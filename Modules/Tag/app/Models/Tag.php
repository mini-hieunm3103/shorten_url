<?php

namespace Modules\Tag\app\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Url\app\Models\Url;
use Modules\User\app\Models\User;

class Tag extends Model
{
    use HasFactory;
    protected $table = 'tags';
    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'title',
        'user_id',
    ];

    protected static function newFactory(): TagFactory
    {
        //return TagFactory::new();
    }
    function user()
    {
        return $this->belongsTo(User::class);
    }
    public function urls(){
        return $this->belongsToMany(Url::class, 'url_tag');
    }
}
