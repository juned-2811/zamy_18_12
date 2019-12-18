<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Changepassword extends CI_Controller {
	
	function __construct() {
		parent::__construct();
		$this->load->model('Common_model','common_model');
		$this->customer_id 	= $this->session->userdata('cust_id');

	} 
	function index(){
      if ($this->input->post('submit')) {
      	 $old_password = $this->input->post('old_pass');
      	 //$old_to_ecy = password_hash($old_password, PASSWORD_BCRYPT);
      	 $new_password = $this->input->post('new_pass');
      	 $get_old_pass = $this->common_model->get_field_by_id('online_customer','password',array('id' => $this->customer_id));
 
      	 $this->form_validation->set_rules('old_pass', 'OLD_PASS', 'trim|required');
      	 $this->form_validation->set_rules('new_pass', 'NEW_PASS', 'trim|required');
         if ($this->form_validation->run() == FALSE) {

         	$this->session->set_flashdata('msg', 'Both field reqired');
         	
         } else {
           if(password_verify($old_password,$get_old_pass)) { 
      	  	 $data = array('password'=>password_hash($new_password, PASSWORD_BCRYPT));
      	  	 $data = $this->security->xss_clean($data);
      	  	 $result = $this->common_model->update_data('online_customer',$data,array('id'=>$this->customer_id)); 
      	  	 if($result){
      	  	 $this->session->set_flashdata('msg', 'Password Changed Successfully!');
      	  	 redirect(base_url('my_account/Changepassword/index'));
      	  	 }          
      	   }
      	   else {
      	  	$this->session->set_flashdata('error','Password did not matched');
      	   }
         }
         
      	   
      } else {
      	$data['sidebar']= 'my_account/sidebar';
		$data['page'] 	= 'my_account/changepassword';
		$data['view'] 	= 'my_account/index';
		$this->load->view('layout',$data);
      }
      
	}
}	