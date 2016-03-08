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


@foreach($months as $month)
  <div class="weui_cells weui_cells_access" id="month">
    {{--<a class="weui_cell" href="/personal/beans/?month={{$month}}">--}}
    <a class="weui_cell" href="javascript:void(0);" onclick="getBeans('{{$month}}')">
      <div class="weui_cell_bd weui_cell_primary">
        <p>{{$month}}月账单</p>
      </div>
      <div class="weui_cell_ft">
      </div>
    </a>
  </div>
  <div class="weui_cells ajax"  style="margin-top: -1px" id="{{$month}}">
  @if($date == $month)
      @foreach($beans as $item)
        <div class="weui_cell">
          <div class="weui_cell_hd"><img src="{{$item['icons']}}" alt="" class="image"></div>
          <div class="weui_cell_bd weui_cell_primary">
            <p class="time">{{$item['day']}}<br>{{$item['time']}}</p>
          </div>
          <div class="weui_cell_ft">{{$item['result']}}&nbsp;丨{{$item['action']}}</div>
        </div>
      @endforeach
  @endif
  </div>

@endforeach

<script src="{{asset('/js/vendor/jquery-2.1.4.min.js')}}"></script>
<script type="text/javascript">
  function getBeans(month) {
    $(function () {
      var requestUrl = '/personal/get-beans-by-month';
      $.ajax({
        url: requestUrl,
        data: {
          month: month
        },
        type: "get",
        dataType: "json",
        success: function (json) {
            $("#month").siblings(".ajax").css({display: 'none'});
            $("#"+month).css({display: 'block'});
            strHtml = '';
            $(json.beans).each(function () {
              strHtml +=  "<div class='weui_cell'><div class='weui_cell_hd'><img src='"+ this.icons +"' class='image'></div><div class='weui_cell_bd weui_cell_primary'><p class='time'>"+ this.day +"<br>"+ this.time + "</p></div><div class='weui_cell_ft'>"+ this.result+"&nbsp;丨"+ this.action+"</div></div>";
            });
            $("#" + month).html(strHtml);
        },
        error: function (xhr, status, errorThrown) {
        //console.log("Sorry, there was a problem!");
        }
      });

    });
  }


  function updateView(id) {
    document.getElementById('text_click').value ='1';
    document.getElementById('text_id').value = id;
    $(function () {
      var requestUrl = '/education/article/update-count';
      $.ajax({
        url : requestUrl,
        data: {
          id: id
        },
        type : "get",
        dataType : "json",
        success: function (json) {

        },
        error: function (xhr, status, errorThrown) {
          alert("Sorry, there was a problem!");
        }
      });
    });

    window.location.href = '/education/article/view?type=1&id='+id;
  }

  function reLoad() {
    var flag = document.getElementById('text_click').value;
    var id = document.getElementById('text_id').value;
    if(flag=='1') {
      window.location.href = '/education/article';
    }
  }
</script>


</body>
</html>