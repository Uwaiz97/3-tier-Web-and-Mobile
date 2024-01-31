<?php
session_start();

class AboutReportContr
{
    //Properties of class
    private $reportid;

    //Constructor 
    public function __construct($reportid)
    {
        $this->reportid = $reportid;
    }

    public function markAsResolved()
    {
        //Creates if no errors
        $this->updateReportStatus($this->reportid, "Resolved");
    }

    public function updateReportStatus($reportid, $status)
    {
        $data = array(
            "report_status" => $status
        );
        
        //Registers if no errors
        $ch = require "../initCurl.php";
        
        curl_setopt($ch, CURLOPT_URL, "http://localhost:80/team27-dev/API/index.php/reports/$this->reportid");
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
}