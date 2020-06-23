<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>注册页面</title>
    <link rel="stylesheet" href="/static/css/bootstrap.min.css">
    <script src="/static/js/jquery.min.js"></script>
    <script src="/static/js/bootstrap.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token()}}">
</head>
<body>
<center>已有账号？进行<a href="{{url('/user/login')}}" class="btn btn-info">登陆</a></center>
<center><h2>注册页面</h2></center>
<form class="form-horizontal" role="form" method="post" action="{{url('user/regdo')}}">
    @csrf
    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">用户名</label>
        <div class="col-sm-5">
            <input type="text" class="form-control" id="user_name" name="user_name" placeholder="请输入用户名"><b style="color: red">{{$errors->first('user_name')}}</b>
        </div>
    </div>
    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">邮箱</label>
        <div class="col-sm-5">
            <input type="text" class="form-control" id="email" name="email" placeholder="请输入邮箱"><b style="color: red">{{$errors->first('email')}}</b>
        </div>
    </div>
    <div class="form-group">
        <label for="lastname" class="col-sm-2 control-label">密码</label>
        <div class="col-sm-5">
            <input type="password" class="form-control" id="password" name="password" placeholder="请输入密码"><b style="color: red">{{$errors->first('password')}}</b>
        </div>
    </div>
    <div class="form-group">
        <label for="lastname" class="col-sm-2 control-label">确认密码</label>
        <div class="col-sm-5">
            <input type="password" class="form-control" id="password2" name="password2" placeholder="请确认密码">
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-5">
            <input type="submit" value="注册" id="but">
        </div>
    </div>
</form>
</body>
</html>