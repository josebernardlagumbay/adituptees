		<div class="span4">
			<div class="img-polaroid">
				<div class="header_title">Request for a Quote</div>
				<hr />
				<div class="alert alert-error" id="message_quote" style="display: none;">
					<strong id="message_header_quote">&nbsp;</strong> 
					<p id="message_details_quote">&nbsp;</p>
				</div>
				<form class="form-horizontal" name="frmQuote" id="frmQuote" method="POST" enctype="multipart/form-data">
					<div class="control-group">
						<label class="control-label content_details" for="Name" style="width: 100px;">Name:</label>
						<div class="controls" style="margin-left: 120px;"><input type="text" name="yourname" id="yourname"/></div>
					</div>
					<div class="control-group">
						<label class="control-label content_details" for="Email Address" style="width: 100px;">Email Address:</label>
						<div class="controls" style="margin-left: 120px;"><input type="text" name="youremail" id="youremail"/></div>
					</div>
					<div class="control-group">
						<label class="control-label content_details" for="Equote Description" style="width: 100px;">Quote Description:</label>
						<div class="controls" style="margin-left: 120px;"><textarea name="quote" id="quote"></textarea></div>
					</div>
					<div class="control-group">
						<div class="controls">
							<button type="button" class="btn btn-primary" id="cmdQuote">Send my Request <i class="icon-hand-up icon-white"></i></button>
						</div>
					</div>
				</form>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">

	$('#cmdQuote').click
	(
		function()
		{
			var error = 0;
			$('#message_header_quote').html('');
			$('#message_details_quote').html('');
			
			if($('#yourname').val() == ''){
				error = 1;
				$('#message_details_quote').append('Please enter your Name.<br/>');
			}
			
			if($('#youremail').val() == ''){
				error = 1;
				$('#message_details_quote').append('Please enter your Email Address.<br/>');
			}
			
			if($('#quote').val() == ''){
				error = 1;
				$('#message_details_quote').append('Please enter your Equote Description.<br/>');
			}
			
			if(error == 1){
				$('#message_header_quote').html('Please correct the following error(s):');
				$('#message_quote').fadeIn('slow');
			} else {
				//Save the equote
				$.post
				(
					'<?php echo site_url("equote/save"); ?>',
					{
						name: $('#yourname').val(),
						email: $('#youremail').val(),
						equote: $('#quote').val()
					},
					function(data)
					{
						if(data == 'ERROR'){
							$('#message_quote').fadeIn('slow');
							$('#message_header_quote').html('Sorry! There was an error found in saving the Request a Quote information.');
						} else {
							window.location = '<?php echo site_url("message/equote") ?>';
						}
					}
				);
			}
		}
	);

</script>