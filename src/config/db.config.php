<?php

$host = $_ENV["DB_HOST"];
$user = $_ENV["DB_USER"];
$pass = $_ENV["DB_PASSWORD"];
$db_name = $_ENV["DB_NAME"];

function connect()
{
    try {
        global $host, $user, $pass, $db_name;
        $db = new PDO("mysql:host=${host};dbname=${db_name}", $user, $pass);
        $db->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        return $db;
    } catch (PDOException $e) {
        echo $e->getMessage();
    }
}
