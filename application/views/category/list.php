<!-- dashboard -->
		<div class="bar_header color1">
			<div class="content_header">&nbsp;&nbsp;List Category</div>
		</div>
		
		<div class="bar_body content_detail">
			<div style="margin-left: 5px; margin-right: 5px;">
				<br />
				<table class="table table-hover table-striped" width="70%" style="margin-bottom: 0px;">
					<tr>
						<th>Category</th>
						<th>&nbsp;</th>
					</tr>
					<?php
						if($category){
							foreach($category as $list){
					?>
								<tr>
									<td><?php echo $list['category_name']; ?></td>
									<td>
										<a class="btn btn-danger btn-small" href="<?php echo site_url('category/edit/'.$list['category_id']); ?>">Edit</a>
										<button class="btn btn-danger btn-small" onclick="delete_item('<?php echo $list['category_id']; ?>')">Delete</button>
									</td>
								</tr>
					<?php
							}
						}
					?>
				</table>
				<br />
			</div>
		</div>
	</div>
</div>

<input type="hidden" name="key" id="key" value=""/>

<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-header">
		<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
		<h3 id="myModalLabel" class="content_header"><span class="color_1">Delete</span> <span class="color_2">Category</span></h3>
	</div>
	<div class="modal-body content_detail">
		<p>Proceed in deleting the category?</p>
	</div>
	<div class="modal-footer">
		<button class="btn btn-danger" data-dismiss="modal" aria-hidden="true">No</button>
		<button class="btn btn-success" id="cmdDelete">Yes</button>
	</div>
</div>

<script type="text/javascript">

	function delete_item(category_id)
	{
		$('#key').val(category_id);
		$('#myModal').modal('show');
	}
	
	$('#cmdDelete').click
	(
		function()
		{
			$.post
			(
				'<?php echo site_url("category/delete"); ?>',
				{
					category_id: $('#key').val()
				},
				function()
				{
					window.location = '<?php echo current_url(); ?>';
				}
			);
		}
	);
	
	$('#cmdSave').click
	(
		function()
		{
			var error = 0;
			$('#message_header').html('');
			$('#message_details').html('');
			
			if($('#product_group').val() == ''){
				error = 1;
				$('#message_details').append('Please select Product Group.<br/>');
			}
			
			if($('#category').val() == ''){
				error = 1;
				$('#message_details').append('Please enter Category.<br/>');
			}
			
			if(error == 1){
				$('#message_header').html('Please check the following error(s):');
				$('#message').fadeIn('slow');
			} else {
				// Check if category exist
				$.post
				(
					'<?php echo site_url("category/is_exist"); ?>',
					{
						product_group: $('#product_group').val(),
						category: $('#category').val(),
						category_id: ''
					},
					function(data){
						if(data == 'EXIST'){
							$('#message_header').html('Category already exist.');
							$('#message').fadeIn('slow');
						} else {
							$('#frmCategory').submit();
						}
					}
				);
			}
		}
	);
	
</script>