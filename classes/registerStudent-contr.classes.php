<?php
session_start();

class RegisterStudentContr 
{
    //Properties of class
    private $id;
    private $prop_id;
    private $rommNo;

    //Constructor 
    public function __construct($prop_id, $rommNo)
    {
        $this->prop_id = $prop_id;
        $this->rommNo = $rommNo;
        $this->id = $_SESSION["userId"];
    }

    public function linkStudentUser()
    {
        //Registers if no errors
        $this->setStudentProperty($this->id, $this->prop_id, $this->rommNo);
    }

    protected function setStudentProperty($id, $prop_id, $rommNo)
    {
        $data = array(
            "student_roomNo" => $rommNo,
            "student_approved" => "Pending",
            "prop_id" => $prop_id
        );

        $ch = require "../initCurl.php";

        curl_setopt($ch, CURLOPT_URL, "http://localhost:80/team27-dev/API/index.php/student/$id");
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
    //Error Handling
    public function emptyInput()
    {
        $result = false;
        if (empty($this->prop_id)) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }
}