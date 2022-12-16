<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public $incrementing = false;

    protected $fillable = [
        'id',
        'user_id',
        'nama_penerima',
        'telp_penerima',
        'alamat_penerima',
        'waktu_kirim',
        'pesanan',
        'type_pembayaran',
        'type_pengiriman',
        'kadaluarsa',
        'bukti_pembayaran',
        'status'
    ];
}
