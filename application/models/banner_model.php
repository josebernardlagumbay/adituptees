<?php

	if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	class Banner_model extends CI_Model
	{
		
		public $banner_id;
		
		/**
			@name: get_banner()
			@uses: Get the banner
		*/
		public function get_banner()
		{
			$this->db->where('banner.status','display');
            $this->db->join('web_content', 'web_content.web_content_id = banner.web_content_id');
			$result = $this->db->get('banner');
			return $result->result_array();
		}
		
		/**
			@name: get_banner_info()
			@uses: Get the banner information
		*/
		public function get_banner_info()
		{
			$this->db->where('banner.banner_id', $this->banner_id);
			$result = $this->db->get('banner');
			return $result->result_array();
		}
		
	}

?>