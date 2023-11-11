<?php

namespace App\Repositories;

use App\Models\Note;
use App\Events\AddNoteEvent;
use Illuminate\Http\Request;
use App\Http\Requests\NoteRequest;
use App\Http\Resources\NoteResource;
use App\Repositories\Interfaces\NoteRepositoryInterface;

class NoteRepository implements NoteRepositoryInterface
{
    private $note;
    
    public function __construct(Note $note)
    {
        $this->note = $note;
    }

    /**
     * Get list of notes
     * 
     * @param  mixed $request
     * @return void
     */
    public function getNotesList(Request $request)
    {
        $notes = !$request->user()->isAdmin()
            ? $request->user()->notes
            : $this->note->getLatest();
       
        return NoteResource::collection($notes);
    }
    
    /**
     * Creating a note
     * 
     * @param  mixed $request
     * @return void
     */
    public function addNote(NoteRequest $request)
    {
        $created = $this->note->create($request->all());
        $created->users()->attach(auth()->user()); 

        event(new AddNoteEvent($created));

        if($created) {
            return response()->json([
                'message'  => 'Заметка добавлена', 
                'data' => new NoteResource($created)
            ], 200);
        } 
        return response()->json([
            'message' => 'Произошла ошибка'
        ], 500);
    }

    /**
     * Note update
     * 
     * @param  mixed $request
     * @return void
     */
    public function updateNote(NoteRequest $request, $id)
    {
        $data = $request->all();
        $data['updated_at'] = date('d.m.Y H:i:s');
        
        $note = $this->note->where('id', $id)->firstOrFail();

        if($note->update($data)) {
            return response()->json([
                'message'  => 'Заметка изменена', 
                'data' => new NoteResource($note)
            ], 200);
        }
        return response()->json([
            'message' => 'Произошла ошибка'
        ], 500);
    }

    /**
     * Deleting a note
     * 
     * @param  mixed $request
     * @return void
     */
    public function deleteNote(Request $request, $id)
    {
        $note = $this->note->where('id', $id)->firstOrFail();

        if ($request->user()->isAdmin() && $note->delete()) {
            return response()->json([
                'message' => 'Заметка удалена из системы'
            ], 200);
        } 

        if ($note->users()->detach(auth()->user())) {
            return response()->json([
                'message' => 'Заметка удалена'
            ], 200);
        }
        
        return response()->json([
            'message' => 'Произошла ошибка'
        ], 500);
    }
}