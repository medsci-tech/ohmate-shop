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

@foreach($beans as $key => $month)
  <div class="weui_cells_title">{{$year}}年{{$key}}月账单</div>

  <div class="weui_cells">
    @foreach($month as $item)
      <div class="weui_cell">
        <div class="weui_cell_hd"><img src="{{$item['icons']}}" alt="" class="image"></div>
        <div class="weui_cell_bd weui_cell_primary">
          <p class="time">{{$item['day']}}<br>{{$item['time']}}</p>
        </div>
        <div class="weui_cell_ft">{{$item['result']}}&nbsp;丨{{$item['action']}}</div>
      </div>
    @endforeach
  </div>
@endforeach

</body>
</html>