<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Favorite_res extends CI_Controller {
	
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

				$data['favourites_res_ids'] = $this->common_model->get_data_by_id(array('user_id'=>$this->customer_id),'fav_restaurants','restaurant_id')[0];
				 
				$get_fav_res = $this->common_model->get_specific_fileds_by(array('id'=>$data['favourites_res_ids']['restaurant_id']),'kitchens');
				

                $all_favorite_restaurant = get_all_fav_res_by_users($this->customer_id);
				$data['current_location'] 	= $current_location;
				$data['restaurants'] 	= $all_favorite_restaurant;
				$data['sidebar']= 'my_account/sidebar';
				$data['page'] 	= 'my_account/favourites';
				$data['view'] 	= 'my_account/index';
				$this->load->view('layout',$data);
			} 
		}

	}
	function remove_fav_res(){
      	$restaurant_id		= $this->input->post('restaurant_id');
		$user_id 			= $this->customer_id; 
        
		$result = $this->common_model->delete_data('fav_restaurants',array('user_id'=>$user_id,'restaurant_id'=>$restaurant_id));

		$msg = '';
        if ($result) {
        	$msg .= "Favorite restaurant delete successful";
        } else {
        	$msg .= "ERROR";
        }
        
		echo $msg;
		exit();
	}
}

?>	