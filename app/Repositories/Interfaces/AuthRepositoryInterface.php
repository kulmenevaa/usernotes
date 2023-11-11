<?php

namespace App\Repositories\Interfaces;

use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;

interface AuthRepositoryInterface
{
    public function login(LoginRequest $request);

    public function logout(Request $request);

    public function profile(Request $request);
}