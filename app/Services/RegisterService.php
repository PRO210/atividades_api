<?php

declare(strict_types=1);

namespace App\Services;

use App\Models\User;
use App\Traits\MessagesReponses;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;


class RegisterService
{
  use MessagesReponses;


  function register($request)
  {
    $oldData = $request->all();
    $data = $request->all();
    $data['password'] = bcrypt($request->password);

    $validator = Validator::make($data, [
      'name' => ['required', 'string', 'min:3', 'max:255'],
      'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
      'password' => ['required', 'min:6']
    ]);

    if ($validator->fails()) {
      return $this->error('Dados Inválidos', 422, $validator->errors(), $oldData);
    }

    $user = User::create($validator->validated());

    return $user;
  }

  function token($request)
  {
    if (Auth::attempt($request->only('email', 'password'))) {
      return $this->success('Authorized', 200, [
        'token' => $request->user()->createToken('user')->plainTextToken
      ]);
    }
    return $this->error('Not Authorized', 403);
  }
}
