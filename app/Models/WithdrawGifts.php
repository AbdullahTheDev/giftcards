<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WithdrawGifts extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function gifts(){
        return $this->belongsTo(Gift::class);
    }

    public function withdraw(){
        return $this->belongsTo(Withdrawl::class);
    }
}
