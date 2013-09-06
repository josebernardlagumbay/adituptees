<?php

	if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	class Menu_model extends CI_Model
	{
		
		public $result;
		
		/**
			@name: get_menu_header()
			@uses: Get the header menu
		*/
		public function get_menu_header()
		{
			$this->db->where('display_header','Yes');
			$this->db->where('status','display');
			$this->db->where('web_content_type !=','content only');
			$result = $this->db->get('web_content');
			return $result->result_array();
		}
		
		/**
			@name: get_menu_footer()
			@uses: Get the footer menu
		*/
		public function get_menu_footer()
		{
			$this->db->where('display_footer','Yes');
			$this->db->where('status','display');
            $this->db->where('web_content_type !=','content only');
			$result = $this->db->get('web_content');
			return $result->result_array();
		}
		
	}

?>