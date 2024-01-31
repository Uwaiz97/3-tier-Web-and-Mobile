<?php

class RegisterCaretakerContr extends Register
{
    //Properties of class
    private $id;
    private $name;
    private $surname;
    private $email;
    private $phone;
    private $propId;
    private $password;
    private $userType;
    //Constructor 
    public function __construct($name, $surname, $email, $phone)
    {
        $this->name = $name;
        $this->surname = $surname;
        $this->email = $email;
        $this->phone = $phone;
        $this->id = $_SESSION["userId"];
    }

    public function registerCaretaker()
    {
        //Error Handling
        if (!$this->emptyInput() == false) {
            //echo "Empty Input";
            header("location: ../register.php?error=emptyinput");
            exit();
        }

        if ($this->invalidEmail() == false) {
            //echo "Invalid Email";
            header("location: ../register.php?error=email");
            exit();
        }

        if ($this->checkEmailExists() == false) {
            //echo "Empty Input";
            header("location: ../index.php?error=emailtaken");
            exit();
        }
        $this->password = $this->name . 123;

        //Registers if no errors
        $caretakerId = $this->createUser($this->name, $this->surname, $this->email, $this->phone, $this->password, "Caretaker");
        $this->setCaretakerProperty($caretakerId);

    }

    protected function createUser($name, $surname, $email, $phone, $password, $userType)
    {
        $data = array(
            "method" => "register",
            "user_name" => $this->name,
            "user_email" => $this->email,
            "user_password" => $this->password,
            "user_surname" => $this->surname,
            "user_phoneNo" => $this->phone,
            "user_type" => $this->userType
        );

        //Registers if no errors
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

            echo "Invalid data: ";
            print_r($data["errors"]);
            exit;
        }

        if ($statusCode !== 201) {

            echo "Unexpected status code: $statusCode";
            var_dump($data);
            exit;
        }

        return $data["user_id"];

    }

    protected function setCaretakerProperty($id, $prop_id)
    {
        $data = array(
            "prop_id" => $prop_id
        );

        $ch = require "../initCurl.php";

        curl_setopt($ch, CURLOPT_URL, "http://localhost:80/team27-dev/API/index.php/caretaker/$id");
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
        if (empty($this->name) || empty($this->surname) || empty($this->email) || empty($this->phone) || empty($this->userType)) {
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

    //Error Handling
    public function checkEmailExists()
    {
        $result = false;
        if (!$this->checkUser($this->email)) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }
}