<?php

	if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	class Social_media_accounts extends CI_Controller
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
	            case 'add':
					$this->add();
				break;
				
				case 'save':
					$this->save();
				break;
				
				case 'view-social-media-accounts':
					$this->view_social_media_accounts();
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
			}
		}
		
		/**
			@name: add()
			@uses: Add new social media account
		*/
		public function add()
		{
			if(!$this->session->userdata('key') && $this->session->userdata('accounttype') != md5('Admin'))
				redirect(site_url('admin'));
				
			$this->load->view('admin/header');
			$this->load->view('social_media_accounts/add');
			$this->load->view('admin/footer');
		}
		
		/**
			@name: save()
			@uses: Save the social media information
		*/
		public function save()
		{
			if(!$this->session->userdata('key') && $this->session->userdata('accounttype') != md5('Admin'))
				redirect(site_url('admin'));
				
			$social_media = new Generalmodel();
			
			// Upload the image to the server
			$config['upload_path'] = 'uploads/social_media';
			$config['allowed_types'] = 'gif|jpg|png|tif';
			$field_name = "social_media_logo";
			$this->load->library('upload', $config);
			
			if($this->upload->do_upload($field_name)){
				
				// Save the social media information after logo upload
				$tabledata = array(
					'url' => $this->input->post('social_media_url'),
					'name' => $this->input->post('social_media_name'),
					'logo' => $_FILES['social_media_logo']['name']
				);
				$social_media->tables = 'social_media';
				$social_media->tabledata = $tabledata;
				$social_media->save();
				$is_save = $social_media->result;
				
				if($is_save){
					redirect(site_url('message/social_media_accounts/save/success'));
				} else {
					redirect(site_url('message/social_media_accounts/save/error'));
				}
				
			} else {
				redirect(site_url('message/social_media_accounts/save/error_upload'));
			}
		}
		
		/**
			@name: view_social_media_accounts()
			@uses: View the social media accounts
		*/
		public function view_social_media_accounts()
		{
			if(!$this->session->userdata('key') && $this->session->userdata('accounttype') != md5('Admin'))
				redirect(site_url('admin'));
				
			$social_media = new Generalmodel();
			$social_media->tables = 'social_media';
			$social_media->datalist();
			$data['social_media'] = $social_media->result;
			
			$this->load->view('admin/header', $data);
			$this->load->view('social_media_accounts/view_social_media_accounts');
			$this->load->view('admin/footer');
		}
		
		/**
			@name: edit()
			@uses: Edit the social media account
		*/
		public function edit()
		{
			if(!$this->session->userdata('key') && $this->session->userdata('accounttype') != md5('Admin'))
				redirect(site_url('admin'));
				
			$social_media = new Generalmodel();
			$conditions = array(
				'id' => $this->uri->segment(3)
			);
			$social_media->tables = 'social_media';
			$social_media->conditions = $conditions;
			$social_media->getrecordinformation();
			$data['social_media'] = $social_media->result;
				
			$this->load->view('admin/header', $data);
			$this->load->view('social_media_accounts/edit');
			$this->load->view('admin/footer');
		}
		
		/**
			@name: update()
			@uses: Update the social media account
		*/
		public function update()
		{
			if(!$this->session->userdata('key') && $this->session->userdata('accounttype') != md5('Admin'))
				redirect(site_url('admin'));
				
			$social_media = new Generalmodel();
			
			// Upload the logo
			// Upload the image to the server
			if($_FILES['social_media_logo']['name']){
				$config['upload_path'] = 'uploads/social_media';
				$config['allowed_types'] = 'gif|jpg|png|tif';
				$field_name = "social_media_logo";
				$this->load->library('upload', $config);
				$this->upload->do_upload($field_name);
				
				$tabledata = array(
					'url' => $this->input->post('social_media_url'),
					'name' => $this->input->post('social_media_name'),
					'logo' => $_FILES['social_media_logo']['name']
				);
			} else {
				$tabledata = array(
					'url' => $this->input->post('social_media_url'),
					'name' => $this->input->post('social_media_name')
				);
			}

			// Save the social media information after logo upload
			$conditions = array(
				'id' => $this->input->post('social_id')
			);
			$social_media->tables = 'social_media';
			$social_media->tabledata = $tabledata;
			$social_media->conditions = $conditions;
			$social_media->update();
			$is_update = $social_media->result;
			
			if($is_update){
				redirect(site_url('message/social_media_accounts/update/success'));
			} else {
				redirect(site_url('message/social_media_accounts/update/error'));
			}
		}
		
		/**
			@name: delete()
			@uses: Delete the social media account
		*/
		public function delete()
		{
			if(!$this->session->userdata('key') && $this->session->userdata('accounttype') != md5('Admin'))
				echo 'LOGIN';
				
			// Get the social media account information
			$social_media = new Generalmodel();
			$conditions = array(
				'id' => $this->input->post('social_id')
			);
			$social_media->tables = 'social_media';
			$social_media->conditions = $conditions;
			$social_media->getrecordinformation();
			$social_media_info = $social_media->result;
			
			// Delete the logo
			unlink('uploads/social_media/'.$social_media_info[0]['logo']);
			
			// Delete the record from the database
			$social_media->delete();
			$is_delete = $social_media->result;
			
			if($is_delete){
				echo 'SUCCESS';
			} else {
				echo 'ERROR';
			}
		}
	}

?>