<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Referral extends CI_Controller {
	
	function __construct() {
		parent::__construct();
		$this->load->model('Common_model','common_model');
		$this->customer_id 	= $this->session->userdata('cust_id');

	} 
	function index() {
        $data['ref_code'] =  $this->common_model->get_field_by_id('referrals_data','my_referral_code',array('user_id'=>$this->customer_id));    
        $data['sidebar']  = 'my_account/sidebar';
		$data['page'] 	  = 'my_account/referral_code';
		$data['view'] 	  = 'my_account/index';
		$this->load->view('layout',$data);
	}

	function send_ref_code(){

        $rf_email = $_POST['rf_email'];
		$rf_code = $this->input->post('rf_code');
        
		if (!empty($rf_code))
		{   
			foreach ($rf_email as $key => $value) 
			{   
				if(is_numeric($value)){
                   $mobile = $value;
                   $message = 'You can use Referral Code for Zamy "'.$rf_code.'"';
                   $sms =  send_sms($mobile,$message);
				   if ($sms) {
				   	  $msg = "Your Referral Code send Successfully";
				   }
				   else{
                      $msg = "Error!In Sending SMS";
				   }
				}
				else
				{
                $each_data = $value;
				$code = $rf_code;
                
				$html = '<h1>Zamy In</h1>';
                $html .= '<p>You can use "'.$code.'"</p>';    
                $config = array();
                $config['protocol']	= 'sendmail';
			    $config['charset']	= 'iso-8859-1';
			    $config['wordwrap']	= TRUE;
			    $config['mailtype']	= 'html';
			    $config['newline']	= "\r\n";
               $this->email->initialize($config);
               $this->email->to($each_data);
               $this->email->from('sameer@gmail.com','zamy');
               $this->email->subject('Referral Code For ZAMY.in');
               $this->email->message($html);
               $result = $this->email->send();
               if ($result) {
               	 $msg = 'Referral Code Email Successfully';
               }
               else{
                 $msg = 'ERROR!';
               }
			   }

            }
		}
		else{
			$msg = "You have No Code Contact info@zamy.com";
		}
		echo $msg;
	}

}

?>	