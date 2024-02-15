<?php

namespace App\Http\Controllers\penjual;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Penjual;
use App\Models\Barang;
use App\Models\Kategori;
use App\Models\Bank;
use App\Models\Transaksi;
use App\Models\DetailKeranjang;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Str;

class PenjualController extends Controller
{
    // ini untuk percobaan sekarang
    public function penjual(){
        return view('penjual.index');
    }
    public function penjualprofile(){
        $users = User::where("id",Auth::user()->id)->get();
        // foreach ($users as $key => $value) {
        //     $namaadmin = $value->name;
        //     $emailadmin = $value->email;
        //     $alamatadmin = $value->alamat;
        // }
        return view("penjual.profile",compact('users'));
        // dd($users["id"]);
    }
    // end now
    public function penjualchangeprofile(Request $request,$id){
        // dd("debug dulu/trashing");
        $users = User::findOrFail($id);
        $users->name = $request->name;
        $users->email = $request->email;
        $users->nomorhp = $request->nomorhp;
        $users->alamat = $request->alamat;
        $users->save();
        return back()->with('status','data profile berhasil diganti');
    }

    // data usaha penjual
    public function penjualusaha(){
        $users = User::where("id",Auth::user()->id)->get();
        $penjuals = Penjual::where("user_id",Auth::user()->id)->get();
        $banks = Bank::all();
        return view('penjual.datausaha',compact('users','penjuals','banks'));
    }
    // data kirim formulir penjual
    public function penjualformulirsubmit(Request $request,$id){
        $user = User::where("role",Auth::user()->role)->get();
        $penjual = Penjual::where("user_id",Auth::user()->id)->count();
        if ($user && $penjual == 0) {
            $penjualans = new Penjual;
            $penjualans->namatoko = $request->namatoko;
            $penjualans->user_id = Auth::user()->id;
            $penjualans->alamattoko = $request->alamattoko;
            $penjualans->kodepos = $request->kodepos;
            $penjualans->slug = Str::slug($request->namatoko);
            $penjualans->bank_id = $request->bank_id;
            $penjualans->nomorrekening = $request->nomorrekening;
            $penjualans->cabangtoko = $request->cabangtoko;
            $penjualans->modaltoko = $request->modaltoko;
            $penjualans->tahunbuka = $request->tahunbuka;
            if ($request->hasfile('photo')) {
                $file = $request->file('photo');
                $exstension = $file->getClientOriginalExtension();
                $filename = time().'.'.$exstension;
                $file->move('photousaha/',$filename);
                $penjualans->photo = $filename;
            }
            $penjualans->save();
            return back()->with('status','selamat data usaha anda berhasil ditambahkan');
        }else{
            Penjual::where('user_id',Auth::user()->id)->update([
                'namatoko'=>$request->namatoko,
                'alamattoko'=>$request->alamattoko,
                'kodepos'=>$request->kodepos,
                'cabangtoko'=>$request->cabangtoko,
                'bank_id' => $request->bank_id,
                'nomorrekening' => $request->nomorrekening,
                'modaltoko'=>$request->modaltoko,
                'slug' => Str::slug($request->namatoko),
                'tahunbuka'=>$request->tahunbuka,
            ]);
            return back()->with('status','selamat data usaha anda berhasil diubah');
            // dd("tidak kosong");
        }
    }
    // khusus untuk menambahkan logo pada usaha
    public function penjualgambarusaha(){
        $users = User::where("id",Auth::user()->id)->get();
        $penjuals = Penjual::where("user_id",Auth::user()->id)->get();
        return view('penjual/gambarusaha',compact('users','penjuals'));
    }
    // untuk mengelola gambar yang diambil/diinput
    public function penjualupgambar(Request $request,$id){
        $validated = $request->validate([
            'photo' => 'required|mimes:png,jpg,jpeg'
        ]);
        $penjualgmbr = Penjual::find($id);
        if ($penjualgmbr->photo == null) {
            if ($request->hasfile('photo')) {
                $tujuan = 'photousaha/'.$penjualgmbr->photo;
                $file = $request->file('photo');
                $ekstensi = $file->getClientOriginalExtension();
                $filenames = time().'.'.$ekstensi;
                $file->move('photousaha/',$filenames);
                $penjualgmbr->photo = $filenames;
                $penjualgmbr->update();
            }else{
                if ($request->hasfile('photo')) {
                    $tujuan = 'photousaha/'.$penjualgmbr->photo;
                    if (File::exists($tujuan)) {
                        File::delete($tujuan);
                    }
                    $file = $request->file('photo');
                    $ekstensi = $file->getClientOriginalExtension();
                    $filenames = time().'.'.$ekstensi;
                    $file->move('photousaha/',$filenames);
                    $penjualgmbr->photo = $filenames;
                }
                $penjualgmbr->update();
            }
        }
        return back()->with('status','selamat logo anda sudah diedit/ditambahkan');
    }
    // end
    public function penjualchangepwd(){
        return view('penjual/penjualchangepwd');
    }
    public function penjualchpwd(Request $request){
        // dd($request->all());
        $validated = $request->validate([
            'passwordlama' => 'required|max:8',
            'passwordbaru' => 'required|max:8',
            'konfirmasipassword'=>'required'
        ]);
        $datalama = $request->passwordlama;
        $databaru = $request->passwordbaru;
        $konfirmasipwd = $request->konfirmasipassword;
        $check = Hash::check($datalama,Auth::user()->password);
        if ($check) {
            if ($datalama == $databaru) {
                return redirect("penjualchangepwd")->with('error','password baru dan lama tidak boleh sama ya');
            }
            else if($databaru != $konfirmasipwd){
                return redirect("penjualchangepwd")->with('error','password baru dan konfirmasi password harus sama ya');
            }else{
                $uactive = Auth::user()->id;
                $user = User::findOrFail($uactive);
                $user->password = Hash::make($databaru);
                $user->save();
                return redirect("penjualchangepwd")->with('status','password berhasil diubah');
            }
        } else {
            return redirect("penjualchangepwd")->with('error','password lama harus sesuai dengan sebelumnya');
        }
    }
    public function penjualbarang(){
        $barangs = Barang::where('user_id',Auth::user()->id)->get();
        return view('penjual/barang/index',compact('barangs'));
    }
    public function penjualaddbarang(){
        $penjual = Penjual::where('user_id',Auth::user()->id)->count();
        $url = 'datausahapenjual/'.Auth::user()->id.'/'.Auth::user()->name;
        $kategoris = Kategori::all();
        if ($penjual == 0) {
            return redirect($url)->with('teguran','Bikin dulu usahanya bro/sis');
        } else {
            return view('penjual/barang/create',compact('kategoris'));
        }
        
    }
    public function penjualstorebarang(Request $request){
        $userac = Penjual::where('user_id',Auth::user()->id)->get();
        foreach ($userac as $value) {
            $i =  $value->id;
        }
        $validated = $request->validate([
            'namaproduk' => 'required',
            'hargabarang' => 'required|numeric',
            'stokbarang' => 'required|numeric',
            'kategories_id'=>'required',
            'gambar' => 'required|mimes:jpg,png,jpeg,PNG',
        ]);
        $barang = new Barang;
        $barang->namaproduk = $request->namaproduk;
        $barang->slug = Str::slug($request->namaproduk);
        $barang->hargabarang = $request->hargabarang;
        $barang->stokbarang = $request->stokbarang;
        $barang->penjual_id = $i;
        $barang->kategories_id = $request->kategories_id;
        $barang->kondisibarang = $request->kondisibarang;
        $barang->user_id = Auth::user()->id;
        if ($request->hasfile('gambar')) {
            $file = $request->file('gambar');
            $exstensioname = $file->getClientOriginalName();
            $exstension = $file->getClientOriginalExtension();
            $filename = $exstensioname.'.'.time().'.'.$exstension;
            $file->move('gambarbarang',$filename);
            $barang->gambar = $filename;
        }
        $barang->save();
        return redirect("penjualbarang")->with('status','Barang berhasil ditambahkan');
    }
    public function penjualshowbarang($slug){
        $barang = Barang::where('slug',$slug)->firstOrFail();
        return view('penjual/barang/show',compact('barang'));
    }
    public function penjualeditbarang($slug){
        $barang = Barang::where('slug',$slug)->firstOrFail();
        $kategoris = Kategori::all();
        if ($barang->user_id == Auth::user()->id) {
            return view('penjual/barang/edit',compact('barang','kategoris'));
        }else{
            return redirect("penjualbarang")->with('status','barang orang jangan diganti2 parah banget');
        }
    }
    public function penjualupdatebarang(Request $request, $id){
        $barang = Barang::find($id);
        $barang->namaproduk = $request->namaproduk;
        $barang->slug = Str::slug($request->namaproduk);
        $barang->hargabarang = $request->hargabarang;
        $barang->stokbarang = $request->stokbarang;
        $barang->kategories_id = $request->kategories_id;
        $barang->penjual_id = $barang->penjual->id;
        $barang->kondisibarang = $request->kondisibarang;
        $barang->user_id = Auth::user()->id;
        if ($request->hasfile('gambar')) {
            $destination = 'gambarbarang/'.$barang->gambar;
            if (File::exists($destination)) {
                File::delete($destination);
            }
            $file = $request->file('gambar');
            $exstensioname = $file->getClientOriginalName();
            $exstension = $file->getClientOriginalExtension();
            $filename = $exstensioname.'.'.time().'.'.$exstension;
            $file->move('gambarbarang',$filename);
            $barang->gambar = $filename;
        }
        $barang->update();
    return redirect("penjualbarang")->with('status','Barang berhasil diubah');
    }
    public function penjualdeletebarang($id){
        $barangs = Barang::find($id);
        $tujuan = 'gambarbarang/'.$barangs->gambar;
        if (File::exists($tujuan)) {
            File::delete($tujuan);
        }
        $barangs->delete();
        return redirect("penjualbarang")->with('status','Barang berhasil dihapus');
    }
    public function penjualpembayaran(){
        $transaksis = Transaksi::all();
        return view('penjual.pembayaranusaha',compact('transaksis'));
    }
    public function penjualdetailtransfer($id){
        $transaksis = Transaksi::with('detailkeranjang')->where('id',$id)->first();
        if ($transaksis == null) {
            return abort(404);
        } else {
            return view('penjual.detailtransfer',compact('transaksis'));
        }
    }
    // public function penjuallunas(Request $request,$id){
    //     $transaction = Transaksi::findOrFail($id);
    //     // Ubah status transaksi menjadi "lunas"
    //     $transaction->statustransaksi = 'lunas';
    //     $transaction->save();
    //     // Ubah status detail transaksi yang sesuai menjadi "lunas"
    //     $transaction->detailkeranjang()->update(['statustransaksi' => 'lunas']);
    //     return redirect("penjualpembayaran")->with('status','pembayaran berhasil lunas');
    // }
    public function penjuallunas(Request $request){
        $ids = $request->id;
        foreach ($ids as $id) {
            $detailKeranjang = DetailKeranjang::findOrFail($id);
            $detailKeranjang->statustransaksi = 'lunas';
            $detailKeranjang->save();
            return redirect("penjualpembayaran")->with('status','pembayaran berhasil lunas');
        }
    }
}
