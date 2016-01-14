<!DOCTYPE html>
<html>
<head lang="en">
    <meta charset="UTF-8">
    <title>用户注册</title>
    <script type="text/javascript">
        function validateMobile() {
            var mobile = document.getElementById('phone').value;
            var code = document.getElementById('code').value;
            if (mobile.length == 0) {
                document.getElementById('label_phone').innerText = '请输入手机号码！';
                document.getElementById('phone').focus();
                return false;
            }
            if (mobile.length != 11) {
                document.getElementById('label_phone').innerText = '请输入有效的手机号码！';
                document.getElementById('phone').focus();
                return false;
            }

            var myreg = /^(((13[0-9]{1})|(15[0-9]{1})|(18[0-9]{1}))+\d{8})$/;
            if (!myreg.test(mobile)) {
                document.getElementById('label_phone').innerText = '请输入有效的手机号码！';
                document.getElementById('phone').focus();
                return false;
            }

        }

        function validateAll() {
            if (!validateMobile()) {
                return false;
            }

            if (code.length == 0) {
                document.getElementById('label_code').innerText = '请输入验证码！';
                document.getElementById('code').focus();
                return false;
            }

            if (code.length != 6) {
                document.getElementById('label_code').innerText = '请输入有效的验证码！';
                document.getElementById('code').focus();
                return false;
            }

            if (isNaN(code)) {
                document.getElementById('label_code').innerText = '请输入有效的验证码！';
                document.getElementById('code').focus();
                return false;
            }

            return true;
        }
        
        function turnTo() {
            if (validateMobile()) {
                var mobile = document.getElementById('phone').value;
                window.location.href = '/sms?phone=' + mobile;
            }
        }
    </script>
</head>
<body>
<form action="{{url('/register/store')}}" method="POST">
    {{csrf_field()}}
    <p>
        <span>输入手机号</span>
        <br>
        <input id="phone" name="phone" type="text">
        <label id="label_phone" for="phone"></label>
        </label>
    </p>
    <p>
        <span>输入验证码</span>
        <br>
        <input id="code" name="code" type="text">
        <label id="label_code" for="code"></label>
        </label>
    </p>
    <p><input type="submit" value="确定"></p>
    <p><input type="button" value="获取短信验证码" onclick='turnTo();'/></p>
</form>
</body>
</html>
