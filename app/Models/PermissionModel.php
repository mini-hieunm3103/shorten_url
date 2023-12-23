<?php

namespace App\Models;

use Spatie\Permission\Exceptions\PermissionAlreadyExists;
use Spatie\Permission\Guard;
use Spatie\Permission\Models\Permission;

class PermissionModel extends Permission
{
    public static function createWithModuleId(array $attributes = [])
    {
        $attributes['guard_name'] = $attributes['guard_name'] ?? Guard::getDefaultName(static::class);
        $permission = static::getPermission(
            [
                'name' => $attributes['name'],
                'guard_name' => $attributes['guard_name'],
                'module_id' => $attributes['module_id']
            ]
        );

        if ($permission) {
            throw PermissionAlreadyExists::create($attributes['name'], $attributes['guard_name']);
        }

        return static::query()->create($attributes);
    }
}
