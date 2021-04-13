@extends('common.layout')
@section('title','修改密码')
@section('content')
    <h2>修改密码</h2>
    <form>
        <div class="input_dl">
            <input type="hidden" name="_token" value="{{csrf_token()}}">
            <input type="hidden" name="id" id="id" value="{{$user->id}}">
            <div>
                <label for="password">密码</label>
                <input type="password" name="password" id="password">
            </div>
            <div>
                <label for="password_confirm">确认密码</label>
                <input type="password" name="password_confirmation" id="password_confirmation">
            </div>
            <div>
                <input class="btn_p" type="button" onclick="editUser()" value="提交">
            </div>
        </div>
    </form>
    <script>
        function editUser(){
            data={
                "id":$("#id").val(),
                "password":$("#password").val(),
                "password_confirmation":$("#password_confirmation").val(),
                "_token":"{{csrf_token()}}"
            };
            $.post('/adm/user/edit-user',data,function(res){
                if(res.success){
                    alert(res.msg);
                    location.href="/adm/user";
                }else
                    alert(res.msg);
            },'json')
        }
    </script>
@endsection