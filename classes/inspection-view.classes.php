<?php

class InspectionView extends Inspection
{
    private $inspections;
    private $properties;

    public function __construct()
    {
        //inspections
        $ch = require "initCurl.php";

        curl_setopt($ch, CURLOPT_URL, "http://localhost:80/team27-dev/API/index.php/inspection");

        $response = curl_exec($ch);

        curl_close($ch);

        $this->inspections = json_decode($response, true);

        //properties
        $ch = require "initCurl.php";

        curl_setopt($ch, CURLOPT_URL, "http://localhost:80/team27-dev/API/index.php/property");

        $response = curl_exec($ch);

        curl_close($ch);

        $this->properties = json_decode($response, true);
    }

    public function showInspListProperty($userid)
    {
        $inspections = $this->getInspListProperty($userid);

        return $inspections;

    }

    public function showStaffType($userid)
    {
        $staffType = $this->getStaffType($userid);

        return $staffType;
    }

    public function showCompletedInspections()
    {
        $inspections = $this->getCompleteInspections();
        return $inspections;
    }

    public function getInspectedProperty($propid)
    {
        $prop = $this->getProperty($propid);
        return $prop;
    }

    public function showInspection($inspid)
    {
        $inspection = $this->getInspection($inspid);

        return $inspection;

    }

    public function showInspectionWithPropId($propId)
    {
        foreach ($this->inspections as $inspection) {
            if ($inspection["prop_id"] == $propId) {
                return $inspection;
            }
        }
        return null;
    }

    public function showInspector($id)
    {
        $ch = require "initCurl.php";

        curl_setopt($ch, CURLOPT_URL, "http://localhost:80/team27-dev/API/index.php/user/$id");

        $response = curl_exec($ch);

        curl_close($ch);

        return json_decode($response, true);
    }

    public function showInspectionComments($inspid)
    {
        $comments = $this->getInspectionComments($inspid);

        return $comments;
    }

    public function checkIfMinimumMet(array $inspections, int $numBeds)
    {
        $comments = array();

        //beds check
        if ($inspections["insp_ocaBeds"] < $numBeds) {
            $comments[] = "The accomadation is short by " . ($numBeds - $inspections["insp_ocaBeds"]) . " beds";
        }

        //mattresses
        if ($inspections["insp_nMatrass"] < $numBeds) {
            $comments[] = "The accomadation is short by " . ($numBeds - $inspections["insp_nMatrass"]) . " mattresses";
        }

        if ($inspections["insp_nMatrass"] == 0) {
            $AVG = 0;
        } else {
            $AVG = ($inspections["insp_matrassTotalRate"] / $inspections["insp_nMatrass"]);
            if ($AVG < 1) {
                $comments[] = "The accomadation is mattresses average is unuseable. Avg : " . number_format($AVG, 2, '.', '');
            }
        }


        $Useable = ($inspections["insp_nMatrass"] - $inspections["insp_nMatrassBelow"]);
        if ($numBeds > $Useable) {
            $comments[] = "The accomadation is short by " . ($numBeds - $Useable) . " useable mattresses";
        }

        //curtains
        if ($inspections["insp_nCurtains"] < 1) {
            $comments[] = "The accomadation needs curtains";
        }

        if ($inspections["insp_nCurtains"] == 0) {
            $AVG = 0;
        } else {
            $AVG = ($inspections["insp_curtainsTotalRate"] / $inspections["insp_nCurtains"]);
            if ($AVG < 1) {
                $comments[] = "The accomadation is cutains average is unuseable. Avg : " . number_format($AVG, 2, '.', '');
            }

        }

        $Useable = ($inspections["insp_nCurtains"] - $inspections["insp_nCurtainsBelow"]);
        if (1 > $Useable) {
            $comments[] = "The accomadation is short by " . (1 - $Useable) . " useable curtains";
        }

        //Paperbins
        if ($inspections["insp_nPaperBins"] < $numBeds) {
            $comments[] = "The accomadation is short by " . ($numBeds - $inspections["insp_nPaperBins"]) . " paper bins";
        }

        if ($inspections["insp_nPaperBins"] == 0) {
            $AVG = 0;
        } else {
            $AVG = ($inspections["insp_paperBinsTotalRate"] / $inspections["insp_nPaperBins"]);
            if ($AVG < 1) {
                $comments[] = "The accomadation is paper bins average is unuseable. Avg : " . number_format($AVG, 2, '.', '');
            }
        }

        $Useable = ($inspections["insp_nPaperBins"] - $inspections["insp_nPaperBinsBelow"]);
        if ($numBeds > $Useable) {
            $comments[] = "The accomadation is short by " . ($numBeds - $Useable) . " useable paper bins";
        }

        //bookshelves
        if ($inspections["insp_nBookshelves"] < $numBeds) {
            $comments[] = "The accomadation is short by " . ($numBeds - $inspections["insp_nBookshelves"]) . " bookshelves";
        }

        if ($inspections["insp_nBookshelves"] == 0) {
            $AVG = 0;
        } else {
            $AVG = ($inspections["insp_bookshTotalRate"] / $inspections["insp_nBookshelves"]);
            if ($AVG < 1) {
                $comments[] = "The accomadation is bookshelves average is unuseable. Avg : " . number_format($AVG, 2, '.', '');
            }
        }

        $Useable = ($inspections["insp_nBookshelves"] - $inspections["insp_nBookshelvesBelow"]);
        if ($numBeds > $Useable) {
            $comments[] = "The accomadation is short by " . ($numBeds - $Useable) . " useable bookshelves";
        }

        //desks
        if ($inspections["insp_nDesks"] < $numBeds) {
            $comments[] = "The accomadation is short by " . ($numBeds - $inspections["insp_nDesks"]) . " desks";
        }

        if ($inspections["insp_nDesks"] == 0) {
            $AVG = 0;
        } else {
            $AVG = ($inspections["insp_desksTotalRate"] / $inspections["insp_nDesks"]);
            if ($AVG < 1) {
                $comments[] = "The accomadation is desks average is unuseable. Avg : " . number_format($AVG, 2, '.', '');
            }
        }

        $Useable = ($inspections["insp_nDesks"] - $inspections["insp_nDesksBelow"]);
        if ($numBeds > $Useable) {
            $comments[] = "The accomadation is short by " . ($numBeds - $Useable) . " useable desks";

        }

        //chairs
        if ($inspections["insp_nChairs"] < $numBeds) {
            $comments[] = "The accomadation is short by " . ($numBeds - $inspections["insp_nChairs"]) . " chairs";
        }

        if ($inspections["insp_nChairs"] == 0) {
            $AVG = 0;
        } else {
            $AVG = ($inspections["insp_chairsTotalRate"] / $inspections["insp_nChairs"]);
            if ($AVG < 1) {
                $comments[] = "The accomadation is chairs average is unuseable. Avg : " . number_format($AVG, 2, '.', '');
            }
        }

        $Useable = ($inspections["insp_nChairs"] - $inspections["insp_nChairsBelow"]);
        if ($numBeds > $Useable) {
            $comments[] = "The accomadation is short by " . ($numBeds - $Useable) . " useable chairs";

        }

        //wardrobes
        if ($inspections["insp_nWardrobes"] < $numBeds) {
            $comments[] = "The accomadation is short by " . ($numBeds - $inspections["insp_nWardrobes"]) . " wardrobes";
        }

        if ($inspections["insp_nWardrobes"] == 0) {
            $AVG = 0;
        } else {
            $AVG = ($inspections["insp_wardrobesTotalRate"] / $inspections["insp_nWardrobes"]);
            if ($AVG < 1) {
                $comments[] = "The accomadation is wardrobes average is unuseable. Avg : " . number_format($AVG, 2, '.', '');
            }
        }

        $Useable = ($inspections["insp_nWardrobes"] - $inspections["insp_nWardrobesBelow"]);
        if ($numBeds > $Useable) {
            $comments[] = "The accomadation is short by " . ($numBeds - $Useable) . " useable wardrobes";

        }

        //heaters
        if ($inspections["insp_nHeaters"] < $numBeds) {
            $comments[] = "The accomadation is short by " . ($numBeds - $inspections["insp_nHeaters"]) . " heaters";
        }

        if ($inspections["insp_nHeaters"] == 0) {
            $AVG = 0;
        } else {
            $AVG = ($inspections["insp_heatersTotalRate"] / $inspections["insp_nHeaters"]);
            if ($AVG < 1) {
                $comments[] = "The accomadation is heaters average is unuseable. Avg : " . number_format($AVG, 2, '.', '');
            }
        }

        $Useable = ($inspections["insp_nHeaters"] - $inspections["insp_nHeatersBelow"]);
        if ($numBeds > $Useable) {
            $comments[] = "The accomadation is short by " . ($numBeds - $Useable) . " useable heaters";

        }

        //study lamps
        if ($inspections["insp_nStudyLamp"] < $numBeds) {
            $comments[] = "The accomadation is short by " . ($numBeds - $inspections["insp_nStudyLamp"]) . " study lamps";
        }

        if ($inspections["insp_nStudyLamp"] == 0) {
            $AVG = 0;
        } else {
            $AVG = ($inspections["insp_studyLampTotalRate"] / $inspections["insp_nStudyLamp"]);
            if ($AVG < 1) {
                $comments[] = "The accomadation is study lamps average is unuseable. Avg : " . number_format($AVG, 2, '.', '');
            }
        }

        $Useable = ($inspections["insp_nStudyLamp"] - $inspections["insp_nStudyLampBelow"]);
        if ($numBeds > $Useable) {
            $comments[] = "The accomadation is short by " . ($numBeds - $Useable) . " useable study lamps";

        }

        //fridges
        if ($inspections["insp_nFridges"] < ($numBeds / 10)) {
            $comments[] = "The accomadation is short by " . (($numBeds / 10) - $inspections["insp_nFridges"]) . " fridges";
        }

        if ($inspections["insp_nFridges"] == 0) {
            $AVG = 0;
        } else {
            $AVG = ($inspections["insp_fridgesTotalRate"] / $inspections["insp_nFridges"]);
            if ($AVG < 1) {
                $comments[] = "The accomadation is fridges average is unuseable. Avg : " . number_format($AVG, 2, '.', '');
            }
        }

        $Useable = ($inspections["insp_nFridges"] - $inspections["insp_nFridgesBelow"]);
        if (($numBeds / 10) > $Useable) {
            $comments[] = "The accomadation is short by " . (($numBeds / 10) - $Useable) . " useable fridges";
        }

        //microwaves
        if ($inspections["insp_nMicrowaves"] < ($numBeds / 10)) {
            $comments[] = "The accomadation is short by " . (($numBeds / 10) - $inspections["insp_nMicrowaves"]) . " microwaves";
        }

        if ($inspections["insp_nMicrowaves"] == 0) {
            $AVG = 0;
        } else {
            $AVG = ($inspections["insp_microwavesTotalRate"] / $inspections["insp_nMicrowaves"]);
            if ($AVG < 1) {
                $comments[] = "The accomadation is microwaves average is unuseable. Avg : " . number_format($AVG, 2, '.', '');
            }
        }

        $Useable = ($inspections["insp_nMicrowaves"] - $inspections["insp_nMicrowavesBelow"]);
        if (($numBeds / 10) > $Useable) {
            $comments[] = "The accomadation is short by " . (($numBeds / 10) - $Useable) . " useable microwaves";

        }

        //showers
        if ($inspections["insp_nShowers"] < ($numBeds / 10)) {
            $comments[] = "The accomadation is short by " . (($numBeds / 10) - $inspections["insp_nShowers"]) . " showers";
        }

        if ($inspections["insp_nShowers"] == 0) {
            $AVG = 0;
        } else {
            $AVG = ($inspections["insp_showersTotalRate"] / $inspections["insp_nShowers"]);
            if ($AVG < 1) {
                $comments[] = "The accomadation average showers is unuseable. Avg : " . number_format($AVG, 2, '.', '');
            }
        }

        $Useable = ($inspections["insp_nShowers"] - $inspections["insp_nShowersBelow"]);
        if (($numBeds / 10) > $Useable) {
            $comments[] = "The accomadation is short by " . (($numBeds / 10) - $Useable) . " useable showers";

        }

        //laundry
        if ($inspections["insp_nLaundryFac"] < ($numBeds / 10)) {
            $comments[] = "The accomadation is short by " . (($numBeds / 10) - $inspections["insp_nLaundryFac"]) . " Laundy Facility/ies";
        }

        if ($inspections["insp_nLaundryFac"] == 0) {
            $AVG = 0;
        } else {
            $AVG = ($inspections["insp_laundryFacTotalRate"] / $inspections["insp_nLaundryFac"]);
            if ($AVG < 1) {
                $comments[] = "The accomadation laundry facility average is unuseable. Avg : " . number_format($AVG, 2, '.', '');
            }
        }

        $Useable = ($inspections["insp_nLaundryFac"] - $inspections["insp_nLaundryFacBelow"]);
        if (($numBeds / 10) > $Useable) {
            $comments[] = "The accomadation is short by " . (($numBeds / 10) - $Useable) . " useable lockable cupboards";

        }

        //lockable cupboards
        if ($inspections["insp_nLckCupboards"] < ($numBeds / 10)) {
            $comments[] = "The accomadation is short by " . (($numBeds / 10) - $inspections["insp_nLckCupboards"]) . " lockable cupboards";
        }

        if ($inspections["insp_nLckCupboards"] == 0) {
            $AVG = 0;
        } else {
            $AVG = ($inspections["insp_lckCupboardstotalRate"] / $inspections["insp_nLckCupboards"]);
            if ($AVG < 1) {
                $comments[] = "The accomadation lockable cupboards average is unuseable. Avg : " . number_format($AVG, 2, '.', '');
            }
        }

        $Useable = ($inspections["insp_nLckCupboards"] - $inspections["insp_nLckCupboardsBelow"]);
        if (($numBeds / 10) > $Useable) {
            $comments[] = "The accomadation is short by " . (($numBeds / 10) - $Useable) . " useable lockable cupboards ";

        }

        //toilets
        if ($inspections["insp_nToilets"] < ($numBeds / 10)) {
            $comments[] = "The accomadation is short by " . (($numBeds / 10) - $inspections["insp_nToilets"]) . "  toilets";
        }

        if ($inspections["insp_nToilets"] == 0) {
            $AVG = 0;
        } else {
            $AVG = ($inspections["insp_toiletstotalRate"] / $inspections["insp_nToilets"]);
            if ($AVG < 1) {
                $comments[] = "The accomadation toilets average is unuseable. Avg : " . number_format($AVG, 2, '.', '');
            }
        }

        $Useable = ($inspections["insp_nToilets"] - $inspections["insp_nToiletsBelow"]);
        if (($numBeds / 10) > $Useable) {
            $comments[] = "The accomadation is short by " . (($numBeds / 10) - $Useable) . " useable toilets ";

        }

        //basin
        if ($inspections["insp_nBasins"] < ($numBeds / 10)) {
            $comments[] = "The accomadation is short by " . (($numBeds / 10) - $inspections["insp_nBasins"]) . "  basins";
        }

        if ($inspections["insp_nBasins"] == 0) {
            $AVG = 0;
        } else {
            $AVG = ($inspections["insp_basinsTotalRate"] / $inspections["insp_nBasins"]);
            if ($AVG < 1) {
                $comments[] = "The accomadation basins average is unuseable. Avg : " . number_format($AVG, 2, '.', '');
            }
        }

        $Useable = ($inspections["insp_nBasins"] - $inspections["insp_nBasinsBelow"]);
        if (($numBeds / 10) > $Useable) {
            $comments[] = "The accomadation is short by " . (($numBeds / 10) - $Useable) . " useable basins ";

        }

        //she bins
        if ($inspections["insp_nSheBins"] < ($numBeds / 10)) {
            $comments[] = "The accomadation is short by " . (($numBeds / 10) - $inspections["insp_nSheBins"]) . "  she bins";
        }

        if ($inspections["insp_nSheBins"] == 0) {
            $AVG = 0;
        } else {
            $AVG = ($inspections["insp_sheBinsTotalRate"] / $inspections["insp_nSheBins"]);
            if ($AVG < 1) {
                $comments[] = "The accomadation she bins average is unuseable. Avg : " . number_format($AVG, 2, '.', '');
            }
        }

        $Useable = ($inspections["insp_nSheBins"] - $inspections["insp_nSheBinsBelow"]);
        if (($numBeds / 10) > $Useable) {
            $comments[] = "The accomadation is short by " . (($numBeds / 10) - $Useable) . " useable she bins ";

        }

        ////////// //////OHS/////// ////////////

        //fire alarm
        if ($inspections["insp_fireAlarm"] == "false") {
            $comments[] = "The accomadation is short of fire alarm";
        }

        //smoke detector
        if ($inspections["insp_smkDetect"] == "false") {
            $comments[] = "The accomadation is short of smoke detetctors";
        }

        //fire extinguishers
        if ($inspections["insp_extinguishers"] == "false") {
            $comments[] = "The accomadation is short of fire extinguishers";
        }

        //first aid
        if ($inspections["insp_firstAid"] == "false") {
            $comments[] = "The accomadation is short of first aid kits";
        }

        //emergency numbers & procedures
        if ($inspections["insp_emgyNum"] == "false") {
            $comments[] = "The accomadation is short of emergency procedures and numbers";
        }

        //exit doors
        if ($inspections["insp_exitDoors"] == "false") {
            $comments[] = "The accomadation is short of exit doors that can be opened at all times for emergency purposes";
        }

        //fire blankets
        if ($inspections["insp_fireBlankets"] == "false") {
            $comments[] = "The accomadation is short of fire blankets";
        }

        //fire equipment signage
        if ($inspections["insp_fireEqptSign"] == "false") {
            $comments[] = "The accomadation is short of fire equipment signs";
        }

        //db board signage
        if ($inspections["insp_dbBrdSign"] == "false") {
            $comments[] = "The accomadation is short of DB board signage";
        }

        //emergency exit route
        if ($inspections["insp_emgyExitRoute"] == "false") {
            $comments[] = "The accomadation is short of an emergency exit route clear of obstructions";
        }

        ///// //////////SEC///////////// //////

        //fence
        if ($inspections["insp_fence"] == "false") {
            $comments[] = "The accomadation is short of a perimeter fence";
        }

        //gates
        if ($inspections["insp_gates"] == "false") {
            $comments[] = "The accomadation is short of security gates at entrances";
        }

        //burglar proofing
        if ($inspections["insp_burglarProof"] == "false") {
            $comments[] = "The accomadation is short of Burglar bars and doors";
        }

        //cctv
        if ($inspections["insp_cctv"] == "false") {
            $comments[] = "The accomadation is short of cctv/securtity cameras";
        }

        //armed response
        if ($inspections["insp_armedResp"] == "false") {
            $comments[] = "The accomadation is short of emergency armed response solutions";
        }

        //panic btn
        if ($inspections["insp_panicBTN"] == "false") {
            $comments[] = "The accomadation is short of panic buttons for safety emergencies";
        }

        //room locks
        if ($inspections["insp_roomLocks"] == "false") {
            $comments[] = "The accomadation is short of locking rooms";
        }

        //security
        if ($inspections["insp_security"] == "false") {
            $comments[] = "The accomadation is short of a posted security";
        }

        //emergency exit route
        if ($inspections["insp_lighting"] == "false") {
            $comments[] = "The accomadation is short of clear visible lighting";
        }

        return $comments;
    }

}