<?php

declare(strict_types=1);


/**
 * @description - Make a JSON response
 * @param array $data
 * @param bool $error
 * @param string $message
 * @return string
 */

function make_json(
    bool $error = false,
    string $message = null,
    array | null $data = null,
    int $code = 200
) {
    header("Content-Type: application/json");
    http_response_code($code);
    $response = [
        "ok" => !$error,
        "message" => $message,
        "data" => $data
    ];
    return json_encode($response, JSON_PRETTY_PRINT | JSON_HEX_TAG | JSON_HEX_APOS | JSON_HEX_QUOT | JSON_HEX_AMP | JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES);
}
