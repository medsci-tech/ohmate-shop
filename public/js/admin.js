$(function () {
  $('[data-toggle="popover"]').popover({html: true})
});

var index = new Vue({
  el: '#index',
  data: {
    data_name: '医生',
    searching: '',
    searched: '张三',
    page_all: 1,
    page_active: 1,
    pagedata: [
      {
        id: '1',
        name: '张三',
        phone: '13232323232',
        nickname: 'zhangsan',
        invited: '90',
        beans: '9000',
        qrcode: '../../image/test03.png'
      },
      {
        id: '2',
        name: '张三',
        phone: '13232323232',
        nickname: 'zhangsan',
        invited: '90',
        beans: '9000',
        qrcode: '../../image/test03.png'
      }
    ],
    data_head: ['#', '姓名', '手机号', '微信昵称', '邀请糖友数', '迈豆数', '二维码']
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
        $.post(
          url(),
          {
            data_name: name,
            searching: '',
            page: 1
          },
          function (data) {
            if (data.success) {
            }
          },
          'json'
        );
      }
    }
    ,
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
      $.post(
        url(),
        {
          data_name: this.data_name,
          searching: this.searching,
          page: page_num
        },
        function (data) {
          if (data.success) {

          }
        },
        'json'
      )
    }
    ,
    search: function () {
      $.post(
        url(),
        {
          data_name: this.data_name,
          searching: this.searching,
          page: 1
        },
        function (data) {
          if (data.success) {

          }
        },
        'json'
      )
    }
  }
});

index.search();