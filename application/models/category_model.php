<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Category_model extends CI_Model
{
	
	public $category_id;
    
    /**
        @name: get_categories()
        @uses: Get the categories
     */
    public function get_categories()
    {
        $result = $this->db->get('category');
        return $result->result_array();
    }
	
	/**
		@name: get_category_info()
		@uses: Get the category information
	*/
	public function get_category_info()
	{
		$this->db->where('category_id', $this->category_id);
		$result = $this->db->get('category');
		return $result->result_array();
	}
}

?>