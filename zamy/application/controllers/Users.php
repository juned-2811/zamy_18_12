<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Users extends CI_Controller {
	
	function __construct() {
		parent::__construct();
		$this->load->model('users/user_model', 'user_model');
		$this->customer_id 	= $this->session->userdata('cust_id');
		$this->load->helper('coupon');
	}
	
	public function restaurants(){	
		is_login();
		
		$data['tables']= $this->common_model->get_data_by_id(array('franchise_id'=>$this->franchise_id,'restaurant_id'=>$this->restaurant_id),'tables','','table_id','asc');
		
		$data['view'] = 'users/dashboard.php';
		$this->load->view('layout', $data);
	}
	
	public function index(){
		
		if($this->session->has_userdata('cust_id')){
			redirect('users/restaurants');
		}
	
		if($this->input->post('submit')){
			$this->form_validation->set_rules('email', 'Email', 'trim|required');
			$this->form_validation->set_rules('password', 'Password', 'trim|required');

			if ($this->form_validation->run() == FALSE) {
				$this->load->view('users/user/login');
			}
			else {
				
				$current_url  =$this->input->post('current_url');
				
				$data = array(
				'email' => $this->input->post('email'),
				'password' => $this->input->post('password')
				);
				$result = $this->user_model->login($data);
				
				$franchise_id = $result['franchise_id'];
				$restaurant_id = $result['restaurant_id'];
				
				if ($result == TRUE) {
					$user_data = array(
						'user_id' 	=> $result['id'],
						'name' 		=> $result['name'],
						'role_id' 	=> $result['user_type'],
						'franchise_id' 	=> $franchise_id,
						'restaurant_id' => $restaurant_id,
						'is_login' 	=> TRUE,
					);
					
					$this->session->set_userdata($user_data);
					if(!empty($current_url)){
						redirect($current_url, 'refresh');
					}else{
						redirect(base_url('users/dashboard'), 'refresh');
					}
					
				}
				else{
					$data['msg'] = 'Invalid Email or Password!';
					$this->load->view('users/user/login', $data);
				}
			}
		}
		else{
			$this->load->view('users/user/login');
		}
	}
	
	function sign_in(){
		$username		= $this->input->post('username');
		$password		= $this->input->post('password');
		
		$current_url =  base_url();
		if(!empty($this->input->post('current_url'))){
			$current_url	= $this->input->post('current_url');
		}
		
		$login_data = array();
		
		$login_data['username'] = $username;
		$login_data['password'] = $password;
		$login_data['status'] = 1;
		
		$result = $this->user_model->login($login_data);
		
		if ($result == TRUE) {
			
			$session_data = array(
				'cust_id' 		=> $result['id'],
				'cust_phone' 	=> $result['phone'],
				'cust_name' 	=> $result['name'],
				'cust_email' 	=> $result['email'],
				'location' 		=> $result['location'],
				'cust_is_login' => TRUE,
			);
			
			
			$this->session->set_userdata($session_data);
			$user_id = $this->session->userdata('cust_id');
			
			login_signup_cart($user_id); // Common Helper
			
			$response["success"] = 1; 
			$response["message"] = "Login successful.";
			$response["redirect_url"] = $current_url;
			echo json_encode($response);
			exit();
		}else{
			$response["success"] = 2; 
			$response["message"] = "email/Phone or Password not match.";
			echo json_encode($response);
			exit();
		}
	}
	
	/* forgot password */
	function forgot_password(){
		
		if($this->session->has_userdata('user_id')){
			redirect('users/dashboard');
		}

		$error='';
		$success='';

		if($this->input->post('hash')){
			$this->form_validation->set_rules('email', 'Email', 'trim|required|valid_email');
			
			$this->load->helper(array('form', 'url'));
			if($this->form_validation->run() == FALSE)
			{
				$error .="<div class='alert alert-danger'>The Email Address field is required</div>";
				$this->session->set_flashdata('message', array('msg'=>"your e-mail address is not valid or doesn't exist.",$this->session->userdata('language_current'),'class' => 'alert-danger'));

			}else{
				$email= $this->input->post('email');

				$findemail = $this->user_model->ForgotPassword($email);  
			
				if($findemail){
					$data1['email']=$email;
					$passwordplain = "";
					$passwordplain  = rand(999999999,9999999999);
					$data1['password'] = password_hash($passwordplain, PASSWORD_BCRYPT);
					
					if($this->user_model->sendpassword($data1)){
				  
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
								
						$userinfo=getCurrentUser();
						
						$this->email->from('no-reply@' . $_SERVER['SERVER_NAME'], 'HOPMeal');
		
						$this->email->to($email);
						
						$this->email->subject('Forgot Password - HOPMeal');
						$this->email->message($message_body);
						$this->email->set_newline("\r\n");
						$this->email->set_crlf("\r\n");
					
						if ($this->email->send()) {
							$this->session->set_flashdata('message' , array('msg'=>"Password sent to your email address. if not display in inbox then check spam folder!",'class' => 'alert-success'));
						} 
						else {
							$this->session->set_flashdata('error',"Failed to send password, please try again!",$this->session->userdata('language_current'),'class');
							
						}
				  }else{
						$this->session->set_flashdata('error','Please try after sometime.',$this->session->userdata('language_current'));
				  }
				}else{
					$this->session->set_flashdata('message' , array('msg'=>"your e-mail address is not valid or doesn't exist.",$this->session->userdata('language_current'),'class' => 'alert-danger'));
				}
			}
		}
		$data['error'] = $error;
		$data['success'] = $success;
		$this->load->view('users/user/forgot_password');
	}
	
	public function edit_profile($id = 0){
		if(!$this->session->has_userdata('user_id')){
			redirect('users/login');
		}
		$id= $this->session->userdata('user_id');
		
		if($this->input->post('save_profile')){
			$this->form_validation->set_rules('name', 'Username', 'trim|required');
			$this->form_validation->set_rules('email', 'Email', 'trim|required');
			$this->form_validation->set_rules('mobile_no', 'Number', 'trim|required');

			if ($this->form_validation->run() == FALSE) {
				$data['user'] = $this->user_model->get_user_by_id($id);
				$data['view'] = 'admin/users/user/edit_profile';
				$this->load->view('admin/layout', $data);
			}
			else {
				$data = array(
						'name' 		=> $this->input->post('name'),
						'email' 	=> $this->input->post('email'),
						'mobile_no' => $this->input->post('mobile_no'),
						'updated_at'=> date('Y-m-d : h:i:s'),
					);
					
				$data = $this->security->xss_clean($data);
				$result = $this->user_model->edit_user($data, $id);
				if($result){
					$this->session->set_flashdata('msg', 'Record is Updated Successfully!');
					redirect(base_url('users/dashboard'));
				}
			}
		}else if($this->input->post('change_pass')){
			$this->form_validation->set_rules('current_password', 'Password', 'trim|required');
			$this->form_validation->set_rules('password', 'New Password', 'trim|required');
			$this->form_validation->set_rules('confirm_password', 'Confirm Password', 'trim|required|matches[password]');

			if ($this->form_validation->run() == FALSE) {
				
				$data['user'] = $this->user_model->get_user_by_id($id);
				$data['view'] = 'users/user/edit_profile';
				$this->load->view('layout', $data);
				
			}else {
				 
				$oldPassword = $this->input->post('current_password');
				$newPassword = $this->input->post('password');
				 
				$resultPas = $this->user_model->matchOldPassword($id, $oldPassword);
				if(empty($resultPas))
				{
					$this->session->set_flashdata('msg', 'Your old password not correct');
					$data['user'] = $this->user_model->get_user_by_id($id);
					$data['view'] = 'users/user/edit_profile';
					$this->load->view('layout', $data);
				}else{
					$data = array(
						'password' 		=> password_hash($this->input->post('password'), PASSWORD_BCRYPT),
						'updated_at'=> date('Y-m-d : h:m:s'),
					);
					
					$data = $this->security->xss_clean($data);
					$result = $this->user_model->edit_user($data, $id);
					if($result){
						$this->session->set_flashdata('msg', 'Password is Updated Successfully!');
						redirect(base_url('users/dashboard'));
					}
				}
				
			}
		}
		else{
			$data['user'] = $this->user_model->get_user_by_id($id);
			$data['view'] = 'users/user/edit_profile';
			$this->load->view('layout', $data);
		}
	}
	
	public function fav_restaurants(){
		/* $restaurant_id		= $this->post->input('res_id');
		$user_id 			= $this->customer_id; */
		
		$restaurant_id		= 3;
		$user_id 			= 2;
		
		$check_fields = array(
				'restaurant_id'	=> $restaurant_id,
				'user_id'	=> $user_id
			); 
		
		$res_data['conditions'] = $check_fields;
		$check_entry = $this->common_model->getRows('fav_restaurants',$res_data);
		
		if(!empty($check_entry)){
			$result = $this->common_model->delete_data('fav_restaurants',$check_fields);
		}else{
			$result = $this->common_model->add_data('fav_restaurants',$check_fields);
		}
		
		echo $result;
	}
	
	function restaurant_menu_search(){
		$restaurant_id 	= $this->input->post('restaurant_id');
		$menu_name 		= $this->input->post('menu_name');
		$all_search_items = $this->common_model->get_res_cat_menus($restaurant_id,$menu_name);
		$data['all_search_items']			= $all_search_items;
		
		$this->load->view('restaurants/res_menu_search',$data);
	}
	
	public function menu_variation(){
		$restaurant_id 	= $this->input->post('restaurant_id');
		$foodmenu_id 	= $this->input->post('foodmenu_id');
		
		$variance = $this->common_model->get_food_menu_variance($restaurant_id,$foodmenu_id);
		
		$html = '';
		if(!empty($variance)){
			$html .='<div class="menu-select-list"><div id="VariationModal" class="modal fade in" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
						<div class="modal-dialog">
							<div class="modal-content">
								<div class="modal-header">
									<h4 class="modal-title col-md-6" id="myModalLabel">Select Variation</h4>
									<button type="button" class="close" data-dismiss="modal"aria-hidden="true">×</button>
								</div>
								<div class="modal-body">';
					$html .='<ul class="list-unstyled" id="menu_list">';
					foreach($variance as $var)
					{
						/* $sale_price = (!empty($var['vreduced_price']) && $var['vreduced_price'] != '0.00')? $var['vreduced_price'] : $var['vprice']; */
						$tax_price = '';
							if((!empty($var['vreduced_price']) && $var['vreduced_price'] != '0.00') && $var['vreduced_price'] < $var['vprice']){
								$unit_price = $var['vreduced_price'];
							}else{
								$unit_price = (!empty($var['vprice']) && $var['vprice'] != '0.00') ? $var['vprice'] : '0';
								
							}
						
						$html .= '<li class="variance_select">';
						/* $html .= '<input onchange="select_menu('. "".$sale_price.","."". $row['foodmenu_id']. ","."". $var['id']. ","."".$kot_id."".')" type="checkbox" id="'.$var['id'].'" name="" >';
						 */
						$html .= '<div class="variance_box variance_select_'.$foodmenu_id.$var['id'].'" data-price="'.$tax_price.'" data-restaurant_id="'.$restaurant_id.'" data-foodmenu_id="'.$foodmenu_id.'" data-variation_id="'.$var['id'].'"  name="variance_select" id="'.$foodmenu_id.$var['id'].'">
									<div class="menu_name">'.$var['name'].'</div>
									<div class="price"><i class="fa fa-inr"> '.$unit_price.'</i></div>
								</div>';
						/* $html .= '<input type="button" class="variance_box variance_select_'.$foodmenu_id.$var['id'].'" data-price="'.$tax_price.'" data-foodmenu_id="'.$foodmenu_id.'" data-variation_id="'.$var['id'].'" data-kot_id="'.$kot_id.'" name="variance_select" value="'.$var['name'].'"  id="'.$foodmenu_id.$var['id'].'">'; */
						$html .= '</li>';
					}
					$html .='</ul>';
							
								$html .='</div>';
								$html .='<!--<div class="modal-footer">
									<input type="hidden" name="url" id="url" value="">
									<button type="button" class="btn btn-default waves-effect close" data-dismiss="modal">No</button>
								</div>-->
							</div>
						</div>
					</div></div>';
		}
		
		echo  $html;
	}
	
	function add_to_cart(){
		
		$restaurant_id 	= $this->input->post('restaurant_id');
		$foodmenu_id 	= $this->input->post('foodmenu_id');
		
		$variation_id 	= !empty($this->input->post('variation_id')) ? $this->input->post('variation_id'):'0';		
		$last_sr_no 	= !empty($this->input->post('last_sr_no')) ? $this->input->post('last_sr_no'):'0';		
		
		$new_sr_no 		= $last_sr_no + 1;
		$menu_price_name = $this->common_model->get_menu_price_name($restaurant_id,$foodmenu_id,$variation_id);
		
		if((!empty($menu_price_name['reduced_price']) && $menu_price_name['reduced_price'] != '0.00') && $menu_price_name['reduced_price'] < $menu_price_name['price']){
			$unit_price = $menu_price_name['reduced_price'];
		}else{
			$unit_price = (!empty($menu_price_name['price']) && $menu_price_name['price'] != '0.00') ? $menu_price_name['price'] : 0;
			
		}
		
		$menu = $this->common_model->get_food_menu($restaurant_id,$foodmenu_id,$variation_id);
		$variation_name = ( !empty($menu->name)) ?  " (" .$menu->name .") " :'';
		$menu_name		= $menu->menu_name;
		$menu_choice 	= $menu->choice;
		
		$food_type = '';
		if(!empty($menu_choice)){
			$choice = explode(',', $menu_choice);
			$food_type = '1'; //For veg
			if(in_array('2',$choice)){
				$food_type = '2';  //For non-veg
			}
		}
		
		$cart = new Cart;
		$insertItem = '';
        if($this->session->has_userdata('cust_id')){
			$itemData = array();
			$itemData[0]['rowid'] 			= $foodmenu_id.$variation_id;
			$itemData[0]['restaurant_id'] 	= $restaurant_id;
			$itemData[0]['food_menu_id'] 	= $foodmenu_id;
			$itemData[0]['menu_name'] 		= $menu_name;
			$itemData[0]['variation_name'] 	= $variation_name;
			$itemData[0]['variation_id'] 	= $variation_id;
			$itemData[0]['price'] 			= $unit_price;
			$itemData[0]['qty'] 			= 1;
			$itemData[0]['subtotal'] 		= $unit_price;
		
			// Insert item to cart table
			$user_id	= $this->customer_id;
		
			$old_cart_data['conditions'] 	= array('user_id'=>$this->customer_id);
			$old_cart_data['fields'] 		= 'persistent_cart,coupon_amount';
			$old_cart_data['returnType'] 	= 'single';
			$check_existing_cart 			= $this->common_model->getRows('cart',$old_cart_data);
			
			if(!empty($check_existing_cart)){
				$cart_table_data = unserialize($check_existing_cart['persistent_cart']);
			}
			
			$add_data = array();
			if(empty($cart_table_data)){
				$add_data['user_id'] 			= $user_id;
				$add_data['persistent_cart'] 	= serialize($itemData);
				$add_data['total'] 				= $itemData[0]['subtotal'];
				$add_data['updated_date'] 		= date('Y-m-d h:i:s');
				
				$insertItem = $this->common_model->add_data('cart',$add_data);

			}else{
				
				$update_cart_array = array();
				$total = 0;
				foreach($cart_table_data as $cart){
					
					$rowid = $cart['rowid'];
					$table_rowid = $foodmenu_id.$variation_id;
					
					if(($cart['restaurant_id'] == $restaurant_id) && ($rowid == $table_rowid )){
						
						$update_cart['rowid'] 			= $cart['rowid'];
						$update_cart['restaurant_id'] 	= $cart['restaurant_id'];
						$update_cart['food_menu_id'] 	= $cart['food_menu_id'];
						$update_cart['menu_name'] 		= $cart['menu_name'];
						$update_cart['variation_id'] 	= $cart['variation_id'];
						$update_cart['variation_name'] 	= $cart['variation_name'];
						$update_cart['price'] 			= $cart['price'];
						$update_cart['qty']				= $cart['qty'] + 1;
						$update_cart['subtotal'] 		= $update_cart['qty'] * $update_cart['price'] ;
						
						$update_cart_array[] = $update_cart;
						
						$total += $update_cart['subtotal'];
					}else{
						$update_cart['rowid'] 			= $cart['rowid'];
						$update_cart['restaurant_id'] 	= $cart['restaurant_id'];
						$update_cart['food_menu_id'] 	= $cart['food_menu_id'];
						$update_cart['menu_name'] 		= $cart['menu_name'];
						$update_cart['variation_id'] 	= $cart['variation_id'];
						$update_cart['variation_name'] 	= $cart['variation_name'];
						$update_cart['price'] 			= $cart['price'];
						$update_cart['qty']				= $cart['qty'] ;
						$update_cart['subtotal'] 		= $cart['subtotal'];
						
						$update_cart_array[] = $update_cart;
						
						$total += $update_cart['subtotal'];
					}
				}
				 
				$itemData = array(
					'rowid'				=> $foodmenu_id.$variation_id,
					'restaurant_id' 	=> $restaurant_id, 
					'food_menu_id' 		=> $foodmenu_id, 
					'menu_name' 		=> $menu_name, 
					'variation_name' 	=> $variation_name, 
					'variation_id' 		=> $variation_id, 
					'price' 			=> $unit_price, 
					'qty' 				=> 1,
					'subtotal'			=> $unit_price
				);
				
				$total += $unit_price;
				
				$update_cart_array[] = $itemData;
				
				if(!empty($itemData)){
				
					$update_data['persistent_cart'] 	= serialize($update_cart_array);
					$update_data['total'] 				= $total;
					$update_data['updated_date'] 		= date('Y-m-d h:i:s');
					
					$insertItem = $this->common_model->update_data('cart',$update_data,array('user_id'=>$user_id));
					
					 
				}
			}
			
			
		}else{
			$itemData = array( 
				'restaurant_id' 	=> $restaurant_id, 
				'food_menu_id' 		=> $foodmenu_id, 
				'menu_name' 		=> $menu_name, 
				'variation_name' 	=> $variation_name, 
				'variation_id' 		=> $variation_id, 
				'price' 			=> $unit_price, 
				'qty' 				=> 1 
			);
			// Insert item to cart session
			$insertItem = $cart->insert($itemData);
		}
		$html = '';
		//if($insertItem){
		$get_cart_amount = '';
			if(!empty($user_id))
				$get_cart_amount = $this->common_model->get_field_by_id('cart','total',array('user_id'=>$user_id));
			
			$get_choice = $this->common_model->get_field_by_id('foodmenu','choice',array('foodmenu_id'=>$foodmenu_id));
						
			if(!empty($get_choice)){
				$choice = explode(',', $get_choice);
				$veg_class = 'veg-ic'; //For veg
				if(in_array('2',$choice)){
					$veg_class = 'non-veg-ic';  //For non-veg
				}
			}
			
			$html .= '<script src="'.base_url('assets/js/jquery.bootstrap-touchspin.js').'" type="text/javascript"></script>';
			$html.='<li id="'.$foodmenu_id.'" data-menu_id="'.$foodmenu_id.'" data-menu_variation="'.$foodmenu_id.$variation_id.'" data-variation="'.$variation_id.'" data-menu_price="'.$unit_price.'" class="menu_item_'.$foodmenu_id.$variation_id.'">';
			$html.='<div class="dish-name">';
			/* $html.='<i><span class="sr_no">'.$new_sr_no.'</span>.</i><h6 itemprop="headline">'.$menu_name.$variation_name.'</h6>'; */
			
			$html.='<i class="'.$veg_class.'"></i><h6 itemprop="headline">'.$menu_name.$variation_name.'</h6>';
			
			/* $html.='<i class="fa fa-rupee-sign"><span class="price item_price_'.$foodmenu_id.$variation_id.'">'.$unit_price.'</span></i>'; */
			
			$html.='<span class="price"><i class="fa fa-rupee"></i><span class="item_price_'.$foodmenu_id.$variation_id.'">'.$unit_price.'</span></span>';
			
			$html.='</div>';
			$html.='<div class="qty-wrap mor-ingredients">';
			
			$html .= '<input id="tch3_'.$foodmenu_id.$variation_id.'" type="text" value="1" class="qty" name="tch3_23" data-bts-button-down-class="qty_btn btn btn-secondary btn-outline" data-bts-button-up-class="qty_btn btn btn-secondary btn-outline"> ';
			$html.='<button class="brd-rd2 qty_btn btn btn-secondary btn-outline bootstrap-touchspin-down" onclick="remove_menu_item('.$foodmenu_id.$variation_id.')"><i class="fa fa-trash"></i></button>';
			$html.='</div>';
			$html.='</li>'; 
		  $coupon_amount = !empty($check_existing_cart['coupon_amount'])?$check_existing_cart['coupon_amount'] :'';
			$var_class = "<i class='fas fa-rupee-sign'></i>";
			$html .= '<script type="text/javascript">
					
				$("#coupon_amount").text('. $coupon_amount .');
					
				i= $("#tch3_"+'.$foodmenu_id.$variation_id.').TouchSpin({
					initval: 40,
					 min: 1,
				}); 
				 
				i.on("touchspin.on.startspin", function () {  
					var qty = $(this).val();
					var menu_id = "'.$foodmenu_id.'";
					var variation_id = "'.$variation_id.'";
					var new_qty = parseInt(qty);
					var price = new_qty * '.$unit_price.';
					$(".item_price_"+menu_id+variation_id).html("'.$var_class.'"+price.toFixed(2));
					
					$("ul.order-list-inner li").each(function(i) {
						calculateColumn(i);
					}); 
				}); 
				
				$(document).ready(function(){ 
					$("ul.order-list-inner li").each(function(i) {
						calculateColumn(i);
					});
				}); 
				  var coupon_code = $("#coupon_code").val();
				 var sub_total = '.$get_cart_amount.';
				 var restaurant_id = '.$restaurant_id.'; 
				apply_coupon(sub_total,coupon_code,restaurant_id)	
	 
				 
				 
			</script>';
		//}
		
		echo $html;
	}
	
 
	
	function update_cart(){
		$restaurant_id 	= $this->input->post('restaurant_id');
		$rowid 			= $this->input->post('rowid');
		
		$variation_id 	= !empty($this->input->post('variation_id')) ? $this->input->post('variation_id'):'0';		
		
		$qty 			= $this->input->post('qty');
		
		$itemData = array( 
            'rowid' 	=> $rowid,
            'qty' 		=> $qty 
        ); 
		
		$cart = new Cart;
		$updateItem= '';
        if($this->session->has_userdata('cust_id')){
			// update item in cart table
			$user_id	= $this->customer_id;
			
			$old_cart_data['conditions'] 	= array('user_id'=>$user_id);
			$old_cart_data['fields'] 		= 'persistent_cart,coupon_code';
			$old_cart_data['returnType'] 	= 'single';
			$check_existing_cart 			= $this->common_model->getRows('cart',$old_cart_data);
			
			$update_cart_array = array();
			$update_data = array();
			
			$cart_table_data = unserialize($check_existing_cart['persistent_cart']);
			
			$total = 0;
			if(!empty($cart_table_data)){
				
				foreach($cart_table_data as $cart){
					
					$cart_rowid = $cart['rowid'];
					
					if(($cart['restaurant_id'] == $restaurant_id) && ($cart_rowid == $rowid )){
						
						$update_cart['rowid'] 			= $cart['rowid'];
						$update_cart['restaurant_id'] 	= $cart['restaurant_id'];
						$update_cart['food_menu_id'] 	= $cart['food_menu_id'];
						$update_cart['menu_name'] 		= $cart['menu_name'];
						$update_cart['variation_id'] 	= $cart['variation_id'];
						$update_cart['variation_name'] 	= $cart['variation_name'];
						$update_cart['price'] 			= $cart['price'];
						$update_cart['qty']				= $qty;
						$update_cart['subtotal'] 		= $qty * $update_cart['price'] ;
						
						$update_cart_array[] = $update_cart;
						
						$total += $update_cart['subtotal'];
					}else{
						$update_cart['rowid'] 			= $cart['rowid'];
						$update_cart['restaurant_id'] 	= $cart['restaurant_id'];
						$update_cart['food_menu_id'] 	= $cart['food_menu_id'];
						$update_cart['menu_name'] 		= $cart['menu_name'];
						$update_cart['variation_id'] 	= $cart['variation_id'];
						$update_cart['variation_name'] 	= $cart['variation_name'];
						$update_cart['price'] 			= $cart['price'];
						$update_cart['qty']				= $cart['qty'];
						$update_cart['subtotal'] 		= $update_cart['qty'] * $update_cart['price'] ;
						
						$update_cart_array[] = $update_cart;
						
						$total += $update_cart['subtotal'];
					}
				}
				
				$update_data['persistent_cart'] 	= serialize($update_cart_array);
				$update_data['total'] 				= $total;
				$update_data['updated_date'] 		= date('Y-m-d h:i:s');
				 
				$updateItem = $this->common_model->update_data('cart',$update_data,array('user_id'=>$user_id));
				$coupon_code = $check_existing_cart['coupon_code'];
				$apply_coupon_response = apply_coupon($coupon_code,$total,$user_id,$restaurant_id);
			}
			
		}else{
			// update item in cart session
			$updateItem = $cart->update($itemData);
		}
		
		if($updateItem){

			$response["success"] = 1; 
			$response["message"] = "Cart Item updated";
			echo json_encode($response);
			exit();
		}else{
			$response["success"] = 0; 
			$response["message"] = "Not able to update cart";
			echo json_encode($response);
			exit();
		}
	}
	
	public function remove_menu_item(){
		$user_id		= $this->customer_id;
		
		$restaurant_id 	= $this->input->post('restaurant_id');
		$rowid 			= $this->input->post('rowid');
		
		$cart = new Cart;
		
		$total = 0;
        if($this->session->has_userdata('cust_id')){
			// remove item from cart table
			
			$old_cart_data['conditions'] 	= array('user_id'=>$user_id);
			$old_cart_data['fields'] 		= 'persistent_cart';
			$old_cart_data['returnType'] 	= 'single';
			$check_existing_cart 			= $this->common_model->getRows('cart',$old_cart_data);
			
			$update_cart_array = array();
			$update_data = array();
			$cart_table_data = array();
			
			if(!empty($check_existing_cart)){
				$cart_table_data = unserialize($check_existing_cart['persistent_cart']);
			}
			
			if(!empty($cart_table_data) && count($cart_table_data) > 1){
				
				foreach($cart_table_data as $cart){
					
					$cart_rowid = $cart['rowid'];
					
					if($cart_rowid != $rowid ){
						
						$update_cart['rowid'] 			= $cart['rowid'];
						$update_cart['restaurant_id'] 	= $cart['restaurant_id'];
						$update_cart['food_menu_id'] 	= $cart['food_menu_id'];
						$update_cart['menu_name'] 		= $cart['menu_name'];
						$update_cart['variation_id'] 	= $cart['variation_id'];
						$update_cart['variation_name'] 	= $cart['variation_name'];
						$update_cart['price'] 			= $cart['price'];
						$update_cart['qty']				= $cart['qty'];
						$update_cart['subtotal'] 		= $update_cart['qty'] * $update_cart['price'] ;
						
						$update_cart_array[] = $update_cart;
						
						$total += $update_cart['subtotal'];
					}
				}
				
				$update_data['persistent_cart'] 	= serialize($update_cart_array);
				$update_data['total'] 				= $total;
				$update_data['updated_date'] 		= date('Y-m-d h:i:s');
				
				$removeItem = $this->common_model->update_data('cart',$update_data,array('user_id'=>$user_id));
			}else{
				$removeItem = $this->common_model->delete_data('cart',array('user_id'=>$user_id));
			}
			
		}else{
			// remove item from cart session
			$removeItem = $cart->remove($rowid);
			
			$total = $cart->total();
		}
		
		if($removeItem){
			$response["success"] = 1; 
			$response["message"] = "Item removed from cart.";
			$response["data"] = $total;
			echo json_encode($response);
			exit();
		}else{
			$response["success"] = 0; 
			$response["message"] = "Not able to remove item from cart";
			$response["data"] = $total;
			echo json_encode($response);
			exit();
		}
	}
	
	public function clear_cart(){
		
		$cart = new Cart;
		
        if($this->session->has_userdata('cust_id')){
			// Clear cart from Table
			$removeItem = $this->common_model->delete_data('cart',array('user_id'=>$this->customer_id));
		}else{
			// Clear cart session
			$removeItem = $cart->destroy();
			$this->session->unset_userdata('complementary_food');
		}
		
		if($removeItem){
			$response["success"] = 1; 
			$response["message"] = "Cart cleared successfully.";
			echo json_encode($response);
			exit();
		}else{
			$response["success"] = 0; 
			$response["message"] = "Not able to clear cart.";
			echo json_encode($response);
			exit();
		}
	}
	
	public function get_cart_count(){
		if($this->session->has_userdata('cust_id')){
			$cart_count = get_cart_count($this->session->userdata('cust_id'));
		}else{
			$cart_count = get_cart_count();
		}
		
		echo $cart_count;
		exit;
	}
	
	public function check_complementary(){
		
		$restaurant_id 	= $this->input->post('restaurant_id');
		
		if($this->session->has_userdata('cust_id')){
			$user_id		= $this->customer_id;
			$complementary = check_complementary_zamy($user_id);
			
			if($complementary){
				$this->common_model->update_data('cart',array('complementary_food'=>$complementary),array('user_id'=>$user_id));
				$success = 1; 
				$message = $complementary;
			}else{
				$success = 0; 
				$message = "";
			}
		}else{
			
			$complementary = check_complementary_zamy();
			
			if($complementary){
				$user_data = array('complementary_food' => $complementary);
					
				$this->session->set_userdata($user_data);
				
				$success = 1; 
				$message = $complementary;
			}else{
				$success = 0; 
				$message = "";
			}
		}
		
		$response["success"] = $success; 
		$response["message"] = $message;
		echo json_encode($response);
		exit();
	}
	
	
	public function logout(){
		$this->session->unset_userdata('cust_id');
		$this->session->unset_userdata('cust_phone');
		$this->session->unset_userdata('cust_name');
		$this->session->unset_userdata('cust_email');
		$this->session->unset_userdata('cust_is_login');
		$this->session->unset_userdata('complementary_food');
		
		if($this->session->has_userdata('kot_login')==false && $this->session->has_userdata('is_login')==false){
			//$this->session->sess_destroy();
		}
		
		redirect(base_url('.'), 'refresh');
	}
	
	function search_cart($products, $field, $value)
	{
	   foreach($products as $key => $product)
	   {
		  if ( $product[$field] === $value )
			 return $key;
	   }
	   return false;
	}
	
}