<?php

	if ( ! defined('BASEPATH')) exit('No direct script access allowed');
	
	class Post extends CI_Controller
	{
		
		
		/**
			@name: read()
			@uses: Display the content
		*/
		public function read()
		{
			// Load the model
			$this->load->model('Menu_model');
			$this->load->model('Product_model');
			$this->load->model('Category_model');
			$this->load->model('Settings_model');
			$this->load->model('Social_media_model');
			$this->load->model('Content_model');
			
			// Get the menu for header
			$data['header_menu'] = $this->Menu_model->get_menu_header();
			$data['footer_menu'] = $this->Menu_model->get_menu_footer();
            
            // Get the social media icons and links
            $this->load->model('Social_media_model');
            $data['social_media'] = $this->Social_media_model->get_social_media();
            
            // Get the current advertisement
            $this->load->model('Ads_model');
            $data['ads'] = $this->Ads_model->get_latest_ads();
            
			// Get the content
			$this->Content_model->web_content_url = $this->uri->segment(3);
			$web_content_info = $data['web_content'] = $this->Content_model->get_content_page();
			
			// Check if page has image
			$this->Content_model->web_content_id = $web_content_info[0]['web_content_id'];
			$content_image = $this->Content_model->check_content_image();
			
            $data['menu_link_content'] = '';
            if($web_content_info[0]['web_content_type'] == 'menu link'){
                // Get the content belong to the web content menu link
                $this->Content_model->web_content_id = $web_content_info[0]['web_content_id'];
                $menu_link_content = $this->Content_model->get_menu_link_content();
                
                // Get the images for web content only
                // Load the image manager model
                $this->load->model('Image_manager_model');
                if($menu_link_content){
                    $image_manager = new Generalmodel();
                    foreach($menu_link_content as $list){
                        $this->Image_manager_model->web_content_id = $list['web_content_detail_id'];
                        $image = $this->Image_manager_model->get_web_content_image();
                        if($image){
                            $image_content = $image[0]['image_display'];
                        } else {
                            $image_content = '';
                        }
                        $link_content = array(
                            'web_content_name' => $list['web_content_name'],
                            'full_content' => $list['full_content'],
                            'image' => $image_content,
                        );
                        $content[] = $link_content;
                    }
                }
                
                $data['menu_link_content'] = $content;
            }
            
			$data['has_image'] = 0;
			if($content_image){
				$data['has_image'] = 1;
				$data['content_image'] = $content_image;
			} 
			
			// Get the menu
            $data['header_menu'] = $this->Menu_model->get_menu_header();
            $data['footer_menu'] = $this->Menu_model->get_menu_footer();
			
			// Get the social media
			$data['social_media'] = $this->Social_media_model->get_social_media();
			
			// Get the current currency used
			$data['currency'] = $this->Settings_model->get_currency();
			
			// Get the product type
			$data['type'] = $this->Product_model->get_product_type();
			
			// Get the product deal
			$data['deal'] = $this->Product_model->get_product_deal();
			
			// Get the categories
			$data['category'] = $this->Category_model->get_categories();
			
			// Get the on demand items
			$data['demand'] = $this->Product_model->get_product_demand();
			
			$this->load->view('header', $data);
			$this->load->view('left');
			$this->load->view('web_content/read');
			$this->load->view('footer');
		}
		
	}

?>