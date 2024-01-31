<?php

class QueryStatsView
{

    private $queries;

    public function __construct()
    {
        $ch = require "initCurl.php";

        curl_setopt($ch, CURLOPT_URL, "http://localhost:80/team27-dev/API/index.php/maintenancequery");

        $response = curl_exec($ch);

        curl_close($ch);

        $this->queries = json_decode($response, true);
    }



    public function showUnresolvedQueries($propId)
    {
        $result = array();
        foreach ($this->queries as $query) {
            if ($query["prop_id"] == $propId && $query["query_status"] == "Unresolved") {
                $result[] = $query;
            }
        }
        return $result;
    }


    public function showQuery($id)
    {
        $ch = require "initCurl.php";

        curl_setopt($ch, CURLOPT_URL, "http://localhost:80/team27-dev/API/index.php/maintenancequery/$id");

        $response = curl_exec($ch);

        curl_close($ch);

        return json_decode($response, true);
    }


    public function showUnescalatedQueries()
    {
        $total = array();
        $propsCounted = array();

        foreach ($this->queries as $query) {
            $propId = $query["prop_id"];
            if ($query["query_status"] == "unresolved" || $query["query_status"] == "Unconfirmed Resolved") {

                if (!in_array($propId, $propsCounted)) {
                    $propsCounted[] = $propId;
                    sort($propsCounted);
                    $total[$propId] = 1;
                } else {
                    $total[$propId] += 1;
                }
            }
        }

        return $total;
    }
    public function showEscalatedQueries()
    {
       $total = array();
        $propsCounted = array();

        foreach ($this->queries as $query) {
            $propId = $query["prop_id"];
            if ($query["query_status"] == "Escalated") {
                
                if (!in_array($propId, $propsCounted)) {
                    $propsCounted[] = $propId;
                    sort($propsCounted);
                    $total[$propId] = 1;
                } else {
                    $total[$propId] += 1;
                }
            }
        }

        return $total;
    }

    public function showAverageQueries()
    {
       $total = array();
        $propsCounted = array();

        foreach ($this->queries as $query) {
            $propId = $query["prop_id"];
                
                if (!in_array($propId, $propsCounted)) {
                    $propsCounted[] = $propId;
                    sort($propsCounted);
                    $total[$propId] = 1;
                } else {
                    $total[$propId] += 1;
                }
            
        }

        return $total;
    }




}