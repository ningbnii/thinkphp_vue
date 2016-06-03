<?php
namespace app\index\controller;
use app\index\model\Wxuser;
use think\Cache;

class WxuserController extends BaseController{
	public function __construct(){
		$this->checkLogin();
	}

	public function add(){
		if(Wxuser::create(input('post.'))){
			return $this->success('添加成功');
		}else{
			return $this->error('添加失败');
		}
	}

	public function getAll(){
		$data = Wxuser::all(['uid'=>input('post.uid')]);
		return $data;
	}
}