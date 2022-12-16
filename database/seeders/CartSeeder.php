<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CartSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('carts')->insert([
            [
                'id' => 1,
                'user_id' => 1,
                'menu_id' => 3,
                'qty' => 1,
                'created_at' => today(),
                'updated_at' => today(),
            ], [
                'id' => 2,
                'user_id' => 2,
                'menu_id' => 4,
                'qty' => 2,
                'created_at' => today(),
                'updated_at' => today(),
            ]
        ]);
    }
}
