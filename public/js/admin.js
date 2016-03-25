$(function () {
  $('[data-toggle="popover"]').popover({html: true});
  $('.dropdown-toggle').dropdown();
});

$(function () {
  city_selector();
});

var index = new Vue({
  el: '#index',
  data: {
    searching: {
      user_type: '医生',
      detail: ''
    },
    searched: '张三',
    page_all: 3,
    page_active: 2,
    page_num: 20,
    page_data: [
      {
        id: 1,
        name: '张三',
        user_type: 'doctor',
        phone: '13232323232',
        email: '123123@123123.com',
        nickname: 'zhangsan',
        hospital: {
          name: '光谷同济医院',
          province: '湖北',
          city: '武汉',
          area: '洪山区',
          location: '生物城666号',
        },
        invited: {
          count: 90,
          this_month: 30,
          page_all: 3,
          page_active: 2,
          page_num: 20,
          pagedata: [{
            id: 2,
            phone: '13232323232',
            time: '2016-03-03'
          }, {
            id: 3,
            phone: '13232323232',
            time: '2016-03-03'
          }]
        },
        beans: {
          count: 9000,
          this_month: '+9000',
          page_all: 3,
          page_active: 2,
          page_num: 20,
          pagedata: [{
            action: '注册新用户',
            result: '+2180',
            time: '2016-03-03'
          }, {
            action: '管理员操作',
            result: '+6820',
            time: '2016-03-03'
          }]
        },
        qrcode: '/image/test04.jpg'
      },
    ],

    data_head: {
      id: '#',
      name: '姓名',
      phone: '手机号',
      address: '地址',
      hospital: '医院',
      invited: '邀请糖友数',
      beans: '迈豆数',
      qrcode: '二维码'
    },

    this_person: {
      id: 1,
      name: '张三',
      user_type: '医生',
      phone: '13232323232',
      email: '123123@123123.com',
      nickname: 'zhangsan',
      hospital: {
        name: '光谷同济医院',
        province: '湖北',
        city: '武汉',
        area: '洪山区',
        location: '生物城666号',
      },
      invited: {
        count: 90,
        page_all: 3,
        page_active: 2,
        page_num: 20,
        page_data: [{
          id: 2,
          phone: '13232323232',
          time: '2016-03-03'
        }, {
          id: 3,
          phone: '13232323232',
          time: '2016-03-03'
        }]
      },
      beans: {
        count: 9000,
        page_all: 3,
        page_active: 2,
        page_num: 20,
        page_data: [{
          action: '注册新用户',
          result: '+2180',
          time: '2016-03-03'
        }, {
          action: '管理员操作',
          result: '+6820',
          time: '2016-03-03'
        }]
      },
      qrcode: '/image/test04.jpg'
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
    invited_page_show: function () {
      if (this.this_person.invited.page_all <= 5 || this.this_person.invited.page_active <= 3) {
        return 1;
      } else {
        return (this.this_person.invited.page_all - 4) < (this.this_person.invited.page_active - 2) ? (this.this_person.invited.page_all - 4) : (this.this_person.invited.page_active - 2);
      }
    },
    beans_page_show: function () {
      if (this.this_person.beans.page_all <= 5 || this.this_person.beans.page_active <= 3) {
        return 1;
      } else {
        return (this.this_person.beans.page_all - 4) < (this.this_person.beans.page_active - 2) ? (this.this_person.beans.page_all - 4) : (this.this_person.beans.page_active - 2);
      }
    },
  },

  methods: {
    choose_data: function (e) {
      var dom = e.currentTarget;
      var name = e.target.innerHTML;
      if (dom.className != 'active') {
        $.get('/customer/list',
          {
            /*            user_type: name,
             detail: '',
             page: 1*/
          },
          function (data) {
            if (data.success) {
              if (name = '医生') index.data_head = {
                id: '#',
                name: '姓名',
                phone: '手机号',
                address: '地址',
                hospital: '医院',
                invited: '邀请糖友数',
                beans: '迈豆数',
                qrcode: '二维码'
              };
              if (name = '志愿者') index.data_head = {
                id: '#',
                name: '姓名',
                phone: '手机号',
                address: '地址',
                hospital: '医院',
                invited: '邀请糖友数',
                beans: '迈豆数',
                qrcode: '二维码'
              };
              if (name = '所有用户') index.data_head = {
                id: '#',
                name: '姓名',
                phone: '手机号',
                address: '地址',
                hospital: '医院',
                invited: '邀请糖友数',
                beans: '迈豆数',
                qrcode: '二维码'
              };
              index.searched = '';
              index.searching.user_type = '所有用户';
              index.page_all = data.data.customers.last_page;
              index.page_active = data.data.customers.current_page;
              index.page_data = data.data.customers.data;
            }
          },
          'json'
        );
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
      $.get('/customer/list',
        {
          page: page_num
        },
        function (data) {
          if (data.success) {
            index.page_active = data.data.customers.current_page;
            index.page_data = data.data.customers.data;
          }
        },
        'json'
      )
    },
    search: function () {
      $.post(
        url(),
        {
          user_type: this.searching.user_type,
          detail: this.searching.detail,
          page: 1
        },
        function (data) {
          if (data.success) {
            this.searching.detail = '';
          }
        },
        'json'
      )
    },
    person_detail: function (e) {
      $('#myModal').modal('show');
      $.post(
        url(),
        {
          id: e.id,
        },
        function (data) {
          if (data.success) {
            this.this_person = data.data;
            $('#province').val(index.this_person.hospital.province);
            $('#province').trigger('change');
            $('#city').val(index.this_person.hospital.city);
            $('#city').trigger('change');
            $('#area').val(index.this_person.hospital.district);
            $('#area').trigger('change');
          }
        }
      )
    },
    edit_btn: function () {
      $('#user_card p').toggleClass('hide');
      $('#user_card button').toggleClass('hide');
      $('#user_card .form-control').toggleClass('sr-only');
    }
  }
});

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

index.choose_data();



