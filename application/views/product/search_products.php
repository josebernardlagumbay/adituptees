<div class="container">
	<div class="row">
		<div class="span12">
			<div class="fontsize_18">Products</div>
		</div>
	</div>
	<div class="row padding_top15">
		<div class="span6">
			<ul class="nav nav-pills">
				<li class="active"><a href="<?php echo current_url() ?>">Search Products</a></li>
			</ul>
		</div>
	</div>
</div>

<div class="background1">
	<div class="container padding_top15">
		<div class="row">
			<div class="span12">
				<div class="content_header">Search Products</div>
				<div class="padding_top15">
					<form class="form-horizontal" id="frmProduct" name="frmProduct" enctype="multipart/form-data" method="post" action="<?php echo site_url('food/search-products'); ?>">
						<div class="control-group">
							<label class="control-label" for="category">Category</label>
							<div class="controls">
								<select name="category" id="category">
									<option value="">- select category -</option>
								<?php
									if($category){
										foreach($category as $list){
								?>
											<option value="<?php echo $list['category_id'] ?>" <?php if($this->input->post('category') == $list['category_id']){ ?> selected="selected" <?php } ?>><?php echo $list['category_name'] ?></option>
								<?php
										}
									}
								?>
								</select>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="product_title">Meal Name</label>
							<div class="controls">
								<input type="text" name="product_title" id="product_title" value="<?php echo $this->input->post('product_title') ?>" placeholder="Product Title"/>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="product_description">Meal Description</label>
							<div class="controls">
								<textarea name="product_description" id="product_description" placeholder="Product Description"><?php echo $this->input->post('product_description') ?></textarea>
							</div>
						</div>
						<div class="control-group">
							<label class="control-label" for="product_keywords">Meal Keywords (comma separated)</label>
							<div class="controls">
								<textarea name="product_keywords" id="product_keywords" placeholder="Product Keywords"><?php echo $this->input->post('product_keywords') ?></textarea>
							</div>
						</div>
						<div class="control-group">
							<div class="controls"><button type="submit" class="btn btn-info" name="cmdSearch" id="cmdSearch">Search</button></div>
						</div>
						<input type="hidden" name="product_id" id="product_id" value="<?php echo $this->uri->segment(3) ?>"/>
					</form>
				</div>
			</div>
		</div>
		<div class="row">
			<div class="span12">
				<div class="content_header">Search Resuts</div>
					<div class="padding_top15">
						<div class="action_menu">
							<div class="row">
								<div class="span6">&nbsp;</div>
								<div class="span6">
									<div class="pagination pull-right" style="margin: 0px;"><ul><?php echo $this->pagination->create_links(); ?></ul></div>
								</div>
							</div>
						</div>
					</div>
					<table class="table table-striped table-hover">
						<tr>
							<th>Image</th>
							<th>Product Title</th>
							<th>Product Description</th>
							<th>Product Keywords</th>
							<th>Price</th>
							<th>Action</th>
						</tr>
						<?php
							if($products){
								foreach($products as $list){
						?>
									<tr>
										<td><img src="<?php echo base_url('uploads/products/'.$list['product_id'].'/'.$list['image_thumbnail']); ?>" alt="<?php echo $list['product_keywords'] ?>" title="<?php echo $list['product_title'] ?>"/></td>
										<td><?php echo $list['product_title'] ?></td>
										<td><?php echo $list['product_description'] ?></td>
										<td><?php echo $list['product_keywords'] ?></td>
										<td><?php echo $currency[0]['data'].' '.number_format($list['price'],2,'.',',') ?></td>
										<td>
											<div class="btn-group">
												<a class="btn btn-info dropdown-toggle" data-toggle="dropdown" href="#"> Action <span class="caret"></span></a>
												<ul class="dropdown-menu">
													<li><a href="<?php echo site_url('products/edit/'.$list['product_id']) ?>">Edit</a></li>
													<li><a href="#" onclick="delete_item('<?php echo $list['product_id'] ?>')">Delete</a></li>
												</ul>
											</div>
										</td>
									</tr>
						<?php
								}
							}
						?>
					</table>
					<div class="padding_top15">
						<div class="action_menu">
							<div class="row">
								<div class="span6">&nbsp;</div>
								<div class="span6">
									<div class="pagination pull-right" style="margin: 0px;"><ul><?php echo $this->pagination->create_links(); ?></ul></div>
								</div>
							</div>
						</div>
					</div>
			</div>
		</div>
	</div>
</div>