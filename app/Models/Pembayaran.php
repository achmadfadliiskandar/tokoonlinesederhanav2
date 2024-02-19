<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pembayaran extends Model
{
    use HasFactory;

    protected $table = 'pembayarans';

    protected $guarded = ["id"];

    public function kurir(){
        return $this->belongsTo(Kurir::class,'kurirs_id');
    }
}
