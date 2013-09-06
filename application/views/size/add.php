<div class="container">
	<div class="row">
		<div class="span12">
			<div class="fontsize_18">Product Sizes</div>
		</div>
	</div>
	<div class="row padding_top15">
		<div class="span6">
			<ul class="nav nav-pills">
				<li class=""><a href="<?php echo site_url('size/view-sizes') ?>">View Product Sizes</a></li>
				<li class="active"><a href="<?php echo site_url('size/add') ?>">Add Size</a></li>
			</ul>
		</div>
	</div>
</div>

<div class="background1">
	<div class="container padding_top15">
		<div class="row">
			<div class="span12">
				<div class="content_header">Add Product Size</div>
				<div class="padding_top15">
					<form class="form-horizontal" id="frmSize" name="frmSize" enctype="multipart/form-data" method="post">
						<div class="control-group">
							<label class="control-label" for="size_name"><span class="required">*</span>&nbsp;Size Name</label>
							<div class="controls">
								<input type="text" id="size_name" name="size_name" placeholder="Size Name">
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="add_on_amount"><span class="required">*</span>&nbsp;Add On Amount <?php echo $currency[0]['data'] ?></label>
							<div class="controls">
								<input type="text" id="add_on_amount" name="add_on_amount" placeholder="Add On Amount" value="0.00">
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
			
			if($('#size_name').val() == ''){
				insert_detail_message('Please enter the Size Name.');
				error = 1;
			}
			
			if($('#add_on_amount').val() == ''){
				insert_detail_message('Please enter the Add On Amount.');
				error = 1;
			}
			
			if(error == 1){
				insert_header_message('Please check the following error');
				display_message();
			} else {
				// Save the size
				$.post
				(
					'<?php echo site_url("size/save") ?>',
					{
						size_name: $('#size_name').val(),
						add_on_amount: $('#add_on_amount').val()
					},
					function(data)
					{
						if(data == 'LOGIN'){
							window.location = '<?php echo site_url("admin") ?>';
						} else if(data == 'EXIST'){
							insert_header_message('Size Exist');
							insert_detail_message('Size Name already exist. Please try again.');
							display_message();
						} else if(data == 'SAVE'){
							insert_header_message('Size Save');
							insert_detail_message('Size Name successfully saved.');
							display_message();
							$('#size_name').val('');
							$('#add_on_amount').val('0.00');
						} else if(data == 'ERROR'){
							insert_header_message('Size Error');
							insert_detail_message('Error in saving the Size. Please try again.');
							display_message();
						}
					}
				);
			}
			setTimeout('hide_message()', 4000);
		}
	);
	
</script>