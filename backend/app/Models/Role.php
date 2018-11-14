<?php

namespace App\Models;

use Spatie\Permission\Guard;
use Spatie\Permission\Models\Role as BaseRole;
use Spatie\Permission\Exceptions\RoleAlreadyExists;

class Role extends BaseRole
{
    public $guarded = ['id'];

    public function __construct(array $attributes = [])
    {
        $attributes['guard_name'] = $attributes['guard_name'] ?? config('auth.defaults.guard');
        $attributes['description'] = $attributes['description'] ?? config('');

        parent::__construct($attributes);

        $this->setTable(config('permission.table_names.roles'));
    }

    public static function create(array $attributes = [])
    {
        $attributes['guard_name'] = $attributes['guard_name'] ?? Guard::getDefaultName(static::class);
        $attributes['description'] = $attributes['description'] ?? '';

        if (static::where('name', $attributes['name'])->where('guard_name', $attributes['guard_name'])->first()) {
            throw RoleAlreadyExists::create($attributes['name'], $attributes['description'], $attributes['guard_name']);
        }

        if (isNotLumen() && app()::VERSION < '5.4') {
            return parent::create($attributes);
        }

        return static::query()->create($attributes);
    }
}
