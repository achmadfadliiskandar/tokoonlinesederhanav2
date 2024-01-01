<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Guest\StartController;
use App\Http\Controllers\admin\AdminController;
use App\Http\Controllers\penjual\PenjualController;
use App\Http\Controllers\pembeli\PembeliController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// routing dasar
Route::get('/', function () {
    return view('welcome');
});
// Route::get('/penjual',function(){
//     return view('penjual.index');
// });
// Route::get('/admin',function(){
//     return view('admin.index');
// });
// rouding dasar

// routing dasar 2 

// Route::get('/penjual',[PenjualController::class,'penjual'])->middleware('checkRole:penjual,admin');
// Route::get('/admin',[AdminController::class,'admin'])->middleware('checkRole:admin');
// Route::get('/pembeli',[PembeliController::class,'pembeli'])->middleware('checkRole:pembeli,admin,penjual');
// routing dasar 2

/*routing user sesuai grup ini jangka panjang kenapa?? 
|agar kedepannya ketika ada revisi kita sudah tidak kelabakan lagi dan sebenarnya ada yang lebih gila
|lagi yaitu Route::resources wah gila sih itu tapi kalau nggak paham dari mananya  ya streesss wkwk
|nah saya buat lebih mudah saja supaya gampang diingat kita lakukan menggunakan routing controller
|kalau routing controller itu kan satu controller banyak isi class nah jadi kita ngerti dan tidak kelabakan
*/

// untuk umum bisa juga untuk tiga role dibawah seperti admin,penjual,pembeli
Route::controller(StartController::class)->group(function(){
    Route::get('/allproduct','start');
    Route::get('/detailkategori/{kategori}','searchkategori');
    Route::get('/searchproduct','searchproduct');
    Route::get('/filterprice','filterprice');
    Route::get('/detailbarang/{slug}','detailbarang');
    Route::post('/addtocart/{slug}','addtocart');
    Route::get('/cart','cart')->middleware('auth');
    Route::put('/updatecart/{id}','updatecart')->middleware('auth');
    Route::delete('/removecart/{id}','removecart')->middleware('auth');
    Route::delete('/truncatecart/{id}','truncatecart')->middleware('auth');
    Route::get('/checkout','checkout')->middleware('auth');
    Route::post('/fixedcheckout','fixedcheckout')->middleware('auth');
});
// end note** kalau ada masalah yang tidak memerlukan login urusnya disini aja

// admin controller|| ada masalah di admin urusnya disini aja
Route::middleware(['auth','checkRole:admin'])->group(function(){
    Route::controller(AdminController::class)->group(function(){
        Route::get('/admin','admin');
        Route::get('/adminprofile/{id}/{name}','adminprofile');
        Route::post('/adminprofile/{id}/{name}','adminchangeprofile');
        Route::get('/adminuser','adminuser');
        Route::get('/adminadduser','adminadduser');
        Route::post('/storeuser','storeuser');
        Route::get('/adminedituser/{id}{name}','adminedituser');
        Route::put('/adminupdateuser/{id}{name}','adminupdateuser');
        Route::delete('/admindeleteuser/{id}{name}','admindeleteuser');
        Route::get('/adminchangepwd','adminchangepwd');
        Route::post('/adminchpwd','adminchpwd');
        Route::get('/adminchcktoko','adminchcktoko');
        Route::get('/adminaddtoko','adminaddtoko');
        Route::post('/adminstoretoko','adminstoretoko');
        Route::get('/adminshowtoko/{id}','adminshowtoko');
        Route::get('/adminedittoko/{id}','adminedittoko');
        Route::put('/adminupdatetoko/{id}','adminupdatetoko');
        Route::delete('/adminhapustoko/{id}','adminhapustoko');
        Route::get('/adminsetting','adminsetting');
        Route::post('/adminchangesetting','adminchangesetting');
        Route::get('/adminkategori','adminkategori');
        Route::post('/adminaddkategori','adminaddkategori');
        Route::delete('/admindeletekategori/{id}','admindeletekategori');
        Route::get('/adminbank','adminbank');
        Route::post('/adminaddbank','adminaddbank');
        Route::delete('/admindeletebank/{id}','admindeletebank');
        Route::get('/adminbarang','adminbarang');
        Route::get('/adminaddbarang','adminaddbarang');
        Route::post('/adminstorebarang','adminstorebarang');
        Route::get('/adminshowbarang/{slug}','adminshowbarang');
        Route::get('/admineditbarang/{slug}','admineditbarang');
        Route::put('/adminupdatebarang/{id}','adminupdatebarang');
        Route::delete('/admindeletebarang/{id}','admindeletebarang');
        Route::get('/adminpay','adminpay');
        Route::put('/adminupdatepembayaran/{id}','adminupdatepembayaran');
        Route::get('/adminpaytf','adminpaytf');
        Route::post('/adminlunas','adminlunas');
    });
});
// end note** urus admin di sini aja

// penjual controller|| ada masalah di penjual urusnya disini aja
Route::middleware(['auth','checkRole:penjual'])->group(function(){
    Route::controller(PenjualController::class)->group(function(){
        Route::get('/penjual','penjual');
        Route::get('/penjualprofile/{id}/{name}','penjualprofile');
        Route::post('/penjualprofile/{id}/{name}','penjualchangeprofile');
        Route::get('/datausahapenjual/{id}/{name}','penjualusaha');
        Route::post('/penjualformulirsubmit/{id}/{name}','penjualformulirsubmit');
        Route::put('/penjualformulirsubmit/{id}/{name}','penjualformulirsubmit');
        Route::get('/penjualgambarusaha/{id}/{user_id}/{name}','penjualgambarusaha');
        Route::put('/penjualupgambar/{id}','penjualupgambar');
        Route::get('/penjualchangepwd','penjualchangepwd');
        Route::post('/penjualchpwd','penjualchpwd');
        Route::get('/penjualbarang','penjualbarang');
        Route::get('/penjualaddbarang','penjualaddbarang');
        Route::post('/penjualstorebarang','penjualstorebarang');
        Route::get('/penjualshowbarang/{slug}','penjualshowbarang');
        Route::get('/penjualeditbarang/{slug}','penjualeditbarang');
        Route::put('/penjualupdatebarang/{id}','penjualupdatebarang');
        Route::delete('/penjualdeletebarang/{id}','penjualdeletebarang');
        Route::get('/penjualpembayaran','penjualpembayaran');
        Route::get('/detailtransfer/{id}','penjualdetailtransfer');
    });
});
// end note** urus penjual di sini aja

// pembeli controller|| ada masalah di pembeli urusnya disini aja
Route::middleware(['auth','checkRole:pembeli'])->group(function(){
Route::controller(PembeliController::class)->group(function(){
        Route::get('/pembeli','pembeli');
        Route::get('/pembeliprofile/{id}/{name}','pembeliprofile');
        Route::post('/pembeliprofile/{id}/{name}','pembelichangeprofile');
        Route::get('/pembelichangepwd','pembelichangepwd');
        Route::post('/pembelichpwd','pembelichpwd');
        Route::get('/pembeliorder/{id}/{name}','pembeliorder');
        Route::get('/detailorder/{kodebayar}','detailorder');
        Route::post('/pembelibayar/{kodebayar}','pembelibayar');
    });
});
// end note** urus pembeli di sini aja



// ketika sudah login pasti diarahkan kesini dari defaultnya kecuali kita atur lagi di controllernya
Auth::routes();
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
