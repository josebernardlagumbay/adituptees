<?php

	if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	class Size extends CI_Controller
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
                case 'view-sizes':
                    $this->view_sizes();
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
			@name: view_sizes()
			@uses: Page for list of sizes
		*/
		public function view_sizes()
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
				
			// Get the product sizes
			$sizes = new Generalmodel();
			$sizes->tables = 'size';
			$sizes->orderby = 'size_name ASC';
			$sizes->datalist();
			$data['size'] = $sizes->result;
			
			$this->load->view('admin/header', $data);
			$this->load->view('size/view_sizes');
			$this->load->view('admin/footer');
		}
		
		/**
			@name: add()
			@uses: Add product size
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
			$this->load->view('size/add');
			$this->load->view('admin/footer');
		}
		
		/**
			@name: save()
			@uses: Save product size
		*/
		public function save()
		{
			if(!$this->session->userdata('key') && $this->session->userdata('accounttype') != md5('Admin'))
				echo 'LOGIN';
				
			$size = new Generalmodel();
			
			// Check if category exist
			$conditions = array(
				'size_name' => $this->input->post('size_name')
			);
			$size->tables = 'size';
			$size->conditions = $conditions;
			$size->getrecordinformation();
			$is_exist = $size->numrows;
			
			if($is_exist){
				echo 'EXIST';
			} else {
				// Save the category
				$tabledata = array(
					'size_id' => uniqid(),
					'size_name' => $this->input->post('size_name'),
					'add_on_amount' => $this->input->post('add_on_amount')
				);
				$size->tabledata = $tabledata;
				$size->save();
				$is_save = $size->result;
				
				if($is_save){
					echo 'SAVE';
				} else {
					echo 'ERROR';
				}
			}
		}
		
		/**
			@name: edit()
			@uses: Edit product size
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
			
			// Get the size information
			$size = new Generalmodel();
			unset($conditions);
			$conditions = array(
				'size_id' => $this->uri->segment(3)
			);
			$size->tables = 'size';
			$size->conditions = $conditions;
			$size->getrecordinformation();
			$data['size'] = $size->result;
				
			$this->load->view('admin/header', $data);
			$this->load->view('size/edit');
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
				
			$size = new Generalmodel();
			
			// Check if category exist
			$conditions = array(
				'size_id !=' => $this->input->post('size_id'),
				'size_name' => $this->input->post('size_name')
			);
			$size->tables = 'size';
			$size->conditions = $conditions;
			$size->getrecordinformation();
			$is_exist = $size->numrows;
			
			if($is_exist){
				echo 'EXIST';
			} else {
				// Save the category
				unset($conditions);
				$tabledata = array(
					'size_name' => $this->input->post('size_name'),
					'add_on_amount' => $this->input->post('add_on_amount')
				);
				$conditions = array(
					'size_id' => $this->input->post('size_id')
				);
				$size->tabledata = $tabledata;
				$size->conditions = $conditions;
				$size->update();
				$is_save = $size->result;
				
				if($is_save){
					echo 'SAVE';
				} else {
					echo 'ERROR';
				}
			}
		}
		
		/**
			@name: delete()
			@uses: Delete the size
		*/		
		public function delete()
		{
			if(!$this->session->userdata('key') && $this->session->userdata('accounttype') != md5('Admin'))
				echo 'LOGIN';
				
			$size = new Generalmodel();
			$conditions = array(
				'size_id' => $this->input->post('size_id')
			);
			$size->tables = 'size';
			$size->conditions = $conditions;
			$size->delete();
			$is_deleted = $size->result;
			
			if($is_deleted){
				echo 'SUCCESS';
			} else {
				echo 'ERROR';
			}
		}
	}

?>