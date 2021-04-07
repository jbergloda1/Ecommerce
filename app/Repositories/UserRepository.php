<?php

namespace App\Repositories;

use App\Models\User;
use App\Models\SessionUser;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Exceptions\UserUnauthorizedException;
use Config;


class UserRepository
{
    public function store($inputs)
    {
        return User::create([
            'name'      => $inputs['name'],
            'email'     => $inputs['email'],
            'password'  => Hash::make($inputs['password'])
        ]);
    }

    public function get()
    {
        return SessionUser::where('user_id', auth()->id())->first();
    }

    public function login($inputs)
    {
        return SessionUser::create([
            'token' => Str::random(40),
            'refresh_token' => Str::random(40),
            'token_expried' => date('Y-m-d H:i:s', strtotime('+30 day')),
            'refresh_token_expried' => date('Y-m-d H:i:s', strtotime('+360 day')),
            'user_id' =>auth()->id()
        ]);
    }
}
