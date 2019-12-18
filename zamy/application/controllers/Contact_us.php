<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Contact_us extends CI_Controller {
	
	function __construct() {
		parent::__construct();
		$this->load->model('Common_model','common_model');
		$this->customer_id 	= $this->session->userdata('cust_id');

	}
	function index(){ 

		if($this->input->post('submit')) {

			$this->form_validation->set_rules('name', 'Name', 'trim|required');
			$this->form_validation->set_rules('email', 'Email', 'trim|required');
			$this->form_validation->set_rules('subject', 'Subject', 'trim|required');
			$this->form_validation->set_rules('msg', 'Msg', 'trim|required');
            if ($this->form_validation->run() == FALSE) {
           	   $data['view'] = 'Contact_us';
			   $this->load->view('layout', $data);
            }
            else {
           	    $data = array(
						'name' => $this->input->post('name'),
						'email' => $this->input->post('email'),
						'subject' => $this->input->post('subject'),
						'msg' => $this->input->post('msg')
				);
				//$data = $this->security->xss_clean($data);
				$result = $this->common_model->add_data('contact_us',$data);
				if($result){
					$this->session->set_flashdata('msg', 'Contact Us Details Added Successfully!');
					redirect(base_url());
				}
           }
           
		} else {
			$data['view'] = 'Contact_us';
		   $this->load->view('layout',$data); 
		}
		

	}


}	