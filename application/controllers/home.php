<?php

	if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	class Home extends CI_Controller
	{
		
		public function index()
		{
			$this->display_home();
		}
		
		/**
			@name: display_home()
			@uses: Display the home page
		*/
		public function display_home()
		{
			// Load the model
			$this->load->model('Menu_model');
			$this->load->model('Product_model');
			$this->load->model('Category_model');
			$this->load->model('Settings_model');
			$this->load->model('Social_media_model');
			$this->load->model('Banner_model');
			
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
			
			// Get the banner
			$data['banner'] = $this->Banner_model->get_banner();
			
			// Get the new product design
			$data['new_design'] = $this->Product_model->get_product_new_design_home();
			
			// Get the featured stock designs
			$data['featured_design'] = $this->Product_model->get_product_featured_designs();
			
			// Get the info for product type
			$this->Product_model->product_type_id = '51c232cb26301';
			$data['type1'] = $this->Product_model->get_product_type_info();
			
			// Get the on sale items
			$data['on_sale_items'] = $this->Product_model->get_product_on_sale();
			
			// Get the info for product type
			$this->Product_model->product_type_id = '51c25d568077c';
			$data['type2'] = $this->Product_model->get_product_type_info();
			
			$data['total_product'] = 10;
			
			$this->load->view('header', $data);
			$this->load->view('left');
			$this->load->view('banner');
			$this->load->view('brands');
			$this->load->view('announcement');
			$this->load->view('home/home');
			$this->load->view('footer');
		}
		
	}

?>