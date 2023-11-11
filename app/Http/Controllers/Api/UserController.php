<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Repositories\Interfaces\UserRepositoryInterface as Repository;

class UserController extends Controller
{
    public $repository;

    public function __construct(Repository $repository)
    {
        $this->middleware('auth:api');
        $this->repository = $repository;
    }
    
    public function index(Request $request)
    {
        return $this->repository->getUsersList($request);
    }

    public function toggleNotice(Request $request)
    {
        return $this->repository->toggleAdminNotice($request);
    }
}
