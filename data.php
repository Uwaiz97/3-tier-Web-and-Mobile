<?php
include "classes/propertyStats-view.classes.php";

$stats = new PropertyStatsView();

if(isset($_POST["submit_data"])){
    $propNames = $stats->showLandlordProperties($_POST["landlord"]);

    $data = array();

    foreach($propNames as $row)
    {
        $data[] = array(
            'language' => $row["prop_name"],
            'total'     => '10',
            'color'     => '#' . rand(100000, 999999) . ''
        );
    }

    echo json_encode($data);
}
?>
