<?php
namespace Home\Model;
//use Think\Model;
use Home\Controller\PublicController;
class WorkerModel/* extends Model*/ {
	
	public function read($id='', $ordering='', $page_size='', $page='', $token='')
	{
		$param['format'] = 'json';
		$param['debug'] = 1;
		if($ordering != '') {
			$param['ordering'] = $ordering;
		}
		if($page_size != '') {
			$param['page_size'] = $page_size;
		}
		if($page != '') {
			$param['page'] = $page;
		}
		if($token != '') {
			$param['token'] = $token;
		}
		$public = new PublicController();
		//$result = $public->http_get(C('API_URL').'/worker/', $param);
		if($id != '') {
			$result = $public->send_request(C('API_URL').'/worker/'.$id.'/', $param); // get请求用send_request
		}
		else {
			$result = $public->send_request(C('API_URL').'/worker/', $param); // get请求用send_request
		}
		$result = json_decode($result, true);
		$result = array_reverse($result);
		return $result;
	}
	
	public function update($id='', $email='', $gender='', $birthday='', $location='', $university='', $degree='', $profession='', $phone='')
	{
		if($email != '') {
			$param['email'] = $email;
		}
		if($gender != '') {
			$param['gender'] = $gender;
		}
		if($birthday != '') {
			$param['birthday'] = $birthday;
		}
		if($location != '') {
			$param['location'] = $location;
		}
		if($university != '') {
			$param['university'] = $university;
		}
		if($degree != '') {
			$param['degree'] = $degree;
		}
		if($profession != '') {
			$param['profession'] = $profession;
		}
		if($phone != '') {
			$param['phone'] = $phone;
		}
		$public = new PublicController();
		$result = $public->http_patch(C('API_URL').'/worker/'.$id.'/', $param);
		$result = json_decode($result, true);
		$result = array_reverse($result);
		return $result;
	}
	
	public function delete($id)
	{
		$param['id'] = $id;
		$public = new PublicController();
		$result = $public->http_delete(C('API_URL').'/worker/'.$id.'/', $param);
		$result = json_decode($result, true);
		$result = array_reverse($result);
		return $result;
	}

}