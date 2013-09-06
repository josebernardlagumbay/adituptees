<?php

	if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	class Brand extends CI_Controller
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
                case 'view-brands':
                    $this->view_brands();
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
		public function view_brands()
		{
			if(!$this->session->userdata('key') && $this->session->userdata('accounttype') != md5('Admin'))
				redirect(site_url('admin'));
				
			// Get the brands
			$brands = new Generalmodel();
			$brands->tables = 'brand';
			$brands->orderby = 'brand_name ASC';
			$brands->datalist();
			$data['brand'] = $brands->result;
				
			$this->load->view('admin/header');
			$this->load->view('brand/view_brands', $data);
			$this->load->view('admin/footer');
		}
		
		/*
			@name: add()
			@uses: Add new brand
		*/
		public function add()
		{
			if(!$this->session->userdata('key') && $this->session->userdata('accounttype') != md5('Admin'))
				redirect(site_url('admin'));
				
			$this->load->view('admin/header');
			$this->load->view('brand/add');
			$this->load->view('admin/footer');
		}
		
		/*
			@name: save()
			@uses: Save the brand information
		*/
		public function save()
		{
			if(!$this->session->userdata('key') && $this->session->userdata('accounttype') != md5('Admin'))
				redirect(site_url('admin'));
				
			// Upload the brand logo to the server
			// Upload the image
			$config['upload_path'] = 'uploads/brand/';
			$config['allowed_types'] = 'gif|jpg|png';
			$field_name = "brand_logo";
			$this->load->library('upload', $config);
			
			if($this->upload->do_upload($field_name)){
				// Resize the image
				$config['image_library'] = 'gd2';
				$config['source_image'] = 'uploads/brand/' . $_FILES['brand_logo']['name'];
				$config['create_thumb'] = TRUE;
				$config['thumb_marker'] = '_logo';
				$config['maintain_ratio'] = TRUE;
				$config['width'] = 270;
				$config['height'] = 270;

				$this->load->library('image_lib');
				$this->image_lib->initialize($config);
				$this->image_lib->resize();
				$image_name = explode('.', $_FILES['brand_logo']['name']);
				
				// Save the brand information
				$brand = new Generalmodel();
				$tabledata = array(
					'brand_id' => uniqid(),
					'brand_name' => $this->input->post('brand_name'),
					'brand_logo' => $image_name[0].'_logo.'.$image_name[1]
				);
				$brand->tables = 'brand';
				$brand->tabledata = $tabledata;
				$brand->save();
				$issave = $brand->result;
				
				if($issave){
					unlink('uploads/brand/' . $_FILES['brand_logo']['name']);
					redirect(site_url('message/brand/save/success'));
				} else {
					redirect(site_url('message/brand/save/error'));
				}
			}
		}
		
		/*
			@name: edit()
			@uses: Edit page for brand
		*/
		public function edit()
		{
			if(!$this->session->userdata('key') && $this->session->userdata('accounttype') != md5('Admin'))
				redirect(site_url('admin'));
				
			if(!$this->uri->segment(3))
				redirect(site_url('admin'));
				
			// Get the brand information
			$brand = new Generalmodel();
			$conditions = array(
				'brand_id' => $this->uri->segment(3)
			);
			$brand->tables = 'brand';
			$brand->conditions = $conditions;
			$brand->getrecordinformation();
			$data['brand'] = $brand->result;
				
			$this->load->view('admin/header');
			$this->load->view('brand/edit', $data);
			$this->load->view('admin/footer');
		}
		
		/*
			@name: update()
			@uses: Update the brand information
		*/
		public function update()
		{
			if(!$this->session->userdata('key') && $this->session->userdata('accounttype') != md5('Admin'))
				echo 'LOGIN';
				
			$brand = new Generalmodel();
			
			// Check if brand exist
			$conditions = array(
				'brand_id != ' => $this->input->post('brand_id'),
				'brand_name' => $this->input->post('brand_name')
			);
			$brand->tables = 'brand';
			$brand->conditions = $conditions;
			$brand->getrecordinformation();
			$is_exist = $brand->result;
			
			if($is_exist){
				echo 'EXIST';
			} else {
				// Update the brand
				$tabledata = array(
					'brand_name' => $this->input->post('brand_name')
				);
				unset($conditions);
				$conditions = array(
					'brand_id' => $this->input->post('brand_id')
				);
				$brand->tables = 'brand';
				$brand->tabledata = $tabledata;
				$brand->conditions = $conditions;
				$brand->update();
				$issave = $brand->result;
				
				if($issave){
					echo 'SAVE';
				} else {
					echo 'ERROR';
				}
			}
		}
		
		/*
			@name: change_logo()
			@uses: Change logo for brand
		*/
		public function change_logo()
		{
			if(!$this->session->userdata('key') && $this->session->userdata('accounttype') != md5('Admin'))
				redirect(site_url('admin'));
				
			if(!$this->uri->segment(3))
				redirect(site_url('admin'));
				
			// Get the brand information
			$brand = new Generalmodel();
			$conditions = array(
				'brand_id' => $this->uri->segment(3)
			);
			$brand->tables = 'brand';
			$brand->conditions = $conditions;
			$brand->getrecordinformation();
			$data['brand'] = $brand->result;
				
			$this->load->view('admin/header');
			$this->load->view('brand/change_logo', $data);
			$this->load->view('admin/footer');
		}
		
		/*
			@name: upload()
			@uses: Upload the brand logo
		*/
		public function upload()
		{
			if(!$this->session->userdata('key') && $this->session->userdata('accounttype') != md5('Admin'))
				redirect(site_url('admin'));
				
			if(!$this->uri->segment(3))
				redirect(site_url('admin'));
				
			// Get the brand information and delete the old logo from the server
			$brand = new Generalmodel();
			$conditions = array(
				'brand_id' => $this->uri->segment(3)
			);
			$brand->tables = 'brand';
			$brand->conditions = $conditions;
			$brand->getrecordinformation();
			$brand_info = $brand->result;
			unlink('uploads/brand/' . $brand_info[0]['logo']);
				
			// Upload the brand logo to the server
			// Upload the image
			$config['upload_path'] = 'uploads/brand/';
			$config['allowed_types'] = 'gif|jpg|png';
			$field_name = "brand_logo";
			$this->load->library('upload', $config);
			
			if($this->upload->do_upload($field_name)){
				// Resize the image
				$config['image_library'] = 'gd2';
				$config['source_image'] = 'uploads/brand/' . $_FILES['brand_logo']['name'];
				$config['create_thumb'] = TRUE;
				$config['thumb_marker'] = '_logo';
				$config['maintain_ratio'] = TRUE;
				$config['width'] = 125;
				$config['height'] = 104;

				$this->load->library('image_lib');
				$this->image_lib->initialize($config);
				$this->image_lib->resize();
				$image_name = explode('.', $_FILES['brand_logo']['name']);
				
				// Update the brand information
				$brand = new Generalmodel();
				$tabledata = array(
					'logo' => $image_name[0].'_logo.'.$image_name[1]
				);
				$brand->tables = 'brand';
				$brand->tabledata = $tabledata;
				$brand->conditions = $conditions;
				$brand->update();
				$issave = $brand->result;
				
				if($issave){
					unlink('uploads/brand/' . $_FILES['brand_logo']['name']);
					redirect(site_url('message/brand/upload/success'));
				} else {
					redirect(site_url('message/brand/upload/error'));
				}
			}
		}
		
		/*
			@name: delete()
			@uses: Delete the brand information
		*/
		public function delete()
		{
			if(!$this->session->userdata('key') && $this->session->userdata('accounttype') != md5('Admin'))
				echo 'LOGIN';
				
			// Get the brand information and delete the old logo from the server
			$brand = new Generalmodel();
			$conditions = array(
				'brand_id' => $this->input->post('brand_id')
			);
			$brand->tables = 'brand';
			$brand->conditions = $conditions;
			$brand->getrecordinformation();
			$brand_info = $brand->result;
			unlink('uploads/brand/' . $brand_info[0]['brand_logo']);
			
			$brand->delete();
			$is_delete = $brand->result;
			
			if($is_delete){
				echo 'SUCCESS';
			} else {
				echo 'ERROR';
			}
		}
		
		/*
			@name: is_exist()
			@uses: Check if brand is exist
		*/
		public function is_exist()
		{
			$brands = new Generalmodel();
			if($this->input->post('key')){
				$conditions = array(
					'brand_id !=' => $this->input->post('key'),
					'brand_name' => $this->input->post('brand_name')
				);
			} else {
				$conditions = array(
					'brand_name' => $this->input->post('brand_name')
				);
			}
			
			$brands->tables = 'brand';
			$brands->conditions = $conditions;
			$brands->getrecordinformation();
			$isexist = $brands->numrows;
			
			if($isexist){
				echo 'EXIST';
			} else {
				echo 'NOT EXIST';
			}
		}
	}

?>