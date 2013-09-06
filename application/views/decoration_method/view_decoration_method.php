<div class="container">
	<div class="row">
		<div class="span12">
			<div class="fontsize_18">Product Decoration Methods</div>
		</div>
	</div>
	<div class="row padding_top15">
		<div class="span6">
			<ul class="nav nav-pills">
				<li class="active"><a href="<?php echo site_url('decoration/view-decoration-method') ?>">View Product Decoration Methods</a></li>
				<li class=""><a href="<?php echo site_url('decoration/add') ?>">Add Decoration Method</a></li>
			</ul>
		</div>
	</div>
</div>

<div class="background1">
	<div class="container padding_top15">
		<div class="row">
			<div class="span12">
				<div class="content_header">View Product Decoration Methods</div>
					<div class="padding_top15">
						<div class="action_menu">
							<div class="row">
								<div class="span8">
									<a href="<?php echo site_url('decoration_method/add') ?>" class="btn btn-info margin_left5 font1">Add</a>
								</div>
							</div>
						</div>
					</div>
					<table class="table table-striped table-hover">
						<tr>
							<th>Decoration Method</th>
							<th>Add On Amount</th>
							<th>Action</th>
						</tr>
						<?php
							if($decoration_method){
								foreach($decoration_method as $list){
						?>
									<tr>
										<td><?php echo $list['decoration_method_name'] ?></td>
										<td><?php echo $currency[0]['data'].' '.number_format($list['add_on_amount'],2,'.',',') ?></td>
										<td>
											<div class="btn-group">
												<a class="btn btn-info dropdown-toggle" data-toggle="dropdown" href="#"> Action <span class="caret"></span></a>
												<ul class="dropdown-menu">
													<li><a href="<?php echo site_url('decoration/edit/'.$list['decoration_method_id']) ?>">Edit</a></li>
													<li><a href="#" onclick="delete_item('<?php echo $list['decoration_method_id'] ?>')">Delete</a></li>
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

	function delete_item(decoration_method_id)
	{
		$('#key').val(decoration_method_id);
		$('#confirm_title').html('Delete Decoration Method');
		$('#confirm_message').html('Proceed in deleting the Decoration Method?');
		$('#myModal').modal('show');
	}
	
	$('#cmdDelete').click
	(
		function()
		{
			$.post
			(
				'<?php echo site_url("decoration/delete") ?>',
				{
					decoration_method_id: $('#key').val()
				},
				function(data)
				{
					$('#myModal').modal('hide');
					if(data == 'LOGIN'){
						window.location = '<?php echo site_url("admin") ?>';
					} else if(data == 'SUCCESS'){
						insert_header_message('Delete Decoration Method');
						insert_detail_message('Decoration Method successfully deleted.');
						display_message();
					} else if(data == 'ERROR'){
						insert_header_message('Delete Decoration Method');
						insert_detail_message('There was an error in deleting the Decoration Method. Please try again.');
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