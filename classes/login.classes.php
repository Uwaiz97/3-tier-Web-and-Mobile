<?php

class Login extends Dbh
{
    //Creates User
    protected function getUser($email, $password)
    {
        $stmt = $this->connect()->prepare('SELECT user_password FROM user WHERE user_email = ?;');

        if (!$stmt->execute(array($email))) {
            $stmt = null;
            header("location: ../index.php?error=stmtfailed");

            exit();
        }

        if ($stmt->rowCount() == 0) {
            $stmt = null;
            $_SESSION['error'] = "User not found!";
            header("location: ../index.php");
            exit();
        }

        $pwdHashed = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $checkPwd = password_verify($password, $pwdHashed[0]["user_password"]);

        if ($checkPwd == false) {
            $stmt = null;
            $_SESSION['error'] = "Wrong password!";
            header("location: ../index.php");
            exit();
        } elseif ($checkPwd == true) {
            $stmt = $this->connect()->prepare('SELECT * FROM user WHERE user_email = ? AND user_password = ?;');

            if (!$stmt->execute(array($email, $pwdHashed[0]["user_password"]))) {
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

            //session_start();
            //$_SESSION["userId"] = $user[0]["user_id"];

            $stmt = null;
            return $user;
        }
    }

    protected function getStaff($userid)
    {
        $stmt = $this->connect()->prepare('SELECT * FROM staff WHERE staff_id  = ?;');

        if (!$stmt->execute(array($userid))) {
            $stmt = null;
            header("location: ../index.php?error=stmtfailed");
            exit();
        }

        if ($stmt->rowCount() == 0) {
            $stmt = null;
            header("location: ../index.php?error=usernotfound");
            exit();
        }

        $staff = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $stmt = null;
        return $staff;

    }
}