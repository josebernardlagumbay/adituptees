<div class="container">
	<div class="row">
		<div class="span12">
			<div class="fontsize_18">Product Types</div>
		</div>
	</div>
	<div class="row padding_top15">
		<div class="span6">
			<ul class="nav nav-pills">
				<li class=""><a href="<?php echo site_url('product_type/view-product-types') ?>">View Product Types</a></li>
				<li class=""><a href="<?php echo site_url('product_type/add') ?>">Add Product Type</a></li>
			</ul>
		</div>
	</div>
</div>

<div class="background1">
	<div class="container padding_top15">
		<div class="row">
			<div class="span12">
				<div class="content_header">Edit Product Type</div>
				<div class="padding_top15">
					<form class="form-horizontal" id="frmProducttype" name="frmProducttype" enctype="multipart/form-data" method="post">
						<div class="control-group">
							<label class="control-label" for="product_type_name"><span class="required">*</span>&nbsp;Product Type Name</label>
							<div class="controls">
								<input type="text" id="product_type_name" name="product_type_name" placeholder="Product Type Name" value="<?php echo $type[0]['product_type_name'] ?>">
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
			
			if($('#product_type_name').val() == ''){
				insert_detail_message('Please enter the Product Type Name.');
				error = 1;
			}
			
			if(error == 1){
				insert_header_message('Please check the following error');
				display_message();
			} else {
				// Save the product type
				$.post
				(
					'<?php echo site_url("product_type/update") ?>',
					{
						product_type_id: '<?php echo $this->uri->segment(3) ?>',
						product_type_name: $('#product_type_name').val()
					},
					function(data)
					{
						if(data == 'LOGIN'){
							window.location = '<?php echo site_url("admin") ?>';
						} else if(data == 'EXIST'){
							insert_header_message('Product Type Exist');
							insert_detail_message('Product Type Name already exist. Please try again.');
							display_message();
						} else if(data == 'SAVE'){
							insert_header_message('Product Type Save');
							insert_detail_message('Product Type Name successfully saved.');
							display_message();
							setTimeout('back_to_list()', 3000);
						} else if(data == 'ERROR'){
							insert_header_message('Product Type Error');
							insert_detail_message('Error in saving the Product Type. Please try again.');
							display_message();
						}
					}
				);
			}
			setTimeout('hide_message()', 4000);
		}
	);
	
	function back_to_list()
	{
		window.location = '<?php echo site_url("product_type/view-product-types") ?>';
	}
	
</script>