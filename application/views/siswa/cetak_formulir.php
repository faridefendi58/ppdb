<div id="main-content">
   <div class="container-fluid">
       <div class="row-fluid">
           <div class="span12">
               <h3 class="page-title"><?=$title;?></h3>
           </div>
       </div>
       <?=$message;?>
       <div class="row-fluid">
           <div class="span12">
                <div class="widget">
                     <div class="widget-title">
                          <h4><i class="icon-file"></i></h4>
                     </div>
                     <div class="widget-body form">
                          <?=form_open($action, 'class="form-horizontal"');?>
                              
                              <div class="control-group">
                                   <label class="control-label">Nomor Pendaftaran</label>
                                   <div class="controls">
                                       <input type="text" name="no_daftar" required="true" class="span12" autocomplete="off" autofocus="true"/>
                                   </div>
                              </div>

                              <div class="control-group">
                                   <label class="control-label">Tanggal Lahir</label>
                                   <div class="controls">
                                       <input name="tgl_lahir" required="true" class="span5" type="text" data-mask="9999-99-99" autocomplete="off">
                                       <span class="help-inline">Tahun-Bulan-Tanggal</span>
                                   </div>
                              </div>
                              
                              <div class="form-actions">
                                   <button type="submit" class="btn btn-success"><?=$button;?></button>
                              </div>
                          </form>
                     </div>
                </div>
           </div>
       </div>
   </div>
</div>