<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Blog extends CI_Controller {
	
	function __construct() {
		parent::__construct();
		$this->load->model('common_model');
		$this->customer_id 	= $this->session->userdata('cust_id');
		$this->load->library('image_lib');
	}
	 
	public function index(){

        $this->load->library('pagination'); 
				
		$allrow = $this->common_model->count_rows_where('blog_post','id',array('blog_status' => 'published'));
		
		$config = array();
		
        $config['base_url'] = base_url()."blog";
		 
		$config['num_links'] = 2;
		
		$config['first_link'] = 'First';
		$config['first_tag_open'] = '<li class="page-item first">';
		$config['first_tag_close'] = '</li>';
		 
		$config['last_link'] = 'Last';
		$config['last_tag_open'] = '<li class="page-item last">';
		$config['last_tag_close'] = '</li>';

		$config['next_link'] = 'Next';
		$config['next_tag_open'] = '<li class="page-item next"> ';
		$config['next_tag_close'] = '</li>';

		$config['prev_link'] = 'Prev';
		$config['prev_tag_open'] = '<li class="page-item prev">';
		$config['prev_tag_close'] = '</li>';

		$config['cur_tag_open'] = '<li class="page-item active"> <a class="page-link brd-rd2" href="#" itemprop="url">';
		$config['cur_tag_close'] = '</a></li>';
		
		$config['num_tag_open'] = '<li class="page-item"> ';
		$config['num_tag_close'] = ' </li>';

		$config['per_page'] = 3;
		$config['total_rows'] = $allrow;
		$this->pagination->initialize($config);
		$page =  ($this->uri->segment(2)) ? $this->uri->segment(2) : 0;
        $str_links = $this->pagination->create_links();

        $query_data['fields'] = 'id,title,sub_title,image,updated,blog_alias';
		$query_data['conditions'] = array('blog_status' => 'published');
        $query_data['start'] = $page ; 
        $query_data['limit'] = $config['per_page'];

        $blog_details = $this->common_model->getRows('blog_post',$query_data);
        
		$data['links'] = explode('&nbsp;',$str_links );
		$data['blog_details'] = $blog_details;
		$data['view'] = 'blog/index';

		$this->load->view('layout',$data);
	}

	public function details($alias,$id){


		$fields = 'id,title,sub_title,image,description,updated,status';
		$review_fields = 'name,message,created_date';
		
		$data['blog_detail']=blog_detail($alias);

		//$review_data = $this->common_model->get_data_by_id(array('status' => 1,'blog_post_id' => $id),'review',$review_fields);

		$review_data = $this->common_model->get_comment_data(array('review.status' => 1,'review.blog_post_id' => $id));

		$data['review_data'] = $review_data;
		$data['view'] = 'blog/blog_detail';

		$this->load->view('layout',$data);
	}

	public function review_form(){
		$uploadDir = 'uploads/cstmr_review/'; 
		$user_id = $this->customer_id;
		if(empty($user_id)){
			echo "pls login your account to send message";
			exit();
		} 

		$name = trim($this->input->post('name'));
        $email = trim($this->input->post('email'));
        $subject = trim($this->input->post('subject'));
        $msg = trim($this->input->post('msg'));
        $blog_post_id = $this->input->post('blog_id');

        $data = array(
                    'name' 			=> $name,
                    'email' 		=> $email,
                    'subject' 		=> $subject,
                    'message' 		=> $msg,
                    'blog_post_id'  => $blog_post_id,
                    'user_id' 		=> $user_id,
                    ); 
         
        $result = $this->db->insert('review',$data);
        $msg = '';
        if($result = true)
        {     
        	$msg .= "Your Message Is Successfully Delivered To Admin For Prossesing";
        }
        else
        {
            $msg .="Error!";
        }
        echo $msg;
       
	}
}

