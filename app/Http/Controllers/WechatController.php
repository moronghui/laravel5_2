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
        $material=$wechat->material_temporary;
        $wechat->server->setMessageHandler(function($message) use ($user){
                switch ($message->MsgType) {
                case 'event':
                    return "您好！莫荣辉测试公众号。";
                    break;
                case 'text':
                    //菜单
                    $menu = $wechat->menu;
                    $buttons = [
                        [
                            "type" => "click",
                            "name" => "今日歌曲",
                            "key"  => "V1001_TODAY_MUSIC"
                        ],
                        [
                            "name"       => "菜单",
                            "sub_button" => [
                                [
                                    "type" => "view",
                                    "name" => "搜索",
                                    "url"  => "http://www.soso.com/"
                                ],
                                [
                                    "type" => "view",
                                    "name" => "视频",
                                    "url"  => "http://v.qq.com/"
                                ],
                                [
                                    "type" => "click",
                                    "name" => "赞一下我们",
                                    "key" => "V1001_GOOD"
                                ],
                            ],
                        ],
                    ];
                    $menu->add($buttons);
                    //素材管理
                    /*$path=rtrim(app_path(),'/app').'/public/images/aa.png';
                    $image=$material->uploadImage($path);
                    return '类型：'.gettype($image);*/
                    //获取用户信息
                    /*$users=$user->lists();
                    if ($users!=''&&!is_null($users)) {
                        $data=$users->data;
                        $openid=$data['openid'];
                        return '用户个数：'.$users->data['openid'][0];
                    }
                    else{
                        return '无关注用户';
                    }*/
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
