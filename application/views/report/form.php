<div id="main-content">
   <div class="container-fluid">
       <div class="row-fluid">
           <div class="span12">
               <h3 class="page-title">Laporan PPDB Online</h3>
           </div>
       </div>
       <div class="row-fluid">
           <div class="span12">
                <div class="widget">
                     <div class="widget-title">
                          <h4><i class="icon-file"></i></h4>
                          <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                          </span>
                     </div>
                     <div class="widget-body">
                        <?=form_open($action, 'class="form-horizontal"');?>
                            <div class="control-group">
                              <label class="control-label">Pilih Data Siswa</label>
                              <div class="controls">
                                 <select name="status" class="span12 chosen">
                                    <option value="a">Semua Pendaftar</option>
                                    <option value="1">Siswa Diterima</option>
                                    <option value="2">Siswa Tidak Diterima</option>
                                    <option value="3">Siswa Belum Diseleksi</option>
                                 </select>
                              </div>
                            </div>
                            
                            <div class="control-group">
                              <label class="control-label">Data PPDB Tahun</label>
                              <div class="controls">
                                 <select name="tahun" class="span12 chosen">
                                    <?php foreach($query->result_array() as $year) { ?>
                                        <option value="<?=$year['tahun'];?>">Tahun <?=$year['tahun'];?></option>    
                                    <?php } ?>
                                 </select>
                              </div>
                            </div>
                            
                            <div class="control-group">
                              <label class="control-label">Pilih Jalur Pendaftaran</label>
                              <div class="controls">
                                 <select name="jalur" class="span12 chosen">
                                    <option value="a">Semua Jalur Pendaftaran</option>
                                    <option value="1">Umum</option>
                                    <option value="2">Prestasi</option>
                                 </select>
                              </div>
                            </div>
                            
                            <div class="control-group">
                              <label class="control-label">Urut Berdasarkan</label>
                              <div class="controls">
                                 <select name="order_by" class="span12 chosen">
                                    <option value="no_daftar">Nomor Pendaftaran</option>
                                    <option value="nama">Nama</option>
                                 </select>
                              </div>
                            </div>
                            
                            <div class="control-group">
                              <div class="controls">
                                 <select name="order_type" class="span3 chosen">
                                    <option value="ASC">Ascending</option>
                                    <option value="DESC">Descending</option>
                                 </select>
                              </div>
                            </div>
                            
                            <div class="form-actions">
                              <button type="submit" class="btn btn-success"><i class="icon-share-alt"></i> Export to excel</button>
                           </div>
                           
                        <?=form_close();?>
                     </div>
                </div>
           </div>
       </div>
   </div>
</div>