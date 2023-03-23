<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WaliKelas extends Model
{
    use HasFactory;

    protected $table = 'pegawai';
    protected $guarded = [''];

    public function kelas()
    {
        return $this->hasOne(Kelas::class, 'nip_wali_kelas', 'nip_wali_kelas');
    }
}
