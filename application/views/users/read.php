<div id="main-content">
   <?=form_open($action)?>
   <input type="hidden" name="url" value="<?=uri_string()?>" />
   <div class="container-fluid">
       <div class="row-fluid">
           <div class="span12">
               <h3 class="page-title">Users Management</h3>
           </div>
       </div>
       <?=$message;?>
       <div class="row-fluid">
           <div class="span12">
                <div class="widget">
                     <div class="widget-title">
                          <h4><i class="icon-user"></i>
                          <?php
                          if ($this->uri->segment(3) == 1)
                          {
                              echo 'Active';
                          }
                          else if ($this->uri->segment(3) == 2)
                          {
                              echo 'Disable';
                          }
                          else
                          {
                              echo 'Trash';
                          }
                          ?>
                          </h4>
                          <div class="actions">
                                <div class="btn-group">
                                    <button data-toggle="dropdown" class="btn btn-primary dropdown-toggle">Pilih <span class="caret"></span></button>
                                    <ul class="dropdown-menu pull-right">
                                        <li><?=anchor('users/create', '<i class="icon-plus"></i> Add Users');?>
                                        <li><?=anchor('users/read/1', '<i class="icon-ok-sign"></i> Active Users');?>
                                        <li><?=anchor('users/read/2', '<i class="icon-minus-sign"></i> Disable Users');?>
                                        <li><?=anchor('users/read/3', '<i class="icon-trash"></i> Trash Users');?>
                                    </ul>
                                </div>
                          </div>
                     </div>
                     <div class="widget-body">
                          <?php
                          if ($this->uri->segment(3) == 1)
                          {
                              echo '<input type="submit" name="disable" class="btn btn-mini" value="Disable" />&nbsp;';
                              echo '<input type="submit" name="trash" class="btn btn-inverse btn-mini" value="Trash"/>';
                          }
                          else if ($this->uri->segment(3) == 2)
                          {
                              echo '<input type="submit" name="active" class="btn btn-primary btn-mini" value="Active" />&nbsp;';
                              echo '<input type="submit" name="trash" class="btn btn-inverse btn-mini" value="Trash" />';
                          }
                          else
                          {
                              echo '<input type="submit" name="active" class="btn btn-warning btn-mini" value="Restore" />&nbsp;';
                              echo '<input type="submit" name="delete_pemanently" class="btn btn-danger btn-mini" value="Delete Pemanently"/>';
                          }
                          ?>
                          <br><br>  
                          <table class="table table-striped table-condensed table-bordered" id="sample_1">
                            <thead>
                                <tr>
                                    <th style="width:8px;"><input type="checkbox" class="group-checkable" data-set="#sample_1 .checkboxes" /></th>
                                    <th style="width:8px;">No.</th>
                                    <th>Full Name</th>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <?php if ($this->uri->segment(3) == 1) { ?>
                                    <th style="width:25px;">&nbsp;</th>
                                    <?php } ?>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $no = 1; foreach($query->result_array() as $row) : ?>
                                <tr class="odd gradeX">
                                    <td><input type="checkbox" class="checkboxes" name="user_id[]" value="<?=$row['user_id'];?>" /></td>
                                    <td><?=$no;?></td>
                                    <td><?=$row['user_display'];?></td>
                                    <td><?=$row['user_name'];?></td>
                                    <td><?=$row['user_email'];?></td>
                                    <?php
                                    if ($this->uri->segment(3) == 1)
                                    {
                                       echo '<td>'; 
                                       echo anchor('users/update/'.$row['user_id'], '<i class="icon-edit"></i>', array('class' => 'btn btn-mini btn-success tooltips', 'data-placement'=> 'top', 'data-original-title' => 'Edit'));
                                       echo '</td>';
                                    }
                                    ?>
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