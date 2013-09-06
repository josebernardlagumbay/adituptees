<!-- content 1 -->
<script src="<?php echo base_url('ckeditor/adapters/jquery.js'); ?>"></script>
<hr />
<div class="container">
	<div class="row">
		<div class="span8">
			<div class="img-polaroid">
				<div class="row">
					<div class="span6"><div class="header_title"><?php echo $content[0]['title']; ?></div></div>
				</div>
				<hr />
				<div class="row">
					<div class="span8" style="width: 96%;">
						<div class="content_details"><?php echo $content[0]['content']; ?></div>
					</div>
				</div>			
			</div>
		</div>