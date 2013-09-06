<div class="container">
	<div class="row">
		<div class="span12">
			<div class="fontsize_18">Web Content</div>
		</div>
	</div>
	<div class="row padding_top15">
		<div class="span6">
			<ul class="nav nav-pills">
				<li class="active"><a href="<?php echo current_url() ?>">View Web Content</a></li>
				<li class=""><a href="<?php echo site_url('web_content/create-web-content') ?>">Create Web Content</a></li>
			</ul>
		</div>
	</div>
</div>

<div class="background1">
	<div class="container padding_top15">
		<div class="row">
			<div class="span12">
				<div class="content_header">View Web Content</div>
				<div class="padding_top15">
						<div class="action_menu">
							<div class="row">
								<div class="span8">
									<a href="<?php echo site_url('web_content/create-web-content') ?>" class="btn btn-info margin_left5 font1">Add</a>
								</div>
							</div>
						</div>
					</div>
					<table class="table table-striped table-hover">
						<tr>
							<th>Web Content Name</th>
							<th>Web Content Type</th>
							<th>URL</th>
							<th>Display Header</th>
							<th>Display Footer</th>
							<th>&nbsp;</th>
							<th>Action</th>
						</tr>
						<?php
							if($web_content){
								foreach($web_content as $list){
						?>
									<tr>
										<td><?php echo $list['web_content_name'] ?></td>
										<td><?php echo $list['web_content_type'] ?></td>
										<td><?php echo $list['web_content_url'] ?></td>
										<td><?php echo $list['display_header'] ?></td>
										<td><?php echo $list['display_footer'] ?></td>
										<td>
											<?php
												if($list['status'] == 'display'){
											?>
													<button class="btn btn-info" onclick="display_status('<?php echo $list['web_content_id'] ?>','hide')">Hide</button>
											<?php
												} else {
											?>
													<button class="btn btn-info" onclick="display_status('<?php echo $list['web_content_id'] ?>','display')">Display</button>
											<?php
												}
											?>
										</td>
										<td>
											<div class="btn-group">
												<a class="btn btn-info dropdown-toggle" data-toggle="dropdown" href="#"> Action <span class="caret"></span></a>
												<ul class="dropdown-menu">
													<li><a href="<?php echo site_url('post/read/'.$list['web_content_url']); ?>" target="_blank">View</a></li>
													<li><a href="<?php echo site_url('web_content/edit-web-content/'.$list['web_content_id']) ?>">Edit</a></li>
													<li><a href="#" onclick="delete_item('<?php echo $list['web_content_id'] ?>')">Delete</a></li>
													<?php
													   if($list['web_content_type'] == 'menu link'){
                                                    ?>
                                                            <li class="divider"></li>
                                                            <li><a href="<?php echo site_url('web_content/add-content/'.$list['web_content_id']) ?>">Add Content</a></li>
                                                    <?php													      
													   }
													?>
												</ul>
											</div>
										</td>
									</tr>
						<?php
								}
							}
						?>
						<?php
							if($category){
								foreach($category as $list){
						?>
									<tr>
										<td><?php echo $list['category_name'] ?></td>
										<td>content only</td>
										<td>&nbsp;</td>
										<td>No</td>
										<td>No</td>
										<td>&nbsp;</td>
										<td>
											<div class="btn-group">
												<a class="btn btn-info dropdown-toggle" data-toggle="dropdown" href="#"> Action <span class="caret"></span></a>
												<ul class="dropdown-menu">
													<li><a href="<?php echo site_url('web_content/add-content-category/'.$list['category_id']) ?>">Add Content</a></li>
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
		$('#confirm_title').html('Delete Web Content');
		$('#confirm_message').html('Proceed in deleting the Web Content?');
		$('#myModal').modal('show');
	}
	
	$('#cmdDelete').click
	(
		function()
		{
			$.post
			(
				'<?php echo site_url("web_content/delete") ?>',
				{
					web_content_id: $('#key').val()
				},
				function(data)
				{
					$('#myModal').modal('hide');
					if(data == 'LOGIN'){
						window.location = '<?php echo site_url("admin") ?>';
					} else if(data == 'SUCCESS'){
						insert_header_message('Delete Web Content');
						insert_detail_message('Web Content successfully deleted.');
						display_message();
					} else if(data == 'ERROR'){
						insert_header_message('Delete Web Content');
						insert_detail_message('There was an error in deleting the Web Content. Please try again.');
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
	
	function display_status(web_content_id, status)
	{
		$.post
		(
			'<?php echo site_url("web_content/update-status") ?>',
			{
				web_content_id: web_content_id,
				status: status
			},
			function(data)
			{
				if(data == 'LOGIN'){
					window.location = '<?php echo site_url("admin") ?>';
				} else if(data == 'SUCCESS'){
					insert_header_message('Update Web Content Status');
					insert_detail_message('Web Content Status successfully updated.');
					display_message();
				} else if(data == 'ERROR'){
					insert_header_message('Update Web Content Status');
					insert_detail_message('There was an error in updating the Web Content Status. Please try again.');
					display_message();
				}
				setTimeout('refresh_page()', 3000);
			}
		);
	}
	
</script>