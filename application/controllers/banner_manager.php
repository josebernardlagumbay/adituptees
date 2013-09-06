<?php

	if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	class Banner_manager extends CI_Controller
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
	            case 'view-banner-manager':
					$this->view_banner_manager();
				break;
				
				case 'banner-settings':
					$this->banner_settings();
				break;
				
				case 'update-banner-setting':
					$this->update_banner_setting();
				break;
				
				case 'upload-banner':
					$this->upload_banner();
				break;
				
				case 'upload':
					$this->upload();
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
			@name: view_banner_manager()
			@uses: View the banner manager
		*/
		public function view_banner_manager()
		{
			if(!$this->session->userdata('key') && $this->session->userdata('accounttype') != md5('Admin'))
				redirect(site_url('admin'));
				
			$banner = new Generalmodel();
			$banner->fields = 'banner.*, web_content.web_content_name, web_content.web_content_url';
			$banner->tables = 'banner';
			$banner->jointable = 'web_content';
			$banner->joincondition = 'web_content.web_content_id = banner.web_content_id';
			$banner->datalist();
			$data['banner'] = $banner->result;
			
			$this->load->view('admin/header', $data);
			$this->load->view('banner_manager/view_banner_manager');
			$this->load->view('admin/footer');
		}
		
		/**
			@name: banner_settings()
			@uses: Display the option setting for the banner sizes
		*/
		public function banner_settings()
		{
			if(!$this->session->userdata('key') && $this->session->userdata('accounttype') != md5('Admin'))
				redirect(site_url('admin'));
				
			$banner_settings = new Generalmodel();
			$banner_settings->tables = 'settings';
			$banner_settings->offset = 6;
			$banner_settings->limit = 2;
			$banner_settings->datalist();
			$data['banner_setting'] = $banner_settings->result;
			
			$this->load->view('admin/header', $data);
			$this->load->view('banner_manager/banner_settings');
			$this->load->view('admin/footer');
		}
		
		/**
			@name: update_banner_setting()
			@uses: Update the banner settings
		*/
		public function update_banner_setting()
		{
			if(!$this->session->userdata('key') && $this->session->userdata('accounttype') != md5('Admin'))
				echo 'LOGIN';
				
			$banner = new Generalmodel();
			
			// Update the thumbnail size
			$conditions = array(
				'settings_id' => 7
			);
			$tabledata = array(
				'data' => $this->input->post('banner_thumbnail')
			);
			$banner->tables = 'settings';
			$banner->tabledata = $tabledata;
			$banner->conditions = $conditions;
			$banner->update();
			
			// Update the display size
			$conditions = array(
				'settings_id' => 8
			);
			$tabledata = array(
				'data' => $this->input->post('banner_display')
			);
			$banner->tables = 'settings';
			$banner->tabledata = $tabledata;
			$banner->conditions = $conditions;
			$banner->update();
			
			echo 'UPDATE';
		}
		
		/**
			@name: upload_banner()
			@uses: Display the upload banner page
		*/
		public function upload_banner()
		{
			if(!$this->session->userdata('key') && $this->session->userdata('accounttype') != md5('Admin'))
				redirect(site_url('admin'));
				
			$banner_settings = new Generalmodel();
			$banner_settings->tables = 'settings';
			$banner_settings->offset = 6;
			$banner_settings->limit = 2;
			$banner_settings->datalist();
			$data['banner_setting'] = $banner_settings->result;
			
			// Get the web content
			$web_content = new Generalmodel();
			$conditions = array(
				'display_header' => 'No',
				'display_footer' => 'No'
			);
			$web_content->tables = 'web_content';
			$web_content->conditions = $conditions;
			$web_content->orderby = 'web_content_name ASC';
			$web_content->datalist();
			$data['web_content'] = $web_content->result;
			
			$this->load->view('admin/header', $data);
			$this->load->view('banner_manager/upload_banner');
			$this->load->view('admin/footer');
		}
		
		/**
			@name: upload()
			@uses: Upload the banner
		*/
		public function upload()
		{
			if(!$this->session->userdata('key') && $this->session->userdata('accounttype') != md5('Admin'))
				redirect(site_url('admin'));
				
			// Upload the image to the server
			$config['upload_path'] = 'uploads/banner';
			$config['allowed_types'] = 'gif|jpg|png|tif';
			$field_name = "upload_image";
			$this->load->library('upload', $config);
			
			if($this->upload->do_upload($field_name)){
				
				$image_name = explode('.', $_FILES['upload_image']['name']);
				
				// Resize the logo to thubmnail size
				// Get the thumbnail image setting
				$banner_setting = new Generalmodel();
				$banner_manager = new Generalmodel();
				
				$conditions = array(
					'settings_id' => 7
				);
				$banner_setting->tables = 'settings';
				$banner_setting->conditions = $conditions;
				$banner_setting->getrecordinformation();
				$thumbnail = $banner_setting->result;
				$thumbnail_info = explode('x',$thumbnail[0]['data']);
				$config['image_library'] = 'gd2';
				$config['source_image'] = 'uploads/banner/'. $_FILES['upload_image']['name'];
				$config['create_thumb'] = TRUE;
				$config['thumb_marker'] = '_thumbnail';
				$config['maintain_ratio'] = TRUE;
				$config['width'] = $thumbnail_info[0];
				$config['height'] = $thumbnail_info[1];
				$this->load->library('image_lib');
				$this->image_lib->initialize($config);
				$this->image_lib->resize();
				
				// Resize the logo to display size
				// Get the thumbnail image setting
				$conditions = array(
					'settings_id' => 8
				);
				$banner_setting->tables = 'settings';
				$banner_setting->conditions = $conditions;
				$banner_setting->getrecordinformation();
				$display = $banner_setting->result;
				$display_info = explode('x',$display[0]['data']);
				$config['image_library'] = 'gd2';
				$config['source_image'] = 'uploads/banner/'. $_FILES['upload_image']['name'];
				$config['create_thumb'] = TRUE;
				$config['thumb_marker'] = '_display';
				$config['maintain_ratio'] = TRUE;
				$config['width'] = $display_info[0];
				$config['height'] = $display_info[1];
				$this->load->library('image_lib');
				$this->image_lib->initialize($config);
				$this->image_lib->resize();
				
				if($this->input->post('web_content')){
					$tabledata = array(
						'banner_id' => uniqid(),
						'web_content_id' => $this->input->post('web_content'),
						'banner_thumbnail' => $image_name[0].'_thumbnail.'.$image_name[1],
						'banner_display' => $image_name[0].'_display.'.$image_name[1],
						'description' => $this->input->post('description'),
						'keywords' => $this->input->post('keywords')
					);
				} else {
					$tabledata = array(
						'banner_id' => uniqid(),
						'banner_thumbnail' => $image_name[0].'_thumbnail.'.$image_name[1],
						'banner_display' => $image_name[0].'_display.'.$image_name[1],
						'description' => $this->input->post('description'),
						'keywords' => $this->input->post('keywords')
					);
				}
				
					
				$banner_manager->tables = 'banner';
				$banner_manager->tabledata = $tabledata;
				$banner_manager->save();
				$is_save = $banner_manager->result;
				
				unlink('uploads/banner/'.$_FILES['upload_image']['name']);
				
				if($is_save){
					redirect(site_url('message/banner_manager/upload/success'));
				} else {
					redirect(site_url('message/banner_manager/upload/error'));
				}
				
			} else {
				redirect(site_url('message/banner_manager/upload/upload_error'));
			}
		}
		
		/**
			@name: update_status()
			@uses: Update the banner image status
		*/
		public function update_status()
		{
			if(!$this->session->userdata('key') && $this->session->userdata('accounttype') != md5('Admin'))
				echo 'LOGIN';
				
			$banner_manager = new Generalmodel();
			$tabledata = array(
				'status' => $this->input->post('status')
			);
			$conditions = array(
				'banner_id' => $this->input->post('banner_id')
			);
			$banner_manager->tables = 'banner';
			$banner_manager->tabledata = $tabledata;
			$banner_manager->conditions = $conditions;
			$banner_manager->update();
			$is_update = $banner_manager->result;
			
			if($is_update){
				echo 'SUCCESS';
			} else {
				echo 'ERROR';
			}
		}
		
		/**
			@name: delete()
			@uses: Delete the banner
		*/
		public function delete()
		{
			if(!$this->session->userdata('key') && $this->session->userdata('accounttype') != md5('Admin'))
				echo 'LOGIN';
			
			$banner_manager = new Generalmodel();
			
			// Get the banner information
			$conditions = array(
				'banner_id' => $this->input->post('banner_id')
			);
			$banner_manager->tables = 'banner';
			$banner_manager->conditions = $conditions;
			$banner_manager->getrecordinformation();
			$banner_info = $banner_manager->result;
			
			// Delete the image file from the server
			unlink('uploads/banner/'.$banner_info[0]['banner_thumbnail']);
			unlink('uploads/banner/'.$banner_info[0]['banner_display']);
			
			// Delete the banner from the database
			$banner_manager->delete();
			$is_delete = $banner_manager->result;
			
			if($is_delete){
				echo 'SUCCESS';
			} else {
				echo 'ERROR';
			}
			
		}
	}

?>