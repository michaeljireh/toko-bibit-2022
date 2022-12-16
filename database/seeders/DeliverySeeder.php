<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DeliverySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('deliveries')->insert([
            [
                'id' => 1,
                'inisial' => 'yourself',
                'nama_pengiriman' => 'Ambil Sendiri',
                'created_at' => today(),
                'updated_at' => today()
            ], [
                'id' => 2,
                'inisial' => 'delivered',
                'nama_pengiriman' => 'Di Antar Ke Tempat',
                'created_at' => today(),
                'updated_at' => today()
            ]
        ]);
    }
}
