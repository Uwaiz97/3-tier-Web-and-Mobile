<?php

class Application extends Dbh
{
    //Creates Property
    protected function createProperty($name, $address, $numBeds, $companyRegister, $proofOwnership, $taxPin, $utilityBill, $liabilityCover, $certificateOccupancy, $landUseConsent, $zoningPermit, $buildingPlans, $proofOfPayment, $landlordId)
    {
        $stmt = $this->connect()->prepare('INSERT INTO property (prop_name, prop_address, prop_numBeds, prop_companyReg, prop_proofOwnership, prop_taxPin, prop_utilityBill, prop_liabilityCover, prop_certificateOccuppancy, prop_landUseConsent, prop_zoningPermit, prop_buildingPlans, prop_proofOfPayment, prop_accreditStatus, prop_rating, prop_accreditLetter, landlord_id) VALUES (?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?);');

        if (!$stmt->execute(array($name, $address, $numBeds, $companyRegister, $proofOwnership, $taxPin, $utilityBill, $liabilityCover, $certificateOccupancy, $landUseConsent, $zoningPermit, $buildingPlans, $proofOfPayment, "Verifying Documents", 0, null, $landlordId))) {
            $stmt = null;
            header("location: ../index.php?error=stmtfailed");
            exit();
        }

        $stmt = null;
    }

    //Gets property by landlord to view
    protected function getProperty($landlordid)
    {
        $stmt = $this->connect()->prepare('SELECT * FROM property WHERE landlord_id = ?;');

        if (!$stmt->execute(array($landlordid))) {
            $stmt = null;
            header("location: ../index.php?error=stmtfailed");
            exit();
        }

        if ($stmt->rowCount() == 0) {
            $stmt = null;
            $_SESSION['error'] = "No application!";
            header("location: landlordHome.php");
            exit();
        }

        $property = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $property;
    }

    //Gets property by landlord to view
    protected function getLandlord($landlordid)
    {
        $stmt = $this->connect()->prepare('SELECT * FROM user WHERE user_id = ?;');

        if (!$stmt->execute(array($landlordid))) {
            $stmt = null;
            header("location: ../index.php?error=stmtfailed");
            exit();
        }

        if ($stmt->rowCount() == 0) {
            $stmt = null;
            header("location: ../index.php?error=usernotfound");
            exit();
        }

        $landlord = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $landlord;
    }

    //Gets property by landlord to view
    protected function getSingleProperty($propid)
    {
        $stmt = $this->connect()->prepare('SELECT * FROM property WHERE prop_id = ?;');

        if (!$stmt->execute(array($propid))) {
            $stmt = null;
            header("location: ../index.php?error=stmtfailed");
            exit();
        }

        if ($stmt->rowCount() == 0) {
            $stmt = null;
            header("location: ../index.php?error=usernotfound");
            exit();
        }

        $property = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $property;
    }

    protected function getDocPendingProperty()
    {
        $stmt = $this->connect()->query('SELECT * FROM property WHERE prop_accreditStatus = "Verifying Documents";');

        $property = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $property;
    }

    protected function getAllProperties()
    {
        $stmt = $this->connect()->query('SELECT * FROM property;');

        $property = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $property;
    }

    //Gets Lanldord Id to use in createProperty function
    protected function getLandlordId($userid)
    {
        $stmt = $this->connect()->prepare('SELECT * FROM landlord WHERE landlord_id = ?;');

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

        $landlord = $stmt->fetchAll(PDO::FETCH_ASSOC);

        return $landlord[0]["landlord_id"];
    }
    protected function updateToInspection($propid)
    {
        $stmt = $this->connect()->prepare('UPDATE property SET prop_accreditStatus = "Inspection" WHERE prop_id = ?;');

        if (!$stmt->execute(array($propid))) {
            $stmt = null;
            header("location: ../index.php?error=stmtfailed");
            exit();
        }

        if ($stmt->rowCount() == 0) {
            $stmt = null;
            header("location: ../aboutApplication.php?propid=" . $propid . "&error=propertynotfound");
            exit();
        }
    }

    protected function updateToDecline($propid, $declineComment)
    {
        $stmt = $this->connect()->prepare('UPDATE property SET prop_accreditStatus = "Declined Application", prop_declineComment = ? WHERE prop_id = ?;');

        if (!$stmt->execute(array($declineComment, $propid))) {
            $stmt = null;
            header("location: ../index.php?error=stmtfailed");
            exit();
        }

        if ($stmt->rowCount() == 0) {
            $stmt = null;
            header("location: ../aboutApplication.php?propid=" . $propid . "&error=propertynotfound");
            exit();
        }
    }

    protected function getStaffType($userid)
    {
        $stmt = $this->connect()->prepare('SELECT * FROM staff WHERE staff_id = ?;');

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
        return $staff[0]["staff_type"];
    }

    //to populate inspection handler
    protected function getOCAInspPendingProperty()
    {
        $stmt = $this->connect()->query('SELECT * FROM inspection WHERE oca_id IS NOT NULL;');
        $inspections = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $properties = [];
        if (!($stmt->rowCount() == 0)) {
            foreach ($inspections as $inspection) {
                $properties[] = $inspection["prop_id"];
            }
        }
        $stmt = null;

        if (empty($properties)) {

            $stmt = $this->connect()->prepare("SELECT * FROM property WHERE prop_accreditStatus = 'Inspection';");

            $stmt->execute($properties);
            $property = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $stmt = null;

            return $property;
        } else {
            $proIds = implode(',', array_fill(0, count($properties), '?'));

            $stmt = $this->connect()->prepare("SELECT * FROM property WHERE prop_accreditStatus = 'Inspection' AND prop_id NOT IN ($proIds);");

            $stmt->execute($properties);
            $property = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $stmt = null;

            return $property;
        }
    }

    //to populate inspection handler
    protected function getOHSInspPendingProperty()
    {
        $stmt = $this->connect()->query('SELECT * FROM inspection WHERE ohs_id IS NOT NULL;');

        $inspections = $stmt->fetchAll(PDO::FETCH_ASSOC);
        $stmt = null;

        $properties = [];
        foreach ($inspections as $inspection) {
            $properties[] = $inspection["prop_id"];
        }

        if (empty($properties)) {

            $stmt = $this->connect()->prepare("SELECT * FROM property WHERE prop_accreditStatus = 'Inspection';");

            $stmt->execute($properties);
            $property = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $stmt = null;

            return $property;
        } else {
            $proIds = implode(',', array_fill(0, count($properties), '?'));

            $stmt = $this->connect()->prepare("SELECT * FROM property WHERE prop_accreditStatus = 'Inspection' AND prop_id NOT IN ($proIds);");

            $stmt->execute($properties);
            $property = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $stmt = null;

            return $property;
        }
    }

    //to populate inspection handler
    protected function getSecInspPendingProperty()
    {
        $stmt = $this->connect()->query('SELECT * FROM inspection WHERE sec_id IS NOT NULL;');
        $inspections = $stmt->fetchAll(PDO::FETCH_ASSOC);

        $properties = [];
        if (!($stmt->rowCount() == 0)) {
            foreach ($inspections as $inspection) {
                $properties[] = $inspection["prop_id"];
            }
        }

        $stmt = null;

        if (empty($properties)) {

            $stmt = $this->connect()->prepare("SELECT * FROM property WHERE prop_accreditStatus = 'Inspection';");

            $stmt->execute($properties);
            $property = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $stmt = null;

            return $property;
        } else {
            $proIds = implode(',', array_fill(0, count($properties), '?'));

            $stmt = $this->connect()->prepare("SELECT * FROM property WHERE prop_accreditStatus = 'Inspection' AND prop_id NOT IN ($proIds);");

            $stmt->execute($properties);
            $property = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $stmt = null;

            return $property;
        }
    }

    //Gets Properties based on userId in Inspection table
    protected function getInspectorInspections($userid)
    {
        $staffType = $this->getStaffType($userid);

        if ($staffType == "Co-Ordinator") {
            $stmt = $this->connect()->prepare('SELECT * FROM inspection WHERE oca_id = ?;');
        } elseif ($staffType == "OHS") {
            $stmt = $this->connect()->prepare('SELECT * FROM inspection WHERE ohs_id = ?;');
        } elseif ($staffType == "Security") {
            $stmt = $this->connect()->prepare('SELECT * FROM inspection WHERE sec_id = ?;');
        }

        if (!$stmt->execute(array($userid))) {
            $stmt = null;
            header("location: ../index.php?error=stmtfailed");
            exit();
        }

        $properties = [];
        $inspections = $stmt->fetchAll(PDO::FETCH_ASSOC);
        foreach ($inspections as $inspection) {
            $properties[] = $inspection["prop_id"];
        }

        if (empty($properties)) {
            return [];
        } else {
            $propIds = implode(',', array_fill(0, count($properties), '?'));

            $stmt = $this->connect()->prepare("SELECT * FROM property WHERE prop_accreditStatus = 'Inspection' AND prop_id IN ($propIds);");

            $stmt->execute($properties);
            $property = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $stmt = null;

            return $property;
        }
    }
}