<!DOCTYPE html>
<html lang="en" xmlns:v-bind="http://www.w3.org/1999/xhtml">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=no">
  <title>我的地址</title>
  <link rel="stylesheet" href="{{asset('/css/shop_rebuild.css')}}">
</head>

<body>
<div class="container" id="addresses">
  <div class="row">
    <template v-if=" addresses != null ">
      <div class="panel panel-default">
        <div class="panel-heading">地址列表</div>
        <ul class="list-group">
          <div class="clearfix"></div>
          <li class="list-group-item" v-bind:class=" address.is_default?'default-address':'' " v-for="address in addresses">
            <table class="table table-condensed">
            <tr>
              <th @click="chooseAdd(address)">收货人</th>
              <td @click="chooseAdd(address)">@{{ address.name }}</td>
              <td @click="chooseAdd(address)">@{{ address.phone }}</td>
              <td class="edit-icon"><i class="fa fa-close" @click="removeAdd(address)"></i></td>
            </tr>
            <tr>
              <th @click="chooseAdd(address)">收货地址<small v-bind:class=" address.is_default?'':'hide' "><br>(默认)</small></th>
              <td colspan="2" @click="chooseAdd(address)">@{{ address.province }}-@{{ address.city }}-@{{ address.district }}-@{{ address.address }}</td>
              <td class="edit-icon"><i class="fa fa-edit" @click="editAdd(address)"></i></td>
            </tr>
            </table>
          </li>
        </ul>
      </div>
    </template>
  </div>
  <div class="row">
    <div class="panel panel-default">
      <div class="panel-heading heading-toggle" id="heading_add">添加收货地址</div>
      <div class="hide panel-heading heading-toggle">修改收货地址</div>
      <form class="form-horizontal">
        <div class="form-group">
          <label class="col-xs-3 control-label" for="name">收货人</label>

          <div class="col-xs-9">
            <input required type="text" class="form-control" id="name" placeholder="收货人姓名" v-model="newAdd.name">
          </div>
        </div>
        <div class="form-group">
          <label class="col-xs-3 control-label" for="phone">手机号</label>

          <div class="col-xs-9">
            <input required type="text" class="form-control" id="phone" placeholder="收货人号码" v-model="newAdd.phone">
          </div>
        </div>
        <div class="form-group">
          <label class="col-xs-3 control-label" for="province">详细地址</label>

          <div class="col-xs-9">
            <select required class="form-control" name="province" id="province" v-model="newAdd.province"></select>
          </div>
        </div>
        <div class="form-group">
          <label class="col-xs-3 control-label" for="city"></label>

          <div class="col-xs-9">
            <select required class="form-control" name="city" id="city" v-model="newAdd.city"></select>
          </div>
        </div>
        <div class="form-group">
          <label class="col-xs-3 control-label" for="area"></label>

          <div class="col-xs-9">
            <select required class="form-control" name="area" id="area" v-model="newAdd.district"></select>
          </div>
        </div>
        <div class="form-group">
          <label class="col-xs-3 control-label" for="address"></label>

          <div class="col-xs-9">
            <input required type="text" class="form-control" id="address" placeholder="街道地址" v-model="newAdd.address">
          </div>
        </div>

        <div class="checkbox col-xs-offset-4">
          <label>
            <input type="checkbox" value="" v-model="newAdd.is_default">设为默认
          </label>
        </div>

        <div class="form-group text-center" id="button">
          <button class="button button-caution button-rounded" id="button_add" type="button" @click="addFun | debounce 1000">添&emsp;加</button>
          <button class="hide button button-primary button-border button-rounded" type="button" @click="editCancel">取消</button>
          <button class="hide button button-caution button-rounded" type="button" @click="editFun | debounce 1000">确认修改</button>
        </div>
      </form>
    </div>
    <br>
  </div>
</div>
</body>

<script src="{{asset('/js/vendor/jquery-2.1.4.min.js')}}"></script>
<script src="{{asset('/js/vendor/vue.js')}}"></script>
<script src="{{asset('/js/address.js')}}"></script>
<script src="{{asset('/js/vendor/city.js')}}"></script>
<script>
  $(function () {
    city_selector();
  });
</script>
</html>