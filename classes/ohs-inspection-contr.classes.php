<?php
class OHSInspectionContr extends Inspection
{
    //Properties of class
    private $OHS_dateTime;
    private $OHS_propertyName;
    private $OHS_address;

    private $fireAlarm;
    private $fireAlarmComt;
    private $smokeDetectors;
    private $smokeDetectorsComt;
    private $fireBlanket;
    private $fireBlanketComt;
    private $fireExtinguishers;
    private $fireExtinguishersComt;
    private $fireEqtSign;
    private $fireEqtSignComt;
    private $firstAid;
    private $firstAidComt;
    private $dbBoard;
    private $dbBoardComt;
    private $pestControl;
    private $pestControlComt;
    private $emgyPdr;
    private $emgyPdrComt;
    private $emgyExitRoute;
    private $emgyExitRouteComt;
    private $exitDoors;
    private $exitDoorsComt;
    private $OHS_id;
    private $prop_id;

    //Constructor
    public function __construct($OHS_dateTime, $OHS_propertyName, $OHS_address, $fireAlarm, $fireAlarmComt, $smokeDetectors, $smokeDetectorsComt, $fireBlanket, $fireBlanketComt, $fireExtinguishers, $fireExtinguishersComt, $fireEqtSign, $fireEqtSignComt, $firstAid, $firstAidComt, $dbBoard, $dbBoardComt, $pestControl, $pestControlComt, $emgyPdr, $emgyPdrComt, $emgyExitRoute, $emgyExitRouteComt, $exitDoors, $exitDoorsComt, $propid)
    {
        $this->OHS_dateTime = $OHS_dateTime;
        $this->OHS_propertyName = $OHS_propertyName;
        $this->OHS_address = $OHS_address;
        $this->fireAlarm = $fireAlarm;
        $this->fireAlarmComt = $fireAlarmComt;
        $this->smokeDetectors = $smokeDetectors; 
        $this->smokeDetectorsComt = $smokeDetectorsComt;
        $this->fireBlanket = $fireBlanket;
        $this->fireBlanketComt = $fireBlanketComt;
        $this->fireExtinguishers = $fireExtinguishers;
        $this->fireExtinguishersComt = $fireExtinguishersComt;
        $this->fireEqtSign = $fireEqtSign;
        $this->fireEqtSignComt = $fireEqtSignComt;
        $this->firstAid = $firstAid;
        $this->firstAidComt = $firstAidComt;
        $this->dbBoard = $dbBoard;
        $this->dbBoardComt = $dbBoardComt;
        $this->dbBoardComt = $dbBoardComt;        
        $this->pestControl = $pestControl;
        $this->pestControlComt = $pestControlComt;
        $this->emgyPdr = $emgyPdr;
        $this->emgyPdrComt = $emgyPdrComt;
        $this->emgyExitRoute = $emgyExitRoute;
        $this->emgyExitRouteComt = $emgyExitRouteComt;
        $this->exitDoors = $exitDoors;
        $this->exitDoorsComt = $exitDoorsComt;
        $this->prop_id = $propid;
    }

    public function submitOHSInspection()
    {
        //Error Handling
        if (!$this->emptyInput() == false) {
            //echo "Empty Input";
            header("location: ../inspection.php?propid=" . $this->prop_id . "&error=emptyinput");
            exit();
        }

        //$this->OHS_id = $_SESSION["userId"];
        $this->OHS_dateTime = date('Y-m-d H:i:s');

        //Creates if no errors
        $this->updateOHSInspection($this->OHS_dateTime, $this->OHS_propertyName, $this->OHS_address, $this->fireAlarm, $this->fireAlarmComt, $this->smokeDetectors, $this->smokeDetectorsComt, $this->fireBlanket, $this->fireBlanketComt, $this->fireExtinguishers, $this->fireExtinguishersComt, $this->fireEqtSign, $this->fireEqtSignComt, $this->firstAid, $this->firstAidComt, $this->dbBoard, $this->dbBoardComt, $this->pestControl, $this->pestControlComt, $this->emgyPdr, $this->emgyPdrComt, $this->emgyExitRoute, $this->emgyExitRouteComt, $this->exitDoors, $this->exitDoorsComt, $this->prop_id);
        $this->checkInspectionComplete($this->prop_id);
    }

    //Error Handling
    public function emptyInput()
    {
        $result = false;
        if (empty($this->OHS_propertyName) || empty($this->OHS_address) || empty($this->fireAlarm) || empty($this->smokeDetectors) || empty($this->fireBlanket) || empty($this->fireExtinguishers) || empty($this->dbBoard) || empty($this->pestControl) || empty($this->emgyPdr) || empty($this->emgyExitRoute) || empty($this->exitDoors)) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }
}