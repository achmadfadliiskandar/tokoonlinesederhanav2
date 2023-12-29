<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailKeranjang extends Model
{
    use HasFactory;

    protected $table = 'detailkeranjangs';

    protected $guarded = ["id"];

    public function barang(){
        return $this->belongsTo(Barang::class,'barangs_id');
    }
    public function transaksi(){
        return $this->belongsTo(Transaksi::class);
    }
}
