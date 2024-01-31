<?php

class ReportsController
{
    public function __construct(private ReportsGateway $gateway)
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
        $report = $this->gateway->get($id);

        if (!$report) {
            http_response_code(404);
            echo json_encode(["message" => "Reports not found"]);
            return;
        }

        switch ($method) {
            case "GET":
                echo json_encode($report);
                break;

            case "PATCH":
                $data = (array) json_decode(file_get_contents("php://input"), true);

                $errors = $this->getValidationErrors($data, false);

                if (!empty($errors)) {
                    http_response_code(422);
                    echo json_encode(["errors" => $errors]);
                    break;
                }

                $rows = $this->gateway->update($report, $data);

                echo json_encode([
                    "message" => "Report $id updated",
                    "rows" => $rows
                ]);
                break;

            case "DELETE":
                $rows = $this->gateway->delete($id);

                echo json_encode([
                    "message" => "Report $id deleted",
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
                    "message" => "Report created",
                    "report_id" => $id
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

        if ($is_new && empty($data["report_title"])) {
            $errors[] = "title is required";
        }

        if ($is_new && empty($data["report_description"])) {
            $errors[] = "description is required";
        }

        if ($is_new && empty($data["report_status"])) {
            $errors[] = "status is required";
        }

        if ($is_new && empty($data["landlord_id"])) {
            $errors[] = "landlord id is required";
        }

        if (array_key_exists("landlord_id", $data)) {
            if (filter_var($data["landlord_id"], FILTER_VALIDATE_INT) === false) {
                $errors[] = "landlord id must be an integer";
            }
        }

        if ($is_new && empty($data["student_id"])) {
            $errors[] = "student id is required";
        }

        if (array_key_exists("student_id", $data)) {
            if (filter_var($data["student_id"], FILTER_VALIDATE_INT) === false) {
                $errors[] = "student id must be an integer";
            }
        }

        return $errors;
    }
}