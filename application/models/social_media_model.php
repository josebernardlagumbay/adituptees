<?php

    if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    
    class Social_media_model extends CI_Model
    {
        
        /**
            @name: get_social_media()
            @uses: Get the social media icons and links
         */
        public function get_social_media()
        {
            $this->db->where('status','display');
            $result = $this->db->get('social_media');
            return $result->result_array();
        }
        
    }

?>