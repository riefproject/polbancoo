<?php

namespace App\Http\Requests\SuperAdmin;

use Illuminate\Foundation\Http\FormRequest;

class UpdateAdminRequest extends FormRequest
{
    public function authorize()
    {
        $user = auth('web')->user();

        return $user && $user->hasAnyRole(['Super Admin']);
    }

    public function rules()
    {
        $userId = $this->route('admin');

        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $userId,
            'password' => 'nullable|min:8|confirmed',
        ];
    }
}