<?php
namespace app\index\model;
use think\Model;

class Wxuser extends Model{
	// 定义需要自动写入时间戳格式的字段
	protected $autoTimeField = ['createtime','updatetime'];

	protected $auto = ['updatetime'];

	protected $insert = ['createtime'];
}