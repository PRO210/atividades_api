<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Notifications\ResetPasswordNotification;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;


class NewPasswordController extends Controller
{
  public function store(Request $request)
  {
    $request->validate([
      'email' => ['required', 'email'],
    ]);

    $user = User::where('email', $request->input('email'))->first();

    if (!$user || !$user->email) {
      return response()->json([
        'message' => 'Não encontramos esses registros em nosso banco de dados!',
        'status' => 203
      ]);
    }

    $token = uniqid();

    $userPasswordReset = DB::table('password_reset_tokens')->where('email', $request->input('email'))->first();

    if (!$userPasswordReset) {
      DB::table('password_reset_tokens')
        ->insert(['email' => $request->input('email'), 'token' => $token, 'created_at' => now()]);
    } else {
      DB::table('password_reset_tokens')
        ->where('email', $request->input('email'))
        ->update(['token' => $token, 'created_at' => now()]);
    }

    $url = "http://localhost:5173/reset-password/" . $token . "";

    $user->notify(new ResetPasswordNotification($url));


    return response()->json(['message' => 'Link enviado para o email com successo!', 'status' => 200]);
  }


  public function reset(Request $request)
  {
    $request->validate([
      'token' => ['required'],
      'email' => ['required', 'email'],
      'password' => ['required', 'confirmed'],
    ]);

    $user = User::where('email', $request->input('email'))->first();

    $resetRequest = DB::table('password_reset_tokens')->where('email', $request->input('email'))->first();

    if (!$user || $request->token != $resetRequest->token) {
      return response()->json(['message' => 'Não encontramos esses registros em nosso banco de dados!']);
    }

    $user->fill(['password' => Hash::make($request->password)]);

    $user->save();

    $user->tokens()->delete();

    DB::table('password_reset_tokens')->where('email', $request->input('email'))->delete();

    $user->createToken('authtoken')->plainTextToken;

    return response()->json(['message' => 'Password reset successfully']);
  }
}
