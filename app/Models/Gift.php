<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Gift extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function senderInfo(){
        return $this->belongsTo(Sender::class, 'sender');
    }

    
    public function user(){
        return $this->belongsTo(Sender::class, 'user_id');
    }
}
