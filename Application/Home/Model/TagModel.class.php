<?php
namespace Home\Model;
//use Think\Model;
use Home\Controller\PublicController;
class TagModel/* extends Model*/ {
	public function read($token)
	{
		$param['format'] = "json";
		$param['debug'] = 1;
		$param['token'] = $token;
		$public = new PublicController();
		$result = $public->send_request(C('API_URL').'/tag/', $param); // get请求用send_request
		$result = json_decode($result, true);
		return $result;
	}
}