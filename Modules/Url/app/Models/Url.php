<?php

namespace Modules\Url\app\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Url\Database\factories\UrlFactory;

class Url extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'long_url',
        'clicks',
        'expired_at'
    ];

    protected static function newFactory()
    {
        //return UrlFactory::new();
    }

}
