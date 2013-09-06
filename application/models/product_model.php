<?php

	if ( ! defined('BASEPATH')) exit('No direct script access allowed');  
	
	class Product_model extends CI_Model
	{
		
		public $category_id;
		public $product_title;
		public $product_description;
		public $product_keywords;
		public $product_url;
		public $product_id;
		public $product_type_id;
		
		public $totalrecords;
		public $limit;
		public $offset;
		public $result;
		
		
		
		/**
			@name: product_search_count()
			@uses: Search for the product
		*/
		public function product_search_count()
		{
			if($this->category_id)
				$this->db->where('products.category_id', $this->category_id);
				
			if($this->product_title)
				$this->db->like('products.product_title', $this->product_title);
				
			if($this->product_description)
				$this->db->like('products.product_description', $this->product_description);
				
			if($this->product_keywords)	
				$this->db->like('products.product_keywords', $this->product_keywords);
				
			$this->db->from('products');
            $this->totalrecords = $this->db->count_all_results();
		}
		
		/**
			@name: product_search()
			@uses: Search the products
		*/
		public function product_search()
		{
			if($this->category_id)
				$this->db->where('products.category_id', $this->category_id);
				
			if($this->product_title)
				$this->db->like('products.product_title', $this->product_title);
				
			if($this->product_description)
				$this->db->like('products.product_description', $this->product_description);
				
			if($this->product_keywords)	
				$this->db->like('products.product_keywords', $this->product_keywords);
			
			$result = $this->db->get('products',$this->limit, $this->offset);
            $this->result = $result->result_array();
		}
		
		/**
			@name: get_product_type()
			@uses: Get the product type
		*/
		public function get_product_type()
		{
			$result = $this->db->get('product_type');
			return $result->result_array();
		}
		
		/**
			@name: get_product_deal()
			@used: Get the product for deal
		*/
		public function get_product_deal()
		{
			$this->db->where('is_deal','yes');
			$result = $this->db->get('products');
			return $result->result_array();
		}
		
		/**
			@name: get_product_demand()
			@uses: Get the product that are on demand
		*/
		public function get_product_demand()
		{
			$this->db->where('product_type_id','51c26af3d09ab'); // On demand items
			$result = $this->db->get('products',15);
			return $result->result_array();
		}
		
		/**
			@name: get_product_new_design_home()
			@uses: Get the new product design
		*/
		public function get_product_new_design_home()
		{
			$this->db->where('product_type_id', '51c232a39f015'); // New designs
			$this->db->order_by('product_id DESC');
			$result = $this->db->get('products',10);
			return $result->result_array();
		}
		
		/**
			@name: get_product_featured_designs()
			@uses: Get the featured product designs
		*/
		public function get_product_featured_designs()
		{
			$this->db->where('product_type_id', '51c232cb26301'); // Featured Stock Designs
			$this->db->order_by('product_id DESC');
			$result = $this->db->get('products',10);
			return $result->result_array();
		}
		
		/**
			@name: get_product_type_info()
			@uses: Get the product type info
		*/
		public function get_product_type_info()
		{
			$this->db->where('product_type_id', $this->product_type_id); // Featured Stock Designs
			$result = $this->db->get('product_type');
			return $result->result_array();
		}
		
		/**
			@name: get_product_on_sale()
			@uses: Get the product on sale
		*/
		public function get_product_on_sale()
		{
			$this->db->where('product_type_id', '51c25d568077c'); // On Sale Items
			$this->db->order_by('product_id DESC');
			$result = $this->db->get('products',10);
			return $result->result_array();
		}
		
		/**
			@name: get_product_info()
			@uses: Get the product information
		*/
		public function get_product_info()
		{
			$this->db->where('product_id', $this->product_id);
			$this->db->join('product_type','product_type.product_type_id = products.product_type_id');
			$this->db->join('category','category.category_id = products.category_id');
			$result = $this->db->get('products');
			return $result->result_array();
		}
		
		/**
			@name: get_product_sizes()
			@uses: Get the product sizes
		*/
		public function get_product_sizes()
		{
			$this->db->where('product_id', $this->product_id);
			$this->db->join('size','size.size_id = product_size.size_id');
			$result = $this->db->get('product_size');
			return $result->result_array();
		}
		
		/**
			@name: get_related_product_according_to_category()
			@uses: Get the related product according to category
		*/
		public function get_related_product_according_to_category()
		{
			$this->db->where('category_id', $this->category_id);
			$this->db->order_by('product_id DESC');
			$result = $this->db->get('products',15);
			return $result->result_array();
		}
		
		/**
			@name: get_product_according_to_product_type()
			@uses: Get the related product according to product type
		*/
		public function get_product_according_to_product_type()
		{
			$this->db->where('product_type_id', $this->product_type_id);
			$this->db->order_by('product_id DESC');
			$result = $this->db->get('products');
			return $result->result_array();
		}
		
		/**
			@name: get_all_items()
			@uses: Get all the items
		*/
		public function get_all_items()
		{
			$this->db->order_by('product_id DESC');
			$result = $this->db->get('products');
			return $result->result_array();
		}
	}

?>