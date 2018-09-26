<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CounterPart extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'cpf',
        'birth_date',
        'rg',
        'rg_issuer',
        'gender',
        'marital_status',
        'profession',
        'note',
        'addresses',
        'document_type',
        'document_number',
        'fantasy_name'
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
     * Get the city that the assisted was born.
     */
    public function city()
    {
        return $this->hasOne(City::class);
    }
}
