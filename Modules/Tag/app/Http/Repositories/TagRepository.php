<?php

namespace Modules\Tag\app\Http\Repositories;

use App\Repositories\BaseRepository;
use Modules\Tag\app\Models\Tag;

class TagRepository extends BaseRepository implements TagRepositoryInterface
{
    public function getModel()
    {
        return Tag::class;
    }

    function getAllTags()
    {
        return $this->model->select(['id','title', 'description', 'user_id', 'created_at']);
    }
    function createTagUrls($tag, $data=[]) {
        return $tag->urls()->attach($data);
    }

}
