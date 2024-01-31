<?php
require 'config.php';
class MyClass{

    private $userId;

    private $conn;

    public function __construct($conn) {
        $this->conn = $conn;
        session_start(); // start session inside class constructor
        //$_SESSION['userId'];
      }

    public function register($name, $surname, $email, $phone, $password, $confirm, $type){
        if($confirm!=$password){
            echo ("<script> alert('Password doese not match!!!'); </script>");
        }else{
            
            $user = mysqli_query($this->conn, "SELECT * FROM user WHERE email = '$email'");
            if(mysqli_num_rows($user) > 0){
                echo ("<script> alert('The email already registered in the system, try to log in.'); </script>");
            }
            else{
                $pass= md5($password);
                $query = "INSERT INTO user VALUES('', '$name', '$surname', '$email', '$phone','$password','$type')";
                mysqli_query($this->conn, $query);
                echo "<script> alert('Registration Successful'); </script>";
                header("Location: index.php");
            }

        }
    }

    public function setUserId($Id){
        $this->userId = $Id;
    }
    
    public function getStudentID(){
        return $this->userId;
    }

    public function logIn($email, $password){

        //$pass= md5($password);
        $user = "SELECT * FROM user WHERE email='$email' AND password='$password'";
		$result = mysqli_query($this->conn, $user);

		// Check if the user's login credentials are valid
		if(mysqli_num_rows($result) > 0) {
            $user1 = "SELECT type FROM user WHERE email='$email' AND password='$password'";
            $result = $this->conn->query($user1);

            if(mysqli_num_rows($result) > 0){
                $studentID = $row["userID"];
                $this->setUserId($studentID);
                header('Location: StudentRegister.php');
            }
			// Login successful
			//$_SESSION['userID'] = $username;
            echo ("<script> alert('Successfull Logged in'$studentID''); </script>");
			//exit;
            header('Location: maintenanceIssues.php');
		} else {
			// Login failed
            echo ("<script> alert('Invalid login credentials.'); </script>");
		}  
		// Close the database connection
		mysqli_close($this->conn);
    }

    public function studentReg($studentNo, $code, $StudentID){

        $user = "SELECT * FROM property WHERE code = '$code'";
		$result = mysqli_query($this->conn, $user);

        if(mysqli_num_rows($result) > 0){
            $merchant = "SELECT landlord FROM property WHERE code = '$code'";
            $result = $this->conn->query($merchant);
            $row = $result->fetch_assoc();
          
            $landlordID = $row["landlord"];
            if( $landlordID != null){
              $query = "INSERT INTO studentproperty VALUES('$code', '$studentNo', '$StudentID', '$landlordID', 'Pending')";
          
              mysqli_query($this->conn, $query);
              echo ("<script> alert('Request successful.'); </script>");
            }
        }else{
            echo ("<script> alert('Incorrect accreditation code.'); </script>");
        }

    }

    public function acceptStudent($studentNo){

        $query = "UPDATE studentproperty
                  SET status = 'Approved'
                  WHERE studentNo = '$studentNo'";
      
          mysqli_query($this->conn, $query);
    }

    public function declineStudent($studentNo){

        $query = "UPDATE studentproperty
        SET status = 'Declined'
        WHERE studentNo = '$studentNo'";

        mysqli_query($conn, $query);
    }

    public function handle($studentNo, $id){
        $status = "SELECT status FROM studentproperty WHERE studentNo = '$studentNo'";
        $result = $this->conn->query($status);
        $row = $result->fetch_assoc();
      
        $stStatus = $row["status"];
        
        $propertyId = "SELECT code FROM studentproperty WHERE studentNo = '$studentNo'";
        $result2 = $this->conn->query($propertyId);
        $row = $result2->fetch_assoc();
        
        $propID = $row["code"];
        if($stStatus != "Approved"){
            //dynamically populate the status
        }else{
            //Insert the data into student table (UserID, StudentNo, PropertyID)
            $query = "INSERT INTO student VALUES('$id', '$studentNo', '$propID')";
      
          mysqli_query($this->conn, $query);
        }
    }


}