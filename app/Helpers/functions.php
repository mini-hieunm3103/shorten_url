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
//Hàm cắt chữ
function getLimitUrl($url, $limit=60){
    $url = trim($url);

    // Kiểm tra xem URL có hợp lệ không
    if (filter_var($url, FILTER_VALIDATE_URL) === false) {
        return $url; // Nếu URL không hợp lệ, trả về nguyên bản
    }

    // Giả sử URL có chiều dài lớn hơn giới hạn
    if (strlen($url) > $limit) {
        // Cắt đoạn URL và thêm "..." ở cuối
        $limitedUrl = substr($url, 0, $limit - 3) . '...';
        return $limitedUrl;
    }

    return $url; // Nếu URL không vượt quá giới hạn, trả về nguyên bản
}
function getLimitText($content, $limit=20){
    $content = strip_tags($content);
    $content = trim($content);
    $contentArr = explode(' ', $content);
    $contentArr = array_filter($contentArr);
    $wordsNumber = count($contentArr); //trả về số lượng phần tử mảng
    if ($wordsNumber>$limit){
        $contentArrLimit = explode(' ', $content, $limit+1);
        array_pop($contentArrLimit);

        $limitText = implode(' ', $contentArrLimit).'...';

        return $limitText;
    }

    return $content;
}
