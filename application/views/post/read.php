<div id="main-content">
   <?=form_open($this->uri->segment(1).'/multiple_checked');?> 
   <div class="container-fluid">
       <div class="row-fluid">
           <div class="span12">
               <h3 class="page-title">Post</h3>
               <button class="btn btn-mini btn-danger tooltips" data-placement="top" data-original-title='Delete Checked'><i class="icon-trash"></i></button>
               <?=anchor('post/create', '<i class="icon-plus"></i>', array('class' => 'btn btn-mini btn-success tooltips', 'data-placement' => 'top', 'data-original-title' => 'Add New'));?>
           </div>
       </div>
       <br>
       <?=$message;?>              
       <div class="row-fluid">
           <div class="span12">
                <div class="widget">
                     <div class="widget-title">
                          <h4><i class="icon-post"></i></h4>
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
                                    <th>Title</th>
                                    <th>Date</th>
                                    <th>Author</th>
                                    <th style="width:50px;">&nbsp;</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; foreach($query->result() as $row) : ?>
                                <tr class="odd gradeX">
                                    <td><input type="checkbox" class="checkboxes" name="post_id[]" value="<?=$row->post_id;?>" /></td>
                                    <td><?=$no;?></td>
                                    <td><?=$row->cat_name;?></td>
                                    <td><?=word_limiter($row->post_title, 5);?></td>
                                    <td><?=indo_date($row->post_date);?></td>
                                    <td><?=$row->user_display;?></td>
                                    <td>
                                        <?=anchor($this->uri->segment(1).'/update/'.$row->post_id, '<i class="icon-pencil"></i>', array('class' => 'btn btn-mini btn-info tooltips', 'data-placement' => 'top', 'data-original-title' => 'Edit'));?>
                                        <?php
                                        if ($row->post_default == 'N')
                                        {
                                            echo anchor($this->uri->segment(1).'/delete/'.$row->post_id, '<i class="icon-trash"></i>', array('class' => 'btn btn-mini btn-danger tooltips', 'data-placement'=> 'top', 'data-original-title' => 'Delete', 'onclick' => "return confirm('Apakah data akan dihapus ?')"));
                                        }
                                        ?>
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