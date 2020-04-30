<div id="main-content">
   <?=form_open($action)?> 
   <div class="container-fluid">
       <div class="row-fluid">
           <div class="span12">
               <h3 class="page-title">Link</h3>
               <button class="btn btn-mini btn-danger tooltips" data-placement="top" data-original-title='Delete Checked'><i class="icon-trash"></i></button>
               <?=anchor('link/create', '<i class="icon-plus"></i>', array('class' => 'btn btn-mini btn-success tooltips', 'data-placement' => 'top', 'data-original-title' => 'Add New'));?>
           </div>
       </div>
       <br>
       <?=$message;?>
       <div class="row-fluid">
           <div class="span12">
                <div class="widget">
                     <div class="widget-title">
                          <h4><i class="icon-link"></i></h4>
                          <span class="tools">
                               <a href="javascript:;" class="icon-chevron-down"></a>
                          </span>
                     </div>
                     <div class="widget-body">
                          <table class="table table-striped table-condensed table-bordered" id="sample_1">
                            <thead>
                                <tr>
                                    <th style="width:8px;"><input type="checkbox" class="group-checkable" data-set="#sample_1 .checkboxes" /></th>
                                    <th style="width:8px;">No.</th>
                                    <th>Category</th>
                                    <th>Name</th>
                                    <th>URL</th>
                                    <th>Description</th>
                                    <th style="width:25px;">&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; foreach($query->result() as $row) : ?>
                                <tr class="odd gradeX">
                                    <td><input type="checkbox" class="checkboxes" name="link_id[]" value="<?=$row->link_id;?>" /></td>
                                    <td><?=$no;?></td>
                                    <td><?=$row->cat_name;?></td>
                                    <td><?=$row->link_name;?></td>
                                    <td><?=$row->link_url;?></td>
                                    <td><?=$row->link_description;?></td>
                                    <td>
                                        <?=anchor('link/update/'.$row->link_id, '<i class="icon-pencil"></i>', array('class' => 'btn btn-mini btn-info tooltips', 'data-placement' => 'top', 'data-original-title' => 'Edit'));?>
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