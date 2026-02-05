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
|	https://codeigniter.com/userguide3/general/routing.html
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
$route['default_controller'] = 'frontend';
$route['profile/struktur-organisasi'] = 'frontend/struktur_organisasi';
$route['dokumen-spmi'] = 'frontend/dokumen';
$route['data-program-studi'] = 'frontend/prodi';
$route['data-program-studi/(:num)'] = 'frontend/detail_prodi/$1';
$route['data-laporan'] = 'frontend/laporan';
$route['data-laporan/(:num)'] = 'frontend/detail_laporan/$1';

// Profile LPM Routes (Frontend)
$route['profile'] = 'Profile/index';
$route['profile/tentang'] = 'Profile/tentang';
$route['profile/visi-misi'] = 'Profile/visi_misi';
$route['profile/tugas'] = 'Profile/tugas';
$route['profile/api'] = 'Profile/api_get';
$route['profile/api/(:any)'] = 'Profile/api_get/$1';

// Frontend Routes
$route['kegiatan'] = 'frontend/kegiatan';
$route['kegiatan/detail-kegiatan/(:num)'] = 'frontend/detail_kegiatan/$1';


$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

// Backend Admin Routes
$route['admin'] = 'Admin/index';
$route['admin/login'] = 'Admin/login';
$route['admin/logout'] = 'Admin/logout';

//profile lpm routes (admin)
$route['admin/profile-lpm'] = 'Profilelpm/index';
$route['admin/profile-lpm/create'] = 'Profilelpm/create';
$route['admin/profile-lpm/store'] = 'Profilelpm/store';
$route['admin/profile-lpm/edit/(:num)'] = 'Profilelpm/edit/$1';
$route['admin/profile-lpm/update/(:num)'] = 'Profilelpm/update/$1';
$route['admin/profile-lpm/delete/(:num)'] = 'Profilelpm/delete/$1';
$route['admin/profile-lpm/toggle/(:num)'] = 'Profilelpm/toggle_status/$1';

// Admin User Management Routes
$route['admin/user-management'] = 'UserManagement/index';
$route['admin/user-management/create'] = 'UserManagement/create';
$route['admin/user-management/store'] = 'UserManagement/store';
$route['admin/user-management/detail/(:num)'] = 'UserManagement/detail/$1';
$route['admin/user-management/edit/(:num)'] = 'UserManagement/edit/$1';
$route['admin/user-management/update/(:num)'] = 'UserManagement/update/$1';
$route['admin/user-management/delete/(:num)'] = 'UserManagement/delete/$1';
$route['admin/user-management/toggle/(:num)'] = 'UserManagement/toggle_status/$1';
$route['admin/user-management/change-role/(:num)'] = 'UserManagement/change_role/$1';
$route['admin/user-management/reset-password/(:num)'] = 'UserManagement/reset_password/$1';
$route['admin/user-management/remove-avatar/(:num)'] = 'UserManagement/remove_avatar/$1';
$route['admin/user-management/search'] = 'UserManagement/search';
$route['admin/user-management/export'] = 'UserManagement/export';

// Admin Struktur Routes - Using main controller directory
$route['admin/struktur/detail/(:num)'] = 'Struktur/detail/$1';
$route['admin/struktur/edit/(:num)'] = 'Struktur/edit/$1';
$route['admin/struktur/update/(:num)'] = 'Struktur/update/$1';
$route['admin/struktur/delete/(:num)'] = 'Struktur/delete/$1';
$route['admin/struktur/store'] = 'Struktur/store';
$route['admin/struktur/create'] = 'Struktur/create';
$route['admin/struktur'] = 'Struktur/index';

// Admin Prodi Routes - Using main controller directory
$route['admin/prodi/detail/(:num)'] = 'Prodi/detail/$1';
$route['admin/prodi/edit/(:num)'] = 'Prodi/edit/$1';
$route['admin/prodi/update/(:num)'] = 'Prodi/update/$1';
$route['admin/prodi/delete/(:num)'] = 'Prodi/delete/$1';
$route['admin/prodi/store'] = 'Prodi/store';
$route['admin/prodi/create'] = 'Prodi/create';
$route['admin/prodi'] = 'Prodi/index';

// Admin Kegiatan Routes - MUST be before general routes
$route['admin/kegiatan/detail/(:num)'] = 'kegiatan/detail/$1';
$route['admin/kegiatan/edit/(:num)'] = 'kegiatan/edit/$1';
$route['admin/kegiatan/delete/(:num)'] = 'kegiatan/delete/$1';
$route['admin/kegiatan/update/(:num)'] = 'kegiatan/update/$1';
$route['admin/kegiatan/store'] = 'kegiatan/store';
$route['admin/kegiatan/create'] = 'kegiatan/create';
$route['admin/kegiatan'] = 'kegiatan/index';


// ADMIN Laporan Routes
$route['admin/laporan'] = 'laporan/index';
$route['admin/laporan/create'] = 'laporan/create';
$route['admin/laporan/store'] = 'laporan/store';
$route['admin/laporan/edit/(:num)'] = 'laporan/edit/$1';
$route['admin/laporan/update/(:num)'] = 'laporan/update/$1';
$route['admin/laporan/delete/(:num)'] = 'laporan/delete/$1';



//contact admin page
$route['admin/contact/detail/(:num)'] = 'backend/Contact/detail/$1';
$route['admin/contact/delete/(:num)'] = 'backend/Contact/delete/$1';
$route['admin/contact/restore/(:num)'] = 'backend/Contact/restore/$1';
$route['admin/contact/permanent_delete/(:num)'] = 'backend/Contact/permanent_delete/$1';
$route['admin/contact'] = 'backend/Contact/index';

// Dokumen management
$route['admin/dokumen'] = 'Dokumen/index';
$route['admin/dokumen/create'] = 'Dokumen/create';
$route['admin/dokumen/store'] = 'Dokumen/store';
$route['admin/dokumen/edit/(:num)'] = 'Dokumen/edit/$1';
$route['admin/dokumen/update/(:num)'] = 'Dokumen/update/$1';
$route['admin/dokumen/delete/(:num)'] = 'Dokumen/delete/$1';

// setting konfiguration 
$route['admin/settingconfig'] = 'Settingconfig/index';
$route['admin/settingconfig/create'] = 'Settingconfig/create';
$route['admin/settingconfig/store'] = 'Settingconfig/store';
$route['admin/settingconfig/edit/(:num)'] = 'Settingconfig/edit/$1';
$route['admin/settingconfig/update/(:num)'] = 'Settingconfig/update/$1';
$route['admin/settingconfig/delete/(:num)'] = 'Settingconfig/delete/$1';

// General Admin Routes (catch-all for other admin modules) - MUST be LAST
$route['admin/(:any)/(:any)/(:any)'] = 'backend/$1/$2/$3';
$route['admin/(:any)/(:any)'] = 'backend/$1/$2';
$route['admin/(:any)'] = 'backend/$1';

// user management
$route['admin/user-management'] = 'UserManagement/index';
$route['admin/user-management/create'] = 'UserManagement/create';
$route['admin/user-management/store'] = 'UserManagement/store';
$route['admin/user-management/edit/(:num)'] = 'UserManagement/edit/$1';
$route['admin/user-management/update/(:num)'] = 'UserManagement/update/$1';
$route['admin/user-management/delete/(:num)'] = 'UserManagement/delete/$1';

