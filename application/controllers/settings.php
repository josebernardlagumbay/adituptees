<?php

	if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	class Settings extends CI_Controller
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
	            case 'paypal-account':
					$this->paypal_account();
					break;
				
				case 'update-paypal-account':
					$this->update_paypal_account();
					break;
					
				case 'email-address':
					$this->email_address();
					break;
					
				case 'update-email-address':
					$this->update_email_address();
					break;
				
				case 'currency':
					$this->currency();
					break;
				
				case 'update-currency':
					$this->update_currency();
					break;
				
				case 'office-address':
					$this->office_address();
					break;
				
				case 'update-office-address':
					$this->update_office_address();
					break;
			}
		}
		
		/**
			@name: paypal_account()
			@uses: Enter the paypal account
		*/
		public function paypal_account()
		{
			if(!$this->session->userdata('key') && $this->session->userdata('accounttype') != md5('Admin'))
				redirect(site_url('admin'));
				
			// Get the current paypal email
			$paypal = new Generalmodel();
			$conditions = array(
				'settings_id' => 1
			);
			$paypal->tables = 'settings';
			$paypal->conditions = $conditions;
			$paypal->getrecordinformation();
			$data['settings'] = $paypal->result;
				
			$this->load->view('admin/header', $data);
			$this->load->view('settings/paypal_account');
			$this->load->view('admin/footer');
		}
		
		/**
			@name: update_paypal_account()
			@uses: Update the paypal account
		*/
		public function update_paypal_account()
		{
			if(!$this->session->userdata('key') && $this->session->userdata('accounttype') != md5('Admin'))
				echo 'LOGIN';
			
			$tabledata = array(
				'data' => $this->input->post('paypal_account')
			);
			$conditions = array(
				'settings_id' => 1
			);
			$paypal = new Generalmodel();
			$paypal->tables = 'settings';
			$paypal->tabledata = $tabledata;
			$paypal->conditions = $conditions;
			$paypal->update();
			$is_update = $paypal->result;
			
			if($is_update){
				echo 'UPDATE';
			} else {
				echo 'ERROR';
			}
		}
		
		/**
			@name: email_address()
			@uses: Email address for contact
		*/
		public function email_address()
		{
			if(!$this->session->userdata('key') && $this->session->userdata('accounttype') != md5('Admin'))
				redirect(site_url('admin'));
			
			// Get the email address
			$email_address = new Generalmodel();
			$conditions = array(
				'settings_id' => 2
			);
			$email_address->tables = 'settings';
			$email_address->conditions = $conditions;
			$email_address->getrecordinformation();
			$data['settings'] = $email_address->result;
				
			$this->load->view('admin/header', $data);
			$this->load->view('settings/email_address');
			$this->load->view('admin/footer');
		}
		
		/**
			@name: update_email_address()
			@uses: Update the email address
		*/
		public function update_email_address()
		{
			if(!$this->session->userdata('key') && $this->session->userdata('accounttype') != md5('Admin'))
				echo 'LOGIN';
			
			$tabledata = array(
				'data' => $this->input->post('email_address')
			);
			$conditions = array(
				'settings_id' => 2
			);
			$email = new Generalmodel();
			$email->tables = 'settings';
			$email->tabledata = $tabledata;
			$email->conditions = $conditions;
			$email->update();
			$is_update = $email->result;
			
			if($is_update){
				echo 'UPDATE';
			} else {
				echo 'ERROR';
			}
		}
		
		/**
			@name: currency()
			@uses: Enter the currency
		*/
		public function currency()
		{
			if(!$this->session->userdata('key') && $this->session->userdata('accounttype') != md5('Admin'))
				redirect(site_url('admin'));
				
			// Get the currency
			$currency = new Generalmodel();
			$conditions = array(
				'settings_id' => 12
			);
			$currency->tables = 'settings';
			$currency->conditions = $conditions;
			$currency->getrecordinformation();
			$data['settings'] = $currency->result;
				
			$this->load->view('admin/header', $data);
			$this->load->view('settings/currency');
			$this->load->view('admin/footer');
		}
		
		/**
			@name: update_currency()
			@uses: Update the currency
		*/
		public function update_currency()
		{
			if(!$this->session->userdata('key') && $this->session->userdata('accounttype') != md5('Admin'))
				echo 'LOGIN';
			
			$tabledata = array(
				'data' => $this->input->post('currency')
			);
			$conditions = array(
				'settings_id' => 12
			);
			$email = new Generalmodel();
			$email->tables = 'settings';
			$email->tabledata = $tabledata;
			$email->conditions = $conditions;
			$email->update();
			$is_update = $email->result;
			
			if($is_update){
				echo 'UPDATE';
			} else {
				echo 'ERROR';
			}
		}
		
		/**
			@name: office_address()
			@uses: Display office address information
		*/
		public function office_address()
		{
			if(!$this->session->userdata('key') && $this->session->userdata('accounttype') != md5('Admin'))
				redirect(site_url('admin'));
				
			// Get the office address
			$office_address = new Generalmodel();
			$office_address->tables = 'settings';
			$office_address->offset = 12;
			$office_address->limit = 6;
			$office_address->datalist();
			$office_address_info = $office_address->result;
			$data['office_address'] = $office_address_info;
				
			$this->load->view('admin/header', $data);
			$this->load->view('settings/office_address');
			$this->load->view('admin/footer');
		}
		
		/**
			@name: update_office_address()
			@uses: Updae the office address
		*/
		public function update_office_address()
		{
			if(!$this->session->userdata('key') && $this->session->userdata('accounttype') != md5('Admin'))
				echo 'LOGIN';
				
			$office_address = new Generalmodel();
			
			// Update the street
			$tabledata = array(
				'data' => $this->input->post('street')
			);
			$conditions = array(
				'settings_id' => 13
			);
			$office_address->tables = 'settings';
			$office_address->tabledata = $tabledata;
			$office_address->conditions = $conditions;
			$office_address->update();
			
			// Update the city
			$tabledata = array(
				'data' => $this->input->post('city')
			);
			$conditions = array(
				'settings_id' => 14
			);
			$office_address->tables = 'settings';
			$office_address->tabledata = $tabledata;
			$office_address->conditions = $conditions;
			$office_address->update();
			
			// Update the state
			$tabledata = array(
				'data' => $this->input->post('state')
			);
			$conditions = array(
				'settings_id' => 15
			);
			$office_address->tables = 'settings';
			$office_address->tabledata = $tabledata;
			$office_address->conditions = $conditions;
			$office_address->update();
			
			// Update the zipcode
			$tabledata = array(
				'data' => $this->input->post('zipcode')
			);
			$conditions = array(
				'settings_id' => 16
			);
			$office_address->tables = 'settings';
			$office_address->tabledata = $tabledata;
			$office_address->conditions = $conditions;
			$office_address->update();
			
			// Update the telephone number
			$tabledata = array(
				'data' => $this->input->post('telephone_number')
			);
			$conditions = array(
				'settings_id' => 17
			);
			$office_address->tables = 'settings';
			$office_address->tabledata = $tabledata;
			$office_address->conditions = $conditions;
			$office_address->update();
			
			// Update the company name
			$tabledata = array(
				'data' => $this->input->post('company_name')
			);
			$conditions = array(
				'settings_id' => 18
			);
			$office_address->tables = 'settings';
			$office_address->tabledata = $tabledata;
			$office_address->conditions = $conditions;
			$office_address->update();
			
			echo 'UPDATE';
		}
		
	}

?>