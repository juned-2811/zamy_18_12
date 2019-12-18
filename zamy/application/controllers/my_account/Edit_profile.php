<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Edit_profile extends CI_Controller {
	
	function __construct() {
		parent::__construct();
		$this->load->model('Common_model');
		$this->customer_id 	= $this->session->userdata('cust_id');
	    $this->load->library('image_lib'); 
		$this->load->library('upload');
	}
	
	public function index($id = 0){
		is_login();
		if ($this->input->post('submit')) {
			$this->form_validation->set_rules('name', 'Name', 'trim|required');
			$this->form_validation->set_rules('email', 'Status', 'trim|required');
			$this->form_validation->set_rules('phone', 'Status', 'trim|required');
			if ($this->form_validation->run() == FALSE) {

				//$data['data'] = $this->common_model->get_data_by_id($this->customer_id,' online_customer')[0];
                $data['sidebar']= 'my_account/sidebar';
		        $data['page'] 	= 'my_account/edit_profile';
		        $data['view'] 	= 'my_account/index';
		        $this->load->view('layout',$data);
			}
			else{
				    $profie = 'notselect.png';
                    if($_FILES['new_profile']['name'] != ""){
						$config['allowed_types'] = 'jpg|jpeg|png';
					//	$config['max_size']      = 1024  * 1024; // Old size  : "5MB"
						$config['overwrite']	 = FALSE;
						$config['upload_path']   = 'uploads/customer_profiles';
						$this->upload->initialize($config); 
						
						if(!$this->upload->do_upload('new_profile'))
						{ echo $this->upload->display_errors();
							$this->session->set_flashdata('msg', str_replace(array('<p>', '</p>'),'', $this->upload->display_errors()));

							exit;
						}else{ 	
						   					
							$fileData=$this->upload->data();
							$profie=$fileData['file_name'];
							
							$config_thumb = array(
							'source_image'      => $fileData['full_path'], //path to the uploaded image
							'new_image'         => 'uploads/customer_profiles/thumbs/', //path to
							'maintain_ratio'    => true,
							'width'             => 50,
							'height'            => 35
							);
						 
							$this->image_lib->initialize($config_thumb);
							$this->image_lib->resize();
						}
					}
					else{
						$profie = $this->input->post('profile');
					}

					$get_old_pass = $this->common_model->get_field_by_id('online_customer','password',array('id' => $this->customer_id));

					if(!empty($this->input->post('conform_pass')) && password_verify($this->input->post("old_pass"),$get_old_pass))
					{
						if($this->input->post('new_pass') == $this->input->post('conform_pass'))
						{
		                	$data = array(
								'name' => $this->input->post('name'),
								'email' => $this->input->post('email'),
								'phone' => $this->input->post('phone'),
								'country' => $this->input->post('country'),
								'state' => $this->input->post('state'),
								'city' => $this->input->post('city'),
								//'gender'=>$this->input->post('gender'),
								'password' => password_hash($this->input->post('conform_pass'),PASSWORD_BCRYPT),
								'profile'=>$profie  						
							);
	                	}
	                	else
	                	{
	                		$this->session->set_flashdata('pass_error','New Password and Conform Password did not matched');

	                		redirect(base_url("my_account/Edit_profile"));
	                	}
	                }
	                else
	                {
	                	$data = array(
							'name' => $this->input->post('name'),
							'email' => $this->input->post('email'),
							'phone' => $this->input->post('phone'),
							'country' => $this->input->post('country'),
							'state' => $this->input->post('state'),
							'city' => $this->input->post('city'),
							//'gender'=>$this->input->post('gender'),
							'password' => $get_old_pass,
							'profile'=>$profie  						
						);
	                }
					
					$data = $this->security->xss_clean($data);
					$result = $this->common_model->update_data('online_customer',$data,array('id'=>$this->customer_id));
					if($result){
						$this->session->set_flashdata('msg', 'Record is Updated Successfully!'); 
						redirect(base_url("my_account/Edit_profile"));
					}
			}
		}
		else{
		$data['online_customer_details'] = $this->Common_model->get_data_by_id(array('id'=>$this->customer_id),'online_customer')[0];
		$data['sidebar']= 'my_account/sidebar';
		$data['page'] 	= 'my_account/edit_profile';
		$data['view'] 	= 'my_account/index';
		$this->load->view('layout',$data);
	   }
	}

	public function match_old_password()
	{
		$old_pass = $this->input->post("old_pass");

		$get_true_pass = $this->common_model->get_field_by_id('online_customer','password',array('id' => $this->customer_id));

		$old_true_pass = password_verify($old_pass,$get_true_pass);

		
		if($old_true_pass){
			echo 1;
		}
		else
		{
			echo 0;
		}
		


	}

	public function load_state_by_country($country_id="")
	{
		if ($country_id=="") {
				echo "<select class='form-control chosen' name='state_id'>
						<option value=''>Choose a Country First</option>
					</select>";
		}
		else {
				
				echo load_state_with_country_id('state', 'state_id', 'name', 'add', 'form-control chosen', '', 'country_id', $country_id, 'load_city');
		}
	}
		 
	public function load_city_by_state($state_id="")
	{
		if ($state_id=="") {
				echo "<select class='form-control chosen' name='state_id'>
						<option value=''>Choose a State First</option>
					</select>";
		}
		else {
				echo load_city_with_state_id('city', 'city_id', 'name', 'add', 'form-control chosen', '', 'state_id', $state_id, '');
		}
	}

	
}