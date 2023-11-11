<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * Table associated with the model
     * @var string
     */
    protected $table = 'users';

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
        'surname',
        'name', 
        'email', 
        'password',
        'role_id',
        'notice'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function scopeGetUserByEmail(Builder $query, $email)
    {
        return $query->where('email', $email)->firstOrFail();
    }

    /**
     * Full name user
     */
    public function getFio(): string
    {
        return trim($this->surname.' '.$this->name.' '.$this->patronymic);
    }

    /**
     * Check if the user has role admin
     */
    public static function isAdmin(): bool
    {
        return self::whereHas('role', fn ($query) => $query->where('name', Role::ROLE_ADMIN))
            ->where('id', auth()->user()->id)
            ->first() ? true : false;
    }

    public static function isAdminList()
    {
        return self::whereHas('role', fn($query) => $query->where('name', Role::ROLE_ADMIN))->where('notice', 1)->get();
    }

    public static function getByNotAdmin(): object
    {
        return self::whereHas('role', function ($query) {
            $query->where('name', Role::ROLE_USER);
        })->where('id', '!=', auth()->user()->id)->get();
    }

    public function scopeGetIdsByInID(Builder $query, $ids): object
    {
        return $query->whereIn('id', $ids)->get()->pluck('id');
    }

    public function notes()
    {
        return $this->belongsToMany(Note::class, 'user_notes', 'user_id', 'note_id')->latest('created_at');
    }

    public function role()
    {
        return $this->belongsTo(Role::class);
    }

}
