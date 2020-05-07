<div id="main-content">
   <div class="container-fluid">
       <div class="row-fluid">
           <div class="span12">
               <h3 class="page-title">Pengaturan Aplikasi</h3>
           </div>
       </div>
       <?=$message;?>
       <div class="row-fluid">
           <div class="span12">
                <div class="widget">
                     <div class="widget-title">
                          <h4><i class="icon-cogs"></i></h4>
                          <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                          </span>
                     </div>
                     <div class="widget-body form">
                          <?=form_open_multipart($action, 'class="form-horizontal"');?>
                              
                              <div class="control-group">
                                  <label class="control-label">Nama Sekolah</label>
                                  <div class="controls">
                                     <input type="text" name="nama_sekolah" required="true" value="<?=set_value('nama_sekolah') ? set_value('nama_sekolah') : $query['nama_sekolah']?>" class="span12" autocomplete="off" placeholder="Dibutuhkan untuk laporan PPDB"/>
                                  </div>
                              </div>
                              
                              <div class="control-group">
                                  <label class="control-label">Alamat</label>
                                  <div class="controls">
                                     <textarea name="alamat" required="true" class="span12" rows="4" placeholder="Dibutuhkan untuk laporan PPDB"><?=set_value('alamat') ? set_value('alamat') : $query['alamat']?></textarea>
                                  </div>
                              </div>
                              
                              <div class="control-group">
                                  <label class="control-label">Kota</label>
                                  <div class="controls">
                                     <input type="text" name="kota" required="true" value="<?=set_value('kota') ? set_value('kota') : $query['kota']?>" class="span12" autocomplete="off" placeholder="Dibutuhkan untuk laporan PPDB"/>
                                  </div>
                              </div>
                              
                              <div class="control-group">
                                  <label class="control-label">Email</label>
                                  <div class="controls">
                                      <input type="email" name="email" required="true" value="<?=set_value('email') ? set_value('email') : $query['email']?>" class="span12" autocomplete="off" placeholder="Dibutuhkan untuk laporan PPDB"/>
                                  </div>
                              </div>
                              
                              <div class="control-group">
                                  <label class="control-label">Website</label>
                                  <div class="controls">
                                      <input type="text" name="website" required="true" value="<?=set_value('website') ? set_value('website') : $query['website']?>" class="span12" autocomplete="off" placeholder="Dibutuhkan untuk laporan PPDB"/>
                                  </div>
                              </div>
                              
                              <div class="control-group">
                                  <label class="control-label">Akreditasi</label>
                                  <div class="controls">
                                     <input type="text" name="akreditasi" required="true" value="<?=set_value('akreditasi') ? set_value('akreditasi') : $query['akreditasi']?>" class="span12" autocomplete="off" placeholder="Dibutuhkan untuk laporan PPDB"/>
                                  </div>
                              </div>
                              
                              <div class="control-group">
                                  <label class="control-label">Logo Sekolah</label>
                                  <div class="controls">
                                      <div class="fileupload fileupload-new" data-provides="fileupload">
                                          <div class="fileupload-new thumbnail" style="width: auto; height: auto;">
                                              <img src="<?=$logo;?>"/>
                                          </div>
                                          <div class="fileupload-preview fileupload-exists thumbnail" style="max-width:; max-height: 150px; line-height: 20px;"></div>
                                          <div>
                                             <span class="btn btn-file">
                                                <span class="fileupload-new">Browse</span>
                                                <span class="fileupload-exists">Change</span>
                                                <input type="file" class="default" name="file"/>
                                             </span>
                                             <a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a>
                                          </div>
                                      </div>
                                      <div class="text-warning">Catatan ! Hanya file dengan type .JPG dan ukuran file maksimal 5 Mb.</div>
                                  </div>
                              </div>

                         <div class="control-group">
                             <label class="control-label">Logo (Additional)</label>
                             <div class="controls">
                                 <div class="fileupload fileupload-new" data-provides="fileupload">
                                     <div class="fileupload-new thumbnail" style="width: auto; height: auto;">
                                         <img src="<?=$logo2;?>"/>
                                     </div>
                                     <div class="fileupload-preview fileupload-exists thumbnail" style="max-width:; max-height: 150px; line-height: 20px;"></div>
                                     <div>
                                             <span class="btn btn-file">
                                                <span class="fileupload-new">Browse</span>
                                                <span class="fileupload-exists">Change</span>
                                                <input type="file" class="default" name="file2" accept=".jpg" oninput="return checkImage(this);"/>
                                             </span>
                                         <a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a>
                                     </div>
                                 </div>
                                 <div class="text-warning">Catatan ! Hanya file dengan type .JPG dan ukuran file maksimal 5 Mb.</div>
                             </div>
                             <input type="hidden" name="logo2_old" value="<?php echo $query['logo2']; ?>">
                         </div>
                              
                              <div class="control-group error">
                                  <label class="control-label">PPDB Tahun</label>
                                  <div class="controls">
                                     <input type="text" name="ppdb_tahun" required="true" value="<?=set_value('ppdb_tahun') ? date('Y') : $query['ppdb_tahun']?>" class="span12" autocomplete="off"/>
                                     <p class="help-block">
                                     <i class="icon-edit"></i> Informasi : Tahun yang akan diberlakukan dalam seluruh proses PPDB Online.
                                     </p>
                                  </div>
                              </div>
                                
                              <div class="control-group">
                                  <label class="control-label">Status Pendaftaran</label>
                                  <div class="controls">
                                     <?php
                                     $status_daftar = array('y' => 'Dibuka', 'n' => 'Ditutup');
                                     echo form_dropdown('status_daftar', $status_daftar, $query['status_daftar'], 'class="span12 chosen"');
                                     ?>
                                  </div>
                              </div>

                         <div class="control-group">
                             <label class="control-label">Status Pengumuman</label>
                             <div class="controls">
                                 <?php
                                 $status_pengumuman = array('open' => 'Dibuka', 'closed' => 'Ditutup');
                                 echo form_dropdown('status_pengumuman', $status_pengumuman, $query['status_pengumuman'], 'class="span12 chosen"');
                                 ?>
                             </div>
                         </div>

                              <div class="control-group">
                                  <label class="control-label">Meta Keyword</label>
                                  <div class="controls">
                                     <textarea name="meta_keywords" required="true" class="span12" rows="4"><?=set_value('meta_keywords') ? set_value('meta_keywords') : $query['meta_keywords']?></textarea>
                                  </div>
                              </div>
                              
                              <div class="control-group">
                                  <label class="control-label">Meta Description</label>
                                  <div class="controls">
                                     <textarea name="meta_description" required="true" class="span12 " rows="4"><?=set_value('meta_description') ? set_value('meta_description') : $query['meta_description']?></textarea>
                                  </div>
                              </div>
                              
                              <div class="control-group">
                                  <label class="control-label">Pesan Sukses</label>
                                  <div class="controls">
                                     <textarea name="pesan_sukses" required="true" class="span12" rows="5"><?=set_value('pesan_sukses') ? set_value('pesan_sukses') : $query['pesan_sukses']?></textarea>
                                  </div>
                              </div>
                              
                              <div class="control-group">
                                  <label class="control-label">Pesan Gagal</label>
                                  <div class="controls">
                                     <textarea name="pesan_gagal" required="true" class="span12" rows="5"><?=set_value('pesan_gagal') ? set_value('pesan_gagal') : $query['pesan_gagal']?></textarea>
                                  </div>
                              </div>
                              
                              <div class="control-group">
                                  <label class="control-label">Informasi Pendaftaran</label>
                                  <div class="controls">
                                     <textarea name="pesan_status_daftar" required="true" class="span12 wysihtml5" rows="12"><?=set_value('pesan_status_daftar') ? set_value('pesan_status_daftar') : $query['pesan_status_daftar']?></textarea>
                                  </div>
                              </div>

                             <div class="control-group">
                                 <label class="control-label">Informasi Pengumuman</label>
                                 <div class="controls">
                                     <textarea name="pesan_status_pengumuman" required="true" class="span12 wysihtml6" rows="12"><?=set_value('pesan_status_pengumuman') ? set_value('pesan_status_daftar') : $query['pesan_status_pengumuman']?></textarea>
                                 </div>
                             </div>

                              <div class="form-actions">
                                   <button type="submit" class="btn btn-success"><i class="icon-save"></i> Update</button>
                              </div>
                              
                          <?=form_close();?>
                     </div>
                </div>
           </div>
       </div>
   </div>
</div>
<script type="text/javascript">
    function checkImage(oInput) {
        var _validFileExtensions = ["jpg", "JPG"];
        if (oInput.type == "file") {
            var sFileName = oInput.value;
            if (sFileName.length > 0) {
                var blnValid = false;
                for (var j = 0; j < _validFileExtensions.length; j++) {
                    var sCurExtension = _validFileExtensions[j];
                    if (sFileName.substr(sFileName.length - sCurExtension.length, sCurExtension.length).toLowerCase() == sCurExtension.toLowerCase()) {
                        blnValid = true;
                        break;
                    }
                }

                var _file = oInput.files[0];
                if (_file.size > 5000000) {
                    blnValid = false;
                }

                if (!blnValid) {
                    $(oInput).addClass('text-error');
                    var input_name = $(oInput).attr('name');
                    var label_err = $(oInput).parent().find("label.text-error");
                    if (label_err.length == 0) {
                        $(oInput).parent().append('<label id="' + input_name + '-error" class="text-error" for="' + input_name + '">' + "Mohon pastikan dokumen yang Anda upload hanya dalam format " + _validFileExtensions.join(", ") + ' dan berukuran maksimal 5 Mb.</label>');
                    } else {
                        label_err.html("Mohon pastikan dokumen yang Anda upload hanya dalam format " + _validFileExtensions.join(", ") + " dan berukuran maksimal 5 Mb.");
                    }
                    oInput.value = "";
                    //return false;
                } else {
                    console.log(oInput.value);
                    var label_err = $(oInput).parent().find("label.text-error");
                    if (label_err.length > 0) {
                        label_err.remove();
                    }
                }
            }
        }
        return true;
    }
</script>