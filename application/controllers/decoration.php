<?php

	if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	class Decoration extends CI_Controller
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
                case 'view-decoration-methods':
                    $this->view_decoration_methods();
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
		
		/*
			@name: view_brands()
			@uses: Page for list of brands
		*/
		public function view_decoration_methods()
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
				
			// Get the decoration methods
			$decoration = new Generalmodel();
			$decoration->tables = 'decoration_method';
			$decoration->orderby = 'decoration_method_name ASC';
			$decoration->datalist();
			$data['decoration_method'] = $decoration->result;
				
			$this->load->view('admin/header', $data);
			$this->load->view('decoration_method/view_decoration_method');
			$this->load->view('admin/footer');
		}
		
		/*
			@name: add()
			@uses: Add new decoration method
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
			$this->load->view('decoration_method/add');
			$this->load->view('admin/footer');
		}
		
		/*
			@name: save()
			@uses: Save the brand information
		*/
		public function save()
		{
			if(!$this->session->userdata('key') && $this->session->userdata('accounttype') != md5('Admin'))
				echo 'LOGIN';
				
			$decoration = new Generalmodel();
			
			// Check if category exist
			$conditions = array(
				'decoration_method_name' => $this->input->post('decoration_method_name')
			);
			$decoration->tables = 'decoration_method';
			$decoration->conditions = $conditions;
			$decoration->getrecordinformation();
			$is_exist = $decoration->numrows;
			
			if($is_exist){
				echo 'EXIST';
			} else {
				// Save the decoration method
				$tabledata = array(
					'decoration_method_id' => uniqid(),
					'decoration_method_name' => $this->input->post('decoration_method_name'),
					'add_on_amount' => $this->input->post('add_on_amount')
				);
				$decoration->tabledata = $tabledata;
				$decoration->save();
				$is_save = $decoration->result;
				
				if($is_save){
					echo 'SAVE';
				} else {
					echo 'ERROR';
				}
			}
		}
		
		/**
			@name: edit()
			@uses: Edit product decoration method
		*/
		public function edit()
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
			
			// Get the decoration method information
			$decoration = new Generalmodel();
			unset($conditions);
			$conditions = array(
				'decoration_method_id' => $this->uri->segment(3)
			);
			$decoration->tables = 'decoration_method';
			$decoration->conditions = $conditions;
			$decoration->getrecordinformation();
			$data['decoration_method'] = $decoration->result;
				
			$this->load->view('admin/header', $data);
			$this->load->view('decoration_method/edit');
			$this->load->view('admin/footer');
		}
		
		/**
			@name: update()
			@uses: Update product decoration method
		*/
		public function update()
		{
			if(!$this->session->userdata('key') && $this->session->userdata('accounttype') != md5('Admin'))
				echo 'LOGIN';
				
			$decoration = new Generalmodel();
			
			// Check if category exist
			$conditions = array(
				'decoration_method_id !=' => $this->input->post('decoration_method_id'),
				'decoration_method_name' => $this->input->post('decoration_method_name')
			);
			$decoration->tables = 'decoration_method';
			$decoration->conditions = $conditions;
			$decoration->getrecordinformation();
			$is_exist = $decoration->numrows;
			
			if($is_exist){
				echo 'EXIST';
			} else {
				// Save the decoration method
				unset($conditions);
				$tabledata = array(
					'decoration_method_name' => $this->input->post('decoration_method_name'),
					'add_on_amount' => $this->input->post('add_on_amount')
				);
				$conditions = array(
					'decoration_method_id' => $this->input->post('decoration_method_id')
				);
				$decoration->tabledata = $tabledata;
				$decoration->conditions = $conditions;
				$decoration->update();
				$is_save = $decoration->result;
				
				if($is_save){
					echo 'SAVE';
				} else {
					echo 'ERROR';
				}
			}
		}
		
		/**
			@name: delete()
			@uses: Delete the product decoration method
		*/		
		public function delete()
		{
			if(!$this->session->userdata('key') && $this->session->userdata('accounttype') != md5('Admin'))
				echo 'LOGIN';
				
			$decoration = new Generalmodel();
			$conditions = array(
				'decoration_method_id' => $this->input->post('decoration_method_id')
			);
			$decoration->tables = 'decoration_method';
			$decoration->conditions = $conditions;
			$decoration->delete();
			$is_deleted = $decoration->result;
			
			if($is_deleted){
				echo 'SUCCESS';
			} else {
				echo 'ERROR';
			}
		}
	}

?>