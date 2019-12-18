<?php defined('BASEPATH') OR exit('No direct script access allowed');

function apply_coupon($coupon_code,$cart_total,$user_id,$restaurant_id){
	
	$CI =& get_instance();
	
	$CI->db->select('my_referral_code,earn_point');
	$CI->db->where('user_id',$user_id); 
	$query = $CI->db->get('referrals_data');
	$referral_result = $query->row_array();
	 
	 $count = 0;
	if(!empty($referral_result['my_referral_code'])){
		//$count = $referral_result['earn_point'] / 50; 
		$count = $referral_result['earn_point'] / 100; 
	} 
	
	 if($count < 1 && $coupon_code == 'REFERRAL100'){
		$html['success'] 				= 0;
		$html['msg'] 					= 'coupon code is not valid.';
		$coupon_data['sub_total']		= '';
		$coupon_data['discount_amount']	= '';
		$coupon_data['total']			= $cart_total;
		$html['data'] 					= $coupon_data;
		echo json_encode($html);
		exit();
	}
	
	if(!empty($coupon_code) && !empty($cart_total)){
			
		$get_coupon_data = $CI->common_model->check_coupon_exist($coupon_code);
		
		if(!empty($get_coupon_data)){
			
			//$usage_limit 				= $get_coupon_data['get_usage_limit'];
			$usage_limit 				= $get_coupon_data['usage_limit_per_coupon'];
			$_total_used_coupon 		= $get_coupon_data['get_usage_count'];
			$usage_limit_per_user 		= $get_coupon_data['usage_limit_per_user'];
			$get_individual_use 		= $get_coupon_data['get_individual_use']; // true/false
			$max_amount 				= $get_coupon_data['max_spend'];
			$min_amount 				= $get_coupon_data['min_spend'];
			
			$start_date 				= strtotime($get_coupon_data['start_date']);
			$end_date 					= strtotime($get_coupon_data['end_date']);
			$current_date				= strtotime(date('Y-m-d'));
			
			$restaurant 				= $get_coupon_data['restaurant'];
			
			if(!empty($get_coupon_data['get_used_by'])){
				$get_used_by 				= explode(',',$get_coupon_data['get_used_by']);
			}else{
				$get_used_by 				= '';
			}
			
			$coupon_amount 				= $get_coupon_data['discount'];
			$discount_type 				= $get_coupon_data['dis_type'];
			
			$count_get_used_by_user = 0;
			if(!empty($get_used_by)){
				foreach($get_used_by as $value){
					if($user_id == $value){
						$count_get_used_by_user++;
					}
				}
			}
		
			// Restrict coupon to restaurant
			if(!empty($restaurant) && $restaurant_id!=''){
				$restaurant_limit 				= explode(',',$restaurant);
				
				if(!in_array($restaurant_id,$restaurant_limit)){
					$html['success'] 				= 0;
					$html['msg'] 					= 'coupon code is not valid for this restaurant.';
					$coupon_data['sub_total']		= '';
					$coupon_data['discount_amount']	= '';
					$coupon_data['total']			= $cart_total;
					$html['data'] 					= $coupon_data;
					echo json_encode($html);
					exit();
				}
			}
			
			// Restrict coupon to start and end Date
			if($start_date <= $current_date && $current_date <= $end_date) {
				
			}else{
				$html['success'] 				= 0;
				$html['msg'] 					= 'Invalid coupon code';
				$coupon_data['sub_total']		= '';
				$coupon_data['discount_amount']	= '';
				$coupon_data['total']			= $cart_total;
				$html['data'] 					= $coupon_data;
				echo json_encode($html);
				exit();
			}
			
			if($usage_limit!='0'){
				echo $usage_limit ."<=". $_total_used_coupon;
				if($usage_limit <= $_total_used_coupon){
					$html['success'] = 0;
					$html['msg'] = 'Coupon already used';
					
					$coupon_data['sub_total']= '';
					$coupon_data['discount_amount']= '';
					$coupon_data['total']= $cart_total;
					$html['data'] = $coupon_data;
				}else{
					if($usage_limit_per_user!='0'){
						//if($usage_limit_per_user <= $get_individual_use){
						if($usage_limit_per_user <= $count_get_used_by_user){
							$html['success'] = 0;
							$html['msg'] = 'Coupon already used';
							$coupon_data['sub_total']= '';
							$coupon_data['discount_amount']= '';
							$coupon_data['total']= $cart_total;
							$html['data'] = $coupon_data;
							
						}else{
							if($max_amount!='0'){
								if($cart_total <= $max_amount){
									if($discount_type=='fix'){
										$_coupon_amount = $coupon_amount;
										$_total_amount	= ($cart_total-$_coupon_amount); 
									}else{
										$_coupon_amount	= ($cart_total*$coupon_amount)/100;
										$_total_amount	= ($cart_total-$_coupon_amount);  
									}
									
									
									$html['success'] = 1;
									$html['msg'] = 'Coupon applied successfully';
									
									$coupon_data['sub_total']= $cart_total;
									$coupon_data['discount_amount']= (float)$_coupon_amount;
									$coupon_data['total']= $_total_amount;
									$html['data'] = $coupon_data;
									
									//$coupon->increase_usage_count( $used_by_email );
									
								}else{
									$html['success'] = 0;
									$html['msg'] = 'Reached Maximum order amount';
									$coupon_data['sub_total']= '';
									$coupon_data['discount_amount']= '';
									$coupon_data['total']= $cart_total;
									$html['data'] = $coupon_data;
								}
							}else{
								if($discount_type=='fix'){
									$_coupon_amount= $coupon_amount;
									$_total_amount=($cart_total-$_coupon_amount);
								}else{
									$_coupon_amount=($cart_total*$coupon_amount)/100;
									$_total_amount=($cart_total-$_coupon_amount);              
								}
								
								$html['success'] = 1;
								$html['msg'] = 'Coupon applied successfully';
								$coupon_data['sub_total']= $cart_total;
								$coupon_data['discount_amount']= (float)$_coupon_amount;
								$coupon_data['total']= $_total_amount;
								$html['data'] = $coupon_data;
								
								//$coupon->increase_usage_count( $used_by_email );
							}
						}
					}else{
						if($max_amount!='0'){
							if($cart_total <= $max_amount){
								if($discount_type=='fix'){
									$_coupon_amount= $coupon_amount;
									$_total_amount=($cart_total-$_coupon_amount);
								}else{
									$_coupon_amount=($cart_total*$coupon_amount)/100;
									$_total_amount=($cart_total-$_coupon_amount);              
								}
								
								$html['success'] = 1;
								$html['msg'] = 'Coupon applied successfully';
								$coupon_data['sub_total']= $cart_total;
								$coupon_data['discount_amount']= (float)$_coupon_amount;
								$coupon_data['total']= $_total_amount;
								$html['data'] = $coupon_data;
								
								//$coupon->increase_usage_count( $used_by_email );
								
							}else{
								$html['success'] = 0;
								$html['msg'] = 'Reached Maximum order amount';
								$coupon_data['sub_total']= '';
								$coupon_data['discount_amount']= '';
								$coupon_data['total']= $cart_total;
								$html['data'] = $coupon_data;
							}
						}else{
							if($discount_type=='fix'){
								$_coupon_amount= $coupon_amount;
								$_total_amount=($cart_total-$_coupon_amount);
							}else{
								$_coupon_amount=($cart_total*$coupon_amount)/100;
								$_total_amount=($cart_total-$_coupon_amount);              
							}
							$html['success'] = 1;
							$html['msg'] = 'Coupon applied successfully';
							$coupon_data['sub_total']= $cart_total;
							$coupon_data['discount_amount']= (float)$_coupon_amount;
							$coupon_data['total']= $_total_amount;
							$html['data'] = $coupon_data;
							
						}
					}
				}
			}else{
				
				if($usage_limit_per_user!='0'){
					
					if($usage_limit_per_user <= $count_get_used_by_user){
						$html['success'] 				= 0;
						$html['msg'] 					= 'Coupon already used';
						$coupon_data['sub_total']		= '';
						$coupon_data['discount_amount']	= '';
						$coupon_data['total']			= $cart_total;
						$html['data'] 					= $coupon_data;
					}else{
						
						if($min_amount!='0'){
							if(($cart_total) >= $min_amount){
								if($max_amount!='0'){
							
									if($cart_total <= $max_amount){
													
										if($discount_type=='fix'){
											$_coupon_amount	= $coupon_amount;
											$_total_amount	= ($cart_total-$_coupon_amount);
										}else{
											$_coupon_amount	= ($cart_total*$coupon_amount)/100;
											$_total_amount	= ($cart_total-$_coupon_amount);              
										}
										
										$html['success'] 				= 1;
										$html['msg'] 					= 'Coupon applied successfully';
										$coupon_data['sub_total']		= $cart_total;
										$coupon_data['discount_amount']	= (float)$_coupon_amount;
										$coupon_data['total']			= $_total_amount;
										$html['data']					= $coupon_data;
										
									}else{
										$html['success'] 				= 0;
										$html['msg'] 					= 'Reached Maximum order amount';
										$coupon_data['sub_total']		= '';
										$coupon_data['discount_amount']	= '';
										$coupon_data['total']			= $cart_total;
										$html['data'] 					= $coupon_data;
										
									}
								}else{
									if($discount_type=='fix'){
										$_coupon_amount	= $coupon_amount;
										$_total_amount	= ($cart_total-$_coupon_amount);
									}else{
										$_coupon_amount	= ($cart_total*$coupon_amount)/100;
										$_total_amount	= ($cart_total-$_coupon_amount);              
									}
									$html['success'] 				= 1;	
									$html['msg'] 					= 'Coupon applied successfully';
									$coupon_data['sub_total']		= $cart_total;
									$coupon_data['discount_amount']	= (float)$_coupon_amount;
									$coupon_data['total']			= $_total_amount;
									$html['data'] 					= $coupon_data;
									
									//$coupon->increase_usage_count( $used_by_email );
								}
							}else{
								$html['success'] 				= 0;
								$html['msg'] 					=  'Minimum Rs.'.$min_amount.'/- order amount is required.';
								$coupon_data['sub_total']		= '';
								$coupon_data['discount_amount']	= '';
								$coupon_data['total']			= $cart_total;
								$html['data'] 					= $coupon_data;
							}
						}else{
							if($max_amount!='0'){
							
								if($cart_total <= $max_amount){
												
									if($discount_type=='fix'){
										$_coupon_amount	= $coupon_amount;
										$_total_amount	= ($cart_total-$_coupon_amount);
									}else{
										$_coupon_amount	= ($cart_total*$coupon_amount)/100;
										$_total_amount	= ($cart_total-$_coupon_amount);              
									}
									
									$html['success'] 				= 1;
									$html['msg'] 					= 'Coupon applied successfully';
									$coupon_data['sub_total']		= $cart_total;
									$coupon_data['discount_amount']	= (float)$_coupon_amount;
									$coupon_data['total']			= $_total_amount;
									$html['data'] 					= $coupon_data;
									
								}else{
									$html['success'] 				= 0;
									$html['msg'] 					= 'Reached Maximum order amount';
									$coupon_data['sub_total']		= '';
									$coupon_data['discount_amount']	= '';
									$coupon_data['total']			= $cart_total;
									$html['data'] 					= $coupon_data;
									
								}
							}else{
								if($discount_type=='fix'){
									$_coupon_amount	= $coupon_amount;
									$_total_amount	= ($cart_total-$_coupon_amount);
								}else{
									$_coupon_amount	= ($cart_total*$coupon_amount)/100;
									$_total_amount	= ($cart_total-$_coupon_amount);              
								}
								$html['success'] 				= 1;	
								$html['msg'] 					= 'Coupon applied successfully';
								$coupon_data['sub_total']		= $cart_total;
								$coupon_data['discount_amount']	= (float)$_coupon_amount;
								$coupon_data['total']			= $_total_amount;
								$html['data'] 					= $coupon_data;
								
							}
						}
					}
				}else{
					if($min_amount!='0'){
						if(($cart_total) >= $min_amount){
							if($max_amount!='0'){
								if($cart_total <= $max_amount){
									if($discount_type=='fix'){
										$_coupon_amount	= $coupon_amount;
										$_total_amount	= ($cart_total-$_coupon_amount);
									}else{
										$_coupon_amount	= ($cart_total*$coupon_amount)/100;
										$_total_amount	= ($cart_total-$_coupon_amount);              
									}
									$html['success'] 				= 1;	
									$html['msg'] 					= 'Coupon applied successfully';
									$coupon_data['sub_total']		= $cart_total;
									$coupon_data['discount_amount']	= (float)$_coupon_amount;
									$coupon_data['total']			= $_total_amount;
									$html['data'] 					= $coupon_data;
									
								}else{
									$html['success'] 				= 0;
									$html['msg'] 					= 'Reached Maximum order amount';
									$coupon_data['sub_total']		= '';
									$coupon_data['discount_amount']	= '';
									$coupon_data['total']			= $cart_total;
									$html['data'] 					= $coupon_data;
								}
							}else{
								if($discount_type=='fix'){
									$_coupon_amount	= $coupon_amount;
									$_total_amount	= ($cart_total-$_coupon_amount);
								}else{
									$_coupon_amount	= ($cart_total*$coupon_amount)/100;
									$_total_amount	= ($cart_total-$_coupon_amount);              
								}
								$html['success'] 				= 1;
								$html['msg'] 					= 'Coupon applied successfully';
								$coupon_data['sub_total']		= $cart_total;
								$coupon_data['discount_amount']	= (float)$_coupon_amount;
								$coupon_data['total']			= $_total_amount;
								$html['data'] 					= $coupon_data;
								
							}
						}else{
							$html['success'] 				= 0;
							$html['msg'] 					=  'Minimum Rs.'.$min_amount.'/- order amount is required.';
							$coupon_data['sub_total']		= '';
							$coupon_data['discount_amount']	= '';
							$coupon_data['total']			= $cart_total;
							$html['data'] 					= $coupon_data;
						}
					}else{
						if($max_amount!='0'){
							if($cart_total <= $max_amount){
								if($discount_type=='fix'){
									$_coupon_amount	= $coupon_amount;
									$_total_amount	= ($cart_total-$_coupon_amount);
								}else{
									$_coupon_amount	= ($cart_total*$coupon_amount)/100;
									$_total_amount	= ($cart_total-$_coupon_amount);              
								}
								$html['success'] 				= 1;	
								$html['msg'] 					= 'Coupon applied successfully';
								$coupon_data['sub_total']		= $cart_total;
								$coupon_data['discount_amount']	= (float)$_coupon_amount;
								$coupon_data['total']			= $_total_amount;
								$html['data'] 					= $coupon_data;
								
							}else{
								$html['success'] 				= 0;
								$html['msg'] 					= 'Reached Maximum order amount';
								$coupon_data['sub_total']		= '';
								$coupon_data['discount_amount']	= '';
								$coupon_data['total']			= $cart_total;
								$html['data'] 					= $coupon_data;
							}
						}else{
							if($discount_type=='fix'){
								$_coupon_amount	= $coupon_amount;
								$_total_amount	= ($cart_total-$_coupon_amount);
							}else{
								$_coupon_amount	= ($cart_total*$coupon_amount)/100;
								$_total_amount	= ($cart_total-$_coupon_amount);              
							}
							$html['success'] 				= 1;
							$html['msg'] 					= 'Coupon applied successfully';
							$coupon_data['sub_total']		= $cart_total;
							$coupon_data['discount_amount']	= (float)$_coupon_amount;
							$coupon_data['total']			= $_total_amount;
							$html['data'] 					= $coupon_data;
						}
					} 
				}
			} 
			
			  
			
		}else{
			$html['success'] 				= 0;
			$html['msg'] 					= 'Invalid coupon code';
			$coupon_data['sub_total']		= '';
			$coupon_data['discount_amount']	= '';
			$coupon_data['total']			= $cart_total;
			$html['data'] 					= $coupon_data;
		} 
	}else{
		$html['success'] 				= 0;
		$html['msg'] 					= 'Coupon code can not be empty.';
		$coupon_data['sub_total']		= '';
		$coupon_data['discount_amount']	= '';
		$coupon_data['total']			= $cart_total;
		$html['data'] 					= $coupon_data;
	}
	
	if($html['success']==1){
		 $delivery_charge = get_delivery_charge_by_restaurant_ID($restaurant_id);
		
		$total_amount = $html['data']['total'];
		if($total_amount > 0){
			$total_amount = $html['data']['total'];
		} else{
			$total_amount = 0;
		}
		$coupon_data['total']	= $total_amount + $delivery_charge['delivery_charge'];
		$html['data'] 			= $coupon_data;
		
		$cart_data['coupon_code']   = $coupon_code;
		$cart_data['coupon_amount'] = $html['data']['discount_amount'];
		$cart_data['total_amount']  = $total_amount + $delivery_charge['delivery_charge'] ;
		
	
		$CI->common_model->update_data('cart',$cart_data,array('user_id'=>$user_id));
		 
	}
		
	echo json_encode($html);
	exit();
}


function coupon_check($coupon_code,$cart_total,$user_id,$restaurant_id){
	
	$CI =& get_instance();
	  
	if(!empty($coupon_code) ){
			
		$get_coupon_data = $CI->common_model->check_coupon_exist($coupon_code);
		
		if(!empty($get_coupon_data)){
			
			//$usage_limit 				= $get_coupon_data['get_usage_limit'];
			$usage_limit 				= $get_coupon_data['usage_limit_per_coupon'];
			$_total_used_coupon 		= $get_coupon_data['get_usage_count'];
			$usage_limit_per_user 		= $get_coupon_data['usage_limit_per_user'];
			$get_individual_use 		= $get_coupon_data['get_individual_use']; // true/false
			$max_amount 				= $get_coupon_data['max_spend'];
			$min_amount 				= $get_coupon_data['min_spend'];
			
			$start_date 				= strtotime($get_coupon_data['start_date']);
			$end_date 					= strtotime($get_coupon_data['end_date']);
			$current_date				= strtotime(date('Y-m-d'));
			
			$restaurant 				= $get_coupon_data['restaurant'];
			
			if(!empty($get_coupon_data['get_used_by'])){
				$get_used_by 				= explode(',',$get_coupon_data['get_used_by']);
			}else{
				$get_used_by 				= '';
			}
			
			$coupon_amount 				= $get_coupon_data['discount'];
			$discount_type 				= $get_coupon_data['dis_type'];
			
			$count_get_used_by_user = 0;
			if(!empty($get_used_by)){
				foreach($get_used_by as $value){
					if($user_id == $value){
						$count_get_used_by_user++;
					}
				}
			}
		
			// Restrict coupon to restaurant
			if(!empty($restaurant) && $restaurant_id!=''){
				$restaurant_limit 				= explode(',',$restaurant);
				
				if(!in_array($restaurant_id,$restaurant_limit)){
					$coupon_valid = '';
				}
			}
			
			// Restrict coupon to start and end Date
			if($start_date <= $current_date && $current_date <= $end_date) {
				
			}else{
				$coupon_valid = '';
			}
			
			if($usage_limit!='0'){
				
				if($usage_limit <= $_total_used_coupon){
					$coupon_valid = '';
				}else{
					if($usage_limit_per_user!='0'){
						//if($usage_limit_per_user <= $get_individual_use){
						if($usage_limit_per_user <= $count_get_used_by_user){
							$coupon_valid = '';
							
						}else{
							if($max_amount!='0'){
								if($cart_total <= $max_amount){
									if($discount_type=='fix'){
										$_coupon_amount = $coupon_amount;
										$_total_amount	= ($cart_total-$_coupon_amount); 
									}else{
										$_coupon_amount	= ($cart_total*$coupon_amount)/100;
										$_total_amount	= ($cart_total-$_coupon_amount);  
									}
									
									
									$coupon_valid = $coupon_code;
									
									//$coupon->increase_usage_count( $used_by_email );
									
								}else{
									$coupon_valid = '';
								}
							}else{
								if($discount_type=='fix'){
									$_coupon_amount= $coupon_amount;
									$_total_amount=($cart_total-$_coupon_amount);
								}else{
									$_coupon_amount=($cart_total*$coupon_amount)/100;
									$_total_amount=($cart_total-$_coupon_amount);              
								}
								
								$coupon_valid = $coupon_code;
								
								//$coupon->increase_usage_count( $used_by_email );
							}
						}
					}else{
						if($max_amount!='0'){
							if($cart_total <= $max_amount){
								 
								
								$coupon_valid = $coupon_code;
								
								//$coupon->increase_usage_count( $used_by_email );
								
							}else{
								$coupon_valid = '';
							}
						}else{
							 
							$coupon_valid = $coupon_code;
							
						}
					}
				}
			}else{
				
				if($usage_limit_per_user!='0'){
					
					if($usage_limit_per_user <= $count_get_used_by_user){
						$coupon_valid = '';
					}else{
						
						if($min_amount!='0'){
							if(($cart_total) >= $min_amount){
								if($max_amount!='0'){
							
									if($cart_total <= $max_amount){
													
										 
										
										$coupon_valid = $coupon_code;
										
									}else{
										$coupon_valid = '';
										
									}
								}else{
									 
									$coupon_valid = $coupon_code;
									
									//$coupon->increase_usage_count( $used_by_email );
								}
							}else{
							$coupon_valid = '';
							}
						}else{
							if($max_amount!='0'){
							
								if($cart_total <= $max_amount){
												
									 
									$coupon_valid = $coupon_code;
									
								}else{
									$coupon_valid = '';
									
								}
							}else{
								 
								$coupon_valid = $coupon_code;
								
							}
						}
					}
				}else{
					if($min_amount!='0'){
						if(($cart_total) >= $min_amount){
							if($max_amount!='0'){
								if($cart_total <= $max_amount){
									 
									$coupon_valid = $coupon_code;
									
								}else{
									$coupon_valid = '';
								}
							}else{
								 
							$coupon_valid = $coupon_code;
								
							}
						}else{
							$coupon_valid = '';
						}
					}else{
						if($max_amount!='0'){
							if($cart_total <= $max_amount){
								 
								$coupon_valid = $coupon_code;
								
							}else{
								$coupon_valid = '';
							}
						}else{
							 
							$coupon_valid = $coupon_code;
						}
					} 
				}
			} 
			 if($coupon_code == 'REFERRAL100'){
				 $coupon_valid = $coupon_code;
			 }
		}else{
		$coupon_valid = '';
		} 
	}else{
		$coupon_valid = '';
	}
	 
	return $coupon_valid;
}




function coupon_discount($coupon_code,$cart_total,$user_id,$restaurant_id){
	
	$CI =& get_instance();
	
	$CI->db->select('my_referral_code,earn_point');
	$CI->db->where('user_id',$user_id); 
	$query = $CI->db->get('referrals_data');
	$referral_result = $query->row_array();
	 
	 $count = 0;
	if(!empty($referral_result['my_referral_code'])){
		//$count = $referral_result['earn_point'] / 50; 
		$count = $referral_result['earn_point'] / 100; 
	} 
	
	 if($count < 1 && $coupon_code == 'REFERRAL100'){
		$html['success'] 				= 0;
		$html['msg'] 					= 'coupon code is not valid.';
		$coupon_data['sub_total']		= '';
		$coupon_data['discount_amount']	= '';
		$coupon_data['total']			= $cart_total;
		$html['data'] 					= $coupon_data;
		echo json_encode($html);
		exit();
	}
	
	if(!empty($coupon_code) && !empty($cart_total)){
			
		$get_coupon_data = $CI->common_model->check_coupon_exist($coupon_code);
		
		if(!empty($get_coupon_data)){
			
			//$usage_limit 				= $get_coupon_data['get_usage_limit'];
			$usage_limit 				= $get_coupon_data['usage_limit_per_coupon'];
			$_total_used_coupon 		= $get_coupon_data['get_usage_count'];
			$usage_limit_per_user 		= $get_coupon_data['usage_limit_per_user'];
			$get_individual_use 		= $get_coupon_data['get_individual_use']; // true/false
			$max_amount 				= $get_coupon_data['max_spend'];
			$min_amount 				= $get_coupon_data['min_spend'];
			
			$start_date 				= strtotime($get_coupon_data['start_date']);
			$end_date 					= strtotime($get_coupon_data['end_date']);
			$current_date				= strtotime(date('Y-m-d'));
			
			$restaurant 				= $get_coupon_data['restaurant'];
			
			if(!empty($get_coupon_data['get_used_by'])){
				$get_used_by 				= explode(',',$get_coupon_data['get_used_by']);
			}else{
				$get_used_by 				= '';
			}
			
			$coupon_amount 				= $get_coupon_data['discount'];
			$discount_type 				= $get_coupon_data['dis_type'];
			
			$count_get_used_by_user = 0;
			if(!empty($get_used_by)){
				foreach($get_used_by as $value){
					if($user_id == $value){
						$count_get_used_by_user++;
					}
				}
			}
		
			// Restrict coupon to restaurant
			if(!empty($restaurant) && $restaurant_id!=''){
				$restaurant_limit 				= explode(',',$restaurant);
				
				if(!in_array($restaurant_id,$restaurant_limit)){
					$html['success'] 				= 0;
					$html['msg'] 					= 'coupon code is not valid for this restaurant.';
					$coupon_data['sub_total']		= '';
					$coupon_data['discount_amount']	= '';
					$coupon_data['total']			= $cart_total;
					$html['data'] 					= $coupon_data;
					echo json_encode($html);
					exit();
				}
			}
			
			// Restrict coupon to start and end Date
			if($start_date <= $current_date && $current_date <= $end_date) {
				
			}else{
				$html['success'] 				= 0;
				$html['msg'] 					= 'Invalid coupon code';
				$coupon_data['sub_total']		= '';
				$coupon_data['discount_amount']	= '';
				$coupon_data['total']			= $cart_total;
				$html['data'] 					= $coupon_data;
				echo json_encode($html);
				exit();
			}
			
			if($usage_limit!='0'){
				echo $usage_limit ."<=". $_total_used_coupon;
				if($usage_limit <= $_total_used_coupon){
					$html['success'] = 0;
					$html['msg'] = 'Coupon already used';
					
					$coupon_data['sub_total']= '';
					$coupon_data['discount_amount']= '';
					$coupon_data['total']= $cart_total;
					$html['data'] = $coupon_data;
				}else{
					if($usage_limit_per_user!='0'){
						//if($usage_limit_per_user <= $get_individual_use){
						if($usage_limit_per_user <= $count_get_used_by_user){
							$html['success'] = 0;
							$html['msg'] = 'Coupon already used';
							$coupon_data['sub_total']= '';
							$coupon_data['discount_amount']= '';
							$coupon_data['total']= $cart_total;
							$html['data'] = $coupon_data;
							
						}else{
							if($max_amount!='0'){
								if($cart_total <= $max_amount){
									if($discount_type=='fix'){
										$_coupon_amount = $coupon_amount;
										$_total_amount	= ($cart_total-$_coupon_amount); 
									}else{
										$_coupon_amount	= ($cart_total*$coupon_amount)/100;
										$_total_amount	= ($cart_total-$_coupon_amount);  
									}
									
									
									$html['success'] = 1;
									$html['msg'] = 'Coupon applied successfully';
									
									$coupon_data['sub_total']= $cart_total;
									$coupon_data['discount_amount']= (float)$_coupon_amount;
									$coupon_data['total']= $_total_amount;
									$html['data'] = $coupon_data;
									
									//$coupon->increase_usage_count( $used_by_email );
									
								}else{
									$html['success'] = 0;
									$html['msg'] = 'Reached Maximum order amount';
									$coupon_data['sub_total']= '';
									$coupon_data['discount_amount']= '';
									$coupon_data['total']= $cart_total;
									$html['data'] = $coupon_data;
								}
							}else{
								if($discount_type=='fix'){
									$_coupon_amount= $coupon_amount;
									$_total_amount=($cart_total-$_coupon_amount);
								}else{
									$_coupon_amount=($cart_total*$coupon_amount)/100;
									$_total_amount=($cart_total-$_coupon_amount);              
								}
								
								$html['success'] = 1;
								$html['msg'] = 'Coupon applied successfully';
								$coupon_data['sub_total']= $cart_total;
								$coupon_data['discount_amount']= (float)$_coupon_amount;
								$coupon_data['total']= $_total_amount;
								$html['data'] = $coupon_data;
								
								//$coupon->increase_usage_count( $used_by_email );
							}
						}
					}else{
						if($max_amount!='0'){
							if($cart_total <= $max_amount){
								if($discount_type=='fix'){
									$_coupon_amount= $coupon_amount;
									$_total_amount=($cart_total-$_coupon_amount);
								}else{
									$_coupon_amount=($cart_total*$coupon_amount)/100;
									$_total_amount=($cart_total-$_coupon_amount);              
								}
								
								$html['success'] = 1;
								$html['msg'] = 'Coupon applied successfully';
								$coupon_data['sub_total']= $cart_total;
								$coupon_data['discount_amount']= (float)$_coupon_amount;
								$coupon_data['total']= $_total_amount;
								$html['data'] = $coupon_data;
								
								//$coupon->increase_usage_count( $used_by_email );
								
							}else{
								$html['success'] = 0;
								$html['msg'] = 'Reached Maximum order amount';
								$coupon_data['sub_total']= '';
								$coupon_data['discount_amount']= '';
								$coupon_data['total']= $cart_total;
								$html['data'] = $coupon_data;
							}
						}else{
							if($discount_type=='fix'){
								$_coupon_amount= $coupon_amount;
								$_total_amount=($cart_total-$_coupon_amount);
							}else{
								$_coupon_amount=($cart_total*$coupon_amount)/100;
								$_total_amount=($cart_total-$_coupon_amount);              
							}
							$html['success'] = 1;
							$html['msg'] = 'Coupon applied successfully';
							$coupon_data['sub_total']= $cart_total;
							$coupon_data['discount_amount']= (float)$_coupon_amount;
							$coupon_data['total']= $_total_amount;
							$html['data'] = $coupon_data;
							
						}
					}
				}
			}else{
				
				if($usage_limit_per_user!='0'){
					
					if($usage_limit_per_user <= $count_get_used_by_user){
						$html['success'] 				= 0;
						$html['msg'] 					= 'Coupon already used';
						$coupon_data['sub_total']		= '';
						$coupon_data['discount_amount']	= '';
						$coupon_data['total']			= $cart_total;
						$html['data'] 					= $coupon_data;
					}else{
						
						if($min_amount!='0'){
							if(($cart_total) >= $min_amount){
								if($max_amount!='0'){
							
									if($cart_total <= $max_amount){
													
										if($discount_type=='fix'){
											$_coupon_amount	= $coupon_amount;
											$_total_amount	= ($cart_total-$_coupon_amount);
										}else{
											$_coupon_amount	= ($cart_total*$coupon_amount)/100;
											$_total_amount	= ($cart_total-$_coupon_amount);              
										}
										
										$html['success'] 				= 1;
										$html['msg'] 					= 'Coupon applied successfully';
										$coupon_data['sub_total']		= $cart_total;
										$coupon_data['discount_amount']	= (float)$_coupon_amount;
										$coupon_data['total']			= $_total_amount;
										$html['data']					= $coupon_data;
										
									}else{
										$html['success'] 				= 0;
										$html['msg'] 					= 'Reached Maximum order amount';
										$coupon_data['sub_total']		= '';
										$coupon_data['discount_amount']	= '';
										$coupon_data['total']			= $cart_total;
										$html['data'] 					= $coupon_data;
										
									}
								}else{
									if($discount_type=='fix'){
										$_coupon_amount	= $coupon_amount;
										$_total_amount	= ($cart_total-$_coupon_amount);
									}else{
										$_coupon_amount	= ($cart_total*$coupon_amount)/100;
										$_total_amount	= ($cart_total-$_coupon_amount);              
									}
									$html['success'] 				= 1;	
									$html['msg'] 					= 'Coupon applied successfully';
									$coupon_data['sub_total']		= $cart_total;
									$coupon_data['discount_amount']	= (float)$_coupon_amount;
									$coupon_data['total']			= $_total_amount;
									$html['data'] 					= $coupon_data;
									
									//$coupon->increase_usage_count( $used_by_email );
								}
							}else{
								$html['success'] 				= 0;
								$html['msg'] 					=  'Minimum Rs.'.$min_amount.'/- order amount is required.';
								$coupon_data['sub_total']		= '';
								$coupon_data['discount_amount']	= '';
								$coupon_data['total']			= $cart_total;
								$html['data'] 					= $coupon_data;
							}
						}else{
							if($max_amount!='0'){
							
								if($cart_total <= $max_amount){
												
									if($discount_type=='fix'){
										$_coupon_amount	= $coupon_amount;
										$_total_amount	= ($cart_total-$_coupon_amount);
									}else{
										$_coupon_amount	= ($cart_total*$coupon_amount)/100;
										$_total_amount	= ($cart_total-$_coupon_amount);              
									}
									
									$html['success'] 				= 1;
									$html['msg'] 					= 'Coupon applied successfully';
									$coupon_data['sub_total']		= $cart_total;
									$coupon_data['discount_amount']	= (float)$_coupon_amount;
									$coupon_data['total']			= $_total_amount;
									$html['data'] 					= $coupon_data;
									
								}else{
									$html['success'] 				= 0;
									$html['msg'] 					= 'Reached Maximum order amount';
									$coupon_data['sub_total']		= '';
									$coupon_data['discount_amount']	= '';
									$coupon_data['total']			= $cart_total;
									$html['data'] 					= $coupon_data;
									
								}
							}else{
								if($discount_type=='fix'){
									$_coupon_amount	= $coupon_amount;
									$_total_amount	= ($cart_total-$_coupon_amount);
								}else{
									$_coupon_amount	= ($cart_total*$coupon_amount)/100;
									$_total_amount	= ($cart_total-$_coupon_amount);              
								}
								$html['success'] 				= 1;	
								$html['msg'] 					= 'Coupon applied successfully';
								$coupon_data['sub_total']		= $cart_total;
								$coupon_data['discount_amount']	= (float)$_coupon_amount;
								$coupon_data['total']			= $_total_amount;
								$html['data'] 					= $coupon_data;
								
							}
						}
					}
				}else{
					if($min_amount!='0'){
						if(($cart_total) >= $min_amount){
							if($max_amount!='0'){
								if($cart_total <= $max_amount){
									if($discount_type=='fix'){
										$_coupon_amount	= $coupon_amount;
										$_total_amount	= ($cart_total-$_coupon_amount);
									}else{
										$_coupon_amount	= ($cart_total*$coupon_amount)/100;
										$_total_amount	= ($cart_total-$_coupon_amount);              
									}
									$html['success'] 				= 1;	
									$html['msg'] 					= 'Coupon applied successfully';
									$coupon_data['sub_total']		= $cart_total;
									$coupon_data['discount_amount']	= (float)$_coupon_amount;
									$coupon_data['total']			= $_total_amount;
									$html['data'] 					= $coupon_data;
									
								}else{
									$html['success'] 				= 0;
									$html['msg'] 					= 'Reached Maximum order amount';
									$coupon_data['sub_total']		= '';
									$coupon_data['discount_amount']	= '';
									$coupon_data['total']			= $cart_total;
									$html['data'] 					= $coupon_data;
								}
							}else{
								if($discount_type=='fix'){
									$_coupon_amount	= $coupon_amount;
									$_total_amount	= ($cart_total-$_coupon_amount);
								}else{
									$_coupon_amount	= ($cart_total*$coupon_amount)/100;
									$_total_amount	= ($cart_total-$_coupon_amount);              
								}
								$html['success'] 				= 1;
								$html['msg'] 					= 'Coupon applied successfully';
								$coupon_data['sub_total']		= $cart_total;
								$coupon_data['discount_amount']	= (float)$_coupon_amount;
								$coupon_data['total']			= $_total_amount;
								$html['data'] 					= $coupon_data;
								
							}
						}else{
							$html['success'] 				= 0;
							$html['msg'] 					=  'Minimum Rs.'.$min_amount.'/- order amount is required.';
							$coupon_data['sub_total']		= '';
							$coupon_data['discount_amount']	= '';
							$coupon_data['total']			= $cart_total;
							$html['data'] 					= $coupon_data;
						}
					}else{
						if($max_amount!='0'){
							if($cart_total <= $max_amount){
								if($discount_type=='fix'){
									$_coupon_amount	= $coupon_amount;
									$_total_amount	= ($cart_total-$_coupon_amount);
								}else{
									$_coupon_amount	= ($cart_total*$coupon_amount)/100;
									$_total_amount	= ($cart_total-$_coupon_amount);              
								}
								$html['success'] 				= 1;	
								$html['msg'] 					= 'Coupon applied successfully';
								$coupon_data['sub_total']		= $cart_total;
								$coupon_data['discount_amount']	= (float)$_coupon_amount;
								$coupon_data['total']			= $_total_amount;
								$html['data'] 					= $coupon_data;
								
							}else{
								$html['success'] 				= 0;
								$html['msg'] 					= 'Reached Maximum order amount';
								$coupon_data['sub_total']		= '';
								$coupon_data['discount_amount']	= '';
								$coupon_data['total']			= $cart_total;
								$html['data'] 					= $coupon_data;
							}
						}else{
							if($discount_type=='fix'){
								$_coupon_amount	= $coupon_amount;
								$_total_amount	= ($cart_total-$_coupon_amount);
							}else{
								$_coupon_amount	= ($cart_total*$coupon_amount)/100;
								$_total_amount	= ($cart_total-$_coupon_amount);              
							}
							$html['success'] 				= 1;
							$html['msg'] 					= 'Coupon applied successfully';
							$coupon_data['sub_total']		= $cart_total;
							$coupon_data['discount_amount']	= (float)$_coupon_amount;
							$coupon_data['total']			= $_total_amount;
							$html['data'] 					= $coupon_data;
						}
					} 
				}
			} 
		}else{
			$html['success'] 				= 0;
			$html['msg'] 					= 'Invalid coupon code';
			$coupon_data['sub_total']		= '';
			$coupon_data['discount_amount']	= '';
			$coupon_data['total']			= $cart_total;
			$html['data'] 					= $coupon_data;
		} 
	}else{
		$html['success'] 				= 0;
		$html['msg'] 					= 'Coupon code can not be empty.';
		$coupon_data['sub_total']		= '';
		$coupon_data['discount_amount']	= '';
		$coupon_data['total']			= $cart_total;
		$html['data'] 					= $coupon_data;
	}
	
	if($html['success']==1){
			
		//$data['data'] = $html;
		$data['data'] = $coupon_data;
	}
		
	return $coupon_data;
}
