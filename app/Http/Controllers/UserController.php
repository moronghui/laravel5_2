<?php

namespace App\Http\Controllers;

use EasyWeChat\Foundation\Application;
use Illuminate\Http\Request;

use App\Http\Requests;

class UserController extends Controller
{
    //
    public $wechat;

    public function __construct(Application $wechat){
    	$this->wechat=$wechat;
    }

    public function users()
    {
    	$users=$this->wechat->user->lists();
    	return $users;
    }

    public function user($openId)
    {
    	$user=$this->wechat->user->get($openId);
    	return $user;
    }

    public function remark()
    {
    	$this->wechat->remark("", "修改备注");
    	return '修改成功';
    }
}
