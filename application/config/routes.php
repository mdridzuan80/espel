<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'welcome';
$route["first_login"] = "auth/first_login";
$route["login"] = "auth/login";
$route["logout"] = "auth/logout";
$route["reset_katalaluan"] = "auth/reset_katalaluan";
$route["lupa_katalaluan"] = "auth/lupa_katalaluan";
$route["reset/(:any)/(:any)"] = "auth/reset";

$route["api/get_event/(:num)/(:num)/(:num)"] = "welcome/get_event/$1/$2/$3";
$route["api/get_event_pengguna/(:num)/(:num)/(:num)"] = "welcome/get_event_pengguna/$1/$2/$3";
$route["api/get_event_pengguna_2/(:num)/(:num)"] = "welcome/get_event_pengguna_2/$1/$2";
$route["api/get_sen_event_pengguna_2/(:num)/(:num)"] = "welcome/get_sen_event_pengguna_2/$1/$2";
$route["api/get_sen_event_pengguna_3/(:num)"] = "welcome/get_sen_event_pengguna_3/$1";
$route["api/get_event_all/(:num)/(:num)"] = "welcome/get_event_all/$1/$2";
$route["api/get_laporan_gred/(:any)/(:any)"] = "welcome/get_laporan_gred/$1/$2";
$route["api/get_laporan_gred2"] = "welcome/get_laporan_gred2";
$route["api/get_laporan_skim/(:any)"] = "welcome/get_laporan_skim/$1";
$route["api/get_laporan_skim2"] = "welcome/get_laporan_skim2";
$route["api/analisa_reaksi/(:num)"] = "welcome/analisa_reaksi/$1";
$route["api/analisa_pembelajaran/(:num)"] = "welcome/analisa_pembelajaran/$1";
$route["api/analisab_reaksi/(:num)"] = "welcome/analisab_reaksi/$1";
$route["api/analisab_pembelajaran/(:num)"] = "welcome/analisab_pembelajaran/$1";
$route["api/csrf"] = "welcome/ajaxmethod";

$route['profil/papar/(:any)'] = "profil/index/$1";
$route['profil/(:any)/kump'] = "profil/kumpulan/$1";
$route['profil/(:any)/kump/add'] = "profil/kumpulan/$1";
$route['profil/(:any)/kump/(:num)/hapus'] = "profil/kumpulan_hapus/$1/$2";
$route['profil/(:any)/reset_katalaluan'] = "profil/reset_katalaluan/$1";
$route['profil/(:any)/kecuali'] = "profil/kecuali/$1";
$route['profil/(:any)/kecuali/(:num)/hapus'] = "profil/kecuali_hapus/$1/$2";
$route['profil/(:any)/status'] = "pengguna/status/$1";

$route['konfigurasi/email'] = "konfigurasi/email_show";
$route['konfigurasi/email/add'] = "konfigurasi/email_add";
$route['konfigurasi/email/(:num)/default'] = "konfigurasi/email_set_default/$1";
$route['konfigurasi/email/(:num)/kemaskini'] = "konfigurasi/email_edit/$1";
$route['konfigurasi/email/(:num)/hapus'] = "konfigurasi/email_deleted/$1";
$route['konfigurasi/email/(:num)/ujian'] = "konfigurasi/email_ujian/$1";

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
