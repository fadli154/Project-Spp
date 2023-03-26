<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tagihan extends Model
{
    use HasFactory;
    protected $table = 'tagihan';
    protected $guarded = [''];
    protected $dates = ['tanggal_tagihan'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function siswa()
    {
        return $this->belongsTo(Siswa::class, 'nisn', 'nisn');
    }

    public function kelas()
    {
        return $this->hasMany(Kelas::class, 'kelas_id', 'kelas_id');
    }

    public function tagihanDetails()
    {
        return $this->hasMany(TagihanDetails::class, 'tagihan_id', 'id');
    }

    public function pembayaran()
    {
        return $this->hasMany(Pembayaran::class);
    }
}
