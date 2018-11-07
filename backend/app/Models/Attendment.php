<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Attendment extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'description',
        'type_id',
        'user_id',
        'assisted_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    /**
     * Get the user that owns the attendment.
     */
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }
}
