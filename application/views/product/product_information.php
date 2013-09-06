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
			<div class="span8">
				<div class="content_header">View Product</div>
				<div class="padding_top15">
					<form class="form-horizontal" enctype="multipart/form-data">
						<div class="control-group">
							<label class="control-label" for="product_type">Product Type</label>
							<div class="controls"><input type="text" disabled="disabled" value="<?php echo $product[0]['category_name']; ?>" class="span6"/></div>
						</div>
						<div class="control-group">
							<label class="control-label" for="category">Category</label>
							<div class="controls"><input type="text" disabled="disabled" value="<?php echo $product[0]['category_name']; ?>" class="span6"/></div>
						</div>
						<div class="control-group">
							<label class="control-label" for="brand">Brand</label>
							<div class="controls"><input type="text" disabled="disabled" value="<?php echo $product[0]['category_name']; ?>" class="span6"/></div>
						</div>
						<div class="control-group">
							<label class="control-label" for="decoration_method">Decoration Method</label>
							<div class="controls"><input type="text" disabled="disabled" value="<?php echo $product[0]['category_name']; ?>" class="span6"/></div>
						</div>
						<div class="control-group">
							<label class="control-label" for="product_name">Product Name</label>
							<div class="controls"><input type="text" disabled="disabled" value="<?php echo $product[0]['product_name'] ?>" class="span6"/></div>
						</div>
						<div class="control-group">
							<label class="control-label" for="product_description">Product Description</label>
							<div class="controls">
								<textarea class="span6" disabled="disabled"><?php echo $product[0]['product_description'] ?></textarea>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="product_keywords">Product Keywords (comma separated)</label>
							<div class="controls"><input type="text" disabled="disabled" value="<?php echo $product[0]['product_keywords'] ?>" class="span6"/></div>
						</div>
						<div class="control-group">
							<label class="control-label" for="price">Price</label>
							<div class="controls"><input type="text" disabled="disabled" value="<?php echo $currency[0]['data'].' '.$product[0]['price'] ?>" class="span6"/></div>
						</div>
						<div class="control-group">
							<label class="control-label" for="price">Size</label>
							<div class="controls"><input type="text" disabled="disabled" value="
								<?php
									if($product_size){
										foreach($product_size as $list){
											echo $list['size_name'].', ';
										}
									}
								?>
							" class="span6"/></div>
						</div>
						<div class="control-group">
							<label class="control-label" for="is_deal">Is Deal</label>
							<div class="controls"><input type="text" disabled="disabled" value="<?php echo $product[0]['is_deal'] ?>" class="span6"/></div>
						</div>
					</form>
				</div>
			</div>
			<div class="span4">
				<img src="<?php echo base_url('uploads/products/'.$product[0]['product_id'].'/'.$product[0]['image_display']) ?>" alt="<?php echo $product[0]['product_keywords'] ?>" title="<?php echo $product[0]['product_name'] ?>"/>
			</div>
		</div>
	</div>
</div>