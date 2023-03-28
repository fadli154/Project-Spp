<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TagihanDetails extends Model
{
    use HasFactory;
    protected $table = 'tagihan_details';
    protected $guarded = [''];
    protected $with = ['tagihan'];

    public function tagihan()
    {
        return $this->belongsTo(Tagihan::class);
    }

    public function biaya()
    {
        return $this->belongsTo(Biaya::class);
    }
}
