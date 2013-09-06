<?php

    if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    
    class Customer_model extends CI_Model
    {
        
        public $email_address;
        public $zip_code;
        public $state;
		public $account_id;
        
        /**
            @name: is_email_exist()
            @uses: Check if email address is already exist
         */
        public function is_email_exist()
        {
            $this->db->where('email_address', $this->email_address);
            $result = $this->db->get('customer');
            return $result->num_rows();
        }
        
        /**
            @name: validate_zip_code()
            @uses: Validate the zip code
         */
        public function validate_zip_code()
        {
            $this->db->where('zip', $this->zip_code);
            
            if($this->state)
                $this->db->where('state', $this->state);
            
            $result = $this->db->get('zipcodes');
            return $result->result_array();           
        }
		
		/**
			@name: get_customer_information()
			@uses: Get the customer account information
		*/
		public function get_customer_information()
		{
			$this->db->where('customer.account_id', $this->account_id);
			$result = $this->db->get('customer');
			return $result->result_array();
		}
		
		/**
			@name: get_customer_order()
			@uses: Get the customer order
		*/
		public function get_customer_order()
		{
			$this->db->where('customer_id', $this->account_id);
			$this->db->order_by('order_id DESC');
			$result = $this->db->get('order');
			return $result->result_array();
		}
		
		/**
			@name: get_customer_wishlist()
			@uses: Get the customer wishlist
		*/
		public function get_customer_wishlist()
		{
			$this->db->where('customer_wishlist.account_id', $this->account_id);
			$this->db->join('products','products.product_id = customer_wishlist.product_id');
			$result = $this->db->get('customer_wishlist');
			return $result->result_array();
		}
        
    }

?>