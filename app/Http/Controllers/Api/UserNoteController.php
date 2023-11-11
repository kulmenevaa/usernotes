<?php

namespace App\Http\Controllers\Api;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\UserNoteRequest;
use App\Repositories\Interfaces\UserNoteRepositoryInterface as Repository;

class UserNoteController extends Controller
{
    public $repository;

    public function __construct(Repository $repository)
    {
        $this->middleware('auth:api');
        $this->repository = $repository;
    }

    public function share(UserNoteRequest $request) 
    {
        return $this->repository->share($request);
    }
}
