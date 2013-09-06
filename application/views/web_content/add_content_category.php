<div class="container">
	<div class="row">
		<div class="span12">
			<div class="fontsize_18">Web Content</div>
		</div>
	</div>
	<div class="row padding_top15">
		<div class="span6">
			<ul class="nav nav-pills">
				<li class="active"><a href="<?php echo current_url() ?>">Add Web Content for <?php echo $category_info[0]['category_name'] ?></a></li>
			</ul>
		</div>
	</div>
</div>

<div class="background1">
	<div class="container padding_top15">
		<div class="row">
			<div class="span12">
				<div class="content_header">Web Content Only</div>
				<form name="frmWebcontent" id="frmWebcontent" method="POST" action="<?php echo site_url('web_content/save-content-category'); ?>" enctype="multipart/form-data">
				    <input type="hidden" name="category_id" id="category_id" value="<?php echo $this->uri->segment(3) ?>" />
    				<table class="table table-striped table-hover">
    					<tr>
    						<th>&nbsp;</th>
    						<th>Web Content Name</th>
    						<th>URL</th>
    					</tr>
    					<?php
    						if($web_content_only){
    							foreach($web_content_only as $list){
    					?>
    								<tr>
    									<td><input type="checkbox" name="add_content[]" id="add_content[]" value="<?php echo $list['web_content_id'] ?>" 
    									   <?php
    									       if($content_details){
    									           foreach($content_details as $list1){
    									               if($list1['web_content_detail_id'] == $list['web_content_id']){
    									                   echo 'checked="checked"';
    									               }
    									           }
    									       }
    									   ?>    
    									/></td>
    									<td><?php echo $list['web_content_name'] ?></td>
    									<td><?php echo $list['web_content_url'] ?></td>
    								</tr>
    					<?php
    							}
    						}
    					?>
    				</table>
    				<br />
    				<div>
    				    <button type="submit" class="btn btn-info" name="cmdSave" id="cmdSave">Save Content for <?php echo $category_info[0]['category_name'] ?></button>
    				</div>
				</form>
			</div>
		</div>
	</div>
</div>