<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

// Load the Rest Controller library
require APPPATH . '/libraries/REST_Controller.php';

class Customer_support extends REST_Controller {

    public function __construct() { 
        parent::__construct();
        $this->load->model('api/Api_model','api_model');
		$this->load->model('common_model');

    }

    public function create_customer_ticket_post()
    {
		 
		$order_id 			= $this->input->post('order_id');
		$ticketChatID 		= $order_id;
		$ticketSenderID 	= $this->input->post('ticketSenderID');
		$ticketReceiverID 	= 1;
		$ticketTitle 		= $this->input->post('ticketTitle');
		$subject 			= $this->input->post('subject');
		$ticketBody 		= $this->input->post('ticketBody');
		$status 			= 1;
		$ticketstatus 		= 'open';

		$data = array('order_id'=>$order_id,
			          'ticketChatID'=>$ticketChatID,
			          'ticketSenderID'=>$ticketSenderID,
			          'ticketReceiverID'=>$ticketReceiverID,
			          'ticketTitle'=>$ticketTitle,
			          'subject'=>$subject,
			          'ticketBody'=>$ticketBody,
			          'status'=>$status,
			          'ticketstatus'=>$ticketstatus);
					  
		
		$check_ticket = $this->common_model->get_field_by_id('customer_support','ticketID',array('order_id'=>$order_id));
		
		if(count($check_ticket)>0){
			 $this->response([
                    'status' => 0,
                    'message' => "Ticket already exist  for sub_order_id : $order_id",
                    'data' => ''
                ], REST_Controller::HTTP_BAD_REQUEST);
		}
		 if(!empty($data)){
				 
			
		    $result = $this->common_model->add_data('customer_support',$data);
		    $msg =  "";
		    if ($result) {
		    	$msg .=  "Ticket Created successfully";
		    } else {
		    	$msg .=  "ERROR";
		    }
		    
			if($result){
	 
                $this->response([
                    'status' => 1,
                    'message' => 'Ticket Created successfully',
                    'data' => $msg
                ], REST_Controller::HTTP_OK);
            }else{ 

				 $this->response([
                    'status' => 0,
                    'message' => 'ERROR!Something Wrong.',
                    'data' => ''
                ], REST_Controller::HTTP_BAD_REQUEST);
            }
		 }
		 else{
			 // Set the response and exit
			$this->response([
				'status' => 0,
				'message' => 'All Data is required.',
				'data' => ''
			], REST_Controller::HTTP_BAD_REQUEST);
		}
		exit;
    }
    

	public function reply_ticket_post(){
    	
		$ticketChatID 		= $this->input->post('ticketChatID');
		$ticketSenderID 	= $this->input->post('ticketSenderID');
		$description		= $this->input->post('description');
		
		if(empty($ticketChatID))
		{
			$this->response([
				'status' => 0,
				'message' => 'ticketChatID is required.',
				'data' => ''
			], REST_Controller::HTTP_BAD_REQUEST);
		}
		
		if(empty($ticketSenderID))
		{
			$this->response([
				'status' => 0,
				'message' => 'ticketSenderID is required.',
				'data' => ''
			], REST_Controller::HTTP_BAD_REQUEST);
		}
		
		if(empty($description))
		{
			$this->response([
				'status' => 0,
				'message' => 'description is required.',
				'data' => ''
			], REST_Controller::HTTP_BAD_REQUEST);
		}
		
		$this->db->where('ticketChatID',$ticketChatID);
		$this->db->order_by('ticketID','desc');
		$query = $this->db->get('customer_support');
		$check_ticket = $query->row_array();
		
		$flag=0;
		if(count($check_ticket)>0){
			if(strtolower($check_ticket['ticketstatus'])=='close'){
				$this->response([
				'status' => 0,
				'message' => 'Ticket already close you can not replay.',
				'data' => ''
			], REST_Controller::HTTP_BAD_REQUEST);
			}else{
				$flag = 1;
			}
		}else{
			$flag = 1;
		}
		
		if($flag ==1){
			
			$ticketReceiverID 	= 1;		
			$ticketstatus 		= 'Open';
			$subject 			= $check_ticket['subject'];
			$ticketTitle 		= $check_ticket['ticketTitle'];
			$order_id 			= $check_ticket['order_id'];
			
			$data = array(
				'ticketTitle'			=> $ticketTitle,
				'subject'				=> $subject,
				'ticketBody'			=> $description,
				'ticketChatID'			=> $ticketChatID,
				'ticketSenderID'		=> $ticketSenderID,
				'ticketReceiverID'		=> $ticketReceiverID,
				'order_id'				=> $order_id,
				'ticketDateTime'		=>date("Y-m-d H:i:s"),
				'ticketstatus'			=>$ticketstatus
				);
				
			$lastid = $this->common_model->add_data('customer_support',$data);
			
			$data2 = array(
					'message_id'	=> $lastid - 1,
					'user_id'		=> $ticketSenderID,
					'sender_id'		=> $ticketReceiverID,
					'time'			=> date("Y-m-d H:i:s")	
					);
					
			$chat_thread = view_message($ticketChatID);
			
			$ticketSenderID = $chat_thread[0]['ticketSenderID'];
			$ticketReceiverID = $chat_thread[0]['ticketReceiverID'];
			
			$this->response([
						'status' => 1,
						'message' => 'Reply successfully inserted.',
						'data' => $chat_thread
					], REST_Controller::HTTP_OK);
			}
		exit;
    }
	
    public function customer_support_conversation_post(){
    	$ticketChatID = $this->input->post('ticketChatID');

		 if(!empty($ticketChatID)){
			$order_by =  'ticketChatID';
			$dir	  =	'ASC'; 
			$data = $this->common_model->get_data_by_id(array('ticketChatID'=>$ticketChatID),'customer_support','',$order_by,$dir);
		
			if($data){

                $this->response([
                    'status' => 1,
                    'message' => 'Get All Conversation .',
                    'data' => $data
                ], REST_Controller::HTTP_OK);
            }else{ 

				 $this->response([
                    'status' => 0,
                    'message' => 'Wrong ticketChatID.',
                    'data' => ''
                ], REST_Controller::HTTP_BAD_REQUEST);
            }
		 }
		 else{
			 // Set the response and exit
			$this->response([
                    'status' => 0,
                    'message' => 'ticketChatID is required.',
                    'data' => ''
                ], REST_Controller::HTTP_BAD_REQUEST);
		}
		exit;
    }


    public function customer_support_ticket_detail_post() {
		 
		$user_id = $this->input->post('ticketSenderID');
		 
		 if(!empty($user_id)){
				 
			$data = $this->common_model->get_data_by_id(array('ticketSenderID'=>$user_id),'customer_support');
		
			if($data){

                $this->response([
                    'status' => 1,
                    'message' => 'Get customer_support_ticket Details.',
                    'data' => $data
                ], REST_Controller::HTTP_OK);
            }else{ 
                // Set the response and exit
                //BAD_REQUEST (400) being the HTTP response code
				 $this->response([
                    'status' => 0,
                    'message' => 'Wrong user_id.',
                    'data' => ''
                ], REST_Controller::HTTP_BAD_REQUEST);
            }
		 }
		 else{
			 // Set the response and exit
			$this->response([
                    'status' => 0,
                    'message' => 'user_id is required.',
                    'data' => ''
                ], REST_Controller::HTTP_BAD_REQUEST);
		}
		exit;
    } 
	public function customer_support_category_issue_get() {
	 
		$category_issue = $this->common_model->get_data_by_id(array('status' => 1),'customer_support_category_issue');

		if($category_issue){
		 
			// Set the response and exit
			$this->response([
			'status' => 1,
			'message' => 'Get issue successfully.',
			'data' => $category_issue
			], REST_Controller::HTTP_OK);
		}
		else{
			// Set the response and exit
			//BAD_REQUEST (400) being the HTTP response code
			$this->response([
			'status' => 0,
			'message' => 'No data found.',
			'data' => (object)[]
			], REST_Controller::HTTP_OK);
		}
		 
		exit;
	} 
}    