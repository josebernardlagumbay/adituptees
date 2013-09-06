<div class="container">
	<div class="row">
		<div class="span12">
			<div class="fontsize_18">Change Password</div>
		</div>
	</div>
	<div class="row padding_top15">
		<div class="span6">
			<ul class="nav nav-pills">
				<li class="active"><a href="<?php echo current_url() ?>">Change Password</a></li>
			</ul>
		</div>
	</div>
</div>

<div class="background1">
	<div class="container padding_top15">
		<div class="row">
			<div class="span12">
				<div class="content_header">Change Password</div>
				<div class="padding_top15">
					<form class="form-horizontal" id="frmChangePassword" name="frmChangePassword" enctype="multipart/form-data" method="post">
						<div class="control-group">
							<label class="control-label" for="new_password"><span class="required">*</span>&nbsp;New Password</label>
							<div class="controls">
								<input type="password" id="new_password" name="new_password" placeholder="New Password">
							</div>
						</div>
						<div class="control-group">
                            <label class="control-label" for="retype_new_password"><span class="required">*</span>&nbsp;Re-type New Password</label>
                            <div class="controls">
                                <input type="password" id="retype_new_password" name="retype_new_password" placeholder="Re-type New Password">
                            </div>
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
			
			if($('#new_password').val() == ''){
				insert_detail_message('Please enter your New Password.');
				error = 1;
			}
			
			if($('#retype_new_password').val() == ''){
                insert_detail_message('Please retype your New Password.');
                error = 1;
            }
			
			if(error == 1){
				insert_header_message('Please check the following error');
				display_message();
			} else {
			    // Check if password are the same
			    if($('#new_password').val() != $('#retype_new_password').val()){
			        insert_header_message('Please check the following error');
			        insert_detail_message('Password mismatch. Please try again.');
                    display_message();
			    } else {
			        // Save the new password
                    $.post
                    (
                        '<?php echo site_url("admin/update-new-password") ?>',
                        {
                            new_password: $('#new_password').val()
                        },
                        function(data)
                        {
                            if(data == 'LOGIN'){
                                window.location = '<?php echo site_url("admin") ?>';
                            } else if(data == 'SAVE'){
                                insert_header_message('Update Admin Password');
                                insert_detail_message('Admin Password successfully updated.');
                                display_message();
                                $('#category_name').val('');
                            } else if(data == 'ERROR'){
                                insert_header_message('Update Admin Password Error');
                                insert_detail_message('Error in updating the Admin Password. Please try again.');
                                display_message();
                            }
                            
                            setTimeout('hide_message()', 4000);
                        }
                    );
			    }
			}
		}
	);
	
</script>