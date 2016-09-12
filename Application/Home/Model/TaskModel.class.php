<?php
namespace Home\Model;
//use Think\Model;
use Home\Controller\PublicController;
use Home\Model\TagModel;
class TaskModel/* extends Model*/ {
	public function create($description, $judgements, $requester, $token)
	{
		$param['description'] = $description;
		$param['judgements'] = $judgements;
		$param['requester'] = $requester;
		$param['token'] = $token;
		$public = new PublicController();
		$result = $public->http_post(C('API_URL').'/task/', $param);
		$result = json_decode($result, true);
		$result = array_reverse($result);
		return $result;
	}
	
	public function read($id='', $published='', $finished='', $ended='', $requester='', $ordering='', $page_size='', $page='', $token='', $tags = '', $content = '')
	{
		//$hash = array("Computer Hardware"=>"电脑硬件","Computer Software"=>"电脑软件","Programming"=>"电脑编程","Cellphone and Tablet PC"=>"手机平板","Electronic Products"=>"电子产品","Costume and Accessories"=>"服装首饰","Cosmetology and Fitness"=>"美容塑身","Gourmet Cooking"=>"美食烹饪","Household Appliances"=>"家居家电","Travel and Holiday"=>"旅游度假","Cars"=>"购车养车","Home life and Raising children"=>"家庭育儿","Healthcare"=>"医疗健康","Sports"=>"体育运动","Commerce and Financing"=>"商业理财","Education and Science"=>"教育科学","Society and Livelihood"=>"社会民生","Culture and Art"=>"文化艺术","Games"=>"益智游戏","Recreation and Entertainment"=>"休闲娱乐","National Geographic"=>"国家地理");			


		$param['format'] = 'json';
		$param['debug'] = 1;
		if($id != '') {
			$param['id'] = $id;
		}
		if($published != '') {
			$param['published'] = $published;
		}
		if($finished != '') {
			$param['finished'] = $finished;
		}
		if($ended != '') {
			$param['ended'] = $ended;
		}
		if($requester != '') {
			$param['requester'] = $requester;
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
		if($content != '') { 
			$param['search'] = $content;
		}
		if($tags != '') {
			$tagss = explode(',', $tags);
			$tags = '?tags='.$tagss[0];
			for($i=1;$i<count($tagss);$i++) {
				$tags = $tags.'&tags='.$tagss[$i];
			}
			$tags = $tags.'&';
		}
		//print_r($tags);
		//print_r($param);
		$public = new PublicController();
		//$result = $public->http_get(C('API_URL').'/task/', $param);
		if($tags != '') {
			$result = $public->send_request(C('API_URL').'/task/'.$tags, $param); // get请求用send_request
		}
		else {
			$result = $public->send_request(C('API_URL').'/task/', $param); // get请求用send_request
		}
		$result = json_decode($result, true);
		$result = array_reverse($result);
		$tagModel = new TagModel();
		$tags = $tagModel->read($token);
		for($i=0;$i<count($result['results']);$i++) {
			$result['results'][$i]['timestamp'] = str_replace('T', ' ', $result['results'][$i]['timestamp']);
			$result['results'][$i]['timestamp'] = substr($result['results'][$i]['timestamp'], 0, strlen($result['results'][$i]['timestamp'])-1);
			for($j=0;$j<count($result['results'][$i]['tags']);$j++) {
				$result['results'][$i]['tags'][$j] = $tags[$result['results'][$i]['tags'][$j]-1]['description']; // 注意顺序，不要反了
			}
		}
		return $result;
	}
	
	public function available_task($id='', $published='', $finished='', $ended='', $requester='', $ordering='', $page_size='', $page='', $token='', $tags = '', $content = '')
	{
		//$hash = array("Computer Hardware"=>"电脑硬件","Computer Software"=>"电脑软件","Programming"=>"电脑编程","Cellphone and Tablet PC"=>"手机平板","Electronic Products"=>"电子产品","Costume and Accessories"=>"服装首饰","Cosmetology and Fitness"=>"美容塑身","Gourmet Cooking"=>"美食烹饪","Household Appliances"=>"家居家电","Travel and Holiday"=>"旅游度假","Cars"=>"购车养车","Home life and Raising children"=>"家庭育儿","Healthcare"=>"医疗健康","Sports"=>"体育运动","Commerce and Financing"=>"商业理财","Education and Science"=>"教育科学","Society and Livelihood"=>"社会民生","Culture and Art"=>"文化艺术","Games"=>"益智游戏","Recreation and Entertainment"=>"休闲娱乐","National Geographic"=>"国家地理");
	
	
		$param['format'] = 'json';
		$param['debug'] = 1;
		if($id != '') {
			$param['id'] = $id;
		}
		if($published != '') {
			$param['published'] = $published;
		}
		if($finished != '') {
			$param['finished'] = $finished;
		}
		if($ended != '') {
			$param['ended'] = $ended;
		}
		if($requester != '') {
			$param['requester'] = $requester;
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
		if($content != '') {
			$param['search'] = $content;
		}
		if($tags != '') {
			$tagss = explode(',', $tags);
			$tags = '?tags='.$tagss[0];
			for($i=1;$i<count($tagss);$i++) {
				$tags = $tags.'&tags='.$tagss[$i];
			}
			$tags = $tags.'&';
		}
		//print_r($tags);
		//print_r($param);
		$public = new PublicController();
		//$result = $public->http_get(C('API_URL').'/task/', $param);
		//if($tags != '') {
		//	$result = $public->http_post(C('API_URL').'/available_task/'.$tags, $param); // get请求用send_request
		//}
		//else {
			$result = $public->http_post(C('API_URL').'/available_task/?token='.$token, $param); // get请求用send_request
		//}
		$result = json_decode($result, true);
		$result = array_reverse($result);
		$tagModel = new TagModel();
		$tags = $tagModel->read($token);
		//print_r($result);
		for($i=0;$i<count($result['result']['tasks']);$i++) {
			$result['results'][$i] = $result['result']['tasks'][$i];
			$result['results'][$i]['timestamp'] = str_replace('T', ' ', $result['results'][$i]['timestamp']);
			$result['results'][$i]['timestamp'] = substr($result['results'][$i]['timestamp'], 0, strlen($result['results'][$i]['timestamp'])-1);
			for($j=0;$j<count($result['results'][$i]['tags']);$j++) {
				$result['results'][$i]['tags'][$j] = $tags[$result['results'][$i]['tags'][$j]-1]['description']; // 注意顺序，不要反了
			}
		}
		$result['count'] = $result['result']['num_tasks'];
		if($page > 1) {
			$result['previous'] = $page-1;
		}
		if($page < $result['result']['num_pages']) {
			$result['next'] = $page+1;
		}
		//print_r($result);
		return $result;
	}
	
	public function update($description='', $judgements='', $requester='', $token='')
	{
		if($description != '') {
			$param['description'] = $description;
		}
		if($judgements != '') {
			$param['judgements'] = $judgements;
		}
		if($requester != '') {
			$param['requester'] = $requester;
		}
		if($token != '') {
			$param['token'] = $token;
		}
		$public = new PublicController();
		$result = $public->http_patch(C('API_URL').'/task/', $param);
		$result = json_decode($result, true);
		$result = array_reverse($result);
		return $result;
	}
	
	public function delete($id, $token)
	{
		$param['id'] = $id;
		$param['token'] = $token;
		$public = new PublicController();
		$result = $public->http_delete(C('API_URL').'/task/', $param);
		$result = json_decode($result, true);
		$result = array_reverse($result);
		return $result;
	}

	public function create_task($requester_id, $token)
	{
		$param['requester_id'] = $requester_id;
		//$param['option'] = $option;
		//$param['token'] = $token;
		//$param['template_type'] = $template_id;
		$param['debug'] = 1;
		$public = new PublicController();
		$result = $public->http_post(C('API_URL').'/workflow/create?token='.$token, $param);
		$result = json_decode($result, true);
		$result = array_reverse($result);
		return $result;
	}

	public function update_template_type($task_id, $template_id, $token)
	{
		//$param['id'] = $task_id;
		$param['template_type'] = $template_id;
		$public = new PublicController();
		$result = $public->http_patch(C('API_URL').'/task/'.$task_id.'/?token='.$token, $param);
		$result = json_decode($result, true);
		//$result = array_reverse($result);
		return $result;
	}

	public function upload_option($task_id, $option, $token)
	{
		$param['task_id'] = $task_id;
		$param['option'] = $option;
		//$param['token'] = $token;
		$param['debug'] = 1;
		$public = new PublicController();
		$result = $public->http_post(C('API_URL').'/workflow/upload-option/?token='.$token, $param);
		$result = json_decode($result, true);
		$result = array_reverse($result);
		return $result;
	}

	public function update_task($task_id, $judgements_per_unit, $units_per_page, $price, $testmode, $developer, $isgeo, $developer_site, $token)
	{
		//$param['id'] = $task_id;
		$param['judgements_per_unit'] = $judgements_per_unit;
		$param['units_per_page'] = $units_per_page;
		$param['price'] = $price;
		//$param['units_for_qualification_test'] = $units_for_qualification_test;
		//$param['min_accuracy'] = $min_accuracy;
		if ($developer==1) {
			$param['developer'] = $developer;
			$param['developer_site'] = $developer_site;
		}
		if ($testmode==1) {
			$param['vote_correct_answer'] = $testmode;
		}
		if ($isgeo==1) {
			$param['is_geo'] = $isgeo;
		}
		$param['token'] = $token;
		$public = new PublicController();
		$result = $public->http_patch(C('API_URL').'/task/'.$task_id.'/?token='.$token, $param);
		$result = json_decode($result, true);
		//$result = array_reverse($result);
		return $result;
	}

	public function update_task_qualification($task_id, $units_for_qualification_test, $min_accuracy, $golden_units_in_first_pages, $min_accuracy_hidden, $token)
	{
		//$param['id'] = $task_id;
		//$param['judgements_per_unit'] = $judgements_per_unit;
		//$param['units_per_page'] = $units_per_page;
		$param['units_for_qualification_test'] = $units_for_qualification_test;
		$param['min_accuracy'] = $min_accuracy;
		$param['golden_units_in_first_pages'] = $golden_units_in_first_pages;
		$param['min_accuracy_hidden'] = $min_accuracy_hidden;
		//$param['debug'] = 1;
		//$param['token'] = $token;
		$public = new PublicController();
		$result = $public->http_patch(C('API_URL').'/task/'.$task_id.'/?token='.$token, $param);
		$result = json_decode($result, true);
		//$result = array_reverse($result);
		return $result;
	}

	public function update_task_title_des($task_id, $title, $description, $token)
	{
		$param['title'] = $title;
		$param['description'] = $description;
		//$param['tags'] = $tags;
		//$param[traditional] = true;
		//$param['units_for_qualification_test'] = $units_for_qualification_test;
		//$param['min_accuracy'] = $min_accuracy;
		//$param['token'] = $token;
		$public = new PublicController();
		$result = $public->http_patch(C('API_URL').'/task/'.$task_id.'/?token='.$token, $param);
		$result = json_decode($result, true);
		//$result = array_reverse($result);
		return $result;
	}

	public function get_option($task_id, $token)
	{
		$param['task_id'] = $task_id;
		//$param['token'] = $token;
		$param['debug'] = 1;
		$public = new PublicController();
		$result = $public->http_post(C('API_URL').'/workflow/get-option?token='.$token, $param);
		$result = json_decode($result, true);
		$result = array_reverse($result);
		return $result;
	}

	/*
	 * 类型: AND
	 url: /task
	 参数: search
	 示例: /task/?search=later,out
	 说明: GET请求, 关键字用逗号','隔开, 返回在description中同时含有later和out关键字的task列表, 属于AND类型的search
	 */	
	public function search($content, $published='', $finished='', $requster='', $ordering='', $page_size='', $page='', $token) {
		$param['debug'] = 1;
		$param['search'] = $content;
		if($published != '') {
			$param['published'] = $published;
		}
		if($finished != '') {
			$param['finished'] = $finished;
		}
		if($requester != '') {
			$param['requester'] = $requester;
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
		//$result = $public->http_get(C('API_URL').'/task/', $param);
		$result = $public->send_request(C('API_URL').'/task/', $param); // get请求用send_request
		$result = json_decode($result, true);
		$result = array_reverse($result);
		for($i=0;$i<count($result['results']);$i++) {
			$result['results'][$i]['timestamp'] = str_replace('T', ' ', $result['results'][$i]['timestamp']);
			$result['results'][$i]['timestamp'] = substr($result['results'][$i]['timestamp'], 0, strlen($result['results'][$i]['timestamp'])-1);
		}
		return $result;
	}
	
	/*
	 * 类型: OR
	url: /task_search
	参数: keywords
	示例: /task_search/?keywords=later,out
	说明: GET请求, 关键字用逗号','隔开, 返回在description中包含有later和out关键字之一的task列表, 属于OR类型的search
	 */
	public function task_search($content, $published='', $finished='', $requster='', $ordering='', $page_size='', $page='', $token) {
		$param['debug'] = 1;
		$param['keywords'] = $content;
		if($published != '') {
			$param['published'] = $published;
		}
		if($finished != '') {
			$param['finished'] = $finished;
		}
		if($requester != '') {
			$param['requester'] = $requester;
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
		//$result = $public->http_get(C('API_URL').'/task/', $param);
		$result = $public->send_request(C('API_URL').'/task_search/', $param); // get请求用send_request
		$result = json_decode($result, true);
		$result = array_reverse($result);
		$result['results'] = $result['result']; // 和上一个函数有些不同，返回的是result，而并不是results
		for($i=0;$i<count($result['results']);$i++) {
			$result['results'][$i]['timestamp'] = str_replace('T', ' ', $result['results'][$i]['timestamp']);
			$result['results'][$i]['timestamp'] = substr($result['results'][$i]['timestamp'], 0, strlen($result['results'][$i]['timestamp'])-1);
		}
		return $result;
	}

	public function publish($task_id, $token)
	{
		$param['task_id'] = $task_id;
		//$param['token'] = $token;
		$param['debug'] = 1;
		$public = new PublicController();
		$result = $public->http_post(C('API_URL').'/workflow/publish?token='.$token, $param);
		$result = json_decode($result, true);
		$result = array_reverse($result);
		return $result;
	}
}