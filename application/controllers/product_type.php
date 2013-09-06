<?php

	if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	class Product_type extends CI_Controller
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
                case 'view-product-types':
                    $this->view_product_types();
                	break;
				
				case 'add':
					$this->add();
					break;
					
				case 'save':
					$this->save();
					break;
					
				case 'edit':
					$this->edit();
					break;
					
				case 'update':
					$this->update();
					break;
					
				case 'delete':
					$this->delete();
					break;
					
				case 'is-exist':
					$this->is_exist();
			}
		}
		
		/**
			@name: view_product_types()
			@uses: Display the product types
		*/
		public function view_product_types()
		{
			if(!$this->session->userdata('key') && $this->session->userdata('accounttype') != md5('Admin'))
				redirect(site_url('admin'));
				
			// Get the product types
			$types = new Generalmodel();
			$types->tables = 'product_type';
			$types->orderby = 'product_type_name ASC';
			$types->datalist();
			$data['type'] = $types->result;
			
			$this->load->view('admin/header', $data);
			$this->load->view('product_type/view_product_types');
			$this->load->view('admin/footer');
		}
		
		/**
			@name: add()
			@uses: Add product type
		*/
		public function add()
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
			
				
			$this->load->view('admin/header', $data);
			$this->load->view('product_type/add');
			$this->load->view('admin/footer');
		}
		
		/**
			@name: save()
			@uses: Save product type
		*/
		public function save()
		{
			if(!$this->session->userdata('key') && $this->session->userdata('accounttype') != md5('Admin'))
				echo 'LOGIN';
				
			$type = new Generalmodel();
			
			// Check if category exist
			$conditions = array(
				'product_type_name' => $this->input->post('product_type_name')
			);
			$type->tables = 'product_type';
			$type->conditions = $conditions;
			$type->getrecordinformation();
			$is_exist = $type->numrows;
			
			if($is_exist){
				echo 'EXIST';
			} else {
				// Save the product type
				$tabledata = array(
					'product_type_id' => uniqid(),
					'product_type_name' => $this->input->post('product_type_name')
				);
				$type->tabledata = $tabledata;
				$type->save();
				$is_save = $type->result;
				
				if($is_save){
					echo 'SAVE';
				} else {
					echo 'ERROR';
				}
			}
		}
		
		/**
			@name: edit()
			@uses: Edit product type
		*/
		public function edit()
		{
			if(!$this->session->userdata('key') && $this->session->userdata('accounttype') != md5('Admin'))
				redirect(site_url('admin'));
				
			// Get the product type information
			$type = new Generalmodel();
			unset($conditions);
			$conditions = array(
				'product_type_id' => $this->uri->segment(3)
			);
			$type->tables = 'product_type';
			$type->conditions = $conditions;
			$type->getrecordinformation();
			$data['type'] = $type->result;
				
			$this->load->view('admin/header', $data);
			$this->load->view('product_type/edit');
			$this->load->view('admin/footer');
		}
		
		/**
			@name: update()
			@uses: Update product size
		*/
		public function update()
		{
			if(!$this->session->userdata('key') && $this->session->userdata('accounttype') != md5('Admin'))
				echo 'LOGIN';
				
			$type = new Generalmodel();
			
			// Check if product type exist
			$conditions = array(
				'product_type_id !=' => $this->input->post('product_type_id'),
				'product_type_name' => $this->input->post('product_type_name')
			);
			$type->tables = 'product_type';
			$type->conditions = $conditions;
			$type->getrecordinformation();
			$is_exist = $type->numrows;
			
			if($is_exist){
				echo 'EXIST';
			} else {
				// Save the product type
				unset($conditions);
				$tabledata = array(
					'product_type_name' => $this->input->post('product_type_name')
				);
				$conditions = array(
					'product_type_id' => $this->input->post('product_type_id')
				);
				$type->tabledata = $tabledata;
				$type->conditions = $conditions;
				$type->update();
				$is_save = $type->result;
				
				if($is_save){
					echo 'SAVE';
				} else {
					echo 'ERROR';
				}
			}
		}
		
		/**
			@name: delete()
			@uses: Delete the product type
		*/		
		public function delete()
		{
			if(!$this->session->userdata('key') && $this->session->userdata('accounttype') != md5('Admin'))
				echo 'LOGIN';
				
			$type = new Generalmodel();
			$conditions = array(
				'product_type_id' => $this->input->post('product_type_id')
			);
			$type->tables = 'product_type';
			$type->conditions = $conditions;
			$type->delete();
			$is_deleted = $type->result;
			
			if($is_deleted){
				echo 'SUCCESS';
			} else {
				echo 'ERROR';
			}
		}
	}

?>