<?php

	if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	class Shopping extends CI_Controller
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
	            case 'view-items':
					$this->view_items();
					break;
					
			}
		}
		
		/**
			@name: view_items()
			@uses: Display the items
		*/
		public function view_items()
		{
			// Load the model
			$this->load->model('Menu_model');
			$this->load->model('Product_model');
			$this->load->model('Category_model');
			$this->load->model('Settings_model');
			$this->load->model('Social_media_model');
			$this->load->model('Product_model');
			
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
			
			// Get all the items
			$products = $data['products'] = $this->Product_model->get_all_items();
			$data['total_product'] = count($products);
			
			// Get the product type information
			$data['product_type_info'] = $this->Product_model->get_product_type_info();
			
			$this->load->view('header', $data);
			$this->load->view('left');
			$this->load->view('product/view_items');
			$this->load->view('footer');
		}
		
	}

?>