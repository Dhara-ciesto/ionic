<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserPostRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        if($this->edit) {
            return [
                'username' => 'required|alpha_dash',
                'email'    => 'required|email|unique:users,email,' . $this->edit,
                'role'  => 'required',
                'password' => ($this->password != null ? 'required|confirmed' : ''),
            ];
        } else {
            return [
                'username' => 'required|alpha_dash',
                'email'    => 'required|email|unique:users,email',
                'role'  => 'required',
                'password' => 'required|confirmed',
            ];

        }
    }
}
