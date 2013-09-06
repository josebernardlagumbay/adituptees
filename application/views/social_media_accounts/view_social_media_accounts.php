<div class="container">
	<div class="row">
		<div class="span12">
			<div class="fontsize_18">Social Media Accounts</div>
		</div>
	</div>
	<div class="row padding_top15">
		<div class="span6">
			<ul class="nav nav-pills">
				<li class="active"><a href="<?php echo current_url() ?>">View Social Media Accounts</a></li>
				<li class=""><a href="<?php echo site_url('social_media_accounts/add') ?>">Add Social Media Account</a></li>
			</ul>
		</div>
	</div>
</div>

<div class="background1">
	<div class="container padding_top15">
		<div class="row">
			<div class="span12">
				<div class="content_header">View Social Media Account</div>
					<div class="padding_top15">
						<div class="action_menu">
							<div class="row">
								<div class="span8">
									<a href="<?php echo site_url('social_media_accounts/add') ?>" class="btn btn-info margin_left5 font1">Add</a>
								</div>
							</div>
						</div>
					</div>
					<table class="table table-striped table-hover">
						<tr>
							<th>Image</th>
							<th>Name</th>
							<th>Url</th>
							<th>Action</th>
						</tr>
						<?php
							if($social_media){
								foreach($social_media as $list){
						?>
									<tr>
										<td><img src="<?php echo base_url('uploads/social_media/'.$list['logo']) ?>" alt="<?php echo $list['name'] ?>" title="<?php echo $list['name'] ?>"/></td>
										<td><?php echo $list['name'] ?></td>
										<td><?php echo $list['url'] ?></td>
										<td>
											<div class="btn-group">
												<a class="btn btn-info dropdown-toggle" data-toggle="dropdown" href="#"> Action <span class="caret"></span></a>
												<ul class="dropdown-menu">
													<li><a href="<?php echo $list['url'] ?>" target="_blank">View</a></li>
													<li><a href="<?php echo site_url('social_media_accounts/edit/'.$list['id']) ?>">Edit</a></li>
													<li><a href="#" onclick="delete_item('<?php echo $list['id'] ?>')">Delete</a></li>
												</ul>
											</div>
										</td>
									</tr>
						<?php
								}
							}
						?>
					</table>
			</div>
		</div>
	</div>
</div>

<input type="hidden" name="key" id="key" value=""/>

<script type="text/javascript">

	function delete_item(social_id)
	{
		$('#key').val(social_id);
		$('#confirm_title').html('Delete Social Media Account');
		$('#confirm_message').html('Proceed in deleting the Social Media Account?');
		$('#myModal').modal('show');
	}
	
	$('#cmdDelete').click
	(
		function()
		{
			$.post
			(
				'<?php echo site_url("social_media_accounts/delete") ?>',
				{
					social_id: $('#key').val()
				},
				function(data)
				{
					$('#myModal').modal('hide');
					if(data == 'LOGIN'){
						window.location = '<?php echo site_url("admin") ?>';
					} else if(data == 'SUCCESS'){
						insert_header_message('Delete Social Media Account');
						insert_detail_message('Social Media Account successfully deleted.');
						display_message();
					} else if(data == 'ERROR'){
						insert_header_message('Delete Social Media Account');
						insert_detail_message('There was an error in deleting the Social Media Account. Please try again.');
						display_message();
					}
					setTimeout('refresh_page()', 3000);
				}
			);
		}
	);
	
	function refresh_page()
	{
		window.location = '<?php echo current_url() ?>';
	}
	
</script>