<?php
session_start();

class AboutApplicationContr
{
    //Properties of class
    private $propid;
    private $inspections;

    //Constructor 
    public function __construct($propid)
    {
        $this->propid = $propid;

        //inspections
        $ch = require "initCurl.php";

        curl_setopt($ch, CURLOPT_URL, "http://localhost:80/team27-dev/API/index.php/inspection");

        $response = curl_exec($ch);

        curl_close($ch);

        $this->inspections = json_decode($response, true);
    }

    public function sendToInspection()
    {
        //Creates if no errors
        $this->createInspection();
        $this->updateToInspection();
    }

    public function declineApplication($declineComment)
    {
        //Creates if no errors
        $this->updateToDecline($declineComment);
    }

    public function deAccreditProperty()
    {
        $data = array(
            "prop_accreditStatus" => "De-Accredited"
        );
        
        //Registers if no errors
        $ch = require "../initCurl.php";

        curl_setopt($ch, CURLOPT_URL, "http://localhost:80/team27-dev/API/index.php/property/$this->propid");
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
            var_dump($data);
            exit;
        }
    }

    public function allowAccreditation()
    {
        $data = array(
            "prop_accreditStatus" => "Inspection"
        );
        
        //Registers if no errors
        $ch = require "../initCurl.php";

        curl_setopt($ch, CURLOPT_URL, "http://localhost:80/team27-dev/API/index.php/property/$this->propid");
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
            var_dump($data);
            exit;
        }

        $inspection = $this->showInspectionWithPropId($this->propid);

        $data = array(
            "prop_accreditStatus" => "Inspection"
        );
        
        //Registers if no errors
        $ch = require "../initCurl.php";
        $isnpID = $inspection['insp_id'];

        curl_setopt($ch, CURLOPT_URL, "http://localhost:80/team27-dev/API/index.php/inspection/$isnpID");
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE");

        $response = curl_exec($ch);

        $statusCode = curl_getinfo($ch, CURLINFO_RESPONSE_CODE);

        curl_close($ch);

        //Logss if no errors
        $data = json_decode($response, true);

        if ($statusCode !== 200) {
    
            echo "Unexpected status code: $statusCode";
            var_dump($data);    
            exit;
        }

        $this->createInspection();
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


    public function createInspection()
    {
        $data = array(
            "insp_status" => "Awaiting Inspectors",
            "prop_id" => $this->propid
        );
        
        //Registers if no errors
        $ch = require "../initCurl.php";

        curl_setopt($ch, CURLOPT_URL, "http://localhost:80/team27-dev/API/index.php/inspection");
        curl_setopt($ch, CURLOPT_POST, true);
        //curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
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

        if ($statusCode !== 201) {

            echo "Unexpected status code: $statusCode";
            var_dump($data);
            exit;
        }
    }

    public function updateToInspection()
    {
        $data = array(
            "prop_accreditStatus" => "Inspection"
        );
        
        //Registers if no errors
        $ch = require "../initCurl.php";
        
        curl_setopt($ch, CURLOPT_URL, "http://localhost:80/team27-dev/API/index.php/property/$this->propid");
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
            var_dump($data);
            exit;
        }
    }

    public function updateToDecline($declineComment)
    {
        $data = array(
            "prop_accreditStatus" => "Declined Application",
            "prop_declineComment" => $declineComment
        );
        
        //Registers if no errors
        $ch = require "../initCurl.php";

        curl_setopt($ch, CURLOPT_URL, "http://localhost:80/team27-dev/API/index.php/property/$this->propid");
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
            var_dump($data);
            exit;
        }
    }
}