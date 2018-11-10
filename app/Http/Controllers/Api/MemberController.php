<?php

namespace App\Http\Controllers\Api;

use App\Models\Member;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redis;
use Mrgoon\AliSms\AliSms;

class MemberController extends BaseController
{
    public function reg(Request $request)
    {
$data=$request->post();
        //判定健壮性
//        $data= $this->validate($request, [
//            "username" => "required|unique:members",
//            "password" => "required|min:3",
//            "sms" => "required|integer|min:1000|max:999999",
//            "tel" => "required|unique:members",
//        ]);

//        dd($data);
        $id=Redis::get('tel_'. $data['tel']);
//        dd($id);
        $data['password']=bcrypt($data['password']);

        //对比验证码
        if($data['sms']==$id){
            //如果对，新建会员
            Member::create($data);
            $data=[
                "status"=> "true",
                "message"=> "注册成功"
            ];
            return $data;
        }else{
            //不对，提示验证码错误
            $data=[
                "status"=> "false",
                "message"=> "注册失败"
            ];
            return $data;
        }

    }

    public function sms(Request $request)
    {
        //接收参数
        $tel=$request->get("tel");
//        dd($tel);
        //随机生成验证码
        $code=mt_rand(1000,9999);
        //存验证码
//        Redis::set("tel_".$tel,$code);
//        Redis::expire("tel_".$tel,60*5);
        Redis::setex("tel_" . $tel, 5*60, $code);
//        Cache::set("tel_",$code,1);
        //4.把验证码发给手机号
        //TODO
        $config = [
            'access_key' => env("ALIYUNU_ACCESS_ID"),//appID
            'access_secret' => env("ALIYUNU_ACCESS_KEY"),//appKey
            'sign_name' => '技术文章分享',//签名
        ];
        $sms = new AliSms();

          $response = $sms->sendSms($tel, 'SMS_149417487', ['code'=> $code], $config);
        //5. 返回
        if($response->Code=='OK'){
            $data = [
                "status" => true,
                "message" => "获取短信验证码成功" . $code//$code调试用，记得删掉
            ];
        }else{
            $data = [
                "status" => false,
                "message" => "获取短信验证码错误" . $response->Message
            ];
        }

        return $data;
        
    }

    public function login()
    {
        //得到账号和密码
        $name=\request()->post('name');
        $password=\request()->password;
//        dd($name);
        //判断是否存在
        $member=Member::where("username",$name)->first();

//        dd($member);
        if($member && Hash::check($password,$member->password)){
            $data=[
                "status"=>"true",
                "message"=>"登录成功",
                "user_id"=>$member->id,
                "username"=>$name
            ];

            return $data;
        }else{

            $data=[
                "status"=>"false",
                "message"=>"登录失败",
                "user_id"=>"0",
                "username"=>$name
            ];
            return $data;
        }
    }

    public function wang(Request $request)
    {
        //判定健壮性
        $data= $this->validate($request, [
            "password" => "required|min:3",
            "sms" => "required|integer|min:1000|max:999999",
            "tel" => "required",
        ]);
        $tel=$data['tel'];
        //密码加密
        $data['password']=bcrypt($data['password']);

        $member=Member::where("tel",$tel)->first();
//        dd($member);
        $id=Redis::get("tel_".$data['tel']);
//        dd($id);

        if($data['sms']==$id){
            $member->update($data);
            $data=[
                "status"=> "true",
                "message"=> "修改成功"
            ];
            return $data;
        }else{
            $data=[
                "status"=> "false",
                "message"=> "修改失败"
            ];
            return $data;
        }

    }

    public function detail(Request $request)
    {
//        return 11;
        return Member::find($request->get("user_id"));


    }

    public function change(Request $request)
    {

        $id=$_POST['id'];
        //判定健壮性
        $data= $this->validate($request, [
            "oldPassword" => "required",
            "newPassword" => "required|min:3",
        ]);
        $member=Member::where("id",$id)->first();
        $password=$data['oldPassword'];
        $data['password']=bcrypt($data['newPassword']);
//        dd($member->password);
        if($member && Hash::check($password,$member->password)){
            //密码加密
            $member->update($data);
//            dd($member->password);
            $datal=[
                "status"=>"true",
                "message"=>"修改成功",
            ];

            return $datal;
        }else{

            $datal=[
                "status"=>"false",
                "message"=>"修改失败",
            ];
            return $datal;
        }

    }




}
