var initialize_popover = function () {
  $('[data-toggle="popover"]').popover({html: true});

  $('[data-toggle="popover"]').mouseover(function () {
    $(this).popover('show');
    $('[data-toggle="popover"]').mouseout(function () {
      var set = setTimeout(function () {
        $('[data-toggle="popover"]').popover('hide')
      }, 300);
      $('.popover-content').mouseover(function () {
        clearTimeout(set);
      });
    });
    $('.popover-content').mouseout(function () {
      $('[data-toggle="popover"]').popover('hide');
    });
  });
};

$(function () {
  $('.dropdown-toggle').dropdown();
  $('#myModal').modal({
    show: false,
    backdrop: false,
    keyboard: false
  });
  city_selector();
});

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
        id:123,
        secret:123,
        useable: '未使用',
      }
    ],
    input: '',

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
      if (order.searching.user_type == '所有卡券') return '/card/list';
    },
    cards: function () {
      var split,i,cards;
      if(this.input.indexOf('卡号')>-1 && this.input.indexOf('密码')>-1){
        split = this.input.replace(/[\s：:]/g,'').split('卡号');
        i = split.length;
        if ( i == 1) {
          return '';
        } else {
          cards = [];
          for ( j=1 ; j<i ; j++ ){
            card = split[j].split('密码');
            if ( card.length != 1) {
              cards.push({
                no: card[0],
                password: card[1]
              })
            }
          }
        }
      } else {
        split = this.input.replace(/[\s：:]/g,'').split('/n');
        i = split.length;
        if ( i == 1) {
          return '';
        } else {
          cards = [];
          for ( j=1 ; j<i ; j++ ){
            card = split[j].split('/t');
            if ( card.length != 1) {
              cards.push({
                no: card[0],
                password: card[1]
              })
            }
          }
        }
      }

      $('#inputCards').css('min-hight',$('#inputTable').height());
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
        {

        },
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
    fill_order: function (e) {
      this.this_order.order_id = e.id;
      $.post('/order/order-posted',
        this.this_order,
        function (data) {
          if (data.success) {
            e.post_no = order.this_order.post_no;
            e.order_status_id = 3;
            $('.dropdown').dropdown('hide');
            order.this_order.order_id = 0;
            order.this_order.post_no = '';
          }
        }
      );
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






