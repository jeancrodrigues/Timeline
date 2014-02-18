<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$route['default_controller'] = 'user';
$route['404_override'] = '';

$route['user'] = 'user';
$route['user/(:num)'] = 'user/user_by_id';
$route['user/(:num)/posts'] = 'post/posts_by_iduser';
// ultimo parametro para paginacao ex: 1: primeiros 25 posts; 2: post 26-50; 3: 51-75 etc
$route['user/(:num)/posts/(:num)'] = 'post/posts_by_iduser';

$route['user/teste'] = 'user/insert_user';
$route['user/(:any)'] = 'user/user_by_name';

$route['users'] = 'user/list_users';
$route['users/(:any)'] = 'user/list_users';

$route['posts'] = 'post/list_posts';
$route['post/(:num)'] = 'post/post_by_id';
$route['posts/(:num)'] = 'post/posts_by_iduser';


