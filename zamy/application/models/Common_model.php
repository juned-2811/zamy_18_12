<?php
class Common_model extends CI_Model{

	public function add_data($table,$data){
		$this->db->insert($table, $data);
		return true;
	}
	
	public function update_data($table,$data,$where){
		$this->db->where($where);
		$this->db->update($table,$data);
		return true;
	}
	
	public function delete_data($table,$where){
		$this->db->where($where);
		$this->db->delete($table);
		return true;
	}

	public function get_all_data($table){
		$query = $this->db->get($table);
		return $result = $query->result_array();
	}

	public function get_data_by_id($where,$table,$fields='',$order_by='',$dir="asc"){
		$this->db->select($fields);
		$this->db->where($where);
		if(($order_by)){
			$this->db->order_by($order_by, $dir);
		}
		$query = $this->db->get($table);
		$result = $query->result_array();
		return $result;
	}
	public function get_field_by_id($table,$field,$where){
		$this->db->select($field);
		$this->db->where($where);
		$query = $this->db->get($table);
		$result = $query->row_array()[$field];
		return $result;
	}

	public function get_all_menus($table,$where){
		$this->db->where($where);
		$query = $this->db->get($table);
		return $result = $query->result_array();
	}
	public function get_specific_fileds_by($where,$table){
		$this->db->select('id,res_name,res_alias,images,service_type,city,area,landmark,approx_delivery_time,approx_cost,pure_veg');
		$this->db->where($where);
		$query = $this->db->get($table);
		$result = $query->result_array();
		return $result;
	}
	function get_Data_Count(){
        return $this->db->count_all('kitchens');

    }
    public function get_restaurants($limit,$offset){
    	$this->db->select('id,res_name,res_alias,logo,images,service_type,city,area,landmark,approx_delivery_time,approx_cost,pure_veg');
    	$this->db->from('kitchens');
    	$this->db->limit($limit,$offset);
    	$this->db->order_by('id','asc');  
		$query = $this->db->get();
        if($query->num_rows() != 0)
         {
              return $query->result_array();
         }
         else
         {
             return false;
         }
    }
	function getRows($table,$params = array()){
	
		if(array_key_exists("fields",$params)){
			$this->db->select($params['fields']);
		}else{
			$this->db->select('*');
		}
		$this->db->from($table);
		
		//fetch data by conditions
		if(array_key_exists("conditions",$params)){
			foreach($params['conditions'] as $key => $value){
				$this->db->where($key,$value);
			}
		}
 
       //fetch data by conditions
		if(array_key_exists("where",$params)){ 
				$this->db->where( $params['where']);  
		}
		//fetch data by like
		if(array_key_exists("like",$params)){
			foreach($params['like'] as $key => $value){
				$this->db->like($key,$value);
			}
		}
		
		if(array_key_exists("id",$params)){
			$this->db->where('id',$params['id']);
			$query = $this->db->get();
			$result = $query->row_array();
		}else{
			//set start and limit
			if(array_key_exists("start",$params) && array_key_exists("limit",$params)){
				$this->db->limit($params['limit'],$params['start']);
			}elseif(!array_key_exists("start",$params) && array_key_exists("limit",$params)){
				$this->db->limit($params['limit']);
			}
			
			if(array_key_exists("returnType",$params) && $params['returnType'] == 'count'){
				$result = $this->db->count_all_results();    
			}elseif(array_key_exists("returnType",$params) && $params['returnType'] == 'single'){
				$query = $this->db->get();
				$result = ($query->num_rows() > 0)?$query->row_array():false;
			}else{
				$query = $this->db->get();
				$result = ($query->num_rows() > 0)?$query->result_array():false;
			}
		}

		//return fetched data
		return $result;
	}

	/////////SELECT HTML/////////////
	public function select_html($from, $name, $field, $type, $class, $e_match = '', $condition = '', $c_match = '', $onchange = '',$condition_type='single',$required = '')
	{
		$return = '';
		$other  = '';
		$multi  = 'no';
		$phrase = 'Choose a ' . $name;
		if ($class == 'demo-cs-multiselect') {
			$other = 'multiple';
			$name  = $name . '[]';
			if ($type == 'edit') {
				$e_match = json_decode($e_match);
				if ($e_match == NULL) {
					$e_match = array();
				}
				$multi = 'yes';
			}
		}
		$return = '<select name="' . $name . '" id="' . $name . '" onChange="' . $onchange . '(this.value,this)" class="' . $class . '" ' . $other . '  data-placeholder="' . $phrase . '" tabindex="2" data-hide-disabled="true" '.$required.'>';
		if (!is_array($from)) {
			if ($condition == '') {
				$all = $this->db->get($from)->result_array();
			} else if ($condition !== '') {
				if($condition_type=='single'){
					$all = $this->db->get_where($from, array(
						$condition => $c_match
					))->result_array();
				}else if($condition_type=='multi'){
					$this->db->where_in($condition,$c_match);
					$all = $this->db->get($from)->result_array();
				}
			}

			$return .= '<option value="">Choose one</option>';

			foreach ($all as $row):
				if ($type == 'add') {
					$return .= '<option value="' . $row[$from . '_id'] . '">' . $row[$field] . '</option>';
				} else if ($type == 'edit') {
					$return .= '<option value="' . $row[$from . '_id'] . '" ';
					if ($multi == 'no') {
						if ($row[$from . '_id'] == $e_match) {
							$return .= 'selected=."selected"';
						}
					} else if ($multi == 'yes') {
						if (in_array($row[$from . '_id'], $e_match)) {
							$return .= 'selected=."selected"';
						}
					}
					$return .= '>' . $row[$field] . '</option>';
				}
			endforeach;
		} else {
			$all = $from;
			$return .= '<option value="">Choose one</option>';
			foreach ($all as $row):
				if ($type == 'add') {
					$return .= '<option value="' . $row . '">';
					if ($condition == '') {
						$return .= ucfirst(str_replace('_', ' ', $row));
					} else {
						$return .= $this->Common_model->get_type_name_by_id($condition, $row, $c_match);
					}
					$return .= '</option>';
				} else if ($type == 'edit') {
					$return .= '<option value="' . $row . '" ';
					if ($row == $e_match) {
						$return .= 'selected=."selected"';
					}
					$return .= '>';

					if ($condition == '') {
						$return .= ucfirst(str_replace('_', ' ', $row));
					} else {
						$return .= $this->Common_model->get_type_name_by_id($condition, $row, $c_match);
					}

					$return .= '</option>';
				}
			endforeach;
		}
		$return .= '</select>';
		return $return;
	}
	/////////GET NAME BY TABLE NAME AND ID/////////////
	function get_type_name_by_id($type, $type_id = '', $field = 'name')
	{
		if ($type_id != '') {
			$l = $this->db->get_where($type, array(
				$type . '_id' => $type_id
			));
			$n = $l->num_rows();
			if ($n > 0) {
				return $l->row()->$field;
			}
		}
	}
	function allstates($table,$col,$dir)
	{
		$this->db->select(''.$table.'.'.$table.'_id, '.$table.'.name,'.$table.'.status, country.name AS country_name', FALSE);
		$this->db->from($table);
		$this->db->join('country', 'country.country_id = '.$table.'.country_id', 'left');
		$this->db->order_by($col,$dir);
		$query = $this->db->get();

		if($query->num_rows()>0)
		{
			return $query->result_array();
		}
		else
		{
			return null;
		}
	}
	function allcities($table,$col,$dir)
	{
		$this->db->select(''.$table.'.'.$table.'_id, '.$table.'.name, state.name AS state_name, country.name AS country_name,'.$table.'.status,', FALSE);
		$this->db->from($table);
		$this->db->join('state', 'state.state_id = '.$table.'.state_id', 'left');
		$this->db->join('country', 'country.country_id = state.country_id', 'left');
		$this->db->order_by($col,$dir);
		$query = $this->db->get();

		if($query->num_rows()>0)
		{
			return $query->result_array();
		}
		else
		{
			return null;
		}
	}
	
	function get_areas(){
		$this->db->distinct();
		$this->db->select('area,zipcode,city,state,country');
		$query = $this->db->get('shippings_area')->result_array();
		
		return $query;
	}
	
	public function get_food_menu_variance($restaurant_id,$menu_id){
 
        $this->db->select('v.id, v.name ,fmv.vprice,fmv.vreduced_price');
		$this->db->from('variations as v');
		$this->db->join('foodmenu_variation as fmv','fmv.vfood_variation = v.id');
		$this->db->where('v.restaurant_id',$restaurant_id);
		$this->db->where('fmv.vfoodmenu_id',$menu_id);
		$query = $this->db->get();
		return $result = $query->result_array();
    }
	
	function get_res_cat($restaurant_id=null,$cat_id=null,$menu_name=null){
		
		$this->db->select('cat_id,cat_name');
		$this->db->from('food_category');
		$this->db->where('cat_status',1);
		$this->db->where('is_deleted',0);
		$this->db->where('restaurant_id',$restaurant_id);
		
		$menu_cat = $this->db->get()->result_array();
		
		
		$total_tax = get_gst($restaurant_id,'total_tax');
		
		$menu_array = array();
		if(!empty($menu_cat)){
			$j=0;
			foreach($menu_cat as $key=>$cat){
				
				$this->db->select('fm.restaurant_id,fm.foodmenu_id,fm.cat_id');
				$this->db->from('foodmenu as fm');
				
				if(!empty($menu_name)){
					$this->db->like('fm.menu_name', $menu_name);
				}
				$this->db->where('cat_id',$cat['cat_id']);
				
				if(!empty($restaurant_id)){
					$this->db->where('restaurant_id',$restaurant_id);
				}
				if(!empty($recommended)){
					$this->db->where('recommended',$recommended);
				}
				
				$menu = $this->db->get()->result_array();
				
				if(!empty($menu)){
					$menu_array[$j]['cat_id'] 	= $cat['cat_id'];
					$menu_array[$j]['cat_name'] 	= $cat['cat_name'];
				
					$i = 0;
					foreach($menu as $row){
						$menu_array[$j]['menu_items'][$i]['foodmenu_id']				= $row['foodmenu_id']; 
						$menu_array[$j]['menu_items'][$i]['cat_id']					= $row['cat_id']; 
					$i++;
					}
					$j++;
				}
				
			}
		}
		
		return $menu_array;
		
	}
	function get_res_cat_menus($restaurant_id=null,$cat_id=null,$menu_name=null,$limit='',$offset=''){
		$limit = !empty($limit)?$limit : 1;
		$offset = !empty($offset)?$offset : 0;
		$this->db->select('cat_id,cat_name');
		$this->db->from('food_category');
		$this->db->where('cat_status',1);
		$this->db->where('is_deleted',0);
		$this->db->where('restaurant_id',$restaurant_id);
		if(!empty($cat_id)){
			$this->db->where('cat_id',$cat_id);
		}
		//	$this->db->limit($limit,$offset);
		$menu_cat = $this->db->get()->result_array();
		//echo $this->db->last_query();
		
		$total_tax = get_gst($restaurant_id,'total_tax');
		
		$menu_array = array();
		if(!empty($menu_cat)){
			foreach($menu_cat as $key=>$cat){
				
				$this->db->select('fm.restaurant_id,fm.foodmenu_id,fm.cat_id,fm.menu_name,fm.menu_logo,fm.choice,fm.long_description,fm.price,fm.reduced_price,fm.container_charges,fm.minimum_preparation_time,fm.choice');
				$this->db->from('foodmenu as fm');
				if(!empty($menu_name)){
					$this->db->like('fm.menu_name', $menu_name);
				}
				$this->db->where('cat_id',$cat['cat_id']);
				if(!empty($restaurant_id)){
					$this->db->where('restaurant_id',$restaurant_id);
				}
				if(!empty($recommended)){
					$this->db->where('recommended',$recommended);
				}
				//$this->db->limit($limit);
				 
				$menu = $this->db->get()->result_array();
				 
				if(!empty($menu)){
					$menu_array[$key]['cat_id'] 	= $cat['cat_id'];
					$menu_array[$key]['cat_name'] 	= $cat['cat_name'];
				
					$i = 0;
					foreach($menu as $row){
					
						$food_type = '';
						if(!empty($row['choice'])){
							$choice = explode(',', $row['choice']);
							$food_type = '1'; //For veg
							if(in_array('2',$choice)){
								$food_type = '2';  //For non-veg
							}
						}
						
						$price = (!empty($row['reduced_price']) && $row['reduced_price'] != '0.00')? $row['reduced_price'] : $row['price'];
						$tax_price = $price - (($price * $total_tax['total_tax']) / 100);
						if(!empty($row['menu_logo'])){
							$menu_image = "http://pos.zamy.in/uploads/FoodMenu/".$row['menu_logo'];
						}else{
							$menu_image = "http://pos.zamy.in/uploads/FoodMenu/download18.jpeg";
						}
						
						
						$menu_array[$key]['menu_items'][$i]['foodmenu_id']				= $row['foodmenu_id']; 
						$menu_array[$key]['menu_items'][$i]['cat_id']					= $row['cat_id']; 
						$menu_array[$key]['menu_items'][$i]['menu_name']				= $row['menu_name']; 
						$menu_array[$key]['menu_items'][$i]['menu_logo']				= $menu_image; 
						$menu_array[$key]['menu_items'][$i]['long_description']			= $row['long_description']; 
						$menu_array[$key]['menu_items'][$i]['price']					= round($row['price'],0);
						$menu_array[$key]['menu_items'][$i]['reduced_price']			= round($row['reduced_price']);
						$menu_array[$key]['menu_items'][$i]['tax_price']				= $tax_price;
						$menu_array[$key]['menu_items'][$i]['container_charges']		= round($row['container_charges']);
						$menu_array[$key]['menu_items'][$i]['minimum_preparation_time']	= $row['minimum_preparation_time'];
						$menu_array[$key]['menu_items'][$i]['food_type']				= $food_type;
						
						$variance = $this->get_food_menu_variance($row['restaurant_id'],$row['foodmenu_id']);
						
						$variation_result  = array();
						if(!empty($variance)){
							
							foreach($variance as $var){
								$vprice = (!empty($var['vreduced_price']) && $var['vreduced_price'] != '0.00')? $var['vreduced_price'] : $var['vprice'];				
								$vtax_price = $vprice - (($vprice * $total_tax['total_tax']) / 100);  
								$variation_data = array();
								$variation_data['foodmenu_id'] 			= $row['foodmenu_id'];
								$variation_data['variation_id'] 		= $var['id'];
								$variation_data['variation_name'] 		= $var['name'];
								$variation_data['variation_price'] 		= $var['vprice'];
								$variation_data['variation_sale_price'] = $var['vreduced_price'] ;
								$variation_data['tax_price'] 	   		= $vtax_price;
								$variation_result[] 					= $variation_data;
							}
						}
						else{
							$variation_result  = array();
						}
						$menu_array[$key]['menu_items'][$i]['product_variation']	= $variation_result;
					
					$i++;
					}
				}
			}
		}
		
		return $menu_array;
	}

	function recommended_menu_items($restaurant_id){
		
		
		$total_tax = get_gst($restaurant_id,'total_tax');
		
		$menu_array = array();
		
		$this->db->select('fm.restaurant_id,fm.foodmenu_id,fm.cat_id,fm.menu_name,fm.menu_logo,fm.choice,fm.long_description,fm.price,fm.reduced_price,fm.container_charges,fm.minimum_preparation_time,fm.choice');
		$this->db->from('foodmenu as fm');
		$this->db->where('restaurant_id',$restaurant_id);
		$this->db->where('recommended',1);
		
		$menu = $this->db->get()->result_array();
		
		
		$i = 0;
		foreach($menu as $row){
		
			$food_type = '';
			if(!empty($row['choice'])){
				$choice = explode(',', $row['choice']);
				$food_type = '1'; //For veg
				if(in_array('2',$choice)){
					$food_type = '2';  //For non-veg
				}
			}
			
			$price = (!empty($row['reduced_price']) && $row['reduced_price'] != '0.00')? $row['reduced_price'] : $row['price'];
			$tax_price = $price - (($price * $total_tax['total_tax']) / 100);
			if(!empty($row['menu_logo'])){
				$menu_image = "http://pos.zamy.in/uploads/FoodMenu/".$row['menu_logo'];
			}else{
				$menu_image = "http://pos.zamy.in/uploads/FoodMenu/download18.jpeg";
			}
			
			
			$menu_array[$i]['foodmenu_id']				= $row['foodmenu_id']; 
			$menu_array[$i]['cat_id']					= $row['cat_id']; 
			$menu_array[$i]['menu_name']				= $row['menu_name']; 
			$menu_array[$i]['menu_logo']				= $menu_image; 
			$menu_array[$i]['long_description']			= $row['long_description']; 
			$menu_array[$i]['price']					= round($row['price'],0);
			$menu_array[$i]['reduced_price']			= round($row['reduced_price']);
			$menu_array[$i]['tax_price']				= $tax_price;
			$menu_array[$i]['container_charges']		= round($row['container_charges']);
			$menu_array[$i]['minimum_preparation_time']	= $row['minimum_preparation_time'];
			$menu_array[$i]['food_type']				= $food_type;
			
			$variance = $this->get_food_menu_variance($row['restaurant_id'],$row['foodmenu_id']);
			
			$variation_result  = array();
			if(!empty($variance)){
				
				foreach($variance as $var){
					$vprice = (!empty($var['vreduced_price']) && $var['vreduced_price'] != '0.00')? $var['vreduced_price'] : $var['vprice'];				
					$vtax_price = $vprice - (($vprice * $total_tax['total_tax']) / 100);  
					$variation_data = array();
					$variation_data['foodmenu_id'] 			= $row['foodmenu_id'];
					$variation_data['variation_id'] 		= $var['id'];
					$variation_data['variation_name'] 		= $var['name'];
					$variation_data['variation_price'] 		= $var['vprice'];
					$variation_data['variation_sale_price'] = $var['vreduced_price'] ;
					$variation_data['tax_price'] 	   		= $vtax_price;
					$variation_result[] 					= $variation_data;
				}
			}
			else{
				$variation_result  = array();
			}
			$menu_array[$i]['product_variation']	= $variation_result;
		
		$i++;
		}
		
		return $menu_array;
	}
	
	
	function search_restaurants($query_data){
		
		$this->db->select("kitchens.id as kitchen_id ,kitchens.res_name, ,kitchens.res_alias, kitchens.service_type,kitchens.logo,kitchens.images , kitchens.address, kitchens.area, kitchens.landmark, kitchens.zipcode,kitchens.approx_delivery_time, kitchens.approx_cost, kitchens.pure_veg,city.name as city,state.name as state,country.name as country");
		$this->db->from("foodmenu");
		$this->db->join("kitchens","kitchens.id = foodmenu.restaurant_id",'left');
		$this->db->join("food_category","food_category.cat_id = foodmenu.cat_id",'left');
		$this->db->join('city','city.city_id = kitchens.city');
		$this->db->join('state','state.state_id = kitchens.state');
		$this->db->join('country','country.country_id = kitchens.country');
		if(!empty($query_data['res_name'])){
			$this->db->like('foodmenu.menu_name', $query_data['res_name']);
			$this->db->or_like('kitchens.res_name', $query_data['res_name']);
			$this->db->or_like('food_category.cat_name', $query_data['res_name']);
		}
		if(!empty($query_data['area'])){
			$this->db->like('kitchens.area',$query_data['area']);
		}
		
		$this->db->where('foodmenu.menu_status',1);
		$this->db->where('foodmenu.is_deleted',0);
		$this->db->where('kitchens.status',1);
		$this->db->where('food_category.cat_status',1);
		$this->db->order_by("kitchens.res_name","ASC");
		$this->db->group_by("kitchen_id");
		if(!empty($total_row)){
			$result = $this->db->get()->num_rows();
		}
		else{
			$result = $this->db->get()->result_array();	
		} 
		 
		return $result;
	}
	function search_dishes($menu_name){
			
		$this->db->select('fm.restaurant_id,fm.foodmenu_id,fm.cat_id,fm.menu_name,fm.menu_logo,fm.choice,fm.long_description,fm.price,fm.reduced_price,fm.container_charges,fm.minimum_preparation_time,fm.choice');
		$this->db->from('foodmenu as fm');
		$this->db->join('kitchens as kt','kt.id = fm.restaurant_id');
		$this->db->like('fm.menu_name', $menu_name);
		$this->db->where('fm.menu_status',1);
		$this->db->where('fm.is_deleted',0);
		$this->db->where('kt.status',1);
		//$this->db->group_by('fm.restaurant_id');
		$menu = $this->db->get()->result_array();
		
		$menu_array = array();
		if(!empty($menu)){
			
			$i = 0;
			foreach($menu as $row){
				
				$restaurant_id = $row['restaurant_id'];
				$total_tax = get_gst($restaurant_id,'total_tax');
				
				
				$food_type = '';
				if(!empty($row['choice'])){
					$choice = explode(',', $row['choice']);
					$food_type = '1'; //For veg
					if(in_array('2',$choice)){
						$food_type = '2';  //For non-veg
					}
				}
				
				$price = (!empty($row['reduced_price']) && $row['reduced_price'] != '0.00')? $row['reduced_price'] : $row['price'];
				$tax_price = $price - (($price * $total_tax['total_tax']) / 100);
				if(!empty($row['menu_logo'])){
					$menu_image = "http://pos.zamy.in/uploads/FoodMenu/".$row['menu_logo'];
				}else{
					$menu_image = "http://pos.zamy.in/uploads/FoodMenu/download18.jpeg";
				}
				 
				$menu_array[$restaurant_id][$i]['foodmenu_id']				= $row['foodmenu_id']; 
				$menu_array[$restaurant_id][$i]['cat_id']					= $row['cat_id']; 
				$menu_array[$restaurant_id][$i]['menu_name']				= $row['menu_name']; 
				$menu_array[$restaurant_id][$i]['menu_logo']				= $menu_image; 
				$menu_array[$restaurant_id][$i]['long_description']			= $row['long_description']; 
				$menu_array[$restaurant_id][$i]['price']					= round($row['price'],0);
				$menu_array[$restaurant_id][$i]['reduced_price']			= round($row['reduced_price']);
				$menu_array[$restaurant_id][$i]['tax_price']				= $tax_price;
				$menu_array[$restaurant_id][$i]['container_charges']		= round($row['container_charges']);
				$menu_array[$restaurant_id][$i]['minimum_preparation_time']	= $row['minimum_preparation_time'];
				$menu_array[$restaurant_id][$i]['food_type']				= $food_type;
				
				$variance = $this->get_food_menu_variance($restaurant_id,$row['foodmenu_id']);
				
				$variation_result  = array();
				if(!empty($variance)){
					
					foreach($variance as $var){
						$vprice = (!empty($var['vreduced_price']) && $var['vreduced_price'] != '0.00')? $var['vreduced_price'] : $var['vprice'];				
						$vtax_price = $vprice - (($vprice * $total_tax['total_tax']) / 100);  
						$variation_data = array();
						$variation_data['foodmenu_id'] 			= $row['foodmenu_id'];
						$variation_data['variation_id'] 		= $var['id'];
						$variation_data['variation_name'] 		= $var['name'];
						$variation_data['variation_price'] 		= $var['vprice'];
						$variation_data['variation_sale_price'] = $var['vreduced_price'] ;
						$variation_data['tax_price'] 	   		= $vtax_price;
						$variation_result[] 					= $variation_data;
					}
				}
				else{
					$variation_result  = array();
				}
				$menu_array[$restaurant_id][$i]['product_variation']	= $variation_result;
			
			$i++;
			}
		}
			
		return $menu_array;
	}
	
	function restaurant_details($restaurant_id){
		$this->db->select('kitchens.id,kitchens.res_name,kitchens.res_alias,kitchens.service_type,city.name as city_name,kitchens.area,kitchens.landmark,kitchens.approx_delivery_time,kitchens.approx_cost,kitchens.pure_veg');
		$this->db->from('kitchens');
		$this->db->join('city','city.city_id = kitchens.city');
		$this->db->where('kitchens.id',$restaurant_id);
		$this->db->where('kitchens.status',1);
		$restaurant_details = $this->db->get()->row_array();
		
		return $restaurant_details;
	}
	function home_top_featured_restaurant(){
	$this->db->select('kitchens.id,kitchens.res_name,kitchens.address, foodmenu.short_code, foodmenu.order_type,foodmenu.menu_logo,foodmenu.price,foodmenu.long_description,kitchens.res_alias,kitchens.approx_delivery_time,kitchens.approx_cost,kitchens.service_type,foodmenu.menu_name,order_items.food_menu_id,count(order_items.food_menu_id) AS food_menu_id_count');
	$this->db->from('order_items');
	$this->db->join('orders', 'orders.id = order_items.order_id','left');
	$this->db->join('kitchens', 'kitchens.id = orders.restaurant_id','left');
	$this->db->join('foodmenu', 'foodmenu.foodmenu_id = order_items.food_menu_id','right');
    $this->db->group_by("order_items.food_menu_id");
    $this->db->order_by('food_menu_id_count','DESC');
    $this->db->where('kitchens.is_featured',1);
    $this->db->limit(3);
    $query = $this->db->get();
	return $result = $query->result_array();
	}
	
	function fav_food_enjoy($restaurant_id,$limit=''){
		  
		$this->db->select('foodmenu.menu_name, foodmenu.short_code, foodmenu.order_type, foodmenu.menu_logo, foodmenu.price, foodmenu.reduced_price,foodmenu.long_description,kitchens.id as restaurant_id, kitchens.res_name, kitchens.res_alias, kitchens.images as kitchen_image, kitchens.address, kitchens.country, kitchens.state, kitchens.city, kitchens.approx_cost, kitchens.pure_veg,kitchens.approx_delivery_time,kitchens.service_type');
		$this->db->from('foodmenu');
		$this->db->join('kitchens','kitchens.id = foodmenu.restaurant_id');
		//$this->db->where('kitchens.id',$restaurant_id);
		$this->db->where('kitchens.status',1);
		$this->db->order_by('foodmenu.foodmenu_id','ASC');
		$this->db->limit(!empty($limit) ? $limit : 3);
		$food_details = $this->db->get()->result_array();
		
		return $food_details;
		
	}

	/*
	 * Get Food Menu 
	 */
	public function get_food_menu($restaurant_id,$menu_id,$variation_id){
		
		$this->db->select('fm.foodmenu_id , fm.menu_name,fm.choice, fm.price, fm.reduced_price, v.id, v.name ,fmv.vprice as variance_price ,fmv.vreduced_price as reduce_variance_price');
		$this->db->from('foodmenu as fm');
		$this->db->join('foodmenu_variation as fmv','fmv.vfoodmenu_id = fm.foodmenu_id','LEFT');
		$this->db->join('variations as v','v.id = fmv.vfood_variation','LEFT');
		$this->db->where('fm.foodmenu_id',$menu_id);
		$this->db->where('fm.restaurant_id',$restaurant_id);
		
		if(!empty($variation_id))
			$this->db->where('v.id',$variation_id);
		
		$query = $this->db->get();
	
		return $result = $query->row();
		
	}
	
	function get_menu_price_name($restaurant_id,$menu_id,$variation_id=''){
	
		if(!empty($variation_id)){
			
			$this->db->select('fmv.vprice as price,fmv.vreduced_price as reduced_price');
			$this->db->join('foodmenu as fm','fm.foodmenu_id = fmv.vfoodmenu_id');
			$this->db->join('variations as v','v.id = fmv.vfood_variation');
			$this->db->where('fm.menu_status',1);
			$this->db->where('fm.is_deleted',0);
			$this->db->where('fm.restaurant_id',$restaurant_id);
			$this->db->where('fm.foodmenu_id',$menu_id);
			$this->db->where('v.id',$variation_id);
			$this->db->where('v.status',1);
			$query = $this->db->get('foodmenu_variation as fmv');
			return $result = $query->row_array();
			
		}else{
			$this->db->select('price,reduced_price');
			$this->db->where('foodmenu_id',$menu_id);
			$this->db->where('menu_status',1);
			$this->db->where('is_deleted',0);
			$query = $this->db->get('foodmenu');
			return $result = $query->row_array();
		
		}
		return $price;
	}
	
	function get_coupons($restaurant_id=null,$user_id=null){
		
		$this->db->where('status',1);
		//$this->db->where('NOW() BETWEEN start_date AND end_date');
		$query = $this->db->get('site_coupons');
		$result = $query->result_array();
		$count = 0; 
		
		if(!empty($user_id)){
			/* Start get referral info */
			$this->db->select('my_referral_code,earn_point');
			$this->db->where('user_id',$user_id); 
			$query = $this->db->get('referrals_data');
			$referral_result = $query->row_array();

			//$points = $referral_result['earn_point'];
			 
			if(!empty($referral_result['my_referral_code'])){
				$count = $referral_result['earn_point'] / 100; 
			}
		}
		/* END get referral info */
		
	/*	if($referral_result['earn_point'] <= 100){

		}*/
		//if($data['coupon_code'] == 'REFERRAL100')
		 
		if(!empty($result)){
			
			$i=0;
			foreach($result as $data){
			  
				$restaurant = $data['restaurant'];
				if(!empty($restaurant) && $restaurant_id!=''){
					$restaurant_limit 				= explode(',',$restaurant);
					
					if(in_array($restaurant_id,$restaurant_limit) ){ 
						
						$coupon_data[$i]['id'] 			= $data['id'];
						$coupon_data[$i]['title'] 		= $data['title'];
						$coupon_data[$i]['coupon_code'] = $data['coupon_code'];
						$coupon_data[$i]['description'] = $data['description'];
						$coupon_data[$i]['min_spend'] = $data['min_spend'];
						$coupon_data[$i]['max_spend'] = $data['max_spend']; 
						$coupon_data[$i]['usage_limit_per_coupon'] = $data['usage_limit_per_coupon'];
						$coupon_data[$i]['usage_limit_per_user'] = $data['usage_limit_per_user'];
						$coupon_data[$i]['discount'] = $data['discount'];
						$coupon_data[$i]['start_date'] = $data['start_date'];
						$coupon_data[$i]['end_date'] = $data['end_date']; 
						$coupon_data[$i]['dis_type'] = $data['dis_type'];
						$i++;
					} 
				}else{
						if($data['coupon_code'] == 'REFERRAL100' && $count < 1){
							continue;
						} 
						$coupon_data[$i]['id'] 			= $data['id'];
						$coupon_data[$i]['title'] 		= $data['title'];
						$coupon_data[$i]['coupon_code'] = $data['coupon_code'];
						$coupon_data[$i]['description'] = $data['description'];
						$coupon_data[$i]['min_spend'] = $data['min_spend'];
						$coupon_data[$i]['max_spend'] = $data['max_spend']; 
						$coupon_data[$i]['usage_limit_per_coupon'] = $data['usage_limit_per_coupon'];
						$coupon_data[$i]['usage_limit_per_user'] = $data['usage_limit_per_user'];
						$coupon_data[$i]['discount'] = $data['discount'];
						$coupon_data[$i]['start_date'] = $data['start_date'];
						$coupon_data[$i]['end_date'] = $data['end_date']; 
						$coupon_data[$i]['dis_type'] = $data['dis_type'];
					 
					$i++;
				}
			}
		} 
		return $coupon_data;
	}
	
	function check_coupon_exist($coupon_code){
		
		$this->db->where('coupon_code',$coupon_code);
		$this->db->where('status',1);
		//$this->db->where('NOW() BETWEEN start_date AND end_date');
		$query = $this->db->get('site_coupons');
		return $result = $query->row_array();
	}
	
	function check_service_area($zipcode){
		$this->db->select('area,zipcode');
		$this->db->where('zipcode',$zipcode);
		$query = $this->db->get('shippings_area');
		return $result = $query->row_array();
	}
	function get_deliveryboy_by_orderid($order_id){
		  
		$this->db->select('orders.id,assign_delivery_boy.delivery_boy_id'); 
		$this->db->from('orders');
		$this->db->join('assign_delivery_boy','assign_delivery_boy.order_id = orders.id' );
		$this->db->where('orders.id',$order_id);
		$result = $this->db->get()->row_array();	
		return $result;
   }

   function get_comment_data($where){
		  
		$this->db->select('review.created_date,review.name,review.message,online_customer.profile'); 
		$this->db->from('review');
		$this->db->join('online_customer','online_customer.id = review.user_id');
		$this->db->where($where);
		$result = $this->db->get()->result_array();	
		return $result;
   }

   public function count_rows_where($table,$field,$where){
		$this->db->select($field);
		$this->db->where($where);
		$query = $this->db->get($table);
		$result = $query->num_rows();
		return $result;
	}
     
   
}

?>