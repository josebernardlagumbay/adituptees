<div class="container">
	<div class="row">
		<div class="span12">
			<div class="fontsize_18">Banner Manager</div>
		</div>
	</div>
	<div class="row padding_top15">
		<div class="span6">
			<ul class="nav nav-pills">
				<li class=""><a href="<?php echo site_url('banner_manager/view-banner-manager') ?>">View Banner Manager</a></li>
				<li class=""><a href="<?php echo site_url('banner_manager/upload-banner') ?>">Upload Banner</a></li>
				<li class="active"><a href="<?php echo current_url() ?>">Banner Settings</a></li>
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
							<label class="control-label" for="banner_thumbnail"><span class="required">*</span>&nbsp;Banner Thumbnail</label>
							<div class="controls">
								<div><input type="text" id="banner_thumbnail" name="banner_thumbnail" placeholder="Banner Thumbnail" value="<?php echo $banner_setting[0]['data']; ?>"></div>
								<div class="color1"><i>Example: 100x100</i></div>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="banner_display"><span class="required">*</span>&nbsp;Banner Display</label>
							<div class="controls"><input type="text" id="banner_display" name="banner_display" placeholder="Banner Display" value="<?php echo $banner_setting[1]['data']; ?>"></div>
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
			
			if($('#banner_thumbnail').val() == ''){
				insert_detail_message('Please enter the Banner Thumbnail value.');
				error = 1;
			}
			
			if($('#banner_display').val() == ''){
				insert_detail_message('Please enter the Banner Display value.');
				error = 1;
			}
			
			if(error == 1){
				insert_header_message('Please correct the following errors:');
				display_message();
			} else {
				// Update the banner settigs
				$.post
				(
					'<?php echo site_url("banner_manager/update-banner-setting") ?>',
					{
						banner_thumbnail: $('#banner_thumbnail').val(),
						banner_display: $('#banner_display').val()
					},
					function(data)
					{
						if(data == 'LOGIN'){
							window.location = '<?php echo site_url("admin") ?>';
						} else if(data == 'UPDATE'){
							insert_header_message('Update Banner Settings');
							insert_detail_message('Banner Settings succesfully updated.');
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