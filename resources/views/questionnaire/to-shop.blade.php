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
    <i class="biaozhi text-success glyphicon glyphicon-heart-empty"></i>
    <br>
    <br>

    <p>感谢您填写调查问卷！</p>

    <p>您可以去积分商城逛逛</p>
    <br>
    <button type="button" style="margin: auto" id="button_good"
            class="button button-block button-large button-rounded button-action">
      去易康商城逛逛
    </button>
    <br>
  </div>
@endsection