<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Note extends Model
{
    use HasFactory;

    /**
     * Table associated with the model
     * @var string
     */
    protected $table = 'notes';

    /**
     * Primary key column name
     * @var string
     */
    protected $primaryKey = 'id';

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'description'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_notes', 'note_id', 'user_id');
    }

    public function scopeGetByID(Builder $query, $id)
    {
        return $query->where('id', $id)->first();
    }

    public static function getLatest(): object
    {
        return self::latest('created_at')->get();
    }
}
