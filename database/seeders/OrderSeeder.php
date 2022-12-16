<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

use Carbon\Carbon;

class OrderSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('orders')->insert([
            [
                'id' => preg_replace('/[\s]/', "BNI", preg_replace('/[-:].*/', '', Carbon::now()->toDateTimeString())) . strtoupper(explode('-', Str::uuid())[0]),
                'user_id' => 1,
                'nama_penerima' => 'Saren',
                'telp_penerima' => '080808',
                'alamat_penerima' => 'Jl. Ekor Koto',
                'waktu_kirim' => Carbon::now('Asia/Jakarta'),
                'pesanan' => json_encode([
                    [
                        'menu_id' => 11,
                        'qty' => 4
                    ], [
                        'menu_id' => 3,
                        'qty' => 3
                    ],
                ]),
                'type_pembayaran' => 'BNI',
                'type_pengiriman' => 'delivered',
                'kadaluarsa' => Carbon::now('Asia/Jakarta')->subDays(-1),
                'bukti_pembayaran' => 'contoh_struct.png',
                'status' => 'done',
                'created_at' => Carbon::now('Asia/Jakarta')->subDays(-1),
                'updated_at' => today(),
            ], [
                'id' => preg_replace('/[\s]/', "COD", preg_replace('/[-:].*/', '', Carbon::now()->toDateTimeString())) . strtoupper(explode('-', Str::uuid())[0]),
                'user_id' => 2,
                'nama_penerima' => 'Akun Member',
                'telp_penerima' => '234235',
                'alamat_penerima' => 'Jl. Koto Ekor',
                'waktu_kirim' => Carbon::now('Asia/Jakarta')->subDays(-2),
                'pesanan' => json_encode([
                    [
                        'menu_id' => 11,
                        'qty' => 4
                    ], [
                        'menu_id' => 3,
                        'qty' => 3
                    ],
                ]),
                'type_pembayaran' => 'COD',
                'type_pengiriman' => 'delivered',
                'kadaluarsa' => Carbon::now('Asia/Jakarta')->subDays(-3),
                'bukti_pembayaran' => null,
                'status' => 'ontrack',
                'created_at' => Carbon::now('Asia/Jakarta')->subDays(-2),
                'updated_at' => today(),
            ], [
                'id' => preg_replace('/[\s]/', "BRI", preg_replace('/[-:].*/', '', Carbon::now()->toDateTimeString())) . strtoupper(explode('-', Str::uuid())[0]),
                'user_id' => 3,
                'nama_penerima' => 'Sulai',
                'telp_penerima' => '433464574',
                'alamat_penerima' => 'Jl. Jalan yuk',
                'waktu_kirim' => Carbon::now('Asia/Jakarta')->subDays(-4),
                'pesanan' => json_encode([
                    [
                        'menu_id' => 11,
                        'qty' => 4
                    ], [
                        'menu_id' => 3,
                        'qty' => 3
                    ],
                ]),
                'type_pembayaran' => 'BRI',
                'type_pengiriman' => 'yourself',
                'kadaluarsa' => Carbon::now('Asia/Jakarta')->subDays(-5),
                'bukti_pembayaran' => 'contoh_struct.png',
                'status' => 'arrived',
                'created_at' => Carbon::now('Asia/Jakarta')->subDays(-4),
                'updated_at' => today(),
            ], [
                'id' => preg_replace('/[\s]/', "BCA", preg_replace('/[-:].*/', '', Carbon::now()->toDateTimeString())) . strtoupper(explode('-', Str::uuid())[0]),
                'user_id' => 4,
                'nama_penerima' => 'Edo',
                'telp_penerima' => '34635745856',
                'alamat_penerima' => 'Jl. Jalan yuk',
                'waktu_kirim' => Carbon::now('Asia/Jakarta')->subDays(-4),
                'pesanan' => json_encode([
                    [
                        'menu_id' => 11,
                        'qty' => 4
                    ], [
                        'menu_id' => 3,
                        'qty' => 3
                    ],
                ]),
                'type_pembayaran' => 'BCA',
                'type_pengiriman' => 'delivered',
                'kadaluarsa' => Carbon::now('Asia/Jakarta')->subDays(-5),
                'bukti_pembayaran' => 'contoh_struct.png',
                'status' => 'unpaid',
                'created_at' => Carbon::now('Asia/Jakarta')->subDays(-4),
                'updated_at' => today(),
            ], [
                'id' => preg_replace('/[\s]/', "MAN", preg_replace('/[-:].*/', '', Carbon::now()->toDateTimeString())) . strtoupper(explode('-', Str::uuid())[0]),
                'user_id' => 5,
                'nama_penerima' => 'Suhu',
                'telp_penerima' => '343252352',
                'alamat_penerima' => 'Jl. Jalan yuk',
                'waktu_kirim' => Carbon::now('Asia/Jakarta')->subDays(-6),
                'pesanan' => json_encode([
                    [
                        'menu_id' => 11,
                        'qty' => 4
                    ], [
                        'menu_id' => 3,
                        'qty' => 3
                    ],
                ]),
                'type_pembayaran' => 'MAN',
                'type_pengiriman' => 'yourself',
                'kadaluarsa' => Carbon::now('Asia/Jakarta')->subDays(-7),
                'bukti_pembayaran' => 'contoh_struct.png',
                'status' => 'unpaid',
                'created_at' => Carbon::now('Asia/Jakarta')->subDays(-6),
                'updated_at' => today(),
            ]
        ]);
    }
}
