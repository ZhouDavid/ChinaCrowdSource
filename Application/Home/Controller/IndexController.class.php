<?php
namespace Home\Controller;
use Think\Controller;
use Home\Model\AccountModel;
use Home\Model\StatModel;
class IndexController extends Controller {

    public function index(){
    	if(isset($_SESSION['requester_id']) && $_SESSION['requester_id'] != '' && $_SESSION['expire_time'] > time()) {
    		$this->redirect(C('WEB_URL').'/Requester/index');
    	}
    	elseif(isset($_SESSION['worker_id']) && $_SESSION['worker_id'] != '' && $_SESSION['expire_time'] > time()) {
    		$this->redirect(C('WEB_URL').'/Worker/index');
    	}
    	else {
    		$statModel = new StatModel();
    		$result = $statModel->stat();
    		if($result['code'] == 0) {
    			$this->assign('statInfo', $result['result']);
    		}
    		$this->display();
    	}
    }
    
    public function signin() {
    	if(isset($_SESSION['requester_id']) && $_SESSION['requester_id'] != '' && $_SESSION['expire_time'] > time()) {
    		$this->redirect(C('WEB_URL').'/Requester/index');
    	}
    	elseif(isset($_SESSION['worker_id']) && $_SESSION['worker_id'] != '' && $_SESSION['expire_time'] > time()) {
    		$this->redirect(C('WEB_URL').'/Worker/index');
    	}
    	else {
    		$this->display();
    	}
    }
    
    public function signup() {
        if(isset($_SESSION['requester_id']) && $_SESSION['requester_id'] != '' && $_SESSION['expire_time'] > time()) {
            $this->redirect(C('WEB_URL').'/Requester/index');
        }
        elseif(isset($_SESSION['worker_id']) && $_SESSION['worker_id'] != '' && $_SESSION['expire_time'] > time()) {
            $this->redirect(C('WEB_URL').'/Worker/index');
        }
        else {
            $this->display();
        }
    }
    
    public function reset_requester() {
        $this->display();
    }
    
    public function reset_worker() {
    	$this->display();
    }
    
    public function donewpwd_worker() {
        $this->display();
    }
    
    public function donewpwd_requester() {
        $this->display();
    }

    public function dosignup() {
    	if(isset($_SESSION['requester_id']) && $_SESSION['requester_id'] != '' && $_SESSION['expire_time'] > time()) {
    		$this->redirect(C('WEB_URL').'/Requester/index');
    	}
    	elseif(isset($_SESSION['worker_id']) && $_SESSION['worker_id'] != '' && $_SESSION['expire_time'] > time()) {
    		$this->redirect(C('WEB_URL').'/Worker/index');
    	}
    	else {
	    	if($_POST) {
	    		$username = I('username');
	    		$password = I('password');
	    		$email = I('email');
	    		$type = I('type');
	    		//$verifycode = I('verifycode');
	    		$accountModel = new AccountModel();
	    		$result = $accountModel->register($username, $password, $email, $type);
	    		$ret['code'] = $result['code'];
	    		if ($result['code'] == 0)
	    		{
	    			//$result = $accountModel->login($username, $password, $type);
	    			//if ($result['code'] == 0)
		    		//	{
		    			if($type == 'requester') {
		    				$_SESSION['requester_username'] = $username;
		    				$_SESSION['requester_id'] = $result['result']['id'];
	                       		        $_SESSION['requester_token'] = $result['result']['token'];
                        			$_SESSION['requester_userstatus'] = "0";
		    			}
		    			else if($type == 'worker') {
		    				$_SESSION['worker_username'] = $username;
		    				$_SESSION['worker_id'] = $result['result']['id'];
	                        		$_SESSION['worker_token'] = $result['result']['token'];
                        			$_SESSION['worker_userstatus'] = "0";
		    			}
	    			//}
	    		}
	    		else {
	    			$ret['message'] = L('Code'.$result['code']);
	    		}
	    		$this->ajaxReturn($ret,'JSON');
	    	}
	    	else {
	    		$this->redirect(C('WEB_URL').'/Index/signup');
	    	}
    	}
    }
    
    public function dosignin() {
    	if(isset($_SESSION['requester_id']) && $_SESSION['requester_id'] != '' && $_SESSION['expire_time'] > time()) {
    		$this->redirect(C('WEB_URL').'/Requester/index');
    	}
    	elseif(isset($_SESSION['worker_id']) && $_SESSION['worker_id'] != '' && $_SESSION['expire_time'] > time()) {
    		$this->redirect(C('WEB_URL').'/Worker/index');
    	}
    	else {
	    	if($_POST) {
	    		$username = I('username');
	    		$password = I('password');
	    		$type = I('type');
	    		//$verifycode = I('verifycode');
	    		$accountModel = new AccountModel();
	    		$result = $accountModel->login($username, $password, $type);
                $ret['result'] = $result;
	    		$ret['code'] = $result['code'];
	            if ($result['code'] == 0)
	            {
	            	if($type == 'requester') {
		                $_SESSION['requester_username'] = $username;
		                $_SESSION['requester_id'] = $result['result']['id'];
                        $_SESSION['requester_token'] = $result['result']['token'];
                        $_SESSION['requester_userstatus'] = $result['result']['status'];
                        $_SESSION['expire_time'] = strtotime("+2 day");
	            	}
	            	else if($type == 'worker') {
	            		$_SESSION['worker_username'] = $username;
	            		$_SESSION['worker_id'] = $result['result']['id'];
                        $_SESSION['worker_token'] = $result['result']['token'];
                        $_SESSION['worker_userstatus'] = $result['result']['status'];
                        $_SESSION['expire_time'] = strtotime("+2 day");
	            	}
	            }
	            else {
	            	$ret['message'] = L('Code'.$result['code']);
	            }
	    		$this->ajaxReturn($ret,'JSON');
	    	}
	    	else {
	    		$this->redirect(C('WEB_URL').'/Index/signin');
	    	}
    	}
    }
    
    public function dochangepassword() {
    	if((!isset($_SESSION['requester_id']) || $_SESSION['requester_id'] == '' || $_SESSION['expire_time'] < time()) &&
    	   (!isset($_SESSION['worker_id']) || $_SESSION['worker_id'] == '' || $_SESSION['expire_time'] < time())) {
    		$this->redirect(C('WEB_URL').'/Index/signin');
    	}
    	else {
    		if($_POST) {
    			$old_password = I('old_password');
    			$new_password = I('new_password');
    			$type = I('type');
    			$id = '';
    			if($type == 'worker') {
    				$id = $_SESSION['worker_id'];
    			}
    			else if($type == 'requester'){
    				$id = $_SESSION['requester_id'];
    			}
    			$accountModel = new AccountModel();
    			$result = $accountModel->changepassword($id, $old_password, $new_password, $type);
    			$ret['code'] = $result['code'];
    			if ($result['code'] == 0)
    			{
    				$ret['message'] = 'change password success!';
    			}
    			else {
    				$ret['message'] = L('Code'.$result['code']);
    			}
    			$this->ajaxReturn($ret,'JSON');
    		}
    		else {
    			$this->redirect(C('WEB_URL'));
    		}
    	}
    }
    
    public function switchuser() {
    	$_SESSION['requester_username'] = '';
        $_SESSION['requester_id'] = '';
        $_SESSION['requester_token'] = '';
    	$_SESSION['worker_username'] = '';
        $_SESSION['worker_id'] = '';
        $_SESSION['worker_token'] = '';
        $_SESSION['template_json'] = '';
        $_SESSION['previous_task_id'] = '';
        $_SESSION['expire_time'] = '';
    	$this->redirect('/index.php/Index/signin');
    }
    
    public function dologout() {
    	$_SESSION['requester_username'] = '';
        $_SESSION['requester_id'] = '';
        $_SESSION['requester_token'] = '';
    	$_SESSION['worker_username'] = '';
        $_SESSION['worker_id'] = '';
        $_SESSION['worker_token'] = '';
        $_SESSION['template_json'] = '';
        $_SESSION['previous_task_id'] = '';

    	$this->redirect('/index.php/Index/index');
    }
    
    public function aboutus() {
    	$this->display();
    }
    
    public function contactus() {
    	$this->display();
    }
    
    public function help() {
    	$this->display();
    }
}
