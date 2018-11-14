<?php

namespace App\Models;

use Spatie\Permission\Guard;
use Spatie\Permission\Models\Permission as BasePermission;
use Spatie\Permission\Exceptions\PermissionAlreadyExists;

class Permission extends BasePermission
{
    public $guarded = ['id'];

    public function __construct(array $attributes = [])
    {
        $attributes['guard_name'] = $attributes['guard_name'] ?? config('auth.defaults.guard');
        $attributes['description'] = $attributes['description'] ?? config('');

        parent::__construct($attributes);

        $this->setTable(config('permission.table_names.permissions'));
    }

    public static function create(array $attributes = [])
    {
        $attributes['guard_name'] = $attributes['guard_name'] ?? Guard::getDefaultName(static::class);
        $attributes['description'] = $attributes['description'] ?? '';

        $permission = static::getPermissions()->filter(function ($permission) use ($attributes) {
            return $permission->name === $attributes['name'] && $permission->description === $attributes['description'] && $permission->guard_name === $attributes['guard_name'];
        })->first();

        if ($permission) {
            throw PermissionAlreadyExists::create($attributes['name'], $attributes['description'], $attributes['guard_name']);
        }

        if (isNotLumen() && app()::VERSION < '5.4') {
            return parent::create($attributes);
        }

        return static::query()->create($attributes);
    }
}
