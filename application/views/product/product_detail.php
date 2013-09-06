<div class="row">
	<div class="span10">
		<div class="bar_header content_header color1">
			<div class="row">
				<div class="span5">&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $product_info[0]['product_name'] ?> Information</div>
				<div class="span5">
					<div align="right"><a href="<?php echo site_url('product/view-by-product-type/'.$product_info[0]['product_type_name'].'-'.$product_info[0]['product_type_id']) ?>" class="btn btn-warning btn-small">See similar of <?php echo $product_info[0]['product_name'] ?></a>&nbsp;&nbsp;&nbsp;&nbsp;</div>
				</div>
			</div>
		</div>
		<br />
		<div class="content_detail">
			<div class="row">
				<div class="span3">
					<div><img src="<?php echo base_url('uploads/products/'.$product_info[0]['product_id'].'/'.$product_info[0]['image_display']) ?>" alt="<?php echo $product_info[0]['product_keywords']  ?>" title="<?php echo $product_info[0]['product_name'] ?>"/></div>
					<br />
					<div align="center">
						<img src="<?php echo base_url('img/star.png') ?>" />
						<img src="<?php echo base_url('img/star.png') ?>" />
						<img src="<?php echo base_url('img/star.png') ?>" />
						<img src="<?php echo base_url('img/star.png') ?>" />
						<img src="<?php echo base_url('img/star.png') ?>" />
					</div>
					<hr />
					<div>
						<span class='st_sharethis_large' displayText='ShareThis'></span>
						<span class='st_facebook_large' displayText='Facebook'></span>
						<span class='st_twitter_large' displayText='Tweet'></span>
						<span class='st_linkedin_large' displayText='LinkedIn'></span>
						<span class='st_googleplus_large' displayText='Google +'></span>
						<span class='st_pinterest_large' displayText='Pinterest'></span>
						<span class='st_email_large' displayText='Email'></span>
					</div>
				</div>
				<div class="span4">
					<h3><?php echo $product_info[0]['product_name'] ?></h3>
					<br />
					<div><?php echo $product_info[0]['product_description'] ?></div>
					<hr />
					<div>Pricing Table</div>
					<table class="table table-striped table-hover">
						<tr>
							<th>Size</th>
							<th>Price</th>
						</tr>
						<?php
							if($product_size){
								foreach($product_size as $list){
						?>
									<tr>
										<td><?php echo $list['size_name'] ?></td>
										<td>
											<?php 
										  		$price = $list['add_on_amount'] + $product_info[0]['price'];
												echo $currency[0]['data'].' '.number_format($price,2,'.',',');
										  	?>
										</td>
									</tr>
						<?php
								}
							}
						?>
					</table>
					<br />
					<div><button type="button" class="btn btn-warning btn-small" id="cmdAddwishlist">Add to my wishlist</button></div>
					
					<script type="text/javascript">
						
						$('#cmdAddwishlist').click
						(
							function()
							{
								// Add to wishlist
								init_message();
								$.post
								(
									'<?php echo site_url("account/add-wishlist") ?>',
									{
										product: '<?php echo $this->uri->segment(3) ?>'
									},
									function(data)
									{
										if(data == 'LOGIN'){
											insert_header_message('Login to Account');
											insert_detail_message('Please login to your Ad It Up Tees Account.');
											display_message();
										} else if (data == 'EXIST'){
											insert_header_message('Item Exist');
											insert_detail_message('Item already exist in your wishlist.');
											display_message();
										} else if (data == 'SAVE'){
											insert_header_message('Item Added in Wishlist');
											insert_detail_message('Item successfully added in your wishlist.');
											display_message();
										} else if (data == 'ERROR'){
											insert_header_message('Error Added to Wishlist');
											insert_detail_message('There was an error in adding the item to your wishlist. Please try again.');
											display_message();
										}
									}
								);
								
								setTimeout('hide_message()', 3000);
								
							}
						);
						
					</script>
					
				</div>
				<div class="span3">
					<form name="frmOrder" id="frmOrder" method="POST" enctype="multipart/form-data" action="<?php echo site_url('order/add-to-cart/'.$this->uri->segment(3)); ?>">
						<div class="bar_header color1">
							<div align="center">Order Now</div>
						</div>
						<div align="center" class="bar_body">
							<table class="table table-striped table-hover table-condensed" style="margin: 0px">
								<tr>
									<th>Size</th>
									<th>Price</th>
									<th>Quantity</th>
								</tr>
								<?php
									$cnt = 0;
									if($product_size){
										foreach($product_size as $list){
								?>
											<tr>
												<td><?php echo $list['size_name'] ?></td>
												<td>
													<?php 
												  		$price = $list['add_on_amount'] + $product_info[0]['price'];
														echo $currency[0]['data'].' '.number_format($price,2,'.',',');
												  	?>
													<input type="hidden" name="price<?php echo $list['size_id'] ?>" id="price<?php echo $list['size_id'] ?>" value="<?php echo $price; ?>"/>
												</td>
												<td><input type="text" name="quantity<?php echo $list['size_id'] ?>" id="quantity<?php echo $list['size_id'] ?>" onchange="check_quantity('<?php echo $list['size_id'] ?>')" value="0" placeholder="Enter Quantity" class="span1"/></td>
											</tr>
								<?php
											$cnt++;
										}
									}
								?>
							</table>
							<input type="hidden" name="total_sizes" id="total_sizes" value="<?php echo $cnt; ?>"/>
						</div>
						<div class="bar_footer">
							<div align="center"><button type="button" class="btn btn-warning btn-small" id="cmdAddCart" name="cmdAddCart">Add to my cart</button></div>
						</div>
						<input type="hidden" name="has_quantity" id="has_quantity" value="0"/>
						<script type="text/javascript">
						
							function check_quantity(size_id)
							{
								if($('#quantity'+size_id).val() == 0){
									if($('#has_quantity').val() != 0){
										$('#has_quantity').val($('#has_quantity').val()-1);
									} else {
										$('#has_quantity').val(0);
									}
									
								} else {
									$('#has_quantity').val($('#has_quantity').val()+1);
								}
							}
							
							$('#cmdAddCart').click
							(
								function()
								{
									if($('#has_quantity').val() == 0){
										insert_header_message('No Quantity');
										insert_detail_message('Please enter quantity of your order.');
										display_message();
									} else {
										$('#frmOrder').submit();
									}
									
									setTimeout('hide_message()', 3000);
									
								}
							);
							
						</script>
						
					</form>
				</div>
			</div>
		</div>
	</div>
</div>

<hr />
<div class="row">
	<div class="span10">
		<div class="bar_header content_header color1">
			<div class="row">
				<div class="span5">&nbsp;&nbsp;&nbsp;&nbsp;Product that might interest you</div>
				<div class="span5">
					<div align="right"><a href="<?php echo site_url('product/view-by-category/'.$product_info[0]['category_name'].'-'.$product_info[0]['category_id']) ?>" class="btn btn-warning btn-small">See more items</a>&nbsp;&nbsp;&nbsp;&nbsp;</div>
				</div>
			</div>
		</div>
		<div class="content_detail">
			<div class="row">
				<br />
				<?php
				$cnt = 1;
				if($category_product){
					foreach($category_product as $list){
			?>
						<div class="span2">
							<div class="bar_header color1">
								<div align="center"><?php echo $list['product_name'] ?></div>
							</div>
							<div align="center" class="bar_body">
								<a href="<?php echo site_url('product/product-detail/'.$list['product_name'].'-'.$list['product_id']) ?>"><img src="<?php echo base_url('uploads/products/'.$list['product_id'].'/'.$list['image_thumbnail']) ?>" alt="<?php echo $list['product_keywords'] ?>" title="<?php echo $list['product_name'] ?>"/></a>
							</div>
							<div class="bar_footer">
								<div align="center"><a href="<?php echo site_url('product/product-detail/'.$list['product_name'].'-'.$list['product_id']) ?>" class="btn btn-warning btn-small">View Art Design</a></div>
							</div>
						</div>
			<?php
						
						if($cnt%5 == 0 && $total_product > $cnt){
						echo '</div><br/><div class="row">';
					} elseif($total_product == $cnt){
						echo '</div>';
					}
					
					$cnt++;
					}
				} else {
			?>
			
				<div class="span10">
					<br/>
					<div class="alert alert-success">
						<strong>Sorry! There are no items found. Please try again later.</strong>
					</div>
				</div>
			</div>
			
			<?php
				}
			?>
		</div>
	</div>
</div>
</div>