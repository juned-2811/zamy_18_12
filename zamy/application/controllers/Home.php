<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Home extends CI_Controller {
	
	function __construct() {
		parent::__construct();
		$this->load->model('common_model');
		$this->customer_id = $this->session->userdata('cust_id');
		 
		$array_items = array('location', 'pincode','current_area' );

				//$this->session->unset_userdata($array_items); exit;
	}
	 
	public function index(){
 

		//if($this->session->has_userdata('location') || $this->session->has_userdata('cust_id')){
		  	$location = $this->input->post('location');
			if($this->input->post('location')){  
			  	$location = $this->input->post('location');
				$current_url = $this->input->post('current_url');

				$user_data = array(
					'location' 	=> $location
				);
				
				if(!empty($location)){
					$this->session->set_userdata($user_data);
				}
				
				$check_saved_locaion = $this->common_model->get_field_by_id('online_customer','location',array('id'=>$this->customer_id));
				
				$this->common_model->update_data('online_customer',array('location'=>$location),array('id'=>$this->customer_id));
				
				if(!empty($current_url)){
					redirect($current_url, 'refresh');
				}else{
					redirect(base_url(), 'refresh');
				} 
			} 
			  
			$query_area['fields'] 	= 'area';
			$area_list			  	= $this->common_model->get_areas('kitchens',$query_area); 
			$query_data['fields'] 	= array('id','res_name','res_alias','logo','images','approx_delivery_time','approx_cost','service_type');
			$query_data['conditions'] = array('status' => 1);
			//$query_data['limit'] = 12;
			$all_restaurants = $this->common_model->getRows('kitchens',$query_data);

			$data['bottom_featured_restaurant'] = get_bottom_featured_restaurant();
			$data['get_populer_this_month'] = populer_this_month_food();
			$restaurant_id		 	  = 3;
			$cat_array = get_food_category_array();
            $new_arr   = replaceKeys('food_cate_title','cat_name',$cat_array);
            $i = 0;
            $only_val  = array();
            foreach ($new_arr as $food_rec => $food_val) {
            	$only_val[$i] = $food_val;
            	$i++;
            }

            $data['food_cat'] =  array_values($new_arr);
			$data['fav_food_enjoy']   = $this->common_model->fav_food_enjoy($restaurant_id);
			$data['fav_food_by_user'] = get_fav_food_by_user($this->customer_id);  
		    $data['data'] 		      = $this->common_model->get_data_by_id(array('id'=>1),'site_config');
		    $data['home_topres']     = $this->common_model->home_top_featured_restaurant();
			$newdata			     = $this->common_model->get_field_by_id('site_config','data',array('id' => 1));
			$data['get_food_category_array'] = get_food_category_array();
			$data['Home_res_cat_filter'] = $this->common_model->get_data_by_id(array('status'=>1),'homepage_food_cate');
			
			$data['info']   		 = unserialize($newdata);
			$data['res_count']       = Restaurant_count();
			$data['users_count']     = Total_users(); 
			$data['cs_count']        = customer_support_count();
			$data['order_user']      = total_orders_users();
			$data['get_top_res']     = get_top_restaurant();
			$data['all_restaurants'] = $all_restaurants;
			$data['area_list'] 		 = $area_list;
			$data['view'] 			 = 'home/index';
 		
			$this->load->view('layout',$data);
			
		/* }else{
			
			if($this->input->post('search_location')){
				$location = $this->input->post('location');

				$user_data = array(
					'location' 	=> $location
				);
				if(!empty($location)){
					$this->session->set_userdata($user_data);
				}
				
				redirect(base_url(), 'refresh');
			}
			
			$query_data['fields'] = 'area';
			$area_list = $this->common_model->get_areas('kitchens',$query_data);
			
			$data['area_list'] = $area_list;
			$this->load->view('home/location',$data);
		} */
	}
		
	public function test(){
 
		if($this->session->has_userdata('location') || $this->session->has_userdata('cust_id')){
			
			if($this->input->post('location')){
				$location = $this->input->post('location');
				$current_url = $this->input->post('current_url');

				$user_data = array(
					'location' 	=> $location
				);
				
				if(!empty($location)){
					$this->session->set_userdata($user_data);
				}
				
				$check_saved_locaion = $this->common_model->get_field_by_id('online_customer','location',array('id'=>$this->customer_id));
				
				$this->common_model->update_data('online_customer',array('location'=>$location),array('id'=>$this->customer_id));
				
				if(!empty($current_url)){
					redirect($current_url, 'refresh');
				}else{
					redirect(base_url(), 'refresh');
				} 
			}
			
			$query_area['fields'] = 'area';
			$area_list = $this->common_model->get_areas('kitchens',$query_area); 
			$query_data['fields'] = array('id','res_name','res_alias','logo','images','approx_delivery_time','approx_cost','service_type');
			$all_restaurants = $this->common_model->getRows('kitchens',$query_data);
			
			$restaurant_id = 3;
			$data['fav_food_enjoy'] 	= $this->common_model->fav_food_enjoy($restaurant_id);

			$data['all_restaurants'] 	= $all_restaurants;
			$data['area_list'] 			= $area_list;
			$data['view'] 				= 'home/home2';
			$this->load->view('layout',$data);

		}else{ 
			
			if($this->input->post('search_location')){
				$location = $this->input->post('location');

				$user_data = array(
					'location' 	=> $location
				);
				if(!empty($location)){
					$this->session->set_userdata($user_data);
				}
				
				redirect(base_url(), 'refresh');
			}
			
			$query_data['fields'] = 'area';
			$area_list = $this->common_model->get_areas('kitchens',$query_data);
			
			$data['area_list'] = $area_list;
			$this->load->view('home/location',$data);
		}
	}
	
	public function save_location(){
		
		if($this->input->post('pincode')){
			
			$current_area = '';
			$current_address = '';
			$pincode = '';
			
			if(!empty($this->input->post('pincode'))){
				$pincode = $this->input->post('pincode');
			}
			
			if(!empty($this->input->post('current_area'))){
				$current_area = $this->input->post('current_area');
			}
			
			if(!empty($this->input->post('current_address'))){
				$current_address = $this->input->post('current_address');
			}
			

			
			
			$check_service_area = $this->common_model->check_service_area($pincode);
			
			if(!empty($check_service_area)){
				
				$user_data = array(
					'pincode' 		=> $pincode,
					'current_area' 	=> $check_service_area['area'],
					'location' 		=> $current_address,
				);
				
				$this->session->set_userdata($user_data);
			
				if($this->session->has_userdata('cust_id')){
					$this->common_model->update_data('online_customer',array('current_area'=>$check_service_area['area'],'location'=>$current_address),array('id'=>$this->customer_id));
				}
				
				$response['status']= 1;
				$response['current_area']= $check_service_area['area'];
				$response['location']= $current_address;
				$response['message']= 'Location set successfully';
			}else{
				$response['status']= 0;
				$response['current_area']= $current_area;
				$response['location']= $current_address;
				$response['message']= 'Sorry we are not serving in your current location, Select another location.';
			}
			
			
			echo json_encode($response);
			exit;
		}
		
		return true;
	}
	
	public function add_location(){
		
		if($this->session->has_userdata('location') || $this->session->has_userdata('customer_id')){
			redirect('restaurants');
		}
		
		if($this->input->post('search_location')){
			$this->form_validation->set_rules('location', 'location', 'trim|required');
		

			if ($this->form_validation->run() == FALSE) {
				$this->load->view('home/add_location');
			}else {
				$location = $this->input->post('location');

				$user_data = array(
					'location' 	=> $location
				);
				
				$this->session->set_userdata($user_data);
				redirect(base_url('restaurants'), 'refresh');
				
			}
		}
		else{
			$query_data['fields'] = 'area';
			$area_list = $this->common_model->get_areas('kitchens',$query_data);
			
			$data['area_list'] = $area_list;
			$this->load->view('home/add_location',$data);
		}
	}
	
	function sent_otp(){
		
		$ip = session_id();
		$mobile=$this->input->post('mobile');
	
		$query = $this->db->get_where('online_customer', array('phone' => $mobile));
		
		if ($query->num_rows() != 0){
					
			$response["success"] = 0; 
			$response["message"] = "Mobile already exist please login.";
			echo json_encode($response);
			exit();
			
		}else{
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
				$response["success"] = 1;
				$response["message"] = "A verification SMS has been sent to ".$params[ 'Mobile' ];
			}else{
				$response["success"] = 0;  
				$response["message"] = $request_body_explode[1];  	   
			}
			
			echo json_encode($response);
			exit();
		}
		
		
	}
	
	function verify_otp(){
		
		$mobile		= $this->input->post('phone');
		$name		= $this->input->post('name');
		$email		= $this->input->post('email');
		$password	= $this->input->post('password');
		$otp		= $this->input->post('otp');		
		$ip 		= session_id();
		$table_name = 'sms_otp';
		
		$smsdata = query_sms_table( $table_name, array('ip'=>$ip) );
		
		if(!empty($smsdata)){
		
			$myotp=substr($smsdata->last, -4);
			
			if (( $smsdata === NULL ) || ( $smsdata->ip != $ip) || ( $smsdata->last < strtotime( '-3 minutes' ) )) {
				
				$response["success"] = 2;
				$response["message"] = "OTP Expired. Please resend OTP again"; 
				echo json_encode($response);				
				delete_sms_table( $table_name, array('ip'=>$ip) );
				exit();
			}elseif ($otp != $myotp) {
				$response["success"] = 0;  
				$response["message"] = "Invalid OTP";  
				echo json_encode($response);
				exit();	
			}else{
				delete_sms_table( $table_name, array('ip'=>$ip) );
				
				$query = $this->db->get_where('online_customer', array('phone' => $mobile));
				if ($query->num_rows() != 0){
					
					$response["success"] = 0; 
					$response["message"] = "Mobile already exist.";
					echo json_encode($response);
					exit();
					
				}else{
				
					$user_data = array(
						'phone' 		=> $mobile,
						'name' 			=> $name,
						'email' 		=> $email,
						'password' 		=> password_hash($password, PASSWORD_BCRYPT),
					);
					
					$register= $this->common_model->add_data('online_customer',$user_data);
					$register_id = $this->db->insert_id();

					$random_number = my_random_string();

					$referral		= $this->input->post('referral');

					if(!empty($referral)){

						$query = $this->db->get_where('referrals_data', array('my_referral_code' => $referral));
						$get_referral_code = $query->row_array();
					
						if($query->num_rows() != 0){
							$earned_point = $get_referral_code['earn_point'] + 25 ;
							$update = $this->common_model->update_data('referrals_data',array('earn_point' => $earned_point), array('id' =>  $get_referral_code['id']));
						}
						else{

							$response["success"] = 0; 
							$response["message"] = "Referral Code Is Invalid";
							echo json_encode($response);
							exit();
						}
					}

					if(empty($referral)){
						$referral = '';
					}
					$current_date = date('Y-m-d');
					$data = array('user_id' 		 => $register_id,
						 		'my_referral_code' 	 => $random_number,
					 			'from_referral_code' => $referral,
					 			'earn_point' 		 => 0,
								'status'			 => 1,
								'date_added'		 => date('Y-m-d', strtotime("+6 months", strtotime($current_date))),
					 			 
							);
					$rquery = $this->db->insert('referrals_data', $data);

					if($register_id){
						$session_data = array(
							'cust_id' 		=> $register_id,
							'cust_phone' 	=> $mobile,
							'cust_name' 	=> $name,
							'cust_email' 	=> $email,
							'cust_is_login' => TRUE,
						);
						
						$this->session->set_userdata($session_data);
						
						$response["success"] = 1; 
						$response["message"] = "SMS verification successful.";
						echo json_encode($response);
						exit();
					}else{
						$response["success"] = 2; 
						$response["message"] = "Somethig went wrong please try again.";
						echo json_encode($response);
						exit();
					}					 
				}
			}
		}else{
			$response["success"] = 2;  
			$response["message"] = "Expired or Invalid OTP";  
			echo json_encode($response);
			exit();	
		}
	}
	
	public function change_location(){
		$current_location = $this->input->post('current_location');
		$current_url = $this->input->post('current_url'); 
		$this->session->set_userdata(array('current_location' => $current_location));
		
		if(!empty($current_location))
			redirect($current_url);
		else
			redirect('restaurants');
	}


	public function privacy_policy(){
		$data['view'] = 'home/privacy_policy';
		$this->load->view('layout',$data);
	}

	public function filter_res_foods(){
		$id = $this->input->post('id');
		$all_choice = $this->common_model->get_field_by_id('homepage_food_cate','choice',array('id'=>$id));
		$data = config_food_filter_food_category($all_choice);
		$html = '';
		$html .= '<div class="row">';
		$html .= '<div class="masonry">';
	   if (!empty($data)) {

       foreach ($data as $filter_res) {
          $res_cat_title = $filter_res['food_cate_title'];
          $menu_name      = $filter_res['menu_name'];
          $restaurant_id = $filter_res['id'];
          $add           = $filter_res['address'];
          $ser_type      = $filter_res['service_type'];
          $res_alias     = $filter_res['res_alias'];
          $approx_amt    = $filter_res['approx_cost'];
          $res_name      = $filter_res['res_name'];
          $foodmenu_id   = $filter_res['foodmenu_id'];
          $reduced_price = $filter_res['reduced_price']; 
          $food_price    = $filter_res['price'];           
          //$menu_logo = $filter_res['menu_logo']
		  $choice		 = explode(',',$filter_res['food_menu_choice']);
		  $fav_res = get_count_fav_food_by_users($foodmenu_id);
		    if (!empty($fav_res)) {
             $total_fav_res_all =  $fav_res['total_fav_res'];
            }
            else{
             $total_fav_res_all = 0;
            }
          $res_ratings = get_rating_restaurant_id($restaurant_id);
          if (!empty($res_ratings)) {
          	$all_ratings = $res_ratings['ratings'] % 5;
          }else{
            $all_ratings = 0;
          }
          $set_alias = base_url('restaurants/'.$res_alias);
           $menu_logo = 'no_image_resto.jpg'; 
	       if(!empty($res_alias) && file_exists( $this->config->item('foodMenu_image_basepath').$filter_res['menu_logo'])){
			    $menu_logo = $filter_res['menu_logo']; 
			}
		   if(!empty($menu_logo)){
		   	$menu_path = $this->config->item('foodMenu_image_url').$menu_logo;
		   }
          //$result=array_intersect($cat_choice,$choice);
		   $food_var_fr = get_food_menu_variance_for_price($foodmenu_id);
							    /**/
							//$variation_result = array();
if(!empty($food_var_fr))
{
 $variation_price_fr = array_column($food_var_fr , 'vprice');
 $variation_sale_price_fr = array_column($food_var_fr, 'vreduced_price');
 
$min_price_fr = min($variation_price_fr);
$min_reduced_price_fr = min($variation_sale_price_fr);

$max_price_fr = max($variation_price_fr);
$max_reduced_price_fr = max($variation_sale_price_fr);

$vminprice_fr = (!empty($min_reduced_price_fr) && $min_reduced_price_fr != '0.00' && $min_reduced_price_fr < $min_price_fr )? $min_reduced_price_fr : $min_price_fr;

if(!empty($min_reduced_price_fr) && $min_reduced_price_fr != '0.00' && ($min_reduced_price_fr < $min_price_fr))
{

$vminprice_fr = $min_reduced_price_fr;
$vmaxprice_fr = $max_reduced_price_fr;

}
else
{
$vminprice_fr = $min_price_fr;
$vmaxprice_fr = $max_price_fr;
}
$var_price_fr = $vminprice_fr.'-'.$vmaxprice_fr;  
}  

if(!empty($var_price_fr)){
   $price = $var_price_fr;
}else{
   if (!empty($reduced_price) && $reduced_price != '0.00') {
   	$price = $reduced_price;
   }
   else{
   	$price = $food_price;
   }
}
		$html .= '<div class="col-md-6 col-sm-6 col-lg-6  ">
                ';
		$html .= '<div class="featured-restaurant-box style2 brd-rd12 wow fadeInUp" data-wow-delay="0.1s">';
		 $html .= '<div class="featured-restaurant-thumb">';
            $html .= '<a href="'.$set_alias.'" title="" itemprop="url">';
            $html .= '<img src="'.$menu_path.'" alt="'.$menu_name.'" itemprop="image">';
            $html .= '</a>';
		 $html .= '</div>';
		 $html .= '<div class="featured-restaurant-info">';
		    $html .= '<h2><span class="red-clr">'.$res_name.'</span></h2>';
		    $html .= '<h4 itemprop="headline">';
		    $html .= "<a href='restaurant-detail.html' title=' itemprop='url'>".$menu_name."</a>";
		    $html .= '</h4>';
		    $html .= '<span class="food-types">Type of food: <a href="#" title="" itemprop="url">'.$ser_type.'</a></span>';
		    $html .= '<ul class="post-meta">';
		    $html .= '<li><i class="fa fa-check-circle-o"></i> Min order <i class="fa fa fa-inr"></i>'.$price.'</li>';
		    $html .= '<li><i class="flaticon-transport"></i> 30min</li>';
		    $html .= '<li><i class="flaticon-money"></i> Accepts cash &amp; online payments</li>';
		    $html .= '</ul>';
		    $html .= '<span class="post-rate yellow-bg brd-rd2"><i class="fa fa-star-o"></i>'.$all_ratings.'</span>';
		    $html .= '<span class="post-likes style2 red-clr"><i class="fa fa-heart-o"></i>'.$total_fav_res_all.'</span>';
		    $html .= '<a class="brd-rd5" href="'.$set_alias.'" title="Order Online">Order Now</a>';
		    $html .= '</div>';
		 $html .= '</div>';
		$html .= '</div>';

        }
    }
        $html .= '</div>';
        $html .= '</div>';
		echo $html;
	}
 
}