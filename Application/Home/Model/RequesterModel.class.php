<?php
namespace Home\Model;
//use Think\Model;
use Home\Controller\PublicController;
class RequesterModel/* extends Model*/ {

	public function read($requester_id, $token)
	{
		//$param['id'] = $requester_id;
		$param['debug'] = 1;
		$public = new PublicController();
		//$result = $public->http_get(C('API_URL').'/worker/', $param);
		if($requester_id != '') {
			$result = $public->http_get(C('API_URL').'/requester/'.$requester_id.'/?token='.$token, $param); // get请求用send_request
		}
		$result = json_decode($result, true);
		$result = array_reverse($result);
		return $result;
	}
}