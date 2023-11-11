<?php

namespace App\Repositories;

use App\Models\Note;
use App\Models\User;
use App\Http\Requests\UserNoteRequest;
use App\Repositories\Interfaces\UserNoteRepositoryInterface;

class UserNoteRepository implements UserNoteRepositoryInterface
{
    private $note;
    private $user;

    public function __construct(Note $note, User $user)
    {
        $this->note = $note;
        $this->user = $user;
    }

    /**
     * Share a note with a user
     *
     * @param  mixed $request
     * @return void
     */
    public function share(UserNoteRequest $request)
    {
        $usersShare = explode(',', $request->usersShare);
        
        $note = $this->note->getByID($request->noteID);
        $users = $this->user->getIdsByInID($usersShare);

        $sync = $note->users()->syncWithoutDetaching($users);
        if ($sync) {
            return response()->json([
                'message' => 'Вы поделились заметкой'
            ], 200);
        }
        return response()->json([
            'message' => 'Произошла непредвиденная ошибка'
        ], 500);
    }
}