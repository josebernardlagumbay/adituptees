<?php

	if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	class Order_model extends CI_Model
	{
		
		public $order_code;
		public $orderid;
		public $order_detail_id;
		
		/**
			@name: get_order()
			@uses: Get the order information
		*/
		public function get_order()
		{
			$this->db->where('order_code', $this->order_code);
			$result = $this->db->get('order');
			return $result->result_array();
		}
		
		/**
			@name: get_order_details()
			@uses: Get the order details
		*/
		public function get_order_details()
		{
			$this->db->where('order_detail.order_id', $this->orderid);
			$result = $this->db->get('order_detail');
			return $result->result_array();
		}
		
		/**
			@name: get_order_sizes()
			@uses: Get the order sizes
		*/
		public function get_order_sizes()
		{
			$this->db->where('order_size.order_detail_id', $this->order_detail_id);
			$result = $this->db->get('order_size');
			return $result->result_array();
		}
		
	}

?>