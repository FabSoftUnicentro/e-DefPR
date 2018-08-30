<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Assisted extends Model
{

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'cpf', 'birth_date', 'birth_place', 'rg', 'rg_issuer', 'gender', 'marital_status',
        'profession', /*'counter_part',*/ 'note', 'addresses',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'cpf' => 'integer',
    ];

    /**
     * The attributes that should be mutated to dates.
     *
     * @var array
     */
    protected $dates = [
        'deleted_at'
    ];

    /**
     * Get the state that owns the city.
     */
    public function assisted()
    {

        return $this->hasMany(Assisted::class);
    }
}
