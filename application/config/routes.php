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

$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;

// Backend Admin Routes
$route['admin'] = 'Admin/index';
$route['admin/login'] = 'Admin/login';
$route['admin/logout'] = 'Admin/logout';

// Admin Struktur Routes - Using main controller directory
$route['admin/struktur/detail/(:num)'] = 'Struktur/detail/$1';
$route['admin/struktur/edit/(:num)'] = 'Struktur/edit/$1';
$route['admin/struktur/update/(:num)'] = 'Struktur/update/$1';
$route['admin/struktur/delete/(:num)'] = 'Struktur/delete/$1';
$route['admin/struktur/store'] = 'Struktur/store';
$route['admin/struktur/create'] = 'Struktur/create';
$route['admin/struktur'] = 'Struktur/index';

// Admin Kegiatan Routes - MUST be before general routes
$route['admin/kegiatan/detail/(:num)'] = 'backend/Kegiatan/detail/$1';
$route['admin/kegiatan/edit/(:num)'] = 'backend/Kegiatan/edit/$1';
$route['admin/kegiatan/delete/(:num)'] = 'backend/Kegiatan/delete/$1';
$route['admin/kegiatan/update/(:num)'] = 'backend/Kegiatan/update/$1';
$route['admin/kegiatan/store'] = 'backend/Kegiatan/store';
$route['admin/kegiatan/create'] = 'backend/Kegiatan/create';
$route['admin/kegiatan'] = 'kegiatan/index';

// Frontend Routes
$route['kegiatan/detail/(:num)'] = 'frontend/kegiatan/detail/$1';
$route['kegiatan'] = 'frontend/kegiatan';
$route['kegiatan/(:any)'] = 'frontend/kegiatan/$1';

//contact admin page
$route['admin/contact/detail/(:num)'] = 'backend/Contact/detail/$1';
$route['admin/contact/delete/(:num)'] = 'backend/Contact/delete/$1';
$route['admin/contact/restore/(:num)'] = 'backend/Contact/restore/$1';
$route['admin/contact/permanent_delete/(:num)'] = 'backend/Contact/permanent_delete/$1';
$route['admin/contact'] = 'backend/Contact/index';

// Dokumen management
$route['admin/dokumen'] = 'Dokumen/index';

// General Admin Routes (catch-all for other admin modules) - MUST be LAST
$route['admin/(:any)/(:any)/(:any)'] = 'backend/$1/$2/$3';
$route['admin/(:any)/(:any)'] = 'backend/$1/$2';
$route['admin/(:any)'] = 'backend/$1';

