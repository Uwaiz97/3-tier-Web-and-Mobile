<?php
if (isset($_POST["accept"])) {
    //Get Data from form
    $inspId = $_POST["inspId"];

    //Instantiate contr class
    include "../classes/dbh.classes.php";
    include "../classes/inspection.classes.php";
    include "../classes/inspection-contr.classes.php";
    $inspection = new InspectionContr($inspId);

    //Error Handling and then registering
    $inspection->sendToInspection();

    //Going to back to front page
    header("location: ../inspectionHandler.php?error=none");
}

if (isset($_POST["OCA_submit"])) {

    //Get Data from form
    $OCA_dateTime = $_POST["dateTime"];
    $OCA_propertyName = $_POST["propertyName"];
    $OCA_address = $_POST["address"];
    $noBeds = $_POST["noBeds"];
    $noSingleBeds = $_POST["noSingleBeds"];
    $noSharingBeds = $_POST["noSharingBeds"];
    //ROOMS
    $noMattresses = $_POST["noMattresses"];
    $mattressComt = $_POST["mattressComt"];
    $noHeaters = $_POST["noHeaters"];
    $heaterComt = $_POST["heaterComt"];
    $noLamps = $_POST["noLamps"];
    $lampComt = $_POST["lampComt"];
    $noBShelves = $_POST["noBShelves"];
    $bShelveComt = $_POST["bShelveComt"];
    $noWardrobes = $_POST["noWardrobes"];
    $wardrobeComt = $_POST["wardrobeComt"];
    $noPaperBins = $_POST["noPaperBins"];
    $paperBinComt = $_POST["paperBinComt"];
    $noCurtains = $_POST["noCurtains"];
    $curtainsComt = $_POST["curtainsComt"];
    $noChairs = $_POST["noChairs"];
    $chairComt = $_POST["chairComt"];
    $noTables = $_POST["noTables"];
    $tableComt = $_POST["tableComt"];
    //KITCHEN
    $noStoves = $_POST["noStoves"];
    $stoveComt = $_POST["stoveComt"];
    $noFrigdes = $_POST["noFrigdes"];
    $frigdeComt = $_POST["frigdeComt"];
    $noMicrowaves = $_POST["noMicrowaves"];
    $microwaveComt = $_POST["microwaveComt"];
    $noLaundryFacs = $_POST["noLaundryFacs"];
    $laundryFacsComt = $_POST["laundryFacsComt"];
    $noLckCupboards = $_POST["noLckCupboards"];
    $lckCupboardsComt = $_POST["lckCupboardsComt"];
    //BATHROOMS
    $noShowerBaths = $_POST["noShowerBaths"];
    $showerBathComt = $_POST["showerBathComt"];
    $noToilets = $_POST["noToilets"];
    $toiletComt = $_POST["toiletComt"];
    $noBasins = $_POST["noBasins"];
    $basinComt = $_POST["basinComt"];
    $noSheBins = $_POST["noSheBins"];
    $sheBinComt = $_POST["sheBinComt"];
    $propid = $_POST["propid"];

    //Instantiate contr class
    include "../classes/dbh.classes.php";
    include "../classes/inspection.classes.php";
    include "../classes/oca-inspection-contr.classes.php";
    $inspection = new OCAInspectionContr($OCA_dateTime, $OCA_propertyName, $OCA_address, $noBeds, $noSingleBeds, $noSharingBeds, $noMattresses, $mattressComt, $noHeaters, $heaterComt, $noLamps, $lampComt, $noBShelves, $bShelveComt, $noWardrobes, $wardrobeComt, $noPaperBins, $paperBinComt, $noCurtains, $curtainsComt, $noChairs, $chairComt, $noTables, $tableComt, $noStoves, $stoveComt, $noFrigdes, $frigdeComt, $noMicrowaves, $microwaveComt, $noLaundryFacs, $laundryFacsComt, $noLckCupboards, $lckCupboardsComt, $noShowerBaths, $showerBathComt, $noToilets, $toiletComt, $noBasins, $basinComt, $noSheBins, $sheBinComt, $propid);

    echo "here";
    //Error Handling and then registering
    $inspection->submitOCAInspection();
    echo "here";
    //Going to back to front page
    header("location: ../inspectionHome.php?error=none");
}

if (isset($_POST["OHS_submit"])) {

    //Get Data from form
    $OHS_dateTime = $_POST["dateTime"];
    $OHS_propertyName = $_POST["propertyName"];
    $OHS_address = $_POST["address"];
    $fireAlarm = $_POST["fireAlarm"];
    $fireAlarmComt = $_POST["fireAlarmComt"];
    $smokeDetectors = $_POST["smokeDetectors"];
    $smokeDetectorsComt = $_POST["smokeDetectorsComt"];
    $fireBlanket = $_POST["fireBlanket"];
    $fireBlanketComt = $_POST["fireBlanketComt"];
    $fireExtinguishers = $_POST["fireExtinguishers"];
    $fireExtinguishersComt = $_POST["fireExtinguishersComt"];
    $fireEqtSign = $_POST["fireEqtSign"];
    $fireEqtSignComt = $_POST["fireEqtSignComt"];
    $firstAid = $_POST["firstAid"];
    $firstAidComt = $_POST["firstAidComt"];
    $dbBoard = $_POST["dbBoard"];
    $dbBoardComt = $_POST["dbBoardComt"];
    $pestControl = $_POST["pestControl"];
    $pestControlComt = $_POST["pestControlComt"];
    $emgyPdr = $_POST["emgyPdr"];
    $emgyPdrComt = $_POST["emgyPdrComt"];
    $emgyExitRoute = $_POST["emgyExitRoute"];
    $emgyExitRouteComt = $_POST["emgyExitRouteComt"];
    $exitDoors = $_POST["exitDoors"];
    $exitDoorsComt = $_POST["exitDoorsComt"];
    $propid = $_POST["propid"];

    //Instantiate contr class
    include "../classes/dbh.classes.php";
    include "../classes/inspection.classes.php";
    include "../classes/ohs-inspection-contr.classes.php";
    $inspection = new OHSInspectionContr($OHS_dateTime, $OHS_propertyName, $OHS_address, $fireAlarm, $fireAlarmComt, $smokeDetectors, $smokeDetectorsComt, $fireBlanket, $fireBlanketComt, $fireExtinguishers, $fireExtinguishersComt, $fireEqtSign, $fireEqtSignComt, $firstAid, $firstAidComt, $dbBoard, $dbBoardComt, $pestControl, $pestControlComt, $emgyPdr, $emgyPdrComt, $emgyExitRoute, $emgyExitRouteComt, $exitDoors, $exitDoorsComt, $propid);
    //Error Handling and then registering
    $inspection->submitOHSInspection();

    //Going to back to front page
    header("location: ../inspectionHome.php?error=none");
}

if (isset($_POST["Sec_submit"])) {

    //Get Data from form
    $Sec_dateTime = $_POST["dateTime"];
    $Sec_propertyName = $_POST["propertyName"];
    $Sec_address = $_POST["address"];

    $fence = $_POST["fence"];
    $fenceComt = $_POST["fenceComt"];
    $gates = $_POST["gates"];
    $gatesComt = $_POST["gatesComt"];
    $burglarProof = $_POST["burglarProof"];
    $burglarProofComt = $_POST["burglarProofComt"];
    $cctv = $_POST["cctv"];
    $cctvComt = $_POST["cctvComt"];
    $armedResp = $_POST["armedResp"];
    $armedRespComt = $_POST["armedRespComt"];
    $panicBtn = $_POST["panicBtn"];
    $panicBtnComt = $_POST["panicBtnComt"];
    $roomLocks = $_POST["roomLocks"];
    $roomLocksComt = $_POST["roomLocksComt"];
    $security = $_POST["security"];
    $securityComt = $_POST["securityComt"];
    $lighting = $_POST["lighting"];
    $lightingComt = $_POST["lightingComt"];
    $propid = $_POST["propid"];

    //Instantiate contr class
    include "../classes/dbh.classes.php";
    include "../classes/inspection.classes.php";
    include "../classes/sec-inspection-contr.classes.php";
    $inspection = new SecInspectionContr($Sec_dateTime, $Sec_propertyName, $Sec_address, $fence, $fenceComt, $gates, $gatesComt, $burglarProof, $burglarProofComt, $cctv, $cctvComt, $armedResp, $armedRespComt, $panicBtn, $panicBtnComt, $roomLocks, $roomLocksComt, $security, $securityComt, $lighting, $lightingComt, $propid);

    //Error Handling and then registering
    $inspection->submitSecInspection();

    //Going to back to front page
    //header("location: ../inspectionHome.php?error=none");
}