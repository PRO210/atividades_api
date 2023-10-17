<?php

namespace App\Http\Requests;

use App\Models\User;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class ProfileUpdateRequest extends FormRequest
{
  public function authorize()
  {
    return true;
  }
  /**
   * Get the validation rules that apply to the request.
   *
   * @return array<string, \Illuminate\Contracts\Validation\Rule|array|string>
   */
  public function rules(): array
  {
    return [
      'name' => [ 'required','string', 'max:255'],
      'email' => ['required', 'email', 'max:255'],
      //'email' => ['email', 'max:255', Rule::unique(User::class)->ignore($this->user()->id)],
    ];

    // $rules = [
    //   'password' => ['required', 'string', 'min:8', 'max:16'],
    //   'password' => ['required', 'string', 'min:8', 'max:16'],
    //   'password' => ['required', 'string', 'min:8', 'max:16'],
    // ];

    // if ($this->method() == 'PUT') {
    //   $rules['password'] = ['nullable', 'string', 'min:8', 'max:16'];
    // }

    //return $rules;
  }
}
