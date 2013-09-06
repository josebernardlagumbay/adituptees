<?php

	if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	class Web_content extends CI_Controller
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
	            case 'create-web-content':
					$this->create_web_content();
				break;
				
				case 'save':
					$this->save();
				break;
				
				case 'view-web-content':
					$this->view_web_content();
				break;
				
				case 'edit-web-content':
					$this->edit_web_content();
				break;
				
				case 'page-name-exist':
					$this->page_name_exist();
				break;
				
				case 'update':
					$this->update();
				break;
				
				case 'delete':
					$this->delete();
				break;
				
				case 'update-status':
					$this->update_status();
				break;
				
				case 'logo-manager':
					$this->change_logo();
				break;
				
				case 'upload-logo':
					$this->upload_logo();
				break;
                
                case 'add-content':
                    $this->add_content();
                    break;   
                    
                case 'save-content':
                    $this->save_content();
                    break;  
					
				case 'add-content-category':
					$this->add_content_category();
					break;
					
				case 'save-content-category':
					$this->save_content_category();
					break;
					
			}
		}
		
		/**
			@name: create_web_content()
			@uses: Create web content
		*/
		public function create_web_content()
		{
			if(!$this->session->userdata('key') && $this->session->userdata('accounttype') != md5('Admin'))
				redirect(site_url('admin'));
				
			$this->load->view('admin/header');
			$this->load->view('web_content/create_web_content');
			$this->load->view('admin/footer');
		}
		
		/**
			@name: save()
			@uses: Save the web content information
		*/
		public function save()
		{
			if(!$this->session->userdata('key') && $this->session->userdata('accounttype') != md5('Admin'))
				redirect(site_url('admin'));
			
			$display_header = $this->input->post('display_header');
			$display_footer = $this->input->post('display_footer');
			$display_blog = $this->input->post('display_blog');
			$web_content_type = $this->input->post('web_content_type');
			$web_content = new Generalmodel();
			$tabledata = array(
				'web_content_id' => time(),
				'web_content_type' => $web_content_type[0],
				'web_content_name' => $this->input->post('web_content_name'),
				'content_summary' => $this->input->post('content_summary'),
				'full_content' => $this->input->post('full_content'),
				'web_content_url' => $this->input->post('web_content_url'),
				'display_header' => $display_header[0],
				'display_footer' => $display_footer[0],
				//'display_blog' => $display_blog[0],
				'web_date' => date('M d Y')
			);
			$web_content->tables = 'web_content';
			$web_content->tabledata = $tabledata;
			$web_content->save();
			$is_save = $web_content->result;
			
			if($is_save){
				redirect(site_url('message/web_content/save/success'));
			} else {
				redirect(site_url('message/web_content/save/error'));
			}
		}
		
		/**
			@name: view_web_content()
			@uses: View the web content
		*/
		public function view_web_content()
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
			
			// Get the categories
			$category = new Generalmodel();
			$category->tables = 'category';
			$category->datalist();
			$data['category'] = $category->result;
			
			$this->load->view('admin/header', $data);
			$this->load->view('web_content/view_web_content');
			$this->load->view('admin/footer');
		}
		
		/**
			@name: edit_web_content()
			@uses: Edit the web content
		*/
		public function edit_web_content()
		{
			if(!$this->session->userdata('key') && $this->session->userdata('accounttype') != md5('Admin'))
				redirect(site_url('admin'));
				
			// Get the web content
			$conditions = array(
				'web_content_id' => $this->uri->segment(3)
			);
			$web_content = new Generalmodel();
			$web_content->tables = 'web_content';
			$web_content->conditions = $conditions;
			$web_content->getrecordinformation();
			$data['web_content'] = $web_content->result;
			
			$this->load->view('admin/header', $data);
			$this->load->view('web_content/edit_web_content');
			$this->load->view('admin/footer');
		}
		
		/**
			@name: page_name_exist()
			@uses: Check if the web content name exist
		*/
		public function page_name_exist()
		{
			$web_content = new Generalmodel();
			if($this->input->post('web_content_id')){
				$conditions = array(
					'web_content_name' => $this->input->post('web_content_name'),
					'web_content_id !=' => $this->input->post('web_content_id')
				);
			} else {
				$conditions = array(
					'web_content_name' => $this->input->post('web_content_name')
				);
			}
			$web_content->tables = 'web_content';
			$web_content->conditions = $conditions;
			$web_content->getrecordinformation();
			$is_exist = $web_content->numrows;
			
			if($is_exist){
				echo 'EXIST';
			} else {
				echo 'NOT EXIST';
			}
		}
		
		/**
			@name: update()
			@uses: Update the web content information
		*/
		public function update()
		{
			if(!$this->session->userdata('key') && $this->session->userdata('accounttype') != md5('Admin'))
				redirect(site_url('admin'));
			
			$display_header = $this->input->post('display_header');
			$display_footer = $this->input->post('display_footer');
			$display_blog = $this->input->post('display_blog');
			$web_content_type = $this->input->post('web_content_type');
			$web_content = new Generalmodel();
			$tabledata = array(
				'web_content_type' => $web_content_type[0],
				'web_content_name' => $this->input->post('web_content_name'),
				'content_summary' => $this->input->post('content_summary'),
				'full_content' => $this->input->post('full_content'),
				'web_content_url' => $this->input->post('web_content_url'),
				'display_header' => $display_header[0],
				'display_footer' => $display_footer[0]
				//'display_blog' => $display_blog[0]
			);
			$conditions = array(
				'web_content_id' => $this->input->post('web_content_id')
			);
			$web_content->tables = 'web_content';
			$web_content->tabledata = $tabledata;
			$web_content->conditions = $conditions;
			$web_content->update();
			$is_save = $web_content->result;
			
			if($is_save){
				redirect(site_url('message/web_content/update/success'));
			} else {
				redirect(site_url('message/web_content/update/error'));
			}
		}
		
		/**
			@name: delete() 
			@uses: Delete the web content
		*/
		public function delete()
		{
			if(!$this->session->userdata('key') && $this->session->userdata('accounttype') != md5('Admin'))
				echo 'LOGIN';
				
			$web_content = new Generalmodel();
			$conditions = array(
				'web_content_id' => $this->input->post('web_content_id')
			);
			$web_content->tables = 'web_content';
			$web_content->conditions = $conditions;
			$web_content->delete();
			$is_delete = $web_content->result;
			
			if($is_delete){
				echo 'SUCCESS';
			} else {
				echo 'ERROR';
			}
		}
		
		/**
			@name: update_status()
			@uses: Update the status of the web content
		*/
		public function update_status()
		{
			if(!$this->session->userdata('key') && $this->session->userdata('accounttype') != md5('Admin'))
				echo 'LOGIN';
				
			$web_content = new Generalmodel();
			$tabledata = array(
				'status' => $this->input->post('status')
			);
			$conditions = array(
				'web_content_id' => $this->input->post('web_content_id')
			);
			$web_content->tables = 'web_content';
			$web_content->tabledata = $tabledata;
			$web_content->conditions = $conditions;
			$web_content->update();
			$is_update = $web_content->result;
			
			if($is_update){
				echo 'SUCCESS';
			} else {
				echo 'ERROR';
			}
		}
		
		/**
			@name: change_logo()
			@uses: Change the website logo
		*/
		public function change_logo()
		{
			if(!$this->session->userdata('key') && $this->session->userdata('accounttype') != md5('Admin'))
				redirect(site_url('admin'));
				
			$this->load->view('admin/header');
			$this->load->view('web_content/change_logo');
			$this->load->view('admin/footer');
		}
		
		/**
			@name: upload_logo()
			@uses: Upload the website logo
		*/
		public function upload_logo()
		{
			if(!$this->session->userdata('key') && $this->session->userdata('accounttype') != md5('Admin'))
				redirect(site_url('admin'));
				
			// Upload the image to the server
			$config['upload_path'] = 'uploads/web_content';
			$config['allowed_types'] = 'gif|jpg|png|tif';
			$field_name = "logo";
			$this->load->library('upload', $config);
			
			if($this->upload->do_upload($field_name)){
				$tabledata = array(
					'data' => $_FILES['logo']['name']
				);
				$conditions = array(
					'settings_id' => 6
				);
				$image_mananger = new Generalmodel();
				$image_mananger->tables = 'settings';
				$image_mananger->tabledata = $tabledata;
				$image_mananger->conditions = $conditions;
				$image_mananger->update();
				$is_save = $image_mananger->result;
				
				if($is_save){
					redirect(site_url('message/logo_manager/upload/success'));
				} else {
					redirect(site_url('message/logo_manager/upload/error'));
				}
			} else {
				redirect(site_url('message/logo_manager/upload/error_upload'));
			}
		}

        /**
            @name: add_content()
            @uses: Add content for menu link web content type
         */
        public function add_content()
        {
            if(!$this->session->userdata('key') && $this->session->userdata('accounttype') != md5('Admin'))
                redirect(site_url('admin'));
                
            // Get the content information
            $web_content = new Generalmodel();
            $conditions = array(
                'web_content_id' => $this->uri->segment(3)
            );      
            $web_content->tables = 'web_content';
            $web_content->conditions = $conditions;
            $web_content->getrecordinformation();
            $data['web_content'] = $web_content->result;      
            
            // Get the content only web pages
            unset($conditions);
            $conditions = array(
                'web_content_type' => 'content only'
            ); 
            $web_content->attrresetter();
            $web_content->tables = 'web_content';
            $web_content->conditions = $conditions;
            $web_content->datalist();
            $data['web_content_only'] = $web_content->result;     
            
            // Get the current of the menu link
            $web_content->attrresetter();
            unset($conditions);
            $conditions = array(
                'web_content_id' => $this->uri->segment(3)
            );  
            $web_content->tables = 'web_content_details';
            $web_content->conditions = $conditions;
            $web_content->datalist();
            $data['content_details'] = $web_content->result;         
               
            $this->load->view('admin/header', $data);
            $this->load->view('web_content/add_content');
            $this->load->view('admin/footer');
        }

        /**
            @name: save_content()
            @uses: Save the sub content
         */
        public function save_content()
        {
            if(!$this->session->userdata('key') && $this->session->userdata('accounttype') != md5('Admin'))
                redirect(site_url('admin'));
                
            $web_content = new Generalmodel();
            
            // Remove the previous content
            $conditions = array(
                'web_content_id' => $this->input->post('web_content_id')
            );
            $web_content->tables = 'web_content_details';
            $web_content->conditions = $conditions;
            $web_content->delete();
            $web_content->attrresetter();
            $sub_content = $this->input->post('add_content');
            if($sub_content){
                foreach($sub_content as $list){
                    $tabledata = array(
                        'web_content_id' => $this->input->post('web_content_id'),
                        'web_content_detail_id' => $list
                    );
                    $web_content->tables = 'web_content_details';
                    $web_content->tabledata = $tabledata;
                    $web_content->save();
                }
                redirect(site_url('message/add_content/save/success'));                
            } else {
                redirect(site_url('message/add_content/save/error'));
            }               
        }
		
		/**
			@name: add_content_category()
			@uses: Add content for product category
		*/
		public function add_content_category()
		{
			if(!$this->session->userdata('key') && $this->session->userdata('accounttype') != md5('Admin'))
                redirect(site_url('admin'));
                
            // Get the category information
            $category = new Generalmodel();
            $conditions = array(
                'category_id' => $this->uri->segment(3)
            );      
            $category->tables = 'category';
            $category->conditions = $conditions;
            $category->getrecordinformation();
            $data['category_info'] = $category->result;      
            
            // Get the content only web pages
			$web_content = new Generalmodel();
            unset($conditions);
            $conditions = array(
                'web_content_type' => 'content only'
            ); 
            $web_content->attrresetter();
            $web_content->tables = 'web_content';
            $web_content->conditions = $conditions;
            $web_content->datalist();
            $data['web_content_only'] = $web_content->result;     
            
            // Get the current of the menu link
            $web_content->attrresetter();
            unset($conditions);
            $conditions = array(
                'web_content_id' => $this->uri->segment(3)
            );  
            $web_content->tables = 'web_content_details';
            $web_content->conditions = $conditions;
            $web_content->datalist();
            $data['content_details'] = $web_content->result;         
               
            $this->load->view('admin/header', $data);
            $this->load->view('web_content/add_content_category');
            $this->load->view('admin/footer');
		}
		
		/**
			@name: save_content_category()
			@uses: Save the category content
		*/
		public function save_content_category()
		{
			if(!$this->session->userdata('key') && $this->session->userdata('accounttype') != md5('Admin'))
                redirect(site_url('admin'));
                
            $web_content = new Generalmodel();
            
            // Remove the previous content
            $conditions = array(
                'web_content_id' => $this->input->post('category_id')
            );
            $web_content->tables = 'web_content_details';
            $web_content->conditions = $conditions;
            $web_content->delete();
            $web_content->attrresetter();
            $sub_content = $this->input->post('add_content');
            if($sub_content){
                foreach($sub_content as $list){
                    $tabledata = array(
                        'web_content_id' => $this->input->post('category_id'),
                        'web_content_detail_id' => $list
                    );
                    $web_content->tables = 'web_content_details';
                    $web_content->tabledata = $tabledata;
                    $web_content->save();
                }
                redirect(site_url('message/add_content/save/success'));                
            } else {
                redirect(site_url('message/add_content/save/error'));
            }
		}
		
	}

?>