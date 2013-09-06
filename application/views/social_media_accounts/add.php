<div class="container">
	<div class="row">
		<div class="span12">
			<div class="fontsize_18">Social Media Accounts</div>
		</div>
	</div>
	<div class="row padding_top15">
		<div class="span6">
			<ul class="nav nav-pills">
				<li class=""><a href="<?php echo site_url('social_media_accounts/view-social-media-accounts') ?>">View Social Media Accounts</a></li>
				<li class="active"><a href="<?php echo current_url() ?>">Add Social Media Account</a></li>
			</ul>
		</div>
	</div>
</div>

<div class="background1">
	<div class="container padding_top15">
		<div class="row">
			<div class="span12">
				<div class="content_header">Add Social Media Account</div>
				<div class="padding_top15">
					<form class="form-horizontal" id="frmSocialMedia" name="frmSocialMedia" enctype="multipart/form-data" method="post" action="<?php echo site_url('social_media_accounts/save'); ?>">
						<div class="control-group">
							<label class="control-label" for="inputURL"><span class="required">*</span>&nbsp;Social Media URL</label>
							<div class="controls">
								<div><input type="text" id="social_media_url" name="social_media_url" placeholder="URL"></div>
								<div class="color1"><i>Sample: http://www.facebook.com/jbwebsolutions_provider</i></div>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="inputName"><span class="required">*</span>&nbsp;Social Media Name</label>
							<div class="controls"><input type="text" id="social_media_name" name="social_media_name" placeholder="Name"></div>
						</div>
						<div class="control-group">
							<label class="control-label" for="inputLogo"><span class="required">*</span>&nbsp;Social Media Logo</label>
							<div class="controls"><input type="file" id="social_media_logo" name="social_media_logo" placeholder="Logo"></div>
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
			if($('#social_media_url').val() == ''){
				insert_detail_message('Please enter the Social Media URL.');
				error = 1;
			}
			
			if($('#social_media_name').val() == ''){
				insert_detail_message('Please enter the Social Media Name.');
				error = 1;
			}
			
			if($('#social_media_logo').val() == ''){
				insert_detail_message('Please select the Social Media Logo.');
				error = 1;
			}
			
			if(error == 1){
				insert_header_message('<b>Please correct the following error:</b>');
				display_message();
			} else {
				// Validate if valid url
				var myVariable = $('#social_media_url').val();
				if(/^([a-z]([a-z]|\d|\+|-|\.)*):(\/\/(((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:)*@)?((\[(|(v[\da-f]{1,}\.(([a-z]|\d|-|\.|_|~)|[!\$&'\(\)\*\+,;=]|:)+))\])|((\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5])\.(\d|[1-9]\d|1\d\d|2[0-4]\d|25[0-5]))|(([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=])*)(:\d*)?)(\/(([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)*)*|(\/((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)+(\/(([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)*)*)?)|((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)+(\/(([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)*)*)|((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)){0})(\?((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|[\uE000-\uF8FF]|\/|\?)*)?(\#((([a-z]|\d|-|\.|_|~|[\u00A0-\uD7FF\uF900-\uFDCF\uFDF0-\uFFEF])|(%[\da-f]{2})|[!\$&'\(\)\*\+,;=]|:|@)|\/|\?)*)?$/i.test(myVariable)) {
					$('#frmSocialMedia').submit();
				} else {
					insert_header_message('<b>Please correct the following error:</b>');
					insert_detail_message('Invalid URL. Please try again.');
					display_message();
				}
			}
			
			
		}
	);
	
</script>