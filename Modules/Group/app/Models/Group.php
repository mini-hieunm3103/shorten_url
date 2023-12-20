<?php

namespace Modules\Group\app\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Modules\Group\Database\factories\GroupFactory;
use Modules\User\app\Models\User;
class Group extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $table='groups';
    protected $fillable = [
        'name',
        'user_id',
        'permission'
    ];
    function users(){
        return $this->hasMany(User::class);
    }
    function userCreate()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    protected static function newFactory(): GroupFactory
    {
        //return GroupFactory::new();
    }
}
