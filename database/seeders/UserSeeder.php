<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    private function formatName($name) { return ucfirst($name); }
    private function get_email($name) { return $name . "@zoo.com"; }
    private function rand_phone() { return str_pad(rand(100000000, 999999999), 9, '0'); }
    private function get_avatar_path($name) { return "all_avatar/" . $name . "-avatar.png"; }

    public function run(): void
    {
        $users = ['alex', 'marty', 'gloria', 'melman', 
                  'skipper', 'rico', 'kowalski', 'cabo', 
                  'julien', 'mort', 'mason', 'maurice'];

        foreach ($users as $username) {
            User::create([
                'name'      => $this->formatName($username),
                'username'  => $username,
                'email'     => $this->get_email($username),
                'password'  => Hash::make('123'),
                'role'      => 'cliente',
                'phone'     => $this->rand_phone(),
                'avatar'    => $this->get_avatar_path($username),
            ]);
        }
    }
}
