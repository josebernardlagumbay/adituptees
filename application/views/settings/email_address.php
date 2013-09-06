<div class="container">
	<div class="row">
		<div class="span12">
			<div class="fontsize_18">Settings</div>
		</div>
	</div>
	<div class="row padding_top15">
		<div class="span6">
			<ul class="nav nav-pills">
				<li class=""><a href="<?php echo site_url('settings/paypal-account') ?>">Paypal Account</a></li>
				<li class="active"><a href="<?php echo site_url('settings/email-address') ?>">Email Address</a></li>
				<li class=""><a href="<?php echo site_url('settings/currency') ?>">Currency</a></li>
				<li class=""><a href="<?php echo site_url('settings/office-address') ?>">Office Address</a></li>
			</ul>
		</div>
	</div>
</div>

<div class="background1">
	<div class="container padding_top15">
		<div class="row">
			<div class="span12">
				<div class="content_header">Email Address</div>
				<div class="padding_top15">
					<form class="form-horizontal">
						<div class="control-group">
							<label class="control-label" for="inputEmailAddress"><span class="required">*</span>&nbsp;Email</label>
							<div class="controls"><input type="text" id="email_address" name="email_address" value="<?php echo $settings[0]['data'] ?>" placeholder="Email Address"></div>
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
			if($('#email_address').val() == ''){
				insert_detail_message('Please enter your Email Address.');
				error = 1;
			}
			
			if(error == 1){
				insert_header_message('<b>Please correct the following error:</b>');
				display_message();
			} else {
				// Check email address format
				var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
		        var email_address = $("#email_address").val();
				
				if(!emailReg.test(email_address)){
					insert_detail_message('Please correct the email address. It is invalid.');
					insert_header_message('<b>Please check the error:</b>');
					display_message();
                } else {
					// Update the email address
					$.post
					(
						'<?php echo site_url("settings/update-email-address") ?>',
						{
							email_address: $('#email_address').val()
						},
						function(data)
						{
							if(data == 'UPDATE'){
								insert_detail_message('Email Address successfully updated.');
								insert_header_message('<b>Email Address Update</b>');
								display_message();
							} else if(data == 'LOGIN'){
								window.location = '<?php echo site_url("admin") ?>';
							} else {
								insert_detail_message('There was an error in updating the Email Address. Please try again.');
								insert_header_message('<b>Email Address Update</b>');
								display_message();
							}
							$("#email_address").val('');
						}
					);
				}
			}
			
			setTimeout('hide_message()', 4000);
			
		}
	);
	
</script>