<div id="main-content">
   <div class="container-fluid">
       <div class="row-fluid">
           <div class="span12">
               <h3 class="page-title">Post</h3>
               <?=anchor('post', '<i class="icon-th-list"></i>', array('class' => 'btn btn-mini btn-success'));?>
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
                     <div class="widget-body form">
                          <?=form_open($action, 'class="form-horizontal"');?>
                              <div class="control-group">
                                   <label class="control-label">Title</label>
                                   <div class="controls">
                                       <input type="text" name="post_title" required="true" value="<?=set_value('post_title') ? set_value('post_title') : $query['post_title']?>" class="span12" autocomplete="off" autofocus="true" />
                                   </div>
                              </div>
                              <div class="control-group">
                                  <label class="control-label">Category</label>
                                  <div class="controls">
                                     <?=form_dropdown('post_cat_id', $category, $query['post_cat_id'], "class='span12 chosen'");?>
                                  </div>
                              </div>
                              <div class="control-group">
                                  <label class="control-label">Status</label>
                                  <div class="controls">
                                     <?php
                                     $status = array('y' => 'Publish', 'n' => 'Draft');
                                     echo form_dropdown('post_status', $status, $query['post_status'], "class='span12 chosen'");?>
                                  </div>
                              </div>
                              <?php if ($this->uri->segment(2) == 'update') { ?>
                              <div class="control-group">
                                  <label class="control-label">Set as Home Page</label>
                                  <div class="controls">
                                     <?php
                                     $option = array('Y' => 'Yes', 'N' => 'No');
                                     echo form_dropdown('post_default', $option, $query['post_default'], "class='span12 chosen'");?>
                                  </div>
                              </div>
                              <?php } ?>
                              <div class="control-group">
                                  <label class="control-label">Content</label>
                                  <div class="controls">
                                     <textarea name="post_content" class="span12 wysihtml5" rows="20"><?=set_value('post_content') ? set_value('post_content') : $query['post_content']?></textarea>
                                  </div>
                              </div>

                              <div class="form-actions">
                                   <button type="submit" class="btn btn-mini btn-success"><i class="icon-save"></i> Submit</button>
                                   <?=anchor('post/read', '<i class="icon-undo"></i> Cancel', array('class' => 'btn btn-mini '));?>
                              </div>
                          </form>
                     </div>
                </div>
           </div>
       </div>
   </div>
</div>