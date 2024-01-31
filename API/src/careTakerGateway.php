<?php

class CareTakerGateway extends Dbh
{
    public function getAll(): array
    {
        $sql = "SELECT *
                FROM careTaker";

        $stmt = $this->connect()->query($sql);

        $data = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

            $data[] = $row;
        }

        return $data;
    }

    public function create(array $data): string
    {
        $sql = "INSERT INTO caretaker (ct_id,prop_id) VALUES (:ct_id, :prop_id)";

        $stmt = $this->connect()->prepare($sql);


        $stmt->bindValue(":ct_id", $data["ct_id"], PDO::PARAM_INT);
        $stmt->bindValue(":prop_id", $data["prop_id"], PDO::PARAM_INT);

        $stmt->execute();


        return $this->connect()->lastInsertId();
    }

    public function get(string $id): array|false
    {
        $sql = "SELECT *
                FROM caretaker
                WHERE ct_id = :ct_id";

        $stmt = $this->connect()->prepare($sql);

        $stmt->bindValue(":ct_id", $id, PDO::PARAM_INT);

        $stmt->execute();

        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        return $data;
    }

    public function update(array $current, array $new): int
    {
        $sql = "UPDATE caretaker
                SET  = prop_id= :prop_id, 
                WHERE ct_id = :ct_id";

        $stmt = $this->connect()->prepare($sql);;

        $stmt->bindValue(":prop_id", $new["prop_id"] ?? $current["prop_id"], PDO::PARAM_INT);

        $stmt->bindValue(":ct_id", $current["ct_id"], PDO::PARAM_INT);

        $stmt->execute();

        return $stmt->rowCount();
    }

    public function delete(string $id): int
    {
        $sql = "DELETE FROM caretaker
                WHERE ct_id = :ct_id";

        $stmt = $this->connect()->prepare($sql);

        $stmt->bindValue(":ct_id", $id, PDO::PARAM_INT);

        $stmt->execute();

        return $stmt->rowCount();
    }

}