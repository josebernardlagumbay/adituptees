<div class="container">
	<div class="row">
		<div class="span12">
			<div class="fontsize_18">Product Decoration Methods</div>
		</div>
	</div>
	<div class="row padding_top15">
		<div class="span6">
			<ul class="nav nav-pills">
				<li class=""><a href="<?php echo site_url('decoration/view-decoration-methods') ?>">View Product Decoration Methods</a></li>
				<li class=""><a href="<?php echo site_url('decoration/add') ?>">Add Decoration Method</a></li>
			</ul>
		</div>
	</div>
</div>

<div class="background1">
	<div class="container padding_top15">
		<div class="row">
			<div class="span12">
				<div class="content_header">Edit Product Decoration Method</div>
				<div class="padding_top15">
					<form class="form-horizontal" id="frmDecorationmethod" name="frmDecorationmethod" enctype="multipart/form-data" method="post">
						<div class="control-group">
							<label class="control-label" for="decoration_method_name"><span class="required">*</span>&nbsp;Decoration Method Name</label>
							<div class="controls">
								<input type="text" id="decoration_method_name" name="decoration_method_name" value="<?php echo $decoration_method[0]['decoration_method_name'] ?>" placeholder="Decoration Method Name">
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="add_on_amount"><span class="required">*</span>&nbsp;Add On Amount <?php echo $currency[0]['data'] ?></label>
							<div class="controls">
								<input type="text" id="add_on_amount" name="add_on_amount" placeholder="Add On Amount" value="<?php echo $decoration_method[0]['add_on_amount'] ?>">
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
			
			if($('#decoration_method_name').val() == ''){
				insert_detail_message('Please enter the Decoration Method Name.');
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
					'<?php echo site_url("decoration/update") ?>',
					{
						decoration_method_id: '<?php echo $this->uri->segment(3) ?>',
						decoration_method_name: $('#decoration_method_name').val(),
						add_on_amount: $('#add_on_amount').val()
					},
					function(data)
					{
						if(data == 'LOGIN'){
							window.location = '<?php echo site_url("admin") ?>';
						} else if(data == 'EXIST'){
							insert_header_message('Decoration Method Exist');
							insert_detail_message('Decoration Method Name already exist. Please try again.');
							display_message();
						} else if(data == 'SAVE'){
							insert_header_message('Decoration Method Save');
							insert_detail_message('Decoration Method Name successfully saved.');
							display_message();
							setTimeout('back_to_list()', 3000);
						} else if(data == 'ERROR'){
							insert_header_message('Decoration Method Error');
							insert_detail_message('Error in saving the Decoration Method. Please try again.');
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
		window.location = '<?php echo site_url("decoration/view-decoration-methods") ?>';
	}
	
</script>