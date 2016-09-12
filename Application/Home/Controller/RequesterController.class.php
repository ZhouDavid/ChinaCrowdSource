<?php
namespace Home\Controller;
use Think\Controller;
use Home\Model\TaskModel;
use Home\Model\UnitModel;
use Home\Model\QuestionModel;
use Home\Model\AnswerModel;
use Home\Model\GoldenAnswerModel;
use Home\Model\TemplateModel;
use Home\Model\TagModel;
use Home\Model\StatModel;
use Home\Model\RequesterModel;
class RequesterController extends Controller {
    public function index(){//无需改动
    	if(isset($_SESSION['requester_id']) && $_SESSION['requester_id'] != '' &&
            isset($_SESSION['requester_token']) && $_SESSION['requester_token'] != '') {
	    		
	    	//$requester_username = $_SESSION['requester_username'];
	    	$requester_id = $_SESSION['requester_id'];

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
            $token = $_SESSION['requester_token'];

            $tags = I('tags');
    		/*if($tags == '') {
    			$requesterModel = new RequesterModel();
    			$requester = $requesterModel->read($_SESSION['requester_id'], $token);
    			$tagss = $requester['tags'];
    			$tags = implode(',', $tagss);
    			//print_r($tags);
    		}*/
    		//print_r($tags);
    		$content = I('search');
    		$content = str_replace(" ", ",", $content);

	    	$taskModel = new TaskModel();
	    	$my_task_list = $taskModel->read('', '', '', '', $requester_id, $ordering, 10, $page, $token, $tags, $content);
            $sort = '';
            $reverse_sort = '-';
            $ordering_field = $ordering;
            if($ordering[0] == '-') {
                $sort = '-';
                $reverse_sort = '';
                $ordering_field = substr($ordering_field, 1, strlen($ordering_field));
            }
	    	
            //echo $requester_id;
            //echo count($my_task_list);
            //echo json_encode($my_task_list);
            $this->assign('token', $token);
	    	$this->assign("my_task_list", $my_task_list);
            $this->assign('current_page', $page);
            $this->assign('current_ordering', $ordering);
            $this->assign('current_ordering_field', $ordering_field);
            $this->assign('current_sort', $sort);
            $this->assign('current_reverse_sort', $reverse_sort);
            //echo $_SESSION['requester_token'];
	    	$this->display();
    	}
    	else {
    		if(!isset($_GET['vtoken']) || $_GET['vtoken'] == '') {
    			$this->display('Index/signin');
    			//$this->redirect('index.php/Index');
    		}
    		else {
    			$this->display();
    		}
    	}
    }

    public function getjobstatus() {
        if (isset($_SESSION['task_id']) && $_SESSION['task_id'] != '')
        {
            $task_id = $_SESSION['task_id'];
            $token = $_SESSION['requester_token'];
            $taskModel = new TaskModel();
            $result = $taskModel->read($task_id, '', '', '', '', '', '', '', $token);
            $_SESSION['status'] = $result[0]['status'];
            $_SESSION['title'] = $result[0]['title'];
            $_SESSION['description'] = $result[0]['description'];
            //$ret['code'] = $result[0]['code'];
            $ret['status'] = $result[0]['status'];
            if ($_SESSION['status']=="data" && $result[0]['published']==true)
            {
                $ret['status'] = "publish";
                $_SESSION['status'] = "publish";
            }
            if ($_SESSION['status']=="data" || $_SESSION['status']=="option")
            {
                $task_id = $_SESSION['task_id'];
                $taskModel = new TaskModel();
                $result = $taskModel->get_option($task_id, $token);
                //$ret['option'] = $result['result']['option'];
                $_SESSION['option'] = $result['result']['option'];
                $_SESSION['normal-sample'] = $result['result']['normal-sample'];
                $_SESSION['golden-sample'] = $result['result']['golden-sample'];
            }
            $this->ajaxReturn($ret, 'JSON');
        }
    }

    public function getoption() {
        if (isset($_SESSION['task_id']) && $_SESSION['task_id'] != '')
        {
            $task_id = $_SESSION['task_id'];
            $taskModel = new TaskModel();
            $token = $_SESSION['requester_token'];
            $result = $taskModel->get_option($task_id, $token);
            $ret['option'] = $result['result']['option'];
            $_SESSION['option'] = $result['result']['option'];
            $_SESSION['normal-sample'] = $result['result']['normal-sample'];
            $_SESSION['golden-sample'] = $result['result']['golden-sample'];
        }
    }

    /*public function get_templates() {//无需改动
        if (isset($_SESSION['requester_token']) && $_SESSION['requester_token'] != '') {
            $token = $_SESSION['requester_token'];
            $templateModel = new TemplateModel();
            $result = $templateModel->templates($token);
            $_SESSION['templates'] = $result;
            $ret['code'] = $result['code'];
        }
        else 
        {
            $ret['code'] = 10;
        }
        $this->ajaxReturn($ret, 'JSON');
    }*/

    public function new_from_template() {
    	$this->display();
    }

    public function get_template() {//无需改动
        if (isset($_SESSION['requester_token']) && $_SESSION['requester_token'] != '') {
            $token = $_SESSION['requester_token'];
            $_SESSION['template_id'] = I("template_id");
            $templateModel = new TemplateModel();
            $result = $templateModel->template($token);
            //$ret['templates'] = $_SESSION['templates'];
            //$ret['template'] = $result;
            $_SESSION['template'] = $result;
            $ret['code'] = $result['code'];
        }
        else
        {
            $ret['code'] = 10;
        }
    	$this->ajaxReturn($ret, 'JSON');
    }

    public function new_job() {
        $this->assign('template_id', $_SESSION['template_id']);
        $this->display();
    }

    public function createjob() {
        if (isset($_SESSION['requester_id']) && $_SESSION['requester_id'] != '' && isset($_SESSION['requester_token']) && $_SESSION['requester_token'] != '')
        {
            $token = $_SESSION['requester_token'];
            $requester_id = $_SESSION['requester_id'];
            $taskModel = new TaskModel();
            $template_id = $_SESSION['template_id'];
            $result = $taskModel->create_task($requester_id, $token);
            $ret['code'] = $result['code'];
            //$ret['result'] = $result['result'];
            $_SESSION['task_id'] = $result['result']['id'];
            $_SESSION['status'] = "init";
            //$ret['id'] = $result['id'];
            if ($ret['code']==0)
            {
                $task_id = $_SESSION['task_id'];
                $result1 = $taskModel->update_template_type($task_id, $template_id, $token);
                if ($result1['code']==0)
                {
                    $ret['code'] = 0;
                    //$ret['result'] = $result;
                    //$ret['result1'] = $result1;
                }
                else $ret['code'] = 1;
            }
            //$result1 = $taskModel->update_template_type($task)
        }
        else
        {
            $ret['code'] = 10;
        }
        $this->ajaxReturn($ret, 'JSON');
    }

    public function template() {
    	if (isset($_SESSION['template']) && $_SESSION['template'] != '')
    	{
    		//$ret['templates'] = $_SESSION['templates'];
    		$ret['template'] = $_SESSION['template'];
            $ret['template_id'] = $_SESSION['template_id'];
    		$this->ajaxReturn($ret, 'JSON');
    	}
    }

    public function get_job_tags() {
        $token = $_SESSION['requester_token'];
        if (isset($_SESSION['task_id']) && $_SESSION['task_id'] != '' && isset($_SESSION['requester_id']) && $_SESSION['requester_id'] != ''){
            $task_id = $_SESSION['task_id'];
            $requester_id = $_SESSION['requester_id'];
            $taskModel = new TaskModel();
            $result = $taskModel->read($task_id, '', '', '', $requester_id, '', '', '', $token);
            $tags = $result[0]["tags"];
            $this->ajaxReturn($tags, 'JSON');
        }
    }

    public function build_job_template() {
        $token = $_SESSION['requester_token'];
        if (!(isset($_SESSION['template']) && $_SESSION['template'] != ''))
        {
            $templateModel = new TemplateModel();
            $result = $templateModel->template($token);
            $_SESSION['template'] = $result;
        }
        if ($_SESSION['status']=="init")
        {
            $ret['template'] = $_SESSION['template'];
        }
        else
        {
            $task_id = $_SESSION['task_id'];//
            $taskModel = new TaskModel();
            $result = $taskModel->get_option($task_id, $token);
            $ret['option'] = $result;
            $_SESSION['option'] = $result['result']['option'];
            $_SESSION['normal-sample'] = $result['result']['normal-sample'];
            $_SESSION['golden-sample'] = $result['result']['golden-sample'];
            $ret['template'] = $_SESSION['template'];
        }
        $this->ajaxReturn($ret, 'JSON');
    }

    public function build_job() {
        $token = $_SESSION['requester_token'];
        if ($_SESSION['status']=="init"){
            if (isset($_SESSION['template']) && $_SESSION['template'] != '') {
                $template = $_SESSION['template'];
            }
            else
            {
                $templateModel = new TemplateModel();
                $result = $templateModel->template($token);
                $_SESSION['template'] = $result;
                $template = $result;
            }
            $show_your_data = $template['result']['template'];
            if ($_SESSION['template_id']=="2")
            {
                $show_your_data = "please compare {fruit1} and {fruit2}, and answer the following questions.";
            }
            else if ($_SESSION['template_id']=="3")
            {
                $show_your_data = "please answer the following questions about picture url@{url_of_pic}@.";
            }
            else if ($_SESSION['template_id']=="4")
            {
                $show_your_data = "please compare picture url@{url_of_pic1}@ and picture url@{url_of_pic2}@, and answer the following questions.";
            }
            else if ($_SESSION['template_id']=="5")
            {
                $show_your_data = "please answer the following questions about webpage web@crowdbao{html}crowdbao@.";
            }
            else if ($_SESSION['template_id']=="6")
            {
                $show_your_data = "please compare webpages web@crowdbao{html1}crowdbao@ and web@crowdbao{html2}crowdbao@, and answer the following questions.";
            }
            $this->assign('task_title', L('Title'));
            $this->assign('task_des', L('This is a new task!'));
            $this->assign('show_your_data', $show_your_data);
            $this->assign('task_id',$_SESSION['task_id']);
            $this->assign('template_id',$_SESSION['template_id']);
            $this->assign('token', $token);
            $this->assign('status', $_SESSION['status']);
            $this->display();
        }
        else {
            //$task_id = $_SESSION['task_id'];
            //$taskModel = new TaskModel();
            //$result = $taskModel->get_option($task_id);
            $this->assign('task_title', $_SESSION['title']);
            $this->assign('task_des', $_SESSION['description']);
            $this->assign('show_your_data', $_SESSION['option']['template']);
            $this->assign('task_id',$_SESSION['task_id']);
            $this->assign('template_id',$_SESSION['template_id']);
            $this->assign('token', $token);
            $this->assign('status', $_SESSION['status']);
            $this->display();
        }
    }

    public function uploadoption() {
        if ($_POST) {
            if (isset($_SESSION['task_id']) && $_SESSION['task_id'] != ''){
                $token = $_SESSION['requester_token'];
                $task_id = $_SESSION['task_id'];
                $option = I('option');
                $option = json_encode($option);
                $taskModel = new TaskModel();
                $result = $taskModel->upload_option($task_id, $option, $token);
                $retf['code'] = $result['code'];
                $_SESSION['normal-sample'] = $result['result']['normal-sample'];
                $_SESSION['golden-sample'] = $result['result']['golden-sample'];
                $_SESSION['status'] = 'option';

                $title = I('title');
                $description = I('description');
                //$tags = I('tags');
                //$taskModel = new TaskModel();
                //$result = $taskModel->update_task_title_des($task_id, $title, $description, $token);
                /*if ($task_id == $result['id'])
                {
                    $rets['code'] = 0;
                }
                else
                {
                    $rets['code'] = 1;
                }
                if ($retf['code']==0 && $rets['code']==0)
                {
                    $ret['code'] = 0;
                }
                else
                    $ret['code'] = 1;*/

                $_SESSION['title'] = $title;
                $_SESSION['description'] = $description;

                $this->ajaxReturn($retf, 'JSON');
            }
        }
    }

    public function get_task_sample() {

        if (isset($_SESSION['task_id']) && $_SESSION['task_id'] != '')
        {
            $task_id = $_SESSION['task_id'];
            $taskModel = new TaskModel();
            $token = $_SESSION['requester_token'];
            $result = $taskModel->get_option($task_id, $token);
            $ret['option'] = $result['result']['option'];
            $_SESSION['option'] = $result['result']['option'];
            $_SESSION['normal-sample'] = $result['result']['normal-sample'];
            $_SESSION['golden-sample'] = $result['result']['golden-sample'];
            $task_url['id'] = $_SESSION['task_id'];
            $task_url['normal-sample'] = $_SESSION['normal-sample'];
            $task_url['golden-sample'] = $_SESSION['golden-sample'];
            $task_url['token'] = $_SESSION['requester_token'];
            $this->ajaxReturn($task_url, 'JSON');
        }
    }

    /*public function set_pic_url() {
        if ($_POST){
            $_SESSION['pic'] = I('pic');
            if ($_SESSION['pic']==1)
            {
                $_SESSION['pic_url'] = I('pic_url');
                $ret['pic_url'] = $_SESSION['pic_url'];
            }
            $ret['pic'] = $_SESSION['pic'];
            $this->ajaxReturn($ret, 'JSON');
        }
        //$_SESSION['pic_url'] = I('pic_url');
    }

    public function set_pic() {
        if ($_POST){
            $_SESSION['pic'] = I('pic');
            /*if ($_SESSION['pic']==1)
            {
                $_SESSION['pic_url'] = I('pic_url');
                $ret['pic_url'] = $_SESSION['pic_url'];
            }
            $ret['pic'] = $_SESSION['pic'];
            $this->ajaxReturn($ret, 'JSON');*/
        /*}
    }*/

    public function upload_data() {
        $this->assign('title', $_SESSION['title']);
        $this->assign('token', $_SESSION['requester_token']);
        $this->assign('task_id', $_SESSION['task_id']);
        $this->assign('template_id', $_SESSION['template_id']);
        $this->assign('status', $_SESSION['status']);
        $this->display();
    }

    public function upload_pic() {
        $this->assign('title', $_SESSION['title']);
        $this->assign('token', $_SESSION['requester_token']);
        $this->assign('task_id', $_SESSION['task_id']);
        $this->assign('template_id', $_SESSION['template_id']);
        $this->assign('status', $_SESSION['status']);
        $this->display();
    }

    public function append_data() {
        $this->assign('title', $_SESSION['title']);
        $this->assign('token', $_SESSION['requester_token']);
        $this->assign('task_id', $_SESSION['task_id']);
        $this->assign('template_id', $_SESSION['template_id']);
        $this->assign('status', $_SESSION['status']);
        $this->display();
    }

    public function truepreview() {
        $token = $_SESSION['requester_token'];
        $templateModel = new TemplateModel();
        $task_id = $_SESSION['task_id'];;
        $result = $templateModel->truedata($task_id, $token);
        $ret['true'] = $result;
        /*if ($_SESSION['pic']==1)
        {
            $ret['pic'] = $_SESSION['pic'];
            $ret['pic_url'] = $_SESSION['pic_url'];
            $ret['template_id'] = $_SESSION['template_id'];
        }*/
        $ret['template_id'] = $_SESSION['template_id'];
        $ret['token'] = $token;
        $this->ajaxReturn($ret, 'JSON');
    }

    public function truepreviewall() {
        $token = $_SESSION['requester_token'];

        if (isset($_SESSION['task_id']) && $_SESSION['task_id'] != '' && isset($_SESSION['requester_id']) && $_SESSION['requester_id'] != ''){
            $task_id = $_SESSION['task_id'];
            $requester_id = $_SESSION['requester_id'];
            $taskModel = new TaskModel();
            $result = $taskModel->read($task_id, '', '', '', $requester_id, '', '', '', $token);
            
            $total_units = $result[0]['total_units'];
            
            $_SESSION['total_units'] = $total_units;
        }

        $totalnum = $_SESSION['total_units'];

        $templateModel = new TemplateModel();
        $task_id = $_SESSION['task_id'];;
        $result = $templateModel->truedataall($task_id, $token, $totalnum);
        $ret['true'] = $result;
        $ret['template_id'] = $_SESSION['template_id'];
        $ret['token'] = $token;
        $this->ajaxReturn($ret, 'JSON');
    }

    public function preview()
    {
        //$_SESSION['status'] = "data";
        $this->assign('title', $_SESSION['title']);
        $this->display();
    }

    public function qualificationtest() {
        if (isset($_SESSION['task_id']) && $_SESSION['task_id'] != '' && isset($_SESSION['requester_id']) && $_SESSION['requester_id'] != ''){
            $token = $_SESSION['requester_token'];
            $task_id = $_SESSION['task_id'];
            $requester_id = $_SESSION['requester_id'];
            $taskModel = new TaskModel();
            $result = $taskModel->read($task_id, '', '', '', $requester_id, '', '', '', $token);
            //echo json_encode($result);
            //echo $task_id;
            //echo $requester_id;
            //$judgements_per_unit = $result[0]['judgements_per_unit'];
            $units_for_qualification_test = $result[0]['units_for_qualification_test'];
            $golden_units_in_first_pages = $result[0]['golden_units_in_first_pages'];
            //$units_per_page = $result[0]['units_per_page'];
            $min_accuracy = $result[0]['min_accuracy'];
            $min_accuracy_hidden = $result[0]['min_accuracy_hidden'];
            //echo $judgements_per_unit;
            //$this->assign('units_per_page', $units_per_page);
            $this->assign('golden_units_in_first_pages', $golden_units_in_first_pages);
            $this->assign('units_for_qualification_test', $units_for_qualification_test);
            $this->assign('min_accuracy_hidden', $min_accuracy_hidden);
            $this->assign('min_accuracy', $min_accuracy);
            $this->assign('title', $_SESSION['title']);
            $this->assign('token', $_SESSION['requester_token']);
            $this->display();
        }
    }

    public function task_update_qualification() {
        if ($_POST){
            if (isset($_SESSION['task_id']) && $_SESSION['task_id'] != '')
            {
                $token = $_SESSION['requester_token'];
                $task_id = $_SESSION['task_id'];
                //$judgements_per_unit = I('judgements_per_unit');
                //$units_per_page = i('units_per_page');
                $units_for_qualification_test = I('units_for_qualification_test');
                $min_accuracy = I('min_accuracy');
                $min_accuracy_hidden = I('min_accuracy_hidden');
                $golden_units_in_first_pages = I('golden_units_in_first_pages');
                $taskModel = new TaskModel();
                $result = $taskModel->update_task_qualification($task_id, $units_for_qualification_test, $min_accuracy, $golden_units_in_first_pages, $min_accuracy_hidden, $token);
                if ($result['code']==0)
                {
                    $ret['code'] = 0;
                }
                else
                {
                    $ret['code'] = 1;
                }
                $this->ajaxReturn($ret, 'JSON');
            }
        }
    }

    public function manage_quality() {
        if (isset($_SESSION['task_id']) && $_SESSION['task_id'] != '' && isset($_SESSION['requester_id']) && $_SESSION['requester_id'] != ''){
            $token = $_SESSION['requester_token'];
            $task_id = $_SESSION['task_id'];
            $requester_id = $_SESSION['requester_id'];
            $taskModel = new TaskModel();
            $result = $taskModel->read($task_id, '', '', '', $requester_id, '', '', '', $token);
            //echo json_encode($result);
            //echo $task_id;
            //echo $requester_id;
            $judgements_per_unit = $result[0]['judgements_per_unit'];
            $price = $result[0]['price'];
            //$units_for_qualification_test = $result[0]['units_for_qualification_test'];
            //$golden_units_per_page = $result[0]['golden_units_per_page'];
            $units_per_page = $result[0]['units_per_page'];
            //$min_accuracy = $result[0]['min_accuracy'];
            //echo $judgements_per_unit;
            $this->assign('units_per_page', $units_per_page);
            $this->assign('price', $price);
            //$this->assign('golden_units_per_page', $golden_units_per_page);
            //$this->assign('units_for_qualification_test', $units_for_qualification_test);
            $this->assign('judgements_per_unit', $judgements_per_unit);
            //$this->assign('min_accuracy', $min_accuracy);
            $this->assign('title', $_SESSION['title']);
            $this->display();
        }
    }

    public function task_update() {
        if ($_POST){
            if (isset($_SESSION['task_id']) && $_SESSION['task_id'] != '')
            {
                $token = $_SESSION['requester_token'];
                $task_id = $_SESSION['task_id'];
                $judgements_per_unit = I('judgements_per_unit');
                $units_per_page = I('units_per_page');
                $price = I('price');
                $testmode = I('testmode');
                $developer = I('developer');
                $isgeo = I('isgeo');
                $developer_site = I('developer_site');
                //$units_for_qualification_test = I('units_for_qualification_test');
                //$min_accuracy = I('min_accuracy');
                //$golden_units_per_page = I('golden_units_per_page');
                $taskModel = new TaskModel();
                $result = $taskModel->update_task($task_id, $judgements_per_unit, $units_per_page, $price, $testmode, $developer, $isgeo, $developer_site, $token);
                if ($result['code']==0)
                {
                    $ret['code'] = 0;
                }
                else
                {
                    $ret['code'] = 1;
                }
                $this->ajaxReturn($ret, 'JSON');
            }
        }
    }

    public function launch($task_id='') {
        if ($task_id != '')
        {
            $_SESSION['task_id'] = $task_id;
        }

        if (isset($_SESSION['task_id']) && $_SESSION['task_id'] != '')
        {
            $token = $_SESSION['requester_token'];
            $task_id = $_SESSION['task_id'];
            $requester_id = $_SESSION['requester_id'];
            $taskModel = new TaskModel();
            $result = $taskModel->read($task_id, '', '', '', $requester_id, '', '', '', $token);
            $judgements_per_unit = $result[0]['judgements_per_unit'];
            $price = $result[0]['price'];
            $total_units = $result[0]['total_units'];
            $total = $total_units*$price*$judgements_per_unit;

            $requesterModel = new RequesterModel();
            $res = $requesterModel->read($requester_id, $token);
            $money = $res['money'];
            $diff = $money-$total;
            //echo json_encode($res);

            $this->assign('judgements_per_unit', $judgements_per_unit);
            $this->assign('total_units', $total_units);
            $this->assign('price', $price);
            $this->assign('title', $_SESSION['title']);
            $this->assign('token', $_SESSION['requester_token']);
            $this->assign('money', $money);
            $this->assign('total', $total);
            $this->assign('diff', $diff);
            $this->assign('task_id', $_SESSION['task_id']);

            $this->display();
        }
    }

    public function publish() {
        if (isset($_SESSION['task_id']) && $_SESSION['task_id'] != '') {
            $token = $_SESSION['requester_token'];
            $task_id = $_SESSION['task_id'];;
            $taskModel = new TaskModel();
            $result = $taskModel->publish($task_id, $token);
            $_SESSION['status'] = "publish";
            $this->ajaxReturn($result, 'JSON');
        }
    }

    public function monitor($task_id='') {
        $token = $_SESSION['requester_token'];
        if ($task_id != '')
        {
            $_SESSION['task_id'] = $task_id;
        }
        if (isset($_SESSION['task_id']) && $_SESSION['task_id'] != '' && isset($_SESSION['requester_id']) && $_SESSION['requester_id'] != ''){
            $task_id = $_SESSION['task_id'];
            $requester_id = $_SESSION['requester_id'];
            $taskModel = new TaskModel();
            $result = $taskModel->read($task_id, '', '', '', $requester_id, '', '', '', $token);
            //echo json_encode($result);
            //echo $task_id;
            //echo $requester_id;
            //$this->getoption();
            $judgements_per_unit = $result[0]['judgements_per_unit'];
            $units_for_qualification_test = $result[0]['units_for_qualification_test'];
            $golden_units_in_first_pages = $result[0]['golden_units_in_first_pages'];
            $total_units = $result[0]['total_units'];
            $finished_units = $result[0]['finished_units'];
            $price = $result[0]['price'];
            $_SESSION['template_id'] = $result[0]['template_type'];
            $_SESSION['total_units'] = $total_units;
            //echo $judgements_per_unit;
            
            $statModel = new StatModel();
            $result = $statModel->task($task_id, $token);
            $n_finished_units = $result['result']['n_finished_units'];
            $n_workers = $result['result']['n_workers'];
            //print_r($result);
            
            $this->assign('total_units', $total_units);
            $this->assign('golden_units_in_first_pages', $golden_units_in_first_pages);
            $this->assign('units_for_qualification_test', $units_for_qualification_test);
            $this->assign('judgements_per_unit', $judgements_per_unit);
            $this->assign('finished_units', $finished_units);
            $this->assign('price', $price);
            $this->assign('n_finished_units', $n_finished_units);
            $this->assign('n_workers', $n_workers);
            $this->assign('title', $_SESSION['title']);
            //$this->assign('title', $_SESSION['title']);
            $this->assign('token', $_SESSION['requester_token']);
            $this->assign('task_id', $_SESSION['task_id']);
            $this->assign('template_id', $_SESSION['template_id']);
            $this->assign('status', $_SESSION['status']);
            $this->display();
        }
    }

    public function get_results($task_id='') {
        if ($task_id != '')
        {
            $_SESSION['task_id'] = $task_id;
        }
        $this->assign('title', $_SESSION['title']);
        $this->assign('token', $_SESSION['requester_token']);
        $this->assign('task_id', $_SESSION['task_id']);
        $this->display();
    }
    
    public function Profile(){
    	if(isset($_SESSION['requester_id']) && $_SESSION['requester_id'] != '') {
    		$this->display('profile');
    	}
    	else {
    		$this->display('Index/signin');
    		//$this->redirect(C('WEB_URL'));
    	}
    }
    
    public function Dashboard(){
    	if(isset($_SESSION['requester_id']) && $_SESSION['requester_id'] != '') {
    		$this->display('dashboard');
    	}
    	else {
    		$this->display('Index/signin');
    		//$this->redirect(C('WEB_URL'));
    	}
    }
    
    public function RechargeSuccess(){
    	if(isset($_SESSION['requester_id']) && $_SESSION['requester_id'] != '') {
    		$public = new PublicController();
    		//echo 'get_url = '.$public->get_url();
    		$url = $public->get_url();
    		$param = strstr($url, '?', false);
    		//echo $param;
    		//$result = $public->http_get(C('API_URL').'/stat/', $param);
    		$result = $public->send_request(C('API_URL').'/payments/return_url'.$param, ''); // get请求用send_request
    		$result = json_decode($result, true);
    		$result = array_reverse($result);
    		//print_r($result);
    		if($result['result']['status'] == 'success') {
    			$this->display('recharge_success');
    		}
    		else {
    			$this->display('recharge_fail');
    		}
    	}
    	else {
    		$this->display('Index/signin');
    		//$this->redirect(C('WEB_URL'));
    	}
    }

    public function Verifyemail(){

        if(isset($_SESSION['requester_id']) && $_SESSION['requester_id'] != '') {
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
        if(isset($_SESSION['requester_id']) && $_SESSION['requester_id'] != ''){
            $_SESSION['requester_userstatus'] = "1";
        }else{
        	$this->display('Index/signin');
            //$this->redirect(C('WEB_URL'));
        }
    }
    
}