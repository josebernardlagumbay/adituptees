<?php

	if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	class Zipcode extends CI_Controller
	{
		
		/**
			@name: validate()
			@uses: Validate the zip code
		*/
		public function validate()
		{
			$zipcode = new Generalmodel();
			$conditions = array(
				'zip' => $this->input->post('zipcode')
			);
			$zipcode->tables = 'zipcodes';
			$zipcode->conditions = $conditions;
			$zipcode->getrecordinformation();
			$zipcode_info = $zipcode->result;
			$is_exist = $zipcode->numrows;
			
			if($is_exist){
				echo $zipcode_info[0]['state'];
			} else {
				echo 'NOT EXIST';
			}
		}
		
	}

?>