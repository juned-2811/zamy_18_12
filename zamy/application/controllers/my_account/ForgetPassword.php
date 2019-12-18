<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class ForgetPassword extends CI_Controller {
   	function __construct() {
		parent::__construct();
		$this->load->model('Common_model');
		$this->load->model('users/user_model', 'user_model');
		$this->customer_id 	= $this->session->userdata('cust_id');
		$this->load->library('email');

	}

	public function index()
	{
		if($this->input->post('submit'))
		{
			//$to_email = $this->input->post('email');

			$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
			if ($this->form_validation->run() == FALSE)
			{
				$this->session->set_flashdata('msg', 'Email reqired');
				//$data['sidebar']= 'my_account/sidebar';
		       // $data['page'] 	= 'my_account/forgotpassword';
		        //$data['view'] 	= 'my_account/index';
		        //$this->load->view('layout',$data);
			}
			else
			{
				$email= $this->input->post('email');
				$findemail = $this->user_model->ForgotPassword($email); 

				if($findemail)
				{
					$data1['email']=$email;
					$passwordplain = "";
					$passwordplain  = rand(999999999,9999999999);
					$data1['password'] = password_hash($passwordplain, PASSWORD_BCRYPT);
					if($this->user_model->sendpassword($data1))
					{

						$config				= array();
						$config['protocol']	= 'sendmail';
						//$config['mailpath']	= '/usr/sbin/sendmail';
						$config['charset']	= 'iso-8859-1';
						$config['wordwrap']	= TRUE;
						$config['mailtype']	= 'html';
						$config['newline']	= "\r\n";
						$data['to']=$email;
						$data['passwordplain']=$passwordplain;
						$data['email']=$email;
						$this->email->initialize($config);
						$htmlContent = '<h1>Forget-Password : Zamy</h1>';
                        $htmlContent .= '<p>Your Password is : '.$passwordplain.'</p>';
								
						//$userinfo=getCurrentUser();
						
						$this->email->from('no-reply@' . $_SERVER['SERVER_NAME'], 'zamy');
		
						$this->email->to($email);
						
						$this->email->subject('Forgot Password - Zamy');
						$this->email->message($htmlContent);
						$this->email->set_newline("\r\n");
						$this->email->set_crlf("\r\n");
					
						if ($this->email->send()) {
							$this->session->set_flashdata('msg', 'Password Details is send on mail If not send then check spam');
							redirect(base_url());
						} 
						else {
							$this->session->set_flashdata('error',"Failed to send password, please try again!");
							 
						}
					}
					else
					{
						$this->session->set_flashdata('error','Please try after sometime.');
					}
				}
				else{
                   $this->session->set_flashdata('message' , array('msg'=>"your e-mail address is not valid or doesn't exist."));
				} 
			}
   
		}
		else
		{
		 $data['view'] 	= 'my_account/forgotpassword';
		 $this->load->view('layout',$data); 
		} 
	}
}

?>