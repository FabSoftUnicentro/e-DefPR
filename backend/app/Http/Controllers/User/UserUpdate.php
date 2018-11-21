<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\User\UpdateRequest;
use App\Models\User;
use Illuminate\Http\Request;

class UserUpdate extends Controller
{
    /**
     * @param UpdateRequest $request
     * @param User $user
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Throwable
     */
    public function __invoke(Request $request, User $user)
    {
        $user->update($request->all());

        $user->saveOrFail();

        try {
            $user->save();

            return redirect()
                ->route('users.index')
                ->with('alert-success', 'Funcionário atualizado com sucesso!');
        } catch (\Exception $e) {
            return redirect()
                ->back()
                ->with('alert-danger', 'Falha na atualização do funcionário!');
        }
    }
}
