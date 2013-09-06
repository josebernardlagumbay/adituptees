<?php

	if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	class Product extends CI_Controller
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
	            case 'view-products':
					$this->view_products();
					break;
					
				case 'add':
					$this->add();
					break;
					
				case 'save':
					$this->save();
					break;
					
				case 'image-settings':
					$this->image_settings();
					break;
					
				case 'update-image-settings':
					$this->update_image_settings();
					break;
					
				case 'product-title-exist':
					$this->product_title_exist();
					break;
					
				case 'edit':
					$this->edit();
					break;
					
				case 'update':
					$this->update();
					break;
					
				case 'view':
					$this->product_information();
					break;
					
				case 'delete':
					$this->delete();
					
				case 'product-detail':
					$this->product_detail();
					break;
					
				case 'view-product-by-type':
					$this->view_product_by_type();
					break;
				
				case 'view-by-category':
					$this->view_product_by_category();
					break;
				
			}
		}
		
		/**
			@name: view_products()
			@uses: View all products
		*/
		public function view_products()
		{
			if(!$this->session->userdata('key') && $this->session->userdata('accounttype') != md5('Admin'))
				redirect(site_url('admin'));
				
			// Get the currency used
			$currency = new Generalmodel();
			$conditions = array(
				'settings_id' => 12
			);
			$currency->tables = 'settings';
			$currency->conditions = $conditions;
			$currency->getrecordinformation();
			$data['currency'] = $currency->result;
			
			// Get the products
			$products = new Generalmodel();
			$products->tables = 'products';
			$products->jointable = 'category';
			$products->joincondition = 'products.category_id = category.category_id';
			$products->datalist();
			$data['products'] = $products->result;
			
			$this->load->view('admin/header', $data);
			$this->load->view('product/view_products');
			$this->load->view('admin/footer');
		}
		
		/**
			@name: add()
			@uses: Add new product
		*/
		public function add()
		{
			if(!$this->session->userdata('key') && $this->session->userdata('accounttype') != md5('Admin'))
				redirect(site_url('admin'));
				
			// Get the product types
			$types = new Generalmodel();
			$types->tables = 'product_type';
			$types->orderby = 'product_type_name ASC';
			$types->datalist();
			$data['type'] = $types->result;
				
			// Get the product categories
			$category = new Generalmodel();
			$category->tables = 'category';
			$category->orderby = 'category_name ASC';
			$category->datalist();
			$data['category'] = $category->result;
			
			// Get the product Brand
			$brands = new Generalmodel();
			$brands->tables = 'brand';
			$brands->orderby = 'brand_name ASC';
			$brands->datalist();
			$data['brand'] = $brands->result;
			
			// Get the decoration method
			$decoration = new Generalmodel();
			$decoration->tables = 'decoration_method';
			$decoration->orderby = 'decoration_method_name ASC';
			$decoration->datalist();
			$data['decoration_method'] = $decoration->result;
			
			// Get the product sizes
			$sizes = new Generalmodel();
			$sizes->tables = 'size';
			$sizes->datalist();
			$data['size'] = $sizes->result;
			
			// Get the currency used
            $currency = new Generalmodel();
            $conditions = array(
                'settings_id' => 12
            );
            $currency->tables = 'settings';
            $currency->conditions = $conditions;
            $currency->getrecordinformation();
            $data['currency'] = $currency->result;
			
			$this->load->view('admin/header', $data);
			$this->load->view('product/add');
			$this->load->view('admin/footer');
		}
		
		/**
			@name: save()
			@uses: Save the product information
		*/
		public function save()
		{
			if(!$this->session->userdata('key') && $this->session->userdata('accounttype') != md5('Admin'))
				redirect(site_url('admin'));
				
			// Upload the product image
			$product_id = uniqid();
			mkdir('uploads/products/'.$product_id);
			
			$config['upload_path'] = 'uploads/products/'.$product_id;
			$config['allowed_types'] = 'gif|jpg|png|tif';
			$field_name = "product_image";
			$this->load->library('upload', $config);
			
			if($this->upload->do_upload($field_name)){
				
				$image_name = explode('.', $_FILES['product_image']['name']);
				$new_image = md5($image_name[0].'_new');
				
				$config['image_library'] = 'gd2';
				$config['source_image'] = 'uploads/products/'.$product_id.'/'. $_FILES['product_image']['name'];
				$new_image = md5($image_name[0].'_new');
				$config['new_image'] = 'uploads/products/'.$product_id.'/'.$new_image.'.'.$image_name[1];
				$config['width'] = 670;
				$config['height'] = 670;
				$config['create_thumb'] = FALSE;
				$this->load->library('image_lib');
				$this->image_lib->initialize($config);
				$this->image_lib->resize();
				
				// Get the product image settings
				$image_settings = new Generalmodel();
				$image_settings->tables = 'settings';
				$image_settings->limit = 3;
				$image_settings->offset = 8;
				$image_settings->datalist();
				$image_settings_info = $image_settings->result;
				
				// Resize image to thumbnail
				$config['image_library'] = 'gd2';
				$config['source_image'] = 'uploads/products/'.$product_id.'/'.$new_image.'.'.$image_name[1];
				$config['create_thumb'] = TRUE;
				$config['thumb_marker'] = md5('_thumbnail');
				$config['maintain_ratio'] = TRUE;
				$config['width'] = $image_settings_info[0]['data'];
				$config['height'] = $image_settings_info[0]['data'];
				$this->load->library('image_lib');
				$this->image_lib->initialize($config);
				$this->image_lib->resize();
				
				// Resize image to display
				$config['image_library'] = 'gd2';
				$config['source_image'] = 'uploads/products/'.$product_id.'/'.$new_image.'.'.$image_name[1];
				$config['create_thumb'] = TRUE;
				$config['thumb_marker'] = md5('_display');
				$config['maintain_ratio'] = TRUE;
				$config['width'] = $image_settings_info[1]['data'];
				$config['height'] = $image_settings_info[1]['data'];
				$this->load->library('image_lib');
				$this->image_lib->initialize($config);
				$this->image_lib->resize();
				
				// Resize image to zoom
				$config['image_library'] = 'gd2';
				$config['source_image'] = 'uploads/products/'.$product_id.'/'.$new_image.'.'.$image_name[1];
				$config['create_thumb'] = TRUE;
				$config['thumb_marker'] = md5('_zoom');
				$config['maintain_ratio'] = TRUE;
				$config['width'] = $image_settings_info[2]['data'];
				$config['height'] = $image_settings_info[2]['data'];
				$this->load->library('image_lib');
				$this->image_lib->initialize($config);
				$this->image_lib->resize();
				
				$deal = $this->input->post('deal');
				if($deal){
					foreach($deal as $list){
						$is_deal = $list;
					}
				}
				
				// Save the product to the database
				$product = new Generalmodel();
				$tabledata = array(
					'product_id' => $product_id,
					'product_type_id' => $this->input->post('product_type'),
					'category_id' => $this->input->post('category'),
					'brand_id' => $this->input->post('brand'),
					'decoration_method_id' => $this->input->post('decoration_method'),
					'product_name' => $this->input->post('product_name'),
					'product_url' => $this->input->post('product_url'),
					'product_description' => $this->input->post('product_description'),
					'product_keywords' => $this->input->post('product_keywords'),
					'price' => $this->input->post('price'),
					'is_deal' => $is_deal,
					'image_orig' => $_FILES['product_image']['name'],
					'image_new' => $new_image.'.'.$image_name[1],
					'image_thumbnail' => $new_image.md5('_thumbnail').'.'.$image_name[1],
					'image_display' => $new_image.md5('_display').'.'.$image_name[1],
					'image_zoom' => $new_image.md5('_zoom').'.'.$image_name[1]
				);
				$product->tables = 'products';
				$product->tabledata = $tabledata;
				$product->save();
				$is_save = $product->result;
				
				if($is_save){
					// Save the product Size
					$size = $this->input->post('size');
					if($size){
						unset($tabledata);
						foreach($size as $list){
							$tabledata = array(
								'product_size_id' => uniqid(),
								'product_id' => $product_id,
								'size_id' => $list
							);
							$product->tables = 'product_size';
							$product->tabledata = $tabledata;
							$product->save();
						}
					}
					
					redirect(site_url('message/products/save/success'));
				} else {
					redirect(site_url('message/products/save/error'));
				}
			} else {
				//redirect(site_url('message/products/save/upload_error'));
			}
		}
		
		/**
			@name: image_settings()
			@uses: Display the image settings for the product image
		*/
		public function image_settings()
		{
			if(!$this->session->userdata('key') && $this->session->userdata('accounttype') != md5('Admin'))
				redirect(site_url('admin'));
			
			$image_settings = new Generalmodel();
			$image_settings->tables = 'settings';
			$image_settings->limit = 3;
			$image_settings->offset = 8;
			$image_settings->datalist();
			$data['image_settings'] = $image_settings->result;
			
			$this->load->view('admin/header', $data);
			$this->load->view('product/image_settings');
			$this->load->view('admin/footer');
		}
		
		/**
			@name: update_image_settings()
			@uses: Update the product image settings
		*/
		public function update_image_settings()
		{
			if(!$this->session->userdata('key') && $this->session->userdata('accounttype') != md5('Admin'))
				echo 'LOGIN';
				
			$image_settings = new Generalmodel();
			
			// Update the thumbnail size
			$tabledata = array(
				'data' => $this->input->post('image_thumbnail')
			);
			$conditions = array(
				'settings_id' => 9
			);
			$image_settings->tables = 'settings';
			$image_settings->tabledata = $tabledata;
			$image_settings->conditions = $conditions;
			$image_settings->update();
			
			// Update the display size
			$tabledata = array(
				'data' => $this->input->post('image_display')
			);
			$conditions = array(
				'settings_id' => 10
			);
			$image_settings->tables = 'settings';
			$image_settings->tabledata = $tabledata;
			$image_settings->conditions = $conditions;
			$image_settings->update();
			
			// Update the display size
			$tabledata = array(
				'data' => $this->input->post('image_zoom')
			);
			$conditions = array(
				'settings_id' => 11
			);
			$image_settings->tables = 'settings';
			$image_settings->tabledata = $tabledata;
			$image_settings->conditions = $conditions;
			$image_settings->update();
			
			echo 'UPDATE';
		}
		
		/**
			@name: product_title_exist()
			@uses: Check if product title exist
		*/
		public function product_title_exist()
		{
			if(!$this->session->userdata('key') && $this->session->userdata('accounttype') != md5('Admin'))
				echo 'LOGIN';
				
			if($this->input->post('product_id')){
				$conditions = array(
					'product_name' => $this->input->post('product_name'),
					'product_id !=' => $this->input->post('product_id')
				);
			} else {
				$conditions = array(
					'product_name' => $this->input->post('product_name')
				);
			}
			
			$product = new Generalmodel();
			$product->tables = 'products';
			$product->conditions = $conditions;
			$product->getrecordinformation();
			$is_exist = $product->numrows;
			
			if($is_exist){
				echo 'EXIST';
			} else {
				echo 'NOT EXIST';
			}
		}
		
		/**
			@name: edit()
			@uses: Edit the product
		*/
		public function edit()
		{
			if(!$this->session->userdata('key') && $this->session->userdata('accounttype') != md5('Admin'))
				redirect(site_url('admin'));
				
			// Get the product types
			$types = new Generalmodel();
			$types->tables = 'product_type';
			$types->orderby = 'product_type_name ASC';
			$types->datalist();
			$data['type'] = $types->result;
				
			// Get the product categories
			$category = new Generalmodel();
			$category->tables = 'category';
			$category->orderby = 'category_name ASC';
			$category->datalist();
			$data['category'] = $category->result;
			
			// Get the product Brand
			$brands = new Generalmodel();
			$brands->tables = 'brand';
			$brands->orderby = 'brand_name ASC';
			$brands->datalist();
			$data['brand'] = $brands->result;
			
			// Get the decoration method
			$decoration = new Generalmodel();
			$decoration->tables = 'decoration_method';
			$decoration->orderby = 'decoration_method_name ASC';
			$decoration->datalist();
			$data['decoration_method'] = $decoration->result;
			
			// Get the product sizes
			$sizes = new Generalmodel();
			$sizes->tables = 'size';
			$sizes->datalist();
			$data['size'] = $sizes->result;
				
			// Get the currency used
            $currency = new Generalmodel();
            $conditions = array(
                'settings_id' => 12
            );
            $currency->tables = 'settings';
            $currency->conditions = $conditions;
            $currency->getrecordinformation();
            $data['currency'] = $currency->result;
			
			// Get the product information
			$products = new Generalmodel();
			unset($conditions);
			$conditions = array(
				'product_id' => $this->uri->segment(3)
			);
			$products->tables = 'products';
			$products->conditions = $conditions;
			$products->getrecordinformation();
			$data['product'] = $products->result;
			
			// Get the product sizes
			$size = new Generalmodel();
			unset($conditions);
			$conditions = array(
				'product_id' => $this->uri->segment(3)
			);
			$size->tables  ='product_size';
			$size->conditions = $conditions;
			$size->jointable = 'size';
			$size->joincondition = 'size.size_id = product_size.size_id';
			$size->datalist();
			$data['product_size'] = $size->result;
			
			$this->load->view('admin/header', $data);
			$this->load->view('product/edit');
			$this->load->view('admin/footer');
		}
		
		/**
			@name: update()
			@uses: Update the product information
		*/
		public function update()
		{
			if(!$this->session->userdata('key') && $this->session->userdata('accounttype') != md5('Admin'))
				redirect(site_url('admin'));
				
			$deal = $this->input->post('deal');
			if($deal){
				foreach($deal as $list){
					$is_deal = $list;
				}
			}
				
			// Save the product to the database
			$product = new Generalmodel();
			$tabledata = array(
				'product_type_id' => $this->input->post('product_type'),
				'category_id' => $this->input->post('category'),
				'brand_id' => $this->input->post('brand'),
				'decoration_method_id' => $this->input->post('decoration_method'),
				'product_name' => $this->input->post('product_name'),
				'product_url' => $this->input->post('product_url'),
				'product_description' => $this->input->post('product_description'),
				'product_keywords' => $this->input->post('product_keywords'),
				'price' => $this->input->post('price'),
				'is_deal' => $is_deal
			);
			$conditions = array(
				'product_id' => $this->input->post('product_id')
			);
			$product->tables = 'products';
			$product->tabledata = $tabledata;
			$product->conditions = $conditions;
			$product->update();
			$is_save = $product->result;
			
			if($is_save){
				// Update the product size
				$product->tables = 'product_size';
				$product->conditions = $conditions;
				$product->delete();
				
				// Save the product Size
				$size = $this->input->post('size');
				if($size){
					unset($tabledata);
					foreach($size as $list){
						$tabledata = array(
							'product_size_id' => uniqid(),
							'product_id' => $this->input->post('product_id'),
							'size_id' => $list
						);
						$product->tables = 'product_size';
						$product->tabledata = $tabledata;
						$product->save();
					}
				}
				
				redirect(site_url('message/products/update/success'));
			} else {
				redirect(site_url('message/products/update/error'));
			}
		}
		
		/**
			@name: product_information()
			@uses: View the product information in the Admin page
		*/
		public function product_information()
		{
			if(!$this->session->userdata('key') && $this->session->userdata('accounttype') != md5('Admin'))
				redirect(site_url('admin'));
				
			// Get the currency used
            $currency = new Generalmodel();
            $conditions = array(
                'settings_id' => 12
            );
            $currency->tables = 'settings';
            $currency->conditions = $conditions;
            $currency->getrecordinformation();
            $data['currency'] = $currency->result;
			
			// Get the product information
			$products = new Generalmodel();
			unset($conditions);
			$conditions = array(
				'product_id' => $this->uri->segment(3)
			);
			$products->tables = 'products';
			$products->conditions = $conditions;
			$products->jointable = 'category';
			$products->joincondition = 'category.category_id = products.category_id';
			$products->getrecordinformation();
			$data['product'] = $products->result;
			
			// Get the product sizes
			$size = new Generalmodel();
			unset($conditions);
			$conditions = array(
				'product_id' => $this->uri->segment(3)
			);
			$size->tables  ='product_size';
			$size->conditions = $conditions;
			$size->jointable = 'size';
			$size->joincondition = 'size.size_id = product_size.size_id';
			$size->datalist();
			$data['product_size'] = $size->result;
			
			$this->load->view('admin/header', $data);
			$this->load->view('product/product_information');
			$this->load->view('admin/footer');
		}
		
		/**
			@name: delete()	
			@uses: Delete the product
		*/
		public function delete()
		{
			if(!$this->session->userdata('key') && $this->session->userdata('accounttype') != md5('Admin'))
				echo 'LOGIN';
				
			$product = new Generalmodel();
			$conditions = array(
				'product_id' => $this->input->post('product_id')
			);
			$product->tables = 'products';
			$product->conditions = $conditions;
			
			// Get the product design information
			$product->getrecordinformation();
			$product_info = $product->result;
			
			// Delete the image from the server
			unlink('uploads/products/'.$product_info[0]['product_id'].'/'.$product_info[0]['image_orig']);
			unlink('uploads/products/'.$product_info[0]['product_id'].'/'.$product_info[0]['image_new']);
			unlink('uploads/products/'.$product_info[0]['product_id'].'/'.$product_info[0]['image_thumbnail']);
			unlink('uploads/products/'.$product_info[0]['product_id'].'/'.$product_info[0]['image_display']);
			unlink('uploads/products/'.$product_info[0]['product_id'].'/'.$product_info[0]['image_zoom']);
			rmdir('uploads/products/'.$product_info[0]['product_id']);
			
			$product->delete();
			$is_delete = $product->result;
			
			if($is_delete){
				echo 'SUCCESS';
			} else {
				echo 'ERROR';
			}
		}
		
		/**
			@name: product_detail()
			@uses: View the product detail
		*/
		public function product_detail()
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
			
			// Get the product information
			$product = explode('-', $this->uri->segment(3));
			$this->Product_model->product_id = $product[1];
			$product_info = $data['product_info'] = $this->Product_model->get_product_info();
			
			// Get the product sizes
			$data['product_size'] = $this->Product_model->get_product_sizes();
			
			// Get the related product according to category
			$this->Product_model->category_id = $product_info[0]['category_id'];
			$data['category_product'] = $this->Product_model->get_related_product_according_to_category();
			$data['total_product'] = 15;
			
			$this->load->view('header', $data);
			$this->load->view('left');
			$this->load->view('product/product_detail');
			$this->load->view('footer');
		}
		
		/**
			@name: view_product_by_type()
			@uses: Get tne products according to product type
		*/
		public function view_product_by_type()
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
			
			// Get the product according to product type
			$product_type = explode('-', $this->uri->segment(3));
			$this->Product_model->product_type_id = $product_type[1];
			$product_type_list = $data['product_type_list'] = $this->Product_model->get_product_according_to_product_type();
			$data['total_product'] = count($product_type_list);
			
			// Get the product type information
			$data['product_type_info'] = $this->Product_model->get_product_type_info();
			
			$this->load->view('header', $data);
			$this->load->view('left');
			$this->load->view('product/view_product_by_type');
			$this->load->view('footer');
		}
		
		/**
			@name: view_product_by_category()
			@uses: View product by category
		*/
		public function view_product_by_category()
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
			
			// Get the product according to product type
			$product_category = explode('-', $this->uri->segment(3));
			$this->Product_model->category_id = $product_category[1];
			$product_category_list = $data['product_category_list'] = $this->Product_model->get_related_product_according_to_category();
			$data['total_product'] = count($product_category_list);
			
			// Get the category information
			$this->Category_model->category_id = $product_category[1];
			$data['category_info'] = $this->Category_model->get_category_info();
			
			$this->load->view('header', $data);
			$this->load->view('left');
			$this->load->view('product/view_product_by_category');
			$this->load->view('footer');
		}
	}

?>