<?php

	if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	class Subscribe extends CI_Controller
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
                case 'check-email':
                    $this->check_email();
                    break;
					
				case 'save-email':
					$this->save_email();
					break;
            }
        } 
		
		/**
			@name: check_email()
			@uses: Check if email address exist
		*/
		public function check_email()
		{
			// Load the subscribe model
			$this->load->model('Subscribe_model');
			
			// Check if email address is already subscribe
			$this->Subscribe_model->email_address = $this->input->post('email');
			$is_exist = $this->Subscribe_model->is_subscribe();
			
			if($is_exist){
				echo 'EXIST';
			} else {
				echo 'NOT EXIST';
			}
		}
		
		/**
			@name: save_email()
			@uses: Save the email address
		*/
		public function save_email()
		{
			$subscribe = new Generalmodel();
			$tabledata = array(
				'email_address' => $this->input->post('email')
			);
			$subscribe->tables = 'subscribe';
			$subscribe->tabledata = $tabledata;
			$subscribe->save();
			$is_save = $subscribe->result;
			
			if($is_save){
				echo 'SAVE';
			} else {
				echo 'ERROR';
			}
		}
		
	}

?>