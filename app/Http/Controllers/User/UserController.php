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
            //向客户端设置cookie
            setcookie('uid',$user->user_id,time()+3600,'/');
            setcookie('user_name',$user->user_name,time()+3600,'/');
            header('refresh:2;url=/user/center');
            echo "登录成功";
        }else{
            header('refresh:2;url=/user/login');
            echo "登录失败，请重新登陆";
        }
    }
    public function center(){
        //判断用户是否登陆
        //echo '<pre>';print_r($_COOKIE);echo '</pre>';
        if(isset($_COOKIE['uid']) && isset($_COOKIE['user_name'])){
            return view('user.center');
        }else{
            header('refresh:2;url=/user/login');
            echo "未登录，请登陆";
            //return redirect('/user/login');
        }
    }
}
