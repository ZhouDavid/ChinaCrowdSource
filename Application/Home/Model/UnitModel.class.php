<?php
namespace Home\Model;
//use Think\Model;
use Home\Controller\PublicController;
class UnitModel/* extends Model*/ {
	public function read($id='', $golden='', $answered='', $assigned='', $task='', $ordering='', $page_size='', $page='', $token='')
	{
		$param['format'] = "json";
		$param['debug'] = 1;
		if($id != '') {
			$param['id'] = $id;
		}
		if($golden != '') {
			$param['golden'] = $golden;
		}
		if($answered != '') {
			$param['answered'] = $answered;
		}
		if($assigned != '') {
			$param['assigned'] = $assigned;
		}
		if($task != '') {
			$param['task'] = $task;
		}
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
		//$result = $public->http_get(C('API_URL').'/unit/', $param);
		$result = $public->send_request(C('API_URL').'/unit/', $param); // get请求用send_request
		$result = json_decode($result, true);
		$result = array_reverse($result);
		return $result;
	}
	
	public function unit($task_id='', $worker_id='', $num_units=2, $qualification_test='', $token='') {
		$param['debug'] = 1;
		if($task_id != '') {
			$param['task_id'] = $task_id;
		}
		if($worker_id != '') {
			$param['worker_id'] = $worker_id;
		}
		if($num_units != '') {
			$param['num_units'] = $num_units;
		}
		if($qualification_test != '') {
			$param['qualification_test'] = $qualification_test;
		}
		if($token != '') {
			$param['token'] = $token;
		}
		$public = new PublicController();
		//$result = $public->http_get(C('API_URL').'/unit/', $param);
		//$result = $public->send_request(C('API_URL').'/workflow/unit/', $param); // get请求用send_request
		$result = $public->http_post(C('API_URL').'/workflow/unit/?token='.$token, $param);
		$result = json_decode($result, true);
		$result = array_reverse($result);
		return $result;
	}
}