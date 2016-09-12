<?php
namespace Home\Controller;
use Think\Controller;
use Home\Model\TaskModel;
use Home\Model\UnitModel;
use Home\Model\QuestionModel;
use Home\Model\AnswerModel;
use Home\Model\GoldenAnswerModel;
class TaskController extends Controller {
    public function search(){
    	if(isset($_SESSION['worker_id']) && $_SESSION['worker_id'] != '') {
    		$content = I('search_content');
    		$content = str_replace(" ", ",", $content);
    		$ordering = I('ordering');
    		if(isset($_GET['page'])) {
    			$page = I('page');
    		}
    		else {
    			$page=1;
    		}
	    	$taskModel = new TaskModel();
	    	$my_task_list = $taskModel->search($content, 'True', 'False', '', $ordering, 10, $page, $_SESSION['worker_token']);
	    	//$my_task_list = $taskModel->task_search($content, 'True', 'False', '', $ordering, 10, $page, $_SESSION['worker_token']);
	    	$sort = '';
	    	$reverse_sort = '-';
	    	$ordering_field = $ordering;
	    	if($ordering[0] == '-') {
	    		$sort = '-';
	    		$reverse_sort = '';
	    		$ordering_field = substr($ordering_field, 1, strlen($ordering_field));
	    	}
	    	$this->assign('my_task_list', $my_task_list);
	    	$this->assign('current_page', $page);
	    	$this->assign('current_ordering', $ordering);
	    	$this->assign('current_ordering_field', $ordering_field);
	    	$this->assign('current_sort', $sort);
	    	$this->assign('current_reverse_sort', $reverse_sort);
	    	$this->assign('current_tags', '');
	    	$this->display('Worker:index');
    	}
    	else if(isset($_SESSION['requester_id']) && $_SESSION['requester_id'] != '') {
    		$content = I('search_content');
    		$content = str_replace(" ", ",", $content);
    		$ordering = I('ordering');
    		if(isset($_GET['page'])) {
    			$page = I('page');
    		}
    		else {
    			$page=1;
    		}
    		$taskModel = new TaskModel();
    		$my_task_list = $taskModel->search($content, '', '', $_SESSION['requester_id'], $ordering, 10, $page, $_SESSION['requester_token']); 
    		//$my_task_list = $taskModel->task_search($content, '', '', $_SESSION['requester_id'], $ordering, 10, $page, $_SESSION['requester_token']);
	    	$sort = '';
	    	$reverse_sort = '-';
	    	$ordering_field = $ordering;
	    	if($ordering[0] == '-') {
	    		$sort = '-';
	    		$reverse_sort = '';
	    		$ordering_field = substr($ordering_field, 1, strlen($ordering_field));
	    	}
	    	$this->assign('my_task_list', $my_task_list);
	    	$this->assign('current_page', $page);
	    	$this->assign('current_ordering', $ordering);
	    	$this->assign('current_ordering_field', $ordering_field);
	    	$this->assign('current_sort', $sort);
	    	$this->assign('current_reverse_sort', $reverse_sort);
	    	$this->assign('current_tags', '');
    		$this->display('Requester:index');
    	}
    	else {
    		$this->redirect(C('WEB_URL'));
    	}
    }
}