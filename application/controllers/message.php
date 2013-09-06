<?php

	if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	class Message extends CI_Controller
	{
		
		/**
			@name: social_media_accounts()
			@uses: Message for social media accounts
		*/
		public function social_media_accounts()
		{
			$action = $this->uri->segment(3);
			$result = $this->uri->segment(4);
			
			if($action == 'save'){
				$data['message_title'] = 'Save Social Media Account';
				
				if($result == 'success'){
					$data['message_subtitle'] = 'Success Save';
					$data['color_control'] = 'alert-success';
					$data['message_detail'] = 'Social Media Account was successfully saved.';
				} elseif($result == 'error'){
					$data['message_subtitle'] = 'Error Save';
					$data['color_control'] = 'alert-error';
					$data['message_detail'] = 'There was an error found in saving the Social Media Account. Please try again.';
				} elseif($result == 'error_upload'){
					$data['message_subtitle'] = 'Error Upload';
					$data['color_control'] = 'alert-info';
					$data['message_detail'] = 'Invalid image filename upload. Please try again.';
				}
			} elseif($action == 'update'){
				$data['message_title'] = 'Update Social Media Account';
				
				if($result == 'success'){
					$data['message_subtitle'] = 'Success Save';
					$data['color_control'] = 'alert-success';
					$data['message_detail'] = 'Social Media Account was successfully updated.';
				} elseif($result == 'error'){
					$data['message_subtitle'] = 'Error Save';
					$data['color_control'] = 'alert-error';
					$data['message_detail'] = 'There was an error found in updating the Social Media Account. Please try again.';
				} 
			}
			
			$this->load->view('admin/header', $data);
			$this->load->view('admin/message');
			$this->load->view('admin/footer');
			
		}
		
		/**
			@name: web_content()
			@uses: Message for the web content
		*/
		public function web_content()
		{
			$action = $this->uri->segment(3);
			$result = $this->uri->segment(4);
			
			if($action == 'save'){
				$data['message_title'] = 'Save Web Content';
				
				if($result == 'success'){
					$data['message_subtitle'] = 'Success Save';
					$data['color_control'] = 'alert-success';
					$data['message_detail'] = 'Web Content was successfully saved.';
				} elseif($result == 'error'){
					$data['message_subtitle'] = 'Error Save';
					$data['color_control'] = 'alert-error';
					$data['message_detail'] = 'There was an error found in saving the Web Content. Please try again.';
				} elseif($result == 'error_upload'){
					$data['message_subtitle'] = 'Error Upload';
					$data['color_control'] = 'alert-info';
					$data['message_detail'] = 'Invalid image filename upload. Please try again.';
				}
			} elseif($action == 'update'){
				$data['message_title'] = 'Update Web Content';
				
				if($result == 'success'){
					$data['message_subtitle'] = 'Success Save';
					$data['color_control'] = 'alert-success';
					$data['message_detail'] = 'Web Content was successfully updated.';
				} elseif($result == 'error'){
					$data['message_subtitle'] = 'Error Save';
					$data['color_control'] = 'alert-error';
					$data['message_detail'] = 'There was an error found in updating the Web Content. Please try again.';
				} 
			}
			
			$this->load->view('admin/header', $data);
			$this->load->view('admin/message');
			$this->load->view('admin/footer');
		}
		
		/**
			@name: image_manager()
			@uses: Message for the image manager
		*/
		public function image_manager()
		{
			$action = $this->uri->segment(3);
			$result = $this->uri->segment(4);
			
			if($action == 'upload'){
				$data['message_title'] = 'Upload Image';
				
				if($result == 'success'){
					$data['message_subtitle'] = 'Success Upload';
					$data['color_control'] = 'alert-success';
					$data['message_detail'] = 'Web Content Image was successfully uploaded.';
				} elseif($result == 'error'){
					$data['message_subtitle'] = 'Error Upload';
					$data['color_control'] = 'alert-error';
					$data['message_detail'] = 'There was an error found in uploading the Web Content Image. Please try again.';
				} elseif($result == 'error_upload'){
					$data['message_subtitle'] = 'Error Upload';
					$data['color_control'] = 'alert-info';
					$data['message_detail'] = 'Invalid image filename upload. Please try again.';
				}
			} 
			
			$this->load->view('admin/header', $data);
			$this->load->view('admin/message');
			$this->load->view('admin/footer');
		}
		
		/**
			@name: logo_manager()
			@uses: Message for the logo manager
		*/
		public function logo_manager()
		{
			$action = $this->uri->segment(3);
			$result = $this->uri->segment(4);
			
			if($action == 'upload'){
				$data['message_title'] = 'Upload Logo';
				
				if($result == 'success'){
					$data['message_subtitle'] = 'Success Upload';
					$data['color_control'] = 'alert-success';
					$data['message_detail'] = 'Logo was successfully uploaded.';
				} elseif($result == 'error'){
					$data['message_subtitle'] = 'Error Upload';
					$data['color_control'] = 'alert-error';
					$data['message_detail'] = 'There was an error found in uploading the Logo. Please try again.';
				} elseif($result == 'error_upload'){
					$data['message_subtitle'] = 'Error Upload';
					$data['color_control'] = 'alert-info';
					$data['message_detail'] = 'Invalid image filename upload. Please try again.';
				}
			} 
			
			$this->load->view('admin/header', $data);
			$this->load->view('admin/message');
			$this->load->view('admin/footer');
		}
		
		/**
			@name: banner_manager()
			@uses: Message for the banner manager
		*/
		public function banner_manager()
		{
			$action = $this->uri->segment(3);
			$result = $this->uri->segment(4);
			
			if($action == 'upload'){
				$data['message_title'] = 'Upload Banner';
				
				if($result == 'success'){
					$data['message_subtitle'] = 'Success Upload';
					$data['color_control'] = 'alert-success';
					$data['message_detail'] = 'Banner was successfully uploaded.';
				} elseif($result == 'error'){
					$data['message_subtitle'] = 'Error Upload';
					$data['color_control'] = 'alert-error';
					$data['message_detail'] = 'There was an error found in uploading the Banner. Please try again.';
				} elseif($result == 'error_upload'){
					$data['message_subtitle'] = 'Error Upload';
					$data['color_control'] = 'alert-info';
					$data['message_detail'] = 'Invalid image filename upload. Please try again.';
				}
			} 
			
			$this->load->view('admin/header', $data);
			$this->load->view('admin/message');
			$this->load->view('admin/footer');
		}
		
		/**
			@name: products()
			@uses: Message for the products
		*/
		public function products()
		{
			$action = $this->uri->segment(3);
			$result = $this->uri->segment(4);
			
			if($action == 'save'){
				$data['message_title'] = 'Save Product';
				
				if($result == 'success'){
					$data['message_subtitle'] = 'Save Success';
					$data['color_control'] = 'alert-success';
					$data['message_detail'] = 'Product successfully saved.';
				} elseif($result == 'error'){
					$data['message_subtitle'] = 'Error';
					$data['color_control'] = 'alert-error';
					$data['message_detail'] = 'There was an error found in saving the Product. Please try again.';
				} elseif($result == 'error_upload'){
					$data['message_subtitle'] = 'Error Upload';
					$data['color_control'] = 'alert-info';
					$data['message_detail'] = 'Invalid image filename upload. Please try again.';
				}
			} else if($action == 'update'){
				$data['message_title'] = 'Update Product';
				
				if($result == 'success'){
					$data['message_subtitle'] = 'Update Success';
					$data['color_control'] = 'alert-success';
					$data['message_detail'] = 'Product successfully updated.';
				} elseif($result == 'error'){
					$data['message_subtitle'] = 'Error';
					$data['color_control'] = 'alert-error';
					$data['message_detail'] = 'There was an error found in updating the Product. Please try again.';
				}
			} else if($action == 'save-designs'){
				$data['message_title'] = 'Upload Product Design';
				
				if($result == 'success'){
					$data['message_subtitle'] = 'Upload Success';
					$data['color_control'] = 'alert-success';
					$data['message_detail'] = 'Product Design successfully uploaded.';
				} elseif($result == 'error'){
					$data['message_subtitle'] = 'Error Upload';
					$data['color_control'] = 'alert-error';
					$data['message_detail'] = 'There was an error found in uploading the Product Design. Please try again.';
				}
			}
			
			$this->load->view('admin/header', $data);
			$this->load->view('admin/message');
			$this->load->view('admin/footer');
		}

        /**
            @name: add_content()
            @uses: Message for the add web content
        */
        public function add_content()
        {
            $action = $this->uri->segment(3);
            $result = $this->uri->segment(4);
            
            if($action == 'save'){
                $data['message_title'] = 'Save Web Content';
                
                if($result == 'success'){
                    $data['message_subtitle'] = 'Success Save';
                    $data['color_control'] = 'alert-success';
                    $data['message_detail'] = 'Web Content was successfully added.';
                } elseif($result == 'error'){
                    $data['message_subtitle'] = 'Error Save';
                    $data['color_control'] = 'alert-error';
                    $data['message_detail'] = 'There was an error found in adding the Web Content. Please try again.';
                } 
            } 
            
            $this->load->view('admin/header', $data);
            $this->load->view('admin/message');
            $this->load->view('admin/footer');
        }
		
		/**
			@name: category()
			@uses: Message for category
		*/
		public function category()
		{
			$action = $this->uri->segment(3);
            $result = $this->uri->segment(4);
            
            if($action == 'save-cover-template'){
                $data['message_title'] = 'Save Web Content';
                
                if($result == 'success'){
                    $data['message_subtitle'] = 'Success Save';
                    $data['color_control'] = 'alert-success';
                    $data['message_detail'] = 'Cover template was successfully saved.';
                } elseif($result == 'error'){
                    $data['message_subtitle'] = 'Error Save';
                    $data['color_control'] = 'alert-error';
                    $data['message_detail'] = 'There was an error found in saving the Cover Template. Please try again.';
                } 
            } 
            
            $this->load->view('admin/header', $data);
            $this->load->view('admin/message');
            $this->load->view('admin/footer');
		}
		
		/**
			@name: brand()
			@uses: Message for brand
		*/
		public function brand()
		{
			$action = $this->uri->segment(3);
            $result = $this->uri->segment(4);
            
            if($action == 'save'){
                $data['message_title'] = 'Save Brand';
                
                if($result == 'success'){
                    $data['message_subtitle'] = 'Success Save';
                    $data['color_control'] = 'alert-success';
                    $data['message_detail'] = 'Brand was successfully saved.';
                } elseif($result == 'error'){
                    $data['message_subtitle'] = 'Error Save';
                    $data['color_control'] = 'alert-error';
                    $data['message_detail'] = 'There was an error found in saving the Brand. Please try again.';
                } 
            } 
            
            $this->load->view('admin/header', $data);
            $this->load->view('admin/message');
            $this->load->view('admin/footer');
		}
		
	}

?>