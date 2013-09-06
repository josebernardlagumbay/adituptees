<?php

if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Utility 
{
	
	function Utility()
	{
		
	}
	
	/*
		@name: display_short_content()
		@uses: Display the content for the number of words specified
	*/
	public function display_short_content($content)
	{
		$position=700; // Define how many characters you want to display.
		// Find what is the last character.
		$post = substr($content,$position,1);

		// In this step, if the last character is not " "(space) run this code.
		// Find until we found that last character is " "(space)
		// by $position+1 (14+1=15, 15+1=16 until we found " "(space) that mean character no.20)
		if($post !=" "){
			while($post !=" "){
				$i=1;
				$position=$position+$i;
				$post = substr($content,$position,1);
			}
		}
		$post = substr($content,0,$position);
		return $post.'...';
	}
	
	/*
		@name: display_short_content_sidebar()
		@uses: Display the content for the number of words specified
	*/
	public function display_short_content_sidebar($content)
	{
		$position=30; // Define how many characters you want to display.
		// Find what is the last character.
		$post = substr($content,$position,1);

		// In this step, if the last character is not " "(space) run this code.
		// Find until we found that last character is " "(space)
		// by $position+1 (14+1=15, 15+1=16 until we found " "(space) that mean character no.20)
		if($post !=" "){
			while($post !=" "){
				$i=1;
				$position=$position+$i;
				$post = substr($content,$position,1);
			}
		}
		$post = substr($content,0,$position);
		return $post.'...';
	}
	
	function reformatDate($date, $format_index=4) 	
	{
		if ($date) {                                                                    
			$dateformat = array(0=>'F d, Y',1=>'d M Y',2=>'d M Y',3=>'Y-m-d H:i:s',4=>'Y-m-d',5=>'Y-m-d H:i:s',6=>'Y-m-d H:i:s',7=>'mdY', 8=> 'M d', 9=> 'M d Y', 10=> 'm/d/Y H:i:s');
			
			if ($format_index==5) {
				// start time
				$tmp = strtotime($date);
				$format=$dateformat[4];
				$starttime = date($format,$tmp)." 00:00:00";
				
				$format=$dateformat[$format_index];
				$date = strtotime($starttime);
				return date($format,$date);
			} else if ($format_index==6) {
				// end time
				$tmp = strtotime($date);
				$format=$dateformat[4];
				$starttime = date($format,$tmp)." 23:59:59";
				
				$format=$dateformat[$format_index];
				$date = strtotime($starttime);
				return date($format,$date);
			} else if ($format_index==7) {
				$format=$dateformat[7];
				
				$date = strtotime($date);
				return date($format,$date);
			} else {
			
				$format=$dateformat[$format_index];
				
				$date = strtotime($date);
				return date($format,$date);
			}
		} else {
			return 0;
		}
	}
	
	function month()
  	{
  		$monthly = array(
			0=>array(
				"id"=>"01",
				"name"=>"January",
				"days"=>"31",
			),
			1=>array(
				"id"=>"02",
				"name"=>"February",
				"days"=>"29",
			),
			2=>array(
				"id"=>"03",
				"name"=>"March",
				"days"=>"31",
			),
			3=>array(
				"id"=>"04",
				"name"=>"April",
				"days"=>"30",
			),
			4=>array(
				"id"=>"05",
				"name"=>"May",
				"days"=>"31",
			),
			5=>array(
				"id"=>"06",
				"name"=>"June",
				"days"=>"30",
			),
			6=>array(
				"id"=>"07",
				"name"=>"July",
				"days"=>"31",
			),
			7=>array(
				"id"=>"08",
				"name"=>"August",
				"days"=>"31",
			),
			8=>array(
				"id"=>"09",
				"name"=>"September",
				"days"=>"30",
			),
			9=>array(
				"id"=>"10",
				"name"=>"October",
				"days"=>"31",
			),
			10=>array(
				"id"=>"11",
				"name"=>"November",
				"days"=>"30",
			),
			11=>array(
				"id"=>"12",
				"name"=>"December",
				"days"=>"31",
			),
		);
		
		return $monthly;
  	}
  	
  	function year()
  	{
  		for($year = date("Y")+ 10; $year >= date("Y"); $year--){
  			$yeararray[] = array(
  					"id"=> $year,
  					"name"=> $year,
  			);
  		}
  		return $yeararray;
  	}
	
	function checkEmail( $email ){
	    return filter_var( $email, FILTER_VALIDATE_EMAIL );
	}
	
}

?>