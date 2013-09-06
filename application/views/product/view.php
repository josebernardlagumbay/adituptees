<!-- datepicker -->
<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/datepicker.css'); ?>"/>
<script src="<?php echo base_url('js/bootstrap-datepicker.js') ?>"></script>

<!-- product featured -->
<div id="product_featured" class="padding_top20">
	<div class="container">
		<div class="row">
			<div class="span12">
				<div class="content_header">View <span class="color1">Photo</span></div>
			</div>
		</div>
		<div class="row padding_top20">
			<div class="span2">
				<label class="control-label" for="Start Date">Choose a Date</label>
				<div class="controls"><input class="span2" type="text" name="choose_date" id="choose_date" data-date="<?php echo date('m-d-Y') ?>" data-date-format="mm-dd-yyyy" value="<?php echo date('m-d-Y') ?>"/></div>
			</div>
			<div class="span8">
				<ul class="nav nav-tabs" id="myTab" style="margin-bottom: 0px;">
					<li class="active"><a href="#personalize" data-toggle="tab">Personalize</a></li>
					<li><a href="#pending" data-toggle="tab">Popular Add-ons</a></li>
					<li><a href="#completed" data-toggle="tab">Review and Checkout</a></li>
				</ul>
				<div class="tab-content">
					<div class="tab-pane active" id="personalize">
						<div class="row padding_top20">
							<div class="span4"><img class="img-polaroid margin_left5" src="<?php echo base_url('uploads/products/'.$product[0]['product_id'].'/'.$product[0]['image_display']) ?>" alt="<?php echo $product[0]['product_keywords'] ?>" alt="<?php echo $product[0]['product_title'] ?>"/></div>
							<div class="span4">
								<div class="content_header">Packages</div>
								<div class="padding_top20">
									<?php
										if($package){
											foreach($package as $list){
									?>
												<div><label class="radio"><input type="radio" name="package[]" id="package[]" value="<?php echo $list['package_id'] ?>"> <?php echo $list['package_name'] ?></label></div>
									<?php
											}
										}
									?>
								</div>
							</div>
						</div>
					</div>
					<div class="tab-pane" id="popular_add_ons">
						test
					</div>
					<div class="tab-pane" id="review_checkout">
						There aren't any orders matching the specified criteria.
					</div>
				</div>
				
				<script type="text/javascript">
					$('#myTab a').click(function (e) {
						e.preventDefault();
						$(this).tab('show');
					})
				</script>
			</div>
			<div class="span2"></div>
		</div>
	</div>
</div>

<script type="text/javascript">
	
	$('#choose_date').datepicker({'autoclose':true});
	
</script>