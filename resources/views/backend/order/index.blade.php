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
        <h2 class="sub-header">@{{ searching.user_type }}<span v-if="search" class="small">(@{{ searched }})</span></h2>
        <div class="table-responsive">
          <table class="table table-striped table-hover">
            <thead>
            <tr>
              <th>订单ID</th>
              <th>订单商品</th>
              <th>收货人姓名</th>
              <th>收货人地址</th>
              <th>下单时间</th>
              <th>发货时间</th>
              <th></th>
            </tr>
            </thead>
            <tbody>
            <tr v-cloak v-for="order in page_data">
              <td>@{{ order.id }}</td>
              <td>
                <ul>
                  <li v-for="item in order.commodities">@{{ item.name }}&emsp;x&emsp;@{{ item.pivot.amount }} </li>
                </ul>
              </td>
              <td>
                @{{ order.address.name }}
              </td>
              <td>
                @{{ order.address.province }}-@{{ order.address.city }}-@{{ order.address.district }}
              </td>
              <td>
                @{{ 2016-03-09 13:50:54 }}
              </td>
              <td>
                @{{  }}
              </td>
              <td>
                <button href="#" @click="fill_order">
                标记为已发货
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

                    <p class="form-control-static">@{{ this_person.name }}</p>
                  </div>
                </div>
              </div>
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="invited" class="col-sm-3 control-label">糖友数</label>
                  <div class="col-sm-8">
                    <input type="number" class="form-control sr-only disabled" id="invited" placeholder="邀请糖友数" disabled
                           v-model="this_person.invited.count">

                    <p class="form-control-static">@{{ this_person.invited.count }}</p>
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
  <script src="{{asset('/js/order.js')}}"></script>
@endsection