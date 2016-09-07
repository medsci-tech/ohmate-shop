@extends('questionnaire.main2')

@section('css')
  <style>
    body {
      font-family: "Microsoft YaHei UI", "Helvetica Neue", Helvetica, Arial, sans-serif;
      color: #fff;
      font-size: 16px;
    }

    .btn {
      border-radius: 8px;
      padding: 10px;
      font-size: 16px;
      border: none;
    }

    .background-img {
      width: 100%;
      height: 100%;
      position: fixed;
      top: 0;
      left: 0;
      background-color: rgb(140, 207, 239);
    }

    a:focus, a:hover {
      text-decoration: none;
    }

    label {
      font-weight: normal;
      width: 100%;
    }

    .question-number {
      margin-bottom: -5px;
    }

    .question-number div {
      width: 55px;
      height: 55px;
      padding-top: 6px;
      margin: auto;
      margin-bottom: -10px;
      font-size: 20px;
      font-weight: bold;
      background-color: #30a7df;
      border: 5px solid #30a7df;
      border-radius: 100%;
    }

    .question-name {
      padding: 20px 20px 30px 20px;
      background: url(/image/questionnaire/蓝色彩带.png) no-repeat center;
      background-size: cover;
      font-size: 16px;
    }

    .question-line {
      width: 100%;
      margin: -40px 0 -30px 0;
    }

    .container {
      padding: 15px;
      margin: 15px;
      background-color: rgba(47, 168, 255, 0.5);
      border-radius: 10px;
    }

  </style>
@endsection

@section('content')
  <div>
    <img class="background-img" src="/image/questionnaire/背景-2.png" alt="">
  </div>
  <div style="position: relative">
    <br>

    <div class="text-center question-number">
@if($result == '2')
      <div><img style="width: 100%" src="/image/questionnaire/诺和笔.png" alt=""></div>
@else
      <div><img style="width: 100%" src="/image/questionnaire/糖果.png" alt=""></div>
@endif
    </div>

    <p class="text-center question-name">
      <span>立即参与换购，乐享好礼！</span>
    </p>
    <img class="question-line" src="/image/questionnaire/线.png" alt="">

    <div class="container" style="background-color: rgba(47, 168, 255, 0.8);">

      <p style="font-color: #aaa; font-size: 14px; text-align: center">
@if($result == 2)
        <span style="text-align: left">一次性使用针头才能有效保证胰岛素治疗效果，重复使用针头存在诸多安全隐患，并可能严重影响治疗效果！<br><br></span>
@endif
        感谢您参与问卷，<br>
        良好的用药习惯对您的身体有很大帮助，<br>
        请保持!
      </p>

      <img style="width: 60%; margin: 10px 20%;" src="/image/questionnaire/礼品.png" alt="">

    </div>
    <div class="col-xs-12">
      <a href="/shop/yiyuan-index" type="button" class="btn btn-primary btn-block">
      点击换购
      </a>
    </div>
    <br><br><br>
  </div>
@endsection