<?php

namespace App\Http\Controllers\admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Penjual;
use App\Models\Kategori;
use App\Models\Barang;
use App\Models\Bank;
use App\Models\Transaksi;

class AdminController extends Controller
{
    // ini hanya untuk percobaan sekarang dan percobaan jangka panjang
    public function admin(){
        $cuser = User::count();
        $penjual = Penjual::count();
        $bank = Bank::count();
        $kategori = Kategori::count();
        $barang = Barang::count();
        $pembeli = User::where('role','pembeli')->count();
        $penjuals = User::where('role','penjual')->count();
        return view('admin.index',compact('cuser','penjual','bank','kategori','barang','pembeli','penjuals'));
    }
    // end now

    // percobaan kedua
    public function adminprofile(){
        $users = User::where("id",Auth::user()->id)->get();
        // foreach ($users as $key => $value) {
        //     $namaadmin = $value->name;
        //     $emailadmin = $value->email;
        //     $alamatadmin = $value->alamat;
        // }
        return view("admin.profile",compact('users'));
        // dd($users["id"]);
    }
    public function adminchangeprofile(Request $request,$id){
        // dd("debug dulu/trashing");
        $users = User::findOrFail($id);
        $users->name = $request->name;
        $users->email = $request->email;
        $users->alamat = $request->alamat;
        $users->save();
        return back()->with('status','data profile berhasil diganti');
    }
    // end now

    // untuk membuat data user(akun)
    public function adminuser(){
        $users = User::all();
        return view('admin/user/index',compact('users'));
    }
    public function adminadduser(){
        return view('admin/user/create');
    }
    public function storeuser(Request $request){
        $validated = $request->validate([
            'name' => 'required', 'string', 'max:255',
            'email' => 'required', 'string', 'email', 'max:255', 'unique:users',
            'nomorhp'=>'required',
            'password' => 'required', 'string', 'min:8', 'confirmed',
            'alamat' => 'required', 'string',
            'role' => 'required', 'string',Rule::in(['admin','pembeli', 'penjual']),
        ]);
        $newuser = new User;
        $newuser->name = $request->name;
        $newuser->email = $request->email;
        $newuser->nomorhp = $request->nomorhp;
        $newuser->password = Hash::make($request->password);
        $newuser->alamat = $request->alamat;
        $newuser->role = $request->role;
        $newuser->save();
        return redirect("adminuser")->with('status','data user berhasil ditambah');
    }
    public function adminedituser($id){
        $userss = User::find($id);
        return view('admin/user/edit',compact('userss'));
    }
    public function adminupdateuser(Request $request,$id){
        $users = User::findOrFail($id);
        $users->name = $request->name;
        $users->nomorhp = $request->nomorhp;
        $users->role = $request->role;
        $users->email = $request->email;
        $users->alamat = $request->alamat;
        $users->save();
        return redirect("adminuser")->with('status','data user berhasil diubah');
    }
    public function admindeleteuser($id){
        $usersss = User::find($id);
        $usersss->delete();
        return redirect("adminuser")->with('status','data user berhasil dihapus');
    }
    // untuk membuat data user
    public function adminchangepwd(){
        return view('admin/adminchangepwd');
    }
    public function adminchpwd(Request $request){
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
                return redirect("adminchangepwd")->with('error','password baru dan lama tidak boleh sama ya');
            }
            else if($databaru != $konfirmasipwd){
                return redirect("adminchangepwd")->with('error','password baru dan konfirmasi password harus sama ya');
            }else{
                $uactive = Auth::user()->id;
                $user = User::findOrFail($uactive);
                $user->password = Hash::make($databaru);
                $user->save();
                return redirect("adminchangepwd")->with('status','password berhasil diubah');
            }
        } else {
            return redirect("adminchangepwd")->with('error','password lama harus sesuai dengan sebelumnya');
        }
    }
    public function adminchcktoko(){
        $penjuals = Penjual::all();
        return view('admin/usaha/index',compact('penjuals'));
    }
    public function adminaddtoko(){
        $users = User::where("role","penjual")->get();
        return view('admin/usaha/create',compact('users'));
    }
    public function adminstoretoko(Request $request){
        $validated = $request->validate([
            'namatoko' => 'required',
            'user_id'=>'required|numeric',
            'alamattoko' => 'required',
            // 'modaltoko' => 'required',
            'kodepos' => 'required|numeric',
            // 'cabangtoko' => 'required|numeric',
            // 'tahunbuka' => 'required|numeric',
            'metodepembayaran' => 'required',
        ]);
        $penjual = new Penjual;
        $penjual->namatoko = $request->namatoko;
        $penjual->user_id = $request->user_id;
        $penjual->alamattoko = $request->alamattoko;
        $penjual->kodepos = $request->kodepos;
        $penjual->cabangtoko = $request->cabangtoko;
        $penjual->modaltoko = $request->modaltoko;
        $penjual->tahunbuka = $request->tahunbuka;
        $penjual->metodepembayaran = $request->metodepembayaran;
        $penjual->save();
        return redirect("adminchcktoko")->with('status','toko berhasil ditambahkan');
    }
    public function adminshowtoko($id){
        $penjuall = Penjual::find($id);
        return view("admin/usaha/detail",compact('penjuall'));
    }
    public function adminedittoko($id){
        $penjuals = Penjual::find($id);
        $users = User::where("role","penjual")->get();
        return view("admin/usaha/edit",compact('penjuals','users'));
    }
    public function adminupdatetoko(Request $request,$id){
        $validated = $request->validate([
            'namatoko' => 'required',
            'user_id'=>'required|numeric',
            'alamattoko' => 'required',
            // 'modaltoko' => 'required',
            'kodepos' => 'required|numeric',
            // 'cabangtoko' => 'required|numeric',
            // 'tahunbuka' => 'required|numeric',
            'metodepembayaran' => 'required',
        ]);
        $penjual = Penjual::findOrFail($id);
        $penjual->namatoko = $request->namatoko;
        $penjual->user_id = $request->user_id;
        $penjual->alamattoko = $request->alamattoko;
        $penjual->kodepos = $request->kodepos;
        $penjual->cabangtoko = $request->cabangtoko;
        $penjual->modaltoko = $request->modaltoko;
        $penjual->tahunbuka = $request->tahunbuka;
        $penjual->metodepembayaran = $request->metodepembayaran;
        $penjual->save();
        return redirect("adminchcktoko")->with('status','toko berhasil diubah');
    }
    public function adminhapustoko($id){
        $penjual = Penjual::findOrFail($id);
        $penjual->delete();
        return redirect("adminchcktoko")->with('status','toko berhasil dihapus');
    }
    public function adminsetting(){
        return view('admin.settings');
    }
    public function adminchangesetting(Request $request){
        // dd($request->all());
        $data = $request->input();
        $request->session()->put('navbar',$data["navbar"]);
        $request->session()->put('sidebar',$data["sidebar"]);
        $request->session()->put('footer',$data["footer"]);
        return back();
    }
    public function adminkategori(){
        $kategories = Kategori::all();
        return view('admin/kategori/index',compact('kategories'));
    }
    public function adminaddkategori(Request $request){
        $validated = $request->validate([
            'kategori' => 'required',
        ]);
        $kategori = new Kategori;
        $kategori->kategori = $request->kategori;
        $kategori->save();
        return redirect("adminkategori")->with('status','Kategori Berhasil Ditambah');
    }
    public function admindeletekategori($id){
        $kategori = Kategori::find($id);
        $kategori->delete();
        return redirect("adminkategori")->with('status','Kategori Berhasil Dihapus');
    }
    public function adminbank(){
        $banks = Bank::all();
        return view('admin/bank/index',compact('banks'));
    }
    public function adminaddbank(Request $request){
        $validated = $request->validate([
            'namabank' => 'required',
        ]);
        $bank = new Bank;
        $bank->namabank = strtoupper($request->namabank);
        $bank->save();
        return redirect("adminbank")->with('status','Bank Berhasil Ditambah');
    }
    public function admindeletebank($id){
        $bank = Bank::find($id);
        $bank->delete();
        return redirect("adminbank")->with('status','Bank Berhasil Dihapus');
    }
    public function adminbarang(){
        $barangs = Barang::all();
        return view('admin/barang/index',compact('barangs'));
    }
    public function adminaddbarang(){
        $penjual = Penjual::all();
        return view('admin/barang/create',compact('penjual'));
    }
    public function penjualstorebarang(Request $request){
        $validated = $request->validate([
            'namaproduk' => 'required',
            'hargabarang' => 'required|numeric',
            'stokbarang' => 'required|numeric',
            'gambar' => 'required|mimes:jpg,png,jpeg,PNG',
        ]);
        $barang = new Barang;
        $barang->namaproduk = $request->namaproduk;
        $barang->slug = Str::slug($request->namaproduk);
        $barang->hargabarang = $request->hargabarang;
        $barang->stokbarang = $request->stokbarang;
        $barang->penjual_id = $request->penjual_id;
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
        return redirect("adminbarang")->with('status','Barang berhasil ditambahkan');
    }
    public function adminshowbarang($slug){
        $barang = Barang::where('slug',$slug)->firstOrFail();
        return view('admin/barang/show',compact('barang'));
    }
    public function admineditbarang($slug){
        $barang = Barang::where('slug',$slug)->firstOrFail();
        return view('admin/barang/edit',compact('barang'));
    }
    public function adminupdatebarang(Request $request, $id){
        $barang = Barang::find($id);
        $barang->namaproduk = $request->namaproduk;
        $barang->slug = Str::slug($request->namaproduk);
        $barang->hargabarang = $request->hargabarang;
        $barang->stokbarang = $request->stokbarang;
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
    return redirect("adminbarang")->with('status','Barang berhasil diubah');
    }
    public function admindeletebarang($id){
        $barangs = Barang::find($id);
        $tujuan = 'gambarbarang/'.$barangs->gambar;
        if (File::exists($tujuan)) {
            File::delete($tujuan);
        }
        $barangs->delete();
        return redirect("adminbarang")->with('status','Barang berhasil dihapus');
    }
    public function adminpay(){
        $transaksisss = Transaksi::where('metodepembayaran','cod')->get();
        return view('admin.adminpay',compact('transaksisss'));
    }
    public function adminupdatepembayaran(Request $request,$id){
        $paylunas = Transaksi::find($id);
        $paylunas->statustransaksi = "lunas";
        $paylunas->save();
        return redirect("adminpay")->with('status','pembayaran berhasil lunas');
    }
    public function adminpaytf(){
        $transaksisss = Transaksi::where('metodepembayaran','transfer')->get();
        return view('admin.adminpay',compact('transaksisss'));
    }
}
