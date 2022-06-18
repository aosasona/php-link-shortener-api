<?php

declare(strict_types=1);


/**
 * @description - Make a JSON response
 * @param array $data
 * @param bool $error
 * @param string $message
 * @return string
 */

function make_json(bool $error = false, array | null $data = null, string $message = null)
{
    $response = [
        "ok" => $error,
        "data" => $data,
        "message" => $message
    ];
    return json_encode($response);
}
