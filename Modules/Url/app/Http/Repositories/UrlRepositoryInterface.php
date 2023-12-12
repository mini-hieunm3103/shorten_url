<?php

namespace Modules\Url\app\Http\Repositories;

use App\Repositories\RepositoryInterface;

interface UrlRepositoryInterface extends RepositoryInterface
{
    function getAllUrls();
    function getUserUrls($userId);
}
