<?php
class AuthController {
    private $apiBaseUrl = "http://localhost/api/api.php"; // Replace with your actual backend API URL

    public function login($username, $password) {
        $data = array(
            "action" => "login",
            "username" => $username,
            "password" => $password
        );

        $response = $this->makeApiRequest($data);
        return $response;
    }

    private function makeApiRequest($data) {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, $this->apiBaseUrl);
        curl_setopt($ch, CURLOPT_POST, 1);
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));
        curl_setopt($ch, CURLOPT_HTTPHEADER, array('Content-Type: application/json'));
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        
        $response = curl_exec($ch);
        curl_close($ch);

        if ($response === false) {
            return array("success" => false, "message" => "API request failed");
        }

        return json_decode($response, true);
    }
}
?>
