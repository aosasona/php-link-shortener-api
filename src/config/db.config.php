<?php

require_once(__DIR__ . '/../../vendor/autoload.php');

$dotenv = Dotenv\Dotenv::createImmutable(__DIR__ . '/../');
$dotenv->safeLoad();

$host = $_ENV["DB_HOST"];
$user = $_ENV["DB_USER"];
$pass = $_ENV["DB_PASSWORD"];
$db_name = $_ENV["DB_NAME"];


class DB
{
    public static function connect()
    {
        try {
            global $host, $user, $pass, $db_name;
            $conn = new PDO("mysql:host=${host};dbname=${db_name}", $user, $pass);
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $conn;
        } catch (PDOException $e) {
            echo $e->getMessage();
        }
    }
}
