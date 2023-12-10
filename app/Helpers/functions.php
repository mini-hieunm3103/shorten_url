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

