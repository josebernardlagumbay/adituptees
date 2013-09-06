<div class="container">
	<div class="row">
		<div class="span12">
			<div class="fontsize_18">Web Content</div>
		</div>
	</div>
	<div class="row padding_top15">
		<div class="span6">
			<ul class="nav nav-pills">
				<li class="active"><a href="<?php echo current_url() ?>">Upload Logo</a></li>
			</ul>
		</div>
	</div>
</div>

<div class="background1">
	<div class="container padding_top15">
		<div class="row">
			<div class="span12">
				<div id="output"></div>
				<div class="content_header">Upload Logo</div>
				<div class="padding_top15">
					<form class="form-horizontal" id="frmLogo" name="frmLogo" enctype="multipart/form-data" method="post" action="<?php echo site_url('web_content/upload-logo'); ?>">
						<div class="control-group">
							<label class="control-label" for="logo"><span class="required">*</span>&nbsp;Logo</label>
							<div class="controls"><input type="file" id="logo" name="logo"></div>
						</div>
						<div class="control-group">
							<div class="controls"><button type="button" class="btn btn-info" name="cmdUpload" id="cmdUpload">Upload</button></div>
						</div>
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
			if($('#logo').val() == ''){
				insert_detail_message('Please select the Logo to upload.');
				error = 1;
			}
			
			if(error == 1){
				insert_header_message('<b>Please correct the following error:</b>');
				display_message();
			} else {
				$('#frmLogo').submit();
			}
		}
	);
	
</script>