<?php
session_start();

class InspectionContr
{
    //Properties of class
    private $user_id;
    private $staff;
    private $inspId;

    //Constructor 
    public function __construct($inspId)
    {
        $this->inspId = $inspId;
    }

    public function sendToInspection()
    {
        //Error Handling
        if (!$this->emptyInput() == false) {
            //echo "Empty Input";
            header("location: ../inspectionHandler.php?error=emptyinput");
            exit();
        }

        $this->user_id = $_SESSION["userId"];

        //Registers if no errors
        $this->addInspector($this->user_id, $this->inspId);
        $this->checkInspectors();
    }

    protected function addInspector($user_id, $inspId)
    {

        $staffType = $this->getStaffType();
        $dbId = "";

        if ($staffType == "Co-Ordinator") {
            $dbId = "oca_Id";
        } elseif ($staffType == "OHS") {
            $dbId = "ohs_Id";
        } elseif ($staffType == "Security") {
            $dbId = "sec_Id";
        }

        $data = array(
            $dbId => $this->user_id
        );
        $ch = require "../initCurl.php";
        $tempID = $this->inspId;
        
        curl_setopt($ch, CURLOPT_URL, "http://localhost:80/team27-dev/API/index.php/inspection/$tempID");
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PATCH");
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        
        $response = curl_exec($ch);
        var_dump($response);

        $statusCode = curl_getinfo($ch, CURLINFO_RESPONSE_CODE);

        curl_close($ch);

        //Logss if no errors
        $data = json_decode($response, true);

        if ($statusCode === 422) {

            echo "Invalid data: ";
            print_r($data["errors"]);
            exit;
        }

        if ($statusCode !== 200) {

            echo "Unexpected status code: $statusCode";
            exit;
        }
    }

    public function getStaffType()
    {
        $this->staff = $this->getStaff($_SESSION["userId"]);
        return $this->staff["staff_type"];
    }

    public function emptyInput()
    {
        $result = false;
        if (empty($this->inspId)) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }

    protected function getStaff($id)
    {
        $ch = require "../initCurl.php";

        curl_setopt($ch, CURLOPT_URL, "http://localhost:80/team27-dev/API/index.php/staff/$id");

        $response = curl_exec($ch);

        curl_close($ch);

        return json_decode($response, true);
    }

    public function showInspection($id)
    {
        $ch = require "initCurl.php";

        curl_setopt($ch, CURLOPT_URL, "http://localhost:80/team27-dev/API/index.php/inspection/$id");

        $response = curl_exec($ch);

        curl_close($ch);

        return json_decode($response, true);
    }

    public function checkInspectors()
    {
        $inspection = $this->showInspection($this->inspId);

        if ($inspection["oca_Id"] == null || $inspection["ohs_Id"] == null || $inspection["sec_Id"] == null) {
            return;
        }

        $data = array(
            "insp_status" => "Inspection"
        );

        $ch = require "../initCurl.php";

        curl_setopt($ch, CURLOPT_URL, "http://localhost:80/team27-dev/API/index.php/inspection/$this->inspId");
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PATCH");
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

        $response = curl_exec($ch);

        $statusCode = curl_getinfo($ch, CURLINFO_RESPONSE_CODE);

        curl_close($ch);

        //Logss if no errors
        $data = json_decode($response, true);

        if ($statusCode === 422) {

            echo "Invalid data: ";
            print_r($data["errors"]);
            exit;
        }

        if ($statusCode !== 200) {

            echo "Unexpected status code: $statusCode";
            exit;
        }
    }
}