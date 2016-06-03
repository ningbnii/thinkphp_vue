<?php
namespace app\index\controller;
use think\Cache;
class BaseController{
	public function __construct(){

	}
	/**
	 * 返回错误信息
	 * @author ning
	 * @DateTime 2016-05-12T16:59:54+0800
	 * @param    [type]                   $data [description]
	 * @return   [type]                         [description]
	 */
	protected function error($data){
		$uri = $_SERVER['REQUEST_URI'];
		if(strpos($uri, '?')){
			$uri = substr($uri, 1, strpos($uri, '?')-1);
		}else{
			$uri = substr($uri, 1, strlen($uri));
		}
		$uri = explode('/', $uri);
		if(intval($uri[0])){
			unset($uri[0]);
		}

		$uri = implode('/', $uri);
		return ['status'=>400, 'api'=>$uri, 'error'=>$data, 'data'=>null];
	}

	/**
	 * 返回正确的信息
	 * @author ning
	 * @DateTime 2016-05-13T14:06:35+0800
	 * @param    [type]                   $data [description]
	 * @return   [type]                         [description]
	 */
	protected function success($data){
		$uri = $_SERVER['REQUEST_URI'];
		if(strpos($uri, '?')){
			$uri = substr($uri, 1, strpos($uri, '?')-1);
		}else{
			$uri = substr($uri, 1, strlen($uri));
		}
		$uri = explode('/', $uri);
		if(intval($uri[0])){
			unset($uri[0]);
		}

		$uri = implode('/', $uri);
		return ['status'=>200, 'api'=>$uri, 'error'=>null, 'data'=>$data];		
	}

	/**
	 * 登陆信息校验
	 * @author ning
	 * @DateTime 2016-05-13T21:42:00+0800
	 * @return   [type]                   [description]
	 */
	protected function checkLogin(){
		$uid = input('post.uid');
		$key = input('post.key');
		if(!$uid || !$key){
			exit('登录信息校验失败');
		}
		$userCache = unserialize(Cache::get('uid_'.$uid));
		if(!$userCache || $userCache['key'] != $key){
			exit('登录信息校验失败');
		}
		unset($_POST['key']);
	}
}