<?php

	if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	class Content extends CI_Controller
	{
		
		/**
			@name: about_us()
			@uses: Display the about us page
		*/
		public function about_us()
		{
			// Get the category
			$category = new Generalmodel();
			$category->tables = 'category';
			$category->orderby = 'category_name ASC';
			$category->limit = 10;
			$category->datalist();
			$data['category'] = $category->result;
			
			// Get the content
			$content = new Generalmodel();
			$conditions = array(
				'id' => 1
			);
			$content->tables = 'content';
			$content->conditions = $conditions;
			$content->getrecordinformation();
			$data['content'] = $content->result;
			
			$this->load->view('header', $data);
			$this->load->view('content/display_content');
			$this->load->view('footer');
		}
		
		/**
			@name: what_we_do()
			@uses: Display the what we do page
		*/
		public function what_we_do()
		{
			// Get the category
			$category = new Generalmodel();
			$category->tables = 'category';
			$category->orderby = 'category_name ASC';
			$category->limit = 10;
			$category->datalist();
			$data['category'] = $category->result;
			
			// Get the content
			$content = new Generalmodel();
			$conditions = array(
				'id' => 2
			);
			$content->tables = 'content';
			$content->conditions = $conditions;
			$content->getrecordinformation();
			$data['content'] = $content->result;
			
			$this->load->view('header', $data);
			$this->load->view('content/display_content');
			$this->load->view('footer');
		}
		
		/**
			@name: contact_us()
			@uses: Display the contact us page
		*/
		public function contact_us()
		{
			// Get the category
			$category = new Generalmodel();
			$category->tables = 'category';
			$category->orderby = 'category_name ASC';
			$category->limit = 10;
			$category->datalist();
			$data['category'] = $category->result;
			
			// Get the content
			$content = new Generalmodel();
			$conditions = array(
				'id' => 3
			);
			$content->tables = 'content';
			$content->conditions = $conditions;
			$content->getrecordinformation();
			$data['content'] = $content->result;
			
			$this->load->view('header', $data);
			$this->load->view('content/display_content');
			$this->load->view('footer');
		}
		
		/**
			@name: help()
			@uses: Display the help page
		*/
		public function help()
		{
			// Get the category
			$category = new Generalmodel();
			$category->tables = 'category';
			$category->orderby = 'category_name ASC';
			$category->limit = 10;
			$category->datalist();
			$data['category'] = $category->result;
			
			// Get the content
			$content = new Generalmodel();
			$conditions = array(
				'id' => 4
			);
			$content->tables = 'content';
			$content->conditions = $conditions;
			$content->getrecordinformation();
			$data['content'] = $content->result;
			
			$this->load->view('header', $data);
			$this->load->view('content/display_content');
			$this->load->view('footer');
		}
		
		/**
			@name: faq()
			@uses: Display the faq page
		*/
		public function faq()
		{
			// Get the category
			$category = new Generalmodel();
			$category->tables = 'category';
			$category->orderby = 'category_name ASC';
			$category->limit = 10;
			$category->datalist();
			$data['category'] = $category->result;
			
			// Get the content
			$content = new Generalmodel();
			$conditions = array(
				'id' => 5
			);
			$content->tables = 'content';
			$content->conditions = $conditions;
			$content->getrecordinformation();
			$data['content'] = $content->result;
			
			$this->load->view('header', $data);
			$this->load->view('content/display_content');
			$this->load->view('footer');
		}
		
		/**
			@name: privacy_policy()
			@uses: Display the privacy policy page
		*/
		public function privacy_policy()
		{
			// Get the category
			$category = new Generalmodel();
			$category->tables = 'category';
			$category->orderby = 'category_name ASC';
			$category->limit = 10;
			$category->datalist();
			$data['category'] = $category->result;
			
			// Get the content
			$content = new Generalmodel();
			$conditions = array(
				'id' => 6
			);
			$content->tables = 'content';
			$content->conditions = $conditions;
			$content->getrecordinformation();
			$data['content'] = $content->result;
			
			$this->load->view('header', $data);
			$this->load->view('content/display_content');
			$this->load->view('footer');
		}
		
		/**
			@name: shipping_and_deliveries()
			@uses: Display the shipping and deliveries page
		*/
		public function shipping_and_deliveries()
		{
			// Get the category
			$category = new Generalmodel();
			$category->tables = 'category';
			$category->orderby = 'category_name ASC';
			$category->limit = 10;
			$category->datalist();
			$data['category'] = $category->result;
			
			// Get the content
			$content = new Generalmodel();
			$conditions = array(
				'id' => 7
			);
			$content->tables = 'content';
			$content->conditions = $conditions;
			$content->getrecordinformation();
			$data['content'] = $content->result;
			
			$this->load->view('header', $data);
			$this->load->view('content/display_content');
			$this->load->view('footer');
		}
		
		/**
			@name: return_exchanges()
			@uses: Display the return and exchanges page
		*/
		public function return_exchanges()
		{
			// Get the category
			$category = new Generalmodel();
			$category->tables = 'category';
			$category->orderby = 'category_name ASC';
			$category->limit = 10;
			$category->datalist();
			$data['category'] = $category->result;
			
			// Get the content
			$content = new Generalmodel();
			$conditions = array(
				'id' => 8
			);
			$content->tables = 'content';
			$content->conditions = $conditions;
			$content->getrecordinformation();
			$data['content'] = $content->result;
			
			$this->load->view('header', $data);
			$this->load->view('content/display_content');
			$this->load->view('footer');
		}
		
		/**
			@name: terms_conditions()
			@uses: Display the terms and conditions page
		*/
		public function terms_conditions()
		{
			// Get the category
			$category = new Generalmodel();
			$category->tables = 'category';
			$category->orderby = 'category_name ASC';
			$category->limit = 10;
			$category->datalist();
			$data['category'] = $category->result;
			
			// Get the content
			$content = new Generalmodel();
			$conditions = array(
				'id' => 9
			);
			$content->tables = 'content';
			$content->conditions = $conditions;
			$content->getrecordinformation();
			$data['content'] = $content->result;
			
			$this->load->view('header', $data);
			$this->load->view('content/display_content');
			$this->load->view('footer');
		}
		
		/*
			@name: edit()
			@uses: Edit the content of the page
		*/
		public function edit()
		{
			if(!$this->session->userdata('key') && $this->session->userdata('accounttype') != md5('ADMIN'))
				redirect(site_url('admin'));
				
			// Get the content
			$content = new Generalmodel();
			$conditions = array(
				'id' => $this->uri->segment(3)
			);
			$content->tables = 'content';
			$content->conditions = $conditions;
			$content->getrecordinformation();
			$data['content'] = $content->result;
			
			$this->load->view('admin/header');
			$this->load->view('admin/menu');
			$this->load->view('content/edit', $data);
			$this->load->view('admin/footer');
		}
		
		/*
			@name: update()
			@uses: Update the content of the page
		*/
		public function update()
		{
			if(!$this->session->userdata('key') && $this->session->userdata('accounttype') != md5('ADMIN'))
				redirect(site_url('admin'));
				
			// Update the content
			$content = new Generalmodel();
			$tabledata = array(
				'title' => $this->input->post('title'),
				'content' => $this->input->post('details')
			);
			$conditions = array(
				'id' => $this->uri->segment(3)
			);	
			$content->tables = 'content';
			$content->tabledata = $tabledata;
			$content->conditions = $conditions;
			$content->update();
			
			redirect(site_url('message/content'));
		}
		
	}

?>