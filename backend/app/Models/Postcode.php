<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Postcode extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'postcode',
        'street',
        'complement',
        'neighborhood',
        'city',
        'uf',
        'unity',
        'ibge_code',
        'gia_code'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [];
}
