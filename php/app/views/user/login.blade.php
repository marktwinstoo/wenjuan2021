<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<!-- saved from url=(0034)http://ysxdn.kydev.net/kyadmin.php -->
<html xmlns="http://www.w3.org/1999/xhtml"><head><meta http-equiv="Content-Type" content="text/html; charset=UTF-8">

    <title>登录</title>
    <link rel="stylesheet" type="text/css" href="/assests/css/bayer.css">
    <script type="text/javascript" src="/assests/js/jquery-1.7.2.min.js">
    </script>
</head>
<body>
<div class="f_dl">
    <div class="f_top">
        <p> </p>
        <div class="f_title"><span>赛诺菲文献满意度调查问卷</span><br><span style="margin-left: 200px;">网站后台管理系统</span></div>
    </div>
    <div class="page_center">
        <div class="dl_box">
            <div class="input_dl">
                <form name="myform">
                    <input type="hidden" id="_token" name="_token" value="{{csrf_token()}}">
                    <div class="dl_one"><label>用户名：</label><input type="text" name="username" id="username" required autofocus></div>
                    <div class="dl_two"><label>密  码：</label><input type="password" name="password" id="password" required></div>
                    <div class="dl_btn">
{{--                     method="post" action="login"   <input type="hidden" name="cookietime" value="0">--}}
{{--                        <input type="hidden" name="forward" value="?">--}}
                        <input name="dosubmit" type="button" value="登录" class="btn_p" onclick="login()">
                        <input type="reset" name="reset" class="btn_p" value="重置">
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="page_footer">
        <div class="page_footer_bd"></div>
    </div>
</div>
<script type="text/javascript">
    function login()
    {
        data={
          'username':$("#username").val(),
          'password':$("#password").val(),
          '_token':$("#_token").val(),
        };
        $.post('/login',data,function(res){
            alert(res.msg);
            if(res.success)
                location.href="/adm";
            else
                location.reload();
        },'json');
    }
</script>
</body></html>