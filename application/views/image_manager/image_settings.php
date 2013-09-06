<div class="container">
	<div class="row">
		<div class="span12">
			<div class="fontsize_18">Image Manager</div>
		</div>
	</div>
	<div class="row padding_top15">
		<div class="span6">
			<ul class="nav nav-pills">
				<li class=""><a href="<?php echo site_url('image_manager/view-image-manager') ?>">View Image Manager</a></li>
				<li class="active"><a href="<?php echo current_url() ?>">Image Settings</a></li>
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
					<form class="form-horizontal" id="frmImageSettings" name="frmImageSettings" enctype="multipart/form-data" method="post">
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
			
			if($('#image_thumbnail').val() == ''){
				insert_detail_message('Please enter the Image Thumbnail value.');
				error = 1;
			}
			
			if($('#image_display').val() == ''){
				insert_detail_message('Please enter the Image Display value.');
				error = 1;
			}
			
			if($('#image_zoom').val() == ''){
				insert_detail_message('Please enter the Image Zoom value.');
				error = 1;
			}
			
			if(error == 1){
				insert_header_message('Please correct the following errors:');
				display_message();
			} else {
				// Update the image settigs
				$.post
				(
					'<?php echo site_url("image_manager/update-image-setting") ?>',
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
							insert_header_message('Update Image Settings');
							insert_detail_message('Image Settings succesfully updated.');
							display_message();
							setTimeout('refresh_page()', 4000);
						}
					}
				);
			}
		}
	);
	
	function refresh_page()
	{
		window.location = '<?php echo current_url() ?>';
	}
	
</script>