<?php

class LandlordGateway extends Dbh
{
    public function getAll(): array
    {
        $sql = "SELECT *
                FROM landlord";

        $stmt = $this->connect()->query($sql);

        $data = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

            $row["landlord_blaclistStatus"] = (bool) $row["landlord_blaclistStatus"];
            $data[] = $row;
        }

        return $data;
    }

    public function create(array $data): string
    {
        $sql = "INSERT INTO landlord (landlord_id, landlord_blaclistStatus) VALUES (:landlord_id, :landlord_blaclistStatus)";

        $stmt = $this->connect()->prepare($sql);

        $stmt->bindValue(":landlord_id", $data["landlord_id"], PDO::PARAM_INT);
        $stmt->bindValue(":landlord_blaclistStatus", (bool) ($data["landlord_blaclistStatus"] ?? false), PDO::PARAM_BOOL);

        $stmt->execute();

        return $this->connect()->lastInsertId();
    }

    public function get(string $id): array|false
    {
        $sql = "SELECT *
                FROM landlord
                WHERE landlord_id = :landlord_id";

        $stmt = $this->connect()->prepare($sql);

        $stmt->bindValue(":landlord_id", $id, PDO::PARAM_INT);

        $stmt->execute();

        $data = $stmt->fetch(PDO::FETCH_ASSOC);
        
        if ($data !== false) {
            $data["landlord_blaclistStatus"] = (bool) $data["landlord_blaclistStatus"];
        }

        return $data;
    }

    public function update(array $current, array $new): int
    {
        $sql = "UPDATE landlord
                SET landlord_blaclistStatus = :landlord_blaclistStatus
                WHERE landlord_id = :landlord_id";

        $stmt = $this->connect()->prepare($sql);

        $stmt->bindValue(":landlord_blaclistStatus", $new["landlord_blaclistStatus"] ?? $current["landlord_blaclistStatus"], PDO::PARAM_BOOL);


        $stmt->bindValue(":landlord_id", $current["landlord_id"], PDO::PARAM_INT);

        $stmt->execute();

        return $stmt->rowCount();
    }

    public function delete(string $id): int
    {
        $sql = "DELETE FROM landlord
                WHERE landlord_id = :landlord_id";

        $stmt = $this->connect()->prepare($sql);

        $stmt->bindValue(":landlord_id", $id, PDO::PARAM_INT);

        $stmt->execute();

        return $stmt->rowCount();
    }
}