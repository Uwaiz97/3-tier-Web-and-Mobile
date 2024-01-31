<?php

class PropertyController
{
    public function __construct(private PropertyGateway $gateway)
    {
    }

    public function processRequest(string $method, ?string $id): void
    {
        if ($id) {

            $this->processResourceRequest($method, $id);
        } else {

            $this->processCollectionRequest($method);
        }
    }

    private function processResourceRequest(string $method, string $id): void
    {
        $property = $this->gateway->get($id);

        if (!$property) {
            http_response_code(404);
            echo json_encode(["message" => "Property not found"]);
            return;
        }

        switch ($method) {
            case "GET":
                echo json_encode($property);
                break;

            case "PATCH":
                $data = (array) json_decode(file_get_contents("php://input"), true);

                $errors = $this->getValidationErrors($data, false);

                if (!empty($errors)) {
                    http_response_code(422);
                    echo json_encode(["errors" => $errors]);
                    break;
                }

                $rows = $this->gateway->update($property, $data);

                echo json_encode([
                    "message" => "Property $id updated",
                    "rows" => $rows
                ]);
                break;

            case "DELETE":
                $rows = $this->gateway->delete($id);

                echo json_encode([
                    "message" => "Property $id deleted",
                    "rows" => $rows
                ]);
                break;

            default:
                http_response_code(405);
                header("Allow: GET, PATCH, DELETE");
        }
    }

    private function processCollectionRequest(string $method): void
    {
        switch ($method) {
            case "GET":
                echo json_encode($this->gateway->getAll());
                break;

            case "POST":
                $data = (array) json_decode(file_get_contents("php://input"), true);

                $errors = $this->getValidationErrors($data);

                if (!empty($errors)) {
                    http_response_code(422);
                    echo json_encode(["errors" => $errors]);
                    break;
                }

                $id = $this->gateway->create($data);

                http_response_code(201);
                echo json_encode([
                    "message" => "Property created",
                    "prop_id" => $id
                ]);

                break;

            default:
                http_response_code(405);
                header("Allow: GET, POST");
        }
    }

    private function getValidationErrors(array $data, bool $is_new = true): array
    {
        $errors = [];

        if ($is_new && empty($data["prop_name"])) {
            $errors[] = "name is required";
        }

        if ($is_new && empty($data["prop_address"])) {
            $errors[] = "address is required";
        }

        if (array_key_exists("prop_numBeds", $data)) {
            if (filter_var($data["prop_numBeds"], FILTER_VALIDATE_INT) === false) {
                $errors[] = "numBeds must be an integer";
            }
        }

        if ($is_new && empty($data["prop_companyReg"])) {
            $errors[] = "companyReg is required";
        }

        if ($is_new && empty($data["prop_proofOwnership"])) {
            $errors[] = "proofOwnership is required";
        }

        if ($is_new && empty($data["prop_taxPin"])) {
            $errors[] = "taxPin is required";
        }

        if ($is_new && empty($data["prop_utilityBill"])) {
            $errors[] = "utilityBill is required";
        }

        if ($is_new && empty($data["prop_liabilityCover"])) {
            $errors[] = "liabilityCover is required";
        }

        if ($is_new && empty($data["prop_certificateOccuppancy"])) {
            $errors[] = "certificateOccuppancy is required";
        }

        if ($is_new && empty($data["prop_landUseConsent"])) {
            $errors[] = "landUseConsent is required";
        }

        if ($is_new && empty($data["prop_zoningPermit"])) {
            $errors[] = "zoningPermit is required";
        }

        if ($is_new && empty($data["prop_buildingPlans"])) {
            $errors[] = "buildingPlans is required";
        }

        if ($is_new && empty($data["prop_proofOfPayment"])) {
            $errors[] = "proofOfPayment is required";
        }

        if ($is_new && empty($data["prop_accreditStatus"])) {
            $errors[] = "accreditStatus is required";
        }

        if (array_key_exists("prop_rating", $data)) {
            if (filter_var($data["prop_rating"], FILTER_VALIDATE_INT) === false) {
                $errors[] = "rating must be an integer";
            }
        }

        if (array_key_exists("landlord_id", $data)) {
            if (filter_var($data["landlord_id"], FILTER_VALIDATE_INT) === false) {
                $errors[] = "landlord_id must be an integer";
            }
        }

        return $errors;
    }
}