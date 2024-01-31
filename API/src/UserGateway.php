<?php

class UserGateway extends Dbh
{
    public function getAll(): array
    {
        $sql = "SELECT *
                FROM user";

        $stmt = $this->connect()->query($sql);

        $data = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

            $data[] = $row;
        }

        return $data;
    }

    public function register(array $data): string
    {
        $sql = "INSERT INTO user (user_name, user_surname, user_email, user_phoneNo, user_password, user_type) VALUES (:user_name, :user_surname, :user_email, :user_phoneNo, :user_password, :user_type)";

        $stmt = $this->connect()->prepare($sql);

        $hashedPwd = password_hash($data["user_password"], PASSWORD_DEFAULT);

        $stmt->bindValue(":user_name", $data["user_name"], PDO::PARAM_STR);
        $stmt->bindValue(":user_surname", $data["user_surname"], PDO::PARAM_STR);
        $stmt->bindValue(":user_email", $data["user_email"], PDO::PARAM_STR);
        $stmt->bindValue(":user_phoneNo", $data["user_phoneNo"], PDO::PARAM_STR);
        $stmt->bindValue(":user_password", $hashedPwd, PDO::PARAM_STR);
        $stmt->bindValue(":user_type", $data["user_type"], PDO::PARAM_STR);

        $stmt->execute();

        $data = array(
            "user_email" => $data["user_email"],
            "user_password" => $data["user_password"]
        );

        return $this->login($data);
    }

    public function login(array $data): string
    {
        $sql = "SELECT user_password 
                FROM user 
                WHERE user_email = :user_email;";

        $stmt = $this->connect()->prepare($sql);
        
        $stmt->bindValue(":user_email", $data["user_email"], PDO::PARAM_STR);
        
        $stmt->execute();
        
        $pwdHashed = $stmt->fetch(PDO::FETCH_ASSOC);
        $checkPwd = password_verify($data["user_password"], $pwdHashed["user_password"]);
        
        if ($checkPwd == false) {
            $stmt = null;
            //error hanlding for wrong password
            return "wrong password";
            
        } elseif ($checkPwd == true) {
            $sql = "SELECT * FROM user WHERE user_email = :user_email AND user_password = :user_password;";
            
            $stmt = $this->connect()->prepare($sql);
            
            $stmt->bindValue(":user_email", $data["user_email"], PDO::PARAM_STR);
            $stmt->bindValue(":user_password", $pwdHashed["user_password"], PDO::PARAM_STR);
            
            $stmt->execute();
            
            $user = $stmt->fetch(PDO::FETCH_ASSOC);
            
            return $user["user_id"];
        }
    }

    public function get(string $id): array|false
    {
        $sql = "SELECT *
                FROM user
                WHERE user_id = :user_id";

        $stmt = $this->connect()->prepare($sql);

        $stmt->bindValue(":user_id", $id, PDO::PARAM_INT);

        $stmt->execute();

        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        return $data;
    }

    public function update(array $current, array $new): int
    {
        $sql = "UPDATE user
                SET user_name = :user_name, user_surname = :user_surname, user_email = :user_email, user_phoneNo = :user_phoneNo, user_password = :user_password, user_type = :user_type
                WHERE user_id = :user_id";

        $stmt = $this->connect()->prepare($sql);

        $hashedPwd = password_hash($new["user_password"], PASSWORD_DEFAULT);

        $stmt->bindValue(":user_name", $new["user_name"] ?? $current["user_name"], PDO::PARAM_STR);
        $stmt->bindValue(":user_surname", $new["user_surname"] ?? $current["user_surname"], PDO::PARAM_STR);
        $stmt->bindValue(":user_email", $new["user_email"] ?? $current["user_email"], PDO::PARAM_STR);
        $stmt->bindValue(":user_phoneNo", $new["user_phoneNo"] ?? $current["user_phoneNo"], PDO::PARAM_STR);
        $stmt->bindValue(":user_password", $hashedPwd ?? $current["user_password"], PDO::PARAM_STR);
        $stmt->bindValue(":user_type", $new["user_type"] ?? $current["user_type"], PDO::PARAM_STR);

        $stmt->bindValue(":user_id", $current["user_id"], PDO::PARAM_INT);

        $stmt->execute();

        return $stmt->rowCount();
    }

    public function delete(string $id): int
    {
        $sql = "DELETE FROM user
                WHERE user_id = :user_id";

        $stmt = $this->connect()->prepare($sql);

        $stmt->bindValue(":user_id", $id, PDO::PARAM_INT);

        $stmt->execute();

        return $stmt->rowCount();
    }

    //checks if User exists
    public function checkUser($email)
    {
        $sql = "SELECT user_id 
                FROM user 
                WHERE user_email = :user_email";

        $stmt = $this->connect()->prepare($sql);

        $stmt->bindValue(":user_email", $email, PDO::PARAM_STR);

        $stmt->execute();

        $resultCheck = false;
        if ($stmt->rowCount() > 0) {
            $resultCheck = true;
        } else {
            $resultCheck = false;
        }
        return $resultCheck;
    }
}