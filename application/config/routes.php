<?php
defined('BASEPATH') or exit('No direct script access allowed');

$route['default_controller'] = 'C_pegawai_beranda';

// Login
$route['login'] = 'C_login/index';
$route['cek_login'] = 'C_login/login';
$route['logout'] = 'C_login/logout';

// Pegawai
$route['dashboard'] = 'C_pegawai_dashboard';

$route['simpanan'] = 'C_pegawai_simpanan';
$route['peminjaman'] = 'C_pegawai_peminjaman';
$route['peminjaman-data'] = 'C_pegawai_peminjaman/dataPeminjaman';
$route['pemberitahuan-konfirmasi-admin'] = 'C_pegawai_peminjaman/konfirmasiAdmin';
$route['peminjaman-detail'] = 'C_pegawai_peminjaman/detail';
$route['peminjaman-download-sp2/(:any)'] = 'C_pegawai_peminjaman/spPeminjaman/$1';
$route['cek-peminjaman'] = 'C_pegawai_peminjaman/cekPeminjaman';
$route['peminjaman-insert'] = 'C_pegawai_peminjaman/insert';
$route['peminjaman-hapus-pemberitahuan'] = 'C_pegawai_peminjaman/hapusPemberitahuan';

// Pegawai Voucher
$route['voucher'] = 'C_pegawai_voucher';
$route['ajukan-voucher'] = 'C_pegawai_voucher/ajukanVoucher';
$route['get-voucher'] = 'C_pegawai_voucher/getVoucher';
$route['get-detail-voucher'] = 'C_pegawai_voucher/getDetailVoucher';
$route['pemberitahuan-konfirmasi-voucher'] = 'C_pegawai_voucher/pemberitahuanVoucher';
$route['voucher-hapus-pemberitahuan'] = 'C_pegawai_voucher/hapusPemberitahuan';
$route['get-detail-isi-voucher'] = 'C_pegawai_voucher/getDetailIsiVoucher';
$route['detail-pembayaran-pegawai'] = 'C_pegawai_voucher/detailPembayaran';
$route['cetak-detail-pembayaran-pegawai'] = 'C_pegawai_voucher/cetakDetailPembayaran';
$route['cetak-voucher-pegawai'] = 'C_pegawai_voucher/cetakVoucher';

// Admin
$route['dashboard-admin'] = 'C_admin_dashboard';

$route['peminjaman-admin'] = 'C_admin_peminjaman';

$route['konfigurasi'] = 'C_admin_konfigurasi';
$route['pengguna-admin'] = 'C_admin_pa';
$route['pengguna-pegawai'] = 'C_admin_pp';
$route['pengguna-kasir'] = 'C_admin_pk';

$route['peminjaman-data-admin'] = 'C_admin_peminjaman/dataPeminjaman';
$route['peminjaman-pemberitahuan'] = 'C_admin_peminjaman/pemberitahuan';
$route['peminjaman-pemberitahuan-count'] = 'C_admin_peminjaman/pemberitahuanCount';
$route['peminjaman-pemberitahuan-detail'] = 'C_admin_peminjaman/pemberitahuanDetail';
// $route['peminjaman-download-sp/(:any)'] = 'C_admin_peminjaman/spPeminjaman/$1';
$route['peminjaman-download-sp/(:any)'] = 'C_admin_peminjaman/spPeminjaman';
$route['peminjaman-setuju'] = 'C_admin_peminjaman/setujuPeminjaman';
$route['peminjaman-ditolak'] = 'C_admin_peminjaman/tolakPeminjaman';
$route['peminjaman-detail-admin'] = 'C_admin_peminjaman/detail';
$route['peminjaman-bayar-tenor'] = 'C_admin_peminjaman/pembayaranTenor';

// Akun Pegawai
$route['pengguna-pegawai-data'] = 'C_admin_pp/dataPegawai';
$route['detail-pegawai'] = 'C_admin_pp/detailPegawai';
$route['nonaktifkan-pegawai'] = 'C_admin_pp/nonaktifkanPegawai';
$route['aktifkan-pegawai'] = 'C_admin_pp/aktifkanPegawai';
$route['cek-data-pegawai'] = 'C_admin_pp/cekDataPegawai';
$route['cek-data-pegawai-detail'] = 'C_admin_pp/cekDataPegawaiDetail';
$route['tambah-data-pegawai'] = 'C_admin_pp/tambahDataPegawai';
$route['ubah-data-pegawai'] = 'C_admin_pp/ubahDataPegawai';
$route['ubah-foto-ktp'] = 'C_admin_pp/ubahFotoKTP';
$route['ubah-foto-kk'] = 'C_admin_pp/ubahFotoKK';
$route['ubah-foto-slip'] = 'C_admin_pp/ubahFotoSlip';
$route['ubah-foto-profil'] = 'C_admin_pp/ubahFotoProfil';

// Akun Kasir
$route['pengguna-kasir-data'] = 'C_admin_pk/dataKasir';
$route['cek-data-kasir'] = 'C_admin_pk/cekDataKasir';
$route['tambah-data-kasir'] = 'C_admin_pk/tambahDataKasir';
$route['cek-data-kasir-detail'] = 'C_admin_pk/cekDataKasirDetail';
$route['ubah-data-kasir'] = 'C_admin_pk/ubahDataKasir';

// Akun Admin
$route['pengguna-admin-data'] = 'C_admin_pa/dataAdmin';
$route['cek-data-admin'] = 'C_admin_pa/cekDataAdmin';
$route['tambah-data-admin'] = 'C_admin_pa/tambahDataAdmin';
$route['cek-data-admin-detail'] = 'C_admin_pa/cekDataAdminDetail';
$route['ubah-data-admin'] = 'C_admin_pa/ubahDataAdmin';

// Grade
$route['get-grade-detail'] = 'C_admin_grade/getGrade2';

// Master Barang
$route['master-barang'] = 'C_admin_master_barang';
$route['get-master-barang'] = 'C_admin_master_barang/getMasterBarang';
$route['simpan-master-barang'] = 'C_admin_master_barang/simpanMasterBarang';
$route['get-detail-master-barang'] = 'C_admin_master_barang/getDetailMasterBarang';
$route['edit-master-barang'] = 'C_admin_master_barang/editMasterBarang';
$route['hapus-master-barang'] = 'C_admin_master_barang/hapusMasterBarang';

// Voucher Admin
$route['voucher-admin'] = 'C_admin_voucher';
$route['get-voucher-admin'] = 'C_admin_voucher/getVoucher';
$route['get-detail-voucher-admin'] = 'C_admin_voucher/getDetailVoucher';
$route['admin-setuju-voucher-admin'] = 'C_admin_voucher/adminSetuju';
$route['admin-tolak-voucher-admin'] = 'C_admin_voucher/adminTolak';
$route['admin-tolak-voucher-admin'] = 'C_admin_voucher/adminTolak';
$route['cetak-voucher-admin'] = 'C_admin_voucher/cetakVoucher';
$route['proses_pembayaran'] = 'C_admin_voucher/prosesPembayaran';
$route['daftar-barang-admin'] = 'C_admin_voucher/daftarBarang';
$route['tambah-daftar-barang-admin'] = 'C_admin_voucher/tambahDaftarBarang';
$route['simpan-proses-pembayaran'] = 'C_admin_voucher/simpanProsesPembayaran';
$route['detail-pembayaran'] = 'C_admin_voucher/detailPembayaran';
$route['cetak-detail-pembayaran'] = 'C_admin_voucher/cetakDetailPembayaran';

// Grade
$route['grade'] = 'C_admin_grade_manage/grade';
$route['simpan-grade'] = 'C_admin_grade_manage/simpanGrade';
$route['get-grade'] = 'C_admin_grade_manage/getGrade';
$route['get-detail-grade'] = 'C_admin_grade_manage/getDetailGrade';
$route['hapus-grade'] = 'C_admin_grade_manage/hapusGrade';
$route['edit-grade'] = 'C_admin_grade_manage/editGrade';
// Perbarui Foto Pegawai

// Syarat dan Ketentuan
$route['syarat-ketentuan'] = 'C_admin_syarat_ketentuan';
$route['getSK'] = 'C_admin_syarat_ketentuan/getSK';
$route['simpan-SK'] = 'C_admin_syarat_ketentuan/simpanSK';
$route['hapus-SK'] = 'C_admin_syarat_ketentuan/hapusSK';
$route['get-detail-SK'] = 'C_admin_syarat_ketentuan/getDetailSK';
$route['edit-SK'] = 'C_admin_syarat_ketentuan/editSK';

// Simpanan Pokok
$route['simpanan-pokok-admin'] = 'C_admin_simpanan_pokok';
$route['get-simpanan-pokok-admin'] = 'C_admin_simpanan_pokok/getSimpananPokok';
$route['get-detail-simpanan-pokok-admin'] = 'C_admin_simpanan_pokok/getDetailSimpananPokok';
$route['proses-simpanan-pokok'] = 'C_admin_simpanan_pokok/prosesSimpananPokok';
$route['proses-simpanan-pokok-cairkan'] = 'C_admin_simpanan_pokok/prosesCairkanSimpananPokok';

$route['pegawai-get-simpanan-pokok'] = 'C_pegawai_simpanan/getDetailSimpananPokok';
$route['pegawai-get-simpanan-wajib'] = 'C_pegawai_simpanan/getSimpananWajib';
$route['pegawai-get-detail-simpanan-wajib'] = 'C_pegawai_simpanan/getDetailSimpananWajib';

// Simpanan Wajib
$route['simpanan-wajib-admin'] = 'C_admin_simpanan_wajib';
$route['get-simpanan-wajib-admin'] = 'C_admin_simpanan_wajib/getSimpananWajib';
$route['get-simpanan-wajib-total-admin'] = 'C_admin_simpanan_wajib/getSimpananWajibTotal';
$route['get-detail-simpanan-wajib-admin'] = 'C_admin_simpanan_wajib/getDetailSimpananWajib';
$route['get-detail-simpanan-wajib-total-admin'] = 'C_admin_simpanan_wajib/getDetailSimpananWajibTotal';
$route['get-detail-simpanan-wajib-tabel-admin'] = 'C_admin_simpanan_wajib/getDetailSimpananWajibTotalTabel';
$route['proses-pencairan'] = 'C_admin_simpanan_wajib/prosesPencairan';
$route['proses-simpanan-wajib'] = 'C_admin_simpanan_wajib/prosesSimpananWajib';

// Wilayah
$route['get-provinsi'] = 'C_wilayah/getProvinsi2';
$route['get-kabupaten'] = 'C_wilayah/getKabupaten';
$route['get-kecamatan'] = 'C_wilayah/getKecamatan';
$route['get-kelurahan'] = 'C_wilayah/getKelurahan';


$route['konfigurasi-layanan'] = 'C_admin_konfigurasi/konfigurasiLayanan';
$route['perbarui-layanan'] = 'C_admin_konfigurasi/perbaruiLayanan';
$route['konfigurasi-web'] = 'C_admin_konfigurasi/konfigurasiWeb';
$route['perbarui-web'] = 'C_admin_konfigurasi/perbaruiWeb';

// Kasir
$route['dashboard-kasir'] = 'C_kasir';
$route['voucher-kasir'] = 'C_kasir/voucherBelanja';
$route['proses-voucher-kasir'] = 'C_kasir/prosesVoucher';
$route['proses-konfirmasi-voucher-kasir'] = 'C_kasir/prosesKonfirmasiVoucher';
// $route['get-voucher-kasir'] = 'C_kasir/voucherData';
$route['get-voucher-kasir'] = 'C_kasir/getVoucher';
$route['get-detail-voucher-kasir'] = 'C_kasir/getDetailVoucher';
$route['get-voucher-id'] = 'C_kasir/getVoucherId';
$route['proses-bayar-rekanan'] = 'C_kasir/prosesBayarRekanan';



///////////////////////////////////////////////// NEW //////////////////////////////
$route['detail-pegawai2'] = 'C_profile/detailPegawai';
$route['cek-data-pegawai-detail2'] = 'C_profile/cekDataPegawaiDetail';
$route['ubah-data-pegawai2'] = 'C_profile/ubahDataPegawai';

$route['detail-kasir2'] = 'C_profile/detailPegawai';
$route['cek-data-kasir-detail2'] = 'C_profile/cekDataKasirDetail';
$route['ubah-data-kasir2'] = 'C_profile/ubahDataKasir';

$route['detail-admin2'] = 'C_profile/detailPegawai';
$route['cek-data-admin-detail2'] = 'C_profile/cekDataAdminDetail';
$route['ubah-data-admin2'] = 'C_profile/ubahDataAdmin';

$route['ubah-foto-ktp2'] = 'C_profile/ubahFotoKTP';
$route['ubah-foto-kk2'] = 'C_profile/ubahFotoKK';
$route['ubah-foto-profil2'] = 'C_profile/ubahFotoProfil';

$route['cek-data-login'] = 'C_login/cekDataLogin';

$route['voucher-pemberitahuan'] = 'C_admin_dashboard/pemberitahuan';
$route['voucher-pemberitahuan-count'] = 'C_admin_dashboard/pemberitahuanCount';

$route['cetak-kartu-anggota'] = 'C_kartu_anggota/cetakKartuAnggota';




$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
