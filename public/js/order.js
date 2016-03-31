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
      user_type:'未完成订单',
      detail:'',
      page_num:''
    },
    searched: '张三',
    page_all: 10,
    page_active: 2,
    page_num: 50,
    page_data: [
      {}
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
    }
  },

  methods: {
    choose_data: function (e) {
      var dom = e.currentTarget;
      var name = e.target.innerHTML;
      if (dom.className != 'active') {

      }
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
    index.searching.user_type = '未完成订单';
    break;
  case '#filled':
    index.searching.user_type = '已完成订单';
    break;
  case '#all':
    index.searching.user_type = '所有订单';
    break;
  default :
    index.searching.user_type = '未完成订单';
    click_btn = '#unfilled';
    break;
}
$(click_btn).trigger('click');

$('.nav').children().eq(1).children().addClass('active');






