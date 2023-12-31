<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaksi extends Model
{
    use HasFactory;

    protected $table = 'transaksis';

    protected $guarded = ["id"];

    public function detailkeranjang(){
        return $this->hasMany(DetailKeranjang::class,'transaksis_id');
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}
