<?php

$headers = [
    
];

$ch = curl_init();

curl_setopt_array($ch, [
    //CURLOPT_HTTPHEADER => $headers,
    CURLOPT_RETURNTRANSFER => true
]);

return $ch;