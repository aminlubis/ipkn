<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------
| BREADCRUMB CONFIG
| -------------------------------------------------------------------
| This file will contain some breadcrumbs' settings.
|
| $config['crumb_divider']		The string used to divide the crumbs
| $config['tag_open'] 			The opening tag for breadcrumb's holder.
| $config['tag_close'] 			The closing tag for breadcrumb's holder.
| $config['crumb_open'] 		The opening tag for breadcrumb's holder.
| $config['crumb_close'] 		The closing tag for breadcrumb's holder.
|
| Defaults provided for twitter bootstrap 2.0
*/

$config['crumb_divider'] = '<span class="kt-subheader__breadcrumbs-separator">&nbsp;<i class="fa fa-angle-double-right"></i></span>';
$config['tag_open'] = '<div class="kt-subheader__breadcrumbs">';
$config['tag_close'] = '</div>';
$config['crumb_open'] = '<a>';
$config['crumb_last_open'] = '<a class="active">';
$config['crumb_close'] = '</a>';


/* End of file breadcrumbs.php */
/* Location: ./application/config/breadcrumbs.php */