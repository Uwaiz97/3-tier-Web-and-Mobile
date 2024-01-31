<?php
class OCAInspectionContr extends Inspection
{
    //Properties of class
    private $OCA_dateTime;
    private $OCA_propertyName;
    private $OCA_address;
    private $noBeds;
    private $noSingleBeds;
    private $noSharingBeds;
    //ROOMS
    private $noMattresses;
    private $mattressComt;
    private $noHeaters;
    private $heaterComt;
    private $noLamps;
    private $lampComt;
    private $noBShelves;
    private $bShelveComt;
    private $noWardrobes;
    private $wardrobeComt;
    private $noPaperBins;
    private $paperBinComt;
    private $noCurtains;
    private $curtainsComt;
    private $noChairs;
    private $chairComt;
    private $noTables;
    private $tableComt;
    //KITCHEN
    private $noStoves;
    private $stoveComt;
    private $noFrigdes;
    private $frigdeComt;
    private $noMicrowaves;
    private $microwaveComt;
    private $noLaundryFacs;
    private $laundryFacsComt;
    private $noLckCupboards;
    private $lckCupboardsComt;
    //BATHROOMS
    private $noShowerBaths;
    private $showerBathComt;
    private $noToilets;
    private $toiletComt;
    private $noBasins;
    private $basinComt;
    private $noSheBins;
    private $sheBinComt;
    private $OCA_id;
    private $prop_id;

    //Constructor
    public function __construct($OCA_dateTime, $OCA_propertyName, $OCA_address, $noBeds, $noSingleBeds, $noSharingBeds, $noMattresses, $mattressComt, $noHeaters, $heaterComt, $noLamps, $lampComt, $noBShelves, $bShelveComt, $noWardrobes, $wardrobeComt, $noPaperBins, $paperBinComt, $noCurtains, $curtainsComt, $noChairs, $chairComt, $noTables, $tableComt, $noStoves, $stoveComt, $noFrigdes, $frigdeComt, $noMicrowaves, $microwaveComt, $noLaundryFacs, $laundryFacsComt, $noLckCupboards, $lckCupboardsComt, $noShowerBaths, $showerBathComt, $noToilets, $toiletComt, $noBasins, $basinComt, $noSheBins, $sheBinComt, $prop_id)
    {
        $this->OCA_dateTime = $OCA_dateTime;
        $this->OCA_propertyName = $OCA_propertyName;
        $this->OCA_address = $OCA_address;
        $this->noBeds = $noBeds;
        $this->noSingleBeds = $noSingleBeds;
        $this->noSharingBeds = $noSharingBeds;
        $this->noMattresses = $noMattresses;
        $this->mattressComt = $mattressComt;
        $this->noHeaters = $noHeaters;
        $this->heaterComt = $heaterComt;
        $this->noLamps = $noLamps;
        $this->lampComt = $lampComt;
        $this->noBShelves = $noBShelves;
        $this->bShelveComt = $bShelveComt;
        $this->noWardrobes = $noWardrobes;
        $this->wardrobeComt = $wardrobeComt;
        $this->noPaperBins = $noPaperBins;
        $this->paperBinComt = $paperBinComt;
        $this->noCurtains = $noCurtains;
        $this->curtainsComt = $curtainsComt;
        $this->noChairs = $noChairs;
        $this->chairComt = $chairComt;
        $this->noTables = $noTables;
        $this->tableComt = $tableComt;
        $this->noStoves = $noStoves;
        $this->stoveComt = $stoveComt;
        $this->noFrigdes = $noFrigdes;
        $this->frigdeComt = $frigdeComt;
        $this->noMicrowaves = $noMicrowaves;
        $this->microwaveComt = $microwaveComt;
        $this->noLaundryFacs = $noLaundryFacs;
        $this->laundryFacsComt = $laundryFacsComt;
        $this->noLckCupboards = $noLckCupboards;
        $this->lckCupboardsComt = $lckCupboardsComt;
        $this->noShowerBaths = $noShowerBaths;
        $this->showerBathComt = $showerBathComt;
        $this->noToilets = $noToilets;
        $this->toiletComt = $toiletComt;
        $this->noBasins = $noBasins;
        $this->basinComt = $basinComt;
        $this->noSheBins = $noSheBins;
        $this->sheBinComt = $sheBinComt;
        $this->prop_id = $prop_id;

    }

    public function submitOCAInspection()
    {
        //Error Handling
        if (!$this->emptyInput() == false) {
            //echo "Empty Input";
            header("location: ../inspection.php?propid=" . $this->prop_id . "&error=emptyinput");
            exit();
        }

        //$this->OCA_id = $_SESSION["userId"];
        $this->OCA_dateTime = date('Y-m-d H:i:s');
        //Creates if no errors
        $this->updateOCAInspection($this->OCA_dateTime, $this->OCA_propertyName, $this->OCA_address, $this->noBeds, $this->noSingleBeds, $this->noSharingBeds, $this->noMattresses, $this->mattressComt, $this->noHeaters, $this->heaterComt, $this->noLamps, $this->lampComt, $this->noBShelves, $this->bShelveComt, $this->noWardrobes, $this->wardrobeComt, $this->noPaperBins, $this->paperBinComt, $this->noCurtains, $this->curtainsComt, $this->noChairs, $this->chairComt, $this->noTables, $this->tableComt, $this->noStoves, $this->stoveComt, $this->noFrigdes, $this->frigdeComt, $this->noMicrowaves, $this->microwaveComt, $this->noLaundryFacs, $this->laundryFacsComt, $this->noLckCupboards, $this->lckCupboardsComt, $this->noShowerBaths, $this->showerBathComt, $this->noToilets, $this->toiletComt, $this->noBasins, $this->basinComt, $this->noSheBins, $this->sheBinComt,  $this->prop_id);

        $this->checkInspectionComplete($this->prop_id);
    }

    //Error Handling
    public function emptyInput()
    {
        $result = false;
        if (empty($this->OCA_propertyName) || empty($this->OCA_address) || empty($this->noBeds) || empty($this->noSingleBeds) || empty($this->noSharingBeds) || empty($this->noMattresses) || empty($this->noHeaters) || empty($this->noLamps) || empty($this->noBShelves) || empty($this->noWardrobes) || empty($this->noPaperBins) || empty($this->noCurtains) || empty($this->noChairs) || empty($this->noTables) || empty($this->noStoves) || empty($this->noFrigdes) || empty($this->noMicrowaves) || empty($this->noLaundryFacs) || empty($this->noLckCupboards) || empty($this->noShowerBaths) || empty($this->noToilets) || empty($this->noBasins) || empty($this->noSheBins) || empty($this->prop_id)) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }
}