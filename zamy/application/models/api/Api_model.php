<?php
class Api_model extends CI_Model{

	public function sendpassword($data){
		
		$email = $data['email'];
		$newpass = $data['password'];
		$query1=$this->db->query("SELECT * from online_customer where email = '".$email."' ");
		$row=$query1->result_array();
		
		if ($query1->num_rows()>0){
		$updata=array('password'=>$newpass);
		$this->db->where('email', $email);
		$this->db->update('online_customer', $updata); 
		   return true;
		}else{  
			return false;
		}
	}  
	
	/*public function get_top_restaurant($limit,$offset='0',$total_row=''){
	 
		$this->db->select("kitchens.id,kitchens.res_name, SUM(total_payable) AS total_payable, kitchens.type,  kitchens.email,kitchens.images,kitchens.logo, kitchens.address, kitchens.area,kitchens.landmark, kitchens.zipcode, kitchens.country, kitchens.state, kitchens.city, kitchens.approx_delivery_time, kitchens.currency_format, kitchens.service_type, case when   fav_restaurants.restaurant_id then 'yes' else 'no' end as favourite_flag");
		$this->db->from("tbl_sales");
		$this->db->join("kitchens","kitchens.id = tbl_sales.outlet_id and DATE_FORMAT( tbl_sales.creted_date,'%Y-%m-%d') > DATE_SUB(NOW(), INTERVAL 1 WEEK)","RIGHT");
		$this->db->join("fav_restaurants","fav_restaurants.restaurant_id = kitchens.id","LEFT");
		$this->db->group_by("kitchens.id");
		$this->db->order_by("total_payable","DESC"); 
		if(!empty($total_row)){
			$result = $this->db->get()->num_rows();
		}
		else{
			$this->db->limit($limit,$offset);
			$result = $this->db->get()->result_array();	
		}
	
		return $result;
		 
	} */
	
	public function get_top_restaurant($limit,$offset='0',$total_row=''){
	 
		$this->db->select("kitchens.id,kitchens.res_name,   kitchens.type,  kitchens.email,kitchens.images,kitchens.logo, kitchens.address, kitchens.area,kitchens.landmark, kitchens.zipcode, kitchens.country, kitchens.state, kitchens.city, kitchens.approx_delivery_time, kitchens.currency_format, kitchens.service_type, case when   fav_restaurants.restaurant_id then 'yes' else 'no' end as favourite_flag");
		$this->db->from("orders");
		$this->db->join("kitchens","kitchens.id = orders.restaurant_id and DATE_FORMAT( orders.created_date,'%Y-%m-%d') > DATE_SUB(NOW(), INTERVAL 1 WEEK)","RIGHT");
		$this->db->join("fav_restaurants","fav_restaurants.restaurant_id = kitchens.id","LEFT");
		$this->db->group_by("kitchens.id");
		//$this->db->order_by("total_payable","DESC"); 
		if(!empty($total_row)){
			$result = $this->db->get()->num_rows();
		}
		else{
			$this->db->limit($limit,$offset);
			$result = $this->db->get()->result_array();	
			
		}
	
		return $result;
		 
	} 
	
	public function top_restaurant($user_id,$limit,$offset=''){
	  
		$this->db->select("kitchens.id,kitchens.res_name,   kitchens.type,  kitchens.email,kitchens.images,kitchens.logo, kitchens.address, kitchens.area,kitchens.landmark, kitchens.zipcode, kitchens.country, kitchens.state, kitchens.city, kitchens.approx_delivery_time, kitchens.currency_format, kitchens.service_type,   count(orders.id) as total_orders");
		$this->db->from("kitchens");
		$this->db->join('orders', 'orders.restaurant_id = kitchens.id','left');
		$this->db->group_by("kitchens.id");
		$this->db->order_by('total_orders','DESC');
		
		if(!empty($total_row)){
			$result = $this->db->get()->num_rows();
		}
		else{
			$this->db->limit($limit,$offset);
			$result = $this->db->get()->result_array();	
			//echo $this->db->last_query();
		}
	
		return $result;
		 
	} 
	 
		/*
     * Get Food Menu variance List
     */
    public function get_food_menu_variance($menu_id){
 
        $this->db->select('v.id, v.name ,fmv.vprice,fmv.vreduced_price');
		$this->db->from('variations as v');
		$this->db->join('foodmenu_variation as fmv','fmv.vfood_variation = v.id');
		$this->db->where('fmv.vfoodmenu_id',$menu_id);
		$query = $this->db->get();
		return $result = $query->result_array();
    }
	
	 public function get_favourite_restaurant($user_id,$limit='',$offset='',$total_row=''){
 
        $this->db->select('kitchens.id,kitchens.res_name,kitchens.images,kitchens.logo,kitchens.service_type,kitchens.address,kitchens.area,kitchens.landmark,kitchens.zipcode,kitchens.latitude,kitchens.longitude,kitchens.contact_information,kitchens.pure_veg');
		$this->db->from('kitchens');
		$this->db->join('fav_restaurants','fav_restaurants.restaurant_id = kitchens.id');
		$this->db->where('fav_restaurants.user_id',$user_id);
		
		if(!empty($total_row)){
			return $result = $this->db->get()->num_rows();
		}
		else{
			$this->db->limit($limit,$offset);
			$result = $this->db->get()->result_array();	
			//echo $this->db->last_query();
			$res_data = array();
			if(!empty($result)){
				$i=0;
				foreach($result as $data){
					  
					$new_data[$i]['id'] 			= $data['id'];
					$new_data[$i]['res_name'] 		= $data['res_name'];
					$new_data[$i]['images'] 		= $this->config->item('restaurant_image_url').$data['images'];
					$new_data[$i]['logo'] 			= $this->config->item('pos_restaurant_logo').$data['logo'];
					$new_data[$i]['service_type'] 	= $data['service_type'];
					$new_data[$i]['address'] 		= $data['address'];
					$new_data[$i]['area'] 			= $data['area'];
					$new_data[$i]['landmark'] 		= $data['landmark'];
					$new_data[$i]['zipcode'] 		= $data['zipcode'];
					$new_data[$i]['latitude'] 		= $data['latitude'];
					$new_data[$i]['longitude'] 		= $data['longitude'];
					$new_data[$i]['contact_information'] = $data['contact_information'];
					$new_data[$i]['pure_veg'] 		= $data['pure_veg'];
					
					$res_data = $new_data; 
				$i++;
				}
			}
			
			return $res_data;
			
			
		}
		//$query = $this->db->get();
		//$result = $query->result_array();
		
		
    }
	 
	public function get_popular_this_month($limit){
	  
		$this->db->select("orders.id, count(order_items.food_menu_id ) as food_menu_id,	order_items.variation_id, order_items.qty,foodmenu.foodmenu_id,foodmenu.menu_name, foodmenu.short_code , foodmenu.online_display_name ,foodmenu.menu_logo , foodmenu.price, foodmenu.reduced_price ,kitchens.id as kitchen_id ,kitchens.res_name, kitchens.service_type, kitchens.logo,kitchens.images, kitchens.address, kitchens.area,kitchens.landmark, kitchens.zipcode, kitchens.country, kitchens.state, kitchens.city");
		$this->db->from("orders"); 
		$this->db->join("order_items","order_items.order_id = orders.id");
		$this->db->join("kitchens","kitchens.id = orders.restaurant_id");
		$this->db->join("foodmenu","foodmenu.foodmenu_id = order_items.food_menu_id");
		$this->db->where("DATE_FORMAT( orders.created_date,'%Y-%m-%d') > DATE_SUB(NOW(), INTERVAL 1 MONTH)");
		$this->db->group_by("order_items.food_menu_id");
		$this->db->order_by("order_items.id","DESC");
		//$this->db->limit($limit);
		$result = $this->db->get()->result_array(); 
		 //echo $this->db->last_query();
		return $result; 
	} 
	
	 public function get_deliveryboy_order_list($delivery_boy_id,$type,$limit,$offset='0',$total_row=''){
		//type:history / upcoming/ current
		$current_date = date('Y-m-d');
        $this->db->select('orders.id, orders.restaurant_id, orders.customer_name, orders.shipping_name, orders.shipping_address,orders.payment_method, orders.total_items, orders.order_total ,orders.order_status, orders.kitchens_status, orders.created_date,delivery_boy.latitude,delivery_boy.longitude, assign_delivery_boy.delivery_boy_id,  assign_delivery_boy.assigned_date, assign_delivery_boy.job_accepted_status, kitchens.res_name, kitchens.service_type, kitchens.address, kitchens.area, kitchens.landmark, kitchens.zipcode, kitchens.country, kitchens.state, kitchens.city'); 
		$this->db->from('orders');
		$this->db->join('assign_delivery_boy','assign_delivery_boy.order_id = orders.id' );
		$this->db->join('delivery_boy','delivery_boy.id = assign_delivery_boy.delivery_boy_id' );
		$this->db->join('kitchens','kitchens.id = orders.restaurant_id','left');
		
		if($type == 'upcoming')
		{
			$this->db->where('assign_delivery_boy.job_accepted_status','Assigned');
			$this->db->where("DATE_FORMAT(assign_delivery_boy.assigned_date,'%Y-%m-%d') > '$current_date'");
		}
		elseif($type == 'current')
		{
			$this->db->where_not_in('assign_delivery_boy.job_accepted_status',array('Delivered','Rejected'));
			$this->db->where("DATE_FORMAT(assign_delivery_boy.assigned_date,'%Y-%m-%d') = '$current_date'");
		}
		else
		{
			$this->db->where_in('assign_delivery_boy.job_accepted_status',array('Delivered','Rejected'));
		}
		$this->db->where('assign_delivery_boy.delivery_boy_id',$delivery_boy_id);
		$this->db->order_by("assign_delivery_boy.id","DESC"); 
		if(!empty($total_row)){
			$result = $this->db->get()->num_rows();
		}
		else{
			//$this->db->limit($limit,$offset);
			$result = $this->db->get()->result_array();	
			 
		}
		 	
		return $result;
    }
	
	public function get_deliveryboy_order_list1($delivery_boy_id,$type,$limit,$offset='0',$total_row=''){
		//type:history / upcoming/ current
		
		$current_date = date('Y-m-d');
        $this->db->select('orders.id, orders.restaurant_id, orders.customer_name, orders.shipping_name, orders.shipping_address,orders.payment_method, orders.total_items, orders.order_total ,orders.order_status, orders.kitchens_status, orders.created_date,delivery_boy.latitude,delivery_boy.longitude, assign_delivery_boy.delivery_boy_id,  assign_delivery_boy.assigned_date, assign_delivery_boy.job_accepted_status, kitchens.res_name, kitchens.service_type, kitchens.address, kitchens.area, kitchens.landmark, kitchens.zipcode, kitchens.country, kitchens.state, kitchens.city'); 
		$this->db->from('orders');
		$this->db->join('assign_delivery_boy','assign_delivery_boy.order_id = orders.id' );
		$this->db->join('delivery_boy','delivery_boy.id = assign_delivery_boy.delivery_boy_id' );
		$this->db->join('kitchens','kitchens.id = orders.restaurant_id','left');
		
		if($type == 'upcoming')
		{
			$this->db->where('assign_delivery_boy.job_accepted_status','Assigned');
			$this->db->where("DATE_FORMAT(assign_delivery_boy.assigned_date,'%Y-%m-%d') > '$current_date'");
		}
		elseif($type == 'current')
		{
			$this->db->where_not_in('assign_delivery_boy.job_accepted_status',array('Delivered','Rejected'));
			$this->db->where("DATE_FORMAT(assign_delivery_boy.assigned_date,'%Y-%m-%d') = '$current_date'");
		}
		else
		{
			$this->db->where_in('assign_delivery_boy.job_accepted_status',array('Delivered','Rejected'));
		}
		$this->db->where('assign_delivery_boy.delivery_boy_id',$delivery_boy_id);
		$this->db->order_by("assign_delivery_boy.id","DESC"); 
		if(!empty($total_row)){
			$result = $this->db->get()->num_rows();
		}
		else{
			//$this->db->limit($limit,$offset);
			$result = $this->db->get()->result_array();	
			 
		}
		 	
		return $result;
    }
	 
	public function get_customer_order_list($customer_id,$limit,$offset='0',$total_row=''){
 
        $this->db->select('orders.id, orders.restaurant_id, orders.shipping_name, orders.payment_method, orders.order_total ,orders.kitchens_status, orders.order_status, orders.created_date, kitchens.res_name,kitchens.images,kitchens.logo, kitchens.service_type, kitchens.address, kitchens.area, kitchens.landmark, kitchens.zipcode, kitchens.country, kitchens.state, kitchens.city');
		$this->db->from('orders');
		$this->db->join('online_customer','online_customer.id = orders.user_id');
		$this->db->join('kitchens','kitchens.id = orders.restaurant_id');
		$this->db->where('online_customer.id',$customer_id);
		$this->db->order_by("orders.id","DESC"); 
		if(!empty($total_row)){
			$result = $this->db->get()->num_rows();
		}
		else{
			$this->db->limit($limit,$offset);
			$result = $this->db->get()->result_array();	
		}
		return $result;
    }
	 
	public function get_order_detail($order_id){
 
      /*  $this->db->select('orders.id, order_items.menu_name ,order_items.variation_name,orders.kitchens_status, ,order_items.qty ,order_items.subtotal ,orders.restaurant_id, orders.customer_name, orders.shipping_name, orders.shipping_email , orders.shipping_phone, orders.shipping_address ,orders.total_items, orders.order_total, orders.payment_method, orders.order_status, orders.created_date');
		$this->db->from('orders'); 
		$this->db->join('order_items','order_items.order_id = orders.id'); 
		$this->db->where('orders.id',$order_id); 
		$query = $this->db->get();
		return $result = $query->result_array();	*/
		
		$this->db->select('orders.id, orders.kitchens_status, orders.restaurant_id, orders.customer_name, orders.shipping_name, orders.shipping_email , orders.shipping_phone, orders.shipping_address, orders.shipping_lat, orders.shipping_lng ,orders.total_items, orders.order_total, orders.sub_total, orders.delivery_charge, orders.coupon_code, orders.discount_type, orders.discount_amount, orders.payment_method , orders.order_status,   orders.created_date, assign_delivery_boy.delivery_boy_id, assign_delivery_boy.assigned_date, assign_delivery_boy.job_accepted_status, assign_delivery_boy.delivery_date, online_customer.name ,online_customer.location, online_customer.email, online_customer.phone ,kitchens.res_name, kitchens.service_type, ');
		$this->db->from('orders');
		$this->db->join('assign_delivery_boy','assign_delivery_boy.order_id = orders.id','left');
		$this->db->join('online_customer','online_customer.id = orders.user_id');
		$this->db->join('kitchens','kitchens.id = orders.restaurant_id');
		$this->db->where('orders.id',$order_id); 
		$query = $this->db->get();
		$result = $query->row_array();
		return $result;
    }
	
	public function get_order($order_id){
 		
		$this->db->select('orders.id, orders.kitchens_status, orders.restaurant_id, orders.customer_name, orders.shipping_name, orders.shipping_email , orders.shipping_phone, orders.shipping_address, orders.shipping_lat, orders.shipping_lng ,orders.total_items, orders.order_total, orders.sub_total,orders.delivery_charge, orders.coupon_code, orders.discount_type, orders.discount_amount, orders.payment_method, orders.order_status,   orders.created_date ,kitchens.res_name, kitchens.service_type, online_customer.id as customer_id');
		$this->db->from('orders');
		$this->db->join('online_customer','online_customer.id = orders.user_id');
		$this->db->join('kitchens','kitchens.id = orders.restaurant_id');
		$this->db->where('orders.id',$order_id); 
		$query = $this->db->get();
		$result = $query->row_array();
		return $result;
    }
 
	public function get_order_items($order_id){
		
		$this->db->select('foodmenu.foodmenu_id, order_items.menu_name , order_items.variation_name, order_items.qty ,order_items.subtotal, foodmenu.menu_logo, foodmenu.swiggy_logo, foodmenu.choice');
		$this->db->from('order_items');  
		$this->db->join("foodmenu","foodmenu.foodmenu_id = order_items.food_menu_id",'left');
		$this->db->where('order_items.order_id',$order_id); 
		
		$query = $this->db->get();
		return $result_data = $query->result_array();
			 
	}
	
	public function search_restaurant_dish($search,$limit,$offset='0',$total_row=''){
		 
		$this->db->select("kitchens.id ,kitchens.res_name, kitchens.email, kitchens.service_type, kitchens.logo,kitchens.images ,kitchens.print_logo,kitchens.approx_delivery_time,kitchens.approx_cost, kitchens.address, kitchens.area, kitchens.landmark, kitchens.zipcode, kitchens.country, kitchens.state, kitchens.city, kitchens.additional_info, kitchens.owner_contact_number, kitchens.contact_information");
		$this->db->from("kitchens");
		$this->db->join("foodmenu","foodmenu.restaurant_id = kitchens.id"); 
		$this->db->where("(foodmenu.menu_name LIKE '%".$search."%' OR kitchens.res_name LIKE '%".$search."%')");  
		$this->db->where('foodmenu.menu_status',1);
		$this->db->where('foodmenu.is_deleted',0);
		$this->db->where('kitchens.status',1); 
		$this->db->order_by("foodmenu.foodmenu_id","DESC");
		$this->db->group_by("kitchens.id");
		if(!empty($total_row)){
			$result = $this->db->get()->num_rows(); 
		}
		else{
			$this->db->limit($limit,$offset);
			$result = $this->db->get()->result_array();	
		} 
		 
		return $result;
	}

	public function get_customer_details($customer_id){
		$this->db->select('*');
		$this->db->from('online_customer');
		$this->db->where('online_customer.id',$customer_id); 
		$query = $this->db->get();
		$result = $query->row_array();
		return $result;
	}
	public function get_driver_info($order_id){
		$this->db->select('orders.id ,  delivery_boy.full_name , delivery_boy.phone ,delivery_boy.profile_pic , delivery_boy.latitude, delivery_boy.longitude, delivery_boy.angle ');
		$this->db->from('orders');
		$this->db->join("assign_delivery_boy","assign_delivery_boy.order_id = orders.id"); 
		$this->db->join("delivery_boy","delivery_boy.id = assign_delivery_boy.delivery_boy_id"); 
		$this->db->where('orders.id',$order_id); 
		$this->db->where('orders.order_status','On the way'); 
		$query = $this->db->get();
		$result = $query->row_array();
		//echo $this->db->last_query();
		return $result;
	}
	
	public function fav_restaurant_count($restaurant_id){
		$this->db->select('count(restaurant_id) as count');
		$this->db->from('fav_restaurants');
		$this->db->where('restaurant_id',$restaurant_id); 
		$query = $this->db->get();
		$result = $query->row_array();
		return $result; 

	}
	
}