<?php

namespace App\Http\Controllers\Api;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Auth\Events\Registered;
use App\Http\Requests\Auth\LoginRequest;
use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Validation\Rules\Password;
use App\Traits\MessagesReponses;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class AuthController extends Controller
{

  use MessagesReponses;

  public function register(Request $request)
  {
    $request->validate([
      'name' => 'required|string|max:255',
      'email' => 'required|string|email|max:255|unique:users',
      'password' => ['required', 'confirmed', Password::defaults()],
    ]);

    $user = User::create([
      'name' => $request->name,
      'email' => $request->email,
      'password' => Hash::make($request->password),
    ]);

    event(new Registered($user));

    $token = $user->createToken('authtoken');

    return response()->json(
      [
        'message' => 'Usuário Regisrado com Sucesso!',
        'user' => $user,
        'token' => $token->plainTextToken
      ]
    );
  }

  public function login(LoginRequest $request)
  {
    try {
      $request->authenticate();

      $token = $request->user()->createToken('authtoken');

      return response()->json(
        [
          'message' => 'Logged in baby',
          'user' => $request->user(),
          'token' => $token->plainTextToken
        ]
      );
    } catch (\Throwable $th) {
      return response()->json([
        'message' => throw $th
      ]);
    }
  }

  public function edit($uuid)
  {
    try {
      $user = User::where('uuid', $uuid)->firstOrFail();
    } catch (\Throwable $th) {
      return response()->json([
        'message' => throw $th,
        'user' => $user,
      ]);
    }
    return response()->json([
      'message' => 'Tudo Certo !',
      'user' => $user,
    ]);
  }

  public function update(ProfileUpdateRequest $request)
  {
    try {
      $user = User::where('uuid', $request->uuid)->firstOrFail();

      $user->update($request->except('uuid'));
    } catch (\Throwable $th) {

      return response()->json([
        'message' => throw $th,
        'user' => $user,
      ]);
    }

    return response()->json([
      'message' => 'Atualizações Feitas com Sucesso',
      'user' => $user,
    ]);
  }

  public function upPassword(LoginRequest $request)
  {
    try {
      $request->validate([
        'email' => 'required|string|email|max:255',
        'password' => 'required', 'confirmed', 'min:8',
        'new_password' => 'required', 'confirmed', 'min:8',
        'confirm_password' => 'required|same:new_password',
      ]);

      $request->authenticate();

      $user = $request->user();

      // $updatePassword = $request->user()->update(['password' => Hash::make($request->input('password'))]);

      DB::table('users')->where('id', $user->id)->update(['password' =>  Hash::make($request->new_password)]);
    } catch (\Throwable $th) {

      return response()->json([
        'message' => throw $th
      ]);
    }

    return response()->json([
      'message' => 'Atualizações Feitas com Sucesso',
      'user' =>  $user,
      'status' => 200
    ]);
  }

  public function logout(Request $request)
  {
    try {
      $request->user()->tokens()->delete();
    } catch (\Throwable $th) {
      return response()->json(['message' => throw $th]);
    }
    // return response()->json(['message' => 'Deslogado'], 200);

    return response()->noContent(204);
  }

  public function destroy(string $uuid)
  {
    $user = User::where('uuid', $uuid)->firstOrFail();

    $userDelResetTokens = DB::table('password_reset_tokens')->where('email', $user->email)->delete();
    $userDelAccessTokens = DB::table('personal_access_tokens')->where('tokenable_id', $user->id)->delete();

    $user->delete();

    return response()->json([], Response::HTTP_NO_CONTENT);
  }
}
