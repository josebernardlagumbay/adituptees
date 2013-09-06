<?php

    if ( ! defined('BASEPATH')) exit('No direct script access allowed');
    
    class Meal_plan_model extends CI_Model
    {
        public $meal_plan_id;
        
        /**
            @name: get_non_free()
            @uses: Get the non free meal plan
         */
        public function get_non_free()
        {
            $this->db->where('free_plan','no');
            $this->db->where('status','active');
            $this->db->join('unit_measure','unit_measure.unit_measure_id = meal_plan.unit_measure_id');
            $result = $this->db->get('meal_plan');
            return $result->result_array();
        }
        
        /**
            @name: get_free()
            @uses: Get the free meal plan
         */
        public function get_free()
        {
            $this->db->where('free_plan','yes');
            $this->db->where('status','active');
            $this->db->join('unit_measure','unit_measure.unit_measure_id = meal_plan.unit_measure_id');
            $result = $this->db->get('meal_plan');
            return $result->result_array();
        }
        
        /**
            @name: get_meal_plan_info()
            @uses: Get the meal plan information
         */
        public function get_meal_plan_info()
        {
            $this->db->where('meal_plan_id', $this->meal_plan_id);
            $this->db->join('unit_measure','unit_measure.unit_measure_id = meal_plan.unit_measure_id');
            $result = $this->db->get('meal_plan');
            return $result->result_array();
        }
        
		/**
			@name: get_meal_plan_package()
			@uses: Get the meal plan package selected
		*/
		public function get_meal_plan_package()
		{
			$this->db->where('order.account_id', $this->session->userdata('key'));
			$this->db->where('order.status','paid');
			$this->db->where('order.serve_status','on-going');
			$this->db->join('meal_plan','meal_plan.meal_plan_id = order.meal_plan_id');
			$result = $this->db->get('order');
			return $result->result_array();
		}
    }

?>