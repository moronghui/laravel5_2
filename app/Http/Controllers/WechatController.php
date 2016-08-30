<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Http\Requests;

class WechatController extends Controller
{
    //
    /**
     * 处理微信的请求消息
     *
     * @return string
     */
    public function serve()
    {

        $wechat = app('wechat');
        $wechat->server->setMessageHandler(function($message){
            return "欢迎关注莫荣辉测试公众号";
        });
        return $wechat->server->serve();
    }
}
