<!-- dashboard -->
<div class="container">
	<div class="row">
		<div class="span12">
			<div class="content_header"><span class="color_1"><?php echo $message_header ?></span></div>
			<br />
			<div class="content_detail">
				<div class="alert <?php echo $message_ctrl; ?> content_detail">
					<p id="message_details"><?php echo $message_detail; ?></p>
				</div>
			</div>
		</div>
	</div>
</div>
<br/>
<br/>
<br/>
<br/>
<br/>

<?php
	if($redirect){
?>
		<script type="text/javascript">
			setTimeout('account_dashboard()', 3000);
			
			function account_dashboard()
			{
				window.location = '<?php echo $redirect_url; ?>';
			}
		</script>
<?php
	}
?>