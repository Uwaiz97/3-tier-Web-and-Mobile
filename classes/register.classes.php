<?php

class Register extends Dbh
{
    //Creates User
    protected function createUser($name, $surname, $email, $phone, $password, $userType)
    {
        // Assuming $this->connect() establishes the database connection

        $stmt = $this->connect()->prepare('INSERT INTO user (user_name, user_surname, user_email, user_phoneNo, user_password, user_type) VALUES (?,?,?,?,?,?);');

        $hashedPwd = password_hash($password, PASSWORD_DEFAULT);

        if ($stmt->execute(array($name, $surname, $email, $phone, $hashedPwd, $userType))) {
            echo "User registration confirmed successfully.";
        } else {
            echo "Error confirming user registration.";
            // You can provide more detailed error handling here
        }

        $stmt = null;
    }

    //Creates User in the Landlord table
    protected function createLandlord($id)
    {
        $stmt = $this->connect()->prepare('INSERT INTO landlord (landlord_id, landlord_blaclistStatus) VALUES (?,?);');

        if (!$stmt->execute(array($id, false))) {
            $stmt = null;
            header("location: ../index.php?error=stmtfailed");
            exit();
        }

        $stmt = null;
    }

    //Creates User in the Staff table
    protected function createStaff($id, $userType)
    {
        $stmt = $this->connect()->prepare('INSERT INTO staff (staff_id, staff_type) VALUES (?,?);');

        if (!$stmt->execute(array($id, $userType))) {
            $stmt = null;
            header("location: ../index.php?error=stmtfailed");
            exit();
        }

        $stmt = null;
    }
    protected function createStudent($id)
    {
        // Assuming $this->connect() establishes the database connection

        $stmt = $this->connect()->prepare('INSERT INTO student (student_id, student_roomNo, student_approved, student_blaclistStatus, prop_id) VALUES (?,?,?,?,?);');

        if (!$stmt->execute(array($id, null, false, false, null))) {
            $stmt = null;
            header("location: ../index.php?error=stmtfailed");
            exit();
        }

        $stmt = null;
    }


    //checks if User exists
    protected function checkUser($email)
    {
        $stmt = $this->connect()->prepare('SELECT user_id FROM user WHERE user_email = ?;');

        if (!$stmt->execute(array($email))) {
            $stmt = null;
            header("location: ../index.php?error=stmtfailed");
            exit();
        }

        $resultCheck = false;
        if ($stmt->rowCount() > 0) {
            $resultCheck = false;
        } else {
            $resultCheck = true;
        }
        return $resultCheck;
    }

    //Gets User Id to use in createLandlord function
    protected function getUserId($email)
    {
        $stmt = $this->connect()->prepare('SELECT * FROM user WHERE user_email = ?;');

        if (!$stmt->execute(array($email))) {
            $stmt = null;
            header("location: ../index.php?error=stmtfailed");
            exit();
        }

        if ($stmt->rowCount() == 0) {
            $stmt = null;
            header("location: ../index.php?error=usernotfound");
            exit();
        }

        $user = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $user[0]["user_id"];
    }
}