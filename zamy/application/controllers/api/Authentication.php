<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

// Load the Rest Controller library
require APPPATH . '/libraries/REST_Controller.php';

class Authentication extends REST_Controller {

    public function __construct() { 
        parent::__construct();
        $this->load->model('api/Api_model','api_model');
		$this->load->model('common_model');
        // Load the user model
         
    }
    
	public function request_otp_post() {
		// Get the post data
		 
		$ip 	  = $_POST['deviceID'];
		$username = addslashes(trim($_POST["username"]));
		$email 	  = addslashes(trim($_POST["email"]));
		$mobile   = addslashes(trim($_POST["mobile"]));
 
		if(empty($username)){
			 $this->response([
                    'status' => 0,
                    'message' => 'username is Required',
                   'data'=>(object)[]
				], REST_Controller::HTTP_OK); 
		}
		
		if(empty($email)){
			 $this->response([
                    'status' => 0,
                    'message' => 'email is Required',
                    'data'=>(object)[]
				], REST_Controller::HTTP_OK); 
		}
		
		if(empty($mobile)){
			 $this->response([
                    'status' => 0,
                    'message' => 'mobile is Required',
                    'data'=>(object)[]
				], REST_Controller::HTTP_OK);  
		}
		 
		if(!empty($mobile) && strlen( $mobile ) < 10 ){
			 $this->response([
                    'status' => 0,
                    'message' => 'mobile must be 10 digit.',
                    'data'=>(object)[]
				], REST_Controller::HTTP_OK);  
		}
		
		$this->db->where('email',$email); 
		$query = $this->db->get('online_customer');
		if ($query->num_rows() > 0){
			 
			 $this->response([
                    'status' => 0,
                    'message' => 'This email is already in use.Please try a different one!',
                    'data' => (object)[]
             ], REST_Controller::HTTP_OK); 
		}
		 $this->db->where('phone',$mobile); 
		$user_avl = $this->db->get('online_customer');
	
		if($user_avl->num_rows() > 0){
			 $this->response([
                    'status' => 0,
                    'message' => 'This mobile is already in use.Please try a different one!',
                    'data'=>(object)[]
				], REST_Controller::HTTP_OK);  
		}
		 
		 if(empty($ip)){
			 $this->response([
                    'status' => 0,
                    'message' => 'DeviceID is required.',
                    'data' => (object)[]
             ], REST_Controller::HTTP_OK);   
		}
		
		$table_name = 'sms_otp';
		$flp_ajax_field = 'flp_ajax_' . substr( hash( 'sha256', uniqid() ), 8, 24 );
		
		$smsdata = query_sms_table( $table_name,array('ip'=>$ip));
		
		if ( ( $smsdata === NULL ) || ( $smsdata->last < strtotime( '-3 minutes' ) ) ) {
			
			$replace_data = array( 'ip' => $ip, 'counter' => 3, 'last' => time(), 'ajax' => $flp_ajax_field, 'mobile' => $mobile );
			$where = array('ip'=>$ip);
			
			replace_sms_table( $table_name, $replace_data, $where);
			$smsdata = query_sms_table( $table_name, array('ip'=>$ip));
		}else{
			if(empty($smsdata->counter)){
				$counter=3;
			}else{
				$counter=$smsdata->counter;
			}
			$replace_data = array( 'ip' => $ip, 'counter' => $counter, 'last' => $smsdata->last, 'ajax' => $flp_ajax_field, 'mobile' => $smsdata->mobile );
			$where = array('ip'=>$ip);
			
			replace_sms_table( $table_name, $replace_data, $where);
		}
		
		$params['Mobile'] = trim($mobile);
		if ( strpos( $params[ 'Mobile' ], '+' ) !== 0 ){
			$params['Mobile'] = '' . $params['Mobile'];
		}
		$params[ 'MsgText' ] = "Please use this OTP: {otp}";
		$params[ 'MsgText' ] = str_replace( [ '{', '}' ], [ '<', '>' ], $params[ 'MsgText' ] );
		
		$myotp=substr($smsdata->last, -4);
		$params[ 'MsgText' ] = str_replace( [ '<otp>' ], [$myotp], $params[ 'MsgText' ] );
		
		$url = 'http://ui.netsms.co.in/API/SendSMS.aspx';
		
		$replace_data1 = array( 'ip' => $ip, 'counter' => --$smsdata->counter, 'last' => $smsdata->last, 'ajax' => $smsdata->ajax, 'mobile' => $params[ 'Mobile' ] );
		$where = array('ip'=>$ip);
		replace_sms_table( $table_name, $replace_data, $where);
		
		$query = '';
		foreach( $params as $key=>$value ) {
			$query .= '&' . $key . '=' . rawurlencode( $value );
		}

		$api_key='ZbEA9roJ2euxWWPH8OWpgQyKYK';
		
		$url = $url . '?APIkey=' . $api_key .'&SenderID=ZAMYin&SMSType=2'. $query;
		
		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $url);
		
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1); 
		$output = curl_exec($ch); 
		curl_close($ch); 
		
		$request_body_explode=explode('|',$output);
	 
		if($request_body_explode[0]=='ok'){
			
			 $this->response([
                    'status' => 1,
                    'message' => "A verification SMS has been sent to ".$params[ 'Mobile' ],
                    'data' => (object)[]
             ], REST_Controller::HTTP_OK);   
			 
		}else{
		 
            $this->response([
					'status'=>0,
					'message'=>$request_body_explode[0],
					'data'=>(object)[]
				], REST_Controller::HTTP_OK);			
		}
		 
	}
	
	function verify_otp_post(){
   
		$ip 	  = $_POST['deviceID'];
		$otp 	  = $_POST['OTP'];
		$username = addslashes(trim($_POST["username"]));
		$email 	  = addslashes(trim($_POST["email"]));
		$mobile   = addslashes(trim($_POST["mobile"]));
		$password = $_POST['password'];  
		$referral_code = $_POST['referral_code'];  
		 
		if(empty($ip)){
			 $this->response([
					'status'=>0,
					'message'=>"deviceID is required.",
					'data'=>(object)[]
				], REST_Controller::HTTP_OK); 
			 
			exit();
		}
		if(empty($otp)){
			
			 $this->response([
					'status'=>0,
					'message'=>"OTP Not found.",
					'data'=>(object)[]
				], REST_Controller::HTTP_OK); 
		}
		else{
			$table_name = 'sms_otp';
			$smsdata = query_sms_table( $table_name, array('ip'=>$ip) );
		
			if(!empty($smsdata)){
			
				$myotp=substr($smsdata->last, -4);
				
				if (( $smsdata === NULL ) || ( $smsdata->ip != $ip) || ( $smsdata->last < strtotime( '-3 minutes' ) )) {
					
					 $this->response([
						'status'=>0,
						'message'=>"OTP Expired. Please resend OTP again",
						'data'=>(object)[]
					], REST_Controller::HTTP_OK);
					 
					 		
					delete_sms_table( $table_name, array('ip'=>$ip) );
					  exit;
				}elseif ($otp != $myotp) {
					
					 $this->response([
						'status'=>0,
						'message'=>"Invalid OTP",
						'data'=>(object)[]
					], REST_Controller::HTTP_OK);
					 
				}else{
					delete_sms_table( $table_name, array('ip'=>$ip) );
					
					$query = $this->db->get_where('online_customer', array('phone' => $mobile));
					if ($query->num_rows() != 0){
						 $this->response([
							'status'=>0,
							'message'=>"Mobile already exist.",
							'data'=>(object)[]
						], REST_Controller::HTTP_OK);
						  
					}else{
							
						if(!empty($referral_code)){
							
							$query = $this->db->get_where('referrals_data', array('my_referral_code' => $referral_code));
							$get_referral_code = $query->row_array();
							  
							if(empty($get_referral_code)){
								
								$this->response([
									'status'=>0,
									'message'=>"Referral code does not exist.",
									'data'=>(object)[]
								], REST_Controller::HTTP_OK);
								
								exit;
							}
							else{
								
								$earned_point = $get_referral_code['earn_point'] + 25 ;
								$update = $this->common_model->update_data('referrals_data',array('earn_point' => $earned_point), array('id' =>  $get_referral_code['id']));
							}
						}
						else{
							$referral_code = ''; 
						}
							$user_data = array(
								'phone' 		=> $mobile,
								'name' 			=> $username,
								'email' 		=> $email,
								'password' 		=> password_hash($password, PASSWORD_BCRYPT), 
							);
						
					   $register = $this->common_model->add_data('online_customer',$user_data);
					   $user_id  = $this->db->insert_id();
						$current_date = date('Y-m-d');
						$referral_data = array(
							'user_id' 				=> $user_id,
							'my_referral_code' 		=> my_random_string(),
							'from_referral_code'	=> $referral_code,
							'status'				=> 1,
							'date_added'			=> date('Y-m-d', strtotime("+6 months", strtotime($current_date))),
							'earn_point'			=> 0,
						);  
						 $register= $this->common_model->add_data('referrals_data',$referral_data);
						
						if($register){
							  
							$this->response([
								'status' => 1,
								'message' => 'SMS verification successful.',
								'data' => $register
							], REST_Controller::HTTP_OK); 
						}else{
							 $this->response([
								'status'=>0,
								'message'=>'Somethig went wrong please try again.',
								'data'=>(object)[]
							], REST_Controller::HTTP_OK); 
						} 
					}
				}
			}else{
				 $this->response([
								'status'=>0,
								'message'=>'Expired or Invalid OTP',
								'data'=>(object)[]
							], REST_Controller::HTTP_OK);  
			}
		} 	
		exit; 
	}
	 
    public function login_post() {
        // Get the post data
        $username = $this->post('email');
        $password = $this->post('password');
        
        // Validate the post data
        if(!empty($username) && !empty($password)){
				 
			$this->db->where('name',$username);
			$this->db->or_where('email',$username);
			$this->db->or_where('phone',$username);
            $query = $this->db->get('online_customer');
			
			$user = array();
			if ($query->num_rows() == 0){
				 $this->response([
					'status'=>0,
					'message'=>"Wrong email or password",
					'data'=>(object)[]
				], REST_Controller::HTTP_OK);
			}
			else{
				//Compare the password attempt with the password we have stored.
				$result = $query->row_array();
			    $validPassword = password_verify($password, $result['password']);
			    if($validPassword){
			        $user = $query->row_array();
			    }
			}
             
            if($user){
				 
				$referrals_data = $this->db->get_where('referrals_data', array('user_id' => $user['id']));
				$get_referral_code = $referrals_data->row_array();
				$current_date = date('Y-m-d');
				 if(empty($get_referral_code)){
						 
					$referral_data = array(
						'user_id' 				=> $user['id'],
						'my_referral_code' 		=> my_random_string(),
						'from_referral_code'	=> '',
						'status'				=> 1,
						'date_added'			=> date('Y-m-d', strtotime("+6 months", strtotime($current_date))),
						'earn_point'			=> 0,
					);  
					 $register= $this->common_model->add_data('referrals_data',$referral_data); 	
				}
						 
                // Set the response and exit
                $this->response([
                    'status' => 1,
                    'message' => 'User login successful.',
                    'data' => $user
                ], REST_Controller::HTTP_OK);
            }else{
                // Set the response and exit
                //BAD_REQUEST (400) being the HTTP response code
                $this->response([
					'status'=>0,
					'message'=>"Wrong email or password",
					'data'=>(object)[]
				], REST_Controller::HTTP_OK);
            }
        }else{
            // Set the response and exit
            $this->response([
					'status'=>0,
					'message'=>'Provide email and password.',
					'data'=>(object)[]
				], REST_Controller::HTTP_OK);
        }
		exit; 
    }
     
    public function update_profile_post() {
		$id = $this->post('user_id');
     
        // Get the post data
        $name = strip_tags($this->post('name'));
        $email = strip_tags($this->post('email'));
        $phone = strip_tags($this->post('phone'));
        $password = strip_tags($this->post('password'));
        $old_password = strip_tags($this->post('old_password'));
        $profile = strip_tags($this->post('profile'));
        
        // Validate the post data
        if(!empty($id)){
			
			$query = $this->db->get_where('online_customer', array('id' => $id));
			$user = $query->row_array();
			
            // Update user's account data
            $userData = array();
            if(!empty($name)){
                $userData['name'] = $name;
            }
           
            if(!empty($email)){
                $userData['email'] = $email;
            }
            
            if(!empty($phone)){
                $userData['phone'] = $phone;
            } 
			if(!empty($password) && !empty($old_password)){
				$validPassword = password_verify($old_password,$user['password']); 
				if($validPassword){
						 $userData['password'] = password_hash($password, PASSWORD_BCRYPT);
				}else{
					$this->response([
						'status' => 1,
						'message' => 'Old password does not match.',
						'data' => (object)[]
					], REST_Controller::HTTP_OK);
					exit;
				} 
            } 
			  
			$userData['profile'] = '';
			if(isset($_FILES['profile']['name'])){
						
				$filename 	=  $_FILES['profile']['name'];
				
				$uploaddir 	= $this->config->item('customer_img_basepath'); // get wordpress upload directory
				$myDirPath 	= $this->config->item('customer_img_basepath');
				$myDirUrl 	= $this->config->item('customer_img_url');
				
				/* unlink if profile pic change */
				if(!empty($user['profile']) && $filename != $user['profile']){
					if(file_exists($uploaddir.$user['profile']))
						unlink($uploaddir.$user['profile']);
				}
				/* unlink if profile pic change */
				
				$MyImage 	= rand(0,5000).$_FILES['profile']['name'];
				$image_path = $myDirPath.'/'.$MyImage;
				move_uploaded_file($_FILES['profile']['tmp_name'],$image_path);
 
				$file = $MyImage;
				$uploadfile = $myDirPath.'/' . basename( $file );
				$filename = basename( $uploadfile ); 
				$userData['profile'] = $file;
			 
			} 
			    
            $update = $this->common_model->update_data('online_customer',$userData, array('id' => $id));
              $query = $this->db->get_where('online_customer', array('id' => $id));
			$user = $query->row_array();
            // Check if the user data is updated
            if($update){
				 
				 
				if(!empty($result['profile']) && file_exists($this->config->item('customer_img_basepath').$result['profile']))
				{
					$user['profile'] = $this->config->item('customer_img_url').$user['profile'];
				}
				else{
					$user['profile'] = $this->config->item('customer_img_url').$user['profile'];
				}
				
				 
				
				
                // Set the response and exit
                $this->response([
                    'status' => 1,
                    'message' => 'The profile info has been updated successfully.',
					'data' => $user
                ], REST_Controller::HTTP_OK);
            }else{
                
				$this->response([
                    'status' => 1,
                    'message' => 'Some problems occurred, please try again.',
					'data' => (object)[]
                ], REST_Controller::HTTP_OK);
            }
        }else{
            // Set the response and exit
			$this->response([
                    'status' => 1,
                    'message' => 'Provide at least one user info to update.',
					'data' => (object)[]
                ], REST_Controller::HTTP_OK);
        }
		exit; 
    }
	
	public function forgot_password_post(){
   
		$email = $this->input->post('email');

		if(empty($email)){
			$this->response([
                    'status' => 0,
                    'message' => 'email is required.',
                    'data'=>(object)[]
				], REST_Controller::HTTP_OK); 
			exit;
		} 
		$query	   = $this->db->get_where('online_customer', array('email' => $email));
		$findemail = $query->row_array();
		
				if($findemail){
					$data1['email']= $email;
					$passwordplain = "";
					$passwordplain = rand(999999999,9999999999);
					$data1['password'] = password_hash($passwordplain, PASSWORD_BCRYPT);
					
					if($this->api_model->sendpassword($data1)){
				  
						$config				= array();
						$config['protocol']	= 'sendmail';
						$config['mailpath']	= '/usr/sbin/sendmail';
						$config['charset']	= 'iso-8859-1';
						$config['wordwrap']	= TRUE;
						$config['mailtype']	= 'html';
						$config['newline']	= "\r\n";

						$data['to']=$email;
						$data['passwordplain']=$passwordplain;
						$data['email']=$email;
						$this->email->initialize($config);
						$message_body=$this->load->view('email_template/emailtemplate',$data,true);
								
						//$userinfo=getCurrentUser();
						
						$this->email->from('no-reply@' . $_SERVER['SERVER_NAME'], 'Zamy');
		
						$this->email->to($email);
						
						$this->email->subject('Forgot Password - Zamy');
						$this->email->message($message_body);
						$this->email->set_newline("\r\n");
						$this->email->set_crlf("\r\n");
					
						if ($this->email->send()) {
							
							$success = "successful";
							$message = "Password sent to your email address. if not display in inbox then check spam folder!";
						} 
						else {
							$success = "Failed";
							$message = "Failed to send password, please try again!";
						}
				  }else{
						$success = "Failed";
						$message = "Please try after sometime.";
				  }
				}else{
					$success = "Failed";
					$message = "Your e-mail address is not valid or doesn't exist.";
				}
			 
		$result = $success;
		  
		if($result){
			// Set the response and exit
			$this->response([
				'status' => 1,
				'message' => $message,
				'data' => $result
			], REST_Controller::HTTP_OK);
		}else{
			// Set the response and exit
			//BAD_REQUEST (400) being the HTTP response code
			 $this->response([
				'status' => 0,
				'message' => 'Data not found.',
				'data'=>(object)[]
			 ], REST_Controller::HTTP_OK); 
		}
		exit;
    }
	 
	public function get_user_profile_post() {
		 
		$user_id = $this->input->post('user_id');
		 
		 if(!empty($user_id)){
				 
			$result = $this->common_model->getRows('online_customer', array('id' => $user_id));
			  
			if($result){
				$profile_pic ='';
				if(!empty($result['profile']) && file_exists($this->config->item('customer_img_basepath').$result['profile']))
				{
					$profile_pic = $result['profile'];
				}
				
				$data = array(
						'id'		 	=> $result['id'], 
						'name'  		=> $result['name'],
						'phone'		 	=> $result['phone'],
						'profile_pic' 	=> $this->config->item('customer_img_url').$profile_pic,
						'email' 		=> $result['email'], 
						'password' 		=> $result['password'],
						'location' 		=> $result['location'], 
						'country' 	    => $result['country'], 
						'state' 		=> $result['state'], 
						'city' 			=> $result['city'], 
						'status' 		=> $result['status'], 
						'created_date'  => $result['created_date'], 
					);
				
				
                // Set the response and exit
                $this->response([
                    'status' => 1,
                    'message' => 'Get user profile successfully.',
                    'data' => $data
                ], REST_Controller::HTTP_OK);
            }else{
                // Set the response and exit
                //BAD_REQUEST (400) being the HTTP response code
				 $this->response([
                    'status' => 0,
                    'message' => 'Wrong user_id.',
                   'data'=>(object)[]
				], REST_Controller::HTTP_OK); 
            }
		 }
		 else{
			 // Set the response and exit
			$this->response([
                    'status' => 0,
                    'message' => 'user_id is required.',
                    'data'=>(object)[]
				], REST_Controller::HTTP_OK); 
		}
		exit;
    } 

	public function reset_password_post() {
		 
		$user_id 	  = $this->input->post('user_id'); 
		$old_password = $this->input->post('old_password');
		$new_password = $this->input->post('new_password');
		 
		if(!empty($old_password) && !empty($user_id) && !empty($new_password)){
		 
		$this->db->where('id',$user_id); 
		$query = $this->db->get('online_customer');

			$user = array();
			if ($query->num_rows() == 0){
				 $this->response([
					'status'=>0,
					'message'=>"No user Found.",
					'data'=>(object)[]
				], REST_Controller::HTTP_OK); 
			}
			else{
				//Compare the password attempt with the password we have stored.
				$result = $query->row_array(); 
				$validPassword = password_verify($old_password, $result['password']); 
				if($validPassword){
					
					$user_data = array(	 
						'password' 	=> password_hash($new_password, PASSWORD_BCRYPT),
					); 
					$update_pass = $this->common_model->update_data('online_customer',$user_data,array('id' => $user_id));
					
					if($update_pass){
						 $this->response([
							'status' => 1,
							'message' => 'Password change sucessfully.',
							'data' => $update_pass
						], REST_Controller::HTTP_OK);
					}
					else{
						 $this->response([
							'status' => 0,
							'message' => 'Wrong user_id.',
							'data'=>(object)[]
							], REST_Controller::HTTP_OK); 
					}  
				}
				else{
					 $this->response([
							'status' => 0,
							'message' => 'Old password not match.',
							'data'=>(object)[]
						], REST_Controller::HTTP_OK); 
				}
			}
		}
		else{
		 // Set the response and exit
		$this->response([
				'status' => 0,
				'message' => 'user_id & old_password & new_password is required.',
				'data'=>(object)[]
			  ], REST_Controller::HTTP_OK); 
		}
		exit;
    } 
	
	public function update_token_post(){
		
		$user_id 	 = $this->input->post('user_id'); 
		$fire_token	 = $this->input->post('fire_token');
		$device_type = $this->input->post('device_type');
		
		$req_field = ''; 
		
		foreach($_POST as $key=>$val){
			 
		if(empty($_POST[$key]) ){
				 
				$req_field  = $key;
				break;
			}
		}
		
		if(!empty($req_field)){
			
			$this->response([
                    'status' => 0,
                    'message' => $req_field.' is required.',
                    'data' => ''
                ], REST_Controller::HTTP_BAD_REQUEST);
				
		}else{
			$user_data = array(
							'fire_token' => $fire_token,
							'device_type' => $device_type, 
							);
			$update_token = $this->common_model->update_data('online_customer',$user_data,array('id' => $user_id));
			if($update_token){
				 $this->response([
					'status' => 1,
					'message' => 'Update fire token sucessfully.',
					'data' => $update_token
				], REST_Controller::HTTP_OK);
			}
			else{
				 $this->response([
					'status' => 0,
					'message' => 'Something went wrong.',
					'data'=>(object)[]
					], REST_Controller::HTTP_OK); 
			}  		
			
		}
	}
	
	public function get_refer_code_post() {
		 
		$user_id = $this->input->post('user_id');
		 
		 if(!empty($user_id)){
			$refer_data['conditions'] 	= array('user_id'=>$user_id); 
			$refer_data['returnType'] 	= 'single';
			$result 				 	= $this->common_model->getRows('referrals_data',$refer_data);	 
						 
			if($result){
				 
				$data['earning_point'] = $result['earn_point'] ;
				$data['cover_image']	= base_url().'uploads/SiteConfig/referral_banner.jpg';
				$data['main_image'] 	= base_url().'uploads/SiteConfig/referral_banner.jpg';
				$data['offer'] 		= '';
				$data['reffaral_code'] = $result['my_referral_code'];
				$refferal_date			= $result['date_added']; 
				$data['offer_validity'] = 'Valid till '.date('d, M Y', strtotime($refferal_date)).'';
				$data['invite_message'] = 'Register on Zamy with Referral Code '.$result['my_referral_code'].' and earn 25 point. Download ZAMY app from android: https://play.google.com/store/apps/details?id=com.attune.zamy&'.$result['my_referral_code'].' & from iOS : https://apps.apple.com/us/app/zamy/id1487781178';
				  
                // Set the response and exit
                $this->response([
                    'status' => 1,
                    'message' => 'Get referral code successfully.',
                    'data' => $data
                ], REST_Controller::HTTP_OK);
            }else{
                // Set the response and exit
                //BAD_REQUEST (400) being the HTTP response code
				 $this->response([
                    'status' => 0,
                    'message' => 'No data found',
                   'data'=>(object)[]
				], REST_Controller::HTTP_OK); 
            }
		 }
		 else{
			 // Set the response and exit
			$this->response([
                    'status' => 0,
                    'message' => 'user_id is required.',
                    'data'=>(object)[]
				], REST_Controller::HTTP_OK); 
		}
		exit;
    } 

	 
    public function logout_post() {
        // Get the post data
        $user_id = $this->post('user_id'); 
        
        // Validate the post data
        if(!empty($user_id)){
				 
			$this->db->where('id',$user_id); 
            $query = $this->db->get('online_customer');
			
			$user = array();
			if ($query->num_rows() == 0){
				 $this->response([
					'status'=>0,
					'message'=>"Wrong user_id",
					'data'=>(object)[]
				], REST_Controller::HTTP_OK);
			}
			else{
			
				$user_data = array(
							'fire_token' => '',
							'device_type' => '', 
							);
				$update_token = $this->common_model->update_data('online_customer',$user_data,array('id' => $user_id));
				  
				if($update_token){	 
					// Set the response and exit
					$this->response([
						'status' => 1,
						'message' => 'User logout successful.',
						'data' => $update_token
					], REST_Controller::HTTP_OK);
				}else{
					// Set the response and exit
					//BAD_REQUEST (400) being the HTTP response code
					$this->response([
						'status'=>0,
						'message'=>"Wrong user_id",
						'data'=>(object)[]
					], REST_Controller::HTTP_OK);
				}
			}	
		}
		else{
            // Set the response and exit
            $this->response([
					'status'=>0,
					'message'=>'user_id is required.',
					'data'=>(object)[]
				], REST_Controller::HTTP_OK);
        }
		exit; 
    }
     
	
	public function get_app_version_get() {
		 
	  //$device_type = $this->input->post('device_type'); 
		$result = $this->common_model->getRows('vesrion', array('id' => 1));
		  
		if($result){
			  
			// Set the response and exit
			$this->response([
				'status' => 1,
				'message' => 'Get version successfully.',
				'data' => $result
			], REST_Controller::HTTP_OK);
		}else{
			// Set the response and exit
			//BAD_REQUEST (400) being the HTTP response code
			 $this->response([
				'status' => 0,
				'message' => 'Data not found.',
			   'data'=>(object)[]
			], REST_Controller::HTTP_OK); 
		}
		   
		exit;
    }

	function social_signup_post(){
   
		$ip 	  = $_POST['deviceID'];
		$type 	  = (trim($_POST["type"])); 
		$username = addslashes(trim($_POST["username"]));
		$email 	  = addslashes(trim($_POST["email"]));
		$mobile   = addslashes(trim($_POST["mobile"]));
		 
		 
		 
		if(empty($ip)){
			 $this->response([
					'status'=>0,
					'message'=>"deviceID is required.",
					'data'=>(object)[]
				], REST_Controller::HTTP_OK); 
			 
			exit();
		} 
		else{ 
			if(!empty($mobile) || !empty($email)){
				 
				$this->db->where('email',$email);
				$this->db->where('type',null);  		
				$query = $this->db->get('online_customer');
/* 				$user = $query->row_array(); 
				 echo $this->db->last_query(); */
				if($query->num_rows() != 0){
					
					$this->response([
						'status' => 0,
						'message' => 'User already exist.',
						'data' => (object)[]
					], REST_Controller::HTTP_OK); 
				}else{
				
					$this->db->where('type',$type);  
					$this->db->where('email',$email);  
					$query = $this->db->get('online_customer');
					  
					if ($query->num_rows() != 0){
						   
						$user = $query->row_array(); 
						  
						$this->response([
							'status' => 1,
							'message' => 'Login successfully.',
							'data' => $user
						], REST_Controller::HTTP_OK); 
						
					}
					else{
				
						$user_data = array(
							'phone' 		=> !empty($mobile) ? $mobile:'',
							'name' 			=> $username,
							'email' 		=> $email, 
							'type'			=> $type
						);
						
					   $register = $this->common_model->add_data('online_customer',$user_data);
					   $user_id  = $this->db->insert_id();
						$current_date =  date('Y-m-d');
						
						$referral_data = array(
							'user_id' 				=> $user_id,
							'my_referral_code' 		=> my_random_string(),
							'from_referral_code'	=> '',
							'status'				=> 1,
							'date_added'			=>  date('Y-m-d', strtotime("+6 months", strtotime($current_date))),
							'earn_point'			=> 0,
						);  
						$register = $this->common_model->add_data('referrals_data',$referral_data);
							
						if($register){
						  
							$this->db->where('email',$email); 
							$query = $this->db->get('online_customer');
							$user = $query->row_array(); 
							  
							$this->response([
								'status' => 1,
								'message' => 'Register successfully.',
								'data' => $user
							], REST_Controller::HTTP_OK); 
						}else{
							 $this->response([
								'status'=>0,
								'message'=>'Somethig went wrong please try again.',
								'data'=>(object)[]
							], REST_Controller::HTTP_OK); 
						} 
					}
				}
			}
			
		} 	 
		exit; 
	}
	  
}