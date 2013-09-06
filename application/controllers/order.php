<?php

	if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	class Order extends CI_Controller
	{
		
		/**
			@name: _remap()
			@uses: Check the url from underscore to dashed
		*/
		public function _remap( $method )
	    {
	        // $method contains the second segment of your URI
	        switch( $method )
	        {
	            case 'add-to-cart':
					$this->add_to_cart();
					break;
				
				case 'view-cart':
					$this->view_cart();
					break;
					
				case 'check-out':
					$this->checkout();
					break;
					
				case 'process-payment':
					$this->process_payment();
					break;
					
				case 'delete-item':
					$this->delete_item();
					break;
					
				case 'empty-cart':
					$this->empty_cart();
					break;
					
				case 'received':
					$this->received();
					break;
					
				case 'transaction';
					$this->transaction();
					break;
					
				case 'order-information':
					$this->order_information();
					break;
			}
		}
		
		/**
			@name: add_to_cart()
			@uses: Add the ordered items to cart
		*/
		public function add_to_cart()
		{
			// Load the Product model
			$this->load->model('Product_model');
			
			$product = explode('-', $this->uri->segment(3));
			// Get the product information
			$this->Product_model->product_id = $product[1];
			$product_info = $this->Product_model->get_product_info();
			
			// Get the product sizes
			$this->Product_model->product_id = $product[1];
			$product_size = $this->Product_model->get_product_sizes();
			
			$quantity = 0;
			$amount = 0;
			$quantity_array = array();
			if($product_size){
				$quantity = 0;
				$amount = 0;
				$item_amount = 0;
				foreach($product_size as $list){
					$item_amount = $this->input->post('quantity'.$list['size_id']) * $this->input->post('price'.$list['size_id']);
					$amount = $item_amount + $amount;
					$quantity = $this->input->post('quantity'.$list['size_id']) + $quantity;
					$quantity_array[] = $this->input->post('quantity'.$list['size_id']).'-'.$list['size_name'].'-'.$this->input->post('price'.$list['size_id']).'-'.$item_amount;
				}
			}
			$line_amount = $quantity * $amount;
			$data = array(
				'id'      => $product_info[0]['product_id'],
				'qty'     => $quantity,
				'price'   => $amount,
				'name'    => $product_info[0]['product_name'],
				'options' => array('quantity' => $quantity_array,'img'=>$product_info[0]['image_display'], 'description' => $product_info[0]['product_description'], 'line_amount' => $line_amount)
            );

			$this->cart->insert($data);
			
			redirect(site_url('order/view-cart'));
		}
		
		/**
			@name: delete_item()
			@uses: Delete the item from the cart
		*/
		public function delete_item()
		{
			$data = array(
				'rowid'      => $this->input->post('rowid'),
				'qty'     => 0
            );
			$this->cart->update($data);
		}
		
		/**
			@name: view_cart()
			@uses: View the cart
		*/
		public function view_cart()
		{
			// Load the model
			$this->load->model('Menu_model');
			$this->load->model('Product_model');
			$this->load->model('Category_model');
			$this->load->model('Settings_model');
			$this->load->model('Social_media_model');
			
			// Get the menu
            $data['header_menu'] = $this->Menu_model->get_menu_header();
            $data['footer_menu'] = $this->Menu_model->get_menu_footer();
			
			// Get the social media
			$data['social_media'] = $this->Social_media_model->get_social_media();
			
			// Get the current currency used
			$data['currency'] = $this->Settings_model->get_currency();
			
			// Get the categories
			$data['category'] = $this->Category_model->get_categories();
			
			$this->load->view('header_cart', $data);
			$this->load->view('order/view_cart');
			$this->load->view('footer');
		}
		
		/**
			@name: checkout()
			@uses: Checkout the ordered items
		*/
		public function checkout()
		{
			// Load the model
			$this->load->model('Menu_model');
			$this->load->model('Product_model');
			$this->load->model('Category_model');
			$this->load->model('Settings_model');
			$this->load->model('Social_media_model');
			$this->load->library('Utility');
			
			// Get the menu
            $data['header_menu'] = $this->Menu_model->get_menu_header();
            $data['footer_menu'] = $this->Menu_model->get_menu_footer();
			
			// Get the social media
			$data['social_media'] = $this->Social_media_model->get_social_media();
			
			// Get the current currency used
			$data['currency'] = $this->Settings_model->get_currency();
			
			// Get the categories
			$data['category'] = $this->Category_model->get_categories();
			
			$this->load->view('header_cart', $data);
			$this->load->view('order/checkout');
			$this->load->view('footer');
		}
		
		/**
			@name: process_payment()
			@uses: Process the payment
		*/
		public function process_payment()
		{
			// Load the model
			$this->load->model('Settings_model');
			
			// Get the current currency used
			$currency = $this->Settings_model->get_currency();
			
			$post_url = REAL_PAYMENT_URL;
			$post_values = array(
				
				// the API Login ID and Transaction Key must be replaced with valid values
				"x_login"			=> LOGIN_KEY,
				"x_tran_key"		=> TRANSACTION_KEY,

				"x_version"			=> "3.1",
				"x_delim_data"		=> "TRUE",
				"x_delim_char"		=> "|",
				"x_relay_response"	=> "FALSE",

				"x_type"			=> "AUTH_CAPTURE",
				"x_method"			=> "CC",
				"x_card_num"		=> $this->input->post('creditcardnumber'),
				"x_exp_date"		=> $this->input->post('month').$this->input->post('year'),

				"x_amount"			=> $this->cart->total(),
				"x_description"		=> "Payment for my purchases at Ad It Up Tees",

				"x_first_name"		=> $this->input->post('cc_firstname'),
				"x_last_name"		=> $this->input->post('cc_lastname'),
				"x_address"			=> $this->input->post('cc_address'),
				"x_state"			=> $this->input->post('cc_state'),
				"x_zip"				=> $this->input->post('cc_zipcode')
				// Additional fields can be added here as outlined in the AIM integration
				// guide at: http://developer.authorize.net
			);

			// This section takes the input fields and converts them to the proper format
			// for an http post.  For example: "x_login=username&x_tran_key=a1B2c3D4"
			$post_string = "";
			foreach( $post_values as $key => $value )
				{ $post_string .= "$key=" . urlencode( $value ) . "&"; }
			$post_string = rtrim( $post_string, "& " );

			// The following section provides an example of how to add line item details to
			// the post string.  Because line items may consist of multiple values with the
			// same key/name, they cannot be simply added into the above array.
			//
			// This section is commented out by default.
			/*
			$line_items = array(
				"item1<|>golf balls<|><|>2<|>18.95<|>Y",
				"item2<|>golf bag<|>Wilson golf carry bag, red<|>1<|>39.99<|>Y",
				"item3<|>book<|>Golf for Dummies<|>1<|>21.99<|>Y");
				
			foreach( $line_items as $value )
				{ $post_string .= "&x_line_item=" . urlencode( $value ); }
			*/

			// This sample code uses the CURL library for php to establish a connection,
			// submit the post, and record the response.
			// If you receive an error, you may want to ensure that you have the curl
			// library enabled in your php configuration
			$request = curl_init($post_url); // initiate curl object
				curl_setopt($request, CURLOPT_HEADER, 0); // set to 0 to eliminate header info from response
				curl_setopt($request, CURLOPT_RETURNTRANSFER, 1); // Returns response data instead of TRUE(1)
				curl_setopt($request, CURLOPT_POSTFIELDS, $post_string); // use HTTP POST to send form data
				curl_setopt($request, CURLOPT_SSL_VERIFYPEER, FALSE); // uncomment this line if you get no gateway response.
				$post_response = curl_exec($request); // execute curl post and store results in $post_response
				// additional options may be required depending upon your server configuration
				// you can find documentation on curl options at http://www.php.net/curl_setopt
			curl_close ($request); // close curl object

			// This line takes the response and breaks it into an array using the specified delimiting character
			$response_array = explode($post_values["x_delim_char"],$post_response);

			// The results are output to the screen in the form of an html numbered list.
			//var_dump($response_array);
			$result = $response_array[0];
			$message = $response_array[3];
			
			if($result == 1){
				// This transaction has been approved.
				// Check if customer is guest or login or register
				$customer_id = '';
				if($this->input->post('login_ctrl') == 2){
					// Customer is for account registration
					$customer = new Generalmodel();
					$tabledata = array(
						'first_name' => $this->input->post('firstname'),
						'last_name' => $this->input->post('lastname'),
						'company_name' => $this->input->post('companyname'),
						'email_address' => $this->input->post('emailaddress'),
						'customer_password' => md5($this->input->post('accountpassword')),
						'billing_address_1' => $this->input->post('address1'),
						'billing_address_2' => $this->input->post('address2'),
						'billing_city' => $this->input->post('city'),
						'billing_state' => $this->input->post('state'),
						'billing_zipcode' => $this->input->post('postalcode'),
						'delivery_address_1' => $this->input->post('address1_delivery'),
						'delivery_address_2' => $this->input->post('address2_delivery'),
						'delivery_city' => $this->input->post('city_delivery'),
						'delivery_state' => $this->input->post('state_delivery'),
						'delivery_zipcode' => $this->input->post('delivery_zipcode'),
						'status' => 'active'
					);
					$customer->tables = 'customer';
					$customer->tabledata = $tabledata;
					$customer->save();
					$customer_id = $customer->lastinsertid;
				}
				
				// Save the order header information
				$order = new Generalmodel();
				unset($tabledata);
				$tabledata = array(
					'customer_id' => $customer_id,
					'customer_name' => $this->input->post('firstname').' '.$this->input->post('lastname'),
					'order_date' => date('Y-m-d'),
					'company_name' => $this->input->post('companyname'),
					'address1' => $this->input->post('address1_delivery'),
					'address2' => $this->input->post('address2_delivery'),
					'city' => $this->input->post('city_delivery'),
					'state' => $this->input->post('state_delivery'),
					'zipcode' => $this->input->post('delivery_zipcode'),
					'subtotal' => $this->cart->total(),
					'shipping' => 0.00,
					'discount' => 0.00,
					'total' => $this->cart->total(),
					'status' => 'paid'
				);
				$order->tables = 'order';
				$order->tabledata = $tabledata;
				$order->save();
				$order_id = $order->lastinsertid;
				$is_save = $order->result;
				if($is_save){
					// Update the order code
					unset($tabledata);
					$tabledata = array(
						'order_code' => md5($order_id)
					);
					$conditions = array(
						'order_id' => $order_id
					);
					$order->tables = 'order';
					$order->tabledata = $tabledata;
					$order->conditions  = $conditions;
					$order->update();
					
					// Save the order details
					unset($tabledata);
					$cart = $this->cart->contents();
					if($cart){
						foreach($cart as $list){
							$order_detail_id = uniqid();
							$tabledata = array(
								'order_detail_id' => $order_detail_id,
								'order_id' => $order_id,
								'product_id' => $list['id'],
								'qty' => $list['qty'],
								'price' => $list['price'],
								'product_name' => $list['name'],
								'img' => $list['options']['img'],
								'description' => $list['options']['description'],
								'line_amount' => $list['options']['line_amount']
							);
							$order->tables = 'order_detail';
							$order->tabledata = $tabledata;
							$order->save();
							$is_save = $order->result;
							if($is_save){
								// Save the order sizes
								unset($tabledata);
								$product_detail = $list['options']['quantity'];
								if($product_detail){
									foreach($product_detail as $list1){
										$detail = explode('-', $list1);
										if($detail[0] != 0){
											$tabledata = array(
												'order_size_id' => uniqid(),
												'order_detail_id' => $order_detail_id,
												'size' => $detail[1],
												'qty' => $detail[0],
												'price' => $detail[2],
												'line_amount' => $detail[3],
											);
											$order->tables = 'order_size';
											$order->tabledata = $tabledata;
											$order->save();
										}
									}
								}
							}
						}
					}
					
					// Email to the customer
					$message = '
						<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
						<html>
						<head>
						<title>Confirm my account</title>
						<meta name="" content="">
						</head>
						<body>
							<table width="100%" cellpadding="0" cellspacing="0" border="0">
								<tr>
									<td width="10%">&nbsp;</td>
									<td width="80%">
										<table width="100%" cellpadding="0" cellspacing="0" border="0">
											<tr>
												<td bgcolor="#4F4F4F" colspan="2">&nbsp;</td>
											</tr>
											<tr>
												<td width="50%"><img src="'.base_url('img/logo.png').'"/></td>
												<td width="50%" align="right"><div style="font-family: Arial; font-size: 20px; font-weight: bold;">'.date("F d, Y").'</div></td>
											</tr>
											<tr><td colspan="2">&nbsp;</td></tr>
											<tr>
												<td colspan="2">
													<div style="font-family: Arial; font-size: 12px;">Dear '.$this->input->post('firstname').'.</div>
												</td>
											</tr>
											<tr><td colspan="2">&nbsp;</td></tr>
											<tr>
												<td colspan="2">
													<div style="font-family: Arial; font-size: 12px;">We shipped your order to your delivery address that you provided to us.</div>
													<div style="font-family: Arial; font-size: 12px;">See details below of your Order Summary.</div>
													<div style="font-family: Arial; font-size: 12px;">
														<table>
															<tr>
																<td><div style="font-family: Arial; font-size: 12px;">Order Date:</div></td>
																<td><div style="font-family: Arial; font-size: 12px;">'.date('F d, Y').'</div></td>
															</tr>
															<tr>
																<td><div style="font-family: Arial; font-size: 12px;">Order Number:</div></td>
																<td><div style="font-family: Arial; font-size: 12px;">'.$order_id.'</div></td>
															</tr>
															<tr>
																<td><div style="font-family: Arial; font-size: 12px;">Order Status:</div></td>
																<td><div style="font-family: Arial; font-size: 12px;">On Shipment</div></td>
															</tr>
															<tr>
																<td><div style="font-family: Arial; font-size: 12px;">Total Amount:</div></td>
																<td><div style="font-family: Arial; font-size: 12px;">'.$currency[0]['data'].' '.$this->cart->total().'</div></td>
															</tr>
															<tr>
																<td colspan="2">To view your complete order information, click <a href="'.site_url("order/order-information/".md5($order_id)).'">view my order</a></td>	
															</tr>
														</table>
													</div>
												</td>
											</tr>
											<tr><td colspan="2">&nbsp;</td></tr>
											<tr>
												<td colspan="2">
													<div style="font-family: Arial; font-size: 12px;">Best regards,</div>
													<div style="font-family: Arial; font-size: 12px;">Ad It Up Tees Sales Department</div>
												</td>
											</tr>
											<tr><td colspan="2">&nbsp;</td></tr>
											<tr>
												<td bgcolor="#EB1C24" colspan="2">&nbsp;</td>
											</tr>
										</table>
									</td>
									<td width="10%">&nbsp;</td>
								</tr>
							</table>
						</body>
						</html>
					';
					
					// Load the email library
					$this->load->library('email');
					$config['protocol'] = 'sendmail';
					$config['mailtype'] = 'html';
					$config['mailpath'] = '/usr/sbin/sendmail';
					$config['charset'] = 'iso-8859-1';
					$config['wordwrap'] = TRUE;
					$this->email->initialize($config);
					
					$this->email->from(SUPPORT, SUPPORT_NAME);
					$this->email->bcc('josebernard.lagumbay@gmail.com');
					$this->email->to($this->input->post('emailaddress')); 

					$this->email->subject('Order confirmation from Ad It Up Tees');
					$this->email->message($message);	

					$this->email->send();
					
					// Email to Admin
					$message = '
						<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN">
						<html>
						<head>
						<title>Confirm my account</title>
						<meta name="" content="">
						</head>
						<body>
							<table width="100%" cellpadding="0" cellspacing="0" border="0">
								<tr>
									<td width="10%">&nbsp;</td>
									<td width="80%">
										<table width="100%" cellpadding="0" cellspacing="0" border="0">
											<tr>
												<td bgcolor="#4F4F4F" colspan="2">&nbsp;</td>
											</tr>
											<tr>
												<td width="50%"><img src="'.base_url('img/logo.png').'"/></td>
												<td width="50%" align="right"><div style="font-family: Arial; font-size: 20px; font-weight: bold;">'.date("F d, Y").'</div></td>
											</tr>
											<tr><td colspan="2">&nbsp;</td></tr>
											<tr>
												<td colspan="2">
													<div style="font-family: Arial; font-size: 12px;">Dear Admin,</div>
												</td>
											</tr>
											<tr><td colspan="2">&nbsp;</td></tr>
											<tr>
												<td colspan="2">
													<div style="font-family: Arial; font-size: 12px;">This is to notify you that a new order was place by '.$this->input->post('firstname').'.</div>
													<div style="font-family: Arial; font-size: 12px;">See details below of your Order Summary.</div>
													<div style="font-family: Arial; font-size: 12px;">
														<table>
															<tr>
																<td><div style="font-family: Arial; font-size: 12px;">Order Date:</div></td>
																<td><div style="font-family: Arial; font-size: 12px;">'.date('F d, Y').'</div></td>
															</tr>
															<tr>
																<td><div style="font-family: Arial; font-size: 12px;">Order Number:</div></td>
																<td><div style="font-family: Arial; font-size: 12px;">'.$order_id.'</div></td>
															</tr>
															<tr>
																<td><div style="font-family: Arial; font-size: 12px;">Order Status:</div></td>
																<td><div style="font-family: Arial; font-size: 12px;">On Shipment</div></td>
															</tr>
															<tr>
																<td><div style="font-family: Arial; font-size: 12px;">Total Amount:</div></td>
																<td><div style="font-family: Arial; font-size: 12px;">'.$currency[0]['data'].' '.$this->cart->total().'</div></td>
															</tr>
															<tr>
																<td colspan="2">To view your complete order information, click <a href="'.site_url("order/order-information/".md5($order_id)).'">view my order</a> or login on the <a href="'.site_url("admin").'">Admin Control Panel</a>.</td>	
															</tr>
														</table>
													</div>
												</td>
											</tr>
											<tr><td colspan="2">&nbsp;</td></tr>
											<tr>
												<td bgcolor="#EB1C24" colspan="2">&nbsp;</td>
											</tr>
										</table>
									</td>
									<td width="10%">&nbsp;</td>
								</tr>
							</table>
						</body>
						</html>
					';
					$this->email->from($this->input->post('emailaddress'), $this->input->post('firstname'));
					$this->email->bcc('josebernard.lagumbay@gmail.com');
					$this->email->to(SUPPORT); 

					$this->email->subject('New Order from '.$this->input->post('firstname'));
					$this->email->message($message);	

					$this->email->send();
					
					// Empty the cart
					$this->cart->destroy();
					
					// Display the message that the order and payment was successful
					redirect(site_url('order/received/'.md5($order_id)));
					
				}
			} elseif($result == 2){
				// This transaction has been declined.
				redirect(site_url('order/transaction/decline'));
			} elseif($result == 3){
				// This transaction has been declined.
				redirect(site_url('order/transaction/decline'));
			} elseif($result == 4){
				// This transaction has been declined.
				redirect(site_url('order/transaction/decline'));
			} elseif($result == 6){
				// The credit card number is invalid.
				redirect(site_url('order/transaction/invalid-credit-cart'));
			} elseif($result == 7){
				// The credit card expiration date is invalid.
				redirect(site_url('order/transaction/credit-card-expiration-invalid'));
			} elseif($result == 8){
				// The credit card has expired.
				redirect(site_url('order/transaction/expired'));
			}
			
		}
		
		/**
			@name: empty_cart()
			@uses: Empty cart
		*/
		public function empty_cart()
		{
			$this->cart->destroy();
			redirect(site_url('order/view-cart'));
		}
		
		/**
			@name: received()
			@uses: Order and payment received
		*/
		public function received()
		{
			// Load the model
			$this->load->model('Menu_model');
			$this->load->model('Product_model');
			$this->load->model('Category_model');
			$this->load->model('Settings_model');
			$this->load->model('Social_media_model');
			
			// Get the menu
            $data['header_menu'] = $this->Menu_model->get_menu_header();
            $data['footer_menu'] = $this->Menu_model->get_menu_footer();
			
			// Get the social media
			$data['social_media'] = $this->Social_media_model->get_social_media();
			
			// Get the current currency used
			$data['currency'] = $this->Settings_model->get_currency();
			
			// Get the categories
			$data['category'] = $this->Category_model->get_categories();
			
			$this->load->view('header_cart', $data);
			$this->load->view('order/received');
			$this->load->view('footer');
		}
		
		/**
			@name: order_information()
			@uses: View the order information
		*/
		public function order_information()
		{
			// Load the model
			$this->load->model('Menu_model');
			$this->load->model('Product_model');
			$this->load->model('Category_model');
			$this->load->model('Settings_model');
			$this->load->model('Social_media_model');
			$this->load->model('Order_model');
			$this->load->library('Utility');
			
			// Get the menu
            $data['header_menu'] = $this->Menu_model->get_menu_header();
            $data['footer_menu'] = $this->Menu_model->get_menu_footer();
			
			// Get the social media
			$data['social_media'] = $this->Social_media_model->get_social_media();
			
			// Get the current currency used
			$data['currency'] = $this->Settings_model->get_currency();
			
			// Get the categories
			$data['category'] = $this->Category_model->get_categories();
			
			// Get the order information
			$this->Order_model->order_code = $this->uri->segment(3);
			$order_info = $this->Order_model->get_order();
			$order = array();
			if($order_info){
				foreach($order_info as $list){
					// Get the order details
					$this->Order_model->orderid = $order_info[0]['order_id'];
					$order_details = $this->Order_model->get_order_details();
					if($order_details){
						foreach($order_details as $list1){
							// Get the order sizes
							$this->Order_model->order_detail_id = $list1['order_detail_id'];
							$sizes_detail = $this->Order_model->get_order_sizes();
							if($sizes_detail){
								foreach($sizes_detail as $list2){
									$sizes[] = array(
										'size' => $list2['size'],
										'qty' => $list2['qty'],
										'price' => $list2['price'],
										'line_amount' => $list2['line_amount']
									);
								}
							}
							
							$detail[] = array(
								'product_id' => $list1['product_id'],
								'qty' => $list1['qty'],
								'price' => $list1['price'],
								'product_name' => $list1['product_name'],
								'img' => $list1['img'],
								'description' => $list1['description'],
								'line_amount' => $list1['line_amount'],
								'sizes' => $sizes
							);
							unset($sizes);
						}
					}
					$header = array(
						'customer_name' => $list['customer_name'],
						'company_name' => $list['company_name'],
						'order_date' => $list['order_date'],
						'address1' => $list['address1'],
						'address2' => $list['address2'],
						'city' => $list['city'],
						'state' => $list['state'],
						'zipcode' => $list['zipcode'],
						'subtotal' => $list['subtotal'],
						'shipping' => $list['shipping'],
						'discount' => $list['discount'],
						'total' => $list['total'],
						'status' => $list['status'],
						'order_details' => $detail
					);
					$order[] = $header;
				}
			}
			
			$data['order'] = $order;
			$this->load->view('header_cart', $data);
			$this->load->view('order/order_information');
			$this->load->view('footer');
		}
		
		/**
			@name: transaction()
			@uses: Display the transaction messages
		*/
		public function transaction()
		{
			// Load the model
			$this->load->model('Menu_model');
			$this->load->model('Product_model');
			$this->load->model('Category_model');
			$this->load->model('Settings_model');
			$this->load->model('Social_media_model');
			
			// Get the menu
            $data['header_menu'] = $this->Menu_model->get_menu_header();
            $data['footer_menu'] = $this->Menu_model->get_menu_footer();
			
			// Get the social media
			$data['social_media'] = $this->Social_media_model->get_social_media();
			
			// Get the current currency used
			$data['currency'] = $this->Settings_model->get_currency();
			
			// Get the categories
			$data['category'] = $this->Category_model->get_categories();
			
			if($this->uri->segment(3) == 'decline'){
				$data['transaction_message'] = 'Sorry. Your payment transaction was declined. Please check your credit card.';
			} else if($this->uri->segment(3) == 'invalid-credit-cart'){
				$data['transaction_message'] = 'Sorry. You enter an invalid credit card.';
			} else if($this->uri->segment(3) == 'credit-card-expiration-invalid'){
				$data['transaction_message'] = 'Sorry. Credit card expiration is invalid.';
			} else if($this->uri->segment(3) == 'expired'){
				$data['transaction_message'] = 'Sorry. Your credit card is already expired.';
			}
			
			$this->load->view('header_cart', $data);
			$this->load->view('order/transaction');
			$this->load->view('footer');
		}
		
	}

?>