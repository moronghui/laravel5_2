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
                    $users=$user->lists();
                    if ($users!=''&&!is_null($users)) {
                        $data=$users->data;
                        return '用户个数：'.gettype($data['openid']);
                    }
                    else{
                        return '无关注用户';
                    }
                    /*return '你好'.$user->get($message->FromUserName)->nickname.',你发送的内容是：'.$message->Content;*/
                    break;
                case 'image':
                    $users=$user->lists();
                    if ($users!=''&&!is_null($users)) {
                        return '用户个数：'.$users->total;
                    }
                    else{
                        return '无关注用户';
                    }
                   
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
