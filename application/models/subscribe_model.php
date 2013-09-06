<?php

	if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	class Subscribe_model extends CI_Model
	{
		
		public $email_address;
		
		/**
			@name: is_subcribe()
			@uses: Check if email address is subscribe
		*/
		public function is_subscribe()
		{
			$this->db->where('email_address', $this->email_address);
			$result = $this->db->get('subscribe');
			return $result->num_rows();
		}
		
	}

?>