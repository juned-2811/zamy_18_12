<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Favorite_food extends CI_Controller {
	
	function __construct() {
		parent::__construct();
		$this->load->model('Common_model','common_model');
		$this->customer_id 	= $this->session->userdata('cust_id');
	} 

	function index($res_name=null) {
		if(empty($this->session->has_userdata('location'))){
			redirect(base_url(), 'refresh');
		}
		if(empty($res_name)){
			if($this->input->post('search_location')){
				$this->form_validation->set_rules('location', 'location', 'trim|required');
			
				if ($this->form_validation->run() == FALSE) {
					$this->load->view('home/add_location');
				}else {
					$location = $this->input->post('location');

					$user_data = array(
						'location' 	=> $location
					);
					
					$this->session->set_userdata($user_data);
					redirect(base_url('restaurants'), 'refresh');
				}
			}else{
				if(empty($this->session->has_userdata('location'))){
					redirect(base_url(), 'refresh');
				}
				
				$current_location = $this->session->userdata('location');

                $all_favorite_food = get_all_fav_food_by_users($this->customer_id);

				$data['current_location'] 	= $current_location;
				$data['food'] 	= $all_favorite_food;
				$data['sidebar']= 'my_account/sidebar';
				$data['page'] 	= 'my_account/favourites_food';
				$data['view'] 	= 'my_account/index';
				$this->load->view('layout',$data);
			} 
		}
	}

	function remove_fav_food(){
      	$foodmenu_id		= $this->input->post('foodmenu_id');
		$user_id 			= $this->customer_id; 
        
		$result = $this->common_model->delete_data('favorite_food',array('user_id'=>$user_id,'foodmenu_id'=>$foodmenu_id));

		$msg = '';
        if ($result) {
        	$msg .= "Food is Successfully removed from favorite";
        } else {
        	$msg .= "ERROR";
        }
        echo $msg;
        exit();   
	}
}

?>	