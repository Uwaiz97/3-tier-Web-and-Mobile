<?php

class ReportsGateway extends Dbh
{
    public function getAll(): array
    {
        $sql = "SELECT *
                FROM reports";

        $stmt = $this->connect()->query($sql);

        $data = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

            $row["report_reporterStudent"] = (bool) $row["report_reporterStudent"];
            $data[] = $row;
        }

        return $data;
    }

    public function create(array $data): string
    {
        $sql = "INSERT INTO reports (report_reporterStudent, report_title, report_description, report_status, report_date, landlord_id, student_id) VALUES (:report_reporterStudent, :report_title, :report_description, :report_status, :report_date, :landlord_id, :student_id)";

        $stmt = $this->connect()->prepare($sql);

        $stmt->bindValue(":report_reporterStudent", (bool) ($data["report_reporterStudent"] ?? false), PDO::PARAM_BOOL);
        $stmt->bindValue(":report_title", $data["report_title"], PDO::PARAM_STR);
        $stmt->bindValue(":report_description", $data["report_description"], PDO::PARAM_STR);
        $stmt->bindValue(":report_status", $data["report_status"], PDO::PARAM_STR);
        $stmt->bindValue(":report_date", $data["report_date"], PDO::PARAM_STR);
        $stmt->bindValue(":landlord_id", $data["landlord_id"], PDO::PARAM_INT);
        $stmt->bindValue(":student_id", $data["student_id"], PDO::PARAM_INT);

        $stmt->execute();

        return $this->connect()->lastInsertId();
    }

    public function get(string $id): array|false
    {
        $sql = "SELECT *
                FROM reports
                WHERE report_id = :report_id";

        $stmt = $this->connect()->prepare($sql);

        $stmt->bindValue(":report_id", $id, PDO::PARAM_INT);

        $stmt->execute();

        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        if ($data !== false) {
            $data["report_reporterStudent"] = (bool) $data["report_reporterStudent"];
        }

        return $data;
    }

    public function update(array $current, array $new): int
    {
        $sql = "UPDATE reports
                SET report_reporterStudent = :report_reporterStudent, report_title = :report_title, report_description = :report_description, report_status = :report_status, landlord_id = :landlord_id, student_id = :student_id
                WHERE report_id = :report_id";

        $stmt = $this->connect()->prepare($sql);

        $stmt->bindValue(":report_reporterStudent", $new["report_reporterStudent"] ?? $current["report_reporterStudent"], PDO::PARAM_BOOL);
        $stmt->bindValue(":report_title", $new["report_title"] ?? $current["report_title"], PDO::PARAM_STR);
        $stmt->bindValue(":report_description", $new["report_description"] ?? $current["report_description"], PDO::PARAM_STR);
        $stmt->bindValue(":report_status", $new["report_status"] ?? $current["report_status"], PDO::PARAM_STR);
        $stmt->bindValue(":landlord_id", $new["landlord_id"] ?? $current["landlord_id"], PDO::PARAM_INT);
        $stmt->bindValue(":student_id", $new["student_id"] ?? $current["student_id"], PDO::PARAM_INT);


        $stmt->bindValue(":report_id", $current["report_id"], PDO::PARAM_INT);

        $stmt->execute();

        return $stmt->rowCount();
    }

    public function delete(string $id): int
    {
        $sql = "DELETE FROM reports
                WHERE report_id = :report_id";

        $stmt = $this->connect()->prepare($sql);

        $stmt->bindValue(":report_id", $id, PDO::PARAM_INT);

        $stmt->execute();

        return $stmt->rowCount();
    }
}