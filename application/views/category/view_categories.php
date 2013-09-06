<div class="container">
	<div class="row">
		<div class="span12">
			<div class="fontsize_18">Product Categories</div>
		</div>
	</div>
	<div class="row padding_top15">
		<div class="span6">
			<ul class="nav nav-pills">
				<li class="active"><a href="<?php echo current_url() ?>">View Product Categories</a></li>
				<li class=""><a href="<?php echo site_url('category/add') ?>">Add Category</a></li>
			</ul>
		</div>
	</div>
</div>

<div class="background1">
	<div class="container padding_top15">
		<div class="row">
			<div class="span12">
				<div class="content_header">View Product Categories</div>
					<div class="padding_top15">
						<div class="action_menu">
							<div class="row">
								<div class="span8">
									<a href="<?php echo site_url('category/add') ?>" class="btn btn-info margin_left5 font1">Add</a>
								</div>
							</div>
						</div>
					</div>
					<table class="table table-striped table-hover">
						<tr>
							<th>Category Name</th>
							<th>Action</th>
						</tr>
						<?php
							if($category){
								foreach($category as $list){
						?>
									<tr>
										<td><?php echo $list['category_name'] ?></td>
										<td>
											<div class="btn-group">
												<a class="btn btn-info dropdown-toggle" data-toggle="dropdown" href="#"> Action <span class="caret"></span></a>
												<ul class="dropdown-menu">
													<li><a href="<?php echo site_url('category/edit/'.$list['category_id']) ?>">Edit</a></li>
													<li><a href="#" onclick="delete_item('<?php echo $list['category_id'] ?>')">Delete</a></li>
													<li class="divider"></li>
													<li><a href="<?php echo site_url('category/cover-template/'.$list['category_id']) ?>">Cover Template</a></li>
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

	function delete_item(category_id)
	{
		$('#key').val(category_id);
		$('#confirm_title').html('Delete Category');
		$('#confirm_message').html('Proceed in deleting the Category?');
		$('#myModal').modal('show');
	}
	
	$('#cmdDelete').click
	(
		function()
		{
			$.post
			(
				'<?php echo site_url("category/delete") ?>',
				{
					category_id: $('#key').val()
				},
				function(data)
				{
					$('#myModal').modal('hide');
					if(data == 'LOGIN'){
						window.location = '<?php echo site_url("admin") ?>';
					} else if(data == 'SUCCESS'){
						insert_header_message('Delete Category');
						insert_detail_message('Category successfully deleted.');
						display_message();
					} else if(data == 'ERROR'){
						insert_header_message('Delete Category');
						insert_detail_message('There was an error in deleting the Category. Please try again.');
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