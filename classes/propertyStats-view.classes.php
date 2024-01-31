<?php

class PropertyStatsView
{
    private $properties;
    private $users;

    public function __construct()
    {
        //properties
        $ch = require "initCurl.php";

        curl_setopt($ch, CURLOPT_URL, "http://localhost:80/team27-dev/API/index.php/property");

        $response = curl_exec($ch);

        curl_close($ch);

        $this->properties = json_decode($response, true);

        //users
        $ch = require "initCurl.php";

        curl_setopt($ch, CURLOPT_URL, "http://localhost:80/team27-dev/API/index.php/user");

        $response = curl_exec($ch);

        curl_close($ch);

        $this->users = json_decode($response, true);

    }

    public function showLandlords()
    {
        $result = array();
        foreach ($this->users as $landlord) {
            if ($landlord["user_type"] == "Landlord") {
                $result[] = $landlord;
            }
        }
        return $result;


    }
    public function showLandlordProperties($landlordId)
    {
        $result = array();
        foreach ($this->properties as $property) {
            if ($property["landlord_id"] == $landlordId) {
                $result[] = $property;
            }
        }
        return $result;
    }

    public function showProperty($id)
    {
        $ch = require "initCurl.php";

        curl_setopt($ch, CURLOPT_URL, "http://localhost:80/team27-dev/API/index.php/property/$id");

        $response = curl_exec($ch);

        curl_close($ch);

        return json_decode($response, true);
    }

    public function showPropertyStudent()
    {
        $property = array();
        sort($this->properties);

        foreach ($this->properties as $prop) {
            if ($prop["prop_accreditStatus"] == "Accredited")
                $property[] = $prop["prop_name"];
        }

        return $property;

    }

    public function showStudentAccomodationId()
    {
        $total = array();
        $propsCounted = array();

        foreach ($this->properties as $prop) {
            $propId = $prop["prop_id"];

            if (!in_array($propId, $propsCounted)) {
                $propsCounted[] = $propId;
                $total[$propId] = 1;
            } else {
                $total[$propId] += 1;
            }
        }

        return $total;
    }

    public function showAccreditedProps()
    {
        $total = 0;
        foreach ($this->properties as $property) {
            if ($property["prop_accreditStatus"] == "Accredited") {
                $total++;
            }
        }
        return $total;
    }

    public function showAwaitngAdminProps()
    {
        $total = 0;
        foreach ($this->properties as $property) {
            if ($property["prop_accreditStatus"] == "Verifying Documents") {
                $total++;
            }
        }
        return $total;
    }

    public function showSystemDeclinedProps()
    {
        $total = 0;
        foreach ($this->properties as $property) {
            if ($property["prop_accreditStatus"] == "Declined by System") {
                $total++;
            }
        }
        return $total;
    }

    public function showDeclinedProps()
    {
        $total = 0;
        foreach ($this->properties as $property) {
            if ($property["prop_accreditStatus"] == "Declined") {
                $total++;
            }
        }
        return $total;
    }

    public function showInspectionPendingProps()
    {
        $total = 0;
        foreach ($this->properties as $property) {
            if ($property["prop_accreditStatus"] == "Inspection") {
                $total++;
            }
        }
        return $total;
    }


}