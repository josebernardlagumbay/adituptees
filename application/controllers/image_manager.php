<?php

	if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	class Image_manager extends CI_Controller
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
	            case 'view-image-manager':
					$this->view_image_manager();
				break;
				
				case 'image-settings':
					$this->image_settings();
				break;
				
				case 'update-image-setting':
					$this->update_image_setting();
				break;
				
				case 'upload-image':
					$this->upload_image();
				break;
				
				case 'upload':
					$this->upload();
				break;
				
				case 'get-image':
					$this->get_image();
				break;
				
				case 'update-status':
					$this->update_status();
				break;
				
				case 'delete':
					$this->delete();
				break;
			}
		}
		
		/**
			@name: view_image_manager()
			@uses: Display the images used in a page
		*/
		public function view_image_manager()
		{
			if(!$this->session->userdata('key') && $this->session->userdata('accounttype') != md5('Admin'))
				redirect(site_url('admin'));
				
			// Get the web content
			$conditions = array(
				'web_content_id !=' => 1
			);
			$web_content = new Generalmodel();
			$web_content->tables = 'web_content';
			$web_content->conditions = $conditions;
			$web_content->datalist();
			$data['web_content'] = $web_content->result;
			
			// Get the images
			$image_manager = new Generalmodel();
			$image_manager->tables = 'image_manager';
			$image_manager->datalist();
			$data['image_manager'] = $image_manager->result;
			
			$this->load->view('admin/header', $data);
			$this->load->view('image_manager/view_image_manager');
			$this->load->view('admin/footer');
		}
		
		/**
			@name: image_settings()
			@uses: Dispay the image settings to configure for the web content
		*/
		public function image_settings()
		{
			if(!$this->session->userdata('key') && $this->session->userdata('accounttype') != md5('Admin'))
				redirect(site_url('admin'));
			
			// Get the current image settings
			$image_setting = new Generalmodel();
			$image_setting->tables = 'settings';
			$image_setting->limit = 3;
			$image_setting->offset = 2;
			$image_setting->datalist();
			$data['image_settings'] = $image_setting->result;
			
			
			$this->load->view('admin/header', $data);
			$this->load->view('image_manager/image_settings');
			$this->load->view('admin/footer');
		}
		
		/**
			@name: update_image_setting()
			@uses: Update the image settings
		*/
		public function update_image_setting()
		{
			if(!$this->session->userdata('key') && $this->session->userdata('accounttype') != md5('Admin'))
				echo 'LOGIN';
				
			$image_settings = new Generalmodel();
			
			// Update for image thumbnail
			$tabledata = array(
				'data' => $this->input->post('image_thumbnail')
			);
			$conditions = array(
				'settings_id' => 3
			);
			$image_settings->tables = 'settings';
			$image_settings->tabledata = $tabledata;
			$image_settings->conditions = $conditions;
			$image_settings->update();
			
			// Update for image display
			$tabledata = array(
				'data' => $this->input->post('image_display')
			);
			$conditions = array(
				'settings_id' => 4
			);
			$image_settings->tables = 'settings';
			$image_settings->tabledata = $tabledata;
			$image_settings->conditions = $conditions;
			$image_settings->update();
			
			// Update for image zoom
			$tabledata = array(
				'data' => $this->input->post('image_zoom')
			);
			$conditions = array(
				'settings_id' => 5
			);
			$image_settings->tables = 'settings';
			$image_settings->tabledata = $tabledata;
			$image_settings->conditions = $conditions;
			$image_settings->update();
			
			echo 'UPDATE';
		}
		
		/**
			@name: upload_image()
			@uses: Upload image for the web content
		*/
		public function upload_image()
		{
			if(!$this->session->userdata('key') && $this->session->userdata('accounttype') != md5('Admin'))
				redirect(site_url('admin'));
			
			// Get the web content information
			$web_content = new Generalmodel();
			$conditions = array(
				'web_content_id' => $this->uri->segment(3)
			);
			$web_content->tables = 'web_content';
			$web_content->conditions = $conditions;
			$web_content->getrecordinformation();
			$data['web_content'] = $web_content->result;
			
			
			$this->load->view('admin/header', $data);
			$this->load->view('image_manager/upload_image');
			$this->load->view('admin/footer');
		}
		
		/**
			@name: upload()
			@uses: Upload the image
		*/
		public function upload()
		{
			if(!$this->session->userdata('key') && $this->session->userdata('accounttype') != md5('Admin'))
				redirect(site_url('admin'));
				
			$image_mananger = new Generalmodel();
			$image_setting = new Generalmodel();
			
			// Upload the image to the server
			$config['upload_path'] = 'uploads/web_content';
			$config['allowed_types'] = 'gif|jpg|png|tif';
			$field_name = "upload_image";
			$this->load->library('upload', $config);
			
			if($this->upload->do_upload($field_name)){
				
				$image_name = explode('.', $_FILES['upload_image']['name']);
				
				// Resize image to 32x32
				$config['image_library'] = 'gd2';
				$config['source_image'] = 'uploads/web_content/'. $_FILES['upload_image']['name'];
				$config['create_thumb'] = TRUE;
				$config['thumb_marker'] = '_small';
				$config['maintain_ratio'] = TRUE;
				$config['width'] = 32;
				$config['height'] = 32;
				$this->load->library('image_lib');
				$this->image_lib->initialize($config);
				$this->image_lib->resize();
				
				// Resize the logo to thubmnail size
				// Get the thumbnail image setting
				$conditions = array(
					'settings_id' => 3
				);
				$image_setting->tables = 'settings';
				$image_setting->conditions = $conditions;
				$image_setting->getrecordinformation();
				$thumbnail_info = $image_setting->result;
				$config['image_library'] = 'gd2';
				$config['source_image'] = 'uploads/web_content/'. $_FILES['upload_image']['name'];
				$config['create_thumb'] = TRUE;
				$config['thumb_marker'] = '_thumbnail';
				$config['maintain_ratio'] = TRUE;
				$config['width'] = $thumbnail_info[0]['data'];
				$config['height'] = $thumbnail_info[0]['data'];
				$this->load->library('image_lib');
				$this->image_lib->initialize($config);
				$this->image_lib->resize();
				
				// Resize the logo to display size
				// Get the thumbnail image setting
				$conditions = array(
					'settings_id' => 4
				);
				$image_setting->tables = 'settings';
				$image_setting->conditions = $conditions;
				$image_setting->getrecordinformation();
				$display_info = $image_setting->result;
				$config['image_library'] = 'gd2';
				$config['source_image'] = 'uploads/web_content/'. $_FILES['upload_image']['name'];
				$config['create_thumb'] = TRUE;
				$config['thumb_marker'] = '_display';
				$config['maintain_ratio'] = TRUE;
				$config['width'] = $display_info[0]['data'];
				$config['height'] = $display_info[0]['data'];
				$this->load->library('image_lib');
				$this->image_lib->initialize($config);
				$this->image_lib->resize();
				
				// Resize the logo to zoom size
				// Get the thumbnail image setting
				$conditions = array(
					'settings_id' => 5
				);
				$image_setting->tables = 'settings';
				$image_setting->conditions = $conditions;
				$image_setting->getrecordinformation();
				$zoom_info = $image_setting->result;
				$config['image_library'] = 'gd2';
				$config['source_image'] = 'uploads/web_content/'. $_FILES['upload_image']['name'];
				$config['create_thumb'] = TRUE;
				$config['thumb_marker'] = '_zoom';
				$config['maintain_ratio'] = TRUE;
				$config['width'] = $zoom_info[0]['data'];
				$config['height'] = $zoom_info[0]['data'];
				$this->load->library('image_lib');
				$this->image_lib->initialize($config);
				$this->image_lib->resize();
				
				$tabledata = array(
					'image_manager_id' => uniqid(),
					'web_content_id' => $this->input->post('web_content_id'),
					'image_thubmnail' => $image_name[0].'_thumbnail.'.$image_name[1],
					'image_display' => $image_name[0].'_display.'.$image_name[1],
					'image_zoom' => $image_name[0].'_zoom.'.$image_name[1],
					'image_small' => $image_name[0].'_small.'.$image_name[1],
					'image' => $_FILES['upload_image']['name']
				);
				$image_mananger->tables = 'image_manager';
				$image_mananger->tabledata = $tabledata;
				$image_mananger->save();
				$is_save = $image_mananger->result;
				
				if($is_save){
					redirect(site_url('message/image_manager/upload/success'));
				} else {
					redirect(site_url('message/image_manager/upload/error'));
				}
				
			} else {
				redirect(site_url('message/image_manager/upload/error_upload'));
			}
		}
		
		/**
			@name: get_image()
			@uses: Get the image
		*/
		public function get_image()
		{
			if(!$this->session->userdata('key') && $this->session->userdata('accounttype') != md5('Admin'))
				echo 'LOGIN';
				
			$image_manager = new Generalmodel();
			$conditions = array(
				'image_manager_id' => $this->input->post('image_manager_id')
			);
			$image_manager->tables = 'image_manager';
			$image_manager->conditions = $conditions;
			$image_manager->getrecordinformation();
			$image_manager_info = $image_manager->result;
			
			echo '<img src="'.base_url('uploads/web_content/'.$image_manager_info[0]['image_display']).'" />';
			
		}
		
		/**
			@name: update_status()
			@uses: Update the web content image status
		*/
		public function update_status()
		{
			if(!$this->session->userdata('key') && $this->session->userdata('accounttype') != md5('Admin'))
				echo 'LOGIN';
				
			$image_manager = new Generalmodel();
			$tabledata = array(
				'status' => $this->input->post('status')
			);
			$conditions = array(
				'image_manager_id' => $this->input->post('image_manager_id')
			);
			$image_manager->tables = 'image_manager';
			$image_manager->tabledata = $tabledata;
			$image_manager->conditions = $conditions;
			$image_manager->update();
			$is_update = $image_manager->result;
			
			if($is_update){
				echo 'SUCCESS';
			} else {
				echo 'ERROR';
			}
		}
		
		/**
			@name: delete()
			@uses: Delete the image
		*/
		public function delete()
		{
			if(!$this->session->userdata('key') && $this->session->userdata('accounttype') != md5('Admin'))
				echo 'LOGIN';
				
			// Get the image file to delete
			$image_manager = new Generalmodel();
			$conditions = array(
				'image_manager_id' => $this->input->post('image_manager_id')
			);
			$image_manager->tables = 'image_manager';
			$image_manager->conditions = $conditions;
			$image_manager->getrecordinformation();
			$image_manager_data = $image_manager->result;
			
			// Delete the image
			unlink('uploads/web_content/'.$image_manager_data[0]['image_thubmnail']);
			unlink('uploads/web_content/'.$image_manager_data[0]['image_display']);
			unlink('uploads/web_content/'.$image_manager_data[0]['image_zoom']);
			unlink('uploads/web_content/'.$image_manager_data[0]['image_small']);
			unlink('uploads/web_content/'.$image_manager_data[0]['image']);
			
			// Delete from the database
			$image_manager->delete();
			$is_delete = $image_manager->result;
			
			if($is_delete){
				echo 'SUCCESS';
			} else {
				echo 'ERROR';
			}
		}
		
	}

?>