<?php

namespace App\Repositories\Interfaces;

use Illuminate\Http\Request;

interface UserRepositoryInterface
{
    public function getUsersList(Request $request);

    public function toggleAdminNotice(Request $request);
}