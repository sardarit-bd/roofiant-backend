<?php

namespace App\Modules\Auth\Services;

use App\Models\User;
use App\Modules\Auth\DTOs\LoginDTO;
use App\Modules\Auth\DTOs\RegisterDTO;
use App\Modules\Auth\DTOs\ChangePasswordDTO;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;

class AuthService
{

    public function register(RegisterDTO $dto): array
    {
        // if ($dto->secret_key !== config('auth.admin_secret_key')) {
        //     throw ValidationException::withMessages([
        //         'secret_key' => ['Invalid secret key.'],
        //     ]);
        // }

        $user = User::create([
            'name'     => $dto->name,
            'email'    => $dto->email,
            'password' => Hash::make($dto->password),
            'role'     => 'admin',
        ]);

        $token = $user->createToken('admin-token')->plainTextToken;

        return [
            'user'  => $user,
            'token' => $token,
        ];
    }


    public function login(LoginDTO $dto): array
    {
        $user = User::where('email', $dto->email)->first();

        if (! $user || ! Hash::check($dto->password, $user->password)) {
            throw ValidationException::withMessages([
                'email' => ['The provided credentials are incorrect.'],
            ]);
        }

        if ($user->role !== 'admin') {
            throw ValidationException::withMessages([
                'email' => ['You do not have admin access.'],
            ]);
        }

        $token = $user->createToken('admin-token')->plainTextToken;

        return [
            'user'  => $user,
            'token' => $token,
        ];
    }


    public function logout(User $user): void
    {
        $user->currentAccessToken()->delete();
    }


    public function profile(User $user): User
    {
        return $user;
    }


    public function ChangePassword(User $user, ChangePasswordDTO $dto): User
    {
        if (! Hash::check($dto->current_password, $user->password)) {
            throw ValidationException::withMessages([
                'current_password' => ['Current password is incorrect.'],
            ]);
        }

        $user->update([
            'password' => Hash::make($dto->password),
        ]);

        return $user->fresh();
    }
}
