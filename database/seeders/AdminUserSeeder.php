<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    private $user;

    public function __construct(User $user)
    {
        $this->user = $user;
    }
    
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $adminRole = Role::where('name', Role::ROLE_ADMIN)->first();
        $this->user->create([
            'surname' => 'Admin',
            'name' => 'Admin',
            'email' => config('admin.email'),
            'password' => Hash::make(config('admin.password')),
            'role_id' => $adminRole->id
        ]);
    }
}
