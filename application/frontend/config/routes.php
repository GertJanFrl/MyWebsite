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
|   example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|   http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|   $route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|   $route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/
$route['default_controller'] = 'page';
$route['404_override'] = 'page/error';
$route['translate_uri_dashes'] = FALSE;

$route['sitemap'] = 'page/sitemap';
$route['sitemap.xml'] = 'page/sitemap_xml';
$route['crossdomain.xml'] = 'page/crossdomain_xml';
$route['robots.txt'] = 'page/robots';
$route['articles.xml'] = 'page/articles_xml';

$route['portfolio/(:num)'] = "portfolio/index/$1";
$route['portfolio/(:any)'] = "portfolio/item/$1";
$route['portfolio'] = "portfolio/index";

$route['agenda/(:num)/(:num)'] = "agenda/month/$1/$2";
$route['agenda/(:any)'] = "agenda/item/$1";
$route['agenda'] = "agenda/index";

$route['nieuws/(:num)'] = "article/index/$1";
$route['nieuws/(:any)'] = "article/item/$1";
$route['nieuws'] = "article/index";

$route['diensten/(:any)'] = "diensten/$1";
$route['diensten'] = "diensten/index";

$route['(:any)/(:any)'] = "page/subpage/$1/$2";
$route['(:any)'] = "page/index/$1";

// $route['article/(:num)/(:any)'] = 'article/index/$1/$2';

/* End of file routes.php */
/* Location: ./application/config/routes.php */