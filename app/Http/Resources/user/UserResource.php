<?php

namespace App\Http\Resources\user;
use App\Http\Resources\BaseResource;

class UserResource extends BaseResource
{
    public function toArray($request)
    {
        return [
            'id'            => $this->id,
            'name'          => $this->name,
            'email'         => $this->email,
            'password'      => $this->password,
            'created_at'    => $this->created_at,
            'updated_at'    => $this->updated_at,
        ];
    }
}
