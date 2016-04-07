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
        address: {
          address: "",
          city: "",
          created_at: "",
          customer_id: 0,
          deleted_at: null,
          district: "",
          id: 0,
          is_default: false,
          name: "",
          phone: "",
          postcode: "",
          priority: 0,
          province: "",
          updated_at: ""
        },
        address_id: 0,
        beans_payment: "",
        beans_payment_calculated: "",
        cash_payment: "",
        cash_payment_calculated: "",
        commodities: [{
          created_at: null,
          deleted_at: null,
          id: 0,
          introduction: "",
          name: "",
          pivot: {order_id: 0, commodity_id: 0, amount: 0},
          portrait: "",
          price: "",
          priority: 0,
          remark: "",
          storage: 0,
          updated_at: null
        }],
        created_at: "",
        customer: {
          auth_code: "",
          auth_code_expired: "",
          beans_total: 0,
          created_at: "",
          head_image_url: "",
          id: 0,
          is_registered: 0,
          nickname: "",
          old_id: null,
          openid: "",
          phone: "",
          qr_code: "",
          referrer_id: 0,
          type_id: 0,
          updated_at: ""
        },
        customer_id: 0,
        id: 0,
        order_status_id: 0,
        post_fee: "",
        post_no: "",
        post_type: "",
        total_price: "",
        updated_at: "",
        wx_out_trade_no: "",
        wx_transaction_id: ""
      }
    ],

    this_order: {
      order_id: 1,
      post_no: ""
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
      if (type == '未完成订单') {
        order.searching.user_type = '未完成订单';
      }
      if (type == '已完成订单') {
        order.searching.user_type = '已完成订单';
      }
      if (type == '所有订单') {
        order.searching.user_type = '所有订单';
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
      post('/order/order-posted',
        this.this_order,
        function (data) {
          if (data.success) {
            e.post_no = this.this_order.post_no;
            e.order_status_id = 3;
            $('.dropdown').dropdown('hide');
            this.this_order.order_id = 0;
            this.this_order.post_no = '';
          }
        }
      );
    }
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






