<div class="container">
	<div class="row">
		<div class="span12">
			<div class="fontsize_18">Image Manager</div>
		</div>
	</div>
	<div class="row padding_top15">
		<div class="span6">
			<ul class="nav nav-pills">
				<li class="active"><a href="<?php echo current_url() ?>">Upload Image</a></li>
			</ul>
		</div>
	</div>
</div>

<div class="background1">
	<div class="container padding_top15">
		<div class="row">
			<div class="span12">
				<div class="content_header">Upload Image for <?php echo $web_content[0]['web_content_name'] ?></div>
				<div class="padding_top15">
					<form class="form-horizontal" id="frmUploadImage" name="frmUploadImage" enctype="multipart/form-data" method="post" action="<?php echo site_url('image_manager/upload'); ?>">
						<div class="control-group">
							<label class="control-label" for="upload_image"><span class="required">*</span>&nbsp;Select Image</label>
							<div class="controls">
								<input type="file" id="upload_image" name="upload_image" placeholder="Image Thumbnail">
							</div>
						</div>
						<div class="control-group">
							<div class="controls"><button type="button" class="btn btn-info" name="cmdUpload" id="cmdUpload">Upload</button></div>
						</div>
						<input type="hidden" name="web_content_id" id="web_content_id" value="<?php echo $this->uri->segment(3) ?>"/>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">

	$('#cmdUpload').click
	(
		function()
		{
			var error = 0;
			init_message();
			
			if($('#upload_image').val() == ''){
				insert_detail_message('Please select the Image to upload.');
				error = 1;
			}
			
			if(error == 1){
				insert_header_message('Please correct the following error:');
				display_message();
			} else {
				$('#frmUploadImage').submit();
			}
			
			setTimeout('hide_message()', 4000);
		}
	);
		
</script>