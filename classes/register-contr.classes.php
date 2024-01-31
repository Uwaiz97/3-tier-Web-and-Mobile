<?php
session_start();
class RegisterContr
{
    //Properties of class
    private $id;
    private $name;
    private $surname;
    private $email;
    private $phone;
    private $password;
    private $confirm_password;
    private $userType;
    private $studentNo;

    //Constructor 
    public function __construct($name, $surname, $email, $phone, $password, $confirm_password, $userType, ?string $studentNo)
    {
        $this->name = $name;
        $this->surname = $surname;
        $this->email = $email;
        $this->phone = $phone;
        $this->password = $password;
        $this->confirm_password = $confirm_password;
        $this->userType = $userType;
        if ($studentNo) {
            $this->studentNo = $studentNo;
        }
    }

    public function registerUser()
    {
        //Error Handling
        if (!$this->emptyInput() == false) {
            //echo "Empty Input";
            $_SESSION['error'] = "Empty input";
            header("location: ../register.php");
            exit();
        }

        if ($this->invalidEmail() == false) {
            //echo "Invalid Email";
            $_SESSION['error'] = "Invalid Email";
            header("location: ../register.php");
            exit();
        }

        if ($this->pwdMatch() == false) {
            //echo "Empty Input";
            $_SESSION['error'] = "Password must match...";
            header("location: ../register.php");
            exit();
        }

        //Strong password handling:
        if ($this->is_strong_password() == false) {
            //echo "Empty Input";
            $_SESSION['error'] = "Password must contain at least 8 characters and include uppercase, lowercase, digits, and special characters";
            header("location: ../register.php");
            exit();
        }

        //Number handling:
        if ($this->isCorrectNumber() == false) {
            //echo "Empty Input";
            //header("location: ../register.php");
            exit();
        }

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
            //Invalid data
            $_SESSION['error'] = "Invalid data";
            header("location: ../register.php");
            exit();
            // echo "Invalid data: ";
            // print_r($data["errors"]);
            // exit;
        }

        if ($statusCode !== 201) {
            //Error from API
            $_SESSION['error'] = "Oops something went wrong";
            header("location: ../register.php");
            exit();
            // echo "Unexpected status code: $statusCode";
            // var_dump($data);
            // exit;
        }

        //$this->createUser($this->name, $this->surname, $this->email, $this->phone, $this->password, $this->userType);
        $this->id = $data["user_id"];


        if ($this->userType == "Landlord") {
            $this->createLandlord($this->id);
            $_SESSION['success'] = "You have successfully registered";

        } else if ($this->userType = "Student") {
            $this->createStudent($this->id, $this->studentNo);
            $_SESSION['success'] = "You have successfully registered";

        }

    }

    //Error Handling
    public function emptyInput()
    {
        $result = false;
        if (empty($this->name) || empty($this->surname) || empty($this->email) || empty($this->phone) || empty($this->password) || empty($this->confirm_password) || empty($this->userType)) {
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
    public function pwdMatch()
    {
        $result = false;
        if ($this->password !== $this->confirm_password) {
            $result = false;
        } else {
            $result = true;
        }
        return $result;
    }

    //Handling strong password.

    function is_strong_password()
    {
        $min_length = 8;
        $regex_uppercase = '/[A-Z]/';
        $regex_lowercase = '/[a-z]/';
        $regex_digit = '/\d/';
        $regex_special = '/[^A-Za-z0-9]/';
        // if (strlen($this->password) < $min_length) {
        //     $_SESSION['error'] = "The password must have a minimum length of 8 ";
        //     header("location: ../register.php");
        //     exit();
        //     //return false;
        // }
        // if (!preg_match($regex_uppercase, $this->password)) {

        //     $_SESSION['error'] = "The password must have a capital letter";
        //     header("location: ../register.php");
        //     exit();
        //     //return false;
        // }
        // if (!preg_match($regex_lowercase, $this->password)) {

        //     $_SESSION['error'] = "The password must have a small letter";
        //     header("location: ../register.php");
        //     exit();
        //     //return false;
        // }
        // if (!preg_match($regex_digit, $this->password)) {
        //     $_SESSION['error'] = "The password must have a number";
        //     header("location: ../register.php");
        //     exit();
        //     //return false;
        // }
        // if (!preg_match($regex_special, $this->password)) {
        //     $_SESSION['error'] = "The password must have a special character";
        //     header("location: ../register.php");
        //     exit();
        //     //return false;
        // }
        return true;
    }

    ////Cellphone Handler:
    public function isCorrectNumber()
    {
        $minLength = 10;
        $regexDigit = '/\d/';
        $regexStartsWithZero = '/^0/';
        $regexSpecial = '/[0-9]/'; // Corrected regex pattern

        if (strlen($this->phone) < $minLength) {
            $_SESSION['error'] = "the Minimum length must be 10";
            header("location: ../register.php");
            exit();
            //return false;
        }

        if (!preg_match($regexDigit, $this->phone)) {
            $_SESSION['error'] = "Number";
            header("location: ../register.php");
            exit();
            //return false;
        }

        if (!preg_match($regexSpecial, $this->phone)) {
            $_SESSION['error'] = "Only numbers are allowed";
            header("location: ../register.php");
            exit();
            // return false;
        }

        if (!preg_match($regexStartsWithZero, $this->phone)) {
            $_SESSION['error'] = "The number must start with zero";
            header("location: ../register.php");
            exit();
            //return false;
        }

        return true;
    }

    protected function createLandlord($id)
    {
        $data = array(
            "landlord_id" => $id
        );

        //Registers if no errors
        $ch = require "../initCurl.php";

        curl_setopt($ch, CURLOPT_URL, "http://localhost:80/team27-dev/API/index.php/landlord");
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

    protected function createStudent($id, $studentNo)
    {
        $data = array(
            "student_id" => $id,
            "student_roomNo" => null,
            "student_number" => $studentNo,
            "student_approved" => null,
            "prop_id" => null
        );

        //Registers if no errors
        $ch = require "../initCurl.php";

        curl_setopt($ch, CURLOPT_URL, "http://localhost:80/team27-dev/API/index.php/student");
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
}