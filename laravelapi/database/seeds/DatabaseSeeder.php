<?php
    use App\User;
    use Illuminate\Database\Seeder;
    use Illuminate\Support\Facades\Hash;
    class DatabaseSeeder extends Seeder
    {
        public function run()
        {
            User::create([
            'name' => 'Admin Ganteng',
            'email' => 'admin@ganteng.com',
            'password' => Hash::make('admin1234'),
            'role' => 1
            ]);

            User::create([
            'name' => 'Member Biasa',
            'email' => 'member@biasa.com',
            'password' => Hash::make('member1234'),
            'role' => 2
            ]);
        }
    }