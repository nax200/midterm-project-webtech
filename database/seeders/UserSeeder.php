<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::where('email','admin@example.com')->first();
        if (!$user) {
            $user = new User();
            $user->name = "Admin";
            $user->role = 'ADMIN';
            $user->email = "admin@example.com";
            $user->password = Hash::make('admin');
            $user->save();
        }

        $user = User::where('email','editor@example.com')->first();
        if (!$user) {
            $user = new User();
            $user->name = "Editor";
            $user->role =  'STAFF';
            $user->email = "editor@example.com";
            $user->password = Hash::make('editor');
            $user->save();
        }

        $user = User::where('email','user01@example.com')->first();
        if (!$user) {
            $user = new User();
            $user->name = "User01";
            $user->role = 'USER';
            $user->email = "user01@example.com";
            $user->password = Hash::make('user01');
            $user->save();
        }

        User::factory(5)->create();
    }
}
