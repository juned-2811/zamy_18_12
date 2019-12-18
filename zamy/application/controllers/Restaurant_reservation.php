<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Restaurant_reservation extends CI_Controller {
	
	function __construct() {
		parent::__construct();
		$this->load->model('Common_model','common_model');
		$this->customer_id 	= $this->session->userdata('cust_id');
        $this->load->library('email');
	}
	function index(){
	  if ($this->input->post('submit')) {
	  	        
	  	      $this->form_validation->set_rules('restaurant_name', 'Name', 'trim|required');
			  $this->form_validation->set_rules('restaurant_phone', 'Restaurant_phone', 'trim|required');
			  $this->form_validation->set_rules('manager_name', 'Manager_contac', 'trim|required');
			  $this->form_validation->set_rules('manager_contact', 'Manager_contact', 'trim|required');
			  $this->form_validation->set_rules('contact_email', 'Contact_Email', 'trim|required');
			  $this->form_validation->set_rules('country', 'Country', 'trim|required');
			  $this->form_validation->set_rules('state', 'State', 'trim|required');
			  $this->form_validation->set_rules('city', 'City', 'trim|required');
			  $this->form_validation->set_rules('terms_and_co', 'TermsandCo', 'trim|required');
				
				if ($this->form_validation->run() == FALSE)
				{
					$data['view'] = 'register_restaurant';
					$this->load->view('layout', $data);
				}else{
					$customer_email = $this->input->post('contact_email');
					$restaurant_name = $this->input->post('restaurant_name');
					$manager_name = $this->input->post('manager_name');
					$data = array(
						'restaurant_name' => $restaurant_name,
						'restaurant_phone' => $this->input->post('restaurant_phone'),
						'manager_name' => $manager_name,
						'manager_contact' => $this->input->post('manager_contact'),
						'contact_email' => $customer_email,
						'country' => $this->input->post('country'),
						'state' => $this->input->post('state'),
						'city' => $this->input->post('city'),
						'terms_and_co' => $this->input->post('terms_and_co')
					);
					$data = $this->security->xss_clean($data);
					$result = $this->common_model->add_data('restaurant_reservation',$data);
					$html_data = '<h1>Thanks <p style="color: red">'.$manager_name.'<p/> for Register Your Restaurant on zamy</h1>';  
                    $html_data .= '<p>Your Restaurant "'.$restaurant_name.'" Details varified soon.</p>';
                    $config = array();
                    $config['protocol']	= 'sendmail';
				  //$config['mailpath']	= '/usr/sbin/sendmail';
					$config['charset']	= 'iso-8859-1';
					$config['wordwrap']	= TRUE;
					$config['mailtype']	= 'html';
					$config['newline']	= "\r\n";
                    $this->email->initialize($config);
                    $this->email->to($customer_email);
                    $this->email->from('no.reply@' . $_SERVER['SERVER_NAME'],'Zamy.in');
                    $this->email->subject('Successfully Register');
                    $this->email->message($html_data);

					if ($this->email->send()) {
							$this->session->set_flashdata('msg', 'Your Details Send Successfully!');
							redirect(base_url());
					} 
					else {
							$this->session->set_flashdata('error',"Failed to send email, Something wrong!");
							 
					}
				}
	  }
	  else
	  {
	    $data['view'] = 'register_restaurant';
		$this->load->view('layout',$data); 
	  }
	   
	}
}

?>	