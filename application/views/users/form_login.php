<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <title>Login page</title>
  <meta content="width=device-width, initial-scale=1.0" name="viewport" />
  <meta content="<?=config('meta_description');?>" name="description" />
  <meta content="<?=config('meta_keywords');?>, Website Sekolah Gratis, Anton Sofyan, http://antonsofyan.com, http://aditiaweb.com" name="keywords" />
  <meta content="<?=$this->config->item('author');?>" name="author" />
  <link href="<?=base_url();?>assets/theme/assets/bootstrap/css/bootstrap.min.css" rel="stylesheet" />
  <link href="<?=base_url();?>assets/theme/assets/font-awesome/css/font-awesome.css" rel="stylesheet" />
  <link href="<?=base_url();?>assets/theme/css/style.css" rel="stylesheet" />
  <link href="<?=base_url();?>assets/theme/css/style_responsive.css" rel="stylesheet" />
</head>
<body id="login-body">
    <?=$alert;?>
    <div id="login">
      <h4 align=center>Penerimaan Siswa Baru</h4>
      <h4 align=center><?=config('nama_sekolah');?></h4>
      <?=form_open('adnel/process', 'class="form-vertical no-padding no-margin" id="loginform"');?>
      <div class="lock">
          <i class="icon-lock"></i>
      </div>
      <div class="control-wrap">
          <br />
          <div class="control-group">
              <div class="controls">
                  <div class="input-prepend">
                      <span class="add-on"><i class="icon-user"></i></span>
                      <input name="user_name" required="true" autocomplete="off" id="input-username" type="text" placeholder="Nama Pengguna" autofocus="true" />
                  </div>
              </div>
          </div>
          <div class="control-group">
              <div class="controls">
                  <div class="input-prepend">
                      <span class="add-on"><i class="icon-key"></i></span>
                      <input name="user_password" required="true" id="input-password" type="password" placeholder="Kata Sandi" />
                  </div>
                  <div class="clearfix space5"></div>
              </div>

          </div>
      </div>
      <input type="submit" id="login-btn" class="btn btn-block login-btn" value="Login" />
      <?=form_close();?>
  </div>
  <div id="login-copyright">
      <?=copyright();?><br>
      <?=config('alamat');?><br>
      <?=$this->config->item('setup');?>
  </div>
  <script src="<?=base_url();?>assets/theme/js/jquery-1.8.3.min.js"></script>
  <script src="<?=base_url();?>assets/theme/assets/bootstrap/js/bootstrap.min.js"></script>
  <script src="<?=base_url();?>assets/theme/js/scripts.js"></script>
  <script>
    jQuery(document).ready(function() {     
      App.initLogin();
    });
  </script>
</body>
</html>