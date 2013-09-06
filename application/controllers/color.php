<?php

	if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	class Color extends CI_Controller
	{
		
		/*
			@name: list_color()
			@uses: Page for list of colors
		*/
		public function list_color()
		{
			if(!$this->session->userdata('key') && $this->session->userdata('accounttype') != md5('ADMIN'))
				redirect(site_url('admin'));
				
			// Get the colors
			$color = new Generalmodel();
			$color->tables = 'color';
			$color->orderby = 'color_name ASC';
			$color->datalist();
			$data['color'] = $color->result;
				
			$this->load->view('admin/header');
			$this->load->view('color/list', $data);
			$this->load->view('admin/footer');
		}
		
		/*
			@name: add()
			@uses: Add new color
		*/
		public function add()
		{
			if(!$this->session->userdata('key') && $this->session->userdata('accounttype') != md5('ADMIN'))
				redirect(site_url('admin'));
				
			$this->load->view('admin/header');
			$this->load->view('color/add');
			$this->load->view('admin/footer');
		}
		
		/*
			@name: save()
			@uses: Save the color information
		*/
		public function save()
		{
			if(!$this->session->userdata('key') && $this->session->userdata('accounttype') != md5('ADMIN'))
				redirect(site_url('admin'));
				
			// Save the color information
			$color = new Generalmodel();
			$tabledata = array(
				'color_id' => uniqid(),
				'color_name' => $this->input->post('color_name')
			);
			$color->tables = 'color';
			$color->tabledata = $tabledata;
			$color->save();
			$issave = $color->result;
			
			if($issave){
				redirect(site_url('message/color/save/success'));
			} else {
				redirect(site_url('message/color/save/error'));
			}
		}
		
		/*
			@name: edit()
			@uses: Edit page for color
		*/
		public function edit()
		{
			if(!$this->session->userdata('key') && $this->session->userdata('accounttype') != md5('ADMIN'))
				redirect(site_url('admin'));
				
			if(!$this->uri->segment(3))
				redirect(site_url('admin'));
				
			// Get the color information
			$color = new Generalmodel();
			$conditions = array(
				'color_id' => $this->uri->segment(3)
			);
			$color->tables = 'color';
			$color->conditions = $conditions;
			$color->getrecordinformation();
			$data['color'] = $color->result;
				
			$this->load->view('admin/header', $data);
			$this->load->view('color/edit');
			$this->load->view('admin/footer');
		}
		
		/*
			@name: update()
			@uses: Update the color information
		*/
		public function update()
		{
			if(!$this->session->userdata('key') && $this->session->userdata('accounttype') != md5('ADMIN'))
				redirect(site_url('admin'));
				
			if(!$this->uri->segment(3))
				redirect(site_url('admin'));
				
			// Save the color information
			$color = new Generalmodel();
			$tabledata = array(
				'color_name' => $this->input->post('color_name')
			);
			$conditions = array(
				'color_id' => $this->uri->segment(3)
			);
			$color->tables = 'color';
			$color->tabledata = $tabledata;
			$color->conditions = $conditions;
			$color->update();
			$issave = $color->result;
			
			if($issave){
				redirect(site_url('message/color/update/success'));
			} else {
				redirect(site_url('message/color/update/error'));
			}
		}
		
		/*
			@name: delete()
			@uses: Delete the size information
		*/
		public function delete()
		{
			// Delete the color
			$color = new Generalmodel();
			$conditions = array(
				'key' => $this->input->post('key')
			);
			$color->tables = 'color';
			$color->conditions = $conditions;
			$color->delete();
		}
		
		/*
			@name: is_exist()
			@uses: Check if color is exist
		*/
		public function is_exist()
		{
			$color = new Generalmodel();
			if($this->input->post('key')){
				$conditions = array(
					'color_id !=' => $this->input->post('key'),
					'color_name' => $this->input->post('color_name')
				);
			} else {
				$conditions = array(
					'color_name' => $this->input->post('color_name')
				);
			}
			
			$color->tables = 'color';
			$color->conditions = $conditions;
			$color->getrecordinformation();
			$isexist = $color->numrows;
			
			if($isexist){
				echo 'EXIST';
			} else {
				echo 'NOT EXIST';
			}
		}
	}

?>