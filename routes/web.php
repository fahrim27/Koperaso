<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

use App\Http\Controllers\CartController;
use App\Http\Controllers\HomeController;

Route::get('/', 'WelcomeController@index');
Route::get('/detail/{id}', 'WelcomeController@show');
Route::get('/category/{id}', 'WelcomeController@showbycategory');

Route::get('/login', function () {
    return view('auth.login');
});
Route::get('logout', 'Auth\LoginController@logout')->name('logout');

Route::get('/registrasi_anggota', 'RegistrasiController@index');
Route::post('/registrasi_anggota', 'RegistrasiController@store');

Route::get('/lupa-kata-sandi', 'Auth\ForgotPasswordController@showForgetPasswordForm');
Route::post('/lupa-kata-sandi', 'Auth\ForgotPasswordController@submitForgetPasswordForm')->name('lupa.password');
Route::get('/reset-password/{id}', 'Auth\ForgotPasswordController@showResetPasswordForm');
Route::post('/reset-password', 'Auth\ForgotPasswordController@submitResetPasswordForm')->name('reset.password');


Auth::routes();

Route::prefix('/admin')->middleware('role:Admin')->group(function () {
    /// Dashboard
    Route::get('/dashboard','HomeController@index');

    /// Akun
    Route::get('/master_akun', 'ChartAccountController@index');
    Route::get('/master_akun/add_akun', 'ChartAccountController@create');
    Route::post('/master_akun/add_akun', 'ChartAccountController@store');
    Route::get('/master_akun/edit_akun/{id}', 'ChartAccountController@edit');
    Route::post('/master_akun/update', 'ChartAccountController@update');
    Route::get('/master_akun/setting_akun', 'ChartAccountController@setting_akun');
    Route::post('/master_akun/update_aktsetting', 'ChartAccountController@update_setting');

    /// SubAkun
    Route::get('/master_akun/add_subakun/{id}', 'ChartAccountController@create_subakun');
    Route::post('/master_akun/add_subakun', 'ChartAccountController@store_subakun');
    Route::get('/master_akun/edit_subakun/{id}', 'ChartAccountController@edit_subakun');
    Route::post('/master_akun/update_subakun', 'ChartAccountController@update_subakun');
    Route::post('/master_akun/hapus', 'ChartAccountController@destroy');


    /// Akt Mutasi KAS
    Route::get('/mutasi_kas', 'KasMutasiController@index');
    Route::get('/mutasi_kas/addnew', 'KasMutasiController@create');
    Route::post('/mutasi_kas/addnew', 'KasMutasiController@store');
    Route::post('/mutasi_kas/hapus', 'KasMutasiController@destroy');


    /// Akt Mutasi NON KAS

    Route::get('/memorial', 'MutasiNonKasController@index');
    Route::get('/memorial/addnew', 'MutasiNonKasController@create');
    Route::post('/memorial/addnew', 'MutasiNonKasController@store');
    Route::post('/memorial/hapus', 'MutasiNonKasController@destroy');
    Route::post('/memorial/filter','MutasiNonKasController@filter');
    Route::post('/memorial/adddetail','MutasiNonKasController@add_detail')->name('add.detail');
    Route::post('/memorial/hapus_detail','MutasiNonKasController@hapus_detail')->name('hapus.detail');




    /// Akt Trx Finance
    Route::get('/trx_finance', 'AktFinanceController@index');
    Route::get('/trx_finance/addnew', 'AktFinanceController@create');
    Route::post('/trx_finance/addnew', 'AktFinanceController@store');
    Route::post('/trx_finance/hapus', 'AktFinanceController@destroy');
    Route::get('/lap_finance', 'AktFinanceController@laporan_index');
    Route::post('/lap_finance/preview', 'AktFinanceController@laporan_preview');

    Route::get('/lap_profit', 'AktFinanceController@lap_profit_index');
    Route::post('/lap_profit/preview', 'AktFinanceController@lap_profit_preview');




    /// Master Product
    Route::get('/master_product', 'ProductController@index');


    /// ANGGOTA
    Route::get('/master_anggota', 'MsAnggotaController@index');
    Route::get('/master_anggota/addnew', 'MsAnggotaController@create');
    Route::post('/master_anggota/addnew', 'MsAnggotaController@store');
    Route::post('/master_anggota/filter', 'MsAnggotaController@filter');
    Route::post('/master_anggota/verifikasi', 'MsAnggotaController@verifikasi');
    Route::post('/master_anggota/nonaktif', 'MsAnggotaController@nonaktif');
    Route::get('/master_anggota/edit/{id}', 'MsAnggotaController@edit');
    Route::post('/master_anggota/update', 'MsAnggotaController@update');
    Route::post('/master_anggota/hapus', 'MsAnggotaController@destroy');
    Route::get('/master_anggota/detail/{id}', 'MsAnggotaController@show');
    Route::get('/master_anggota/kirim_email/{id}', 'RegistrasiController@sendemail');
    Route::get('/master_anggota/cetak/{id}', 'MsAnggotaController@cetakformulir');
    Route::get('/master_anggota/download/{id}', 'MsAnggotaController@download');

    Route::get('/master_anggota/verifikasi_anggota', 'MsAnggotaController@verifikasi_index');


    /// SIMPANAN
    Route::get('/simp_master', 'SimpMasterController@index');
    Route::get('/simp_master/addnew', 'SimpMasterController@create');
    Route::post('/simp_master/addnew', 'SimpMasterController@store');
    Route::get('/simp_master/edit/{id}', 'SimpMasterController@edit');
    Route::post('/simp_master/update', 'SimpMasterController@update');
    Route::post('/simp_master/hapus', 'SimpMasterController@destroy');

    Route::get('/kirim_email', 'HomeController@sendemail');




    Route::get('/simp_rekening', 'SimpRekeningController@index');
    Route::get('/simp_rekening/addnew', 'SimpRekeningController@create');
    Route::post('/simp_rekening/addnew', 'SimpRekeningController@store');


    Route::post('/simp_rekening/filter', 'SimpRekeningController@filter');
    Route::get('/simp_rekening/lihat_mutasi/{id}', 'SimpRekeningController@show');
    Route::get('/simp_rekening/lihat_mutasi/cetak', 'SimpRekeningController@show');
    Route::post('/simp_rekening/update_setoran', 'SimpRekeningController@update_setoran');



    Route::get('/simp_mutasi', 'SimpMutasiController@index');
    Route::get('/simp_mutasi/addnew', 'SimpMutasiController@create');
    Route::post('/simp_mutasi/addnew', 'SimpMutasiController@store');
    Route::post('/simp_mutasi/filter', 'SimpMutasiController@filter');
    Route::post('/simp_mutasi/cetak', 'SimpMutasiController@cetak_mutasi');
    Route::get('/simp_mutasi/cetak', 'SimpMutasiController@print_mutasi');


    Route::get('/simp_mutasi/cetak_bukti/{id}', 'SimpMutasiController@cetak_bukti');
    Route::get('/simp_mutasi/download_excel', 'SimpMutasiController@export_excel');
    Route::post('/simp_mutasi/delete', 'SimpMutasiController@destroy');

    Route::get('/simp_verifikasi', 'SimpVerifController@index');
    Route::get('/simp_verifikasi/detail/{id}', 'SimpVerifController@show');
    Route::post('/simp_verifikasi/proses', 'SimpVerifController@store');
    Route::post('/simp_verifikasi/delete', 'SimpVerifController@store');


    Route::get('/simp_mutasi/import', 'SimpMutasiController@import');
    Route::post('/simp_mutasi/import', 'SimpMutasiController@import_excel');

    Route::get('/lap_simpanan', 'LapSimpananController@index');
    Route::post('/lap_simpanan/preview', 'LapSimpananController@preview');


    /// PINJAMAN
    Route::get('/pby_master', 'PbyMasterController@index');
    Route::get('/pby_master/addnew', 'PbyMasterController@create');
    Route::post('/pby_master/addnew', 'PbyMasterController@store');
    Route::get('/pby_master/edit/{id}', 'PbyMasterController@edit');
    Route::post('/pby_master/update', 'PbyMasterController@update');
    Route::post('/pby_master/hapus', 'PbyMasterController@destroy');

    Route::get('/pengajuan', 'PbyPengajuanController@index');
    Route::get('/pengajuan/addnew', 'PbyPengajuanController@create');
    Route::post('/pengajuan/addnew', 'PbyPengajuanController@store');
    Route::get('/pengajuan/detail/{id}', 'PbyPengajuanController@show');
    Route::post('/pengajuan/update', 'PbyPengajuanController@update');
    Route::get('/pengajuan/download/{id}', 'PbyPengajuanController@download');
    Route::get('/pengajuan/edit/{id}', 'PbyPengajuanController@edit');
    Route::post('/pengajuan/update_pengajuan', 'PbyPengajuanController@update_pengajuan');
    Route::get('/pengajuan_cicilan', 'PbyPengajuanController@index_cicilan');



    Route::get('/pencairan', 'PbyPencairanController@index');
    Route::post('/pencairan/proses', 'PbyPencairanController@store');

    Route::get('/pby_rekening', 'PbyRekeningController@index');
    Route::get('/pby_rekening/detail/{id}', 'PbyRekeningController@show');
    Route::get('/pby_rekening/detail/cetak/{id}', 'PbyRekeningController@cetak_bukti');


    Route::get('/pby_angsuran', 'PbyMutasiController@index');
    Route::post('/pby_angsuran/addnew','PbyMutasiController@store');

    Route::post('/pby_mutasi/delete', 'PbyMutasiController@destroy');
    Route::get('/pby_mutasi/download_excel', 'PbyMutasiController@export_excel');
    Route::post('/pby_mutasi/import', 'PbyMutasiController@import_excel');

    Route::get('/lap_pinjaman', 'LapPinjamanController@index');
    Route::post('/lap_pinjaman/preview', 'LapPinjamanController@preview');


    /// Laporan Akunting
    Route::get('/lap_akunting/lapjurnal', 'LapAkuntingController@jurnal');
    Route::post('/lap_akunting/lapjurnal/filter', 'LapAkuntingController@jurnal_filter');
    Route::post('/lap_akunting/lapjurnal/cetak', 'LapAkuntingController@jurnal_cetak');

    Route::get('/lap_akunting/bukubesar', 'LapAkuntingController@bukubesar_index');
    Route::post('/lap_akunting/bukubesar', 'LapAkuntingController@bukubesar_show');
    Route::post('/lap_akunting/bukubesar/cetak', 'LapAkuntingController@bukubesar_cetak');

    Route::get('/lap_akunting/labarugi', 'LapAkuntingController@labarugi_index');
    Route::post('/lap_akunting/labarugi', 'LapAkuntingController@labarugi_show');
    Route::post('/lap_akunting/labarugi/cetak', 'LapAkuntingController@labarugi_cetak');

    Route::get('/lap_akunting/aruskas', 'LapAkuntingController@aruskas_index');
    Route::post('/lap_akunting/aruskas', 'LapAkuntingController@aruskas_show');
    Route::post('/lap_akunting/aruskas/cetak', 'LapAkuntingController@aruskas_cetak');

    Route::get('/lap_akunting/neracasaldo', 'LapAkuntingController@neracasaldo_index');
    Route::post('/lap_akunting/neracasaldo', 'LapAkuntingController@neracasaldo_show');
    Route::post('/lap_akunting/neracasaldo/cetak', 'LapAkuntingController@neracasaldo_cetak');


    Route::get('/shu', 'ShuController@index');

    //// Notifikasi
    Route::get('/notification/update/{id}', 'NotifController@update');
    Route::get('/notification/readall/', 'NotifController@readall');


    /// Produk
    Route::get('/master_produk', 'ProdukController@index');
    Route::get('/master_produk/addnew', 'ProdukController@create');
    Route::post('/master_produk/addnew', 'ProdukController@store');
    Route::get('/master_produk/edit/{id}', 'ProdukController@edit');
    Route::post('/master_produk/update', 'ProdukController@update');

    Route::get('/master_produk/detail/{id}', 'ProdukController@show');
    Route::post('/master_produk/hapus', 'ProdukController@destroy');

    /// Pembelian
    Route::get('/pembelian', 'TrxPembelianController@index');
    Route::get('/pembelian/addnew', 'TrxPembelianController@create');
    Route::post('/pembelian/add_item/', 'TrxPembelianController@addToCart');

    Route::get('/pembelian/increase/{id}', 'TrxPembelianController@increaseQty');
    // [TrxPembelianController::class, 'increase'])->name('increase.cart');
    Route::get('/pembelian/decrease/{id}','TrxPembelianController@decreaseQty');
    //  [TrxPembelianController::class, 'decrease'])->name('decrease.cart');
    Route::patch('/pembelian/update_list', [TrxPembelianController::class, 'update'])->name('update.list');
    Route::get('/pembelian/checkout_pembayaran', 'TrxPembelianController@pembayaran');
    Route::post('/pembelian/posting', 'TrxPembelianController@store');
    Route::post('/pembelian/setuju', 'TrxPembelianController@approve_pembelian');
    Route::post('/pembelian/hapus', 'TrxPembelianController@destroy');

    // Laporan Penjualan
    Route::get('/lap_penjualan', 'LaporanUjbController@index');
    Route::post('/lap_penjualan/preview', 'LaporanUjbController@lap_penjualan');


    /// Purchasing
    Route::get('/purchasing', 'PurchasingController@index');
    Route::get('/purchasing/detail/{id}', 'PurchasingController@show');
    Route::post('/purchasing/update', 'PurchasingController@update');
    Route::get('/purchasing/detail/{id}/cetak', 'PurchasingController@cetak');


    //// Auto Tagih
    Route::get('/autotagih', 'AutoTagihController@index');
    // Route::post('/autotagih/proses', 'AutoTagihController@proses');
    Route::post('/autotagih/proses', 'AutoTagihController@new_autotagih');
    Route::get('/autotagih/download_excel', 'AutoTagihController@export_excel');
    Route::get('/autotagih/posting_tagihan', 'AutoTagihController@postingAutoTagih');


    /// MASTER
    Route::get('/ms_department', 'MsDepartmentController@index');
    Route::get('/ms_department/addnew', 'MsDepartmentController@create');
    Route::post('/ms_department/addnew', 'MsDepartmentController@store');
    Route::get('/ms_department/edit/{id}', 'MsDepartmentController@edit');
    Route::post('/ms_department/update', 'MsDepartmentController@update');
    Route::post('/ms_department/hapus', 'MsDepartmentController@destroy');


    Route::get('/ms_jabatan', 'MsJabatanController@index');
    Route::get('/ms_jabatan/addnew', 'MsJabatanController@create');
    Route::post('/ms_jabatan/addnew', 'MsJabatanController@store');
    Route::get('/ms_jabatan/edit/{id}', 'MsJabatanController@edit');
    Route::post('/ms_jabatan/update', 'MsJabatanController@update');
    Route::post('/ms_jabatan/hapus', 'MsJabatanController@destroy');


    Route::get('/ms_perusahaan', 'MsPerusahaanController@index');
    Route::get('/ms_perusahaan/addnew', 'MsPerusahaanController@create');
    Route::post('/ms_perusahaan/addnew', 'MsPerusahaanController@store');
    Route::get('/ms_perusahaan/edit/{id}', 'MsPerusahaanController@edit');
    Route::post('/ms_perusahaan/update', 'MsPerusahaanController@update');
    Route::post('/ms_perusahaan/hapus', 'MsPerusahaanController@destroy');

    Route::get('/master_user', 'UsersController@index');
    Route::get('/master_user/addnew', 'UsersController@create');
    Route::post('/master_user/addnew', 'UsersController@store');
    Route::get('/master_user/edit/{id}', 'UsersController@edit');
    Route::post('/master_user/update', 'UsersController@update');
    Route::post('/master_user/hapus', 'UsersController@destroy');


    Route::get('/edit_profil', 'UsersController@edit_profil');
    Route::post('/edit_profil/update', 'UsersController@update_profil');

    Route::get('/setting', 'SettingController@index');
    Route::post('/setting/update_perush', 'SettingController@update_perush');
    Route::post('/setting/update_notif', 'SettingController@update_notif');
    Route::post('/setting/update_periode', 'SettingController@update_periode');



    Route::get('/closing', 'ClosingController@index');
    Route::get('/closing/proses', 'ClosingController@proses_closing');



});

Route::prefix('/anggota')->middleware('role:Anggota')->group(function () {
    /// Dashboard
    Route::get('/dashboard', 'HomeController@anggota');

    Route::get('/pengajuan', 'AgtPinjamanController@index');
    Route::get('/pengajuan/addnew', 'AgtPinjamanController@create');
    Route::post('/pengajuan/addnew', 'AgtPinjamanController@store');
    Route::get('/pengajuan/kirimemail/{id}', 'AgtPinjamanController@kirimemail');
    Route::get('/pengajuan/getjasa', 'AgtPinjamanController@getJasa');
    Route::post('/pengajuan/batal', 'AgtPinjamanController@destroy');


    Route::get('/pinjaman', 'AgtPinjamanController@datarekening');
    Route::get('/pinjaman/detail/{id}', 'AgtPinjamanController@show');
    Route::get('/pinjaman/simulasi', 'AgtPinjamanController@simulasi_pinjaman');
    Route::post('/pinjaman/simulasi', 'AgtPinjamanController@proses_simulasi');



    Route::get('/simpanan','AgtSimpananController@index');
    Route::get('/simpanan/detail/{id}','AgtSimpananController@show');
    Route::get('/simpanan/setoran','AgtSimpananController@setoran_index');
    Route::get('/simpanan/setoran/addnew','AgtSimpananController@setoran');
    Route::get('/simpanan/setoran/detail/{id}','AgtSimpananController@setoran_detail');
    Route::post('/simpanan/setoran/addnew','AgtSimpananController@store');
    Route::post('/simpanan/setoran/hapus','AgtSimpananController@destroy');



    Route::get('/purchasing','AgtPurchasingController@index');
    // Route::get('/purchasing/{key}/{id}','AgtPurchasingController@create');
    Route::get('/purchasing/addnew/{id}','AgtPurchasingController@create');
    Route::post('/purchasing/addnew','AgtPurchasingController@store');
    Route::get('/purchasing/catalog','AgtPurchasingController@catalog');
    Route::get('/purchasing/catalog/cari','AgtPurchasingController@catalog_filter');

    Route::get('/purchasing/catalog/bahan_pokok','AgtPurchasingController@catalog_bhnpokok');
    Route::get('/purchasing/catalog/bahan_pokok/cari','AgtPurchasingController@catalog_bhnpokok_filter');

    Route::get('/purchasing/catalog/elektronik','AgtPurchasingController@catalog_elektronik');
    Route::get('/purchasing/catalog/elektronik/cari','AgtPurchasingController@catalog_elektronik_filter');

    Route::get('/purchasing/catalog/furniture','AgtPurchasingController@catalog_furniture');
    Route::get('/purchasing/catalog/furniture/cari','AgtPurchasingController@catalog_furniture_filter');

    Route::get('/purchasing/catalog/sepeda_motor','AgtPurchasingController@catalog_sepeda_motor');
    Route::get('/purchasing/catalog/sepeda_motor/cari','AgtPurchasingController@catalog_sepeda_motor_filter');

    /// Cart Anggota
    Route::get('/purchasing/mycart','CartController@index')->name('cart');
    Route::get('/purchasing/add-to-cart/{id}', [CartController::class, 'addToCart'])->name('add.to.cart');
    Route::get('/purchasing/increase/{id}', [CartController::class, 'increase'])->name('increase.cart');
    Route::get('/purchasing/decrease/{id}', [CartController::class, 'decrease'])->name('decrease.cart');
    Route::patch('/purchasing/update-cart', [CartController::class, 'update'])->name('update.cart');
    Route::post('/purchasing/remove-from-cart', [CartController::class, 'remove'])->name('remove.from.cart');

    Route::get('/purchasing/checkout','CartController@checkout');
    Route::post('/purchasing/pembayaran_checkout','CartController@pembayaran');
    Route::get('/purchasing/detail/{id}', 'AgtPurchasingController@show');


    Route::get('/edit_profil', 'UsersController@edit_profil');
    Route::post('/edit_profil/update', 'UsersController@update_profil');

    Route::get('/agtshu', 'AgtShuController@index');


    //// Notification
    Route::get('/notification/readall/', 'HomeController@readall');


});

// Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
