<?php
namespace Home\Model;
//use Think\Model;
use Home\Controller\PublicController;
class QuestionModel/* extends Model*/ {
	public function read($id='', $unit='', $ordering='', $page_size='', $page='')
	{
		$param['format'] = "json";
		$param['debug'] = 1;
		if($id != '') {
			$param['id'] = $id;
		}
		if($unit != '') {
			$param['unit'] = $unit;
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
		$public = new PublicController();
		//$result = $public->http_get(C('API_URL').'/question/', $param);
		$result = $public->send_request(C('API_URL').'/question/', $param); // get请求用send_request
		$result = json_decode($result, true);
		$result = array_reverse($result);
		return $result;
	}
}