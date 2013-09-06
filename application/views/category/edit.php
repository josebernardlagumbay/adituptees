<div class="container">
	<div class="row">
		<div class="span12">
			<div class="fontsize_18">Product Categories</div>
		</div>
	</div>
	<div class="row padding_top15">
		<div class="span6">
			<ul class="nav nav-pills">
				<li class=""><a href="<?php echo site_url('category/view-categories') ?>">View Product Categories</a></li>
				<li class=""><a href="<?php echo site_url('category/add') ?>">Add Category</a></li>
			</ul>
		</div>
	</div>
</div>

<div class="background1">
	<div class="container padding_top15">
		<div class="row">
			<div class="span12">
				<div class="content_header">Edit Product Category</div>
					<div class="padding_top15">
						<form class="form-horizontal" id="frmCategory" name="frmCategory" enctype="multipart/form-data" method="post">
							<div class="control-group">
								<label class="control-label" for="category_name"><span class="required">*</span>&nbsp;Category Name</label>
								<div class="controls">
									<input type="text" id="category_name" name="category_name" placeholder="Category Name" value="<?php echo $category[0]['category_name'] ?>">
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
			
			if($('#category_name').val() == ''){
				insert_detail_message('Please enter the Category Name.');
				error = 1;
			}
			
			if(error == 1){
				insert_header_message('Please check the following error');
				display_message();
			} else {
				// Save the category
				$.post
				(
					'<?php echo site_url("category/update") ?>',
					{
						category_name: $('#category_name').val(),
						category_id: '<?php echo $this->uri->segment(3) ?>'
					},
					function(data)
					{
						if(data == 'LOGIN'){
							window.location = '<?php echo site_url("admin") ?>';
						} else if(data == 'EXIST'){
							insert_header_message('Category Exist');
							insert_detail_message('Category Name already exist. Please try again.');
							display_message();
						} else if(data == 'SAVE'){
							insert_header_message('Category Save');
							insert_detail_message('Category Name successfully saved.');
							display_message();
						} else if(data == 'ERROR'){
							insert_header_message('Category Error');
							insert_detail_message('Error in saving the Category. Please try again.');
							display_message();
						}
						
						setTimeout('hide_message()', 4000);
					}
				);
			}
		}
	);
	
</script>