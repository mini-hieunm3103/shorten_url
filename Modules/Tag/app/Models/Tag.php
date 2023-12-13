<?php

namespace Modules\Tag\app\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Tag\Database\factories\TagFactory;

class Tag extends Model
{
    use HasFactory;
    protected $table = 'tags';
    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'title',
        'description',
        'user_id',
    ];

    protected static function newFactory(): TagFactory
    {
        //return TagFactory::new();
    }
}
