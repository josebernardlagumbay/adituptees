<div class="container">
	<div class="row">
		<div class="span12">
			<div class="fontsize_18">Product Brands</div>
		</div>
	</div>
	<div class="row padding_top15">
		<div class="span6">
			<ul class="nav nav-pills">
				<li class=""><a href="<?php echo site_url('decoration_methods/view-decoration-methods') ?>">View Product Brands</a></li>
				<li class="active"><a href="<?php echo site_url('decoration_methods/add') ?>">Add Brand</a></li>
			</ul>
		</div>
	</div>
</div>

<div class="background1">
	<div class="container padding_top15">
		<div class="row">
			<div class="span12">
				<div class="content_header">Add Product Brand</div>
				<div class="padding_top15">
					<form class="form-horizontal" id="frmBrand" name="frmBrand" enctype="multipart/form-data" method="post" action="<?php echo site_url('brand/save'); ?>">
						<div class="control-group">
							<label class="control-label" for="brand_name"><span class="required">*</span>&nbsp;Brand Name</label>
							<div class="controls">
								<input type="text" id="brand_name" name="brand_name" placeholder="Brand Name" value="<?php echo $brand[0]['brand_name']; ?>">
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
			
			if($('#brand_name').val() == ''){
				insert_detail_message('Please enter the Brand Name.');
				error = 1;
			}
			
			if(error == 1){
				insert_header_message('Please check the following error');
				display_message();
			} else {
				$.post
				(
					'<?php echo site_url("brand/update"); ?>',
					{
						brand_name: $('#brand_name').val(),
						brand_id: '<?php echo $this->uri->segment(3); ?>'
					},
					function(data)
					{
						if(data == 'LOGIN'){
							window.location = '<?php echo site_url("admin") ?>';
						} else if(data == 'EXIST'){
							insert_header_message('Brand Exist');
							insert_detail_message('Brand Name already exist. Please try again.');
							display_message();
						} else if(data == 'SAVE'){
							insert_header_message('Brand Save');
							insert_detail_message('Brand Name successfully saved.');
							display_message();
							setTimeout('back_to_list()', 3000);
						} else if(data == 'ERROR'){
							insert_header_message('Brand Error');
							insert_detail_message('Error in saving the Brand. Please try again.');
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
		window.location = '<?php echo site_url("brand/view-brands") ?>';
	}
</script>