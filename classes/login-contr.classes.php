<?php

class LoginContr
{
    //Properties of class
    private $email;
    private $password;
    private $userId;
    private $user;
    private $staff;
    private $inspections;
    private $properties;

    //Constructor 
    public function __construct($email, $password)
    {
        $this->email = $email;
        $this->password = $password;
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

    public function loginUser()
    {
        //Error Handling
        if ($this->emptyInput() == false) {
            //echo "Empty Input";
            $_SESSION['error'] = "Empty input";
            header("location: ../index.php");
            exit();
        }

        if ($this->invalidEmail() == false) {
            //echo "Invalid Email";
            $_SESSION['error'] = "Invalid Email";
            header("location: ../index.php");
            exit();
        }

        $data = array(
            "method" => "login",
            "user_email" => $this->email,
            "user_password" => $this->password
        );

        $ch = require "../initCurl.php";

        curl_setopt($ch, CURLOPT_URL, "http://localhost:80/team27-dev/API/index.php/user");
        curl_setopt($ch, CURLOPT_POST, true);
        //curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

        $response = curl_exec($ch);

        $statusCode = curl_getinfo($ch, CURLINFO_RESPONSE_CODE);

        curl_close($ch);

        //Logss if no errors
        $data = json_decode($response, true);

        if ($statusCode === 422) {
            //Invalid data
            $_SESSION['error'] = "Invalid data";
            header("location: ../index.php");
            exit();
            // echo "Invalid data: ";
            // print_r($data["errors"]);
            // exit;
        }

        if ($statusCode !== 200) {
            //Error from API
            $_SESSION['error'] = "Oops something went wrong";
            header("location: ../index.php");
            exit();
            // echo "Unexpected status code: $statusCode";
            // var_dump($data);
            // exit;
        }

        $this->userId = $data["user_id"];
        $this->user = $this->getUser($this->userId);

        if ($this->user["message"] == "User not found") {
            //echo "User not found";
            $_SESSION['error'] = "User not found";
            header("location: ../index.php");
            exit();
        }
        $_SESSION["userId"] = $this->userId;
    }

    public function checkForDecline()
    {
        $landlordProps = $this->getLandlordProperties($this->userId);
        $propId = [];

        foreach ($landlordProps as $props) {
            if ($props["prop_accreditStatus"] == "Inspection") {
                $propId[] = $props["prop_id"];
                foreach ($this->inspections as $insp) {
                    if ($insp["prop_id"] == $props["prop_id"] && $insp["insp_status"] == "Inspection Complete") {

                        //beds check
                        if ($insp["insp_ocaBeds"] < ($props["prop_numBeds"] * 0.9)) {
                            $this->changeStatus($insp["insp_id"], "Declined by System");
                            $this->changePropStatus($props["prop_id"], "Declined by System");
                        }

                        //mattresses
                        if ($this->inspections["insp_nMatrass"] < ($props["prop_numBeds"] * 0.9)) {
                            $this->changeStatus($insp["insp_id"], "Declined by System");
                            $this->changePropStatus($props["prop_id"], "Declined by System");
                        }

                        //showers
                        if ($this->inspections["insp_nShowers"] < ($props["prop_numBeds"] / 15)) {
                            $this->changeStatus($insp["insp_id"], "Declined by System");
                            $this->changePropStatus($props["prop_id"], "Declined by System");
                        }

                        //toilets
                        if ($this->inspections["insp_nToilets"] < ($props["prop_numBeds"] / 15)) {
                            $this->changeStatus($insp["insp_id"], "Declined by System");
                            $this->changePropStatus($props["prop_id"], "Declined by System");
                        }

                    }
                }
            }
        }



    }

    public function getLandlordProperties($landlordId)
    {
        $result = array();
        foreach ($this->properties as $property) {
            if ($property["landlord_id"] == $landlordId) {
                $result[] = $property;
            }
        }
        return $result;
    }

    public function changeStatus($inspId, $status)
    {
        $data = array(
            "insp_status" => $status
        );
        $ch = require "../initCurl.php";

        curl_setopt($ch, CURLOPT_URL, "http://localhost:80/team27-dev/API/index.php/inspection/$inspId");
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

    public function changePropStatus($propId, $status)
    {
        $data = array(
            "prop_accreditStatus" => $status
        );
        $ch = require "../initCurl.php";

        curl_setopt($ch, CURLOPT_URL, "http://localhost:80/team27-dev/API/index.php/inspection/$propId");
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

    //Gets User Type to direct to Home Page
    public function getUserType()
    {
        return $this->user["user_type"];
    }

    public function getUserId()
    {
        return $this->user["user_id"];
    }

    public function getStaffType()
    {
        $this->staff = $this->getStaff($_SESSION["userId"]);
        return $this->staff["staff_type"];
    }

    //Error Handling
    public function emptyInput()
    {
        $result = false;
        if (empty(empty($this->email) || empty($this->password))) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }

    //Error Handling
    public function invalidEmail()
    {
        $result = false;
        if (!filter_var($this->email, FILTER_VALIDATE_EMAIL)) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }

    protected function getUser($id)
    {
        $ch = require "../initCurl.php";

        curl_setopt($ch, CURLOPT_URL, "http://localhost:80/team27-dev/API/index.php/user/$id");

        $response = curl_exec($ch);

        curl_close($ch);

        return json_decode($response, true);
    }

    protected function getStaff($id)
    {
        $ch = require "../initCurl.php";

        curl_setopt($ch, CURLOPT_URL, "http://localhost:80/team27-dev/API/index.php/staff/$id");

        $response = curl_exec($ch);

        curl_close($ch);

        return json_decode($response, true);
    }
}