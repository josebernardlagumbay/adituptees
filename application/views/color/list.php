		<div class="bar_header color1">
			<div class="content_header">&nbsp;&nbsp;List Colors</div>
		</div>
		
		<div class="bar_body content_detail">
			<div style="margin-left: 5px; margin-right: 5px;">
				<br />
				<table class="table table-hover table-striped" width="70%" style="margin-bottom: 0px;">
					<tr>
						<th>Color</th>
						<th>&nbsp;</th>
					</tr>
					<?php
						if($color){
							foreach($color as $list){
					?>
								<tr>
									<td><?php echo $list['color_name']; ?></td>
									<td>
										<a class="btn btn-danger btn-small" href="<?php echo site_url('color/edit/'.$list['color_id']); ?>">Edit</a>
										<button class="btn btn-danger btn-small" onclick="delete_item('<?php echo $list['color_id']; ?>')">Delete</button>
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
		<h3 id="myModalLabel">Delete Color</h3>
	</div>
	<div class="modal-body">
		<p>Proceed in deleting the color information?</p>
	</div>
	<div class="modal-footer">
		<button class="btn btn-danger" data-dismiss="modal" aria-hidden="true">No</button>
		<button class="btn btn-success" id="cmdDelete">Yes</button>
	</div>
</div>

<script type="text/javascript">
	$('#cmdAdd').click
	(
		function()
		{
			add('<?php echo site_url("color/add"); ?>');
		}
	);
	
	function delete_item(key)
	{
		$('#key').val(key);
		$('#myModal').modal('show');
	}
	
	$('#cmdDelete').click
	(
		function()
		{
			$.post
			(
				'<?php echo site_url("color/delete"); ?>',
				{
					key: $('#key').val()
				},
				function()
				{
					list('<?php echo current_url(); ?>');
				}
			);
		}
	);
</script>