<?php
defined('BASEPATH') or exit('No direct script access allowed');

$route['default_controller'] = 'home';
$route['404_override'] = 'not_found';
$route['translate_uri_dashes'] = FALSE;

// route admin
$route['admin'] = 'admin/dashboard';

// route kurir
$route['kurir'] = 'kurir/dashboard';

// route pelayan
$route['pelayan'] = 'pelayan/dashboard';

// route manager
$route['manager'] = 'manager/dashboard';

// route user
$route['users'] = 'home';

// route users
$route['produk']                 = 'users/produk';
$route['produk/detail/(:any)']   = 'users/produk/detail';
$route['produk/kategori/(:any)'] = 'users/produk/kategori';
$route['riwayat']                     = 'users/riwayat';
$route['riwayat/load_rating']         = 'users/riwayat/load_rating';
$route['riwayat/save_rating']         = 'users/riwayat/save_rating';
$route['riwayat/detail/(:any)']       = 'users/riwayat/detail';
$route['lacak/(:any)']                = 'users/riwayat/lacak';
$route['load_chat/(:any)']            = 'users/riwayat/load_chat';
$route['send_chat']                   = 'users/riwayat/send_chat';
$route['batal']                       = 'users/riwayat/batal';
$route['keranjang']                   = 'users/keranjang';
$route['keranjang/add']               = 'users/keranjang/add';
$route['keranjang/del']               = 'users/keranjang/del';
$route['keranjang/detail/(:any)']     = 'users/keranjang/detail';
$route['checkout']                    = 'users/keranjang/checkout';
$route['checkout/finish']             = 'users/keranjang/checkout_finish';
$route['nota/(:any)']                 = 'users/keranjang/nota';
$route['cetak/(:any)']                = 'users/keranjang/cetak';
$route['transfer/(:any)']             = 'users/keranjang/transfer';
$route['pembayaran']                  = 'users/keranjang/pembayaran';

// route home
$route['tentang']       = 'home/tentang';
$route['kontak']        = 'home/kontak';
$route['panduan']       = 'home/panduan';
$route['diskon/(:any)'] = 'home/diskon';
