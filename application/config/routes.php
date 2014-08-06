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

$route['categories'] = "home/index/all";
$route['categories/all'] = "home/index/all";
$route['categories/(:num)'] = "home/index/all/$1";
$route['categories/(:any)'] = "home/index/$1";
$route['categories/(:any)/(:num)'] = "home/index/$1/$2";

$route['wallet/success/(:num)'] = "wallet/success/$1";
$route['wallet/failure/(:num)'] = "wallet/failure/$1";
$route['wallet/generate-transaction-code/(:num)'] = "wallet/generate_transaction_code/$1";

$route['login'] = "home/login";
$route['logout'] = "home/logout";
$route['signup'] = "home/signup";
$route['contact'] = 'home/contact';
$route['about'] = 'home/about_us';
$route['how-it-works'] = 'home/how_it_works';
$route['help-faq'] = 'home/help_faq';
$route['profile'] = 'home/profile';
$route['user/forgot-password'] = 'home/forgot_password';
$route['reset_password'] = 'home/reset_password';
$route['edit-profile'] = 'home/edit_profile';
$route['settings'] = 'home/settings';
$route['coupon-not-found'] = 'home/coupon_not_found';
$route['my-coupons'] = 'home/my_coupons';
$route['my-coupons/(:any)'] = 'home/my_coupons/$1';
$route['my-coupons/(:any)/(:num)'] = 'home/my_coupons/$1/$2';
$route['grab_coupon/(:any)'] = 'home/grab_coupon/$1';

$route['coupon'] = "home/index/all";
$route['coupon/(:any)'] = 'home/coupon/$1';

$route['search'] = 'home/search/0/all/';
$route['search/(:num)'] = 'home/search/$1/all/';
$route['search/(:any)'] = 'home/search/0/all/$1';
$route['search/(:num)/(:any)'] = 'home/search/$1/$2/';
$route['search/(:num)/(:any)/(:any)'] = 'home/search/$1/$2/$3';

$route['error'] = 'home/error_page';
$route['error/(:num)'] = 'home/error_page/$1';

//-----------MERCHANT ROUTES----------------------------------

$route['merchant'] = 'merchant/index';
$route['merchant/dashboard'] = 'merchant/dashboard';
$route['merchant/login'] = 'merchant/login';
$route['merchant/logout'] = "merchant/logout";
$route['merchant/edit-profile'] = "merchant/edit_profile";
$route['merchant/signup'] = 'merchant/create';
$route['merchant/add-coupon'] = "merchant/add_coupon";
$route['merchant/my-coupons'] = 'merchant/my_coupons';
$route['merchant/my-coupons/(:any)'] = 'merchant/my_coupons/$1';
$route['merchant/my-coupons/(:any)/(:num)'] = 'merchant/my_coupons/$1/$2';
$route['merchant/verify-coupon'] = 'coupon/verify_coupon';
$route['merchant/forgot-password'] = 'merchant/forgot_password';
$route['merchant/reset_password'] = 'merchant/reset_password';


//$route['api/user'] = 'api/user/index';
//$route['api/user/(:num)'] = 'api/user/index/$1';
//$route['api/user/(:any)'] = 'api/user';
$route['404_override'] = 'home/error_page';


/* End of file routes.php */
/* Location: ./application/config/routes.php */