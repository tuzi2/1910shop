<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <title>登录页面</title>
    <link rel="stylesheet" href="/static/css/bootstrap.min.css">
    <script src="/static/js/jquery.min.js"></script>
    <script src="/static/js/bootstrap.min.js"></script>
    <meta name="csrf-token" content="{{ csrf_token()}}">
</head>
<body>
<center>还没注册？快进行<a href="{{url('/user/reg')}}" class="btn btn-info">注册</a></center>
<center><h2>登录页面</h2></center>
<form class="form-horizontal" role="form" method="post" action="{{url('user/logindo')}}">
    @csrf
    <div class="form-group">
        <label for="firstname" class="col-sm-2 control-label">用户名</label>
        <div class="col-sm-5">
            <input type="text" class="form-control" id="user_name" name="user_name" placeholder="请输入用户名">
        </div>
    </div>
    <div class="form-group">
        <label for="lastname" class="col-sm-2 control-label">密码</label>
        <div class="col-sm-5">
            <input type="password" class="form-control" id="password" name="password" placeholder="请输入密码">
        </div>
    </div>
    <div class="form-group">
        <div class="col-sm-offset-2 col-sm-5">
            <input type="submit" value="登录" id="but">
        </div>
    </div>
</form>
</body>
</html>