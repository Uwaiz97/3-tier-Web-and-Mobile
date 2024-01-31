<?php

declare(strict_types=1);

spl_autoload_register(function ($class) {
    require __DIR__ . "/src/$class.php";
});

set_error_handler("ErrorHandler::handleError");
set_exception_handler("ErrorHandler::handleException");

header("Content-type: application/json; charset=UTF-8");

$parts = explode("/", $_SERVER["REQUEST_URI"]);

switch ($parts[4]) {
    case "user":
        $id = $parts[5] ?? null;

        $gateway = new UserGateway();

        $controller = new UserController($gateway);

        $controller->processRequest($_SERVER["REQUEST_METHOD"], $id);

        break;
    case "staff":
        $id = $parts[5] ?? null;

        $gateway = new StaffGateway();

        $controller = new StaffController($gateway);

        $controller->processRequest($_SERVER["REQUEST_METHOD"], $id);

        break;
    case "landlord":
        $id = $parts[5] ?? null;

        $gateway = new LandlordGateway();

        $controller = new LandlordController($gateway);

        $controller->processRequest($_SERVER["REQUEST_METHOD"], $id);

        break;
    case "property":
        $id = $parts[5] ?? null;

        $gateway = new PropertyGateway();

        $controller = new PropertyController($gateway);

        $controller->processRequest($_SERVER["REQUEST_METHOD"], $id);

        break;
    case "student":
        $id = $parts[5] ?? null;

        $gateway = new StudentGateway();

        $controller = new StudentController($gateway);

        $controller->processRequest($_SERVER["REQUEST_METHOD"], $id);

        break;
    case "inspection":
        $id = $parts[5] ?? null;

        $gateway = new InspectionGateway();

        $controller = new InspectionController($gateway);

        $controller->processRequest($_SERVER["REQUEST_METHOD"], $id);

        break;
    case "maintenancequery":
        $id = $parts[5] ?? null;

        $gateway = new MaintenanceQueryGateway();

        $controller = new MaintenanceQueryController($gateway);

        $controller->processRequest($_SERVER["REQUEST_METHOD"], $id);

        break;
    case "caretaker":
        $id = $parts[5] ?? null;

        $gateway = new CareTakerGateway();

        $controller = new CareTakerController($gateway);

        $controller->processRequest($_SERVER["REQUEST_METHOD"], $id);

        break;
    case "reports":
        $id = $parts[5] ?? null;

        $gateway = new ReportsGateway();

        $controller = new ReportsController($gateway);

        $controller->processRequest($_SERVER["REQUEST_METHOD"], $id);

        break;
    default:
        http_response_code(404);
        exit;
}