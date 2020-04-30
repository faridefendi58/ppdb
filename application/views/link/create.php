<div id="main-content">
   <div class="container-fluid">
       <div class="row-fluid">
           <div class="span12">
               <h3 class="page-title">Link</h3>
               <?=anchor('link', '<i class="icon-th-list"></i>', array('class' => 'btn btn-mini btn-success'));?>
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
                                   <label class="control-label">link Name</label>
                                   <div class="controls">
                                       <input type="text" name="link_name" required="true" value="<?=set_value('link_name') ? set_value('link_name') : $query['link_name']?>" class="span12" autocomplete="off" autofocus="true" />
                                   </div>
                              </div>
                              <div class="control-group">
                                  <label class="control-label">Category</label>
                                  <div class="controls">
                                     <?=form_dropdown('link_cat_id', $category, $query['link_cat_id'], "class='span12 chosen' data-placeholder='Choose a Category'");?>
                                  </div>
                              </div>
                              <div class="control-group">
                                   <label class="control-label">URL</label>
                                   <div class="controls">
                                       <input type="text" name="link_url" required="true" value="<?=set_value('link_url') ? set_value('link_url') : $query['link_url']?>" class="span12" autocomplete="off"/>
                                   </div>
                              </div>
                              <div class="control-group">
                                   <label class="control-label">Description</label>
                                   <div class="controls">
                                       <input type="text" name="link_description" required="true" value="<?=set_value('link_description') ? set_value('link_description') : $query['link_description']?>" class="span12" autocomplete="off"/>
                                   </div>
                              </div>
                              <div class="form-actions">
                                   <button type="submit" class="btn btn-mini btn-success"><i class="icon-save"></i> Submit</button>
                                   <?=anchor($this->uri->segment(1), '<i class="icon-undo"></i> Cancel', array('class' => 'btn btn-mini '));?>
                              </div>
                          </form>
                     </div>
                </div>
           </div>
       </div>
   </div>
</div>