<?php
namespace Home\Model;
//use Think\Model;
use Home\Controller\PublicController;
class StatModel/* extends Model*/ {
	/*
	 * url: /stat
	参数: 无
	说明: unit总数没有加, 因为以后unit数目可能是动态生成的; 在线人数也没有加, 以后再做
	结果示例: {"code": 0, "result": {"num_requesters": 20, "num_available_tasks": 0, "num_all_tasks": 0, "num_workers": 8}}
	 */
	public function stat()
	{
		$public = new PublicController();
		//$result = $public->http_get(C('API_URL').'/stat/', $param);
		$result = $public->send_request(C('API_URL').'/stat/', ''); // get请求用send_request
		$result = json_decode($result, true);
		$result = array_reverse($result);
		return $result;
	}
	
	/*
	 * url: /stat/task
	参数: task_id, token
	说明: 返回一个任务有多少worker做过，有多少unit已经完成.
	结果示例:
	{
	    "code": 0,
	    "result": {
	        "n_finished_units": 0,
	        "n_workers": 5
	    }
	}
	 */
	public function task($task_id, $token)
	{
		$public = new PublicController();
		$param['task_id'] = $task_id;
		$param['token'] = $token;
		$param['debug'] = 1;
		$param['format'] = 'json';
		//$result = $public->http_get(C('API_URL').'/stat/', $param);
		$result = $public->send_request(C('API_URL').'/stat/task/', $param); // get请求用send_request
		$result = json_decode($result, true);
		$result = array_reverse($result);
		return $result;
	}
}