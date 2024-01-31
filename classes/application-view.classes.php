<?php

class ApplicationView
{
    private $properties;
    private $inspections;

    public function __construct()
    {
        $ch = require "initCurl.php";

        curl_setopt($ch, CURLOPT_URL, "http://localhost:80/team27-dev/API/index.php/property");

        $response = curl_exec($ch);

        curl_close($ch);

        $this->properties = json_decode($response, true);

        //inspections
        curl_setopt($ch, CURLOPT_URL, "http://localhost:80/team27-dev/API/index.php/inspection");

        $response = curl_exec($ch);

        curl_close($ch);

        $this->inspections = json_decode($response, true);
    }

    public function GetInspections()
    {
        return $this->inspections;
    }

    public function showProperty($landlordId)
    {
        $result = array();
        foreach ($this->properties as $property) {
            if ($property["landlord_id"] == $landlordId) {
                $result[] = $property;
            }
        }
        return $result;
    }

    public function showSingleProperty($id)
    {
        $ch = require "initCurl.php";

        curl_setopt($ch, CURLOPT_URL, "http://localhost:80/team27-dev/API/index.php/property/$id");

        $response = curl_exec($ch);

        curl_close($ch);

        return json_decode($response, true);
    }

    public function showAllProperties()
    {
        $result = array();
        foreach ($this->properties as $property) {
            if ($property["prop_accreditStatus"] == "Accredited" || $property["prop_accreditStatus"] == "Declined by System" || $property["prop_accreditStatus"] == "De-Accredited") {
                $result[] = $property;
            }
        }
        return $result;
    }

    public function showDocPendingProperty()
    {
        $result = array();
        foreach ($this->properties as $property) {
            if ($property["prop_accreditStatus"] == "Verifying Documents") {
                $result[] = $property;
            }
        }
        return $result;
    }

    public function showAccreditProperty()
    {
        $result = array();
        foreach ($this->properties as $property) {
            if ($property["prop_accreditStatus"] == "Accredited") {
                $result[] = $property;
            }
        }
        return $result;
    }

    public function showLandlord($id)
    {
        $ch = require "initCurl.php";

        curl_setopt($ch, CURLOPT_URL, "http://localhost:80/team27-dev/API/index.php/user/$id");

        $response = curl_exec($ch);

        curl_close($ch);

        return json_decode($response, true);
    }


    public function showStaffType($userid)
    {
        $ch = require "initCurl.php";

        curl_setopt($ch, CURLOPT_URL, "http://localhost:80/team27-dev/API/index.php/staff/$userid");

        $response = curl_exec($ch);

        curl_close($ch);

        $staff = json_decode($response, true);

        return $staff["staff_type"];
    }

    public function showOCAInspPendingProperty($userId)
    {
        $result = array();
        foreach ($this->inspections as $inspection) {
            if ($inspection["oca_Id"] == $userId) {
                foreach ($this->properties as $property) {
                    if ($property["prop_id"] == $inspection["prop_id"]) {
                        $result[] = $property;
                    }
                }
            }
        }
        return $result;
    }

    public function showOHSInspPendingProperty($userId)
    {
        $result = array();
        foreach ($this->inspections as $inspection) {
            if ($inspection["ohs_Id"] == $userId) {
                foreach ($this->properties as $property) {
                    if ($property["prop_id"] == $inspection["prop_id"]) {
                        $result[] = $property;
                    }
                }
            }
        }
        return $result;
    }

    public function showSecInspPendingProperty($userId)
    {
        $result = array();
        foreach ($this->inspections as $inspection) {
            if ($inspection["sec_Id"] == $userId) {
                foreach ($this->properties as $property) {
                    if ($property["prop_id"] == $inspection["prop_id"]) {
                        $result[] = $property;
                    }
                }
            }
        }
        return $result;
    }

    public function getSecProperties()
    {
        $result = array();
        $inspPropIds = array();
        foreach ($this->inspections as $inspection) {
            if ($inspection["sec_Id"] == null) {
                $inspPropIds[] = $inspection["prop_id"];
            }
        }

        foreach ($this->properties as $property) {
            if (in_array($property["prop_id"], $inspPropIds)) {
                $result[] = $property;
            }
        }

        return $result;
    }

    public function getOCAProperties()
    {
        $result = array();
        $inspPropIds = array();
        foreach ($this->inspections as $inspection) {
            if ($inspection["oca_Id"] == null) {
                $inspPropIds[] = $inspection["prop_id"];
            }
        }

        foreach ($this->properties as $property) {
            if (in_array($property["prop_id"], $inspPropIds)) {
                $result[] = $property;
            }
        }

        return $result;
    }

    public function getOHSProperties()
    {
        $result = array();
        $inspPropIds = array();
        foreach ($this->inspections as $inspection) {
            if ($inspection["ohs_Id"] == null) {
                $inspPropIds[] = $inspection["prop_id"];
            }
        }

        foreach ($this->properties as $property) {
            if (in_array($property["prop_id"], $inspPropIds)) {
                $result[] = $property;
            }
        }

        return $result;
    }
}