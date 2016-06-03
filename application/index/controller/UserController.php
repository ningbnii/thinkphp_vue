<?php
namespace app\index\controller;
use app\index\model\User;
use think\Cache;

class UserController extends BaseController{
	public function login(){
		$username = input('post.username');
		$password = input('post.password');
		$user = User::get(['username'=>$username]);
		if($user['password'] == md5($password)){
			$userCache = ['uid'=>$user['id'],'time'=>time(),'key'=>md5($user['id'].'_'.time().'_wxbuluo')];
			Cache::set('uid_' . $user['id'], serialize($userCache), 3600);
			return $this->success($userCache);
		}else{
			return $this->error('用户名或密码错误');
		}
	}
}