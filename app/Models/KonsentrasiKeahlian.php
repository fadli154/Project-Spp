<?php

namespace App\Models;

use App\Models\Kelas;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class KonsentrasiKeahlian extends Model
{
    use HasFactory;

    protected $table = 'konsentrasi_keahlian';
    protected $guarded = [];

    public function kelas()
    {
        return $this->hasMany(Kelas::class, 'id_kk', 'id_kk');
    }
}
