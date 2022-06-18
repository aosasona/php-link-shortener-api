<?php

declare(strict_types=1);

require(__DIR__ . "/../config/db.config.php");

$db_instance = new DB();
$db = $db_instance->connect();

/* 
* @desc - Checks if a URL is valid
* @param - $url - string - The URL to be checked
* @return - bool - True if valid, false if not
*/
function check_type(string $url): bool
{
    $sanitized = filter_var($url, FILTER_SANITIZE_URL);

    if (!$sanitized) {
        return false;
    } else if (count(explode(".", $sanitized)) < 2) {
        return false;
    } else {
        return true;
    }
};

// Check if url starts with http or https
function check_protocol(string $url, bool $https = false): string
{
    $http_protocol = substr($url, 0, 6);
    $https_protocol = substr($url, 0, 7);

    if (check_type($url)) {
        if (!$https && $http_protocol === "http://") {
            return $url;
        } else if ($https && $https_protocol === "https://") {
            return $url;
        } else {
            if ($https) {
                return "https://" . $url;
            } else {
                return "http://" . $url;
            }
        }
    } else {
        return false;
    }
}

// Generate a random string
function generate_random_string(int $length = 5): string
{
    $characters = "0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ";
    $charactersLength = strlen($characters);
    $randomString = "";
    for ($i = 0; $i < $length; $i++) {
        $randomString .= $characters[rand(0, $charactersLength - 1)];
    }
    return $randomString;
}


// Check if the short url already exists
function check_short_url(string $short_url): bool
{
    global $db;
    $sql = "SELECT * FROM urls WHERE custom_ref = ?";
    $stmt = $db->prepare($sql);
    $stmt->execute([$short_url]);
    $result = $stmt->fetch();
    if ($result) {
        return true;
    } else {
        return false;
    }
}

// Create short url
function create_short_url(): array
{
    // Generate a random string of characters
    $ref = generate_random_string();

    // Check if the short url already exists
    while (check_short_url($ref)) {
        $ref = generate_random_string();
    }

    $site_url = $_ENV["SITE_URL"];
    $short_url = "${site_url}/s/$ref";
    $result = [$ref, $short_url];
    return $result;
}
