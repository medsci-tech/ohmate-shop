$(function () {
  $('.dropdown-toggle').dropdown();
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
      page_data: [{
        id: 1,
        name: '',
        phone: '',
        email: '',
        nickname: '',
        hospital: {
          name: '',
          province: '',
          city: '',
          area: '',
          location: ''
        },
        statistics: {friend_count: 0},
        type: {type_ch: ''},
        beans_total: 0,
        qr_code: '',
      }],

      data_head: {
        id: '#',
        name: '姓名',
        phone: '手机号',
        address: '地址',
        hospital: '医院',
        invited: '邀请糖友数',
        beans: '迈豆数',
        qr_code: '二维码'
      },

      this_person: {
        id: 1,
        name: '',
        phone: '',
        email: '',
        nickname: '',
        hospital: {
          name: '',
          province: '',
          city: '',
          area: '',
          location: ''
        },
        statistics: {friend_count: 0},
        type: {type_ch: ''},
        beans_total: 0,
        qr_code: '',
      },

      this_person_cache: ''
    },
    computed: {
      page_show: function () {
        if (this.page_all <= 5 || this.page_active <= 3) {
          return 1;
        } else {
          return (this.page_all - 4) < (this.page_active - 2) ? (this.page_all - 4) : (this.page_active - 2);
        }
      }
      ,
      invited_page_show: function () {
        if (this.this_person.invited.page_all <= 5 || this.this_person.invited.page_active <= 3) {
          return 1;
        } else {
          return (this.this_person.invited.page_all - 4) < (this.this_person.invited.page_active - 2) ? (this.this_person.invited.page_all - 4) : (this.this_person.invited.page_active - 2);
        }
      }
      ,
      beans_page_show: function () {
        if (this.this_person.beans.page_all <= 5 || this.this_person.beans.page_active <= 3) {
          return 1;
        } else {
          return (this.this_person.beans.page_all - 4) < (this.this_person.beans.page_active - 2) ? (this.this_person.beans.page_all - 4) : (this.this_person.beans.page_active - 2);
        }
      }
    }
    ,

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
                  qr_code: '二维码'
                };
                if (name = '志愿者') index.data_head = {
                  id: '#',
                  name: '姓名',
                  phone: '手机号',
                  address: '地址',
                  hospital: '医院',
                  invited: '邀请糖友数',
                  beans: '迈豆数',
                  qr_code: '二维码'
                };
                if (name = '所有用户') index.data_head = {
                  id: '#',
                  name: '姓名',
                  phone: '手机号',
                  address: '地址',
                  hospital: '医院',
                  invited: '邀请糖友数',
                  beans: '迈豆数',
                  qr_code: '二维码'
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
      }
      ,
      choose_page_invited: function (e) {
      }
      ,
      choose_page_beans: function (e) {
      }
      ,
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
      }
      ,
      person_detail: function (e) {
        $('#myModal').modal('show');
        with (this.this_person) {
          id = e.id;
          name = e.name;
          phone = e.phone;
          email = e.email;
          nickname = e.nickname;
          if (e.hospital) {
            hospital.name = e.hospital.name;
            hospital.province = e.hospital.province;
            hospital.city = e.hospital.city;
            hospital.area = e.hospital.area;
            hospital.location = e.hospital.location;
            $('#province').val(index.this_person.hospital.province);
            $('#province').trigger('change');
            $('#city').val(index.this_person.hospital.city);
            $('#city').trigger('change');
            $('#area').val(index.this_person.hospital.district);
            $('#area').trigger('change');
          }
          if (e.statistics) {
            statistics.friend_count = e.statistics.friend_count;
          }
          if (e.type.type_ch) {
            type.type_ch = e.type.type_ch;
          }
          beans_total = e.beans_total;
          qr_code = e.qr_code;
        }
        this.this_person_cache = e;
      }
      ,
      cancel_edit: function () {
        this.this_person = this.this_person_cache;
        $('#user_card p').toggleClass('hide');
        $('#user_card button').toggleClass('hide');
        $('#user_card .form-control').toggleClass('sr-only');
      }
      ,
      edit_btn: function () {
        $('#myModal').modal({
          backdrop: false,
          keyboard: false
        });
        $('#user_card p').toggleClass('hide');
        $('#user_card button').toggleClass('hide');
        $('#user_card .form-control').toggleClass('sr-only');
      }
      ,
      submit_edit: function () {
        $.post('customer/' + this.this_person.id + '/update', this.this_person,
          function (data) {
            if (data.success) {
              this.page_data[this.this_person_cache] = JSON.parse(JSON.stringify(this.this_person));
              $('#user_card p').toggleClass('hide');
              $('#user_card button').toggleClass('hide');
              $('#user_card .form-control').toggleClass('sr-only');
              $('#myModal').modal('hide');
            }
          }, 'json'
        );
      }
    }
  })
  ;

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

$('#customer').trigger('click');
$(function () {
  $('[data-toggle="popover"]').popover({html: true});
});

