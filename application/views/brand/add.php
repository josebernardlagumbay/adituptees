<div class="container">
	<div class="row">
		<div class="span12">
			<div class="fontsize_18">Product Decoration Methods</div>
		</div>
	</div>
	<div class="row padding_top15">
		<div class="span6">
			<ul class="nav nav-pills">
				<li class=""><a href="<?php echo site_url('decoration_methods/view-decoration-methods') ?>">View Product Decoration Methods</a></li>
				<li class="active"><a href="<?php echo site_url('decoration_methods/add') ?>">Add Decoration Method</a></li>
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
								<input type="text" id="brand_name" name="brand_name" placeholder="Brand Name">
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="brand_logo"><span class="required">*</span>&nbsp;Brand Logo</label>
							<div class="controls">
								<input type="file" name="brand_logo" id="brand_logo" value=""/>
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
			
			if($('#brand_logo').val() == ''){
				insert_detail_message('Please select the Brand Logo.');
				error = 1;
			}
			
			if(error == 1){
				insert_header_message('Please check the following error');
				display_message();
			} else {
				// Check if brand is exist
				$.post
				(
					'<?php echo site_url("brand/is-exist"); ?>',
					{
						brand_name: $('#brand_name').val(),
						key: ''
					},
					function(data)
					{
						if(data == 'EXIST'){
							$('#message_header').html('Sorry. Brand name already exist. Please try again.<br/>');
							$('#message').fadeIn('slow');
						} else {
							$('#frmBrand').submit();
						}
					}
				);
			}
			setTimeout('hide_message()', 4000);
		}
	);
	
</script>