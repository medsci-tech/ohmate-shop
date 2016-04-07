@extends('app')

@section('css')
@endsection

@section('content')
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-3 col-md-2 sidebar">
        <ul class="nav nav-sidebar">
          <li :class="(searching.user_type == '未发货订单')?'active':''" @click="choose_data" id="unfilled"><a href="#unfilled">未发货订单</a></li>
          <li :class="(searching.user_type == '已发货订单')?'active':''" @click="choose_data" id="filled"><a href="#filled">已发货订单</a></li>
          <li :class="(searching.user_type == '所有订单')?'active':''" @click="choose_data" id="all"><a href="#all">所有订单</a></li>
        </ul>
      </div>
      <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main" v-cloak>
        <h2 class="sub-header">@{{ searching.user_type }}<span v-if="searched" class="small">(@{{ searched }})</span></h2>
        <div class="table-responsive">
          <table class="table table-striped table-hover">
            <thead>
            <tr>
              <th>订单ID</th>
              <th>EMS单号</th>
              <th>订单商品</th>
              <th>收货人姓名</th>
              <th>收货人电话</th>
              <th>收货人地址</th>
              <th>下单时间</th>
              <th>发货状态</th>
              <th></th>
            </tr>
            </thead>
            <tbody>
            <tr v-cloak v-for="order in page_data">
              <td>@{{ order.id }}</td>
              <td>
                <span v-if="order.order_status_id == 3">EMS@{{ order.post_no }}</span>
                <span v-if="order.order_status_id == 2">未发货</span>
              </td>
              <td>
                <ul class="list-unstyled" style="margin-bottom: 0px;">
                  <li v-for="item in order.commodities">@{{ item.name }}&emsp;x&emsp;@{{ item.pivot.amount }} </li>
                </ul>
              </td>
              <td>
                @{{ order.address.name }}
              </td>
              <td>
                @{{ order.address.phone }}
              </td>
              <td>
                @{{ order.address.province }}-@{{ order.address.city }}-@{{ order.address.district }}-@{{ order.address.address }}
              </td>
              <td>
                @{{ order.created_at }}
              </td>
              <td>
                <div class="dropdown" v-if="order.order_status_id == 2">
                  <button class="button button-tiny button-rounded button-border button-primary" id="@{{ order.id }}" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    填写单号
                  </button>
                  <form class="dropdown-menu" role="form" aria-labelledby="@{{ order.id }}">
                    <div class="form-group">
                      <label for="post_no">请填写EMS单号</label>
                      <input type="text" id="number" class="form-control" placeholder="请输入单号" value="@{{ this_order.post_no }}" name="post_no" required autofocus>
                    </div>
                    <button class="button button-rounded button-primary button-small" type="button" @click="fill_order(order)">确认</button>
                  </form>
                </div>
                <button v-if="order.order_status_id == 3" class="button button-tiny button-rounded" disabled>
                  已发货
                </button>
              </td>
              <td v-if="false">
                <button class="button button-tiny button-rounded button-action" href="#" @click="print">
                打印
                </button>
              </td>
            </tr>
            </tbody>
          </table>
        </div>
        <nav class="text-center col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 col-xs-12" id="pagination">
          <ul class="pagination" @click="choose_page">
          <li v-if="page_active > 1">
            <a href="#" aria-label="Previous" name="pre">
              &laquo;
            </a>
          </li>
          <li v-if="page_show > 1">
            <a href="#" aria-label="Previous5" name="pre5">
              &hellip;
            </a>
          </li>
          <li :class="(page_active == page_show)?'active':''"><a href="#">@{{page_show}}</a></li>
          <li :class="(page_active == page_show+1)?'active':''" v-if="(page_show+1)<=page_all"><a
              href="#">@{{ page_show+1 }}</a></li>
          <li :class="(page_active == page_show+2)?'active':''" v-if="(page_show+2)<=page_all"><a
              href="#">@{{ page_show+2 }}</a></li>
          <li :class="(page_active == page_show+3)?'active':''" v-if="(page_show+3)<=page_all"><a
              href="#">@{{ page_show+3 }}</a></li>
          <li :class="(page_active == page_show+4)?'active':''" v-if="(page_show+4)<=page_all"><a
              href="#">@{{ page_show+4 }}</a></li>
          <li v-if="(page_show+5)<=page_all">
            <a href="#" name="next5" aria-label="Next5">
              &hellip;
            </a>
          </li>
          <li v-if="page_active < page_all">
            <a href="#" aria-label="Next" name="next">
              &raquo;
            </a>
          </li>
          </ul>
        </nav>
      </div>
    </div>
  </div>
  <!-- Modal -->
  <div v-if="false" class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="col-sm-12">
        <div class="modal-content" id="user_card">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel1">订单: @{{  }}</h4>
          </div>
          <div class="modal-body">
            <form class="form-horizontal">
              <br>
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">姓名</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control sr-only" id="inputEmail3" placeholder="请输入姓名"
                           v-model="this_person.name">

                    <p class="form-control-static">@{{  }}</p>
                  </div>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="invited" class="col-sm-3 control-label">糖友数</label>
                  <div class="col-sm-8">
                    <input type="number" class="form-control sr-only disabled" id="invited" placeholder="邀请糖友数" disabled
                           v-model="this_person.invited.count">

                    <p class="form-control-static">@{{  }}</p>
                  </div>
                </div>

              </div>
              <div class="clearfix"></div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
            <button type="button" class="btn btn-primary" @click="print">打印</button>
            {{--<button type="button" class="btn btn-primary" @click="edit_btn">编辑</button>--}}
            <button type="button" class="btn btn-default hide" @click="cancel_edit">取消</button>
            <button type="button" class="btn btn-warning hide" @click="submit_edit">确认</button>
          </div>
        </div>
      </div>

    </div>
  </div>
@endsection

@section('js')
  <script src="{{asset('/js/vendor/city.js')}}"></script>
  <script src="{{asset('/js/backend/order.js')}}"></script>
@endsection