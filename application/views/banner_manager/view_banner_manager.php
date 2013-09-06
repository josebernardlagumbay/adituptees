<div class="container">
	<div class="row">
		<div class="span12">
			<div class="fontsize_18">Banner Manager</div>
		</div>
	</div>
	<div class="row padding_top15">
		<div class="span6">
			<ul class="nav nav-pills">
				<li class="active"><a href="<?php echo current_url() ?>">View Banner Manager</a></li>
				<li class=""><a href="<?php echo site_url('banner_manager/upload-banner') ?>">Upload Banner</a></li>
				<li class=""><a href="<?php echo site_url('banner_manager/banner-settings') ?>">Banner Settings</a></li>
			</ul>
		</div>
	</div>
</div>

<div class="background1">
	<div class="container padding_top15">
		<div class="row">
			<div class="span12">
				<div class="content_header">View Banner Manager</div>
				<div class="padding_top15">
					<div class="action_menu">
						<div class="row">
							<div class="span8">
								<a href="<?php echo site_url('banner_manager/upload-banner') ?>" class="btn btn-info margin_left5 font1">Add</a>
							</div>
						</div>
					</div>
				</div>
				<table class="table table-striped table-hover">
					<tr>
						<th>Web Content Name</th>
						<th>Image</th>
						<th>URL</th>
						<th>Action</th>
					</tr>
					<?php
						if($banner){
							foreach($banner as $list){
					?>
								<tr>
									<td><?php echo $list['web_content_name'] ?></td>
									<td><img src="<?php if($list['banner_thumbnail']){ echo base_url('uploads/banner/'.$list['banner_thumbnail']); } else { echo base_url('img/blank.png'); } ?>" alt="<?php echo $list['web_content_name'] ?>" title="<?php echo $list['web_content_name'] ?>"/></td>
									<td><?php echo $list['web_content_url'] ?></td>
									<td>
										<?php
											if($list['status'] == 'display'){
										?>
												<button class="btn btn-info" onclick="display_status('<?php echo $list['banner_id'] ?>','hide')">Hide</button>
										<?php
											} else {
										?>
												<button class="btn btn-info" onclick="display_status('<?php echo $list['banner_id'] ?>','display')">Display</button>
										<?php
											}
										?>
										<button class="btn btn-info" onclick="delete_item('<?php echo $list['banner_id'] ?>')">Delete</button>
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

	function delete_item(banner_id)
	{
		$('#key').val(banner_id);
		$('#confirm_title').html('Delete Banner');
		$('#confirm_message').html('Proceed in deleting the Banner?');
		$('#myModal').modal('show');
	}
	
	$('#cmdDelete').click
	(
		function()
		{
			$.post
			(
				'<?php echo site_url("banner_manager/delete") ?>',
				{
					banner_id: $('#key').val()
				},
				function(data)
				{
					$('#myModal').modal('hide');
					if(data == 'LOGIN'){
						window.location = '<?php echo site_url("admin") ?>';
					} else if(data == 'SUCCESS'){
						insert_header_message('Delete Banner');
						insert_detail_message('Banner successfully deleted.');
						display_message();
					} else if(data == 'ERROR'){
						insert_header_message('Delete Banner');
						insert_detail_message('There was an error in deleting the Banner. Please try again.');
						display_message();
					}
					setTimeout('refresh_page()', 3000);
				}
			);
		}
	);

	function display_status(banner_id, status)
	{
		$.post
		(
			'<?php echo site_url("banner_manager/update-status") ?>',
			{
				banner_id: banner_id,
				status: status
			},
			function(data)
			{
				if(data == 'LOGIN'){
					window.location = '<?php echo site_url("admin") ?>';
				} else if(data == 'SUCCESS'){
					insert_header_message('Update Banner Image Status');
					insert_detail_message('Banner Image Status successfully updated.');
					display_message();
				} else if(data == 'ERROR'){
					insert_header_message('Update Banner Image Status');
					insert_detail_message('There was an error in updating the Banner Image Status. Please try again.');
					display_message();
				}
				setTimeout('refresh_page()', 3000);
			}
		);
	}
	
	function refresh_page()
	{
		window.location = '<?php echo current_url() ?>';
	}
	
</script>