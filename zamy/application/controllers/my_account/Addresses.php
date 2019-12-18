<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Addresses extends CI_Controller {
	
	function __construct() {
		parent::__construct();
		$this->load->model('common_model');
		$this->customer_id 	= $this->session->userdata('cust_id');
	}
	
	public function index(){
		is_login();
		
		$req_param['conditions'] = array('user_id'=>$this->customer_id);
		$address_book = $this->common_model->getRows('address_book',$req_param);
		
		$data['address_book']	= $address_book;
		$data['sidebar']		= 'my_account/sidebar';
		$data['page'] 			= 'my_account/addresses';
		$data['view'] 			= 'my_account/index';
		$this->load->view('layout',$data);
	}
	
	public function add(){
		is_login();
		
		if($this->input->post('add_address')){
			
		 
			$this->form_validation->set_rules('name', 'Name', 'trim|required');
			$this->form_validation->set_rules('email', 'Email', 'trim|required');
			$this->form_validation->set_rules('phone', 'Phone', 'trim|required');
			/* $this->form_validation->set_rules('shipping_area', 'Shipping Area', 'trim|required'); */
			$this->form_validation->set_rules('address_1', 'Address 1', 'trim|required');
			$this->form_validation->set_rules('country', 'Country', 'trim|required');
			$this->form_validation->set_rules('state', 'State', 'trim|required');
			$this->form_validation->set_rules('city', 'City', 'trim|required');
			$this->form_validation->set_rules('postcode', 'Postcode', 'trim|required');
			$this->form_validation->set_rules('address_lat', 'latitude', 'trim|required');
			$this->form_validation->set_rules('address_lng', 'longitude', 'trim|required');
			$this->form_validation->set_rules('address_type', 'Address Type', 'trim|required');
		 
			if ($this->form_validation->run() == FALSE) {
				$errors = validation_errors();
			 
				echo json_encode(['validation_errors'=>$errors]);
				redirect('my_account/addresses/add');
			}else{
				
				$data['user_id'] 		= $this->customer_id;
				$data['name'] 			= $this->input->post('name');
				$data['email'] 			= $this->input->post('email');
				$data['phone'] 			= $this->input->post('phone');
				//$data['shipping_area'] 	= $this->input->post('shipping_area');
				$data['map_address'] 		= $this->input->post('map_address');
				$data['address_1'] 		= $this->input->post('address_1');
				if(!empty($this->input->post('address_2'))){
					$data['address_2'] 	= $this->input->post('address_2');
				}
				$data['country'] 		= $this->input->post('country');
				$data['state'] 			= $this->input->post('state');
				$data['city'] 			= $this->input->post('city');
				$data['postcode'] 		= $this->input->post('postcode');
				$data['address_lat'] 	= $this->input->post('address_lat');
				$data['address_lng'] 	= $this->input->post('address_lng');
				$data['address_type'] 	= $this->input->post('address_type');
				if(!empty($this->input->post('other_address_type'))){
					$data['other_address_type'] 	= $this->input->post('other_address_type');
				}
				$data['updated_date'] 	= date('Y-m-d h:i:s');
				
				$data 	= $this->security->xss_clean($data); 
				 
				$result = $this->common_model->add_data('address_book', $data);
				if($result){
					$this->session->set_flashdata('msg', 'Address Added Successfully!');
					echo json_encode(['message'=>1]);
					
					if(!empty($this->input->post('current_url')) && $this->input->post('current_url')=='checkout'){
						redirect(base_url('checkout'));
					}else{
						redirect('my_account/addresses');
					} 
				}
			} 
		}else{
				
			$data['form_url']	= 'my_account/addresses/add';
			$data['title']		= 'Add New Address';
			$data['sidebar']	= 'my_account/sidebar';
			$data['page'] 		= 'my_account/add_edit_address';
			$data['view'] 		= 'my_account/index';
			$this->load->view('layout',$data);
		}
	}
	
	public function edit($id){
		is_login();
		
		if($this->input->post('add_address')){
			
			$this->form_validation->set_rules('name', 'Name', 'trim|required');
			$this->form_validation->set_rules('email', 'Email', 'trim|required');
			$this->form_validation->set_rules('phone', 'Phone', 'trim|required');
			//$this->form_validation->set_rules('shipping_area', 'Shipping Area', 'trim|required');
			$this->form_validation->set_rules('address_1', 'Address 1', 'trim|required');
			$this->form_validation->set_rules('country', 'Country', 'trim|required');
			$this->form_validation->set_rules('state', 'State', 'trim|required');
			$this->form_validation->set_rules('city', 'City', 'trim|required');
			$this->form_validation->set_rules('postcode', 'Postcode', 'trim|required');
			$this->form_validation->set_rules('address_lat', 'latitude', 'trim|required');
			$this->form_validation->set_rules('address_lng', 'longitude', 'trim|required');
			
			if ($this->form_validation->run() == FALSE) {
				$errors = validation_errors();
				echo json_encode(['validation_errors'=>$errors]);
				redirect('my_account/addresses/add');
			}else{
				
				$data['name'] 			= $this->input->post('name');
				$data['email'] 			= $this->input->post('email');
				$data['phone'] 			= $this->input->post('phone');
				//$data['shipping_area']= $this->input->post('shipping_area');
				$data['map_address'] 	= $this->input->post('map_address');
				$data['address_1'] 		= $this->input->post('address_1');
				if(!empty($this->input->post('address_2'))){
					$data['address_2'] 	= $this->input->post('address_2');
				}
				$data['country'] 		= $this->input->post('country');
				$data['state'] 			= $this->input->post('state');
				$data['city'] 			= $this->input->post('city');
				$data['postcode'] 		= $this->input->post('postcode');
				$data['address_lat'] 	= $this->input->post('address_lat');
				$data['address_lng'] 	= $this->input->post('address_lng');
				$data['address_type'] 	= $this->input->post('address_type');
				if(!empty($this->input->post('other_address_type'))){
					$data['other_address_type'] 	= $this->input->post('other_address_type');
				}
				$data['updated_date'] 	= date('Y-m-d h:i:s');
				
				$data 	= $this->security->xss_clean($data); 
				$result = $this->common_model->update_data('address_book', $data, array('id'=>$id));
				if($result){
					$this->session->set_flashdata('msg', 'Address Updated Successfully!');
					echo json_encode(['message'=>1]);
					redirect('my_account/addresses');
				}
			}
			
		}else{
			$req_param['conditions'] = array('id'=>$id,'user_id'=>$this->customer_id);
			$req_param['returnType'] = 'single';
			$address_book = $this->common_model->getRows('address_book',$req_param);
			
			$data['address_book']	= $address_book;
		
			$data['id']			= $id;
			$data['form_url']	= 'my_account/addresses/edit/'.$id;
			$data['title']		= 'Edit Address';
			$data['sidebar']	= 'my_account/sidebar';
			$data['page'] 		= 'my_account/add_edit_address';
			$data['view'] 		= 'my_account/index';
			$this->load->view('layout',$data);
		}
	}
	
	public function del_address($id){
		
		$req_param = array('id'=>$id,'user_id'=>$this->customer_id);
		$address_book = $this->common_model->delete_data('address_book',$req_param);
		$this->session->set_flashdata('msg', 'Address Deleted Successfully!');
		redirect('my_account/addresses');
	}
	public function retrievezipcode(){
		$location = $this->input->post('area');
		
		$req_param['like'] = array('area'=>$location);
		$req_param['fields'] = 'zipcode,area,city,state,country';
		$req_param['returnType'] = 'single';
		$shippings_area = $this->common_model->getRows('shippings_area',$req_param);
		
		$result = array();
		
		if(!empty($shippings_area)){
			$result = $shippings_area;
		}
		
		echo json_encode($result);
		exit();
	}
	
}