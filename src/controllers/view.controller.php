<?php

declare(strict_types=1);

use function PHPSTORM_META\type;

require_once(__DIR__ . "/../utils/json.php");

header("Content-Type: application/json; charset=UTF-8");


/**
 * @desc - VIEW ALL SHORT URLS
 */

function view_all()
{
    echo "Showing All";
}


/**
 * @desc - VIEW ONE SHORT URL
 */

function view_one(int $id)
{
    if ($id > 0 && gettype($id) === "integer") {
        echo "Showing One";
    } else {
        http_response_code(400);
        $res = make_json(true, null, "Invalid ID");
        echo $res;
    }
}
