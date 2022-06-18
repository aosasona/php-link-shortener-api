<?php

declare(strict_types=1);
/* 
* @desc - Checks if a URL is valid
* @param - $url - string - The URL to be checked
* @return - bool - True if valid, false if not
*/
function check(string $url)
{
    $sanitized = filter_var($url, FILTER_SANITIZE_URL);
};
