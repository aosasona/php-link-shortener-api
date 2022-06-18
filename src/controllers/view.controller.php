<?php

declare(strict_types=1);
require_once(__DIR__ . "/../utils/json.php");
/**
 * @desc - VIEW ALL SHORT URLS
 */

function view_all(): void
{
    global $db;

    // Fetch all the short urls
    $sql = "SELECT custom_ref, short_url, original_url, created_at FROM urls";
    $stmt = $db->prepare($sql);
    $stmt->execute();
    $result = $stmt->fetchAll();
    if (!$result) {
        $res = make_json(true, "No short urls found", null, 404);
        echo $res;
        return;
    } else {
        $count = count($result);
        $data = array_map(function ($item) {
            return [
                "ref" => $item["custom_ref"],
                "short_url" => $item["short_url"],
                "original_url" => $item["original_url"],
                "created_at" => $item["created_at"]
            ];
        }, $result);
        $res = make_json(false, "${count} urls found", $data, 200);
        echo $res;
        return;
    }
}


/**
 * @desc - VIEW ONE SHORT URL
 */

function view_one(string $ref): void
{
    if ($ref !== null && gettype($ref) === "string") {
        global $db;

        // Get URL by custom_ref
        $sql = "SELECT custom_ref, short_url, original_url, created_at FROM urls WHERE custom_ref = :id LIMIT 1";
        $stmt = $db->prepare($sql);
        $stmt->execute([":id" => $ref]);
        $result = $stmt->fetch(PDO::FETCH_ASSOC);

        // If URL is found
        if ($result) {
            $res = make_json(false, "Short URL fetched!", $result, 200);
            echo $res;
        } else {
            $res = make_json(true, "URL not found!", null, 404);
            echo $res;
        }

        return;
    } else {
        $res = make_json(true, "Invalid ID", null, 400);
        echo $res;
        return;
    }
}
