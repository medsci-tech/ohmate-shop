<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>调查问卷</title>
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
  <title>易康伴侣-上传医生表单</title>
  <link rel="shortcut icon" href="/favicon.ico">
  <link rel="stylesheet" href="{{asset('/')}}css/bootstrap.min.css">
  <link rel="stylesheet" href="{{asset('/')}}vendor/bootstrap-theme/bootstrap-theme-paper.min.css">


</head>
<body>
<div class="container">
  <br>
  <div class="panel panel-default">
    <div class="panel-heading">医生信息Excel上传</div>
    <div class="panel-body">
      <form class="form-horizontal" action="" enctype="multipart/form-data" method="post">
        {{csrf_field()}}
        <div class="form-group">
          <label class="col-sm-2 control-label" for="doctor-information">请选择Excel</label>

          <div class="col-sm-8">
            <input class="form-control" type="file" name="doctor-information" id="doctor-information">
          </div>
        </div>

        <div class="form-group">
          <div class="col-sm-offset-2 col-sm-10">
            <button class="btn btn-default" type="submit">提交</button>
          </div>
        </div>
      </form>
    </div>
  </div>
</div>

</body>
</html>

