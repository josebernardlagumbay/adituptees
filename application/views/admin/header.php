<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Ad It Up Tees - Your leading t-shirt</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="">
		<meta name="author" content="">

		<script src="<?php echo base_url('js/jquery.js') ?>" type='text/javascript'></script>
		<link href="<?php echo base_url('css/admin.css') ?>" rel="stylesheet">
		<link href="<?php echo base_url('assets1/css/bootstrap.css') ?>" rel="stylesheet">
		<link href="<?php echo base_url('assets1/css/bootstrap-responsive.css') ?>" rel="stylesheet">
		<link href="<?php echo base_url('assets1/css/docs.css') ?>" rel="stylesheet">
		<link href="<?php echo base_url('assets1/js/google-code-prettify/prettify.css') ?>" rel="stylesheet">

		<!-- Le HTML5 shim, for IE6-8 support of HTML5 elements -->
		<!--[if lt IE 9]>
		  <script src="assets1/js/html5shiv.js"></script>
		<![endif]-->

		<!-- Le fav and touch icons -->
		<link rel="apple-touch-icon-precomposed" sizes="144x144" href="<?php echo base_url('assets1/ico/apple-touch-icon-144-precomposed.png') ?>">
		<link rel="apple-touch-icon-precomposed" sizes="114x114" href="<?php echo base_url('assets1/ico/apple-touch-icon-114-precomposed.png') ?>">
		<link rel="apple-touch-icon-precomposed" sizes="72x72" href="<?php echo base_url('assets1/ico/apple-touch-icon-72-precomposed.png') ?>">
		<link rel="apple-touch-icon-precomposed" href="<?php echo base_url('assets1/ico/apple-touch-icon-57-precomposed.png') ?>">
		<link rel="shortcut icon" href="<?php echo base_url('assets1/ico/favicon.png') ?>">
		
		<!-- fonts -->
		<link href='http://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet' type='text/css'>
		<link href='http://fonts.googleapis.com/css?family=Archivo+Narrow' rel='stylesheet' type='text/css'>
		
		<!-- message box -->
		<link rel="stylesheet" type="text/css" href="<?php echo base_url('css/box.css') ?>" />
		<script src="<?php echo base_url('js/jquery.easing.1.3.js') ?>"></script>
		<script src="<?php echo base_url('js/jquery.bouncebox.1.0.js') ?>"></script>
		<script src="<?php echo base_url('js/message.js') ?>"></script>
		<script src="<?php echo base_url('js/validate.js') ?>"></script>
		
		
	</head>

	<body data-spy="scroll" data-target=".bs-docs-sidebar">
	
		<div id="box" style="display: none">
			<div class="content_detail" id="message">
				<div id="message_header">&nbsp;</div> 
				<div id="message_detail">&nbsp;</div>
				<br />
				<button type="button" name="cmdClose" id="cmdClose" class="btn btn-info"> Close</button>
			</div>
		</div>
		
		<div id="myModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
				<h3 id="confirm_title">&nbsp;</h3>
			</div>
			<div class="modal-body">
				<p id="confirm_message">&nbsp;</p>
			</div>
			<div class="modal-footer">
				<button class="btn btn-danger" data-dismiss="modal" aria-hidden="true">No</button>
				<button class="btn btn-success" id="cmdDelete">Yes</button>
			</div>
		</div>
		
		<div id="header">
			<div class="container">
				<div class="row">
					<div class="span7">&nbsp;</div>
					<div class="span2">
						<div align="right">Welcome <?php echo $this->session->userdata('firstname') ?></div>
					</div>
					<div class="span2">
                        <div align="right"><a href="<?php echo site_url('admin/change-password') ?>">Change Password</a></div>
                    </div>
					<div class="span1">
						<div align="right"><a href="<?php echo site_url('admin/logout') ?>">Logout</a></div>
					</div>
				</div>
			</div>
		</div>
		
		<div class="container">
			<div class="row">
				<div class="span9">
					<div id="logo"><img src="<?php echo base_url('img/logo.png') ?>" alt="Fusion Element" title="Fusion Element"/></div>
				</div>
				<div class="span3">
					<div class="pull-right">
						<div class="padding_top15">
							<ul class="nav nav-pills">
								<li class="active"><a href="<?php echo site_url('home') ?>" target="_blank">View Website</a></li>
								<li class="dropdown">
									<a class="dropdown-toggle" data-toggle="dropdown" href="#">Settings <b class="caret"></b></a>
									<ul class="dropdown-menu">
										<li><a href="<?php echo site_url('settings/paypal-account') ?>">Paypal Account</a></li>
										<li><a href="<?php echo site_url('settings/email-address') ?>">Email Address</a></li>
										<li><a href="<?php echo site_url('settings/currency') ?>">Currency</a></li>
										<li><a href="<?php echo site_url('settings/office-address') ?>">Office Address</a></li>
									</ul>
								</li>
							</ul>
						</div>
					</div>
				</div>
			</div>
		</div>
		
		<!-- menu -->
		<div class="navbar">
			<div class="navbar-inner">
				<div class="container">
					<button type="button" class="btn btn-navbar" data-toggle="collapse" data-target=".nav-collapse">
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
						<span class="icon-bar"></span>
					</button>
					<div class="nav-collapse collapse">
						<ul class="nav">
							<li class="active"><a href="<?php echo site_url('admin/dashboard') ?>"><i class="icon-home"></i></a></li>
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">Orders <i class="icon-chevron-down"></i></a> 
								<ul class="dropdown-menu">
									<li><a href="<?php echo site_url('orders/view-orders') ?>">View Orders</a></li>
									<li><a href="<?php echo site_url('orders/search-orders') ?>">Search Orders</a></li>
									<li><a href="<?php echo site_url('orders/view-shipments') ?>">View Shipments</a></li>
									<li><a href="<?php echo site_url('orders/view-return-request') ?>">View Return Request</a></li>
									<li><a href="<?php echo site_url('orders/view-tracking-number') ?>">View Tracking Number</a></li>
							</ul>
							</li>
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">Product <i class="icon-chevron-down"></i></a>
								<ul class="dropdown-menu">
									<li><a href="<?php echo site_url('product/view-products') ?>">View Products</a></li>
									<li><a href="<?php echo site_url('category/view-categories') ?>">Product Categories</a></li>
									<li><a href="<?php echo site_url('brand/view-brands') ?>">Product Brands</a></li>
									<li><a href="<?php echo site_url('decoration/view-decoration-methods') ?>">Product Decoration Methods</a></li>
									<li><a href="<?php echo site_url('size/view-sizes') ?>">Product Sizes</a></li>
									<li><a href="<?php echo site_url('product_type/view-product-types') ?>">Product Type</a></li>
							</ul>
							</li>
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">Customers <i class="icon-chevron-down"></i></a>
								<ul class="dropdown-menu">
									<li><a href="<?php echo site_url('customer/view-customers') ?>">View Customers</a></li>
									<li><a href="<?php echo site_url('customer/search-customer') ?>">Search Customer</a></li>
							</ul>
							</li>
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">Web Content <i class="icon-chevron-down"></i></a>
								<ul class="dropdown-menu">
									<li><a href="<?php echo site_url('web_content/view-web-content') ?>">View Web Pages</a></li>
									<li><a href="<?php echo site_url('web_content/create-web-content') ?>">Create a Web Page</a></li>
									<li><a href="<?php echo site_url('image_manager/view-image-manager') ?>">Image Manager</a></li>
									<li><a href="<?php echo site_url('web_content/logo-manager') ?>">Logo Manager</a></li>
									<li><a href="<?php echo site_url('banner_manager/view-banner-manager') ?>">Banner Manager</a></li>
							</ul>
							</li>
							<li class="dropdown">
								<a href="#" class="dropdown-toggle" data-toggle="dropdown">Social Media Accounts <i class="icon-chevron-down"></i></a>
								<ul class="dropdown-menu">
									<li><a href="<?php echo site_url('social_media_accounts/view-social-media-accounts') ?>">View Social Media Accounts</a></li>
									<li><a href="<?php echo site_url('social_media_accounts/add') ?>">Add Social Media Account</a></li>
							</ul>
							</li>
						</ul>
					</div>
						
				</div>
			</div>
		</div>	