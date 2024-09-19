<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WithdrawGifts extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function gifts(){
        return $this->belongsTo(Gift::class, 'gift_id');
    }

    public function withdrawFunc(){
        return $this->belongsTo(Withdrawl::class, 'withdrawl_id');
    }
}
