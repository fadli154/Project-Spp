<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Biaya extends Model
{
    use HasFactory;
    protected $table = 'biaya';
    protected $guarded = [''];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function tagihanDetails()
    {
        return $this->hasMany(TagihanDetails::class, 'biaya_id', 'id');
    }
}
