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
      user_type: '未发货订单',
      detail: '',
      page_num: ''
    },
    searched: '张三',
    page_all: 10,
    page_active: 2,
    page_num: 50,
    page_data: [
      {
        address: {
          address: "保利蓝海郡",
          city: "武汉",
          created_at: "2016-03-09 11:26:38",
          customer_id: 10,
          deleted_at: null,
          district: "洪山区",
          id: 7,
          is_default: false,
          name: "许守明",
          phone: "15623093771",
          postcode: "",
          priority: 0,
          province: "湖北",
          updated_at: "2016-03-16 13:40:52"
        },
        address_id: 10,
        beans_payment: "0.02",
        beans_payment_calculated: "0.02",
        cash_payment: "8.00",
        cash_payment_calculated: "8.00",
        commodities: [],
        created_at: "2016-03-09 13:50:54",
        customer: {id: 17, old_id: null, type_id: 5, referrer_id: 0, phone: "13237177277", is_registered: 1},
        customer_id: 17,
        id: 69,
        order_status_id: 2,
        post_fee: "8.00",
        post_no: "9728189263200",
        post_type: "",
        total_price: "8.02",
        updated_at: "2016-03-09 13:51:13",
        wx_out_trade_no: "84c1884e8cb1fa5f20d05e7e9699035b",
        wx_transaction_id: "1006150911201603093848809841"
      }
    ],

    this_order: {
      id: 1
    }
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
      if (order.searching.user_type == '未发货订单') return '/order/search?type_id=0';
      if (order.searching.user_type == '已发货订单') return '/order/search?type_id=1';
      if (order.searching.user_type == '所有订单') return '/order/list';
    }
  },

  methods: {
    choose_data: function (e) {
      var type = e.target.innerHTML;
      console.log(type);
      order.searching.user_type = type;
      $.get(order.get_url,
        {},
        function (data) {
          if (data.success) {
            order.searched = '';
            order.page_all = data.data.order.last_page;
            order.page_active = data.data.order.current_page;
            order.page_data = data.data.orders;
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

    },
    search: function () {

    },
    person_detail: function (e) {
      $('#myModal').modal('show');

    },
    edit_btn: function () {
      $('#user_card p').toggleClass('hide');
      $('#user_card button').toggleClass('hide');
      $('#user_card .form-control').toggleClass('sr-only');
    },

  }
});

var click_btn = location.hash;
switch (click_btn) {
  case '#unfilled':
    order.searching.user_type = '未完成订单';
    break;
  case '#filled':
    order.searching.user_type = '已完成订单';
    break;
  case '#all':
    order.searching.user_type = '所有订单';
    break;
  default :
    order.searching.user_type = '所有订单';
    click_btn = '#all';
    break;
}
$(click_btn).trigger('click');

$('.nav').children().eq(1).children().addClass('active');






