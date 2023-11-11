<?php

namespace App\Repositories;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Resources\UserResource;
use App\Repositories\Interfaces\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }
    
    /**
     * Get list of users
     * 
     * @param  mixed $request
     * @return void
     */
    public function getUsersList(Request $request)
    {
        $users = !$request->user()->isAdmin()
            ? $this->user->getByNotAdmin()
            : $this->user->all();

        return UserResource::collection($users);
    }

    /**
     * Toggle notice
     * 
     * @param  mixed $request
     * @return void
     */
    public function toggleAdminNotice(Request $request)
    {
        $user = $request->user();
        if ($user->isAdmin()) {
            $notice = $user->notice ? 0 : 1; 
            $setNotice = $user->update(['notice' => $notice]); 
            if ($setNotice) {
                return response()->json([
                    'message' => 'Статус получение уведомлений переключен на ' . ($notice ? 'вкл' : 'выкл')
                ], 200);
            }
        }
    }
}
