<?php

class StudentController
{
    public function __construct(private StudentGateway $gateway)
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
        $student = $this->gateway->get($id);

        if (!$student) {
            http_response_code(404);
            echo json_encode(["message" => "Student not found"]);
            return;
        }

        switch ($method) {
            case "GET":
                echo json_encode($student);
                break;

            case "PATCH":
                $data = (array) json_decode(file_get_contents("php://input"), true);

                $errors = $this->getValidationErrors($data, false);

                if (!empty($errors)) {
                    http_response_code(422);
                    echo json_encode(["errors" => $errors]);
                    break;
                }

                $rows = $this->gateway->update($student, $data);

                echo json_encode([
                    "message" => "Student $id updated",
                    "rows" => $rows
                ]);
                break;

            case "DELETE":
                $rows = $this->gateway->delete($id);

                echo json_encode([
                    "message" => "Student $id deleted",
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
                    "message" => "Student created",
                    "student_id" => $id
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

        if ($is_new && empty($data["student_id"])) {
            $errors[] = "id is required";
        }

        if ($is_new && empty($data["student_number"])) {
            $errors[] = "student_number is required";
        }

        if (array_key_exists("student_id", $data)) {
            if (filter_var($data["student_id"], FILTER_VALIDATE_INT) === false) {
                $errors[] = "id must be an integer";
            }
        }

        return $errors;
    }
}