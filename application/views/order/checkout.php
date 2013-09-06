<div class="container">	<div class="row">		<div class="span12 well_body">			<h3 class="content_header">Checkout</h3>			<hr />			<div class="row">				<div class="span6">					<div class="content_detail"><a href="#" onclick="display_login()">Already registered? Click here to login</a></div>				</div>				<div class="span6">					<div class="content_detail" align="right"><a href="<?php echo site_url('order/view-cart') ?>">Update your cart? Click here to edit your card</a></div>				</div>			</div>			<hr />			<form enctype="multipart/form-data" class="content_detail" name="frmCheckout" id="frmCheckout" method="POST" action="<?php echo site_url('order/process-payment'); ?>">			<div class="row">				<div class="span4">					<h4 class="content_header"><span class="badge badge-warning">1</span> Billing Information</h4>						<label>Login as Guest (or) Register</label>						<label class="radio"><input type="radio" name="account[]" id="account1" value="Guest"/> Guest</label>						<label class="radio"><input type="radio" name="account[]" id="account2" value="Register" checked="checked"/> Register</label>						<input type="hidden" name="login_ctrl" id="login_ctrl" value="2"/>												<script type="text/javascript">														$('#account1').click							(								function()								{									$("#login_ctrl").val(1);								}							);														$('#account2').click							(								function()								{									$("#login_ctrl").val(2);								}							);													</script>												<br />						<label><span class="required">*</span>&nbsp;Firstname</label>						<input type="text" name="firstname" id="firstname" placeholder="Firstname"/>						<br />						<label><span class="required">*</span>&nbsp;Lastname</label>						<input type="text" name="lastname" id="lastname" placeholder="Lastname"/>						<br />						<label>Company Name</label>						<input type="text" name="companyname" id="companyname" placeholder="Company Name"/>						<br />						<label><span class="required">*</span>&nbsp;Email Address</label>						<input type="text" name="emailaddress" id="emailaddress" placeholder="Email Address"/>						<br />						<label><span class="required">*</span>&nbsp;Address</label>						<input type="text" name="address1" id="address1" placeholder="Address 1"/>						<input type="text" name="address2" id="address2" placeholder="Address 2"/>						<br />						<label><span class="required">*</span>&nbsp;City</label>						<input type="text" name="city" id="city" placeholder="City"/>						<br />						<label><span class="required">*</span>&nbsp;State</label>						<input type="text" name="state" id="state" placeholder="State"/>						<br />						<label><span class="required">*</span>&nbsp;Zip/Postal Code</label>						<input type="text" name="postalcode" id="postalcode" placeholder="Zip/Postal Code"/>						<br />						<label><span class="required">*</span>&nbsp;Password</label>						<input type="password" name="accountpassword" id="accountpassword" placeholder="Password"/>					<br/>					<h4 class="content_header"><span class="badge badge-warning">2</span> Delivery Information</h4>					<label>Same with my Billing Information</label>					<label class="checkbox"><input type="checkbox" name="same_billing" id="same_billing" value="same"/> Same with my Billing Information</label>					<input type="hidden" name="same_billing_ctrl" id="same_billing_ctrl" value="1"/>					<script type="text/javascript">												$('#same_billing').click						(							function()							{								if($('#same_billing_ctrl').val() == 1){									$('#address1_delivery').val($("#address1").val());									$('#address2_delivery').val($("#address2").val());									$('#city_delivery').val($("#city").val());									$('#state_delivery').val($("#state").val());									$('#delivery_zipcode').val($("#postalcode").val());									$('#same_billing_ctrl').val(0);								} else {									$('#address1_delivery').val('');									$('#address2_delivery').val('');									$('#city_delivery').val('');									$('#state_delivery').val('');									$('#delivery_zipcode').val('');									$('#same_billing_ctrl').val(1);								}							}						);											</script>										<br />					<label><span class="required">*</span>&nbsp;Address</label>					<input type="text" name="address1_delivery" id="address1_delivery" placeholder="Address 1"/>					<input type="text" name="address2_delivery" id="address2_delivery" placeholder="Address 2"/>					<br />					<label><span class="required">*</span>&nbsp;City</label>					<input type="text" name="city_delivery" id="city_delivery" placeholder="City"/>					<br />					<label><span class="required">*</span>&nbsp;State</label>					<input type="text" name="state_delivery" id="state_delivery" placeholder="State"/>					<br />					<label><span class="required">*</span>&nbsp;Zip/Postal Code</label>					<input type="text" name="delivery_zipcode" id="delivery_zipcode" placeholder="Zip/Postal Code"/>				</div>				<div class="span4">					<h4 class="content_header"><span class="badge badge-warning">3</span> Payment Methods</h4>					<label><span class="required">*</span>&nbsp;Credit Card Number</label>					<input type="text" name="creditcardnumber" id="creditcardnumber" placeholder="Credit Card Number"/>					<br />					<label><span class="required">*</span>&nbsp;Expiration Date</label>					<select name="month" id="month" class="span1">						<option value=""> - select month -</option>						<?php							$month = $this->utility->month();							foreach($month as $list){						?>								<option value="<?php echo $list['id']; ?>"><?php echo $list['name']; ?></option>						<?php							}						?>					</select>					<select name="year" id="year" class="span1">						<option value=""> - select year -</option>						<?php							$year = $this->utility->year();							foreach($year as $list){						?>								<option value="<?php echo $list['id']; ?>"><?php echo $list['name']; ?></option>						<?php							}						?>					</select>					<br />					<label><span class="required">*</span>&nbsp;CV Number</label>					<input id="ccv_number" type="text" maxlength="3" value="" name="ccv_number" placeholder="CV Number">					<br />					<div class="content_header">Please provide your Credit Card Billing address</div>					<br />					<label>Company Name</label>					<input type="text" name="cc_companyname" id="cc_companyname" value="" placeholder="Company Name"/>					<br />					<label>Firstname</label>					<input type="text" name="cc_firstname" id="cc_firstname" placeholder="Firstname"/>					<br />					<label>Lastname</label>					<input type="text" name="cc_lastname" id="cc_lastname" placeholder="Lastname"/>					<br />					<label>Address</label>					<input type="text" name="cc_address" id="cc_address" placeholder="Address"/>					<br />					<label>State</label>					<input type="text" name="cc_state" id="cc_state" placeholder="State"/>					<br />					<label>Zip/Postal Code</label>					<input type="text" name="cc_zipcode" id="cc_zipcode" placeholder="Zip/Postal Code"/>				</div>				<div class="span4">					<h4 class="content_header"><span class="badge badge-warning">4</span> Order Review</h4>					<table class="table table-striped table-hover content_detail">						<tr>							<th>Products</th>							<th>Price</th>							<th>Quantity</th>							<th>Total</th>						</tr>						<?php							$cart = $this->cart->contents();							if($cart){								foreach($cart as $list){						?>									<tr>										<td><?php echo $list['name'] ?></td>										<td><?php echo $currency[0]['data'].' '.number_format($list['price'],2,'.',',') ?></td>										<td><?php echo $list['qty'] ?></td>										<td><?php echo $currency[0]['data'].' '.number_format($list['options']['line_amount'],2,'.',',') ?></td>									</tr>						<?php								}							} else {						?>								<tr>									<td colspan="4">										<div class="alert alert-info">											<strong>Sorry!</strong> Your cart is empty.										</div>									</td>								</tr>						<?php							}						?>					</table>					<table class="table table-striped content_detail" width="100%">						<tr>							<td width="80%"><div align="right">Sub Total Amount:</div></td>							<td width="20%"><div><?php echo $currency[0]['data'].' '.number_format($this->cart->total(),2,'.',','); ?></div></td>						</tr>						<tr>							<td><div align="right">Shipping Amount:</div></td>							<td><div><?php echo $currency[0]['data'].' 0.00' ?></div></td>						</tr>						<tr>							<td><div align="right">Discount Amount Amount:</div></td>							<td><div><?php echo $currency[0]['data'].' 0.00' ?></div></td>						</tr>						<tr>							<td><div align="right">Total Amount:</div></td>							<td><div><?php echo $currency[0]['data'].' '.number_format($this->cart->total(),2,'.',','); ?></div></td>						</tr>					</table>					<br />					<label class="checkbox">						<input type="checkbox" name="acceptterms" id="acceptterms" checked="checked"/> I accept the <a href="<?php echo site_url('post/read/terms-and-conditions') ?>">Terms and Conditions</a>						<input type="hidden" name="acceptterms_ctrl" id="acceptterms_ctrl" value="1"/>												<script type="text/javascript">														$('#acceptterms').click							(								function()								{									if($('#acceptterms_ctrl').val() == 1){										$('#acceptterms_ctrl').val(0);									} else {										$('#acceptterms_ctrl').val(1);									}								}							);													</script>											</label>					<br />					<button type="button" name="cmdPlaceOrder" id="cmdPlaceOrder" class="btn btn-warning btn-large">Place Order</button>				</div>			</div>			</form>						<script type="text/javascript">								$('#cmdPlaceOrder').click				(					function()					{						var error = 0;						init_message();												if($('#firstname').val() == ''){							insert_detail_message('Please enter your Firstname');							error = 1;						}												if($('#lastname').val() == ''){							insert_detail_message('Please enter your Lastname');							error = 1;						}												if($('#emailaddress').val() == ''){							insert_detail_message('Please enter your Email Address');							error = 1;						}												if($('#address1').val() == ''){							insert_detail_message('Please enter your Address 1');							error = 1;						}												if($('#city').val() == ''){							insert_detail_message('Please enter your City');							error = 1;						}												if($('#state').val() == ''){							insert_detail_message('Please enter your State');							error = 1;						}												if($('#postalcode').val() == ''){							insert_detail_message('Please enter your Zip/Postal Code');							error = 1;						}												if($('#login_ctrl').val() == 2){							if($('#accountpassword').val() == ''){								insert_detail_message('Please enter your Account Password');								error = 1;							}						}												if($('#address1_delivery').val() == ''){							insert_detail_message('Please enter your Delivery Address 1.');							error = 1;						}												if($('#city_delivery').val() == ''){							insert_detail_message('Please enter your Delivery City.');							error = 1;						}												if($('#state_delivery').val() == ''){							insert_detail_message('Please enter your Delivery State.');							error = 1;						}												if($('#delivery_zipcode').val() == ''){							insert_detail_message('Please enter your Delivery Zip/Postal Code.');							error = 1;						}												if($('#creditcardnumber').val() == ''){							insert_detail_message('Please enter your Credit Card Number.');							error = 1;						}												if($('#month').val() == ''){							insert_detail_message('Please select Month Expiration.');							error = 1;						}												if($('#year').val() == ''){							insert_detail_message('Please select Year Expiration.');							error = 1;						}												if($('#ccv_number').val() == ''){							insert_detail_message('Please enter CCV Number.');							error = 1;						}												if($('#acceptterms_ctrl').val() == 0){							insert_detail_message('Please accept the Terms and Conditions.');							error = 1;						}												var valid_email = IsEmail($('#emailaddress').val());						if(!valid_email){							insert_detail_message('Invalid Email Address.');							error = 1;						}												if(error == 1){							insert_header_message('Please check the following errors:');							display_message();						} else {							$('#frmCheckout').submit();						}												setTimeout('hide_message()', 5000);												}				);							</script>					</div>	</div></div>