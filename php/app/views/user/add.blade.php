@extends('common.layout')
@section('title','添加管理员')
@section('content')
    <h2>添加新管理</h2>
    <form>
        <div class="input_dl">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
        <div>
            <label for="username">用户名</label>
            <input type="text" name="username" id="username">
        </div>
        <div>
            <label for="email">邮箱</label>
            <input type="text" name="email" id="email">
        </div>
        <div>
            <label for="password">密码</label>
            <input type="password" name="password" id="password">
        </div>
        <div>
            <label for="password_confirm">确认密码</label>
            <input type="password" name="password_confirmation" id="password_confirmation">
        </div>
        <div>
            <input class="btn_p" type="button" onclick="addUser()" value="提交">
        </div>
        </div>
    </form>
    <script>
        function addUser(){
                data={
                    "username": $("#username").val().trim(),
                    "email": $("#email").val().trim(),
                    "password":$("#password").val(),
                    "password_confirmation":$("#password_confirmation").val(),
                    "_token":"{{csrf_token()}}"
                };
                $.post('/adm/user/add-user',data,function(res){
                    if(res.success){
                        alert(res.msg);
                        location.href="/adm/user";
                    }else
                        alert(res.msg);
                },'json')
        }
    </script>
@endsection