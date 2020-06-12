<style>
    @media only screen and (min-width: 769px) and (max-width: 1024px) {
        #sample_1 {table-layout: fixed;width: 100% !important;}
        #sample_1 td,
        #sample_1 th{width: auto;white-space: normal;text-overflow: ellipsis;font-size: 10px;}
        .col-short{width:20px !important;}
    }
    @media only screen and (max-width: 768px) {
        .dataTables_wrapper {margin: 0 auto;overflow-x: scroll;}
    }
    @media only screen and (max-width: 360px) {
        .dataTables_wrapper {width: 320px;margin: 0 auto;overflow-x: scroll;}
    }
</style>
<div id="main-content">
   <?=form_open($action);?>
   <input type="hidden" name="url" value="<?=uri_string()?>" />
   <div class="container-fluid">
       <div class="row-fluid">
           <div class="span12">
               <h3 class="page-title">PPDB Tahun <?=config('ppdb_tahun');?></h3>
           </div>
       </div>
       <?=$message;?>              
       <div class="row-fluid">
           <div class="span12">
                <div class="widget">
                     <div class="widget-title">
                          <h4><i class="icon-th-list"></i> <?=$title;?></h4>
                          <div class="actions">
                                <div class="btn-group">
                                    <button data-toggle="dropdown" class="btn btn-primary dropdown-toggle">Pilih <span class="caret"></span></button>
                                    <ul class="dropdown-menu pull-right">
                                        <li><?=anchor('siswa/read',   '<i class="icon-signin"></i> Data Pendaftar');?></li>
                                        <li><?=anchor('siswa/read/1', '<i class="icon-signin"></i> Seleksi Calon Siswa Baru');?></li>
                                        <li><?=anchor('siswa/read/2', '<i class="icon-signin"></i> Data Siswa Diterima');?></li>
                                        <li><?=anchor('siswa/read/3', '<i class="icon-signin"></i> Data Siswa Tidak Diterima');?></li>
                                    </ul>
                                </div>
                          </div>
                     </div>
                     <div class="widget-body">
                          <?php
                          if ($this->uri->segment(3) == FALSE)
                          {
                              echo '<input type="submit" name="delete" class="btn btn-danger btn-mini" value="Delete Permanently" />';
                              echo '<br><br>';
                          }
                          else if ($this->uri->segment(3) == 2 OR $this->uri->segment(3) == 3)
                          {
                             echo '<input type="submit" name="clear" class="btn btn-mini" value="Hapus dari daftar seleksi" />';
                             echo '<br><br>';
                          }
                          ?>
                          <table class="table table-striped table-condensed table-bordered" id="sample_1">
                            <thead>
                                <tr>
                                    <th style="width:8px;" class="col-short"><input type="checkbox" class="group-checkable" data-set="#sample_1 .checkboxes" /></th>
                                    <th style="width:8px;">No.</th>
                                    <th>No. Daftar</th>
                                    <th>Nama</th>
                                    <?php if ($this->uri->segment(3) == FALSE) { ?>
                                    
                                    <th>Pilihan 1</th>
                                    <th>Pilihan 2</th>
                                    <th>Pilihan 3</th>
                                    <th>Pilihan 4</th>
                                    <th>Lampiran</th>
                                    <th>Diterima</th>
                                    <th style="width:55px;">&nbsp;</th>
                                    
                                    <?php } else if ($this->uri->segment(3) == 1) { ?>
                                    
                                    <th>Pilihan 1</th>
                                    <th>Pilihan 2</th>
                                    <th>Pilihan 3</th>
                                    <th>Pilihan 4</th>
                                        <th>Lampiran</th>
                                    <th style="width:75px;">&nbsp;</th>
                                    
                                    <?php } else if ($this->uri->segment(3) == 2) { ?>
                                    
                                    <th>Asal Sekolah</th>
                                    <th>Diterima di Program Studi</th>
                                    
                                    <?php } else if ($this->uri->segment(3) == 3) { ?>
                                    
                                    <th>Asal Sekolah</th>
                                    
                                    <?php } ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; foreach($query->result() as $row) : ?>
                                <tr class="odd gradeX">
                                    <td class="col-short"><input type="checkbox" class="checkboxes" name="id[]" value="<?=$row->id;?>" /></td>
                                    <td><?=$no;?></td>
                                    <td><?=$row->no_daftar;?></td>
                                    <td><?=$row->nama;?></td>
                                    
                                    <?php if ($this->uri->segment(3) == FALSE) { ?>
                                    
                                    <td><?=$row->pilihan_1;?></td>
                                    <td><?=$row->pilihan_2;?></td>
                                    <td><?=$row->pilihan_3;?></td>
                                    <td><?=$row->pilihan_4;?></td>
                                    <td>
                                        <?php
                                        $attachments = [];
                                        if (!empty($row->n_raport_1_5)):
                                            array_push($attachments, $row->n_raport_1_5);
                                            ?>
                                            <a href="<?php echo site_url('assets/pdf/'. $row->n_raport_1_5);?>" target="_blank">Nilai Rapor 1-5</a>
                                        <?php endif; ?>
                                        <?php if (!empty($row->no_ujian_smp)):
                                            array_push($attachments, $row->no_ujian_smp);
                                            ?>
                                            <?php if (count($attachments)>0):?>, <?php endif;?> <a href="<?php echo site_url('assets/pdf/'. $row->no_ujian_smp);?>" target="_blank">No Ujian SMP</a>
                                        <?php endif; ?>
                                    </td>
                                    <td><?=status($row->diterima);?></td>
                                    <td>
                                    <?=anchor('siswa/update/'.$row->id, '<i class="icon-pencil"></i>', array('class' => 'btn btn-mini btn-info tooltips', 'data-placement' => 'top', 'data-original-title' => 'Edit'));?>
                                    <?=anchor('siswa/print_formulir/'.$row->id, '<i class="icon-download-alt"></i>', array('class' => 'btn btn-mini btn-warning tooltips', 'data-placement' => 'top', 'data-original-title' => 'Export to PDF'));?>
                                    </td>
                                    
                                    <?php } else if ($this->uri->segment(3) == 1) { ?>
                                    
                                    <td><?=$row->pilihan_1;?></td>
                                    <td><?=$row->pilihan_2;?></td>
                                    <td><?=$row->pilihan_3;?></td>
                                    <td><?=$row->pilihan_4;?></td>
                                        <td>
                                            <?php
                                            $attachments = [];
                                            if (!empty($row->n_raport_1_5)):
                                                array_push($attachments, $row->n_raport_1_5);
                                                ?>
                                                <a href="<?php echo site_url('assets/pdf/'. $row->n_raport_1_5);?>" target="_blank">Nilai Rapor 1-5</a>
                                            <?php endif; ?>
                                            <?php if (!empty($row->no_ujian_smp)):
                                                array_push($attachments, $row->no_ujian_smp);
                                                ?>
                                                <?php if (count($attachments)>0):?>, <?php endif;?> <a href="<?php echo site_url('assets/pdf/'. $row->no_ujian_smp);?>" target="_blank">No Ujian SMP</a>
                                            <?php endif; ?>
                                        </td>
                                    <td>
                                    <div class="btn-group">
                                    <button data-toggle="dropdown" class="btn btn-primary btn-mini dropdown-toggle">Diterima di <span class="caret"></span></button>
                                    <ul class="dropdown-menu pull-right">
                                        <?php
                                        foreach ($prodi->result() as $p)
                                        {
                                            echo '<li>';
                                            echo anchor('siswa/seleksi/'.$row->id.'/'.$p->prodi_id, '<i class="icon-ok"></i> '.$p->prodi_nama.'');
                                            echo '</li>';
                                        }
                                        echo '<li>';
                                        echo anchor('siswa/seleksi/'.$row->id.'/t', '<i class="icon-remove"></i> Tidak Diterima');
                                        echo '</li>';
                                        ?>
                                    </ul>
                                    </div>
                                    </td>
                                    
                                    <?php } else if ($this->uri->segment(3) == 2) { ?>
                                    
                                    <td><?=$row->asal_sekolah;?></td>
                                    <td><?=$row->diterima;?></td>

                                    <?php } else if ($this->uri->segment(3) == 3) { ?>

                                    <td><?=$row->asal_sekolah;?></td>

                                    <?php } ?>
                                </tr>
                                <?php $no++; endforeach;?>
                            </tbody>
                        </table>
                     </div>
                </div>
           </div>
       </div>
   </div>
   <?=form_close();?>
</div>