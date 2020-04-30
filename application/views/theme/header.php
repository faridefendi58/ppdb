<!DOCTYPE html>
<html lang="en">
<head>
   <meta charset="utf-8" />
   <title><?=config('nama_sekolah');?></title>
   <meta content="width=device-width, initial-scale=1.0" name="viewport" />
   <meta content="<?=config('meta_description');?>" name="description" />
   <meta content="<?=config('meta_keywords');?>" name="keywords" />
   <meta content="<?=$this->config->item('author');?>" name="author"/>
   <link href="<?=base_url();?>assets/theme/assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
   <link href="<?=base_url();?>assets/theme/assets/bootstrap/css/bootstrap-fileupload.css" rel="stylesheet" />
   <link rel="stylesheet" type="text/css" href="<?=base_url();?>assets/theme/assets/bootstrap-wysihtml5/bootstrap-wysihtml5.css" />
   <link href="<?=base_url();?>assets/theme/assets/bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet" />
   <link href="<?=base_url();?>assets/theme/assets/bootstrap/css/bootstrap-fileupload.css" rel="stylesheet" />
   <link href="<?=base_url();?>assets/theme/assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
   <link href="<?=base_url();?>assets/theme/css/style.css" rel="stylesheet" />
   <link rel="stylesheet" type="text/css" href="<?=base_url();?>assets/theme/assets/chosen-bootstrap/chosen/chosen.css" />
   <link href="<?=base_url();?>assets/theme/css/style_responsive.css" rel="stylesheet" />
   <link href="<?=base_url();?>assets/theme/css/style_default.css" rel="stylesheet" id="style_color" />
   <link href="<?=base_url();?>assets/theme/assets/fancybox/source/jquery.fancybox.css" rel="stylesheet" />
   <link rel="stylesheet" type="text/css" href="<?=base_url();?>assets/theme/assets/uniform/css/uniform.default.css" />
   <link rel="shortcut icon" href="<?php echo base_url();?>assets/images/icon.png" type="image/x-icon" />
</head>
<body class="fixed-top">
   <div id="header" class="navbar navbar-inverse navbar-fixed-top">
       <div class="navbar-inner">
           <div class="container-fluid">
               <?php
               if ($this->auth->is_logged_in() == TRUE)
               {
                   echo anchor('dashboard', 'Administrator', array('class' => 'brand'));  
               }
               else
               {
                   echo anchor(base_url(), '<center><h4>PPDB Online</h4></center> <h5>SMKN 2 Muara Enim</h5>', array('class' => 'brand'));
               }               
               ?>
               <a class="btn btn-navbar collapsed" id="main_menu_trigger" data-toggle="collapse" data-target=".nav-collapse">
                   <span class="icon-bar"></span>
                   <span class="icon-bar"></span>
                   <span class="icon-bar"></span>
                   <span class="arrow"></span>
               </a>
               <?php if ($this->auth->is_logged_in() == TRUE) { ?>
               <div class="top-nav ">
                   <ul class="nav pull-right top-menu" >
                       <li class="dropdown">
                           <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                               <img src="<?=base_url();?>assets/theme/img/avatar.png" alt="">
                               <span class="username"><?=$this->session->userdata('user_display');?></span>
                               <b class="caret"></b>
                           </a>
                           <ul class="dropdown-menu">
                               <li><?=anchor('users/update', '<i class="icon-user"></i> My Profile');?></li>
                               <li><?=anchor('login/logout', '<i class="icon-signout"></i> Log Out');?></li>
                           </ul>
                       </li>
                   </ul>
               </div>
               <?php } ?>
           </div>
       </div>
   </div>
   <div id="container" class="row-fluid">