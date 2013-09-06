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
				<li class=""><a href="<?php echo site_url('settings/currency') ?>">Currency</a></li>
				<li class="active"><a href="<?php echo site_url('settings/office-address') ?>">Office Address</a></li>
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
							<label class="control-label" for="company_name">Company Name</label>
							<div class="controls"><input type="text" id="company_name" name="company_name" value="<?php echo $office_address[5]['data']; ?>" placeholder="Company Name"></div>
						</div>
						<div class="control-group">
							<label class="control-label" for="street">Street</label>
							<div class="controls"><input type="text" id="street" name="street" value="<?php echo $office_address[0]['data']; ?>" placeholder="Sreet"></div>
						</div>
						<div class="control-group">
							<label class="control-label" for="city">City</label>
							<div class="controls"><input type="text" id="city" name="city" value="<?php echo $office_address[1]['data']; ?>" placeholder="City"></div>
						</div>
						<div class="control-group">
							<label class="control-label" for="state">State</label>
							<div class="controls"><input type="text" id="state" name="state" value="<?php echo $office_address[2]['data']; ?>" placeholder="State"></div>
						</div>
						<div class="control-group">
							<label class="control-label" for="zipcode">Zipcode</label>
							<div class="controls"><input type="text" id="zipcode" name="zipcode" value="<?php echo $office_address[3]['data']; ?>" placeholder="Zipcode"></div>
						</div>
						<div class="control-group">
							<label class="control-label" for="telephone_number">Telephone Number</label>
							<div class="controls"><input type="text" id="telephone_number" name="telephone_number" value="<?php echo $office_address[4]['data']; ?>" placeholder="Telephone Number"></div>
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
			
			if($('#company_name').val() == ''){
				insert_detail_message('Please enter the Company Name.');
				error = 1;
			}
			
			if($('#street').val() == ''){
				insert_detail_message('Please enter the Street.');
				error = 1;
			}
			
			if($('#city').val() == ''){
				insert_detail_message('Please enter the City.');
				error = 1;
			}
			
			if($('#state').val() == ''){
				insert_detail_message('Please enter the State.');
				error = 1;
			}
			
			if($('#zipcode').val() == ''){
				insert_detail_message('Please enter the Zipcode.');
				error = 1;
			}
			
			if($('#telephone_number').val() == ''){
				insert_detail_message('Please enter the Telephone Number.');
				error = 1;
			}
			
			if(error == 1){
				insert_header_message('<b>Please correct the following error:</b>');
				display_message();
			} else {
				// Update the office address
				$.post
				(
					'<?php echo site_url("settings/update-office-address") ?>',
					{
						company_name: $('#company_name').val(),
						street: $('#street').val(),
						city: $('#city').val(),
						state: $('#state').val(),
						zipcode: $('#zipcode').val(),
						telephone_number: $('#telephone_number').val()
					},
					function(data)
					{
						if(data == 'UPDATE'){
							insert_detail_message('Office Address successfully updated.');
							insert_header_message('<b>Office Address Update</b>');
							display_message();
						} else if(data == 'LOGIN'){
							window.location = '<?php echo site_url("admin") ?>';
						}
					}
				);
			}
			
			setTimeout('hide_message()', 4000);
			
		}
	);
	
</script>