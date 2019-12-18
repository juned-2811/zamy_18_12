<?php
class Order_model extends CI_Model{

	public function order_details($order_id,$user_id){
		
		$this->db->select('orders.*,
		online_customer.email as billing_email,online_customer.phone as billing_phone,online_customer.city as billing_city,online_customer.state as billing_state,online_customer.country as billing_country,
		kitchens.res_name as restaurant_name,kitchens.email as restaurant_email');
		$this->db->from('orders');
		$this->db->join('online_customer','online_customer.id=orders.user_id');
		$this->db->join('kitchens','kitchens.id=orders.restaurant_id');
		$this->db->where('orders.id',$order_id);
		$this->db->where('orders.user_id',$user_id);
		$order= $this->db->get()->row_array();
		
		$order_data = array();
		if(!empty($order)){
			
			$order_data['order_id'] 		= $order['id'];
			$order_data['restaurant_id'] 	= $order['restaurant_id'];
			$order_data['restaurant_name'] 	= $order['restaurant_name'];
			$order_data['restaurant_email'] 	= $order['restaurant_email'];
			
			$order_data['user_id'] 			= $order['user_id'];
			$order_data['total_items'] 		= $order['total_items'];
			$order_data['sub_total'] 		= $order['sub_total'];
			$order_data['delivery_charge'] 	= $order['delivery_charge'];
			$order_data['coupon_code'] 		= $order['coupon_code'];
			$order_data['discount_type'] 	= $order['discount_type'];
			$order_data['discount_amount'] 	= $order['discount_amount'];
			$order_data['order_total'] 		= $order['order_total'];
			$order_data['complementary_food'] = $order['complementary_food'];
			$order_data['payment_method'] 	= $order['payment_method'];
			$order_data['order_status'] 	= $order['order_status'];
			$order_data['order_date'] 		= date('d-m-Y h:i:s',strtotime($order['created_date']));
			
			$order_data['billing']['billing_name'] 	= $order['customer_name'];
			$order_data['billing']['billing_email'] 	= $order['billing_email'];
			$order_data['billing']['billing_phone'] 	= $order['billing_phone'];
			
			$billing_address ='';
			if(!empty($order['billing_city'])){
				$billing_address .=$order['billing_city'];
			}
			if(!empty($order['billing_state'])){
				$billing_address .=", ".$order['billing_state'];
			}
			if(!empty($order['billing_country'])){
				$billing_address .=", ".$order['billing_country'];
			}
			
			$order_data['billing']['billing_address'] 	= $billing_address;
			
			$order_data['shipping']['shipping_name'] 	= $order['shipping_name'];
			$order_data['shipping']['shipping_email'] 	= $order['shipping_email'];
			$order_data['shipping']['shipping_phone'] 	= $order['shipping_phone'];
			$order_data['shipping']['shipping_address'] = $order['shipping_address'];
			
			$this->db->select('
			order_items.menu_name,order_items.variation_name,order_items.qty,order_items.price,order_items.subtotal,order_items.food_menu_id,foodmenu.menu_logo');
			$this->db->from('order_items');
			$this->db->join('orders', 'orders.id = order_items.order_id', 'left');
			$this->db->join('foodmenu', 'foodmenu.foodmenu_id = order_items.food_menu_id', 'left');
			$this->db->where('order_items.order_id',$order_id);
			$order_items_data	= $this->db->get()->result_array();
			
			if(!empty($order_items_data)){
				foreach($order_items_data as $key=>$items){
					
					if(!empty($items['menu_logo'])){
						$menu_image = "http://pos.zamy.in/uploads/FoodMenu/".$items['menu_logo'];
					}else{
						$menu_image = "http://pos.zamy.in/uploads/FoodMenu/download18.jpeg";
					}
					
					$order_data['order_items'][$key]['food_menu_id']   = $items['food_menu_id'];
					$order_data['order_items'][$key]['menu_name'] 		= $items['menu_name'];
					$order_data['order_items'][$key]['menu_logo'] 		= $menu_image;
					$order_data['order_items'][$key]['variation_name'] 	= $items['variation_name'];
					$order_data['order_items'][$key]['qty'] 			= $items['qty'];
					$order_data['order_items'][$key]['price'] 			= $items['price'];
					$order_data['order_items'][$key]['subtotal'] 		= $items['subtotal'];
				}
			}
		}
		return $order_data;
	}

	public function my_orders($user_id){
		$this->db->select('orders.id as order_id,orders.order_total,orders.delivery_charge,orders.order_status,orders.created_date as order_date,
		kitchens.res_name as restaurant_name,kitchens.res_alias,kitchens.service_type,kitchens.images,kitchens.logo,kitchens.area,kitchens.landmark,kitchens.city');
		$this->db->from('orders');
		$this->db->join('online_customer','online_customer.id=orders.user_id');
		$this->db->join('kitchens','kitchens.id=orders.restaurant_id');
		$this->db->where('orders.user_id',$user_id);
		$this->db->order_by('orders.id','desc');
		$order= $this->db->get()->result_array();
		
		return $order;
	}
	
}

?>