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
}
