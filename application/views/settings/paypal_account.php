<div class="container">
	<div class="row">
		<div class="span12">
			<div class="fontsize_18">Settings</div>
		</div>
	</div>
	<div class="row padding_top15">
		<div class="span6">
			<ul class="nav nav-pills">
				<li class="active"><a href="<?php echo site_url('settings/paypal-account') ?>">Paypal Account</a></li>
				<li class=""><a href="<?php echo site_url('settings/email-address') ?>">Email Address</a></li>
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
				<div class="content_header">Paypal Account</div>
				<div class="padding_top15">
					<form class="form-horizontal">
						<div class="control-group">
							<label class="control-label" for="inputPaypalAccount"><span class="required">*</span>&nbsp;Email</label>
							<div class="controls"><input type="text" id="paypal_account" name="paypal_account" value="<?php echo $settings[0]['data'] ?>" placeholder="Paypal Account"></div>
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
			if($('#paypal_account').val() == ''){
				insert_detail_message('Please enter your Paypal Account Email Address.');
				error = 1;
			}
			
			if(error == 1){
				insert_header_message('<b>Please correct the following error:</b>');
				display_message();
			} else {
				// Check email address format
				var emailReg = /^([\w-\.]+@([\w-]+\.)+[\w-]{2,4})?$/;
		        var paypal_account = $("#paypal_account").val();
				
				if(!emailReg.test(paypal_account)){
					insert_detail_message('Please correct the email address. It is invalid.');
					insert_header_message('<b>Please check the error:</b>');
					display_message();
                } else {
					// Update the paypal account
					$.post
					(
						'<?php echo site_url("settings/update-paypal-account") ?>',
						{
							paypal_account: $('#paypal_account').val()
						},
						function(data)
						{
							if(data == 'UPDATE'){
								insert_detail_message('Paypal Account successfully updated.');
								insert_header_message('<b>Paypal Account Update</b>');
								display_message();
							} else if(data == 'LOGIN'){
								window.location = '<?php echo site_url("admin") ?>';
							} else {
								insert_detail_message('There was an error in updating the Paypal Account. Please try again.');
								insert_header_message('<b>Paypal Account Update</b>');
								display_message();
							}
							$("#paypal_account").val('');
						}
					);
				}
			}
			
			setTimeout('hide_message()', 4000);
			
		}
	);
	
</script>