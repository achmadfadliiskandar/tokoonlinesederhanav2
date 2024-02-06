<?php

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use App\Models\Barang;
use App\Models\Penjual;
use App\Models\Kategori;
use App\Models\Keranjang;
use App\Models\Transaksi;
use App\Models\DetailKeranjang;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class StartController extends Controller
{
    //ini adalah controller khusus yang bisa melayani tamu tanpa akun dan dengan akun
    public function start(){
        $barangs = Barang::all();
        $kategoris = Kategori::all();
        return view('start',compact('barangs','kategoris'));
    }
    public function searchkategori($kategori){
        $kategorii = Kategori::where('kategori',$kategori)->firstOrFail();
        $barangs = Barang::where('kategories_id',$kategorii->id)->get();
        $getnamekategori = $kategorii->kategori;
        $kategoris = Kategori::all();
        return view('detailkategori',compact('barangs','kategoris','getnamekategori'));
    }
    public function searchproduct(Request $request){
        $validated = $request->validate([
            'search'=>'required|alpha',
        ]);
        $cari = $request->input('search');
        $barangs = Barang::where('namaproduk','LIKE','%'.$cari.'%')->get();
        $kategoris = Kategori::all();
        return view('start',compact('barangs','kategoris'));
    }
    public function filterprice(Request $request){
        $inputan = $request->input("filterprice");
        if ($inputan == null) {
            $barangs = Barang::all();
            $kategoris = Kategori::all();
            return redirect("allproduct");
        }else if ($inputan == "Harga-Tertinggi-Terendah") {
            $barangs = Barang::orderBy('hargabarang','DESC')->get();
            $kategoris = Kategori::all();
            return view('start',compact('barangs','kategoris'));
        }else if ($inputan == "Harga-Terendah-Tertinggi") {
            $barangs = Barang::orderBy('hargabarang','ASC')->get();
            $kategoris = Kategori::all();
            return view('start',compact('barangs','kategoris'));
        }else if ($inputan == "Harga-Dibawah-10rb") {
            $barangs = Barang::where('hargabarang','<',10000)->get();
            $kategoris = Kategori::all();
            return view('start',compact('barangs','kategoris'));
        }else{
            $barangs = Barang::all();
            $kategoris = Kategori::all();
            return redirect("allproduct");
        }
    }
    public function detailbarang($slug){
        $barang = Barang::where('slug',$slug)->firstOrFail();
        $kategoribarang = $barang->kategori->kategori;
        $kategoris = Kategori::all();
        return view('detailbarang',compact('barang','kategoris','kategoribarang'));
    }
    public function addtocart(Request $request,$slug){
        // dd($request->all());
        $validated = $request->validate([
            'stok'=>'required|numeric'
        ]);
        $barang = Barang::where('slug',$slug)->firstOrFail();
        $id = $barang->id;
        $keranjang = Keranjang::where('user_id',Auth::user()->id)->where('barangs_id',$id)->get();
        // dd($keranjang);
        if ($keranjang->count(0)) {
            return back()->with("warning",'barangnya sudah ada');
        }else{
            $keranjang = new Keranjang;
            $keranjang->user_id = Auth::user()->id;
            $keranjang->barangs_id = $barang->id;
            $keranjang->stok = $request->stok;
            if ($request->stok < 1) {
                return back()->with('warning','jumlahnya kedikitan wkwk');
            }
            if ($request->stok > $barang->stokbarang) {
                return back()->with('warning','jumlahnya kebanyakan wkwk');
            } else {
                $keranjang->totalharga = $barang->hargabarang * $request->stok;
                $keranjang->save();
                return redirect('cart')->with('status','keranjang berhasil ditambahkan');
            }
        }
        // dd($barang->id);
    }
    public function cart(){
        $keranjangs = Keranjang::where('user_id',Auth::user()->id)->get();
        $kategoris = Kategori::all();
        return view('cart',compact('keranjangs','kategoris'));
    }
    public function updatecart(Request $request,$id){
        $validated = $request->validate([
            'stok'=>'required|numeric'
        ]);
        $keranjang = Keranjang::findOrFail($id);
        $keranjang->stok = $request->stok;
        if ($request->stok < 1) {
            return back()->with('warning','jumlahnya kedikitan wkwk');
        }
       if ($request->stok > $keranjang->barang->stokbarang) {
        return back()->with('warning','jumlahnya kebanyakan wkwk');
       } else {
        $keranjang->totalharga = $keranjang->barang->hargabarang * $request->stok;
        $keranjang->update();
        return redirect('cart')->with('status','jumlah barang dalam keranjang berhasil diubah');
       }
    }
    public function removecart($id){
        $keranjang = Keranjang::findOrFail($id);
        $keranjang->delete();
        return redirect('cart')->with('status','keranjang berhasil dihapus');
    }
    public function truncatecart($id){
        $keranjangg = Keranjang::where('user_id',$id);
        $keranjangg->delete();
        return redirect('cart')->with('status','keranjang berhasil dikosongkan');
    }
    public function checkout(){
        $keranjangs = Keranjang::where('user_id',Auth::user()->id)->get();
        $kategoris = Kategori::all();
        if (sizeof($keranjangs) == 0) {
            return redirect('cart')->with('status','belanja dulu baru checkout');
        }else{
            return view('checkout',compact('keranjangs','kategoris'));
        }
    }
    public function fixedcheckout(Request $request){
        $validated = $request->validate([
            'alamatpengiriman' => ['required'],
            'metodepembayaran' => ['required', Rule::in(['cod', 'transfer'])]
        ]);
        date_default_timezone_set("Asia/Jakarta");
        // transaksi
        $transaksis = new Transaksi();
        $transaksis->user_id = Auth::user()->id;
        $transaksis->alamatpengiriman = $request->input("alamatpengiriman");
        $transaksis->metodepembayaran = $request->input("metodepembayaran");
        $transaksis->jumlahbarang = Auth::user()->keranjang->count();
        $transaksis->totalsemuaharga = Auth::user()->keranjang->sum("totalharga");
        $transaksis->tanggaltransaksi = date("Y-m-d");
        $transaksis->statustransaksi = "pending";
        $transaksis->kodebayar = rand();
        $transaksis->save();

        $keranjangs = Keranjang::where('user_id',Auth::user()->id)->get();
        foreach ($keranjangs as $value)
         {
            DetailKeranjang::create([
                'keranjangs_id'=> $value->id,
                'transaksis_id'=> $transaksis->id,
                'penjuals_id'=> $value->barang->penjual->id,
                'barangs_id'=> $value->barangs_id,
                'statustransaksi'=>'pending',
                'stok'=> $value->stok,
                'user_id'=> Auth::user()->id,
                'kodebayar'=> $transaksis->kodebayar,
            ]);
            $barang = Barang::where('id',$value->barangs_id)->first();
            $barang->stokbarang = $barang->stokbarang - $value->stok;
            $barang->update();

            $keranjangg = Keranjang::where('user_id',Auth::user()->id);
            $keranjangg->delete();

        }
        return redirect('cart')->with('status','Checkout Berhasil Terima Kasih');
    }
}
