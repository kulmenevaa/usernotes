<?php

namespace App\Repositories\Interfaces;

use Illuminate\Http\Request;
use App\Http\Requests\NoteRequest;

interface NoteRepositoryInterface
{
    public function getNotesList(Request $request);

    public function addNote(NoteRequest $request);

    public function updateNote(NoteRequest $request, $id);

    public function deleteNote(Request $request, $id);
}