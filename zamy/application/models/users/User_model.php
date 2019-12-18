<?php
class User_model extends CI_Model{

	public function login($data){
		
		$this->db->where('email', $data['username']);
		$this->db->where('status', $data['status']);  
		$this->db->or_where('phone', $data['username']);

		$query=$this->db->get('online_customer');
		
		if ($query->num_rows() == 0){
			return false;
		}
		else{
			//Compare the password attempt with the password we have stored.
			$result = $query->row_array();
			$validPassword = password_verify($data['password'], $result['password']);
			
			
			if($validPassword){
				return $result = $query->row_array();
			}
			
		}
	}
	/* forgot password */
	public function ForgotPassword($email){
			$this->db->select('email'); 
			$this->db->where('email', $email); 
			$query=$this->db->get('online_customer');
			return $query->row_array();
	}

	public function sendpassword($data){
		$email = $data['email'];
		$newpass = $data['password'];
		$query1=$this->db->query("SELECT *  from online_customer where email = '".$email."' ");
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
	/* end forgot password */
	
	public function get_user_by_id($id){
		$query = $this->db->get_where('api_users', array('id' => $id));
		return $result = $query->row_array();
	}
	public function edit_user($data, $id){
		$this->db->where('id', $id);
		$this->db->update('online_customer', $data);
		return true;
	}
	
	public function change_pwd($data, $id){
		$this->db->where('id', $id);
		$this->db->update('online_customer', $data);
		return true;
	}
	
	/**
	 * This function is used to match users password for change password
	 * @param number $user_id : This is user id
	 */
	function matchOldPassword($user_id, $oldPassword)
	{
		$this->db->select('id, password');
		$this->db->where('id', $user_id);        
		$this->db->where('status', 'active');
		$query = $this->db->get('online_customer');
		
		$user = $query->row_array();
		$validPassword = password_verify($oldPassword, $user['password']);

		if(!empty($user)){
			if(password_verify($oldPassword, $user['password'])==1){
				return $user;
			} else {
				return array();
			}
		} else {
			return array();
		}
	}

	}

?>