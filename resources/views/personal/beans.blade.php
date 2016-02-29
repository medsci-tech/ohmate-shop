<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=no">
  <title>迈豆钱包</title>
  <link rel="stylesheet" href="/css/weui.min.css">
  <link rel="stylesheet" href="/css/member.css">
</head>
<body>

@foreach($items as $key => $d1)
  <div class="weui_cells_title">{{$year}}年{{$key}}月账单</div>

  <div class="weui_cells">
    @foreach($d1[$key] as $index)
      <div class="weui_cell">
        <div class="weui_cell_hd"><img src="{{$index['icons']}}" alt="" class="image"></div>
        <div class="weui_cell_bd weui_cell_primary">
          <p class="time">{{$index['day']}}<br>{{$index['time']}}</p>
        </div>
        <div class="weui_cell_ft">{{$index['result']}}&nbsp;丨{{$index['action']}}</div>
      </div>
    @endforeach
  </div>
@endforeach

</body>
</html>