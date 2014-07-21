<?php

if (!defined('BASEPATH'))
    exit('No direct script access allowed');
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
  |	http://codeigniter.com/user_guide/general/routing.html
  |
  | -------------------------------------------------------------------------
  | RESERVED ROUTES
  | -------------------------------------------------------------------------
  |
  | There area two reserved routes:
  |
  |	$route['default_controller'] = 'welcome';
  |
  | This route indicates which controller class should be loaded if the
  | URI contains no data. In the above example, the "welcome" class
  | would be loaded.
  |
  |	$route['404_override'] = 'errors/page_missing';
  |
  | This route will tell the Router what URI segments to use if those provided
  | in the URL cannot be matched to a valid route.
  |
 */

$route['default_controller'] = "home";
$route['coupons'] = "home/index/0/all";
$route['coupons/(:num)'] = "home/index/$1/all";
$route['coupons/(:num)/(:num)'] = "home/index/$1/$2";

$route['category/all'] = "home/index/0";
$route['category/'] = "";

$route['sell'] = 'merchant/index';
$route['contact'] = 'static_pages/contact';
$route['about'] = 'static_pages/about_us';
$route['how-it-works'] = 'static_pages/how_it_works';
$route['help-faq'] = 'static_pages/help_faq';

$route['search'] = 'home/search/0/all/';
$route['search/(:num)'] = 'home/search/$1/all/';
$route['search/(:any)'] = 'home/search/0/all/$1';
$route['search/(:num)/(:any)'] = 'home/search/$1/$2/';
$route['search/(:num)/(:any)/(:any)'] = 'home/search/$1/$2/$3';
//$route['api/user'] = 'api/user/index';
//$route['api/user/(:num)'] = 'api/user/index/$1';
//$route['api/user/(:any)'] = 'api/user';
$route['404_override'] = 'static_pages/error_page';


/* End of file routes.php */
/* Location: ./application/config/routes.php */