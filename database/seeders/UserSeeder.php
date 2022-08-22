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

        $user = User::where('email','roserin@example.com')->first();
        if (!$user) {
            $user = new User();
            $user->name = "Roserin";
            $user->role =  'STAFF';
            $user->email = "roserin@example.com";
            $user->password = Hash::make('roserin');
            $user->agency = "University";
//            <option value="Registrar">Registrar</option>
//            <option value="University">University</option>
//            <option value="Science Faculty">Science Faculty</option>
//            <option value="Other agencies">Other agencies</option>
            $user->save();
        }

        $user = User::where('email','science@example.com')->first();
        if (!$user) {
            $user = new User();
            $user->name = "Science";
            $user->role =  'STAFF';
            $user->email = "science@example.com";
            $user->password = Hash::make('science');
            $user->agency = "Science Faculty";
//            <option value="Registrar">Registrar</option>
//            <option value="University">University</option>
//            <option value="Science Faculty">Science Faculty</option>
//            <option value="Other agencies">Other agencies</option>
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

        $user = User::where('email','user02@example.com')->first();
        if (!$user) {
            $user = new User();
            $user->name = "User02";
            $user->role = 'USER';
            $user->email = "user02@example.com";
            $user->password = Hash::make('user02');
            $user->save();
        }

        User::factory(5)->create();
    }
}
