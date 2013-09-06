<div class="container">
	<div class="row">
		<div class="span12">
			<div class="fontsize_18">Products</div>
		</div>
	</div>
	<div class="row padding_top15">
		<div class="span6">
			<ul class="nav nav-pills">
				<li class=""><a href="<?php echo site_url('product/view-products') ?>">View Products</a></li>
				<li class=""><a href="<?php echo site_url('product/add') ?>">Add Product</a></li>
				<li class="active"><a href="<?php echo site_url('product/image-settings') ?>">Image Settings</a></li>
			</ul>
		</div>
	</div>
</div>

<div class="background1">
	<div class="container padding_top15">
		<div class="row">
			<div class="span12">
				<div class="content_header">Image Settings</div>
				<div class="padding_top15">
					<form class="form-horizontal" id="frmImageSettings" name="frmImageSettings" method="post">
						<div class="control-group">
							<label class="control-label" for="image_thumbnail"><span class="required">*</span>&nbsp;Image Thumbnail</label>
							<div class="controls">
								<select name="image_thumbnail" id="image_thumbnail">
									<option value=""> - select thumbnail size - </option>
									<option value="70" <?php  if($image_settings[0]['data'] == 70){ ?> selected="selected" <?php } ?>>70</option>
									<option value="170" <?php  if($image_settings[0]['data'] == 170){ ?> selected="selected" <?php } ?>>170</option>
								</select>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="image_display"><span class="required">*</span>&nbsp;Image Display</label>
							<div class="controls">
								<select name="image_display" id="image_display">
									<option value=""> - select display size - </option>
									<option value="270" <?php  if($image_settings[1]['data'] == 270){ ?> selected="selected" <?php } ?>>270</option>
									<option value="370" <?php  if($image_settings[1]['data'] == 370){ ?> selected="selected" <?php } ?>>370</option>
								</select>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="image_zoom"><span class="required">*</span>&nbsp;Image Zoom</label>
							<div class="controls">
								<select name="image_zoom" id="image_zoom">
									<option value=""> - select zoom size - </option>
									<option value="470" <?php  if($image_settings[2]['data'] == 470){ ?> selected="selected" <?php } ?>>470</option>
									<option value="570" <?php  if($image_settings[2]['data'] == 570){ ?> selected="selected" <?php } ?>>570</option>
									<option value="670" <?php  if($image_settings[2]['data'] == 670){ ?> selected="selected" <?php } ?>>670</option>
									<option value="770" <?php  if($image_settings[2]['data'] == 770){ ?> selected="selected" <?php } ?>>770</option>
									<option value="870" <?php  if($image_settings[2]['data'] == 870){ ?> selected="selected" <?php } ?>>870</option>
								</select>
							</div>
						</div>
						<div class="control-group">
							<div class="controls"><button type="button" class="btn btn-info" name="cmdSave" id="cmdSave">Save</button></div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">

	$('#cmdSave').click
	(
		function()
		{
			var error = 0;
			init_message();
			
			if($('#product_thumbnail').val() == ''){
				insert_detail_message('Please select the Image Thumbnail Size.');
				error = 1;
			}
			
			if($('#product_display').val() == ''){
				insert_detail_message('Please select the Image Display Size.');
				error = 1;
			}
			
			if($('#product_zoom').val() == ''){
				insert_detail_message('Please select the Image Zoom Size.');
				error = 1;
			}
			
			if(error == 1){
				insert_header_message('Please correct the following errors:');
				display_message();
			} else {
				// Check if product name exist
				$.post
				(
					'<?php echo site_url("product/update-image-settings") ?>',
					{
						image_thumbnail: $('#image_thumbnail').val(),
						image_display: $('#image_display').val(),
						image_zoom: $('#image_zoom').val()
					},
					function(data)
					{
						if(data == 'LOGIN'){
							window.location = '<?php echo site_url("admin") ?>';
						} else if(data == 'UPDATE'){
							insert_header_message('Image Settings Updated');
							insert_detail_message('Image Settings successfully updated.');
							display_message();
							setTimeout('hide_message()', 4000);
						}
					}
				);
			}
		}
	);
	
</script>