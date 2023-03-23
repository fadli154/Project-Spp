<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\hasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Kelas extends Model
{
    use HasFactory;

    protected $table = 'kelas';
    protected $guarded = [''];

    public function konsentrasi()
    {
        return $this->hasMany(KonsentrasiKeahlian::class, 'id_kk', 'id_kk');
    }

    public function WaliKelas()
    {
        return $this->hasOne(WaliKelas::class, 'nip_wali_kelas', 'nip_wali_kelas');
    }
}
