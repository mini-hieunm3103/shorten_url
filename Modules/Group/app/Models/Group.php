<?php

namespace Modules\Group\app\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Group\Database\factories\GroupFactory;

class Group extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $table='groups';
    protected $fillable = [
        'user_id',
        'permission'
    ];

    protected static function newFactory(): GroupFactory
    {
        //return GroupFactory::new();
    }
}
