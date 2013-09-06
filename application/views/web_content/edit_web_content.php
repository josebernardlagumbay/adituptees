<script src="<?php echo base_url('ckeditor/ckeditor.js'); ?>"></script>
<script src="<?php echo base_url('ckeditor/adapters/jquery.js'); ?>"></script>

<div class="container">
	<div class="row">
		<div class="span12">
			<div class="fontsize_18">Web Content</div>
		</div>
	</div>
	<div class="row padding_top15">
		<div class="span6">
			<ul class="nav nav-pills">
				<li class=""><a href="<?php echo site_url('web_content/view-web-content') ?>">View Web Content</a></li>
				<li class=""><a href="<?php echo site_url('web_content/create-web-content') ?>">Create Web Content</a></li>
			</ul>
		</div>
	</div>
</div>

<div class="background1">
	<div class="container padding_top15">
		<div class="row">
			<div class="span12">
				<div class="content_header">Edit Web Content</div>
				<div class="padding_top15">
					<form class="form-horizontal" id="frmWebContent" name="frmWebContent" enctype="multipart/form-data" method="post" action="<?php echo site_url('web_content/update'); ?>">
						<div class="control-group">
							<label class="control-label" for="input_web_content_name"><span class="required">*</span>&nbsp;Web Content Type</label>
							<div class="controls">
								<label class="radio"><input type="radio" id="web_content_type[]" name="web_content_type[]" value="new page" <?php if($web_content[0]['web_content_type'] == 'new page'){ ?> checked="checked" <?php } ?>>New Page</label>
								<label class="radio"><input type="radio" id="web_content_type[]" name="web_content_type[]" value="ads" <?php if($web_content[0]['web_content_type'] == 'ads'){ ?> checked="checked" <?php } ?>>Ads</label>
								<label class="radio"><input type="radio" id="web_content_type[]" name="web_content_type[]" value="content only" <?php if($web_content[0]['web_content_type'] == 'content only'){ ?> checked="checked" <?php } ?>>Content Only</label>
								<label class="radio"><input type="radio" id="web_content_type[]" name="web_content_type[]" value="menu link" <?php if($web_content[0]['web_content_type'] == 'menu link'){ ?> checked="checked" <?php } ?>>Menu Link</label>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="input_web_content_name"><span class="required">*</span>&nbsp;Web Content Name</label>
							<div class="controls"><input type="text" id="web_content_name" name="web_content_name" placeholder="Web Content Name" value="<?php echo $web_content[0]['web_content_name'] ?>"></div>
						</div>
						<div class="control-group">
							<label class="control-label" for="input_web_content_url">Web Content URL</label>
							<div class="controls"><input type="text" id="web_content_url" name="web_content_url" placeholder="Web Content URL" readonly="readonly" value="<?php echo $web_content[0]['web_content_url'] ?>"></div>
						</div>
						<div class="control-group">
							<label class="control-label" for="input_web_content">Content Summary</label>
							<div class="controls"><textarea id="content_summary" name="content_summary" class="span8" placeholder="Content Summary"><?php echo $web_content[0]['content_summary'] ?></textarea></div>
						</div>
						<div class="control-group">
							<label class="control-label" for="input_web_content">Full Content</label>
							<div class="controls"><textarea id="full_content" name="full_content" placeholder="Full Content"><?php echo $web_content[0]['full_content'] ?></textarea></div>
						</div>
						<div class="control-group">
							<label class="control-label" for="input_display_header">Display Header</label>
							<div class="controls">
								<label class="radio"><input type="radio" id="display_header[]" name="display_header[]" value="Yes" <?php if($web_content[0]['display_header'] == 'Yes'){ ?> checked="checked" <?php } ?>>Yes</label>
								<label class="radio"><input type="radio" id="display_header[]" name="display_header[]" value="No" <?php if($web_content[0]['display_header'] == 'No'){ ?> checked="checked" <?php } ?>>No</label>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="input_display_header">Display Footer</label>
							<div class="controls">
								<label class="radio"><input type="radio" id="display_footer[]" name="display_footer[]" value="Yes" <?php if($web_content[0]['display_footer'] == 'Yes'){ ?> checked="checked" <?php } ?>>Yes</label>
								<label class="radio"><input type="radio" id="display_footer[]" name="display_footer[]" value="No" <?php if($web_content[0]['display_footer'] == 'No'){ ?> checked="checked" <?php } ?>>No</label>
							</div>
						</div>
						<!-- 
						<div class="control-group">
							<label class="control-label" for="input_display_header">Display Blog</label>
							<div class="controls">
								<label class="radio"><input type="radio" id="display_blog[]" name="display_blog[]" value="Yes" <?php if($web_content[0]['display_blog'] == 'Yes'){ ?> checked="checked" <?php } ?>>Yes</label>
								<label class="radio"><input type="radio" id="display_blog[]" name="display_blog[]" value="No" <?php if($web_content[0]['display_blog'] == 'No'){ ?> checked="checked" <?php } ?>>No</label>
							</div>
						</div>
						-->
						<div class="control-group">
							<div class="controls"><button type="button" class="btn btn-info" name="cmdSave" id="cmdSave">Save</button></div>
						</div>
						<input type="hidden" name="web_content_id" id="web_content_id" value="<?php echo $this->uri->segment(3) ?>"/>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<script type="text/javascript">

	CKEDITOR.replace( 'full_content');
	
	$('#web_content_name').keyup
	(
		function()
		{
			if($('#web_content_name').val() != ''){
				var url_equivalent = convertToSlug($('#web_content_name').val());
				$('#web_content_url').val(url_equivalent);
			}
		}
	);
	
	$('#cmdSave').click
	(
		function()
		{
			var error = 0;
			init_message();
			if($('#web_content_name').val() == ''){
				insert_detail_message('Please enter the Web Content Name.');
				error = 1;
			}
			
			if(error == 1){
				insert_header_message('<b>Please correct the following error:</b>');
				display_message();
			} else {
				// Check if Page name exist
				$.post
				(
					'<?php echo site_url("web_content/page-name-exist") ?>',
					{
						web_content_name: $("#web_content_name").val(),
						web_content_id: $('#web_content_id').val()
					},
					function(data)
					{
						if(data == 'EXIST'){
							insert_header_message('Web Content Name Exist');
							insert_detail_message('Web Content Name already exist. Please try again.');
							display_message();
						} else {
							$('#frmWebContent').submit();
						}
					}
				);
			}
			
			
		}
	);
	
</script>