<?php

namespace App\Http\Resources\user;
use App\Http\Resources\BaseCollection;

class UserCollection extends BaseCollection
{
    public function toArray($request)
    {
        return $this->map(function ($user) {
            return [
                'id'            => $user->id,
                'name'          => $user->name,
                'email'         => $user->email,
                'password'      => $user->password,
                'created_at'    => $user->created_at,
                'updated_at'    => $user->updated_at,
            ];
        });
    }
}
