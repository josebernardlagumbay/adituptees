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
				<li class=""><a href="<?php echo site_url('settings/email-address') ?>">Email Address</a></li>
				<li class="active"><a href="<?php echo site_url('settings/currency') ?>">Currency</a></li>
				<li class=""><a href="<?php echo site_url('settings/office-address') ?>">Office Address</a></li>
			</ul>
		</div>
	</div>
</div>

<div class="background1">
	<div class="container padding_top15">
		<div class="row">
			<div class="span12">
				<div class="content_header">Currency</div>
				<div class="padding_top15">
					<form class="form-horizontal">
						<div class="control-group">
							<label class="control-label" for="inputCurrency"><span class="required">*</span>&nbsp;Currency</label>
							<div class="controls"><input type="text" id="currency" name="currency" value="<?php echo $settings[0]['data'] ?>" placeholder="Currency"></div>
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
			if($('#currency').val() == ''){
				insert_detail_message('Please enter your Currency.');
				error = 1;
			}
			
			if(error == 1){
				insert_header_message('<b>Please correct the following error:</b>');
				display_message();
			} else {
				// Update the currency
				$.post
				(
					'<?php echo site_url("settings/update-currency") ?>',
					{
						currency: $('#currency').val()
					},
					function(data)
					{
						if(data == 'UPDATE'){
							insert_detail_message('Currency successfully updated.');
							insert_header_message('<b>Currency Update</b>');
							display_message();
						} else if(data == 'LOGIN'){
							window.location = '<?php echo site_url("admin") ?>';
						} else {
							insert_detail_message('There was an error in updating the Currency. Please try again.');
							insert_header_message('<b>Currency Update</b>');
							display_message();
						}
						$("#paypal_account").val('');
					}
				);
			}
			
			setTimeout('hide_message()', 4000);
			
		}
	);
	
</script>