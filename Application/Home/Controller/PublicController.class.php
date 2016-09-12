<?php
namespace Home\Controller;
use Think\Controller;
class PublicController extends Controller {
	//在类初始化方法中，引入相关类库
	protected function _initialize() {
		header ( "Content-Type:text/html; charset=utf-8" );
	}
	
	// 生成验证码图片
	Public function verifyCode() {
		import ( 'ORG.Util.Image' );
		ob_end_clean (); // 解决中文状态不显示验证码，英文状态可以显示验证码问题，是BOM头的问题（http://blog.sina.com.cn/s/blog_4acbd39c01013jq9.html）
		Image::buildImageVerify ( $length = 4, $mode = 1, $type = 'png', $width = 60, $height = 30, $verifyName = 'verifycode' );
	}
	
	// 计算两个时间之间的时间差，以秒为单位
	Public function timeDiff($start_time, $end_time) {
		if ($start_time < $end_time) {
			$starttime = $start_time;
			$endtime = $end_time;
		} else {
			$starttime = $end_time;
			$endtime = $start_time;
		}
		$timediff = $endtime - $starttime;
		$days = intval ( $timediff / 86400 );
		$remain = $timediff % 86400;
		$hours = intval ( $remain / 3600 );
		$remain = $remain % 3600;
		$mins = intval ( $remain / 60 );
		$secs = $remain % 60;
		$res = array (
				"day" => $days,
				"hour" => $hours,
				"min" => $mins,
				"sec" => $secs 
		);
		// echo implode(",",$res);
		return $res;
	}
	
	// 获取客户端IP地址，注意只能在服务器上调试，通过localhost访问不能得到IP地址，通过127.0.0.1访问可以获得127.0.0.1
	// 参考：http://www.111cn.net/phper/php/36158.htm
	public function getIP() {
		if (! empty ( $_SERVER ["REMOTE_ADDR"] )) {
			$cip = $_SERVER ["REMOTE_ADDR"];
		} elseif (! empty ( $_SERVER ['HTTP_CLIENT_IP'] )) {
			$cip = $_SERVER ['HTTP_CLIENT_IP'];
		} elseif (! empty ( $_SERVER ['HTTP_X_FORWARDED_FOR'] )) {
			$cip = $_SERVER ['HTTP_X_FORWARDED_FOR'];
		} else {
			$cip = "0.0.0.0";
		}
		echo "REMOTE_ADDR:" . $cip;
		return $cip;
	}
	
	/**
	 * 发送HTTP请求
	 *
	 * @param string $url
	 *        	请求地址
	 * @param string $method
	 *        	请求方式 GET/POST
	 * @param string $refererUrl
	 *        	请求来源地址
	 * @param array $data
	 *        	发送数据
	 * @param string $contentType        	
	 * @param string $timeout        	
	 * @param string $proxy        	
	 * @return boolean
	 */
	function send_request($url, $data, $refererUrl = '', $method = 'GET', $contentType = 'application/json', $timeout = 30, $proxy = false) {
		$ch = null;
		if ('POST' === strtoupper ( $method )) {
			$ch = curl_init ( $url );
			curl_setopt ( $ch, CURLOPT_POST, 1 );
			curl_setopt ( $ch, CURLOPT_HEADER, 0 );
			curl_setopt ( $ch, CURLOPT_FRESH_CONNECT, 1 );
			curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, 1 );
			curl_setopt ( $ch, CURLOPT_FORBID_REUSE, 1 );
			curl_setopt ( $ch, CURLOPT_TIMEOUT, $timeout );
			if ($refererUrl) {
				curl_setopt ( $ch, CURLOPT_REFERER, $refererUrl );
			}
			if ($contentType) {
				curl_setopt ( $ch, CURLOPT_HTTPHEADER, array (
						'Content-Type:' . $contentType 
				) );
			}
			if (is_string ( $data )) {
				curl_setopt ( $ch, CURLOPT_POSTFIELDS, $data );
			} else {
				curl_setopt ( $ch, CURLOPT_POSTFIELDS, http_build_query ( $data ) );
			}
		} else if ('GET' === strtoupper ( $method )) {
			if (is_string ( $data )) {
				$real_url = $url . (strpos ( $url, '?' ) === false ? '?' : '') . $data;
			} else {
				$real_url = $url . (strpos ( $url, '?' ) === false ? '?' : '') . http_build_query ( $data );
			}
			//print_r($real_url);
			
			$ch = curl_init ( $real_url );
			curl_setopt ( $ch, CURLOPT_HEADER, 0 );
			curl_setopt ( $ch, CURLOPT_HTTPHEADER, array (
					'Content-Type:' . $contentType 
			) );
			curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, 1 );
			curl_setopt ( $ch, CURLOPT_TIMEOUT, $timeout );
			if ($refererUrl) {
				curl_setopt ( $ch, CURLOPT_REFERER, $refererUrl );
			}
		} else {
			$args = func_get_args ();
			return false;
		}
		
		if ($proxy) {
			curl_setopt ( $ch, CURLOPT_PROXY, $proxy );
		}
		$ret = curl_exec ( $ch );
		$info = curl_getinfo ( $ch );
		$contents = array (
				'httpInfo' => array (
						'send' => $data,
						'url' => $url,
						'ret' => $ret,
						'http' => $info 
				) 
		);
		
		curl_close ( $ch );
		return $ret;
	}
	
	public function http_post($url, $fields) {
		$context = stream_context_create(array('http' =>
			array(
				'method'  => 'POST',
				'content' => http_build_query($fields),
				'header'  => 'Content-type: application/x-www-form-urlencoded',
			)
		));
		return file_get_contents($url, false, $context);
	}

	public function http_get($url, $fields) {
		$ch = curl_init();//初始化curl
		curl_setopt($ch, CURLOPT_URL, $url);//设置请求地址
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);//返回值
		//curl_setopt($ch, CURLOPT_POST, 1);//设置请求方式POST
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "GET"); // 设置请求方式
		curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);//请求所带变量数据
		$result = curl_exec($ch);//执行获取返回数据，返回的数据建议json_encode($return_data);
		curl_close($ch);
		return $result;
	}
	
	public function http_patch($url, $fields) {
		$ch = curl_init();//初始化curl
		curl_setopt($ch, CURLOPT_URL, $url);//设置请求地址
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);//返回值
		//curl_setopt($ch, CURLOPT_POST, 1);//设置请求方式POST
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PATCH"); // 设置请求方式
		curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);//请求所带变量数据
		$result = curl_exec($ch);//执行获取返回数据，返回的数据建议json_encode($return_data);
		curl_close($ch);
		return $result;
	}
	
	public function http_put($url, $fields) {
		$ch = curl_init();//初始化curl
		curl_setopt($ch, CURLOPT_URL, $url);//设置请求地址
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);//返回值
		//curl_setopt($ch, CURLOPT_POST, 1);//设置请求方式POST
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "PUT"); // 设置请求方式
		curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);//请求所带变量数据
		$result = curl_exec($ch);//执行获取返回数据，返回的数据建议json_encode($return_data);
		curl_close($ch);
		return $result;
	}
	
	public function http_delete($url, $fields) {
		$ch = curl_init();//初始化curl
		curl_setopt($ch, CURLOPT_URL, $url);//设置请求地址
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);//返回值
		//curl_setopt($ch, CURLOPT_POST, 1);//设置请求方式POST
		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "DELETE"); // 设置请求方式
		curl_setopt($ch, CURLOPT_POSTFIELDS, $fields);//请求所带变量数据
		$result = curl_exec($ch);//执行获取返回数据，返回的数据建议json_encode($return_data);
		curl_close($ch);
		return $result;
	}
	
	/**************************************************************
     *  生成指定长度的随机码。
     *  @param int $length 随机码的长度。
     *  @access public
     **************************************************************/
    function createRandomCode($length)
    {
        $randomCode = "";
        $randomChars = '0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZ';
        for ($i = 0; $i < $length; $i++)
        {
            $randomCode .= $randomChars { mt_rand(0, 35) };
        }
        return $randomCode;
    }
	
	// 检查是否直接访问本页面
	static public function CheckPostReferer() {
		if (isset ( $_SERVER ['HTTP_REFERER'] )) {
			$url_array = explode ( 'http://', $_SERVER ['HTTP_REFERER'] );
			$url = explode ( '/', $url_array [1] );
			if (false !== strpos ( $url [0], ':' )) 			// 修改端口判断
			{
				$url [0] = substr ( $url [0], 0, strpos ( $url [0], ':' ) );
			}
			if ($_SERVER ['SERVER_NAME'] != $url [0]) {
				return false;
			} else {
				return true;
			}
		} else {
			return false;
		}
	}
	
	/**
	 * 获取当前页面完整URL地址
	*/
	function get_url() {
		$sys_protocal = isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] == '443' ? 'https://' : 'http://';
		$php_self = $_SERVER['PHP_SELF'] ? $_SERVER['PHP_SELF'] : $_SERVER['SCRIPT_NAME'];
		$path_info = isset($_SERVER['PATH_INFO']) ? $_SERVER['PATH_INFO'] : '';
		$relate_url = isset($_SERVER['REQUEST_URI']) ? $_SERVER['REQUEST_URI'] : $php_self.(isset($_SERVER['QUERY_STRING']) ? '?'.$_SERVER['QUERY_STRING'] : $path_info);
		return $sys_protocal.(isset($_SERVER['HTTP_HOST']) ? $_SERVER['HTTP_HOST'] : '').$relate_url;
	}
	
}
?>
