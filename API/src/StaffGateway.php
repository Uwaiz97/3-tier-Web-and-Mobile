<?php

class StaffGateway extends Dbh
{
    public function getAll(): array
    {
        $sql = "SELECT *
                FROM Staff";

        $stmt = $this->connect()->query($sql);

        $data = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

            $data[] = $row;
        }

        return $data;
    }

    public function create(array $data): string
    {
        $sql = "INSERT INTO staff (staff_id,staff_type) VALUES (:staff_id, :staff_type)";

        $stmt = $this->connect()->prepare($sql);

        $stmt->bindValue(":staff_id", $data["staff_id"], PDO::PARAM_INT);
        $stmt->bindValue(":staff_type", $data["staff_type"], PDO::PARAM_STR);

        $stmt->execute();

        return $this->connect()->lastInsertId();
    }

    public function get(string $id): array|false
    {
        $sql = "SELECT *
                FROM staff
                WHERE staff_id = :staff_id";

        $stmt = $this->connect()->prepare($sql);

        $stmt->bindValue(":staff_id", $id, PDO::PARAM_INT);

        $stmt->execute();

        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        return $data;
    }

    public function update(array $current, array $new): int
    {
        $sql = "UPDATE staff
                SET staff_type = :staff_type
                WHERE staff_id = :staff_id";

        $stmt = $this->connect()->prepare($sql);

        $stmt->bindValue(":staff_type", $new["staff_type"] ?? $current["staff_type"], PDO::PARAM_STR);

        $stmt->bindValue(":staff_id", $current["staff_id"], PDO::PARAM_INT);

        $stmt->execute();

        return $stmt->rowCount();
    }

    public function delete(string $id): int
    {
        $sql = "DELETE FROM staff
                WHERE staff_id = :staff_id";

        $stmt = $this->connect()->prepare($sql);

        $stmt->bindValue(":staff_id", $id, PDO::PARAM_INT);

        $stmt->execute();

        return $stmt->rowCount();
    }
}