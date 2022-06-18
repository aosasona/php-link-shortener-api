<?php

declare(strict_types=1);

require_once('../vendor/autoload.php');

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->safeLoad();

require(__DIR__ . "/config/db.config.php");


$db_instance = new DB();
$db = $db_instance->connect();


$database_name = $_ENV["DB_NAME"];

// Database creation
$database = "CREATE DATABASE IF NOT EXISTS ${database_name}";

// Table creation
$table = "CREATE TABLE IF NOT EXISTS ${database_name}.urls (
    id INT(11) NOT NULL AUTO_INCREMENT,
    custom_ref VARCHAR(5) NOT NULL,
    short_url VARCHAR(255) NOT NULL,
    original_url VARCHAR(255) NOT NULL,
    created_at TIMESTAMP NOT NULL DEFAULT CURRENT_TIMESTAMP,
    PRIMARY KEY (id)
)";

try {
    $db->exec($database);
    $db->exec($table);
    echo "Migrations complete";
} catch (PDOException $e) {
    echo $e->getMessage();
}
