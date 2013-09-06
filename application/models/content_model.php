<?php

	if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	class Content_model extends CI_Model
	{
		
		public $web_content_url;
		public $web_content_id;
		
		/**
			@name: get_home()
			@uses: Get the content for home
		*/
		public function get_home()
		{
			$this->db->where('web_content_id', 1);
			$result = $this->db->get('web_content');
			return $result->result_array();
		}
		
		/**
			@name: get_content_page()
			@uses: Get the content of the page
		*/
		public function get_content_page()
		{
			$this->db->where('web_content_url', $this->web_content_url);
			$result = $this->db->get('web_content');
			return $result->result_array();
		}
		
		/**
			@name: check_content_image()
			@uses: Check if the content has image
		*/
		public function check_content_image()
		{
			$this->db->where('web_content_id', $this->web_content_id);
			$result = $this->db->get('image_manager');
			return $result->result_array();
		}
        
        /**
            @name: get_menu_link_content()
            @uses: Get the menu link content
         */
        public function get_menu_link_content()
        {
            $this->db->where('web_content_details.web_content_id', $this->web_content_id);
            $this->db->join('web_content','web_content.web_content_id = web_content_details.web_content_detail_id');
            $result = $this->db->get('web_content_details');
            return $result->result_array();
        }
		
	}

?>