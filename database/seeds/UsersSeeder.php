<?php

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;

class UsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       // User::truncate();
        $user = User::create([
            'name'     => 'Admin',
            'email'    => 'admin@admin.com',
            'password' => bcrypt('admin'),
            'role_id'  => Role::find(1)->id,
        ]);

    }
}
