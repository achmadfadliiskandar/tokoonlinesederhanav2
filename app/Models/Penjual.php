<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Penjual extends Model
{
    use HasFactory;

    protected $table = 'penjuals';

    protected $fillable = ['user_id','namatoko','alamattoko','slug','bank_id','nomorrekening'];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function barang(){
        return $this->belongsTo(Barang::class);
    }
    public function DetailKeranjang(){
        return $this->hasMany(DetailKeranjang::class);
    }
}
