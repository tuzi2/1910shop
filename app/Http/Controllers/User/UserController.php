<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\User;
use Illuminate\Support\Facades\Validator;
class UserController extends Controller
{
    //注册页面
    public function reg(){
        return view("user.reg");
    }
    //进行注册
    public function regdo(Request $request){
//        $data=request()->except('_token');
//        $validator = Validator::make($data,[
//            'user_name' => 'required|unique:user',
//            'password' => 'required',
//            'email' => 'required',
//        ],[
//            'user_name.required'=>'名字必填',
//            'user_name.unique'=>'名字已存在',
//            'password.required'=>'密码必填',
//            'email.required'=>'邮箱必填',
//        ]);
//        if ($validator->fails()){
//            return redirect('user/reg')
//                ->withErrors($validator)
//                ->withInput();
//        }
        $password1 = $request->input("password");
        $password2 = $request->input("password2");
        $user_name = $request->input("user_name");
        $email = $request->input("email");
        //密码长度是否大于6
        $len = strlen($password1);
        if($len<6){
            die("密码长度必须大于6");
        }
        //密码是否一致
        if($password1 != $password2)
        {
            die("两次输入的密码不一致");
        }
        //检查用户是否已存在
        $res = User::where(['user_name'=>$user_name])->first();
        if($res){
            die("用户已存在");
        }
        //生成密码
        $password1=password_hash($password1,PASSWORD_BCRYPT);
        $data = [
            'user_name' =>$user_name,
            'email' =>$email,
            'password' =>$password1,
        ];
        $res=User::insert($data);
        //var_dump($res);
        if($res){
            return redirect('/user/login');
        }
    }
    //登录页面
    public function login(){
        return view("user.login");
    }
    //登录
    public function logindo(Request $request){
        $user_name = $request->input('user_name');
        $password = $request->input('password');
        //验证登录信息
        $user =User::where(['user_name'=>$user_name])->first();
        //验证密码
        $res = password_verify($password,$user->password);
        if($res){
            echo "登录成功";
        }else{
            echo "登录失败";
        }
    }
}
