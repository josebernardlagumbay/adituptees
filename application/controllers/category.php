<?php

	if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	class Category extends CI_Controller
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
	            case 'view-categories':
					$this->view_categories();
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
				
				case 'cover-template':
					$this->cover_template();
					break;
					
				case 'save-cover-template':
					$this->save_cover_template();
					break;
			}
		}
		
		/**
			@name: view_categories()
			@uses: Display the product categories
		*/
		public function view_categories()
		{
			if(!$this->session->userdata('key') && $this->session->userdata('accounttype') != md5('Admin'))
				redirect(site_url('admin'));
				
			// Get the product categories
			$category = new Generalmodel();
			$category->tables = 'category';
			$category->orderby = 'category_name ASC';
			$category->datalist();
			$data['category'] = $category->result;
			
			$this->load->view('admin/header', $data);
			$this->load->view('category/view_categories');
			$this->load->view('admin/footer');
		}
		
		/**
			@name: add()
			@uses: Add product category
		*/
		public function add()
		{
			if(!$this->session->userdata('key') && $this->session->userdata('accounttype') != md5('Admin'))
				redirect(site_url('admin'));
				
			$this->load->view('admin/header');
			$this->load->view('category/add');
			$this->load->view('admin/footer');
		}
		
		/**
			@name: save()
			@uses: Save the category information
		*/
		public function save()
		{
			if(!$this->session->userdata('key') && $this->session->userdata('accounttype') != md5('Admin'))
				echo 'LOGIN';
				
			$category = new Generalmodel();
			
			// Check if category exist
			$conditions = array(
				'category_name' => $this->input->post('category_name')
			);
			$category->tables = 'category';
			$category->conditions = $conditions;
			$category->getrecordinformation();
			$is_exist = $category->numrows;
			
			if($is_exist){
				echo 'EXIST';
			} else {
				// Save the category
				$tabledata = array(
					'category_id' => uniqid(),
					'category_name' => $this->input->post('category_name')
				);
				$category->tabledata = $tabledata;
				$category->save();
				$is_save = $category->result;
				
				if($is_save){
					echo 'SAVE';
				} else {
					echo 'ERROR';
				}
			}
		}
		
		/**
			@name: edit()
			@uses: Edit product category
		*/
		public function edit()
		{
			if(!$this->session->userdata('key') && $this->session->userdata('accounttype') != md5('Admin'))
				redirect(site_url('admin'));
				
			// Get the product information
			$category = new Generalmodel();
			$conditions = array(
				'category_id' => $this->uri->segment(3)
			);
			$category->tables = 'category';
			$category->conditions = $conditions;
			$category->getrecordinformation();
			$data['category'] = $category->result;
				
			$this->load->view('admin/header', $data);
			$this->load->view('category/edit');
			$this->load->view('admin/footer');
		}
		
		/**
			@name: update()
			@uses: Update the category information
		*/
		public function update()
		{
			if(!$this->session->userdata('key') && $this->session->userdata('accounttype') != md5('Admin'))
				echo 'LOGIN';
				
			$category = new Generalmodel();
			
			// Check if category exist
			$conditions = array(
				'category_name' => $this->input->post('category_name'),
				'category_id' => $this->input->post('category_id')
			);
			$category->tables = 'category';
			$category->conditions = $conditions;
			$category->getrecordinformation();
			$is_exist = $category->numrows;
			
			if($is_exist){
				echo 'EXIST';
			} else {
				// Save the category
				$tabledata = array(
					'category_name' => $this->input->post('category_name')
				);
				$conditions = array(
					'category_id' => $this->input->post('category_id')
				);
				$category->tabledata = $tabledata;
				$category->conditions = $conditions;
				$category->update();
				$is_save = $category->result;
				
				if($is_save){
					echo 'SAVE';
				} else {
					echo 'ERROR';
				}
			}
		}
		
		/**
			@name: delete()
			@uses: Delete the category
		*/		
		public function delete()
		{
			if(!$this->session->userdata('key') && $this->session->userdata('accounttype') != md5('Admin'))
				echo 'LOGIN';
				
			$category = new Generalmodel();
			$conditions = array(
				'category_id' => $this->input->post('category_id')
			);
			$category->tables = 'category';
			$category->conditions = $conditions;
			$category->delete();
			$is_deleted = $category->result;
			
			if($is_deleted){
				echo 'SUCCESS';
			} else {
				echo 'ERROR';
			}
		}
		
	}

?>