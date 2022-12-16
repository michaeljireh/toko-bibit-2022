<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('statuses')->insert([
            [
                'id' => 1,
                'inisial' => 'unpaid',
                'nama_status' => 'Belum Bayar',
                'created_at' => today(),
                'updated_at' => today()
            ], [
                'id' => 2,
                'inisial' => 'ontrack',
                'nama_status' => 'Sedang di Antar',
                'created_at' => today(),
                'updated_at' => today()
            ], [
                'id' => 3,
                'inisial' => 'arrived',
                'nama_status' => 'Telah Tiba Di Tempat',
                'created_at' => today(),
                'updated_at' => today()
            ], [
                'id' => 4,
                'inisial' => 'done',
                'nama_status' => 'Orderan Telah Selesai',
                'created_at' => today(),
                'updated_at' => today()
            ]
        ]);
    }
}
