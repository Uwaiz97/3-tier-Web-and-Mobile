<?php

class InspectionStatsView
{
    private $inspections;
    private $staff;

    public function __construct()
    {
        //inspections
        $ch = require "initCurl.php";

        curl_setopt($ch, CURLOPT_URL, "http://localhost:80/team27-dev/API/index.php/inspection");

        $response = curl_exec($ch);

        curl_close($ch);

        $this->inspections = json_decode($response, true);

        //staffs
        $ch = require "initCurl.php";

        curl_setopt($ch, CURLOPT_URL, "http://localhost:80/team27-dev/API/index.php/staff");

        $response = curl_exec($ch);

        curl_close($ch);

        $this->staff = json_decode($response, true); 

    }

    public function showInspectors()
    {
        $result = array();
        foreach ($this->staff as $inspector) {
            if ($inspector["staff_type"] == "Co-Ordinator" || $inspector["staff_type"] == "OHS" || $inspector["staff_type"] == "Security") {
                $result[] = $inspector["staff_id"];
            }
        }
        return $result;


    }
    public function showUserInspections($userID)
    {
        $result = array();
        foreach ($this->inspections as $insp) {
            if ($insp["oca_Id"] == $userID || $insp["sec_Id"] == $userID || $insp["ohs_Id"] == $userID  ) {
                $result[] = $insp;
            }
        }
        return $result;
    }

    public function showAwaitingInspectorsCount()
    {
        $pending = 0;
    
        foreach ($this->inspections as $insp) {
            if($insp["insp_status"] == "Awaiting Inspectors")
            {
                $pending++;
            }
        }

        return $pending;
    }

    public function showCompletedInspectionsCount()
    {
        $completed = 0;
    
        foreach ($this->inspections as $insp) {
            if($insp["insp_status"] == "Inspection Complete")
            {
                $completed++;
            }
        }

        return $completed;
    }

    public function showthisCompletedInspectionsCount($inspections)
    {
        $completed = 0;
    
        foreach ($inspections as $insp) {
            if($insp["insp_status"] == "Inspection Complete")
            {
                $completed++;
            }
        }

        return $completed;
    }

    public function showUser($id)
    {
        $ch = require "initCurl.php";

        curl_setopt($ch, CURLOPT_URL, "http://localhost:80/team27-dev/API/index.php/user/$id");

        $response = curl_exec($ch);

        curl_close($ch);

        return json_decode($response, true);
    }



//     public function showStudentAccomodationId()
// {
//     $total = array();
//     $propsCounted = array();

//     foreach ($this->properties as $prop) {
//         $propId = $prop["prop_id"];

//         if (!in_array($propId, $propsCounted)) {
//             $propsCounted[] = $propId;
//             $total[$propId] = 1;  
//         } else {
//             $total[$propId] += 1;  
//         }
//     }

//     return $total;
// }


}