<?php

namespace Home\Model;
//use Think\Model;
use Home\Controller\PublicController;
class TemplateModel/* extends Model*/ {
	public function templates($token)
	{
		//$param['token'] = $token;
		$param['debug'] = 1;
		
		$public = new PublicController();
		$result = $public->http_post(C('API_URL').'/workflow/template?token='.$token, $param);
		$result = json_decode($result, true);
		$result = array_reverse($result);
		return $result;
	}
	
	public function template_json($token)
	{
		$param['token'] = $token;
		$param['debug'] = 1;
	
		$public = new PublicController();
		$result = $public->send_request(C('API_URL').'/workflow/template/', $param);
		//$result = json_decode($result, true);
		//$result = array_reverse($result);
		return $result;
	}

	public function template($token)
	{
		//$param['token'] = $token;
		$param['debug'] = 1;
		$param['num_units'] = 3;

		$public = new PublicController();
		$result = $public->http_post(C('API_URL').'/workflow/unit?token='.$token, $param);
		$result = json_decode($result, true);
		$result = array_reverse($result);
		return $result;
	}

	/*public function data($task_id, $data)
	{
		$param['task_id'] = $task_id;
		$param['data'] = $data;
		$param['debug'] = 1;

		$public = new PublicController();
		$result = $public->http_post(C('API_URL').'/workflow/upload/', $param);
		$result = json_decode($result, true);
		$result = array_reverse($result);
		return $result;

	}*/

	public function truedata($task_id, $token)
	{
		//$param['token'] = $token;
		$param['task_id'] = $task_id;
		$param['num_units'] = 3;
		$param['debug'] = 1;

		$public = new PublicController();
		$result = $public->http_post(C('API_URL').'/workflow/unit?token='.$token, $param);
		$result = json_decode($result, true);
		$result = array_reverse($result);
		return $result;
	}

	public function truedataall($task_id, $token, $totalnum)
	{
		//$param['token'] = $token;
		$param['task_id'] = $task_id;
		$param['num_units'] = $totalnum;
		$param['debug'] = 1;

		$public = new PublicController();
		$result = $public->http_post(C('API_URL').'/workflow/unit?token='.$token, $param);
		$result = json_decode($result, true);
		$result = array_reverse($result);
		return $result;
	}
}