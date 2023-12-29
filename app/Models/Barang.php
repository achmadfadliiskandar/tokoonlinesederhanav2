<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    protected $table = 'barangs';

    protected $fillable = ['namaproduk','gambar','stok','hargabarang','stokbarang','penjual_id','user_id'];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function penjual(){
        return $this->belongsTo(Penjual::class);
    }
    public function kategori(){
        return $this->belongsTo(Kategori::class,'kategories_id');
    }
    public function keranjang(){
        return $this->hasOne(Keranjang::class);
    }
    public function detailkeranjang(){
        return $this->hasMany(Detailkeranjang::class);
    }
}
