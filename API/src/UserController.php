<?php

class UserController
{
    public function __construct(private UserGateway $gateway)
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
        $user = $this->gateway->get($id);

        if (!$user) {
            http_response_code(404);
            echo json_encode(["message" => "User not found"]);
            return;
        }

        switch ($method) {
            case "GET":
                echo json_encode($user);
                break;

            case "PATCH":
                $data = (array) json_decode(file_get_contents("php://input"), true);

                $errors = $this->getValidationErrors($data, false);

                if (!empty($errors)) {
                    http_response_code(422);
                    echo json_encode(["errors" => $errors]);
                    break;
                }

                $rows = $this->gateway->update($user, $data);

                echo json_encode([
                    "message" => "User $id updated",
                    "rows" => $rows
                ]);
                break;

            case "DELETE":
                $rows = $this->gateway->delete($id);

                echo json_encode([
                    "message" => "User $id deleted",
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

                if ($data["method"] === "login") {

                    $id = $this->gateway->login($data);

                    if ($id == "wrong password") {
                        http_response_code(422);
                        echo json_encode(["message" => "wrong password"]);
                        break;
                    }

                    echo json_encode([
                        "message" => "User logged in",
                        "user_id" => $id
                    ]);
                } elseif ($data["method"] === "register") {
                    $id = $this->gateway->register($data);

                    http_response_code(201);
                    echo json_encode([
                        "message" => "User created",
                        "user_id" => $id
                    ]);
                }

                break;

            default:
                http_response_code(405);
                header("Allow: GET, POST");
        }
    }

    private function getValidationErrors(array $data, bool $is_new = true): array
    {
        $errors = [];

        if ($is_new && empty($data["user_email"])) {
            $errors[] = "email is required";
        }

        if (array_key_exists("user_email", $data)) {
            if (filter_var($data["user_email"], FILTER_VALIDATE_EMAIL) === false) {
                $errors[] = "email invalid";
            }
        }

        if ($is_new && empty($data["user_password"])) {
            $errors[] = "password is required";
        }

        if (!$is_new || $data["method"] == "login") {

        } elseif ($data["method"] == "register") {
            if ($this->gateway->checkUser($data["user_email"]) === true) {
                $errors[] = "email already exists";
            }

            if ($is_new && empty($data["user_name"])) {
                $errors[] = "name is required";
            }

            if ($is_new && empty($data["user_surname"])) {
                $errors[] = "surname is required";
            }


            if ($is_new && empty($data["user_phoneNo"])) {
                $errors[] = "phone number is required";
            }

            if ($is_new && empty($data["user_type"])) {
                $errors[] = "user type is required";
            }

        } else {
            $errors[] = "method is required";
        }

        return $errors;
    }
}