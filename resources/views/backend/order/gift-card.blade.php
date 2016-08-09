@extends('app')

@section('css')
@endsection

@section('content')
  <div class="container-fluid">
    <div class="row">
      <div class="col-sm-3 col-md-2 sidebar">
        <ul class="nav nav-sidebar">
          {{--<li :class="(searching.user_type == '未兑换卡券')?'active':''" @click="choose_data" id="unfilled"><a--}}
          {{--href="#unfilled">未兑换卡券</a></li>--}}
          {{--<li :class="(searching.user_type == '已兑换卡券')?'active':''" @click="choose_data" id="filled"><a--}}
          {{--href="#filled">已兑换卡券</a>--}}
          {{--</li>--}}
          <li :class="(searching.user_type == '所有卡券')?'active':''" @click="choose_data" id="all"><a href="#all">所有卡券</a>
          </li>
        </ul>
      </div>
      <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 hide">
        <div style="margin-bottom: 0px;margin-top: 20px;" class="alert alert-warning alert-dismissible" role="alert">
          <button type="button" class="close" @click='hideAlert'><span>&times;</span></button>
          <strong id="response"></strong>
        </div>
      </div>
      <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2" v-cloak>
        <h2 class="sub-header">待审核申请<span v-if="searched" class="small">(@{{ searched }})</span>
        </h2>

        <div class="table-responsive">
          <table class="table table-striped table-hover">
            <thead>
            <tr>
              <th>#</th>
              <th>申请人id</th>
              <th>申请人昵称</th>
              <th>申请人手机号</th>
              <th>申请数量</th>
              <th>迈豆余额</th>
              <th colspan="2">审核</th>
            </tr>
            </thead>
            <tbody>
            <template v-cloak v-for="require in require_list">
              <tr>
                <td>@{{ require.require_id }}</td>
                <td>@{{ require.id }}</td>
                <td>@{{ require.name }}</td>
                <td>@{{ require.phone }}</td>
                <td>@{{ require.num }}</td>
                <td>@{{ require.beans_total }}</td>
                <td>
                  <button class="button button-primary button-tiny button-rounded" @click='pass(require)'>审核通过</button>
                </td>
                <td>
                  <button class="button button-highlight button-tiny button-rounded" @click='reject(require)'>审核不通过</button>
                </td>
              </tr>
            </template>
            </tbody>
          </table>
        </div>
      </div>
      <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main" v-cloak>
        <h2 class="sub-header">@{{ searching.user_type }}<span v-if="searched" class="small">(@{{ searched }})</span>
        </h2>

        <div class="table-responsive">
          <table class="table table-striped table-hover">
            <thead>
            <tr>
              <th>#</th>
              <th>卡号</th>
              <th>兑换状态</th>
              <th>兑换人</th>
              <th>兑换人电话</th>
              <th>兑换时间</th>
              <th>
                <button class="button button-tiny button-action" data-toggle="modal" data-target="#myModal">添加卡券
                </button>
              </th>
            </tr>
            </thead>
            <tbody>
            <tr v-cloak v-for="card in page_data">
              <td>@{{ card.id }}</td>
              <td>@{{ card.num }}</td>
              <td>@{{ card.usable }}</td>
              <td>@{{ card.name }}</td>
              <td>@{{ card.phone }}</td>
              <td>@{{ card.date }}</td>
              <td></td>
            </tr>
            </tbody>
          </table>
        </div>
        <nav v-if="false" class="text-center col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 col-xs-12" id="pagination">
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
                  <textarea type="text" class="form-control" rows="20" id="inputCards"
                            placeholder="请输入卡号密码 ,例：卡号：JDV8000000000001 密码：000-0000-0000-0000"
                            v-model="input">
                  </textarea>
                  </div>
                </div>
              </div>
              <div class="col-sm-6">
                <table class="table table-striped table-hover" id="inputTable">
                  <thead>
                  <tr>
                    <th>#</th>
                    <th>卡号</th>
                    <th>密码</th>
                  </tr>
                  </thead>
                  <tbody>
                  <tr v-cloak v-for="card in cards">
                    <td>@{{ $index +   1 }}</td>
                    <td>@{{ card.no }}</td>
                    <td>@{{ card.password }}</td>
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
  <script>
    $(function () {
      $('#myModal').modal({
        show: false,
        backdrop: false,
        keyboard: false
      });
    });

    var requireList = {!! $applications !!};
    var order = new Vue({
      el: '#index',
      data: {
        searching: {
          user_type: '',
          detail: '',
          page_num: ''
        },
        searched: '',
        page_all: 0,
        page_active: 0,
        page_num: 0,
        page_data: [
          {
            id: 123,
            card_num: 123,
            usable: 123,
            name: 123,
            phone: 123,
            date: 123,
          }
        ],
        input: '',

        require_list: requireList

      },
      computed: {
        page_show: function () {
          if (this.page_all <= 5 || this.page_active <= 3) {
            return 1;
          } else {
            return (this.page_all - 4) < (this.page_active - 2) ? (this.page_all - 4) : (this.page_active - 2);
          }
        },
        get_url: function () {
          if (order.searching.user_type == '未兑换卡券') return '/order/search?type_id=0';
          if (order.searching.user_type == '已兑换卡券') return '/order/search?type_id=1';
          if (order.searching.user_type == '所有卡券') return '/gift-card/import';
        },
        cards: function () {
          var split, i, cards;
          if (this.input.indexOf('卡号') > -1 && this.input.indexOf('密码') > -1) {
            split = this.input.replace(/[^\w\-\s卡号密码]/g, '').split('卡号');
            i = split.length;
            if (i == 1) {
              return '';
            } else {
              cards = [];
              for (j = 1; j < i; j++) {
                card = split[j].split('密码');
                if (card.length != 1) {
                  cards.push({
                    no: card[0],
                    password: card[1]
                  })
                }
              }
            }
          } else {
            split = this.input.replace(/[^\w\-\s]/g, '').split('\n');
            i = split.length;
            if (i == 0) {
              return '';
            } else {
              cards = [];
              for (j = 0; j < i; j++) {
                if( split[j].indexOf('\t') > -1 ){
                  card = split[j].split('\t');
                } else {
                  card = split[j].split(' ');
                }
                card = split[j].split('\t');
                if (card.length != 1) {
                  cards.push({
                    no: card[0],
                    password: card[1]
                  })
                }
              }
            }
          }

          $('#inputCards').css('min-height', $('#inputTable').height());
          return cards;
        }
      },

      methods: {
        choose_data: function (e) {
          var type = e.target.innerHTML;
          if (type == '未兑换卡券') {
            order.searching.user_type = '未兑换卡券';
          }
          if (type == '已兑换卡券') {
            order.searching.user_type = '已兑换卡券';
          }
          if (type == '所有卡券') {
            order.searching.user_type = '所有卡券';
          }
          $.get(order.get_url,
            {},
            function (data) {
              if (data.success) {
                order.searched = '';
                order.page_all = data.data.orders.last_page;
                order.page_active = data.data.orders.current_page;
                order.page_data = data.data.orders.data;
                order.$nextTick(initialize_popover);
              }
            },
            'json'
          );
        },
        choose_page: function (e) {
          var page_num = e.target.getAttribute('name');
          switch (page_num) {
            case 'pre':
              page_num = this.page_active - 1;
              break;
            case 'pre5':
              if (this.page_active - 5 > 0) {
                page_num = this.page_active - 5;
              } else {
                page_num = 1;
              }
              break;
            case 'next':
              page_num = this.page_active + 1;
              break;
            case 'next5':
              if (this.page_active + 4 < this.page_all) {
                page_num = this.page_active + 5;
              } else {
                page_num = this.page_all;
              }
              break;
            default:
              page_num = e.target.innerHTML;
              break;
          }
          $.get(order.get_url,
            {
              page: page_num,
              key: order.searched
            },
            function (data) {
              if (data.success) {
                order.page_active = data.data.orders.current_page;
                order.page_data = data.data.orders.data;
                order.$nextTick(initialize_popover);
              }
            },
            'json'
          )

        },
        search: function () {

        },
        print: function () {
          alert('hahah!');
        },
        pass: function (e) {
          $.post('/gift-card-application/approve',e,function(data){
            if(data == '操作成功！') {
              order.requireList.$remove(e);
            };
              $('#response').text(data);
              $('#response').parent().parent().removeClass('hide');
          })
        },
        reject: function () {
          $.post('',e,function(data){
            if(data){
              $('#response').text(data);
              $('#response').parent().parent().removeClass('hide');
            }
          })
        },
        addCards: function () {
          $.post('/gift-card/import',{cards:order.cards},function(data){
            if(data.success){
              order.input = '';
              $('#myModal').modal('hide');
              $('#response').text('上传成功');
              $('#response').parent().parent().removeClass('hide');
            }
          })
        },
        hideAlert: function () {
          $('#response').parent().parent().addClass('hide');
        }
      }
    });

    var click_btn = location.hash;
    switch (click_btn) {
      case '#unfilled':
        order.searching.user_type = '未兑换卡券';
        break;
      case '#filled':
        order.searching.user_type = '已兑换卡券';
        break;
      case '#all':
        order.searching.user_type = '所有卡券';
        break;
      default :
        order.searching.user_type = '所有卡券';
        click_btn = '#all';
        break;
    }
    $(click_btn).trigger('click');

    $('.nav').children().eq(3).children().addClass('active');

  </script>
@endsection