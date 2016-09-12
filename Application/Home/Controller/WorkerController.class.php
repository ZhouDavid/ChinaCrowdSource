<?php
namespace Home\Controller;
use Think\Controller;
use Home\Model\TaskModel;
use Home\Model\UnitModel;
use Home\Model\QuestionModel;
use Home\Model\AnswerModel;
use Home\Model\GoldenAnswerModel;
use Home\Model\TemplateModel;
use Home\Model\WorkflowModel;
use Home\Model\WorkerModel;
class WorkerController extends Controller {
    public function index(){    	
    	if(isset($_SESSION['worker_id']) && $_SESSION['worker_id'] != '' &&
            isset($_SESSION['worker_token']) && $_SESSION['worker_token'] != '' && $_SESSION['expire_time'] > time()) {
            $ordering = I('ordering');
    		if($ordering == '') {
    			$ordering = '-id'; // 默认id从大到小排序
    		}
    		if(isset($_GET['page'])) {
    			$page = I('page');
    		}
    		else {
    			$page=1;
    		}
    		$token = $_SESSION['worker_token'];
    		$tags = I('tags');
    		if($tags == '') {
    			$workerModel = new WorkerModel();
    			$worker = $workerModel->read($_SESSION['worker_id'], '', '', '', $token);
    			$tagss = $worker['tags'];
    			$tags = implode(',', $tagss);
    			//print_r($tags);
    		}
    		//print_r($tags);
    		$content = I('search');
    		$content = str_replace(" ", ",", $content);
	    	$taskModel = new TaskModel();
	    	//$my_task_list = $taskModel->read('', 'True', 'False', 'False', '', $ordering, 10, $page, $token, $tags, $content);
	    	$my_task_list = $taskModel->available_task('', 'True', 'False', 'False', '', $ordering, 10, $page, $token, $tags, $content);
	    	$sort = '';
	    	$reverse_sort = '-';
	    	$ordering_field = $ordering;
	    	if($ordering[0] == '-') {
	    		$sort = '-';
	    		$reverse_sort = '';
	    		$ordering_field = substr($ordering_field, 1, strlen($ordering_field));
	    	}
	    	//print_r($my_task_list);
	    	/*for($i=0;$i<count($my_task_list['results']);$i++) {
	    		$tags = $my_task_list['results'][$i]['tags'];
	    		//print_r($tags);
	    		for($j=0;$j<count($tags);$j++) {
	    			$my_task_list['results'][$i]['tags'][$j] = L($my_task_list['results'][$i]['tags'][$j]);
	    		}
	    	}*/
	    	$this->assign('my_task_list', $my_task_list);
	    	$this->assign('current_page', $page);
	    	$this->assign('current_ordering', $ordering);
	    	$this->assign('current_ordering_field', $ordering_field);
	    	$this->assign('current_sort', $sort);
	    	$this->assign('current_tags', $tags);
	    	$this->assign('current_search', $content);
	    	$this->assign('current_reverse_sort', $reverse_sort);
	    	/*$_SESSION['my_task_list'] = $my_task_list;
	    	$_SESSION['current_page'] = $page;
	    	$_SESSION['current_ordering'] = $ordering;
	    	$_SESSION['current_ordering_field'] = $ordering_field;
	    	$_SESSION['current_sort'] = $sort;
	    	$_SESSION['current_tags'] = $tags;
	    	$_SESSION['current_search'] = $content;
	    	$_SESSION['current_reverse_sort'] = $reverse_sort;*/
	    	//print_r($my_task_list);
	    	
	    	$this->display();
    	}
    	else {
    		if(!isset($_GET['vtoken']) || $_GET['vtoken'] == '') {
    			$this->display('Index/signin');
    			//$this->redirect(C('WEB_URL'));
    		}
    		else {
    			$this->display();
    		}
    	}
    }
    
    // 旧的方法，可以舍弃了
/*    public function DoJob() {
    	if(isset($_SESSION['worker_id']) && $_SESSION['worker_id'] != '') {
    		$task_id = I('task_id');
    		$page = I('page');
    		$unitModel = new UnitModel();
    		$my_unit_list = $unitModel->read('', '', '', 0, $task_id, '', 5, $page);
    		if($my_unit_list['count'] > 0) {
    			for($i=0;$i<count($my_unit_list['results']);$i++) {
    				$questionModel = new QuestionModel();
    				$my_question_list = $questionModel->read('', $my_unit_list['results'][$i]['id']);
    				$my_unit_list['results'][$i]['questions'] = $my_question_list;
    			}
    		}
    		$this->assign('my_unit_list', $my_unit_list);
    		$this->assign('task_id', $task_id);
    		$this->display('dojob');
    	}
    	else {
    		$this->redirect(C('WEB_URL'));
    	}
    }
*/    
    
    public function DoJob($task_id) {
    	if(isset($_SESSION['worker_id']) && $_SESSION['worker_id'] != '' && $_SESSION['expire_time'] > time()) {
    		$token = $_SESSION['worker_token'];
    		if(isset($_SESSION['previous_task_id']) && $_SESSION['previous_task_id'] != '' && $_SESSION['previous_task_id'] != $task_id) { // 如果换task了，对应要更换template和question
    			$_SESSION['template_json'] = '';
    			$_SESSION['question_json'] = '';
    		}
    		$_SESSION['previous_task_id'] = $task_id;
    		$worker_id = $_SESSION['worker_id'];
    		// 模板改为在前台显示，不再向后台发请求
    		/*if(!isset($_SESSION['template_json']) || $_SESSION['template_json'] == '') {
    			$templateModel = new TemplateModel();
	    		$result = $templateModel->template_json($token);
	    		$_SESSION['template_json'] = $result;
    		}*/
    		$taskModel = new TaskModel();
    		$task = $taskModel->read($task_id, '', '', '', '', '', '', '', $token);
    		$qualification_test = '';
    		if($task[0]['units_for_qualification_test'] != 0) { // 说明需要进行qualification test
    			$qualification_test = 1;
    		}
    		$unitModel = new UnitModel();
    		$my_unit_list = $unitModel->unit($task_id, $worker_id, '', $qualification_test, $token);
    		if($my_unit_list['code'] == '1301') { // qualification test isn't needed
    			$my_unit_list = $unitModel->unit($task_id, $worker_id, '', '', $token);
    		}
    		$this->assign('my_unit_list', json_encode($my_unit_list));
    		$this->assign('task_id', $task_id);
    		$this->assign('task_template_type', $task[0]['template_type']);
    		$this->assign('qualification_test', $qualification_test);
    		$this->display('dojob');
    	}
    	else {
    		$this->display('Index/signin');
    		//$this->redirect(C('WEB_URL'));
    	}
    }
    
    /*public function SubmitAnswer() {
    	$data = I('data');
    	//id-24=A&amp;id-25=B&amp;id-26=A&amp;id-27=A&amp;worker_id=14
    	$data_array = explode('&amp;', $data);
    	$post_array = array();
    	for($i=0;$i<count($data_array);$i++) {
    		$tmp = explode('=', $data_array[$i], 2);
    		$post_array[$tmp[0]] = $tmp[1];
    	}
    	$workflowModel = new WorkflowModel();
    	$result = $workflowModel->submit($post_array);
    	if($result['code'] == 0) {
    		$ret['code'] = 0;
    	}
    	else {
    		$ret['code'] = 1;
    		$ret['message'] = 'Submit Fail!';
    	}
    	$this->ajaxReturn($ret, 'JSON');
    }*/
    
    public function Profile(){
    	if(isset($_SESSION['worker_id']) && $_SESSION['worker_id'] != '' && $_SESSION['expire_time'] > time()) {
    		//$workerModel = new WorkerModel();
    		//$worker = $workerModel->read($_SESSION['worker_id']);
    		//$this->assign('worker', $worker);
    		$this->display('profile');
    	}
    	else {
    		$this->display('Index/signin');
    		//$this->redirect(C('WEB_URL'));
    	}
    }
    
    /*public function AjaxProfile(){
    	if(isset($_SESSION['worker_id']) && $_SESSION['worker_id'] != '') {
    		$workerModel = new WorkerModel();
    		$worker = $workerModel->read($_SESSION['worker_id']);
    		$this->ajaxReturn($worker);
    	}
    	else {
    		$this->redirect(C('WEB_URL'));
    	}
    }
    
    public function SaveProfile(){
    	if(isset($_SESSION['worker_id']) && $_SESSION['worker_id'] != '') {
    		$workerModel = new WorkerModel();
    		$worker = $workerModel->update($_SESSION['worker_id']);
    		$this->assign('worker', $worker);
    		$this->display();
    	}
    	else {
    		$this->redirect(C('WEB_URL'));
    	}
    }*/
    
    public function Dashboard(){
    	if(isset($_SESSION['worker_id']) && $_SESSION['worker_id'] != '' && $_SESSION['expire_time'] > time()) {
    		//$workerModel = new WorkerModel();
    		//$worker = $workerModel->read($_SESSION['worker_id']);
    		//$this->assign('worker', $worker);
    		$this->display('dashboard');
    	}
    	else {
    		$this->display('Index/signin');
    		//$this->redirect(C('WEB_URL'));
    	}
    }

    public function Verifyemail(){

        if(isset($_SESSION['worker_id']) && $_SESSION['worker_id'] != '' && $_SESSION['expire_time'] > time()) {
            //$workerModel = new WorkerModel();
            //$worker = $workerModel->read($_SESSION['worker_id']);
            //$this->assign('worker', $worker);
            $this->display("verifyemail");
        }
        else {
        	$this->display('Index/signin');
            //$this->redirect(C('WEB_URL'));
        }
    }

    public function ChangeStatus(){
        if(isset($_SESSION['worker_id']) && $_SESSION['worker_id'] != '' && $_SESSION['expire_time'] > time()){
            $_SESSION['worker_userstatus'] = "1";
        }else{
        	$this->display('Index/signin');
           // $this->redirect(C('WEB_URL'));
        }
    }
}