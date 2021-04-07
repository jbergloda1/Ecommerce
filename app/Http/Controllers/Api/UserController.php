<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Repositories\UserRepository;
use App\Http\Requests\UserRequest;
use App\Http\Requests\LoginRequest;
use App\Http\Resources\user\UserCollection;
use App\Http\Resources\user\UserResource;
use App\Http\Resources\user\SessionUserResource;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;

class UserController extends Controller
{

    private $userRepository;

    public function __construct(UserRepository $userRepository)
    {
        $this->userRepository = $userRepository;
    }

    public function store(UserRequest $request)
    {
        return new UserResource($this->userRepository->store($request->storeFilter()));
    }

    public function login(LoginRequest $request)
    {
        $datacheckLogin = [
            'email' => $request->email,
            'password' => $request->password
        ];
        if(Auth::attempt($datacheckLogin)){
            $checkTokenExit = $this->userRepository->get();
            if(empty($checkTokenExit)){
                $userSession = new SessionUserResource($this->userRepository->login($request->filter()));
                return $userSession;
            }else{
                $userSession = $checkTokenExit;
                return $userSession;
            } 
        }
    }
}
