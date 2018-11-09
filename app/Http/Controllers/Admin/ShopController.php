<?php

namespace App\Http\Controllers\Admin;

use App\Models\Shop;
use App\Models\ShopCategory;
use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Storage;

class ShopController extends BaseController
{
    public function index()
    {
        $shops = Shop::paginate(4);
        return view("admin.shop.index", compact("shops"));
    }

    public function add(Request $request)
    {
        $cates = ShopCategory::all();
        $users = User::all();
        if ($request->isMethod('post')) {
            //验证
//            $this->validate($request,[
//                "name"=>"required",
//                "status"=>"required",
//                "sort"=>"required",
//                'img'=>"required"
//            ]);

            $data = $request->post();
//            $data['shop_img'] = $request->file("img")->store("images");
//            dd($data);
            Shop::create($data);
            return redirect()->route("admin.shop.index")->with("success", "添加成功");
        } else {
            return view("admin.shop.add", compact("cates", "users"));
        }
    }

    public function del($id)
    {
        $shop = Shop::find($id);
        if ($shop->delete()) {
            //删除原来图片
            @unlink($shop->shop_img);
            return redirect()->route("admin.shop.index");
        }

    }

    public function edit(Request $request, $id)
    {
        $shop = Shop::find($id);
        if ($request->isMethod('post')) {
            //验证
//            $this->validate($request,[
//                "name"=>"required",
//                "status"=>"required",
//                "sort"=>"required",
//                'img'=>"required"
//            ]);
            $data = $request->post();

            $img = $request->file("img");
            if ($img) {
                //删除原来图片
                @unlink($shop->shop_img);

//            dd($data);

//                $data['shop_img'] = $request->file("img")->store("images");
            }
            if ($shop->update($data)) {
                return redirect()->route("admin.shop.index");
            }
        } else {
            return view('admin.shop.edit', compact('shop'));
        }
    }

    public function examine($id)
    {
        $shop = Shop::find($id);
        //得到邮箱
        $email=$shop->user->email;
//        dd($email);
        //给该用户赋值为1
        $shop->status = 1;

        //保存
        if($shop->save()){

        //调用发送邮件函数
            //$content = 'test';//邮件内容
            $shopName="互联网学院";
            $to = $email;//收件人
            $subject = $shopName.' 审核通知';//邮件标题
            \Illuminate\Support\Facades\Mail::send(
                'admin.emails.shop',//视图
                compact("shopName"),//传递给视图的参数
                function ($message) use($to, $subject) {
                    $message->to($to)->subject($subject);
                }
            );

//            exit;
        }
        return redirect()->route("admin.shop.index");
    }

    public function upload(Request $request)
    {
        //处理上传

        //dd($request->file("file"));

        $file=$request->file("file");


        if ($file){
            //上传

            $url=$file->store("menu_cate");

            /// var_dump($url);
            //得到真实地址  加 http的址
            $url=Storage::url($url);

            $data['url']=$url;

            return $data;
            ///var_dump($url);
        }

    }
}
