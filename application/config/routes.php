<?php
defined('BASEPATH') OR exit('No direct script access allowed');

$route['Posts']='Posts/index';
$route['default_controller'] = 'Pages/view';
$route['(:any)']='Pages/view/$1';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
