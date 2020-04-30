<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

//if ( ! isset($content)) exit('page not loaded');
$this->load->view('theme/header');
$this->load->view('theme/sidebar');
$this->load->view($content);
$this->load->view('theme/footer');