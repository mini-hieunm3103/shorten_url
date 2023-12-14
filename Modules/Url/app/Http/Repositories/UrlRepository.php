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
        return $this->model->select(['id','title', 'long_url','back_half','clicks', 'user_id', 'expired_at', 'created_at']);
    }
    function getBackHalf(){
        $arr = [];
        $urls = $this->getAllUrls()->get();
        foreach ($urls as $key => $url) {
            $arr[$key] = $url->back_half;
        }
        return $arr;

    }
    function getUserUrls($userId)
    {
        return $this->getAllUrls()->where(['user_id' => $userId]);
    }

    function createUrlTags($url, $data=[]) {
        return $url->tags()->attach($data);
    }
    function updateUrlTags($url, $data=[]) {
        return $url->tags()->sync($data);
    }
    function getRelatedTags($url) {
         $tagIds = $url->tags()->allRelatedIds()->toArray();
        return  $tagIds;
    }
    function deleteUrlTags($url) {
        return $url->tags()->detach();
    }
}
