<?php

use App\Admin;
use App\State;
use App\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /*factory(App\TypeProduct::class, 5)->create();

        factory(App\Product::class, 15)->create();

        State::create([
            'name' => 'A preparer'
        ]);
        State::create([
            'name' => 'Expedier'
        ]);

        User::create([
            'name' => 'yan',
            'email' => 'yan@yan.com',
            'password' => bcrypt('123456')
        ]);*/

        Admin::create([
            'name' => 'admin',
            'password' => bcrypt('admin'),
        ]);
    }
}
