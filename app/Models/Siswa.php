<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Siswa extends Model
{
    use HasFactory;

    protected $table = 'siswa';
    protected $guarded = [];

    public function user()
    {
        return $this->hasOne(User::class, 'id', 'wali_id')->withDefault(
            [
                'wali_id' => 'belum',
            ]
        );
    }

    public function kelas()
    {
        return $this->belongsTo(Kelas::class, 'kelas_id', 'kelas_id');
    }

    public function tagihan()
    {
        return $this->hasOne(tagihan::class, 'kelas_id', 'kelas_id');
    }
}
