<div class="container">
	<div class="row">
		<div class="span12">
			<div class="fontsize_18">Products</div>
		</div>
	</div>
	<div class="row padding_top15">
		<div class="span6">
			<ul class="nav nav-pills">
				<li class="active"><a href="<?php echo site_url('product/view-products') ?>">View Products</a></li>
				<li class=""><a href="<?php echo site_url('product/add') ?>">Add Product</a></li>
				<li class=""><a href="<?php echo site_url('product/image-settings') ?>">Image Settings</a></li>
			</ul>
		</div>
	</div>
</div>

<div class="background1">
	<div class="container padding_top15">
		<div class="row">
			<div class="span12">
				<div class="content_header">View Products</div>
				<table class="table table-striped table-hover">
					<tr>
						<th>Category</th>
						<th>Product Name</th>
						<th>Price</th>
						<th>Action</th>
					</tr>
					<?php
						if($products){
							foreach($products as $list){
					?>
								<tr>
									<td><?php echo $list['category_name'] ?></td>
									<td><?php echo $list['product_name'] ?></td>
									<td><?php echo $currency[0]['data'].' '.$list['price'] ?></td>
									<td>
										<div class="btn-group">
											<a class="btn btn-info dropdown-toggle" data-toggle="dropdown" href="#"> Action <span class="caret"></span></a>
											<ul class="dropdown-menu">
												<li><a href="<?php echo site_url('product/view/'.$list['product_id']) ?>">View</a></li>
												<li><a href="<?php echo site_url('product/edit/'.$list['product_id']) ?>">Edit</a></li>
												<li><a href="#" onclick="delete_item('<?php echo $list['product_id'] ?>')">Delete</a></li>
												<li class="divider"></li>
												<li><a href="<?php echo site_url('product/product-specs/'.$list['product_id']) ?>">Product Specs</a></li>
												<li><a href="<?php echo site_url('product/product-pricing/'.$list['product_id']) ?>">Product Pricing</a></li>
												<li><a href="<?php echo site_url('product/product-designs/'.$list['product_id']) ?>">Product Designs</a></li>
												<li><a href="<?php echo site_url('product/product-styles/'.$list['product_id']) ?>">Product Styles</a></li>
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

	function delete_item(product_id)
	{
		$('#key').val(product_id);
		$('#confirm_title').html('Delete Product');
		$('#confirm_message').html('Proceed in deleting the Product?');
		$('#myModal').modal('show');
	}
	
	$('#cmdDelete').click
	(
		function()
		{
			$.post
			(
				'<?php echo site_url("product/delete") ?>',
				{
					product_id: $('#key').val()
				},
				function(data)
				{
					$('#myModal').modal('hide');
					if(data == 'LOGIN'){
						window.location = '<?php echo site_url("admin") ?>';
					} else if(data == 'SUCCESS'){
						insert_header_message('Delete Product');
						insert_detail_message('Product successfully deleted.');
						display_message();
					} else if(data == 'ERROR'){
						insert_header_message('Delete Product');
						insert_detail_message('There was an error in deleting the Product. Please try again.');
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
	
	function display_status(product_id, status)
	{
		$.post
		(
			'<?php echo site_url("products/update-status") ?>',
			{
				product_id: product_id,
				status: status
			},
			function(data)
			{
				if(data == 'LOGIN'){
					window.location = '<?php echo site_url("admin") ?>';
				} else if(data == 'SUCCESS'){
					insert_header_message('Update Product Status');
					insert_detail_message('Product Status successfully updated.');
					display_message();
				} else if(data == 'ERROR'){
					insert_header_message('Update Product Status');
					insert_detail_message('There was an error in updating the Product Status. Please try again.');
					display_message();
				}
				setTimeout('refresh_page()', 3000);
			}
		);
	}
	
</script>