<?php

    if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    
    class Image_manager_model extends CI_Model
    {
        
        public $web_content_id;
        
        /**
            @name: get_web_content_image()
            @uses: Get the web content image
         */
        public function get_web_content_image()
        {
            $this->db->where('web_content_id', $this->web_content_id);
            $result = $this->db->get('image_manager');
            return $result->result_array();
        }
        
    }

?>