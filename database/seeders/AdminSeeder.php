<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Admin;
use Illuminate\Database\Seeder;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $admin = Admin::create(['role' => Admin::roles()[random_int(0,1)]]);

        $userData = array_merge(User::factory()->make([
            'name' => 'Super Admin',
            'email' => 'admin@example.com'
        ])->toArray(), ['password' => bcrypt('password')]);

        $admin->user()->create($userData);
    }
}
