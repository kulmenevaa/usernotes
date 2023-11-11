<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    private $role;

    public function __construct(Role $role)
    {
        $this->role = $role;
    }

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            $this->role::ROLE_ADMIN, 
            $this->role::ROLE_USER
        ];
        
        foreach($roles as $role) {
            $this->role->create(['name' => $role]);
        }
    }
}
