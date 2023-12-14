<?php

namespace Modules\Url\app\Http\Repositories;

use App\Repositories\RepositoryInterface;

interface UrlRepositoryInterface extends RepositoryInterface
{
    function getAllUrls();
    function getBackHalf();
    function getUserUrls($userId);
    function createUrlTags($url, $data=[]);
    function updateUrlTags($url, $data=[]);
    function getRelatedTags($url);
    function deleteUrlTags($url);
}
