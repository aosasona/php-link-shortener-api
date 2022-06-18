<?php

/**
 * @author - Ayodeji
 * @desc - ROUTER
 */

declare(strict_types=1);

require_once('../vendor/autoload.php');

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->safeLoad();

// Endpoint files
require_once "controllers/create.controller.php";
require_once "controllers/view.controller.php";

$currentPath = substr($_SERVER['REQUEST_URI'], 1); // Remove the leading slash

// Serve endpoints
switch ($currentPath) {
    case "create":
        create();
        break;
    case substr($currentPath, 0, 4) === "view":
        $pathArray = explode("/", $currentPath);
        $resource = $pathArray[1] ?? null;
        if (!$resource) {
            view_all();
        } else {
            $id = (string) $pathArray[1] ?? 0;
            view_one($id);
        }
        break;
    case "":
        http_response_code(200);
        echo "<h1>Welcome!</h1>";
        break;
    default:
        http_response_code(200);
        echo "<h1>Welcome!</h1>";
        break;
};
