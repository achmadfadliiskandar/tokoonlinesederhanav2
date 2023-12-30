<?php

namespace App\Http\Controllers\pembeli;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Transaksi;
use App\Models\DetailKeranjang;
use App\Models\Pembayaran;

class PembeliController extends Controller
{
    public function pembeli(){
        return view('pembeli.index');
    }
    public function pembeliprofile(){
        $users = User::where("id",Auth::user()->id)->get();
        // foreach ($users as $key => $value) {
        //     $namaadmin = $value->name;
        //     $emailadmin = $value->email;
        //     $alamatadmin = $value->alamat;
        // }
        return view("pembeli.profile",compact('users'));
        // dd($users["id"]);
    }
    public function pembelichangeprofile(Request $request,$id){
        // dd("debug dulu/trashing");
        $users = User::findOrFail($id);
        $users->name = $request->name;
        $users->email = $request->email;
        $users->nomorhp = $request->nomorhp;
        $users->alamat = $request->alamat;
        $users->save();
        return back()->with('status','data profile berhasil diganti');
    }
    public function pembelichangepwd(){
        return view('pembeli/pembelichangepwd');
    }
    public function pembelichpwd(Request $request){
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
                return redirect("pembelichangepwd")->with('error','password baru dan lama tidak boleh sama ya');
            }
            else if($databaru != $konfirmasipwd){
                return redirect("pembelichangepwd")->with('error','password baru dan konfirmasi password harus sama ya');
            }else{
                $uactive = Auth::user()->id;
                $user = User::findOrFail($uactive);
                $user->password = Hash::make($databaru);
                $user->save();
                return redirect("pembelichangepwd")->with('status','password berhasil diubah');
            }
        } else {
            return redirect("pembelichangepwd")->with('error','password lama harus sesuai dengan sebelumnya');
        }
    }
    public function pembeliorder(){
        $transaksis = Transaksi::where('user_id',Auth::user()->id)->get();
        return view('pembeli.order',compact('transaksis'));
    }
    public function detailorder($kodebayar){
        $transaksis = Transaksi::with('detailkeranjang')->where('kodebayar',$kodebayar)->firstOrFail();
        if ($transaksis == null) {
            return abort(404);
        } else {
            return view('pembeli.detailorder',compact('transaksis'));
        }

    }
    public function pembelibayar(Request $request,$kodebayar){
        $validated = $request->validate([
            'totalpembayaran' => 'required',
        ]);
        $transaksis = Transaksi::where('kodebayar',$kodebayar)->firstOrFail();
        $detailtf = new Pembayaran;
        $detailtf->transaksis_id = $transaksis->id;
        $detailtf->kodebayar = $transaksis->kodebayar;
        $detailtf->totalpembayaran = $request->totalpembayaran;
        $detailtf->nominalpembayaran = $transaksis->totalsemuaharga;
        if ($request->totalpembayaran == $transaksis->totalsemuaharga) {
            $detailtf->kembalianpembayaran = $request->totalpembayaran - $transaksis->totalsemuaharga;
            $detailtf->user_id = Auth::user()->id;
            $detailtf->save();
            $transaksiss = Transaksi::find($transaksis->id);
            $transaksiss->statustransaksi = "lunas";
            $transaksiss->save();
            return redirect('pembeliorder/'.Auth::user()->id.'/'.Auth::user()->name)->with('status','pembayaran berhasil terima kasih');
        }else{
            return back()->with('fail','pembayaran gagal');
        }
    }
}
