<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
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

$route['default_controller'] = 'dashboard';
$route['404_override'] = 'dashboard';

$route['article/(:num)/(:any)'] = 'article/index/$1/$2';

$route['diensten/domein'] = 'diensten/domein_index';
$route['diensten/domein/(:any)'] = 'diensten/domein_$1';

$route['diensten/hosting'] = 'diensten/hosting_web_index';
$route['diensten/hosting/web/(:any)'] = 'diensten/hosting_web_$1';
$route['diensten/hosting/web'] = 'diensten/hosting_web_index';

$route['diensten/hosting/reseller'] = 'diensten/hosting_reseller_index';
$route['diensten/hosting/reseller/(:any)'] = 'diensten/hosting_reseller_$1';

$route['diensten/hosting/vps'] = 'diensten/hosting_vps_index';
$route['diensten/hosting/vps/(:any)'] = 'diensten/hosting_vps_$1';

/* End of file routes.php */
/* Location: ./application/config/routes.php */