<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;

use App\Repositories\Interfaces\AuthRepositoryInterface as Repository;

class AuthController extends Controller
{
    public $repository;
    
    public function __construct(Repository $repository)
    {
        $this->repository = $repository;
    }

    public function login(LoginRequest $request)
    {
        return $this->repository->login($request);
    }

    public function profile(Request $request) {
        return $this->repository->profile($request);
    }

    public function logout(Request $request) 
    {
        return $this->repository->logout($request);
    }
}
