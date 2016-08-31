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
        $user=$wechat->user;
        $wechat->server->setMessageHandler(function($message) use ($user){
                switch ($message->MsgType) {
                case 'event':
                    return "您好！莫荣辉测试公众号。";
                    break;
                case 'text':
                    return '你好'.$user->get($message->FromUserName)->nickname.',你发送的内容是：'.$message->Content;
                    break;
                case 'image':
                    $users=$user->lists();                   
                    return $users;
                    break;
                case 'voice':
                    return '语音消息';
                    break;
                case 'video':
                    return '视频消息';
                    break;
                default:
                    return 'default';
                    break;
            }
        });
        return $wechat->server->serve();
    }
}
