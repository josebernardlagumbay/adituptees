		<div class="bar_header color1">
			<div class="content_header">&nbsp;&nbsp;Add Color</div>
		</div>
		
		<div class="bar_body content_detail">
			<div style="margin-left: 5px;">
				<br />
				<div class="row">
					<div class="span6">
						<div class="alert alert-error" id="message" style="display: none;">
							<strong id="message_header">&nbsp;</strong> 
							<p id="message_details">&nbsp;</p>
						</div>
						<form name="frmColor" id="frmColor" method="POST" method="POST" action="<?php echo site_url('color/save'); ?>" enctype="multipart/form-data">
							<div>
								<label>Color:</label>
								<input type="text" name="color_name" id="color_name" value=""/>
							</div>
							<br />
							<div>
								<button type="button" class="btn btn-danger btn-small" name="cmdSave" id="cmdSave">Save</button>
							</div>
						</form>
					</div>
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
			$('#message_header').html('');
			$('#message_details').html('');
			$('#message').fadeOut('slow');
			
			if($('#color_name').val() == ''){
				error = 1;
				$('#message_details').append('Please enter the Color Name.<br />');
			}
			
			if(error == 1){
				$('#message_header').html('Please correct the following error(s).<br/>');
				$('#message').fadeIn('slow');
			} else {
				// Check if color is exist
				$.post
				(
					'<?php echo site_url("color/is_exist"); ?>',
					{
						color_name: $('#color_name').val(),
						key: ''
					},
					function(data)
					{
						if(data == 'EXIST'){
							$('#message_header').html('Sorry. Color name already exist. Please try again.<br/>');
							$('#message').fadeIn('slow');
						} else {
							$('#frmColor').submit();
						}
					}
				);
			}
		}
	);
</script>