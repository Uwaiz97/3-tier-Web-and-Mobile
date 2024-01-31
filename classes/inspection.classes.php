<?php

class Inspection extends Dbh
{
    //Check if property is already under inspection
    private function checkPropertyExist($prop_id)
    {
        $stmt = $this->connect()->prepare('SELECT * FROM inspection WHERE prop_id = ?;');

        if (!$stmt->execute(array($prop_id))) {
            $stmt = null;
            header("location: ../index.php?error=stmtfailed");
            exit();
        }

        if ($stmt->rowCount() == 0) {
            return false;
        } else {
            return true;
        }
    }

    protected function createInspection($user_id, $prop_id)
    {
        $stmt = $this->connect()->prepare('SELECT * FROM staff WHERE staff_id = ?;');

        if (!$stmt->execute(array($user_id))) {
            $stmt = null;
            header("location: ../index.php?error=stmtfailed");
            exit();
        }

        if ($stmt->rowCount() == 0) {
            $stmt = null;
            header("location: ../inspectionHandler.php?error=usernotfound");
            exit();
        }

        $inspector = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stafftype = $inspector[0]["staff_type"];
        $stmt = null;

        $propertycheck = $this->checkPropertyExist($prop_id);

        if ($stafftype == "Co-Ordinator") {

            if ($propertycheck == true) {
                $stmt = $this->connect()->prepare('UPDATE inspection SET oca_id = ? WHERE prop_id = ?;');

                if (!$stmt->execute(array($user_id, $prop_id))) {
                    $stmt = null;
                    header("location: ../index.php?error=stmtfailed");
                    exit();
                }

            } elseif ($propertycheck == false) {
                $stmt = $this->connect()->prepare('INSERT INTO inspection (insp_status, oca_id, prop_id) VALUES (?,?,?);');

                if (!$stmt->execute(array("Awaiting Inspectors", $user_id, $prop_id))) {
                    $stmt = null;
                    header("location: ../index.php?error=stmtfailed");
                    exit();
                }
            }
        } elseif ($stafftype == "OHS") {
            if ($propertycheck == true) {
                $stmt = $this->connect()->prepare('UPDATE inspection SET ohs_id = ? WHERE prop_id = ?;');

                if (!$stmt->execute(array($user_id, $prop_id))) {
                    $stmt = null;
                    header("location: ../index.php?error=stmtfailed");
                    exit();
                }

            } elseif ($propertycheck == false) {
                $stmt = $this->connect()->prepare('INSERT INTO inspection (insp_status, ohs_id, prop_id) VALUES (?,?,?);');

                if (!$stmt->execute(array("Awaiting Inspectors", $user_id, $prop_id))) {
                    $stmt = null;
                    header("location: ../index.php?error=stmtfailed");
                    exit();
                }
            }
        } elseif ($stafftype == "Security") {
            if ($propertycheck == true) {
                $stmt = $this->connect()->prepare('UPDATE inspection SET sec_id = ? WHERE prop_id = ?;');

                if (!$stmt->execute(array($user_id, $prop_id))) {
                    $stmt = null;
                    header("location: ../index.php?error=stmtfailed");
                    exit();
                }

            } elseif ($propertycheck == false) {

                $stmt = $this->connect()->prepare('INSERT INTO inspection (insp_status, sec_id , prop_id) VALUES (?,?,?);');

                if (!$stmt->execute(array("Awaiting Inspectors", $user_id, $prop_id))) {
                    $stmt = null;
                    header("location: ../index.php?error=stmtfailed");
                    exit();
                }
            }
        } else {

            header("location: ../index.php?error=wrongUserType");
            exit();
        }
    }

    //to populate inspection list
    protected function getInspListProperty($userid)
    {

        $stmt = $this->connect()->prepare('SELECT * FROM staff WHERE staff_id = ?;');

        if (!$stmt->execute(array($userid))) {
            $stmt = null;
            header("location: ../index.php?error=stmtfailed");
            exit();
        }

        if ($stmt->rowCount() == 0) {
            $stmt = null;
            header("location: ../index.php?error=usernotfound");
            exit();
        }

        $inspectors = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt = null;

        if ($inspectors[0]['staff_type'] == "OHS") {

            $stmt = $this->connect()->prepare('SELECT * FROM inspection WHERE ohs_id = ?;');

            if ($stmt->rowCount() == 0) {
                $stmt = null;
                header("location: ../inspectionList.php?error=noInspectionfound");
                exit();
            }
            $inspections = $stmt->fetchAll(PDO::FETCH_ASSOC);

            return $inspections;

        }

    }

    protected function getStaffType($userid)
    {
        $stmt = $this->connect()->prepare('SELECT * FROM staff WHERE staff_id = ?;');

        if (!$stmt->execute(array($userid))) {
            $stmt = null;
            header("location: ../index.php?error=stmtfailed");
            exit();
        }

        if ($stmt->rowCount() == 0) {
            $stmt = null;
            header("location: ../index.php?error=usernotfound");
            exit();
        }

        $staff = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $staff[0]["staff_type"];
    }

    protected function getProperty($prop_id)
    {
        $stmt = $this->connect()->prepare('SELECT * FROM property WHERE prop_id = ?;');

        if (!$stmt->execute(array($prop_id))) {
            $stmt = null;
            header("location: ../index.php?error=stmtfailed");
            exit();
        }

        if ($stmt->rowCount() == 0) {
            $stmt = null;
            header("location: ../index.php?error=propnotfound");
            exit();
        }

        $prop = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $prop;
    }

    protected function getInspector($id)
    {
        $stmt = $this->connect()->prepare('SELECT * FROM user WHERE user_id = ?;');

        if (!$stmt->execute(array($id))) {
            $stmt = null;
            header("location: ../index.php?error=stmtfailed");
            exit();
        }

        if ($stmt->rowCount() == 0) {
            $stmt = null;
            header("location: ../index.php?error=propnotfound");
            exit();
        }

        $insp = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $insp;

    }

    //Upadtes Inspection for OCA
    protected function updateOCAInspection($OCA_dateTime, $OCA_propertyName, $OCA_address, $noBeds, $noSingleBeds, $noSharingBeds, $noMattresses, $mattressComt, $noHeaters, $heaterComt, $noLamps, $lampComt, $noBShelves, $bShelveComt, $noWardrobes, $wardrobeComt, $noPaperBins, $paperBinComt, $noCurtains, $curtainsComt, $noChairs, $chairComt, $noTables, $tableComt, $noStoves, $stoveComt, $noFridges, $frigdeComt, $noMicrowaves, $microwaveComt, $noLaundryFacs, $laundryFacsComt, $noLckCupboards, $lckCupboardsComt, $noShowerBaths, $showerBathComt, $noToilets, $toiletComt, $noBasins, $basinComt, $noSheBins, $sheBinComt, $prop_id)
    {
        $stmt = $this->connect()->prepare('UPDATE inspection SET insp_ocaDate = ?, insp_ocaPName = ?, insp_ocaAddress = ?, insp_ocaBeds = ?, insp_numSingleRoom = ?, insp_numShareRooms = ?, insp_nMatrass = ?, insp_matrassComt = ?, insp_nHeaters = ?, insp_heaterComt = ?, insp_nStudyLamp = ?, insp_studyLampComt = ?, insp_nBookshelves = ?, insp_bookshelvesComt = ?, insp_nWardrobes = ?, insp_wardrobeComt = ?, insp_nPaperBins = ?, insp_paperBinComt = ?, insp_nCurtains = ?, insp_nCurtains = ?, insp_nChairs = ?, insp_chairComt = ?, insp_nDesks = ?, insp_deskComt = ?, insp_nStoves = ?, insp_stovesComt = ?, insp_nFridges = ?, insp_fridgesComt = ?, insp_nMicrowaves = ?, insp_microwavesComt = ?, insp_nLaundryFac = ?, insp_laundryFacComt = ?, insp_nLckCupboards = ?, insp_lckCupboardsComt = ?, insp_nShowers = ?, insp_showersComt = ?, insp_nToilets = ?, insp_toiletComt = ?, insp_nBasins = ?, insp_basinsComt = ?, insp_nSheBins = ?, insp_sheBinsComt = ? WHERE prop_id = ?');

        if (!$stmt->execute(array($OCA_dateTime, $OCA_propertyName, $OCA_address, $noBeds, $noSingleBeds, $noSharingBeds, $noMattresses, $mattressComt, $noHeaters, $heaterComt, $noLamps, $lampComt, $noBShelves, $bShelveComt, $noWardrobes, $wardrobeComt, $noPaperBins, $paperBinComt, $noCurtains, $curtainsComt, $noChairs, $chairComt, $noTables, $tableComt, $noStoves, $stoveComt, $noFridges, $frigdeComt, $noMicrowaves, $microwaveComt, $noLaundryFacs, $laundryFacsComt, $noLckCupboards, $lckCupboardsComt, $noShowerBaths, $showerBathComt, $noToilets, $toiletComt, $noBasins, $basinComt, $noSheBins, $sheBinComt, $prop_id))) {
            $stmt = null;
            header("location: ../index.php?error=stmtfailed");
            exit();
        }

        $stmt = null;
    }

    // Updates Inspection for OHS
    protected function updateOHSInspection($OHS_dateTime, $OHS_propertyName, $OHS_address, $fireAlarm, $fireAlarmComt, $smokeDetectors, $smokeDetectorsComt, $fireBlanket, $fireBlanketComt, $fireExtinguishers, $fireExtinguishersComt, $fireEqtSign, $fireEqtSignComt, $firstAid, $firstAidComt, $dbBoard, $dbBoardComt, $pestControl, $pestControlComt, $emgyPdr, $emgyPdrComt, $emgyExitRoute, $emgyExitRouteComt, $exitDoors, $exitDoorsComt, $propid)
    {
        $stmt = $this->connect()->prepare('UPDATE inspection SET insp_ohsDate = ?, insp_ohsPName = ?, insp_ohsAddress = ?, insp_fireAlarm = ?, insp_fireAlarmComt = ?, insp_smkDetect = ?, insp_smkDetectComt = ?, insp_fireBlankets = ?, insp_fireBlanketComt = ?, insp_extinguishers = ?, insp_extinguishersComt = ?, insp_fireEqptSign = ?, insp_fireEqptSignComt = ?, insp_firstAid = ?, insp_firstAidComt = ?, insp_dbBrdSign = ?, insp_dbBrdSignComt = ?, insp_pestControl = ?, insp_pestControlComt = ?, insp_emgyPdr = ?, insp_emgyPdrComt = ?, insp_emgyExitRoute = ?, insp_emgyExitRouteComt = ?, insp_exitDoors = ?, insp_exitDoorsComt = ? WHERE prop_id = ?');

        if (!$stmt->execute(array($OHS_dateTime, $OHS_propertyName, $OHS_address, $fireAlarm, $fireAlarmComt, $smokeDetectors, $smokeDetectorsComt, $fireBlanket, $fireBlanketComt, $fireExtinguishers, $fireExtinguishersComt, $fireEqtSign, $fireEqtSignComt, $firstAid, $firstAidComt, $dbBoard, $dbBoardComt, $pestControl, $pestControlComt, $emgyPdr, $emgyPdrComt, $emgyExitRoute, $emgyExitRouteComt, $exitDoors, $exitDoorsComt, $propid))) {
            $stmt = null;
            header("location: ../index.php?error=stmtfailed");
            exit();
        }

        $stmt = null;
    }

    // Updates Inspection for Security
    protected function updateSecInspection($Sec_dateTime, $Sec_propertyName, $Sec_address, $fence, $fenceComt, $gates, $gatesComt, $burglarProof, $burglarProofComt, $cctv, $cctvComt, $armedResp, $armedRespComt, $panicBtn, $panicBtnComt, $roomLocks, $roomLocksComt, $security, $securityComt, $lighting, $lightingComt, $prop_id)
    {
        $stmt = $this->connect()->prepare('UPDATE inspection SET insp_secDate = ?, insp_secPName = ?, insp_secAddress = ?, insp_fence = ?, insp_fenceComt = ?, insp_gates = ?, insp_gatesComt = ?, insp_burglarProof = ?, insp_burglarProofComt = ?, insp_cctv = ?, insp_cctvComt = ?, insp_armedResp = ?, insp_armedRespComt = ?, insp_panicBTN = ?, insp_panicBTNComt = ?, insp_roomLocks = ?, insp_roomLocksComt = ?, insp_security = ?, insp_securityComt = ?, insp_lighting = ?, insp_lightingComt = ? WHERE prop_id = ?');

        if (!$stmt->execute(array($Sec_dateTime, $Sec_propertyName, $Sec_address, $fence, $fenceComt, $gates, $gatesComt, $burglarProof, $burglarProofComt, $cctv, $cctvComt, $armedResp, $armedRespComt, $panicBtn, $panicBtnComt, $roomLocks, $roomLocksComt, $security, $securityComt, $lighting, $lightingComt, $prop_id))) {
            $stmt = null;
            header("location: ../index.php?error=stmtfailed");
            exit();
        }

        $stmt = null;
    }

    protected function checkInspectionComplete($prop_id)
    {
        $stmt = $this->connect()->prepare('SELECT * FROM inspection WHERE prop_id = ?;');

        if (!$stmt->execute(array($prop_id))) {
            $stmt = null;
            header("location: ../index.php?error=stmtfailed");
            exit();
        }

        $inspection = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt = null;

        if (!$inspection[0]["insp_ocaDate"] == null || !$inspection[0]["insp_ohsDate"] == null || !$inspection[0]["insp_secDate"] == null) {
            $stmt = $this->connect()->prepare('UPDATE inspection SET insp_status = "Inspection Complete" WHERE prop_id = ?;');

            if (!$stmt->execute(array($prop_id))) {
                $stmt = null;
                header("location: ../index.php?error=stmtfailed");
                exit();
            }

            $stmt = null;
        }
    }

    protected function getCompleteInspections()
    {
        $stmt = $this->connect()->prepare('SELECT * FROM inspection WHERE insp_status = "Inspection Completed"');

        if (!$stmt->execute(array())) {
            $stmt = null;
            header("location: ../index.php?error=stmtfailed");
            exit();
        }

        $inspections = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt = null;

        return $inspections;
    }

    protected function updateInspectionStatus($inspid, $status)
    {
        $stmt = $this->connect()->prepare('UPDATE inspection SET insp_status = ? WHERE insp_id = ?;');
        if (!$stmt->execute(array($status, $inspid))) {
            $stmt = null;
            header("location: ../index.php?error=stmtfailed");
            exit();
        }

        if ($stmt->rowCount() == 0) {
            $stmt = null;
            header("location: ../aboutInspection.php?insp=" . $inspid . "&error=inspectionnotfound");
            exit();
        }

    }

    protected function getInspection($inspid)
    {
        $stmt = $this->connect()->prepare('SELECT * FROM inspection WHERE insp_id =  ?;');

        if (!$stmt->execute(array($inspid))) {
            $stmt = null;
            header("location: ../index.php?error=stmtfailed");
            exit();
        }

        if ($stmt->rowCount() == 0) {
            $stmt = null;
            header("location: ../inspectedList.php?inspid=" . $inspid . "&error=inspectionnotfound");
            exit();
        }

        $insp = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt = null;
        return $insp;

    }

    protected function updatePropertyStatus($propid, $status)
    {
        $stmt = $this->connect()->prepare('UPDATE property SET prop_accreditStatus = ? WHERE prop_id = ?;');

        if (!$stmt->execute(array($status, $propid))) {
            $stmt = null;
            header("location: ../index.php?error=stmtfailed");
            exit();
        }

        if ($stmt->rowCount() == 0) {
            $stmt = null;
            header("location: ../aboutInspection.php?propid=" . $propid . "&error=propertynotfound");
            exit();
        }
    }

    protected function setDeclnedComment($propid, $declineComment)
    {
        $stmt = $this->connect()->prepare('UPDATE property SET prop_declineComment = ? WHERE prop_id = ?;');

        if (!$stmt->execute(array($declineComment, $propid))) {
            $stmt = null;
            header("location: ../index.php?error=stmtfailed");
            exit();
        }

        if ($stmt->rowCount() == 0) {
            $stmt = null;
            header("location: ../aboutInspection.php?propid=" . $propid . "&error=propertynotfound");
            exit();
        }

    }

    protected function getInspectionComments($inspid)
    {
        $stmt = $this->connect()->prepare('SELECT insp_commentSection FROM inspection WHERE insp_id =  ?;');

        if (!$stmt->execute(array($inspid))) {
            $stmt = null;
            header("location: ../index.php?error=stmtfailed");
            exit();
        }

        if ($stmt->rowCount() == 0) {
            $stmt = null;
            header("location: ../inspectedList.php?inspid=" . $inspid . "&error=inspectionnotfound");
            exit();
        }

        $comments = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt = null;
        return $comments;
    }

}