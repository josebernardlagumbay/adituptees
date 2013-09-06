<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ads_model extends CI_Model
{
    
    /**
        @name: get_latest_ads()
        @uses: Get the latest ad added
     */
    public function get_latest_ads()
    {
        $this->db->where('web_content_type','ads');    
        $this->db->where('web_content.status', 'display');        
		$this->db->join('image_manager','image_manager.web_content_id = web_content.web_content_id');
        $this->db->orderby = 'web_content_id DESC';
        $result = $this->db->get('web_content');
        return $result->result_array();
    }
    
}

?>