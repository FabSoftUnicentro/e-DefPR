<?php

namespace App;

use App\Models\Attendment;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Services\Mailer;
use Spatie\Permission\Traits\HasRoles;
use Illuminate\Support\Facades\View;

class User extends Authenticatable
{
    use HasApiTokens, Notifiable, HasRoles;

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
        'rg_issuer',
        'rg',
        'gender',
        'marital_status',
        'profession',
        'note',
        'birthplace',
        'addresses',
        'must_change_password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * Get all of the attendments for the user.
     */
    public function attendments()
    {
        return $this->hasMany(Attendment::class, 'user_id');
    }

    /**
     * @throws \Exception
     */
    public function resetPassword()
    {
        $temporaryPassword = uniqid(time());
        $hashedPassword = bcrypt($temporaryPassword);
        $this->password = $hashedPassword;
        $this->must_change_password = true;
        $this->save();

        $address = [
            'email' => $this->email,
            'name' => $this->name
        ];

        $htmlProvide = View::make('templates/resetPassword', [
            'user' => $this,
            'temporaryPassword' => $temporaryPassword
        ]);

        $html = $htmlProvide->render();

        Mailer::sendEmail([ $address ], 'Recuperação de Senha', $html);
    }
}
