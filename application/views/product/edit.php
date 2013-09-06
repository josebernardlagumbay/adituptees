<script src="<?php echo base_url('ckeditor/ckeditor.js'); ?>"></script>
<script src="<?php echo base_url('ckeditor/adapters/jquery.js'); ?>"></script>

<div class="container">
	<div class="row">
		<div class="span12">
			<div class="fontsize_18">Products</div>
		</div>
	</div>
	<div class="row padding_top15">
		<div class="span6">
			<ul class="nav nav-pills">
				<li class=""><a href="<?php echo site_url('product/view-products') ?>">View Products</a></li>
				<li class=""><a href="<?php echo site_url('product/add') ?>">Add Product</a></li>
				<li class=""><a href="<?php echo site_url('product/image-settings') ?>">Image Settings</a></li>
			</ul>
		</div>
	</div>
</div>

<div class="background1">
	<div class="container padding_top15">
		<div class="row">
			<div class="span12">
				<div class="content_header">Edit Product</div>
				<div class="padding_top15">
					<form class="form-horizontal" id="frmProduct" name="frmProduct" enctype="multipart/form-data" method="post" action="<?php echo site_url('product/update'); ?>">
						<input type="hidden" name="product_id" id="product_id" value="<?php echo $this->uri->segment(3) ?>"/>
						<div class="control-group">
							<label class="control-label" for="product_type"><span class="required">*</span>&nbsp;Product Type</label>
							<div class="controls">
								<select name="product_type" id="product_type">
									<option value="">- select product type -</option>
								<?php
									if($type){
										foreach($type as $list){
								?>
											<option value="<?php echo $list['product_type_id'] ?>" <?php if($product[0]['product_type_id'] == $list['product_type_id']){ echo 'selected="selected"'; } ?>><?php echo $list['product_type_name'] ?></option>
								<?php
										}
									}
								?>
								</select>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="category"><span class="required">*</span>&nbsp;Category</label>
							<div class="controls">
								<select name="category" id="category">
									<option value="">- select category -</option>
								<?php
									if($category){
										foreach($category as $list){
								?>
											<option value="<?php echo $list['category_id'] ?>" <?php if($product[0]['category_id'] == $list['category_id']){ echo 'selected="selected"'; } ?>><?php echo $list['category_name'] ?></option>
								<?php
										}
									}
								?>
								</select>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="brand">Brand</label>
							<div class="controls">
								<select name="brand" id="brand">
									<option value="">- select brand -</option>
								<?php
									if($brand){
										foreach($brand as $list){
								?>
											<option value="<?php echo $list['brand_id'] ?>" <?php if($product[0]['brand_id'] == $list['brand_id']){ echo 'selected="selected"'; } ?>><?php echo $list['brand_name'] ?></option>
								<?php
										}
									}
								?>
								</select>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="decoration_method">Decoration Method</label>
							<div class="controls">
								<select name="decoration_method" id="decoration_method">
									<option value="">- select decoration method -</option>
								<?php
									if($decoration_method){
										foreach($decoration_method as $list){
								?>
											<option value="<?php echo $list['decoration_method_id'] ?>" <?php if($product[0]['decoration_method_id'] == $list['decoration_method_id']){ echo 'selected="selected"'; } ?>><?php echo $list['decoration_method_name'] ?></option>
								<?php
										}
									}
								?>
								</select>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="product_name"><span class="required">*</span>&nbsp;Product Name</label>
							<div class="controls">
								<input type="text" name="product_name" id="product_name" value="<?php echo $product[0]['product_name'] ?>" placeholder="Product Name"/>
								<input type="hidden" name="product_url" id="product_url" value="<?php echo $product[0]['product_url'] ?>"/>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="product_description"><span class="required">*</span>&nbsp;Product Description</label>
							<div class="controls">
								<textarea name="product_description" id="product_description" placeholder="Product Description"><?php echo $product[0]['product_description'] ?></textarea>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="product_keywords">Product Keywords (comma separated)</label>
							<div class="controls">
								<textarea name="product_keywords" id="product_keywords" placeholder="Product Keywords"><?php echo $product[0]['product_keywords'] ?></textarea>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="price"><span class="required">*</span>&nbsp;Price <?php echo $currency[0]['data'] ?></label>
							<div class="controls">
								<input type="text" name="price" id="price" value="<?php echo $product[0]['price'] ?>" placeholder="Price"/>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="price">Select Size</label>
							<div class="controls">
								<?php
									if($size){
										foreach($size as $list){
								?>
											<label class="checkbox">
												<input type="checkbox" name="size[]" id="size[]" value="<?php echo $list['size_id'] ?>" 
												
													<?php
														if($product_size){
															foreach($product_size as $list1){
																if($list1['size_id'] == $list['size_id']){
																	echo 'checked="checked"';
																}
															}
														}
													?>
												
												> <?php echo $list['size_name'] ?>
											</label>
								<?php
										}
									}
								?>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="price">Product Deal</label>
							<div class="controls">
								<label class="radio">
									<input type="radio" name="deal[]" id="deal[]" value="yes" <?php if($product[0]['is_deal'] == 'yes'){ echo 'checked="checked"'; } ?>> Yes
								</label>
								<label class="radio">
									<input type="radio" name="deal[]" id="deal[]" value="no" <?php if($product[0]['is_deal'] == 'no'){ echo 'checked="checked"'; } ?>> No
								</label>
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

	CKEDITOR.replace( 'product_description');

	$('#product_name').keyup
	(
		function()
		{
			if($('#product_name').val() != ''){
				var url_equivalent = convertToSlug($('#product_name').val());
				$('#product_url').val(url_equivalent);
			}
		}
	);

	$('#cmdSave').click
	(
		function()
		{
			var error = 0;
			init_message();
			
			if($('#category').val() == ''){
				insert_detail_message('Please select the Category.');
				error = 1;
			}
			
			if($('#product_name').val() == ''){
				insert_detail_message('Please enter the Product Name.');
				error = 1;
			}
			
			if($('#price').val() == ''){
				insert_detail_message('Please enter the Price.');
				error = 1;
			}
			
			if(error == 1){
				insert_header_message('Please correct the following errors:');
				display_message();
			} else {
				// Check if product name exist
				$.post
				(
					'<?php echo site_url("product/product-title-exist") ?>',
					{
						product_name: $('#product_name').val(),
						product_id: '<?php echo $this->uri->segment(3) ?>'
					},
					function(data)
					{
						if(data == 'EXIST'){
							insert_header_message('Product Title Exist');
							insert_detail_message('Product Title already exist. Please try again.');
							display_message();
						} else if(data == 'NOT EXIST'){
							$('#frmProduct').submit();
						}
					}
				);
			}
			
			setTimeout('hide_message()', 3000);
			
		}
	);
	
</script>