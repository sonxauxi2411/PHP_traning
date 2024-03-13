<?php
$routes['default_controller'] = 'home';

/** Đường dẫn ảo => đường đãn thật
 * 
 */
// $routes['san-pham'] = 'products/index';
// $routes[''] = 'home';
$routes['trang-chu'] = 'home';
$routes['san-pham/(.+)'] = 'product/detail/$1';
$routes['tin-tuc/(.+)'] = 'news/category/$1';
