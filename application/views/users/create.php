<div id="main-content">
   <div class="container-fluid">
       <div class="row-fluid">
           <div class="span12">
               <h3 class="page-title">User Management</h3>
           </div>
       </div>
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
                     <div class="widget-body form">
                          <?=form_open($action, array('class'=>'form-horizontal'));?>
                          
                          <input type="hidden" name="url" value="<?=uri_string();?>"/>
                            
                            <div class="control-group">
                                <label class="control-label">Nama Pengguna</label>
                                <div class="controls">
                                    <input type="text" name="user_name" required="true" autocomplete="off" autofocus="true" class="span12" value="<?=(set_value('user_name')) ? set_value('user_name') : $query['user_name']?>"/>
                                </div>
                            </div>
                            
                            <div class="control-group">
                                <label class="control-label">Kata Sandi</label>
                                <div class="controls">
                                    <input type="password" name="user_password" <?php if ($this->uri->segment(2) == 'create') echo 'required="true"';?> class="span12" <?php if ($this->uri->segment(2) == 'update') echo 'placeholder="kosongkan jika kata sandi tidak akan diubah"';?>/>
                                </div>
                            </div>
                            
                            <div class="control-group">
                                <div class="controls">
                                    <input type="password" name="conf_password" <?php if ($this->uri->segment(2) == 'create') echo 'required="true"';?> class="span12" placeholder="Ulangi Kata Sandi"/>
                                </div>
                            </div>
                            
                            <div class="control-group">
                                <label class="control-label">Email</label>
                                <div class="controls">
                                    <input type="email" name="user_email" required="true" autocomplete="off" class="span12" value="<?=(set_value('user_email')) ? set_value('user_email') : $query['user_email']?>"/>
                                </div>
                            </div>
                            
                            <div class="control-group">
                                <label class="control-label">Nama Lengkap</label>
                                <div class="controls">
                                    <input type="text" name="user_display" required="true" autocomplete="off" class="span12" value="<?=(set_value('user_display')) ? set_value('user_display') : $query['user_display']?>"/>
                                </div>
                            </div>

                            <div class="form-actions">
                                <div class="btn-group">
                                    <?php
                                    if ($this->uri->segment(2) == 'create')
                                    {
                                        echo '<button class="btn btn-success"><i class="icon-save"></i> Save</button>';
                                        echo anchor('users/read/1', '<i class="icon-undo"></i> Back', array('class'=>'btn'));
                                    }
                                    elseif ($this->uri->segment(2) == 'update')
                                    {
                                        echo '<button class="btn btn-success"><i class="icon-save"></i> Update</button>';    
                                    }
                                    
                                    if ($this->uri->segment(3) == TRUE)
                                    {
                                        echo anchor('users/read/1', '<i class="icon-undo"></i> Back', array('class'=>'btn'));
                                    }
                                    ?>
                                </div>
                            </div>
                        <?=form_close();?>
                     </div>
                </div>
           </div>
       </div>
   </div>
</div>