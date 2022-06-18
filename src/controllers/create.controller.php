<?php

declare(strict_types=1);

require(__DIR__ . "/../utils/url.php");


/**
 * @desc - CREATE A NEW SHORT URL
 */


function create(): void
{
    if ($_SERVER["REQUEST_METHOD"] === "POST") {
        // Initiate the database connection
        global $db;

        // If URL is not provided
        if (!array_key_exists("url", $_POST)) {
            $res = make_json(true, "URL is required", null, 400);
            echo $res;
            return;
        }

        // Destructure POST array
        ["url" => $url] = $_POST;
        $url = htmlspecialchars(trim($url));

        // Check if URL is valid
        $check = check_protocol($url, true);
        if (!$check) {
            $res = make_json(true, "Invalid URL", null, 400);
            echo $res;
            return;
        }

        // Generate short url
        $generated_ref = create_short_url();
        if (!$generated_ref) {
            $res = make_json(true, "Error creating short url", null, 500);
            echo $res;
            return;
        }

        [$ref, $short_url] = $generated_ref;


        // // Insert the URL into the database
        $sql = "INSERT INTO urls (custom_ref, short_url, original_url) VALUES (?, ?, ?)";
        $stmt = $db->prepare($sql);
        $stmt->execute([$ref, $short_url, $check]);
        $res = make_json(false, "Short URL created successfully", [
            "ref" => $ref,
            "short_url" => $short_url,
            "original_url" => $check
        ], 201);

        // Close the database connection
        $stmt->closeCursor();

        echo $res;
    } else {
        http_response_code(405);
        echo "<h1>Method Not Allowed</h1>";
    }
}
