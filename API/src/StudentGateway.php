<?php

class StudentGateway extends Dbh
{
    public function getAll(): array
    {
        $sql = "SELECT *
                FROM student";

        $stmt = $this->connect()->query($sql);

        $data = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

            $row["student_blaclistStatus"] = (bool) $row["student_blaclistStatus"];
            $data[] = $row;
        }

        return $data;
    }

    public function create(array $data): string
    {
        $sql = "INSERT INTO student (student_id, student_roomNo, student_number, student_approved, student_blaclistStatus, prop_id) VALUES (:student_id, :student_roomNo, :student_number, :student_approved, :student_blaclistStatus, :prop_id)";

        $stmt = $this->connect()->prepare($sql);

        $stmt->bindValue(":student_id", $data["student_id"], PDO::PARAM_INT);
        $stmt->bindValue(":student_roomNo", $data["student_roomNo"], PDO::PARAM_INT);
        $stmt->bindValue(":student_number", $data["student_number"], PDO::PARAM_STR);
        $stmt->bindValue(":student_approved", $data["student_approved"], PDO::PARAM_STR);
        $stmt->bindValue(":student_blaclistStatus", (bool) ($data["student_blaclistStatus"] ?? false), PDO::PARAM_BOOL);
        $stmt->bindValue(":prop_id", $data["prop_id"], PDO::PARAM_INT);

        $stmt->execute();

        return $this->connect()->lastInsertId();
    }

    public function get(string $id): array|false
    {
        $sql = "SELECT *
                FROM student
                WHERE student_id = :student_id";

        $stmt = $this->connect()->prepare($sql);

        $stmt->bindValue(":student_id", $id, PDO::PARAM_INT);

        $stmt->execute();

        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($data !== false) {
            $data["student_blaclistStatus"] = (bool) $data["student_blaclistStatus"];
        }

        return $data;
    }

    public function update(array $current, array $new): int
    {
        $sql = "UPDATE student
                SET student_roomNo = :student_roomNo, student_number = :student_number, student_approved = :student_approved, student_blaclistStatus = :student_blaclistStatus, prop_id = :prop_id
                WHERE student_id = :student_id";


        $stmt = $this->connect()->prepare($sql);

        $stmt->bindValue(":student_roomNo", $new["student_roomNo"] ?? $current["student_roomNo"], PDO::PARAM_INT);
        $stmt->bindValue(":student_number", $new["student_number"] ?? $current["student_number"], PDO::PARAM_STR);
        $stmt->bindValue(":student_approved", $new["student_approved"] ?? $current["student_approved"], PDO::PARAM_STR);
        $stmt->bindValue(":student_blaclistStatus", $new["student_blaclistStatus"] ?? $current["student_blaclistStatus"], PDO::PARAM_BOOL);
        $stmt->bindValue(":prop_id", $new["prop_id"] ?? $current["prop_id"], PDO::PARAM_INT);

        $stmt->bindValue(":student_id", $current["student_id"], PDO::PARAM_INT);

        $stmt->execute();

        return $stmt->rowCount();
    }

    public function delete(string $id): int
    {
        $sql = "DELETE FROM student
                WHERE student_id = :student_id";

        $stmt = $this->connect()->prepare($sql);

        $stmt->bindValue(":student_id", $id, PDO::PARAM_INT);

        $stmt->execute();

        return $stmt->rowCount();
    }
}