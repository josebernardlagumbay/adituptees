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
				<li class="active"><a href="<?php echo current_url() ?>">Create Web Content</a></li>
			</ul>
		</div>
	</div>
</div>

<div class="background1">
	<div class="container padding_top15">
		<div class="row">
			<div class="span12">
				<div id="output"></div>
				<div class="content_header">Create Web Content</div>
				<div class="padding_top15">
					<form class="form-horizontal" id="frmWebContent" name="frmWebContent" enctype="multipart/form-data" method="post" action="<?php echo site_url('web_content/save'); ?>">
						<div class="control-group">
							<label class="control-label" for="input_web_content_name"><span class="required">*</span>&nbsp;Web Content Type</label>
							<div class="controls">
								<label class="radio"><input type="radio" id="web_content_type[]" name="web_content_type[]" value="new page">New Page</label>
								<label class="radio"><input type="radio" id="web_content_type[]" name="web_content_type[]" value="ads">Ads</label>
								<label class="radio"><input type="radio" id="web_content_type[]" name="web_content_type[]" value="content only" checked="checked">Content Only</label>
								<label class="radio"><input type="radio" id="web_content_type[]" name="web_content_type[]" value="menu link">Menu Link</label>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="input_web_content_name"><span class="required">*</span>&nbsp;Web Content Name</label>
							<div class="controls"><input type="text" id="web_content_name" name="web_content_name" placeholder="Web Content Name"></div>
						</div>
						<div class="control-group">
							<label class="control-label" for="input_web_content_url">Web Content URL</label>
							<div class="controls"><input type="text" id="web_content_url" name="web_content_url" placeholder="Web Content URL" readonly="readonly"></div>
						</div>
						<div class="control-group">
							<label class="control-label" for="input_web_content">Content Summary</label>
							<div class="controls"><textarea id="content_summary" name="content_summary" class="span8" placeholder="Content Summary"></textarea></div>
						</div>
						<div class="control-group">
							<label class="control-label" for="input_web_content">Full Content</label>
							<div class="controls"><textarea id="full_content" name="full_content" placeholder="Web Content"></textarea></div>
						</div>
						<div class="control-group">
							<label class="control-label" for="input_display_header">Display Header</label>
							<div class="controls">
								<label class="radio"><input type="radio" id="display_header[]" name="display_header[]" value="Yes">Yes</label>
								<label class="radio"><input type="radio" id="display_header[]" name="display_header[]" value="No" checked="checked">No</label>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="input_display_header">Display Footer</label>
							<div class="controls">
								<label class="radio"><input type="radio" id="display_footer[]" name="display_footer[]" value="Yes">Yes</label>
								<label class="radio"><input type="radio" id="display_footer[]" name="display_footer[]" value="No" checked="checked">No</label>
							</div>
						</div>
						<!--
						<div class="control-group">
							<label class="control-label" for="input_display_header">Display Blog</label>
							<div class="controls">
								<label class="radio"><input type="radio" id="display_blog[]" name="display_blog[]" value="Yes">Yes</label>
								<label class="radio"><input type="radio" id="display_blog[]" name="display_blog[]" value="No" checked="checked">No</label>
							</div>
						</div>
						-->
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
						web_content_id: ''
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