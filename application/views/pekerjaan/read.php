<div id="main-content">
   <?=form_open($action);?> 
   <div class="container-fluid">
       <div class="row-fluid">
           <div class="span12">
               <h3 class="page-title">Pekerjaan</h3>
               <button class="btn btn-mini btn-danger tooltips" data-placement="top" data-original-title='Delete Checked'><i class="icon-trash"></i></button>
               <?=anchor('pekerjaan/create', '<i class="icon-plus"></i>', array('class' => 'btn btn-mini btn-success tooltips', 'data-placement' => 'top', 'data-original-title' => 'Add New'));?>
           </div>
       </div>
       <br>
       <?=$message;?>
       <div class="row-fluid">
           <div class="span12">
                <div class="widget">
                     <div class="widget-title">
                          <h4><i class="icon-th-list"></i></h4>
                     </div>
                     <div class="widget-body">
                          <table class="table table-striped table-condensed table-bordered" id="sample_1">
                            <thead>
                                <tr>
                                    <th style="width:8px;"><input type="checkbox" class="group-checkable" data-set="#sample_1 .checkboxes" /></th>
                                    <th style="width:8px;">No.</th>
                                    <th>Pekerjaan</th>
                                    <th style="width:25px;">&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; foreach($query->result() as $row) : ?>
                                <tr class="odd gradeX">
                                    <td><input type="checkbox" class="checkboxes" name="pk_id[]" value="<?=$row->pk_id;?>" /></td>
                                    <td><?=$no;?></td>
                                    <td><?=$row->pk_nama;?></td>
                                    <td>
                                        <?=anchor('pekerjaan/update/'.$row->pk_id, '<i class="icon-pencil"></i>', array('class' => 'btn btn-mini btn-info btn-small tooltips', 'data-placement' => 'top', 'data-original-title' => 'Edit'));?>
                                    </td>
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