@extends('main')

@section('css')
  <style>
    .biaozhi {
      font-size: 40px;
    }
  </style>
@endsection

@section('content')
  <div class="container text-center">
    <br>
    <br>
    <i class="biaozhi text-warning glyphicon glyphicon-info-sign"></i>
    <br>
    <br>

    <p>感谢您填写调查问卷！</p>

    <p>根据您的注射习惯，<br>建议您学习安全注射的知识</p>
    <br>
    <button type="button" style="margin: auto" id="button_bad"
            class="button button-block button-large button-rounded button-caution">
      去学习安全注射知识
    </button>
    <br>
  </div>
@endsection