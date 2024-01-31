<?php

class MaintenanceQueryGateway extends Dbh
{
    public function getAll(): array
    {
        $sql = "SELECT *
                FROM maintenancequery";

        $stmt = $this->connect()->query($sql);

        $data = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {
            $data[] = $row;
        }

        return $data;
    }

    public function create(array $data): string
    {
        $sql = "INSERT INTO maintenancequery (query_date, query_title, query_priorityLvl, query_description, query_image, query_status, student_id, prop_id) VALUES (:query_date, :query_title, :query_priorityLvl, :query_description, :query_image, :query_status, :student_id, :prop_id)";

        $stmt = $this->connect()->prepare($sql);

        $stmt->bindValue(":query_date", $data["query_date"], PDO::PARAM_STR);
        $stmt->bindValue(":query_title", $data["query_title"], PDO::PARAM_STR);
        $stmt->bindValue(":query_priorityLvl", $data["query_priorityLvl"], PDO::PARAM_INT);
        $stmt->bindValue(":query_description", $data["query_description"], PDO::PARAM_STR);
        $stmt->bindValue(":query_image", ($data["query_image"] ?? null), PDO::PARAM_LOB);
        $stmt->bindValue(":query_status", $data["query_status"], PDO::PARAM_STR);
        $stmt->bindValue(":student_id", $data["student_id"], PDO::PARAM_INT);
        $stmt->bindValue(":prop_id", $data["prop_id"], PDO::PARAM_INT);

        $stmt->execute();

        return $this->connect()->lastInsertId();
    }

    public function get(string $id): array|false
    {
        $sql = "SELECT *
                FROM maintenancequery
                WHERE query_id = :query_id";

        $stmt = $this->connect()->prepare($sql);

        $stmt->bindValue(":query_id", $id, PDO::PARAM_INT);

        $stmt->execute();

        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        return $data;
    }

    public function update(array $current, array $new): int
    {
        $sql = "UPDATE maintenancequery
                SET query_date = :query_date, query_title = :query_title, query_priorityLvl = :query_priorityLvl, query_description = :query_description, query_image = :query_image, query_status = :query_status, student_id = :student_id, prop_id = :prop_id
                WHERE query_id = :query_id";

        $stmt = $this->connect()->prepare($sql);

        $stmt->bindValue(":query_date", $new["query_date"] ?? $current["query_date"], PDO::PARAM_STR);
        $stmt->bindValue(":query_title", $new["query_title"] ?? $current["query_title"], PDO::PARAM_STR);
        $stmt->bindValue(":query_priorityLvl", $new["query_priorityLvl"] ?? $current["query_priorityLvl"], PDO::PARAM_INT);
        $stmt->bindValue(":query_description", $new["query_description"] ?? $current["query_description"], PDO::PARAM_STR);
        $stmt->bindValue(":query_image", $new["query_image"] ?? $current["query_image"], PDO::PARAM_STR);
        $stmt->bindValue(":query_status", $new["query_status"] ?? $current["query_status"], PDO::PARAM_STR);
        $stmt->bindValue(":student_id", $new["student_id"] ?? $current["student_id"], PDO::PARAM_INT);
        $stmt->bindValue(":prop_id", $new["prop_id"] ?? $current["prop_id"], PDO::PARAM_INT);


        $stmt->bindValue(":query_id", $current["query_id"], PDO::PARAM_INT);

        $stmt->execute();

        return $stmt->rowCount();
    }

    public function delete(string $id): int
    {
        $sql = "DELETE FROM maintenancequery
                WHERE query_id = :query_id";

        $stmt = $this->connect()->prepare($sql);

        $stmt->bindValue(":query_id", $id, PDO::PARAM_INT);

        $stmt->execute();

        return $stmt->rowCount();
    }
}