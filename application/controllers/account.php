<?php

	if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	class Account extends CI_Controller
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
	            case 'is-email-exist':
					$this->is_email_exist();
					break;
					
				case 'authenticate':
					$this->authenticate();
					break;
					
				case 'dashboard':
					$this->dashboard();
					break;
					
				case 'logout':
					$this->logout();
					break;
					
				case 'add-wishlist':
					$this->add_wishlist();
					break;
					
				case 'wishlist':
					$this->wishlist();
					break;
					
				case 'login':
					$this->login();
					break;
					
			}
		}
		
		/**
			@name: is_email_exist()
			@uses: Check if account email address is exist
		*/
		public function is_email_exist()
		{
			// Load the model
			$this->load->model('Customer_model');
			
			// Check if email addres is exist
			$this->Customer_model->email_address = $this->input->post('emailaddress');
			$is_exist = $this->Customer_model->is_email_exist();
			if($is_exist){
				echo 'EXIST';
			} else {
				echo 'NOT EXIST';
			}
		}
		
		/**
			@name: authenticate()
			@uses: Authenticate if account email and password are correct
		*/
		public function authenticate()
		{
			// Check if customer account exist
			$customer = new Generalmodel();
			$conditions = array(
				'email_address' => $this->input->post('email'),
				'customer_password' => md5($this->input->post('password'))
			);
			$customer->tables = 'customer';
			$customer->conditions = $conditions;
			$customer->getrecordinformation();
			$customer_info = $customer->result;
			$is_exist = $customer->numrows;
			
			if($is_exist){
				$newdata = array(
					'id'  => $customer_info[0]['account_id'],
					'firstname'  => $customer_info[0]['first_name'],
					'email'     => $customer_info[0]['email_address'],
					'logged_in' => TRUE,
					'account_type' => CUSTOMER
				);
				$this->session->set_userdata($newdata);
				echo 'EXIST';
			} else {
				echo 'NOT EXIST';
			}
		}
		
		/**
			@name: dashboard()
			@uses: Display the dashboard for account
		*/
		public function dashboard()
		{
			if(!$this->session->userdata('id') && $this->session->userdata('logged_in') != TRUE && $this->session->userdata('account_type') != CUSTOMER)
				redirect(site_url('home'));
				
			// Load the model
			$this->load->model('Menu_model');
			$this->load->model('Product_model');
			$this->load->model('Category_model');
			$this->load->model('Settings_model');
			$this->load->model('Social_media_model');
			$this->load->model('Customer_model');
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
			
			// Get the customer order information
			$this->Customer_model->account_id = $this->session->userdata('id');
			$data['order'] = $this->Customer_model->get_customer_order();
				
			$this->load->view('header_cart', $data);
			$this->load->view('account/dashboard');
			$this->load->view('footer');
		}
		
		/**
			@name: logout()
			@uses: Logout for the account
		*/
		public function logout()
		{
			$newdata = array(
				'id'  => '',
				'firstname'  => '',
				'email'     => '',
				'logged_in' => FALSE,
				'account_type' => ''
			);
			$this->session->set_userdata($newdata);
			redirect(site_url('home'));
		}
		
		/**
			@name: add_wishlist()
			@uses: Add item to wishlist
		*/
		public function add_wishlist()
		{
			if(!$this->session->userdata('id') && $this->session->userdata('logged_in') != TRUE && $this->session->userdata('account_type') != CUSTOMER)
				echo 'LOGIN';
				
			$wishlist = new Generalmodel();
			
			// Check if item is on your wishlist
			$product = explode('-', $this->input->post('product'));
			$conditions = array(
				'account_id' => $this->session->userdata('id'),
				'product_id' => $product[1]
			);
			$wishlist->tables = 'customer_wishlist';
			$wishlist->conditions = $conditions;
			$wishlist->getrecordinformation();
			$is_exist = $wishlist->numrows;
			
			if($is_exist){
				echo 'EXIST';
			} else {
				// Save to wishlist
				$tabledata = array(
					'account_id' => $this->session->userdata('id'),
					'product_id' => $product[1]
				);
				$wishlist->tables = 'customer_wishlist';
				$wishlist->tabledata = $tabledata;
				$wishlist->save();
				$is_save = $wishlist->result;
				
				if($is_save){
					echo 'SAVE';
				} else {
					echo 'ERROR';
				}
			}
		}
		
		/**
			@name: wishlist()
			@uses: Display your wishlist
		*/
		public function wishlist()
		{
			if(!$this->session->userdata('id') && $this->session->userdata('logged_in') != TRUE && $this->session->userdata('account_type') != CUSTOMER)
				redirect(site_url('home'));
			
			// Load the model
			$this->load->model('Menu_model');
			$this->load->model('Product_model');
			$this->load->model('Category_model');
			$this->load->model('Settings_model');
			$this->load->model('Social_media_model');
			$this->load->model('Customer_model');
			
			// Get the menu
            $data['header_menu'] = $this->Menu_model->get_menu_header();
            $data['footer_menu'] = $this->Menu_model->get_menu_footer();
			
			// Get the social media
			$data['social_media'] = $this->Social_media_model->get_social_media();
			
			// Get the current currency used
			$data['currency'] = $this->Settings_model->get_currency();
			
			// Get the categories
			$data['category'] = $this->Category_model->get_categories();
			
			// Get the customer order information
			$this->Customer_model->account_id = $this->session->userdata('id');
			$wishlist = $data['wishlist'] = $this->Customer_model->get_customer_wishlist();
			$data['total_product'] = count($wishlist);
				
			$this->load->view('header_cart', $data);
			$this->load->view('account/wishlist');
			$this->load->view('footer');
		}
		
		/**
			@name: login()
			@uses: Login for account
		*/
		public function login()
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
			
			// Get the product type
			$data['type'] = $this->Product_model->get_product_type();
			
			// Get the product deal
			$data['deal'] = $this->Product_model->get_product_deal();
			
			// Get the categories
			$data['category'] = $this->Category_model->get_categories();
			
			// Get the on demand items
			$data['demand'] = $this->Product_model->get_product_demand();
            
			$this->load->view('header', $data);
			$this->load->view('left');
			$this->load->view('account/login');
			$this->load->view('footer');
		}
		
	}

?>