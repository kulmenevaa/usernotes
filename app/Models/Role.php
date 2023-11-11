<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;

    const ROLE_ADMIN = 'admin';
    const ROLE_USER = 'user';

    /**
     * Table associated with the model
     * @var string
     */
    protected $table = 'roles';

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
        'name',
    ];

    public $timestamps = false;

    public function users() 
    {
        return $this->hasMany(User::class);
    }
}
