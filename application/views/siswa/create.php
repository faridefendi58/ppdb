<div id="main-content">
   <div class="container-fluid">
       <div class="row-fluid">
           <div class="span12">
               <h3 class="page-title">PPDB Online SMKN 2 Muara Enim Tahun <?=config('ppdb_tahun');?></h3>

<br>
<u><b>Penting !! :</b></u> <br>
* Sebelum melakukan pendaftaran, SIAPKAN DATA terlebih dahulu sesuai dengan <b>KETENTUAN</b> yang ada pada formulir berikut ini.<br>
* Tiap Peserta WAJIB mengisi formulir berikut dengan "LENGKAP dan BENAR", dan sesuai dengan <b>KETENTUAN</b> yang ada pada formulir berikut ini. <br>
* Tiap Peserta Hanya dapat mendaftar satu kali dengan data peserta yang valid. <br>
* <b>Cetak Bukti Pendaftaran Online</b> dan catat nomor pendaftaran sebelum menutup browser. <br><br>

<u><b>Catatan :</b></u> <br>
* Gunakan akses internet (koneksi internet) yang stabil.
<br><br>



               <?php
               if ($this->uri->segment(2) == 'update')
               {
                   echo anchor('siswa/read', '<i class="icon-th-list"></i>', array('class' => 'btn btn-mini btn-success'));
               }
               ?>
               
           </div>
       </div>
       <br>
       <?=$message;?>
       <div class="row-fluid">
           <div class="span12">
                <div class="widget">
                     <div class="widget-title">
                          <h4><i class="icon-home"></i> FORM PENDAFTARAN</h4>
                     </div>
                     <div class="widget-body form">
                          <?=form_open_multipart($action, 'class="form-horizontal"');?>
                              
                              <?php if ($this->uri->segment(2) == 'update') { ?>
                              <div class="control-group">
                                   <label class="control-label">No. Pendaftaran</label>
                                   <div class="controls">
                                       <input type="text" value="<?=$query['no_daftar'];?>" class="span12" readonly="true"/>
                                   </div>
                              </div>
                              <?php } ?> <br>
                                                            
                                                           
                              <div class="control-group">
                                  <label class="control-label">Jalur Pendaftaran</label>
                                  <div class="controls">
                                     <?php
                                     $jalur = array('1' => 'UMUM');
                                     echo form_dropdown('jalur_id', $jalur, $query['jalur_id'], "class='span12 chosen'");?>
                                  </div>
                              </div>

                              <br> <b>* Pilihan 1-4 Harus Berbeda</b> <br><br>
                              <div class="control-group">
                                  <label class="control-label">Pilihan 1</label>
                                  <div class="controls">
                                     <?=form_dropdown('pil_1', $prodi, $query['pil_1'], "class='span12 chosen'");?>
                                  </div>
                              </div>
                              
                              <div class="control-group">
                                  <label class="control-label">Pilihan 2</label>
                                  <div class="controls">
                                     <?=form_dropdown('pil_2', $prodi, $query['pil_2'], "class='span12 chosen'");?>
                                  </div>
                              </div>

                             <div class="control-group">
                                  <label class="control-label">Pilihan 3</label>
                                  <div class="controls">
                                     <?=form_dropdown('pil_3', $prodi, $query['pil_3'], "class='span12 chosen'");?>
                                  </div>
                              </div>

                             <div class="control-group">
                                  <label class="control-label">Pilihan 4</label>
                                  <div class="controls">
                                     <?=form_dropdown('pil_4', $prodi, $query['pil_4'], "class='span12 chosen'");?>
                                  </div>
                              </div><br>

                                   <h4><i class="icon-signin"></i> Data Siswa </h4>
                                   
                                   <div class="control-group">
                                   <label class="control-label">Nama</label>
                                   <div class="controls">
                                       <input type="text" name="nama" required="true" value="<?=set_value('nama') ? set_value('nama') : $query['nama']?>" class="span12" autocomplete="off"/>
                                   </div>
                              </div>

                                   <div class="control-group">
                                   <label class="control-label">NISN</label>
                                   <div class="controls">
                                       <input type="text" name="nisn" required="true" value="<?=set_value('nisn') ? set_value('nisn') : $query['nisn']?>" class="span12" autocomplete="off"/>
                                   </div>
                              </div>

                                   <div class="control-group">
                                   <label class="control-label">NIK (berdasarkan KK)</label>
                                   <div class="controls">
                                       <input type="text" name="nik" required="true" value="<?=set_value('nik') ? set_value('nik') : $query['nik']?>" class="span12" autocomplete="off"/>
                                   </div>
                              </div>

                                   <div class="control-group">
                                   <label class="control-label">No. Akte Kelahiran</label>
                                   <div class="controls">
                                       <input type="text" name="no_akte" required="true" value="<?=set_value('no_akte') ? set_value('no_akte') : $query['no_akte']?>" class="span12" autocomplete="off"/>
                                   </div>
                              </div>


                                  <div class="control-group">
                                  <label class="control-label">Jenis Kelamin</label>
                                  <div class="controls">
                                     <?php
                                     $jk = array('L' => 'Laki-Laki', 'P' => 'Perempuan');
                                     echo form_dropdown('jns_kelamin', $jk, $query['jns_kelamin'], "class='span12 chosen'");?>
                                  </div>
                              </div>

                                   <div class="control-group">
                                   <label class="control-label">Tempat Lahir</label>
                                   <div class="controls">
                                       <input type="text" name="tmp_lahir" required="true" value="<?=set_value('tmp_lahir') ? set_value('tmp_lahir') : $query['tmp_lahir']?>" class="span12" autocomplete="off"/>
                                   </div>
                              </div>
                              
                              <div class="control-group">
                                   <label class="control-label">Tanggal Lahir</label>
                                   <div class="controls">
                                       <input name="tgl_lahir" required="true" class="span5" type="text" data-mask="99-99-9999" value="<?=$this->uri->segment(2) == 'create' ? '' : extract_date($query['tgl_lahir']);?>">
                                       <span class="help-inline">Tanggal-Bulan-Tahun</span>
                                   </div>
                              </div>
                              
                              <div class="control-group">
                                  <label class="control-label">Agama</label>
                                  <div class="controls">
                                     <?php
                                     $ag = array('1' => 'Islam', '2' => 'Kristen', '3' => 'Katolik', '4' => 'Hindu', '5' => 'Budha');
                                     echo form_dropdown('agama', $ag, $query['agama'], "class='span12 chosen'");?>
                                  </div>
                              </div>

                                  <div class="control-group">
                                  <label class="control-label">Alamat Lengkap</label>
                                  <div class="controls">
                                     <textarea name="alamat" required="true" class="span12" rows="4"><?=set_value('alamat') ? set_value('alamat') : $query['alamat']?></textarea>
                                  </div>
                              </div>
                              
                              <div class="control-group">
                                   <label class="control-label">No. Kartu Keluarga</label>
                                   <div class="controls">
                                       <input type="text" name="no_kk" required="true" value="<?=set_value('no_kk') ? set_value('no_kk') : $query['no_kk']?>" class="span5" autocomplete="off"/>
                                   </div>
                              </div>
                              
                              <div class="control-group">
                                   <label class="control-label">Jumlah Saudara Kandung</label>
                                   <div class="controls">
                                       <input type="text" name="sdr_kandung" required="true" value="<?=set_value('sdr_kandung') ? set_value('sdr_kandung') : $query['sdr_kandung']?>" class="span5" autocomplete="off"/> <span class="help-inline">(contoh : 5)</span>
                                   </div>
                              </div>
                              
                                   <div class="control-group">
                                   <label class="control-label">Anak Ke</label>
                                   <div class="controls">
                                       <input type="text" name="anak_ke" required="true" value="<?=set_value('anak_ke') ? set_value('anak_ke') : $query['anak_ke']?>" class="span5" autocomplete="off"/> <span class="help-inline">(contoh : 5)</span>
                                   </div>
                              </div>

                                   <div class="control-group">
                                   <label class="control-label">Status Anak</label>
                                   <div class="controls">
                                       <input type="text" name="st_anak" required="true" value="<?=set_value('st_anak') ? set_value('st_anak') : $query['st_anak']?>" class="span5" autocomplete="off"/> <span class="help-inline">(kandung/tiri/asuh/angkat)</span>
                                   </div>
                              </div>
                              
                                   <div class="control-group">
                                   <label class="control-label">Berat Badan</label>
                                   <div class="controls">
                                       <input type="text" name="b_badan" required="true" value="<?=set_value('b_badan') ? set_value('b_badan') : $query['b_badan']?>" class="span5" autocomplete="off"/> <span class="help-inline">(contoh : 50 kg)</span>
                                   </div>
                              </div>

                                   <div class="control-group">
                                   <label class="control-label">Tinggi Badan </label>
                                   <div class="controls">
                                       <input type="text" name="t_badan" required="true" value="<?=set_value('t_badan') ? set_value('t_badan') : $query['t_badan']?>" class="span5" autocomplete="off"/><span class="help-inline">(contoh : 150 cm)</span>
                                   </div>
                              </div>

                                   <div class="control-group">
                                   <label class="control-label">Golongan Darah</label>
                                   <div class="controls">
                                       <input type="text" name="g_darah" value="<?=set_value('g_darah') ? set_value('g_darah') : $query['g_darah']?>" class="span12" autocomplete="off"/>
                                   </div>
                              </div>
                                                            
                              <div class="control-group">
                                   <label class="control-label">No. HP</label>
                                   <div class="controls">
                                       <input type="text" name="telp" value="<?=set_value('telp') ? set_value('telp') : $query['telp']?>" class="span12" autocomplete="off"/>
                                   </div>
                              </div> 
                              
                              <div class="control-group">
                                   <label class="control-label">No. Kartu Indonesia Pintar (jika ada) </label>
                                   <div class="controls">
                                       <input type="text" name="no_kip" value="<?=set_value('no_kip') ? set_value('telp') : $query['no_kip']?>" class="span12" autocomplete="off"/>
                                   </div>
                              </div> 

                                  <div class="control-group">
                                  <label class="control-label">Upload Photo</label>
                                  <div class="controls">
                                      <div class="fileupload fileupload-new" data-provides="fileupload">
                                          <div class="fileupload-new thumbnail" style="width: auto; height: auto;">
                                              <img src="<?=$photo;?>"/>
                                          </div>
                                          <div class="fileupload-preview fileupload-exists thumbnail" style="max-width:113px; max-height:170px; line-height: 20px;"></div>
                                          <div>
                                             <span class="btn btn-file">
                                                <span class="fileupload-new">Browse</span>
                                                <span class="fileupload-exists">Change</span>
                                                <input type="file" class="default" name="file"/>
                                             </span>
                                             <a href="#" class="btn fileupload-exists" data-dismiss="fileupload">Remove</a>
                                          </div>
                                      </div>
                                      <div class="text-warning"><b>Catatan !! <br>
                                      * Hanya file dengan type .JPG dan ukuran file MAKSIMAL 300 KB.<br>
                                      * Foto Terbaru, formal, berseragam SMP/Sederajat dan rapi. <br>                                 
                                      * Pas Foto Studio berwarna</b></div>
                                  </div>
                              </div><br>


                              <h4><i class="icon-signin"></i> Data Sekolah Sebelumnya (SMP/MTS/Sederajat) </h4>
                              <div class="control-group">
                                   <label class="control-label">Asal Sekolah</label>
                                   <div class="controls">
                                       <input type="text" name="asal_sekolah" required="true" value="<?=set_value('asal_sekolah') ? set_value('asal_sekolah') : $query['asal_sekolah']?>" class="span12" autocomplete="off"/>
                                   </div>
                              </div> <br>


                              <h4><i class="icon-signin"></i> Data Orang Tua/Wali </h4>
                              <br>
                              <h4> Data Ayah </h4>
                              <div class="control-group">
                                   <label class="control-label">Nama Ayah</label>
                                   <div class="controls">
                                       <input type="text" name="nama_ortu" required="true" value="<?=set_value('nama_ortu') ? set_value('nama_ortu') : $query['nama_ortu']?>" class="span12" autocomplete="off"/>
                                   </div>
                              </div>
                              
                              <div class="control-group">
                                   <label class="control-label">NIK Ayah</label>
                                   <div class="controls">
                                       <input type="text" name="nik_ayah" required="true" value="<?=set_value('nik_ayah') ? set_value('nik_ayah') : $query['nik_ayah']?>" class="span12" autocomplete="off"/>
                                   </div>
                              </div>
                              
                              <div class="control-group">
                                   <label class="control-label">Alamat Ayah</label>
                                   <div class="controls">
                                       <textarea name="alamat_ortu" required="true" class="span12" rows="4"><?=set_value('alamat_ortu') ? set_value('alamat_ortu') : $query['alamat_ortu']?></textarea>
                                   </div>
                              </div>
                              
                                   <div class="control-group">
                                   <label class="control-label">Pekerjaan Ayah</label>
                                   <div class="controls">
                                       <?php
                                       echo form_dropdown('pekerjaan_ortu', $pekerjaan, $query['pekerjaan_ortu'], "class='span12 chosen'");
                                       ?>
                                   </div>
                              </div>
                              
                              <div class="control-group">
                                   <label class="control-label">Penghasilan Ayah</label>
                                   <div class="controls">
                                       <input type="text" name="hasil_ortu" value="<?=set_value('hasil_ortu') ? set_value('hasil_ortu') : $query['hasil_ortu']?>" class="span5" autocomplete="off"/> <span class="help-inline">(contoh : 1.000.000)</span>
                                   </div>
                              </div>
                              
                              <div class="control-group">
                                   <label class="control-label">No. HP Ayah</label>
                                   <div class="controls">
                                       <input type="text" name="telp_ortu" value="<?=set_value('telp_ortu') ? set_value('telp_ortu') : $query['telp_ortu']?>" class="span12" autocomplete="off"/>
                                   </div>
                              </div>
                              

                              <br>
                              <h4> Data Ibu </h4>
                                   <div class="control-group">
                                   <label class="control-label">Nama Ibu</label>
                                   <div class="controls">
                                       <input type="text" name="nama_ibu" required="true" value="<?=set_value('nama_ibu') ? set_value('nama_ibu') : $query['nama_ibu']?>" class="span12" autocomplete="off"/>
                                   </div>
                              </div>
                              
                              <div class="control-group">
                                   <label class="control-label">NIK Ibu</label>
                                   <div class="controls">
                                       <input type="text" name="nik_ibu" value="<?=set_value('nik_ibu') ? set_value('nik_ibu') : $query['nik_ibu']?>" class="span12" autocomplete="off"/>
                                   </div>
                              </div>
                              
                              <div class="control-group">
                                   <label class="control-label">Alamat Ibu</label>
                                   <div class="controls">
                                       <textarea name="alamat_ibu" required="true" class="span12" rows="4"><?=set_value('alamat_ibu') ? set_value('alamat_ibu') : $query['alamat_ibu']?></textarea>
                                   </div>
                              </div>

                                   <div class="control-group">
                                  <label class="control-label">Pekerjaan Ibu</label>
                                  <div class="controls">
                                     <?php
                                     $ki = array('1' => 'PNS/TNI/POLRI/BUMN', '2' => 'Wirausaha', '3' => 'Karyawan Swasta', '4' => 'Buruh', '5' => 'Petani', '6' => 'Ibu Rumah Tangga', '7' => 'Sudah Meninggal');
                                     echo form_dropdown('hasil_ibu', $ki, $query['hasil_ibu'], "class='span12 chosen'");?>
                                  </div>
                              </div>
                              
                              <div class="control-group">
                                   <label class="control-label">Penghasilan Ibu</label>
                                   <div class="controls">
                                       <input type="text" name="hasil_ibu" value="<?=set_value('hasil_ibu') ? set_value('hasil_ibu') : $query['hasil_ibu']?>" class="span5" autocomplete="off"/><span class="help-inline">(contoh : 1.000.000)</span>
                                   </div>
                              </div>
                              
                              <div class="control-group">
                                   <label class="control-label">No. HP Ibu</label>
                                   <div class="controls">
                                       <input type="text" name="hp_ibu" value="<?=set_value('hp_ibu') ? set_value('hp_ibu') : $query['hp_ibu']?>" class="span12" autocomplete="off"/>
                                   </div>
                              </div>

                                   
                              <br>
                              <h4><i class="icon-signin"></i> NILAI RAPORT SEMESTER 1 (harus angka)</h4>
                                   <div class="control-group">
                                   <label class="control-label">Bahasa Indonesia</label>
                                   <div class="controls">
                                       <input type="text" name="n_bindo" required="true" value="<?=set_value('n_bindo') ? set_value('n_bindo') : $query['n_bindo']?>" class="span2" autocomplete="off"/>
                                   </div>
                              </div>

                                   <div class="control-group">
                                   <label class="control-label">Bahasa Inggris</label>
                                   <div class="controls">
                                       <input type="text" name="n_bing" required="true" value="<?=set_value('n_bing') ? set_value('n_bing') : $query['n_bing']?>" class="span2" autocomplete="off"/>
                                   </div>
                              </div>

                                   <div class="control-group">
                                   <label class="control-label">Matematika</label>
                                   <div class="controls">
                                       <input type="text" name="n_mtk" required="true" value="<?=set_value('n_mtk') ? set_value('n_mtk') : $query['n_mtk']?>" class="span2" autocomplete="off"/>
                                   </div>
                              </div>

                                   <div class="control-group">
                                   <label class="control-label">IPA</label>
                                   <div class="controls">
                                       <input type="text" name="n_ipa" required="true" value="<?=set_value('n_ipa') ? set_value('n_ipa') : $query['n_ipa']?>" class="span2" autocomplete="off"/>
                                   </div>
                              </div> <br>
                              
                              <div class="control-group">
                                   <label class="control-label">RATA-RATA</label>
                                   <div class="controls">
                                       <input type="text" name="n_rata" required="true" value="<?=set_value('n_rata') ? set_value('n_rata') : $query['n_rata']?>" class="span2" autocomplete="off"/>
                                   </div>
                              </div> <br>
                              
                              <br>
                              <h4><i class="icon-signin"></i> NILAI RAPORT SEMESTER 2 (harus angka)</h4>
                                   <div class="control-group">
                                   <label class="control-label">Bahasa Indonesia</label>
                                   <div class="controls">
                                       <input type="text" name="n_bindo2" required="true" value="<?=set_value('n_bindo2') ? set_value('n_bindo2') : $query['n_bindo2']?>" class="span2" autocomplete="off"/>
                                   </div>
                              </div>

                                   <div class="control-group">
                                   <label class="control-label">Bahasa Inggris</label>
                                   <div class="controls">
                                       <input type="text" name="n_bing2" required="true" value="<?=set_value('n_bing2') ? set_value('n_bing2') : $query['n_bing2']?>" class="span2" autocomplete="off"/>
                                   </div>
                              </div>

                                   <div class="control-group">
                                   <label class="control-label">Matematika</label>
                                   <div class="controls">
                                       <input type="text" name="n_mtk2" required="true" value="<?=set_value('n_mtk2') ? set_value('n_mtk2') : $query['n_mtk2']?>" class="span2" autocomplete="off"/>
                                   </div>
                              </div>

                                   <div class="control-group">
                                   <label class="control-label">IPA</label>
                                   <div class="controls">
                                       <input type="text" name="n_ipa2" required="true" value="<?=set_value('n_ipa2') ? set_value('n_ipa2') : $query['n_ipa2']?>" class="span2" autocomplete="off"/>
                                   </div>
                              </div> <br>
                              
                              <div class="control-group">
                                   <label class="control-label">RATA-RATA</label>
                                   <div class="controls">
                                       <input type="text" name="n_rata2" required="true" value="<?=set_value('n_rata2') ? set_value('n_rata2') : $query['n_rata2']?>" class="span2" autocomplete="off"/>
                                   </div>
                              </div> 
                              
                              <br>
                                   <h4><i class="icon-signin"></i> NILAI RAPORT SEMESTER 3 (harus angka)</h4>
                                   <div class="control-group">
                                   <label class="control-label">Bahasa Indonesia</label>
                                   <div class="controls">
                                       <input type="text" name="n_bindo3" required="true" value="<?=set_value('n_bindo3') ? set_value('n_bindo3') : $query['n_bindo3']?>" class="span2" autocomplete="off"/>
                                   </div>
                              </div>

                                   <div class="control-group">
                                   <label class="control-label">Bahasa Inggris</label>
                                   <div class="controls">
                                       <input type="text" name="n_bing3" required="true" value="<?=set_value('n_bing3') ? set_value('n_bing3') : $query['n_bing3']?>" class="span2" autocomplete="off"/>
                                   </div>
                              </div>

                                   <div class="control-group">
                                   <label class="control-label">Matematika</label>
                                   <div class="controls">
                                       <input type="text" name="n_mtk3" required="true" value="<?=set_value('n_mtk3') ? set_value('n_mtk3') : $query['n_mtk3']?>" class="span2" autocomplete="off"/>
                                   </div>
                              </div>

                                   <div class="control-group">
                                   <label class="control-label">IPA</label>
                                   <div class="controls">
                                       <input type="text" name="n_ipa3" required="true" value="<?=set_value('n_ipa3') ? set_value('n_ipa3') : $query['n_ipa3']?>" class="span2" autocomplete="off"/>
                                   </div>
                              </div> <br>
                              
                              <div class="control-group">
                                   <label class="control-label">RATA-RATA</label>
                                   <div class="controls">
                                       <input type="text" name="n_rata3" required="true" value="<?=set_value('n_rata3') ? set_value('n_rata3') : $query['n_rata3']?>" class="span2" autocomplete="off"/>
                                   </div>
                              </div> <br>
                              
                              <br>
                                   <h4><i class="icon-signin"></i> NILAI RAPORT SEMESTER 4 (harus angka)</h4>
                                   <div class="control-group">
                                   <label class="control-label">Bahasa Indonesia</label>
                                   <div class="controls">
                                       <input type="text" name="n_bindo4" required="true" value="<?=set_value('n_bindo4') ? set_value('n_bindo4') : $query['n_bindo4']?>" class="span2" autocomplete="off"/>
                                   </div>
                              </div>

                                   <div class="control-group">
                                   <label class="control-label">Bahasa Inggris</label>
                                   <div class="controls">
                                       <input type="text" name="n_bing4" required="true" value="<?=set_value('n_bing4') ? set_value('n_bing4') : $query['n_bing4']?>" class="span2" autocomplete="off"/>
                                   </div>
                              </div>

                                   <div class="control-group">
                                   <label class="control-label">Matematika</label>
                                   <div class="controls">
                                       <input type="text" name="n_mtk4" required="true" value="<?=set_value('n_mtk4') ? set_value('n_mtk4') : $query['n_mtk4']?>" class="span2" autocomplete="off"/>
                                   </div>
                              </div>

                                   <div class="control-group">
                                   <label class="control-label">IPA</label>
                                   <div class="controls">
                                       <input type="text" name="n_ipa4" required="true" value="<?=set_value('n_ipa4') ? set_value('n_ipa4') : $query['n_ipa4']?>" class="span2" autocomplete="off"/>
                                   </div>
                              </div> <br>
                              
                              <div class="control-group">
                                   <label class="control-label">RATA-RATA</label>
                                   <div class="controls">
                                       <input type="text" name="n_rata4" required="true" value="<?=set_value('n_rata4') ? set_value('n_rata4') : $query['n_rata4']?>" class="span2" autocomplete="off"/>
                                   </div>
                              </div> <br>
                              
                              <h4><i class="icon-signin"></i> NILAI RAPORT SEMESTER 5 (harus angka)</h4>
                                   <div class="control-group">
                                   <label class="control-label">Bahasa Indonesia</label>
                                   <div class="controls">
                                       <input type="text" name="n_bindo5" required="true" value="<?=set_value('n_bindo5') ? set_value('n_bindo5') : $query['n_bindo5']?>" class="span2" autocomplete="off"/>
                                   </div>
                              </div>

                                   <div class="control-group">
                                   <label class="control-label">Bahasa Inggris</label>
                                   <div class="controls">
                                       <input type="text" name="n_bing5" required="true" value="<?=set_value('n_bing5') ? set_value('n_bing5') : $query['n_bing5']?>" class="span2" autocomplete="off"/>
                                   </div>
                              </div>

                                   <div class="control-group">
                                   <label class="control-label">Matematika</label>
                                   <div class="controls">
                                       <input type="text" name="n_mtk5" required="true" value="<?=set_value('n_mtk5') ? set_value('n_mtk5') : $query['n_mtk5']?>" class="span2" autocomplete="off"/>
                                   </div>
                              </div>

                                   <div class="control-group">
                                   <label class="control-label">IPA</label>
                                   <div class="controls">
                                       <input type="text" name="n_ipa5" required="true" value="<?=set_value('n_ipa5') ? set_value('n_ipa5') : $query['n_ipa5']?>" class="span2" autocomplete="off"/>
                                   </div>
                              </div> <br>
                              
                              <div class="control-group">
                                   <label class="control-label">RATA-RATA</label>
                                   <div class="controls">
                                       <input type="text" name="n_rata5" required="true" value="<?=set_value('n_rata5') ? set_value('n_rata5') : $query['n_rata5']?>" class="span2" autocomplete="off"/>
                                   </div>
                              </div> <br>
                              
                              
                              <h4><i class="icon-signin"></i> NILAI UJIAN NASIONAL (jika ada)</h4>
                                   <div class="control-group">
                                   <label class="control-label">Bahasa Indonesia</label>
                                   <div class="controls">
                                       <input type="text" name="nun_bindo" value="<?=set_value('nun_bindo') ? set_value('nun_bindo') : $query['nun_bindo']?>" class="span2" autocomplete="off"/>
                                   </div>
                              </div>

                                   <div class="control-group">
                                   <label class="control-label">Bahasa Inggris</label>
                                   <div class="controls">
                                       <input type="text" name="nun_bing" value="<?=set_value('nun_bing') ? set_value('nun_bing') : $query['nun_bing']?>" class="span2" autocomplete="off"/>
                                   </div>
                              </div>

                                   <div class="control-group">
                                   <label class="control-label">Matematika</label>
                                   <div class="controls">
                                       <input type="text" name="nun_mtk" value="<?=set_value('nun_mtk') ? set_value('nun_mtk') : $query['nun_mtk']?>" class="span2" autocomplete="off"/>
                                   </div>
                              </div>

                                   <div class="control-group">
                                   <label class="control-label">IPA</label>
                                   <div class="controls">
                                       <input type="text" name="nun_ipa" value="<?=set_value('nun_ipa') ? set_value('nun_ipa') : $query['nun_ipa']?>" class="span2" autocomplete="off"/>
                                   </div>
                              </div> <br>
                              
                              <div class="control-group">
                                   <label class="control-label">RATA-RATA</label>
                                   <div class="controls">
                                       <input type="text" name="nun_rata" value="<?=set_value('nun_rata') ? set_value('nun_rata') : $query['nun_rata']?>" class="span2" autocomplete="off"/>
                                   </div>
                              </div> <br>
                              
                              <h4><i class="icon-signin"></i> NILAI UJIAN SEKOLAH (jika ada)</h4>
                                   <div class="control-group">
                                   <label class="control-label">Bahasa Indonesia</label>
                                   <div class="controls">
                                       <input type="text" name="nus_bindo" value="<?=set_value('nus_bindo') ? set_value('nus_bindo') : $query['nus_bindo']?>" class="span2" autocomplete="off"/>
                                   </div>
                              </div>

                                   <div class="control-group">
                                   <label class="control-label">Bahasa Inggris</label>
                                   <div class="controls">
                                       <input type="text" name="nus_bing" value="<?=set_value('nus_bing') ? set_value('nus_bing') : $query['nus_bing']?>" class="span2" autocomplete="off"/>
                                   </div>
                              </div>

                                   <div class="control-group">
                                   <label class="control-label">Matematika</label>
                                   <div class="controls">
                                       <input type="text" name="nus_mtk" value="<?=set_value('nus_mtk') ? set_value('nus_mtk') : $query['nus_mtk']?>" class="span2" autocomplete="off"/>
                                   </div>
                              </div>

                                   <div class="control-group">
                                   <label class="control-label">IPA</label>
                                   <div class="controls">
                                       <input type="text" name="nus_ipa" value="<?=set_value('nus_ipa') ? set_value('nus_ipa') : $query['nus_ipa']?>" class="span2" autocomplete="off"/>
                                   </div>
                              </div> <br>
                              
                              <div class="control-group">
                                   <label class="control-label">RATA-RATA</label>
                                   <div class="controls">
                                       <input type="text" name="nus_rata" value="<?=set_value('nus_rata') ? set_value('nus_rata') : $query['nus_rata']?>" class="span2" autocomplete="off"/>
                                   </div>
                              </div> <br>

                
                              <br><br><br><br>
                                                           
                              <?php if ($this->uri->segment(2) == 'create') { ?>
                              <div class="control-group">
                                 <label class="control-label">Kode Keamanan</label>
                                 <div class="controls">
                                     <?php echo $captcha['image'];?>
                                 </div>
                              </div>
                              <div class="control-group">
                                 <div class="controls">
                                     <input type="text" name="captcha" required="true" class="span5" autocomplete="off" placeholder="Masukan 6 digit angka diatas"/>
                                 </div>
                              </div>
<br> <b>" Dengan ini SAYA menyatakan bahwa data yang SAYA masukkan adalah BENAR dan dapat dipertanggung jawabkan "
<br> " Dengan ini SAYA membaca, mengerti serta memahami Peraturan dan Ketentuan yang berlaku "</b>

                              <?php } ?>
                              
                              <div class="form-actions">
                                   <?php
                                   if ($this->uri->segment(2) == 'update')
                                   {
                                       echo '<button type="submit" class="btn btn-success"><i class="icon-save"></i> Update</button>&nbsp;'; 
                                       echo anchor($this->uri->segment(1), '<i class="icon-undo"></i> Cancel', array('class' => 'btn'));
                                   }
                                   else
                                   {
                                       echo '<button type="submit" class="btn btn-success"><i class="icon-save"></i> Daftar</button>'; 
                                   }
                                   ?>
                              </div>
                          </form>
                     </div>
                </div>
           </div>
       </div>
   </div>
</div>