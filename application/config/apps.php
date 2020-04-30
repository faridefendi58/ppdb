<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

$CI =& get_instance();

$CI->load->helper(array('url'));

$config['developer'] = '';
$config['aditiaweb'] = '';
$config['author']    = '';
$config['setup']     = 'Developed By : '.anchor('http://webmastersolusindo.co.id', 'Webmaster Solusindo - Master Digitech Corporation', array('target' => '_blank'));