<?php

namespace App\Http\Controllers\User;

use App\Forms\User\UserForm;
use App\Http\Controllers\Controller;

class UserCreate extends Controller
{
    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function __invoke()
    {
        $form = $this->formBuilder->create(UserForm::class, [
            'url' => route('users.store'),
            'method' => 'POST'
        ]);

        return view('users.create', [
            'form' => $form
        ]);
    }
}