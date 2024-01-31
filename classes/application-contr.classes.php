<?php
session_start();

class ApplicationContr
{
    //Properties of class
    private $name;
    private $address;
    private $numBeds;
    private $companyRegister;
    private $proofOwnership;
    private $taxPin;
    private $utilityBill;
    private $liabilityCover;
    private $certificateOccupancy;
    private $landUseConsent;
    private $zoningPermit;
    private $buildingPlans;
    private $proofOfPayment;
    private $landlord_id;
    private $user_id;

    //Constructor
    public function __construct($name, $address, $numBeds, $companyRegister, $proofOwnership, $taxPin, $utilityBill, $liabilityCover, $certificateOccupancy, $landUseConsent, $zoningPermit, $buildingPlans, $proofOfPayment)
    {
        $this->name = $name;
        $this->address = $address;
        $this->numBeds = $numBeds;
        $this->companyRegister = $companyRegister;
        $this->proofOwnership = $proofOwnership;
        $this->taxPin = $taxPin;
        $this->utilityBill = $utilityBill;
        $this->liabilityCover = $liabilityCover;
        $this->certificateOccupancy = $certificateOccupancy;
        $this->landUseConsent = $landUseConsent;
        $this->zoningPermit = $zoningPermit;
        $this->buildingPlans = $buildingPlans;
        $this->proofOfPayment = $proofOfPayment;
    }

    public function applyForAccrediton()
    {
        //Error Handling
        if (!$this->emptyInput() == false) {
            $_SESSION['error'] = "Please provide all the fields!";
            header("location: ../applicationPage.php");
            exit();
        }

        $this->user_id = $_SESSION["userId"];
        $this->landlord_id = $this->getLandlordId($this->user_id);

        //Creates if no errors
        $this->createProperty();
        $_SESSION['success'] = "You have successfully submitted your application,<a href='viewApplicationStatusPage.php' >View Application Status</a>";
    }

    //Error Handling
    public function emptyInput()
    {
        $result = false;
        if (empty($this->name) || empty($this->address) || empty($this->numBeds) || empty($this->companyRegister) || empty($this->proofOwnership) || empty($this->taxPin) || empty($this->utilityBill) || empty($this->liabilityCover) || empty($this->certificateOccupancy) || empty($this->landUseConsent) || empty($this->zoningPermit) || empty($this->buildingPlans) || empty($this->proofOfPayment)) {
            $result = true;
        } else {
            $result = false;
        }
        return $result;
    }
    
    protected function getLandlordId($id)
    {
        $ch = require "../initCurl.php";
        
        curl_setopt($ch, CURLOPT_URL, "http://localhost:80/team27-dev/API/index.php/landlord/$id");
        
        $response = curl_exec($ch);
        
        curl_close($ch);
        
        $landlord = json_decode($response, true);

        return $landlord["landlord_id"];
    }

    protected function createProperty()
    {
        $data = array(
            "prop_name" => $this->name,
            "prop_address" => $this->address,
            "prop_numBeds" => $this->numBeds,
            "prop_companyReg" =>$this->companyRegister,
            "prop_proofOwnership" =>$this->proofOwnership,
            "prop_taxPin" =>$this->taxPin,
            "prop_utilityBill" => $this->utilityBill,
            "prop_liabilityCover" => $this->liabilityCover,
            "prop_certificateOccuppancy" => $this->certificateOccupancy,
            "prop_landUseConsent" =>$this->landUseConsent,
            "prop_zoningPermit" =>$this->zoningPermit,
            "prop_buildingPlans" =>$this->buildingPlans,
            "prop_proofOfPayment" => $this->proofOfPayment,
            "prop_accreditStatus" => "Verifying Documents",
            "prop_rating" => 0,
            "landlord_id" =>$this->landlord_id
        );
        
        //Registers if no errors
        $ch = require "../initCurl.php";

        curl_setopt($ch, CURLOPT_URL, "http://localhost:80/team27-dev/API/index.php/property");
        curl_setopt($ch, CURLOPT_POST, true);
        //curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, json_encode($data));

        $response = curl_exec($ch);

        $statusCode = curl_getinfo($ch, CURLINFO_RESPONSE_CODE);

        curl_close($ch);

        //Logss if no errors
        $data = json_decode($response, true);

        if ($statusCode === 422) {

            echo "Invalid data: ";
            print_r($data["errors"]);
            exit;
        }

        if ($statusCode !== 201) {

            echo "Unexpected status code: $statusCode";
            var_dump($data);
            exit;
        }
    }
}