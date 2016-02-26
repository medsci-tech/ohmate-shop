<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=no">
  <title>迈豆钱包</title>
  <link rel="stylesheet" href="/css/beans.css">
</head>
<body>
<div class="container">
  <div class="row ">
    <div id="beans-header">
      <h4 class="text-center"><span>{{$total}}</span>迈豆</h4>
    </div>
  </div>
  @foreach($list as $index)
  <div class="row">
    <div class="col-xs-3 text-center">
      <p>{{$list['time']}}</p>
    </div>
    <div class="media col-xs-9">
      <div class="media-left media-middle">
        <a href="#">
          <img class="media-object" src="../../image/shop_goods/7.png" alt="...">
        </a>
      </div>
      <div class="media-body">
        <h4 class="media-heading">+{{$list['result']}}</h4>

        <p>{{$list['action']}}</p>
      </div>
    </div>
  </div>
  @endforeach
</div>
</body>
</html>