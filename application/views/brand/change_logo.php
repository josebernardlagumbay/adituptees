		<div class="bar_header color1">
			<div class="content_header">&nbsp;&nbsp;Update <?php echo $brand[0]['brand_name']; ?> Logo</div>
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
						<form name="frmBrand" id="frmBrand" method="POST" method="POST" action="<?php echo site_url('brand/upload/'.$this->uri->segment(3)); ?>" enctype="multipart/form-data">
							<div class="control-group">
								<label class="control-label" for="inputEmail">Logo:</label>
								<input type="file" name="brand_logo" id="brand_logo" value=""/>
							</div>
							<br />
							<div>
								<button type="button" class="btn btn-danger btn-small" name="cmdSave" id="cmdSave">Save</button>
							</div>
						</form>
					</div>
				</div>
				<br />
				<br />
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">
	$('#cmdList').click
	(
		function()
		{
			list('<?php echo site_url("brand/list_brands"); ?>');
		}
	);
	
	$('#cmdAdd').click
	(
		function()
		{
			add('<?php echo site_url("brand/add"); ?>');
		}
	);
	
	$('#cmdSave').click
	(
		function()
		{
			var error = 0;
			$('#message_header').html('');
			$('#message_details').html('');
			$('#message').fadeOut('slow');
			
			if($('#brand_logo').val() == ''){
				error = 1;
				$('#message_details').append('Please select the Brand Logo.<br />');
			}
			
			if(error == 1){
				$('#message_header').html('Please correct the following error(s).<br/>');
				$('#message').fadeIn('slow');
			} else {
				$('#frmBrand').submit();
			}
		}
	);
</script>