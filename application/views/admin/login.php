<div class="row">
	<div class="span10">
		<div class="bar_header content_header color1">
			<div class="row">
				<div class="span5">&nbsp;&nbsp;&nbsp;&nbsp;Admin Login</div>
			</div>
		</div>
		<br />
		<div class="content_detail">
			<div class="row">
				<div class="span3">&nbsp;</div>
				<div class="span4">
					<div class="content_header">Login as Admin</div>
					<div class="margin_top20 content_detail">
						<form id="frmLogin" action="<?php echo site_url('admin/dashboard'); ?>" method="POST" name="frmLogin">
							<div class="content_detail">
								<label>User Name:</label>
								<input id="username" type="text" name="username" placeholder="Please enter Username">
							</div>
							<div class="content_detail">
								<label>Password:</label>
								<input id="userpassword" type="password" name="userpassword" placeholder="Please enter Password">
							</div>
							<button type="button" class="btn btn-danger btn-small" name="cmdLogin" id="cmdLogin">Login</button>
						</form>
					</div>
				</div>
				<div class="span3">&nbsp;</div>
			</div>
		</div>
	</div>
</div>


<script type="text/javascript">
	$('#cmdLogin').click
	(
		function()
		{
			var error = 0;
			init_message();
			if($('#username').val() == ''){
				insert_detail_message('Please enter the User Name.');
				error = 1;
			}
			
			if($('#userpassword').val() == ''){
				insert_detail_message('Please enter the Password.');
				error = 1;
			}
			
			if(error == 1){
				insert_header_message('<b>Please check the following errors(s):</b>')
				display_message();
				
			} else {
				$.post
				(
					'<?php echo site_url("admin/authenticate"); ?>',
					{
						username: $('#username').val(),
						password: $('#userpassword').val()
					},
					function(data)
					{
						if(data == 'NOT EXIST'){
							insert_header_message('<b>Admin Account Not Exist</b>');
							insert_detail_message('Admin Account does not exist. Please enter again.');
							display_message();
						} else if(data == 'EXIST'){
							window.location = '<?php echo site_url("admin/dashboard") ?>';
						}
					}
				);
			}
			setTimeout('hide_message()', 3000);
		}
	)	
</script>