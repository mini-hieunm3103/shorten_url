<?php

namespace Modules\Url\app\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Tag\app\Models\Tag;
use Modules\User\app\Models\User;

class Url extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'long_url',
        'back_half',
        'user_id',
        'clicks',
        'archived',
        'expired_at',
        'title'
    ];

    protected static function newFactory()
    {
        //return UrlFactory::new();
    }

    function user()
    {
        return $this->belongsTo(User::class);
    }
    public function tags(){
        return $this->belongsToMany(Tag::class, 'url_tag');
    }
}
