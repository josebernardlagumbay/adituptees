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
				<li class="active"><a href="<?php echo current_url() ?>">Upload Banner</a></li>
				<li class=""><a href="<?php echo site_url('banner_manager/banner-settings') ?>">Banner Settings</a></li>
			</ul>
		</div>
	</div>
</div>

<div class="background1">
	<div class="container padding_top15">
		<div class="row">
			<div class="span12">
				<div class="content_header">Upload Banner</div>
				<div class="padding_top15">
					<form class="form-horizontal" id="frmUploadBanner" name="frmUploadBanner" enctype="multipart/form-data" method="post" action="<?php echo site_url('banner_manager/upload'); ?>">
						<div class="control-group">
							<label class="control-label" for="upload_image"><span class="required">*</span>&nbsp;Select Image</label>
							<div class="controls">
								<input type="file" id="upload_image" name="upload_image">
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="upload_image"><span class="required">*</span>&nbsp;Banner Description</label>
							<div class="controls">
								<textarea name="description" id="description" placeholder="Banner Description"></textarea>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="upload_image"><span class="required">*</span>&nbsp;Banner Keywords</label>
							<div class="controls">
								<textarea name="keywords" id="keywords" placeholder="Banner Keywords"></textarea>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="web_content">Banner Info</label>
							<div class="controls">
								<select name="web_content" id="web_content">
									<option value=""> - select web content - </option>
									<?php
										if($web_content){
											foreach($web_content as $list){
									?>
												<option value="<?php echo $list['web_content_id'] ?>"><?php echo $list['web_content_name'] ?></option>
									<?php
											}
										}
									?>
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
			
			if($('#upload_image').val() == ''){
				insert_detail_message('Please select the Image to upload.');
				error = 1;
			}
			
			if($('#description').val() == ''){
				insert_detail_message('Please enter the Description.');
				error = 1;
			}
			
			if($('#keywords').val() == ''){
				insert_detail_message('Please enter the Keywords.');
				error = 1;
			}
			
			if(error == 1){
				insert_header_message('Please correct the following error:');
				display_message();
			} else {
				$('#frmUploadBanner').submit();
			}
			
			setTimeout('hide_message()', 4000);
		}
	);
		
</script>