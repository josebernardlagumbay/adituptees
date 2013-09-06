<?php

	if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	class Package_model extends CI_Controller
	{
		
		/**
			@name: get_active_package()
			@uses: Get the active package
		*/
		public function get_active_package()
		{
			$this->db->where('status','active');
			$result = $this->db->get('package');
			return $result->result_array();
		}
		
	}

?>