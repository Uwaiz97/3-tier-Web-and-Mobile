<?php
session_start();

class AboutInspectionContr extends Inspection
{
    //Properties of class
    private $inspid;
    private $propid;
    
    //Constructor 
    public function __construct($inspid)
    {
        $this->inspid = $inspid;
        $insp = $this->getInspection($this->inspid);
        $this->propid = $insp[0]["prop_id"];
    }

    public function approveInspection()
    {
        //Creates if no errors
        $this->updateInspectionStatus($this->inspid,"Approved");
        $this->updatePropertyStatus($this->propid,"Accredited");
    }
    public function declineInspection($declineComment)
    {
        //Creates if no errors
        $this->updateInspectionStatus($this->inspid, "Declined");
        $this->updatePropertyStatus($this->propid,"Inspection Declined");
        $this->setDeclnedComment($this->propid,$declineComment);

    }
}