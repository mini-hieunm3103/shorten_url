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
/** đưa vào currentUrl: quan-tri-vien/url/create
 * đưa vào previous url: quan-tri-vien/url/create (do khi submit form không thành công , previous sẽ bị chuyển thành create thay vì là trang đi vào create)
 *
 */
//function backUrl($currentUrl, $url)
//{
//    if ($currentUrl === $previousUrl) {
//        // khi đó previous sẽ trở
//        $previousUrl->previous();
//        backUrl($currentUrl, $previousUrl);
//    }
//    return $previousUrl;
//}

// $actionRouteName = request()->route()->getName()
function titleBlade($actionRouteName, $modules=[], $actionArr){
    $nameArr = explode('.', $actionRouteName);
    if ($nameArr[0] != 'admin'){
        return false;
    }
    $module = $nameArr[1];
    $action = $nameArr[2];

    // trường hợp đặc biệt dashboard cho admin
    if ($module === 'dashboard'){
        return  [
            'lists' => '<li class="breadcrumb-item active">Trang Chủ</li>',
            'title' => 'Trang Chủ'
        ];
    } else{
        if ($action === 'index'){
            return  [
                'lists' => '
            <li class="breadcrumb-item"><a href="'.route('admin.dashboard.index').'">Trang Chủ</a></li>
            <li class="breadcrumb-item active">'.$actionArr[$action].' '.$modules[$module]['title'].'</li>',
                'title' => $actionArr[$action].' '.$modules[$module]['title']
            ];
        }else {
            return [
                'lists' => '<li class="breadcrumb-item"><a href="'.route('admin.dashboard.index').'">Trang Chủ</a></li>
                            <li class="breadcrumb-item"><a href="'.route('admin.'.$module.'.index').'">'.$modules[$module]['title'].'</a></li>
                            <li class="breadcrumb-item active">'.$actionArr[$action].' '.$modules[$module]['title'].'</li>',
                'title' => $actionArr[$action].' '.$modules[$module]['title']
                ];
        }
    }
    return false;
}

function checkPermission($module, $action = 'view')
{
    $permissionName =($action == 'view') ? $action.' '.$module.'s' : $action.' '.$module;
    if (!auth()->user()->hasPermissionTo($permissionName)){
        abort(403);
    }
}
