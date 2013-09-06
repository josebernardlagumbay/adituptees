<?php

	if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	class Admin extends CI_Controller
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
                case 'login':
                    $this->login();
                break;
                
                case 'index':
                    $this->login();
                break;
                
                case 'authenticate':
                    $this->authenticate();
                break;
                
                case 'dashboard':
                    $this->dashboard();
                break;     
                
                case 'logout':
                    $this->login();
                break;
                
                case 'change-password':
                    $this->change_password();
                break;      
                
                case 'update-new-password':
                    $this->update_new_password();
                break;  
            }
        }
        		
		/*
			@name: login()
			@uses: Display the login page for Admin
		*/
		public function login()
		{
		    // Load the model
			$this->load->model('Menu_model');
			$this->load->model('Product_model');
			$this->load->model('Category_model');
			$this->load->model('Settings_model');
			$this->load->model('Social_media_model');
			
			// Get the menu
            $data['header_menu'] = $this->Menu_model->get_menu_header();
            $data['footer_menu'] = $this->Menu_model->get_menu_footer();
			
			// Get the social media
			$data['social_media'] = $this->Social_media_model->get_social_media();
			
			// Get the current currency used
			$data['currency'] = $this->Settings_model->get_currency();
			
			// Get the product type
			$data['type'] = $this->Product_model->get_product_type();
			
			// Get the product deal
			$data['deal'] = $this->Product_model->get_product_deal();
			
			// Get the categories
			$data['category'] = $this->Category_model->get_categories();
			
			// Get the on demand items
			$data['demand'] = $this->Product_model->get_product_demand();
            
			$this->load->view('header', $data);
			$this->load->view('left');
			$this->load->view('admin/login');
			$this->load->view('footer');
		}
		
		/*
			@name: authenticate()
			@uses: Authenticate admin account if exist
		*/
		public function authenticate()
		{
			$admin = new Generalmodel();
			$conditions = array(
				'username' => $this->input->post('username'),
				'password' => md5($this->input->post('password'))
			);
			$admin->tables = 'admin';
			$admin->conditions = $conditions;
			$admin->getrecordinformation();
			$admin_info = $admin->result;
			$isexist = $admin->numrows;
			
			if($isexist){
				// Store the Admin information to the session
				$newdata = array(
					'username'  => $admin_info[0]['username'],
					'firstname'  => $admin_info[0]['first_name'],
					'key'  => $admin_info[0]['id'],
					'accounttype'     => ADMIN,
					'logged_in' => TRUE
               		);
				$this->session->set_userdata($newdata);
				echo 'EXIST';
			} else {
				echo 'NOT EXIST';
			}
		}
		
		/*
			@name: dashboard()
			@uses: Display the Admin Dashboard
		*/
		public function dashboard()
		{
			if(!$this->session->userdata('key') && $this->session->userdata('accounttype') != md5('Admin'))
				redirect(site_url('admin'));
				
			$this->load->view('admin/header');
			$this->load->view('admin/dashboard');
			$this->load->view('admin/footer');
		}
		
		/*
			@name: logout()
			@uses: Logout for Admin
		*/
		public function logout()
		{
			// Store the Admin information to the session
			$newdata = array(
               'username'  => '',
               'firstname'  => '',
               'key'  => '',
               'accounttype' => '',
               'logged_in' => ''
           	);
			$this->session->set_userdata($newdata);
			redirect(site_url('admin'));
		}

        /**
            @name: change_password()
            @uses: Change the password for Admin User UI
         */
        public function change_password()
        {
            if(!$this->session->userdata('key') && $this->session->userdata('accounttype') != md5('Admin'))
                redirect(site_url('admin'));
                
            $this->load->view('admin/header');
            $this->load->view('admin/change_password');
            $this->load->view('admin/footer');           
        }
        
        /*
            @name: update_new_password()
            @uses: Update new password for Admin User
         */
        public function update_new_password()
        {
            if(!$this->session->userdata('key') && $this->session->userdata('accounttype') != md5('Admin'))
                echo 'LOGIN';
            
            $admin = new Generalmodel();
            $tabledata = array(
                'password' => md5($this->input->post('new_password'))
            );
            $conditions = array(
                'id' => 1
            );
            $admin->tables = 'admin';
            $admin->tabledata = $tabledata;
            $admin->conditions = $conditions;
            $admin->update();
            $is_update = $admin->result;
            
            if($is_update){
                echo 'SAVE';
            } else {
                echo 'ERROR';
            }
        }        
		
	}

?>