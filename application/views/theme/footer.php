</div>
   <div id="footer">
    <?=copyright();?><br>
    <?=config('alamat');?><br>
    <?=$this->config->item('setup');?>
   </div>
   <script src="<?=base_url();?>assets/theme/js/jquery-1.8.3.min.js"></script>
   <script type="text/javascript" src="<?=base_url();?>assets/theme/assets/bootstrap-wysihtml5/wysihtml5-0.3.0.js"></script>
   <script type="text/javascript" src="<?=base_url();?>assets/theme/assets/bootstrap-wysihtml5/bootstrap-wysihtml5.js"></script>
   <script type="text/javascript" src="<?=base_url();?>assets/theme/assets/bootstrap-inputmask/bootstrap-inputmask.min.js"></script>
   <script type="text/javascript" src="<?=base_url();?>assets/theme/assets/chosen-bootstrap/chosen/chosen.jquery.min.js"></script>
   <script src="<?=base_url();?>assets/theme/assets/bootstrap/js/bootstrap.min.js"></script>
   <script type="text/javascript" src="<?=base_url();?>assets/theme/assets/data-tables/jquery.dataTables.js"></script>
   <script type="text/javascript" src="<?=base_url();?>assets/theme/assets/data-tables/DT_bootstrap.js"></script>
   <script type="text/javascript" src="<?=base_url();?>assets/theme/assets/uniform/jquery.uniform.min.js"></script>
   <script type="text/javascript" src="<?=base_url();?>assets/theme/assets/bootstrap/js/bootstrap-fileupload.js"></script>
   <script src="<?=base_url();?>assets/theme/js/scripts.js"></script>
   <script>
      jQuery(document).ready(function() {
         App.init();
      });
   </script>
</body>
</html>