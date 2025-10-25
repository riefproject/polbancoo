<?php

namespace App\Http\Requests\SuperAdmin;

use Illuminate\Foundation\Http\FormRequest;

class StoreAdminRequest extends FormRequest
{
    public function authorize()
    {
        $user = auth('web')->user();

        logger()->info('StoreAdminRequest authorize', [
            'user_id' => $user?->id,
            'user_roles' => $user?->roles->pluck('name')->toArray(),
            'is_super_admin' => $user?->hasAnyRole(['Super Admin']),
        ]);

        return auth('web')->check() && $user->hasAnyRole(['Super Admin']);
    }

    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|min:8|confirmed',
        ];
    }
}