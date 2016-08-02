@extends('app')

@section('css')
@endsection

@section('content')
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-3 col-md-2 sidebar">
        <ul class="nav nav-sidebar">
          <li :class="(searching.user_type == '未兑换卡券')?'active':''" @click="choose_data" id="unfilled"><a
            href="#unfilled">未兑换卡券</a></li>
          <li :class="(searching.user_type == '已兑换卡券')?'active':''" @click="choose_data" id="filled"><a href="#filled">已兑换卡券</a>
          </li>
          <li :class="(searching.user_type == '所有卡券')?'active':''" @click="choose_data" id="all"><a href="#all">所有卡券</a>
          </li>
        </ul>
      </div>
      <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main" v-cloak>
        <h2 class="sub-header">@{{ searching.user_type }}<span v-if="searched" class="small">(@{{ searched }})</span></h2>

        <div class="table-responsive">
          <table class="table table-striped table-hover">
            <thead>
            <tr>
              <th>卡号</th>
              <th>密码</th>
              <th>使用状态</th>
              <th>兑换状态</th>
              <th>兑换人</th>
              <th>兑换人电话</th>
              <th>购买时间</th>
              <th>
                <button class="button button-tiny button-action" data-toggle="modal" data-target="#myModal">添加卡券</button>
              </th>
            </tr>
            </thead>
            <tbody>
            <tr v-cloak v-for="card in page_data">
              <td>@{{ order.id }}</td>

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
  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="col-sm-12">
        <div class="modal-content" id="user_card">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel1">添加卡券</h4>
          </div>
          <div class="modal-body">
            <form class="form-horizontal">
              <br>

              <div class="col-sm-6">
                <div class="form-group">
                  <label for="inputCards" class="control-label sr-only">姓名</label>

                  <div class="col-sm-12">
                  <textarea type="text" class="form-control" rows="30" id="inputCards"
                            placeholder="请输入卡号密码 ,例：卡号：JDV8000000000001 密码：000-0000-0000-0000"
                            v-model="input">
                  </textarea>
                  </div>
                </div>
              </div>
              <div class="col-sm-6">
                <table class="table table-striped table-hover">
                  <thead>
                  <tr>
                    <th>#</th>
                    <th>卡号</th>
                    <th>密码</th>
                  </tr>
                  </thead>
                  <tbody>
                  <tr v-cloak v-for="card in cards">
                    <td>{{ $index +   1 }}</td>
                    <td>{{ card.no }}</td>
                    <td>{{ card.password }}</td>
                  </tr>
                  </tbody>
                </table>
              </div>
              <div class="clearfix"></div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">取消</button>
            <button type="button" class="btn btn-primary" @click="addCards">添加</button>
          </div>
        </div>
      </div>

    </div>
  </div>
@endsection

@section('js')
  <script src="{{asset('/js/backend/gift-card.js')}}"></script>
@endsection