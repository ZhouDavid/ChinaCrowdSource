<?php
namespace Home\Model;
//use Think\Model;
use Home\Controller\PublicController;
class WorkflowModel/* extends Model*/ {
	public function submit($param)
	{
		$public = new PublicController();
		$result = $public->http_post(C('API_URL').'/workflow/submit/', $param);
		$result = json_decode($result, true);
		$result = array_reverse($result);
		return $result;
	}
}