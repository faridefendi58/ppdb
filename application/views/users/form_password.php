<div class="row-fluid">
<div class="span12">
    <?=$message?>
	<div class="box box-color box-bordered">
		<div class="box-title">
			<h3><i class="icon-key"></i> Ubah Kata Sandi</h3>
		</div>
		<div class="box-content nopadding">
			<?=form_open($action, array('class' => 'form-horizontal form-bordered form-validate', 'id' => 'bb'))?>
                
                <div class="control-group">
                    <label for="kata_sandi" class="control-label">Kata Sandi</label>
                    <div class="controls">
                    	<input type="password" name="kata_sandi" data-rule-minlength='6' data-rule-required='true' id="kata_sandi" class="input-block-level">	
                    </div>
				</div>
                                    
                <div class="control-group">
                    <label for="ulangi_kata_sandi" class="control-label">Ulangi Kata Sandi</label>
                    <div class="controls">
                    	<input type="password" name="ulangi_kata_sandi" data-rule-minlength='6' data-rule-required='true' data-rule-equalTo='#kata_sandi' id="ulangi_kata_sandi" class="input-block-level">	
                    </div>
				</div>

                <div class="form-actions">
		             <button type="submit" class="btn btn-primary"><i class="icon-save"></i> Simpan</button>
                </div>
                
			</form>
		</div>
	</div>
</div>
</div>