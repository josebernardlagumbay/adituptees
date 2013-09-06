<?php

	if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	class Blog_model extends CI_Model
	{
		
		public $limit;
		public $offset;
		
		
		/**
			@name: get_total_blogs()
			@uses: Get the total blogs
		*/
		public function get_total_blogs()
		{
			$this->db->where('display_blog','yes');
			$result = $this->db->get('web_content');
			return $result->num_rows();
		}
		
		/**
			@name: get_blogs()
			@uses: Get the blog detail summary
		*/
		public function get_blogs()
		{
			$this->db->where('display_blog','yes');
			$this->db->order_by = 'web_content_id DESC';
			$result = $this->db->get('web_content', $this->limit, $this->offset);
			return $result->result_array();
		}
		
	}

?>