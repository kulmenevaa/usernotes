<?php

namespace App\Repositories\Interfaces;

use App\Http\Requests\UserNoteRequest;

interface UserNoteRepositoryInterface
{
    public function share(UserNoteRequest $request);
}