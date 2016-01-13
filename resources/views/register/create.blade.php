<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>用户注册</title>
    <script type="text/javascript">
        function validateMobile() {
            var mobile = document.getElementById('phone').value;
            if (mobile.length == 0) {
                document.getElementById('label').innerText = '请输入手机号码！';
                document.getElementById('phone').focus();
                return false;
            }
            if (mobile.length != 11) {
                document.getElementById('label').innerText = '请输入有效的手机号码！';
                document.getElementById('phone').focus();
                return false;
            }

            var myreg = /^(((13[0-9]{1})|(15[0-9]{1})|(18[0-9]{1}))+\d{8})$/;
            if (!myreg.test(mobile)) {
                document.getElementById('label').innerText = '请输入有效的手机号码！';
                document.getElementById('phone').focus();
                return false;
            }
            return true;
        }

        function turnTo() {
            if (validateMobile()) {
                var mobile = document.getElementById('phone').value;
                window.location.href = '/smsrequest?phone=' + mobile;
            }
        }
    </script>
</head>
<body>
<form action="{{url('/customer/store')}}" method="POST">
    {{csrf_field()}}
    <p>
        <span>输入手机号</span>
        <br>
        <input id="phone" name="phone" type="text">
        <label id="label" for="phone"></label>
        </label>
    </p>
    <p><input type="submit" value="确定"></p>
    <p><input type="button" value="获取短信验证码" onclick='turnTo();'/></p>
</form>
</body>
</html>
