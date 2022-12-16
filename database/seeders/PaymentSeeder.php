<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PaymentSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('payments')->insert([
            [
                'id' => 1,
                'inisial' => 'COD',
                'nama_pembayaran' => 'Cost On Delivery (COD)',
                'no_rekening' => null,
                'image' => 'img_cod.png',
                'created_at' => today(),
                'updated_at' => today()
            ], [
                'id' => 2,
                'inisial' => 'BNI',
                'nama_pembayaran' => 'Transfer Bank BNI',
                'no_rekening' => '085746323432',
                'image' => 'img_bankid_bni@3x.png',
                'created_at' => today(),
                'updated_at' => today()
            ], [
                'id' => 3,
                'inisial' => 'BRI',
                'nama_pembayaran' => 'Transfer Bank BRI',
                'no_rekening' => '023534457567',
                'image' => 'img_bankid_bri@3x.png',
                'created_at' => today(),
                'updated_at' => today()
            ], [
                'id' => 4,
                'inisial' => 'BCA',
                'nama_pembayaran' => 'Transfer Bank BCA',
                'no_rekening' => '075632342345',
                'image' => 'img_bankid_bca@3x.png',
                'created_at' => today(),
                'updated_at' => today()
            ], [
                'id' => 5,
                'inisial' => 'MAN',
                'nama_pembayaran' => 'Transfer Bank MANDIRI',
                'no_rekening' => '076867567775',
                'image' => 'img_bankid_mandiri@3x.png',
                'created_at' => today(),
                'updated_at' => today()
            ], [
                'id' => 6,
                'inisial' => 'BSI',
                'nama_pembayaran' => 'Transfer Bank BSI',
                'no_rekening' => '085746323432',
                'image' => 'img_bankid_bsi@3x.png',
                'created_at' => today(),
                'updated_at' => today()
            ],
        ]);
    }
}
