<?php

use Illuminate\Database\Seeder;
use App\User;
use Spatie\Permission\Models\Role;
class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user=User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('123456789'),
        ]);
        $role = Role::create(['name' => 'Admin']);
        $user->assignRole('Admin');


        $user=User::create([
            'name' => 'Asesor',
            'email' => 'user@user.com',
            'password' => Hash::make('123456789'),
        ]);
        $role = Role::create(['name' => 'User']);
        $user->assignRole('User');


    }
}
