<?php
 // 递归替换数组中的html标签
function filterHtml($array){
    if(is_array($array)){
        foreach($array as $k => $v){
            $array[$k] = filterHtml($array[$k]);
        }
    }else{
        $array =  trim(strip_tags($array));
    }
    return $array;
}

// 获取ip地址
function getIP(){
	if(!empty($_SERVER["HTTP_CLIENT_IP"])){
	  $cip = $_SERVER["HTTP_CLIENT_IP"];
	}
	elseif(!empty($_SERVER["HTTP_X_FORWARDED_FOR"])){
	  $cip = $_SERVER["HTTP_X_FORWARDED_FOR"];
	}
	elseif(!empty($_SERVER["REMOTE_ADDR"])){
	  $cip = $_SERVER["REMOTE_ADDR"];
	}
	else{
	  $cip = "无法获取！";
	}
	return $cip;
}

// 验证手机号
function checkphone($phone){
    if (!$phone) {
        return false;
    }
    return preg_match('#^13[\d]{9}$|147[\d]{8}||170[\d]{8}|^15[0-9]\d{8}$|^18[0-9]\d{8}$#', $phone) ? true : false;
}

// 验证密码长度
function checkpassword($password){
    $len = strlen($password);
    if($len >= 6){
        return true;
    }else{
        return false;
    }
}

function check_verify($code, $id = ''){
    $verify = new \Think\Verify();
    return $verify->check($code, $id);
}
