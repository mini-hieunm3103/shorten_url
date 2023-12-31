<?php

namespace Modules\Tag\app\Http\Repositories;

use App\Repositories\RepositoryInterface;

interface TagRepositoryInterface extends RepositoryInterface
{
    function getAllTags();

    function createTagUrls($tag, $data=[]);

    function updateTagUrls($tag, $data=[]);

    function getRelatedUrls($tag);

    function deleteTagUrls($tag);
}
