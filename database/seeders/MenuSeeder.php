<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('menus')->insert([
            [
                'id' => 1,
                'menu' => 'Bibit Pohon Kakao',
                'harga' => 8000,
                'desc' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Rem sunt tempora quae architecto quia numquam sapiente incidunt neque odit est consectetur ut veritatis eum voluptatibus, adipisci reiciendis minus? Eius, aperiam.',
                'image' => 'Kakao.jpg',
                'created_at' => today(),
                'updated_at' => today(),
            ], [
                'id' => 2,
                'menu' => 'Bibit Pohon Nangka',
                'harga' => 50000,
                'desc' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Rem sunt tempora quae architecto quia numquam sapiente incidunt neque odit est consectetur ut veritatis eum voluptatibus, adipisci reiciendis minus? Eius, aperiam.',
                'image' => 'Nangka.jpg',
                'created_at' => today(),
                'updated_at' => today(),
            ], [
                'id' => 3,
                'menu' => 'Bibit Pohon Durian',
                'harga' => 55000,
                'desc' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Rem sunt tempora quae architecto quia numquam sapiente incidunt neque odit est consectetur ut veritatis eum voluptatibus, adipisci reiciendis minus? Eius, aperiam.',
                'image' => 'Durian.jpg',
                'created_at' => today(),
                'updated_at' => today(),
            ], [
                'id' => 4,
                'menu' => 'Bibit Pohon Cengkeh',
                'harga' => 25000,
                'desc' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Rem sunt tempora quae architecto quia numquam sapiente incidunt neque odit est consectetur ut veritatis eum voluptatibus, adipisci reiciendis minus? Eius, aperiam.',
                'image' => 'Cengkeh.jpg',
                'created_at' => today(),
                'updated_at' => today(),
            ], [
                'id' => 5,
                'menu' => 'Bibit Pohon Pinang',
                'harga' => 40000,
                'desc' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Rem sunt tempora quae architecto quia numquam sapiente incidunt neque odit est consectetur ut veritatis eum voluptatibus, adipisci reiciendis minus? Eius, aperiam.',
                'image' => 'Pinang.jpg',
                'created_at' => today(),
                'updated_at' => today(),
            ], [
                'id' => 6,
                'menu' => 'Bibit Pohon Alpukat',
                'harga' => 15000,
                'desc' => 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Rem sunt tempora quae architecto quia numquam sapiente incidunt neque odit est consectetur ut veritatis eum voluptatibus, adipisci reiciendis minus? Eius, aperiam.',
                'image' => 'Alpukat.jpg',
                'created_at' => today(),
                'updated_at' => today(),
            ], 
        ]);
    }
}
