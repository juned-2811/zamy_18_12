<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

// Load the Rest Controller library
require APPPATH . '/libraries/REST_Controller.php';

class Delivery_api extends REST_Controller {

    public function __construct() { 
        parent::__construct();
        $this->load->model('api/Api_model','api_model');
		$this->load->model('common_model');
		$this->load->helper('push_notification');
        // Load the user model 
    }
     
	public function login_post() {
        // Get the post data
        $username = $this->post('username');
        $password = $this->post('password');
        
        // Validate the post data
        if(!empty($username) && !empty($password)){
				 
			$this->db->where('username',$username);
			$this->db->or_where('email',$username);
			 
            $query = $this->db->get('delivery_boy');
        
			$user = array();
			if ($query->num_rows() == 0){
				 $this->response([
					'status'=>0,
					'message'=>"Wrong email or password",
					'data'=>''
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
				
				$user_data = array(
								'ID'	=> $user['id'],
								'user_login' => $user['id'],
								'user_pass' => $user['password'],
								'user_nicename' => $user['full_name'],
								'user_email' => $user['email'], 
								'user_status' => $user['status'],
								'display_name' => $user['username'],
								'get_avatar_url' => $user['profile_pic'],
								'mobile' => $user['phone'],
							);
				
                // Set the response and exit
                $this->response([
                    'status' => 1,
                    'message' => 'User login successful.',
                    'data' => $user_data
                ], REST_Controller::HTTP_OK);
				
            }else{
                // Set the response and exit
                //BAD_REQUEST (400) being the HTTP response code
                $this->response([
					'status'=>0,
					'message'=>"Wrong email or password",
					'data'=>''
				], REST_Controller::HTTP_OK);
            }
        }else{
            // Set the response and exit
            $this->response([
					'status'=>0,
					'message'=>'Provide email and password.',
					'data'=>''
				], REST_Controller::HTTP_BAD_REQUEST);
        }
    }

	public function get_profile_post() {
		 
		$user_id = $this->input->post('user_id');
		 
		 if(!empty($user_id)){
				 
			$result = $this->common_model->getRows('delivery_boy', array('id' => $user_id));
			 
			if($result){
				$profile_pic = ''; 
				if(!empty($result['profile_pic']) && file_exists($this->config->item('customer_image_basepath').$result['profile_pic'])){
					$profile_pic = $result['profile_pic'];
				}
				$data = array(
							'ID' => $result['id'], 
							'user_login' => $result['username'],
							'user_nicename' => $result['full_name'],
							'user_email' => $result['email'],
							'user_status' => $result['status'],
							'display_name' => $result['username'],
							'get_avatar_url' => $this->config->item('customer_image_url').$profile_pic,
							'mobile' => $result['phone'], 
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
	
	public function get_order_list_post() {
		 
		$delivery_boy_id = $this->input->post('user_id');
		$type  			 = $this->input->post('type');
		//type:history / upcoming/ current
		if (isset($_POST['pageno'])) {
			$pageno = $_POST['pageno'];
		} else {
			$pageno = 1;
		}
	
		if(!empty($delivery_boy_id) && !empty($type)){
				 
			$offset	='0'; 
			$limit 	= 10;
			$offset = ($pageno-1) * $limit; 
			$total_row='total_row';
				
			$total_rows			= $this->api_model->get_deliveryboy_order_list($delivery_boy_id,$type,$limit,$offset,$total_row); 
			$result['total_rows'] = $total_rows;
			$result['total_pages']= ceil($total_rows / $limit); 	  
			$order = $this->api_model->get_deliveryboy_order_list($delivery_boy_id,$type,$limit,$offset);
			 
			if($order){
				$restaurant_address = '';
				foreach($order as $row){
					
					$restaurant_address .= $row['address'];
					$restaurant_address .= $row['landmark'].", ";
					$restaurant_address .= $row['area'].", ";
					$restaurant_address .= $row['city'].", ";
					$restaurant_address .= $row['state']."-";
					$restaurant_address .= $row['zipcode'];
					 
					$order_list[] =  array(
										'id' => $row['id'],
										'order_id' => $row['id'],
										'sub_order_id' => '',
										'meal_type' => '',
										'quantity' => $row['total_items'],
										'delivery_boy_id' => $row['delivery_boy_id'],
										'shipping_address' => $row['shipping_address'],
										'order_date' => $row['created_date'],
										'order_status' => $row['order_status'],
										'assigned_date' => date('d-m-Y', strtotime($row['assigned_date'])),
										'assigned_date_time' => $row['assigned_date'],
										'time_ago' => '',
										'order_total' => $row['order_total'],
										'current_let' => $row['latitude'],
										'current_long' => $row['longitude'], 
										'job_accepted_status' => $row['job_accepted_status'],
										'kitchens_status' =>$row['kitchens_status'],
										'restaurant_name' => $row['res_name'],
										'restaurant_address' => $restaurant_address, 	
									 );
				}
				 
				$result['list'] = $order_list; 
                // Set the response and exit
                $this->response([
                    'status' => 1,
                    'message' => 'Get order List.',
                    'data' => $result
                ], REST_Controller::HTTP_OK);
            }else{
                // Set the response and exit
                //BAD_REQUEST (400) being the HTTP response code
				 $this->response([
                    'status' => 0,
                    'message' => 'No data found.',
                    'data' => (object)[]
                ], REST_Controller::HTTP_OK);
            }
		 }
		 else{
			 // Set the response and exit
			$this->response([
                    'status' => 0,
                    'message' => 'user_id & type is required.',
                    'data' => ''
                ], REST_Controller::HTTP_OK);
		}
		exit;
    }
	
	public function get_order_detail_post() {
		 
		$order_id = $this->input->post('order_id');
		 
		 if(!empty($order_id)){
				 
			$result = $this->api_model->get_order_detail($order_id);
			//echo $this->db->last_query();
			if($result){
				 
				 $order_data = array(
								'order_id' => $result['id'],
								'item_quantity' => $result['total_items'],
								'order_date' => $result['created_date'],
								'order_status' => $result['order_status'],
								'delivery_date' => $result['delivery_date'],
								'assigned_date_time' => $result['assigned_date'],
								'job_accepted_status' => $result['job_accepted_status'],
								'time_ago' => '',
								'payment_method' => $result['payment_method'],
								'order_total' => $result['order_total'],
								'billing_name' => $result['name'],
								'billing_address' => $result['location'],
								'billing_email' => $result['email'], 
								'billing_phone' => $result['phone'],
								'shipping_address' => $result['shipping_address'],
								'shipping_lat' => $result['shipping_lat'],
								'shipping_lng' => $result['shipping_lng'],
								'shipping_phone' => $result['shipping_phone'],
								'shipping_cost' => $result['delivery_charge'],
							   );
		
			$order_items = $this->api_model->get_order_items($order_id);
			foreach($order_items as $items){
				
				$choice = explode(',', $items['choice']); 
				$food_type = 'veg'; //For veg
				if(in_array('2',$choice)){   

					$food_type = 'non-veg';  //For non-veg
				}
				
				$menu_logo 	 = 'no_image_food.png'; 		
				$swiggy_logo = 'no_image_food.png'; 		 
				if(!empty( $items['menu_logo']) && file_exists($this->config->item('foodMenu_image_basepath').$items['menu_logo'])){
					$menu_logo 	 = $items['menu_logo'];
					$swiggy_logo = $items['swiggy_logo'];
				}
				$order_data['items'][] = array(
											'food_type' => $food_type, 
											'menu_name' => $items['menu_name'],
											'variation_name' => $items['variation_name'],
											'qty' => $items['qty'],
											'menu_logo' => $this->config->item('foodMenu_image_url').$menu_logo,
											'swiggy_logo' => $this->config->item('foodMenu_image_url').$swiggy_logo, 
											'subtotal' => $items['subtotal'],  
										 );
			}	
                // Set the response and exit
                $this->response([
                    'status' => 1,
                    'message' => 'Get order Details.',
                    'data' => $order_data
                ], REST_Controller::HTTP_OK);
            }else{ 
                // Set the response and exit
                //BAD_REQUEST (400) being the HTTP response code
				 $this->response([
                    'status' => 0,
                    'message' => 'Wrong order_id.',
                    'data' => ''
                ], REST_Controller::HTTP_BAD_REQUEST);
            }
		 }
		 else{
			 // Set the response and exit
			$this->response([
                    'status' => 0,
                    'message' => 'order_id is required.',
                    'data' => ''
                ], REST_Controller::HTTP_BAD_REQUEST);
		}
		exit;
    }
	
	public function update_order_status_post(){
		        
		$order_id	= $this->input->post('order_id');
		$latitude	= $this->input->post('latitude');
		$longitude	= $this->input->post('longitude');
		$status		= $this->input->post('status');
		if(isset($_POST['angle'])){
			$angle	= $this->input->post('angle');
		} 
		
		if(empty($order_id)){
			 
				 $this->response([
                    'status' => 0,
                    'message' => 'order_id is required.',
                    'data' => ''
                ], REST_Controller::HTTP_BAD_REQUEST);
		}
		/*elseif(empty($latitude)){
			 
				 $this->response([
                    'status' => 0,
                    'message' => 'latitude is required.',
                    'data' => ''
                ], REST_Controller::HTTP_BAD_REQUEST);
		}
		elseif(empty($longitude)){
			 
				 $this->response([
                    'status' => 0,
                    'message' => 'longitude is required.',
                    'data' => ''
                ], REST_Controller::HTTP_BAD_REQUEST);
		}*/
		elseif(empty($status)){
			 
				 $this->response([
                    'status' => 0,
                    'message' => 'status is required.',
                    'data' => ''
                ], REST_Controller::HTTP_BAD_REQUEST);
		}
		else{
			
			$data  = array('job_accepted_status' => $status );
			
			if(isset($latitude) && !empty($latitude)){
					$data += array(
								'shipping_lat' => $latitude,
								'shipping_lng' => $longitude
							   );
			}
			if($status == 'Accepted')  {
			 $data  += array('accepted_date' => date('Y-m-d H:i:s') );
			}
			if($status == 'Delivered')  {
			 $data  += array('delivery_date' => date('Y-m-d H:i:s') );
			}
			if($status == 'Rejected')  {
			 $data  += array('is_rejected' => 1);
			}
			$where = array( 'order_id' => $order_id );
			 
			$result= $this->common_model->update_data('assign_delivery_boy',$data,$where);
			 
			 if($status == 'Delivered')  {
				 $order_where = array( 'id' => $order_id );
				 $order_data = array( 'order_status' => 'completed' );
				 $this->common_model->update_data('orders',$order_data,$order_where);
				 
				/* Push notification */
						
					$order_data['conditions'] 	= array('id'=>$order_id);
					$order_data['fields'] 		= 'user_id';
					$order_data['returnType'] 	= 'single'; 
					$order						= $this->common_model->getRows('orders',$order_data);
					//Order Delivered for Customer 
					$notification_type='3';  
					push_notification($order_id,$order['user_id'],$notification_type);
						 
				/* Push notification */
			 }
			  if($status == 'On the way')  {
				 $order_where = array( 'id' => $order_id );
				 $order_data = array( 'order_status' => 'On the way' );
				 $this->common_model->update_data('orders',$order_data,$order_where);
				 
				/* Push notification */
						
					$order_data['conditions'] 	= array('id'=>$order_id);
					$order_data['fields'] 		= 'user_id';
					$order_data['returnType'] 	= 'single'; 
					$order						= $this->common_model->getRows('orders',$order_data);
					//Order Delivered for Customer 
					$notification_type='6';  
					push_notification($order_id,$order['user_id'],$notification_type);
						 
				/* Push notification */
			 }
			 
			if($result){
                // Set the response and exit
                $this->response([
                    'status' => 1,
                    'message' => 'Update order status successfully.',
                    'data'   => $result 
                ], REST_Controller::HTTP_OK);
            }else{
                //BAD_REQUEST (400) being the HTTP response code
				 $this->response([
                    'status' => 0,
                    'message' => 'No found any data.',
                    'data' => ''
                ], REST_Controller::HTTP_BAD_REQUEST);
            }
		}
		exit;
	}
	 // 22.9923 72.5142
	public function update_deliveryboy_latlong_post(){
		
		$user_id	= $this->input->post('user_id');	
		$latitude	= $this->input->post('latitude');
		$longitude	= $this->input->post('longitude');
		 	$angle	= '';
		if(isset($_POST['angle'])){
			$angle	= $this->input->post('angle');
		} 
		
		if(empty($user_id)){
			 
				 $this->response([
                    'status' => 0,
                    'message' => 'user_id is required.',
                    'data' => ''
                ], REST_Controller::HTTP_BAD_REQUEST);
		}
		elseif(empty($latitude)){
			 
				 $this->response([
                    'status' => 0,
                    'message' => 'latitude is required.',
                    'data' => ''
                ], REST_Controller::HTTP_BAD_REQUEST);
		}
		elseif(empty($longitude)){
			 
				 $this->response([
                    'status' => 0,
                    'message' => 'longitude is required.',
                    'data' => ''
                ], REST_Controller::HTTP_BAD_REQUEST);
		}
		 
		else{
			$data  = array('latitude' => $latitude,
						   'longitude' => $longitude,
						   'angle' => $angle
						   );
			$where = array( 'id' => $user_id );
			$result= $this->common_model->update_data('delivery_boy',$data,$where);
			 
			if($result){
                // Set the response and exit
                $this->response([
                    'status' => 1,
                    'message' => 'Successfully updated Delivery boy Info.',
                    'data'   => $result 
                ], REST_Controller::HTTP_OK);
            }else{
                //BAD_REQUEST (400) being the HTTP response code
				 $this->response([
                    'status' => 0,
                    'message' => 'No found any data.',
                    'data' => ''
                ], REST_Controller::HTTP_BAD_REQUEST);
            }
		}
		exit;
	}
	
	public function update_deliveryboy_token_post(){
		
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
			$update_token = $this->common_model->update_data('delivery_boy',$user_data,array('id' => $user_id));
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
	
	
	public function get_delivery_list_get(){
		
		$this->db->select('orders.id, orders.restaurant_id, orders.total_items,orders.created_date, orders.shipping_address,orders.order_status, orders.order_total,orders.kitchens_status, kitchens.res_name,kitchens.address,kitchens.landmark,kitchens.area,kitchens.city,kitchens.state,kitchens.zipcode,kitchens.latitude,kitchens.longitude'); 
		$this->db->from('orders');
		$this->db->join('kitchens','kitchens.id = orders.restaurant_id','left');
		$this->db->where_in('orders.order_status',array('processing'));
		
		$order_result = $this->db->get()->result_array();	
		
		$order_list = array();
		$restaurant_address = '';
		foreach($order_result as $order){
			
			$restaurant_address .= $order['address'];
			$restaurant_address .= $order['landmark'].", ";
			$restaurant_address .= $order['area'].", ";
			$restaurant_address .= $order['city'].", ";
			$restaurant_address .= $order['state']."-";
			$restaurant_address .= $order['zipcode'];
			
			$order_id 				= $order['id'];
			$total_items 			= $order['total_items'];
			$shipping_address 		= $order['shipping_address'];
			$order_date 			= $order['order_date'];
			$order_status 			= $order['order_status'];
			$order_total 			= $order['order_total'];
			$kitchens_status 		= $order['kitchens_status'];
			$restaurant_name 		= $order['res_name'];
			$restaurant_address 	= $restaurant_address;
			
			
			$latitudes 				= $order['latitude'];
			$longitudes 			= $order['longitude'];
			
			
			if(!empty($latitudes) && !empty($longitudes)){
				
			
				$SQL = ('SELECT id
						  FROM (
						 SELECT z.id,
								z.latitude, 
								z.longitude,
								p.radius,
								p.distance_unit
										 * DEGREES(ACOS(COS(RADIANS(p.latpoint))
										 * COS(RADIANS(z.latitude))
										 * COS(RADIANS(p.longpoint - z.longitude))
										 + SIN(RADIANS(p.latpoint))
										 * SIN(RADIANS(z.latitude)))) AS distance
						  FROM delivery_boy AS z
						  JOIN (   SELECT  '.$latitudes.'  AS latpoint,  '.$longitudes.' AS longpoint,
										5.0 AS radius,      111.045 AS distance_unit
							) AS p ON 1=1
						  WHERE z.latitude
							 BETWEEN p.latpoint  - (p.radius / p.distance_unit)
								 AND p.latpoint  + (p.radius / p.distance_unit)
							AND z.longitude
							 BETWEEN p.longpoint - (p.radius / (p.distance_unit * COS(RADIANS(p.latpoint))))
								 AND p.longpoint + (p.radius / (p.distance_unit * COS(RADIANS(p.latpoint))))
						 ) AS d
						 WHERE distance <= radius
						 ORDER BY distance');
							
				$query = $this->db->query($SQL);

				$result = $query->result_array();
				if(!empty($result)){
					
					foreach($result  as $val){
						
						$new_data['delivery_boy_id']  	= $val['id'];
						$new_data['id']  				= $order_id;
						$new_data['order_id']  			= $order_id;
						$new_data['sub_order_id']  		= '';
						$new_data['meal_type']  		= '';
						$new_data['quantity']  			= $total_items;
						echo "<pre>";
						print_r($val);
						echo "</pre>";
						
					}
				}
			}
			
		}
		
		
	  }
}