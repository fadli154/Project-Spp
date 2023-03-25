<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;

    protected $table = 'pembayaran';
    protected $guarded = [''];
    protected $dates = ['tanggal_bayar'];


    public function tagihan()
    {
        return $this->belongsTo(Tagihan::class);
    }
}
