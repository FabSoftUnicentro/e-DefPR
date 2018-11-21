<?php

namespace App\Http\Controllers\User;

use App\Forms\User\UserForm;
use App\Http\Controllers\Controller;
use App\Models\User;
use Kris\LaravelFormBuilder\Form;

class UserEdit extends Controller
{
    /**
     * @param User $user
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function __invoke(User $user)
    {
        $form = $this->formBuilder->create(UserForm::class, [
            'url' => route('users.update', $user->id),
            'method' => 'PUT',
            'model' => $user
        ]);

        return view('users.edit', [
            'form' => $form
        ]);
    }
}