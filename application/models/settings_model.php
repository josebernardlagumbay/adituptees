<?php

	if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	class Settings_model extends CI_Model
	{
		
		/**
			@name: get_paypal()
			@uses: Get the paypal account
		*/
		public function get_paypal()
		{
			$this->db->where('settings_id', 1);
			$result = $this->db->get('settings');
			return $result->result_array();
		}
		
		/**
			@name: get_email_address()
			@uses: Get the email address
		*/
		public function get_email_address()
		{
			$this->db->where('settings_id', 2);
			$result = $this->db->get('settings');
			return $result->result_array();
		}
		
		/**
			@name: get_company_info()
			@uses: Get the company information
		*/
		public function get_company_info()
		{
			$result = $this->db->get('settings',6,12);
			return $result->result_array();
		}
		
		/**
			@name: get_currency()
			@uses: Get the currency
		*/
		public function get_currency()
		{
			$this->db->where('settings_id', 12);
			$result = $this->db->get('settings');
			return $result->result_array();
		}
		
	}

?>