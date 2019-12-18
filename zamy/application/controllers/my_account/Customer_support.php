<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Customer_support extends CI_Controller {
	
	function __construct() {
		parent::__construct();
		$this->load->model('Common_model','common_model');
		$this->customer_id 	= $this->session->userdata('cust_id');

	} 

	function index()
	{   
		$data['data'] =  $this->common_model->get_all_data('customer_support');
        $data['sidebar']= 'my_account/sidebar';
		$data['page'] 	= 'my_account/customer_support';
		$data['view'] 	= 'my_account/index';
		$this->load->view('layout',$data);
	}

	function view_conversation($ticketID = 0,$ticketChatID = 0){
		$data['data'] = order_details_by_ticket_ID($ticketID)[0];
		$data['conversation']  = get_cs_admin_conversation($ticketChatID);
		$data['sidebar']= 'my_account/sidebar';
		$data['page'] 	= 'my_account/conversation';
		$data['view'] 	= 'my_account/index';
		$this->load->view('layout',$data);
	}

	function getDetails_for_Reply(){
		$ticketID = $this->input->post('ticketID');
		$result = $this->common_model->get_data_by_id(array('ticketID'=>$ticketID),'customer_support')[0];
		echo json_encode($result);
		exit();
	}

	function give_customer_reply(){
		$data = array('ticketChatID'=>$this->input->post('ticketChatID'),
			          'ticketSenderID'=>$this->input->post('ticketSenderID'),
			          'ticketReceiverID'=>$this->input->post('ticketReceiverID'),
			          'order_id'=>$this->input->post('order_id'),
			          'ticketTitle' => $this->input->post('ticketTitle'),
			          'subject' => $this->input->post('subject'),
			          'ticketBody' => $this->input->post('ticketBody'),
			          'status' => 1,
			          'ticketstatus' => $this->input->post('ticketstatus')
			          );
		$result = $this->common_model->add_data('customer_support',$data);
		$msg = '';
		if($result){
			$msg .= 'Send Successfully';
		}
		else{
			$msg .= 'ERROR!';
		}
		echo $msg;	
	}
}
?>	