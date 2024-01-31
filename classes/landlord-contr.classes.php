<?php

class LandlordController
{
    public function __construct(private LandlordGateway $gateway)
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
        $landlord = $this->gateway->get($id);

        if (!$landlord) {
            http_response_code(404);
            echo json_encode(["message" => "Landlord not found"]);
            return;
        }

        switch ($method) {
            case "GET":
                echo json_encode($landlord);
                break;

            case "PATCH":
                $data = (array) json_decode(file_get_contents("php://input"), true);

                $rows = $this->gateway->update($landlord, $data);

                echo json_encode([
                    "message" => "Landlord $id updated",
                    "rows" => $rows
                ]);
                break;

            case "DELETE":
                $rows = $this->gateway->delete($id);

                echo json_encode([
                    "message" => "Landlord $id deleted",
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

                $id = $this->gateway->create($data);

                http_response_code(201);
                echo json_encode([
                    "message" => "Landlord created",
                    "id" => $id
                ]);
                break;

            default:
                http_response_code(405);
                header("Allow: GET, POST");
        }
    }
}