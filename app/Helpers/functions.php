<?php
function encodeUrl($base10_number){
    $index = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $base62_number = '';

    while ($base10_number > 0) {
        $remainder = $base10_number % 62;
        $base62_number = $index[$remainder] . $base62_number;
        $base10_number = floor($base10_number / 62);
    }

    return $base62_number === '' ? '0' : $base62_number;
}

function decodeUrl($base62_number){
    $index = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    $base10_number = 0;
    $length = strlen($base62_number);

    for ($i = 0; $i < $length; $i++) {
        $char = $base62_number[$i];
        $position = strpos($index, $char);
        $base10_number = $base10_number * 62 + $position;
    }
    return $base10_number;
}
