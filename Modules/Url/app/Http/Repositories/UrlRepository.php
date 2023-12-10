<?php

namespace Modules\Url\app\Http\Repositories;

use App\Repositories\BaseRepository;
use Modules\Url\app\Models\Url;

class UrlRepository extends BaseRepository implements UrlRepositoryInterface
{
    public function getModel()
    {
        return Url::class;
    }

    function getAllUrls()
    {
        return $this->model->select(['id', 'long_url','clicks']);
    }
}
