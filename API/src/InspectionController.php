<?php

class InspectionController
{
    public function __construct(private InspectionGateway $gateway)
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
        $inspection = $this->gateway->get($id);

        if (!$inspection) {
            http_response_code(404);
            echo json_encode(["message" => "Inspection not found"]);
            return;
        }

        switch ($method) {
            case "GET":
                echo json_encode($inspection);
                break;

            case "PATCH":
                $data = (array) json_decode(file_get_contents("php://input"), true);

                $errors = $this->getValidationErrors($data, false);

                if (!empty($errors)) {
                    http_response_code(422);
                    echo json_encode(["errors" => $errors]);
                    break;
                }

                $rows = $this->gateway->update($inspection, $data);

                echo json_encode([
                    "message" => "Inspection $id updated",
                    "rows" => $rows
                ]);
                break;

            case "DELETE":
                $rows = $this->gateway->delete($id);

                echo json_encode([
                    "message" => "Inspection $id deleted",
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
                    "message" => "Inspection created",
                    "insp_id" => $id
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

        if ($is_new && empty($data["insp_status"])) {
            $errors[] = "status is required";
        }

        if ($is_new && empty($data["prop_id"])) {
            $errors[] = "prop_id is required";
        }

        if (array_key_exists("prop_id", $data)) {
            if (filter_var($data["prop_id"], FILTER_VALIDATE_INT) === false) {
                $errors[] = "prop_id must be an integer";
            }
        }

        return $errors;
    }
}