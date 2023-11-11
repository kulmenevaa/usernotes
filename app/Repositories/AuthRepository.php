<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Requests\LoginRequest;
use App\Http\Resources\UserResource;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Repositories\Interfaces\AuthRepositoryInterface;


class AuthRepository implements AuthRepositoryInterface
{
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }
    
    /**
     * User authorization
     *
     * @param  mixed $request
     * @return void
     */
    public function login(LoginRequest $request)
    {
        $userByEmail = $this->user->getUserByEmail($request->email);
        if (!$userByEmail || !Hash::check($request->password, $userByEmail->password)) {
            return response()->json([
                'message' => 'Неверный email или пароль'
            ], 401);
        } 
        
        if (Auth::attempt($request->only(['email', 'password']))) {
            // можно $user = auth()->user() , но ругается IDE
            $user = $request->user();
            $permissions = self::setPermissions($user->role->name);
            $tokenData = $user->createToken($user->email.'-'.now(), $permissions);
            $token = $tokenData->token;
            
            if ($token->save()) {
                return response()->json([
                    'message' => 'Вы успешно авторизованы!',
                    'token' => $tokenData->accessToken
                ], 200);
            } 
        }
        return response()->json([
            'message' => 'Произошла непредвиденная ошибка'
        ], 500);
    }

    /**
     * Setting user rights
     *
     * @param  mixed $role
     * @return void
     */
    private function setPermissions($role) {
        switch ($role) {
            case 'admin':
                return ['user', 'admin'];
                break;
            case 'user':
                return ['user'];
                break;
        }
    }

    /**
     * User profile
     *
     * @param  mixed $request
     * @return void
     */
    public function profile(Request $request) {
        if ($user = $request->user()) {
            return response()->json(new UserResource($user), 200);
        }
        return response()->json([
            'message' => 'Произошла непредвиденная ошибка'
        ], 500);
    }

    /**
     * User logout
     *
     * @param  mixed $request
     * @return void
     */
    public function logout(Request $request)
    {
        $request->user()->token()->revoke();
        return response()->json([
            'message' => 'Вы успешно вышли из системы!',
        ], 200);
    }
}