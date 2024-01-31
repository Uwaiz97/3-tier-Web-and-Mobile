<?php

class PropertyGateway extends Dbh
{
    public function getAll(): array
    {
        $sql = "SELECT *
                FROM property";

        $stmt = $this->connect()->query($sql);

        $data = [];

        while ($row = $stmt->fetch(PDO::FETCH_ASSOC)) {

            $data[] = $row;
        }

        return $data;
    }

    public function create(array $data): string
    {
        $sql = "INSERT INTO property (prop_name, prop_address, prop_numBeds, prop_companyReg, prop_proofOwnership, prop_taxPin, prop_utilityBill, prop_liabilityCover, prop_certificateOccuppancy, prop_landUseConsent, prop_zoningPermit, prop_buildingPlans, prop_proofOfPayment, prop_accreditStatus, prop_rating, landlord_id) VALUES (:prop_name, :prop_address, :prop_numBeds, :prop_companyReg, :prop_proofOwnership, :prop_taxPin, :prop_utilityBill, :prop_liabilityCover, :prop_certificateOccuppancy, :prop_landUseConsent, :prop_zoningPermit, :prop_buildingPlans, :prop_proofOfPayment, :prop_accreditStatus, :prop_rating, :landlord_id)";

        $stmt = $this->connect()->prepare($sql);

        $stmt->bindValue(":prop_name", $data["prop_name"], PDO::PARAM_STR);
        $stmt->bindValue(":prop_address", $data["prop_address"], PDO::PARAM_STR);
        $stmt->bindValue(":prop_numBeds", $data["prop_numBeds"], PDO::PARAM_INT);
        $stmt->bindValue(":prop_companyReg", $data["prop_companyReg"], PDO::PARAM_LOB);
        $stmt->bindValue(":prop_proofOwnership", $data["prop_proofOwnership"], PDO::PARAM_LOB);
        $stmt->bindValue(":prop_taxPin", $data["prop_taxPin"], PDO::PARAM_LOB);
        $stmt->bindValue(":prop_utilityBill", $data["prop_utilityBill"], PDO::PARAM_LOB);
        $stmt->bindValue(":prop_liabilityCover", $data["prop_liabilityCover"], PDO::PARAM_LOB);
        $stmt->bindValue(":prop_certificateOccuppancy", $data["prop_certificateOccuppancy"], PDO::PARAM_LOB);
        $stmt->bindValue(":prop_landUseConsent", $data["prop_landUseConsent"], PDO::PARAM_LOB);
        $stmt->bindValue(":prop_zoningPermit", $data["prop_zoningPermit"], PDO::PARAM_LOB);
        $stmt->bindValue(":prop_buildingPlans", $data["prop_buildingPlans"], PDO::PARAM_LOB);
        $stmt->bindValue(":prop_proofOfPayment", $data["prop_proofOfPayment"], PDO::PARAM_LOB);
        $stmt->bindValue(":prop_accreditStatus", $data["prop_accreditStatus"], PDO::PARAM_STR);
        $stmt->bindValue(":prop_rating", $data["prop_rating"], PDO::PARAM_INT);
        $stmt->bindValue(":landlord_id", $data["landlord_id"], PDO::PARAM_INT);

        $stmt->execute();

        return $this->connect()->lastInsertId();
    }

    public function get(string $id): array|false
    {
        $sql = "SELECT *
                FROM property
                WHERE prop_id = :prop_id";

        $stmt = $this->connect()->prepare($sql);

        $stmt->bindValue(":prop_id", $id, PDO::PARAM_INT);

        $stmt->execute();

        $data = $stmt->fetch(PDO::FETCH_ASSOC);

        return $data;
    }

    public function update(array $current, array $new): int
    {
        $sql = "UPDATE property
                SET prop_name = :prop_name, prop_address = :prop_address, prop_numBeds = :prop_numBeds, prop_companyReg = :prop_companyReg, prop_proofOwnership = :prop_proofOwnership, prop_taxPin = :prop_taxPin, prop_utilityBill = :prop_utilityBill, prop_liabilityCover = :prop_liabilityCover, prop_certificateOccuppancy = :prop_certificateOccuppancy, prop_landUseConsent = :prop_landUseConsent, prop_zoningPermit = :prop_zoningPermit, prop_buildingPlans = :prop_buildingPlans, prop_proofOfPayment = :prop_proofOfPayment, prop_accreditStatus = :prop_accreditStatus, prop_rating = :prop_rating, landlord_id = :landlord_id
                WHERE prop_id = :prop_id";

        $stmt = $this->connect()->prepare($sql);

        $stmt->bindValue(":prop_name", $new["prop_name"] ?? $current["prop_name"], PDO::PARAM_STR);
        $stmt->bindValue(":prop_address", $new["prop_address"] ?? $current["prop_address"], PDO::PARAM_STR);
        $stmt->bindValue(":prop_numBeds", $new["prop_numBeds"] ?? $current["prop_numBeds"], PDO::PARAM_INT);
        $stmt->bindValue(":prop_companyReg", $new["prop_companyReg"] ?? $current["prop_companyReg"], PDO::PARAM_LOB);
        $stmt->bindValue(":prop_proofOwnership", $new["prop_proofOwnership"] ?? $current["prop_proofOwnership"], PDO::PARAM_LOB);
        $stmt->bindValue(":prop_taxPin", $new["prop_taxPin"] ?? $current["prop_taxPin"], PDO::PARAM_LOB);
        $stmt->bindValue(":prop_utilityBill", $new["prop_utilityBill"] ?? $current["prop_utilityBill"], PDO::PARAM_LOB);
        $stmt->bindValue(":prop_liabilityCover", $new["prop_liabilityCover"] ?? $current["prop_liabilityCover"], PDO::PARAM_LOB);
        $stmt->bindValue(":prop_certificateOccuppancy", $new["prop_certificateOccuppancy"] ?? $current["prop_certificateOccuppancy"], PDO::PARAM_LOB);
        $stmt->bindValue(":prop_landUseConsent", $new["prop_landUseConsent"] ?? $current["prop_landUseConsent"], PDO::PARAM_LOB);
        $stmt->bindValue(":prop_zoningPermit", $new["prop_zoningPermit"] ?? $current["prop_zoningPermit"], PDO::PARAM_LOB);
        $stmt->bindValue(":prop_buildingPlans", $new["prop_buildingPlans"] ?? $current["prop_buildingPlans"], PDO::PARAM_LOB);
        $stmt->bindValue(":prop_proofOfPayment", $new["prop_proofOfPayment"] ?? $current["prop_proofOfPayment"], PDO::PARAM_LOB);
        $stmt->bindValue(":prop_accreditStatus", $new["prop_accreditStatus"] ?? $current["prop_accreditStatus"], PDO::PARAM_STR);
        $stmt->bindValue(":prop_rating", $new["prop_rating"] ?? $current["prop_rating"], PDO::PARAM_INT);
        $stmt->bindValue(":landlord_id", $new["landlord_id"] ?? $current["landlord_id"], PDO::PARAM_INT);

        $stmt->bindValue(":prop_id", $current["prop_id"], PDO::PARAM_INT);

        $stmt->execute();

        return $stmt->rowCount();
    }

    public function delete(string $id): int
    {
        $sql = "DELETE FROM property
                WHERE prop_id = :prop_id";

        $stmt = $this->connect()->prepare($sql);

        $stmt->bindValue(":prop_id", $id, PDO::PARAM_INT);

        $stmt->execute();

        return $stmt->rowCount();
    }
}