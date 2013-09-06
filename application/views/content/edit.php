		<script src="<?php echo base_url('ckeditor/ckeditor.js'); ?>"></script>
		
		<div class="span8">
			<div class="content_header"><span class="color_1">Edit</span> <span class="color_2">Content</span></div>
			<br />
			<div class="content_detail">
				<form class="form-horizontal" name="frmContent" id="frmContent" method="POST" method="POST" action="<?php echo site_url('content/update/'.$this->uri->segment(3)); ?>" enctype="multipart/form-data">
					<div class="control-group">
						<label class="control-label content_details" for="inputEmail" style="width: 100px;">Title:</label>
						<div class="controls" style="margin-left: 120px;"><input type="text" class="span4" name="title" id="title" value="<?php echo $content[0]['title']; ?>"/></div>
					</div>
					<div class="control-group">
						<label class="control-label content_details" for="Brand" style="width: 100px;">Details:</label>
						<div class="controls" style="margin-left: 120px;"><textarea name="details" id="details"><?php echo $content[0]['content']; ?></textarea></div>
					</div>
					<div class="control-group">
						<div class="controls">
							<button type="button" class="btn btn-inverse" name="cmdSave" id="cmdSave">Save <i class="icon-hdd icon-white"></i></button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	CKEDITOR.replace( 'details');

	$('#cmdSave').click
	(
		function()
		{
			var error = 0;
			$('#message_header').html('');
			$('#message_details').html('');
			$('#message').fadeOut('slow');
			
			if($('#title').val() == ''){
				error = 1;
				$('#message_details').append('Please enter the Title.<br />');
			}
			
			if(error == 1){
				$('#message_header').html('Please correct the following error(s).<br/>');
				$('#message').fadeIn('slow');
			} else {
				$('#frmContent').submit();
			}
		}
	);
</script>