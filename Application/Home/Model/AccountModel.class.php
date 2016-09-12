<?php

namespace Home\Model;
//use Think\Model;
use Home\Controller\PublicController;
class AccountModel/* extends Model*/ {
	public function register($username, $password, $email, $type)
	{
		$param['username'] = $username;
		$param['password'] = $password;
		$param['ip'] = get_client_ip();
		$param['email'] = $email;
		$param['type'] = $type;
		
		$public = new PublicController();
		$result = $public->http_post(C('API_URL').'/account/register/', $param);
		$result = json_decode($result, true);
		$result = array_reverse($result);
		return $result;
	}
	
	public function login($username, $password, $type)
	{
		$param['username'] = $username;
		$param['password'] = $password;
		$param['ip'] = get_client_ip();
		$param['type'] = $type;
		$public = new PublicController();
		$result = $public->http_post(C('API_URL').'/account/login/', $param);
		$result = json_decode($result, true);
		$result = array_reverse($result);
		return $result;
	}
	
	public function changepassword($id, $old_password, $new_password, $type)
	{
		$param['id'] = $id;
		$param['old_password'] = $old_password;
		$param['new_password'] = $new_password;
		$param['type'] = $type;
		$public = new PublicController();
		$result = $public->http_post(C('API_URL').'/account/change-password/', $param);
		$result = json_decode($result, true);
		$result = array_reverse($result);
		return $result;
	}
}