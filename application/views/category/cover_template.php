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
				<div class="content_header">Cover Template for <?php echo $category[0]['category_name'] ?></div>
					<div class="padding_top15">
						<form class="form-horizontal" id="frmCovertemplate" name="frmCovertemplate" enctype="multipart/form-data" method="post" action="<?php echo site_url('category/save-cover-template') ?>">
							<input type="hidden" name="category_id" id="category_id" value="<?php echo $this->uri->segment(3) ?>"/>
							<div class="control-group">
								<label class="control-label" for="cover_template_name"><span class="required">*</span>&nbsp;Cover Template Name</label>
								<div class="controls">
									<input type="text" id="cover_template_name" name="cover_template_name" placeholder="Cover Template Name" value="">
								</div>
							</div>
							<div class="control-group">
								<label class="control-label" for="cover_template_img"><span class="required">*</span>&nbsp;Cover Template Image</label>
								<div class="controls">
									<input type="file" id="cover_template_img" name="cover_template_img" value="">
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
			
			if($('#cover_template_name').val() == ''){
				insert_detail_message('Please enter the Cover Template Name.');
				error = 1;
			}
			
			if($('#cover_template_img').val() == ''){
				insert_detail_message('Please select the Cover Template Image.');
				error = 1;
			}
			
			if(error == 1){
				insert_header_message('Please check the following error');
				display_message();
			} else {
				// Save the category
				$('#frmCovertemplate').submit();
			}
			setTimeout('hide_message()', 4000);
		}
	);
	
</script>