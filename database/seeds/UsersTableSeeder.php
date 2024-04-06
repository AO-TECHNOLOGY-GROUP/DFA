<?php

use App\Permission;
use App\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $superAdmin = User::create([
            'first_name' => 'Ephantus',
            'last_name' => 'Okumu',
            'email' => 'ephantokumu98@gmail.com',
            'phone_number' => '254713197824',
            'email_verified_at' => now(),
            'phone_verified_at' => now(),
            'password' => 'admin@123',
            'type' => 'super-admin',
            'creator_id' => 777,
            'verifier_id' => 777
        ]);

        $superAdmin->assignRole(['super-admin']);
        $superAdmin->givePermissionTo((Permission::all('name')->toArray()));

        $superAdmin = User::create([
            'first_name' => 'Isaac',
            'last_name' => 'Mungai',
            'email' => 'isaacmungaik97@gmail.com',
            'phone_number' => '254713197824',
            'email_verified_at' => now(),
            'phone_verified_at' => now(),
            'password' => 'admin@123',
            'type' => 'super-admin',
            'creator_id' => 777,
            'verifier_id' => 777
        ]);

        $superAdmin->assignRole(['super-admin']);
        $superAdmin->givePermissionTo((Permission::all('name')->toArray()));

        $admin = User::create([
            'first_name' => 'Ephantus',
            'last_name' => 'Okumu',
            'email' => 'ephantokumu98@outlook.com',
            'phone_number' => '254746254325',
            'email_verified_at' => now(),
            'phone_verified_at' => now(),
            'password' => 'admin@123',
            'type' => 'administrator',
            'creator_id' => 777,
            'verifier_id' => 777
        ]);

        $admin->assignRole(['administrator']);

    }
}
