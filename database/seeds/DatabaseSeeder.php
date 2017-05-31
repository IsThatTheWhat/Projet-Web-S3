<?php

use App\Admin;
use App\Product;
use App\State;
use App\TypeProduct;
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

        factory(App\Product::class, 15)->create();*/
        Admin::create([
            'name' => 'admin',
            'password' => bcrypt('admin'),
        ]);

        User::create([
            'name' => 'yan',
            'email' => 'yan@yan.com',
            'password' => bcrypt('123456')
        ]);

        State::create([
            'name' => 'A preparer'
        ]);
        State::create([
            'name' => 'Expedier'
        ]);

        $coupe = TypeProduct::create(['name' => 'Coupe']);
        $sport = TypeProduct::create(['name' => 'Sport']);
        $electric = TypeProduct::create(['name' => 'Electric']);
        $suv = TypeProduct::create(['name' => 'Suv']);

        Product::create([
           'name' => 'Volkswagen - Scirocco',
            'price' => 50000,
            'photo' => 'scirocco.jpg',
            'available' => true,
            'stock' => 10,
            'type_id' => $coupe->id,
        ]);
        Product::create([
           'name' => 'Audi - S5',
            'price' => 80000,
            'photo' => 'audi-s5.jpg',
            'available' => true,
            'stock' => 10,
            'type_id' => $coupe->id,
        ]);

        Product::create([
           'name' => 'Mclaren - P1',
            'price' => 1200000,
            'photo' => 'mclaren-p1.jpg',
            'available' => true,
            'stock' => 3,
            'type_id' => $sport->id,
        ]);
        Product::create([
           'name' => 'Lamborghini - Murcielago',
            'price' => 1300000,
            'photo' => 'lambo-murcielago.jpg',
            'available' => true,
            'stock' => 3,
            'type_id' => $sport->id,
        ]);

        Product::create([
           'name' => 'Tesla - Model S',
            'price' => 75000,
            'photo' => 'tesla-s.jpg',
            'available' => true,
            'stock' => 5,
            'type_id' => $electric->id,
        ]);
        Product::create([
           'name' => 'Tesla - Model 3',
            'price' => 70000,
            'photo' => 'tesla-3.jpg',
            'available' => true,
            'stock' => 5,
            'type_id' => $electric->id,
        ]);

        Product::create([
           'name' => 'Peugeot - 5008',
            'price' => 30000,
            'photo' => 'peugeot-5008.jpg',
            'available' => true,
            'stock' => 5,
            'type_id' => $suv->id,
        ]);
        Product::create([
           'name' => 'Jeep',
            'price' => 55000,
            'photo' => 'jeep.jpg',
            'available' => true,
            'stock' => 5,
            'type_id' => $suv->id,
        ]);
    }
}
