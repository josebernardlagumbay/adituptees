<div class="container">
	<div class="row">
		<div class="span12">
			<div class="fontsize_18">Image Manager</div>
		</div>
	</div>
	<div class="row padding_top15">
		<div class="span6">
			<ul class="nav nav-pills">
				<li class="active"><a href="<?php echo current_url() ?>">View Image Manager</a></li>
				<li class=""><a href="<?php echo site_url('image_manager/image-settings') ?>">Image Settings</a></li>
			</ul>
		</div>
	</div>
</div>

<div class="background1">
	<div class="container padding_top15">
		<div class="row">
			<div class="span12">
				<div class="content_header">View Image Manager</div>
				<div class="padding_top15">
					<table class="table table-striped table-hover">
						<tr>
							<th>Web Content Name</th>
							<th>Image</th>
							<th>&nbsp;</th>
							<th>URL</th>
							<th>Action</th>
						</tr>
						<?php
							if($web_content){
								foreach($web_content as $list){
						?>
									<tr>
										<td><?php echo $list['web_content_name'] ?></td>
										<?php
											$has_image = 0;
											if($image_manager){
												foreach($image_manager as $list1){
													if($list['web_content_id'] == $list1['web_content_id']){
														$has_image = 1;
													
										?>
														<td><img src="<?php if($list1['image_small']){ echo base_url('uploads/web_content/'.$list1['image_small']); } else { echo base_url('img/blank.png'); } ?>" alt="<?php echo $list['web_content_name'] ?>" title="<?php echo $list['web_content_name'] ?>"/></td>
														<td>
															<button class="btn btn-info" onclick="display_image('<?php echo $list1['image_manager_id'] ?>','<?php echo $list['web_content_name'] ?>')"><i class="icon-zoom-in icon-white"></i></button>
															<button class="btn btn-info" onclick="delete_image('<?php echo $list1['image_manager_id'] ?>')"><i class="icon-remove icon-white"></i></button>
														</td>
										
										<?php
													} 
												}
											}
										?>
										
										<?php
											if($has_image == 0){
										?>
												<td><img src="<?php echo base_url('img/blank.png'); ?>" alt="<?php echo $list['web_content_name'] ?>" title="<?php echo $list['web_content_name'] ?>"/></td>
												<td>&nbsp;</td>
										<?php
											}
										?>
													
										<td><?php echo $list['web_content_url'] ?></td>
										<td>
											<a href="<?php echo site_url('image_manager/upload-image/'.$list['web_content_id']) ?>" class="btn btn-info font1">Upload Image</a>
											<?php
											if($image_manager){
												foreach($image_manager as $list1){
													if($list['web_content_id'] == $list1['web_content_id']){
													
											?>
													<?php
														if($list1['status'] == 'display'){
													?>
															<button class="btn btn-info" onclick="display_status('<?php echo $list1['image_manager_id'] ?>','hide')">Hide</button>
													<?php
														} else {
													?>
															<button class="btn btn-info" onclick="display_status('<?php echo $list1['image_manager_id'] ?>','display')">Display</button>
													<?php
														}
													?>
											<?php
														}
													}
												}
											?>
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
</div>

<div id="myModalImage" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		<h3 id="image_title">&nbsp;</h3>
	</div>
	<div class="modal-body">
		<div id="image_display">&nbsp;</div>
	</div>
</div>

<input type="hidden" name="key" id="key" value=""/>

<script type="text/javascript">

	function display_image(image_manager_id, web_content_name)
	{
		$('#image_title').html(web_content_name);
		
		// Get the image
		$.post
		(
			'<?php echo site_url("image_manager/get-image") ?>',
			{
				image_manager_id: image_manager_id
			},
			function(data)
			{
				if(data == 'LOGIN'){
					window.location = '<?php echo site_url("admin") ?>';
				} else {
					$('#image_display').html(data);
					$('#myModalImage').modal('show');
				}
			}
		);
	}

	function display_status(image_manager_id, status)
	{
		$.post
		(
			'<?php echo site_url("image_manager/update-status") ?>',
			{
				image_manager_id: image_manager_id,
				status: status
			},
			function(data)
			{
				if(data == 'LOGIN'){
					window.location = '<?php echo site_url("admin") ?>';
				} else if(data == 'SUCCESS'){
					insert_header_message('Update Web Content Image Status');
					insert_detail_message('Web Content Image Status successfully updated.');
					display_message();
				} else if(data == 'ERROR'){
					insert_header_message('Update Web Content Image Status');
					insert_detail_message('There was an error in updating the Web Content Image Status. Please try again.');
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
	
	function delete_image(image_manager_id)
	{
		$('#key').val(image_manager_id);
		$('#confirm_title').html('Delete Image');
		$('#confirm_message').html('Proceed in deleting the Image?');
		$('#myModal').modal('show');
	}
	
	$('#cmdDelete').click
	(
		function()
		{
			$.post
			(
				'<?php echo site_url("image_manager/delete") ?>',
				{
					image_manager_id: $('#key').val()
				},
				function(data)
				{
					$('#myModal').modal('hide');
					if(data == 'LOGIN'){
						window.location = '<?php echo site_url("admin") ?>';
					} else if(data == 'SUCCESS'){
						insert_header_message('Delete Category');
						insert_detail_message('Image successfully deleted.');
						display_message();
					} else if(data == 'ERROR'){
						insert_header_message('Delete Image');
						insert_detail_message('There was an error in deleting the Image. Please try again.');
						display_message();
					}
					setTimeout('refresh_page()', 3000);
				}
			);
		}
	);
	
</script>