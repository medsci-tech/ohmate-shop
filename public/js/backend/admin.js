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
  });
  city_selector();
});

var index = new Vue({
  el: '#index',
  data: {
    a_searching: {
      type: '',
      value: '',
    },
    a_searched: {
      type: '',
      value: '',
    },
    searching: {
      user_type: '',
      detail: ''
    },
    searched: '',
    page_all: 0,
    page_active: 0,
    page_num: 0,
    page_data: [{
      id: 1,
      phone: '',
      email: '',
      nickname: '',
      information: {
        name: '',
        hospital: '',
        province: '',
        city: '',
        district: '',
        remark: '',
        department: '',
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
      // invited: '邀请糖友数',
      beans: '迈豆数',
      qr_code: '二维码'
    },

    this_person: {
      id: 1,
      name: '',
      hospital: '',
      province: '',
      city: '',
      district: '',
      department: '',
      type_id: '',
      remark: '',
      type: '',
      referred_name: '',
      referred_phone: '',
      region: '',
      region_level: '',
      responsible: '',
      hospital_level: '',
      phone: '',
    },
    other_info: {
      statistics: {friend_count: 0},
      type: {type_ch: ''},
      phone: '',
      nickname: '',
      beans_total: 0,
      qr_code: '',
      patient: {
        page_all: 3,
        page_active: 2,
        page_num: 20,
        page_data: [{
          poen_id: 1,
          phone: '',
          time: ''
        }]
      },
      // beans: {
      //   page_all: 3,
      //   page_active: 2,
      //   page_num: 20,
      //   page_data: [{
      //     time: '',
      //     action: '',
      //     result: ''
      //   }]
      // },
      focus_count:'',
      register_count:'',
      questionnaire_count:''
    },

    this_person_cache: '',
    beans_edit: 0,
    add_doctor: {
      name: '',
      hospital: '',
      province: '',
      city: '',
      district: '',
      department: '',
      type_id: '',
      remark: '',
      type: '',
      referred_name: '',
      referred_phone: '',
      region: '',
      region_level: '',
      responsible: '',
      hospital_level: '',
      phone: '',
    },
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
    },
    get_url: function () {
      if (index.searching.user_type == '医生') return '/customer/search?type_id=4';
      if (index.searching.user_type == '护士') return '/customer/search?type_id=3';
      if (index.searching.user_type == '志愿者') return '/customer/search?type_id=2';
      if (index.searching.user_type == '普通用户') return '/customer/search?type_id=1';
      if (index.searching.user_type == '企业用户') return '/customer/search?type_id=5';
      if (index.searching.user_type == '所有用户') return '/customer/search';
      if (index.searching.user_type == '修改迈豆') return '/customer/search-bean';
      if (index.searching.user_type == 'A类医生') return '/customer/search-for-type-a?force_search=1';
    },
  }
  ,

  methods: {
    choose_data: function (e) {
      var name = e.target.innerHTML;
      if (name == '医生' || name == '<a href="#doctor">医生</a>' ) {
        index.data_head = {
          id: '#',
          name: '姓名',
          phone: '手机号',
          address: '地址',
          hospital: '医院',
          // invited: '邀请糖友数',
          beans: '迈豆数',
          qr_code: '二维码'
        };
        index.searching.user_type = '医生';
      }
      if (name == '护士' || name == '<a href="#nurse">护士</a>' ) {
        index.data_head = {
          id: '#',
          name: '姓名',
          phone: '手机号',
          address: '地址',
          hospital: '医院',
          // invited: '邀请糖友数',
          beans: '迈豆数',
          qr_code: '二维码'
        };
        index.searching.user_type = '护士';
      }
      if (name == '志愿者' || name == '<a href="#volunteer">志愿者</a>' ) {
        index.data_head = {
          id: '#',
          name: '姓名',
          phone: '手机号',
          address: '地址',
          hospital: '医院',
          // invited: '邀请糖友数',
          beans: '迈豆数',
          qr_code: '二维码'
        };
        index.searching.user_type = '志愿者';
      }
      if (name == '普通用户' || name == '<a href="#common">普通用户</a>' ) {
        index.data_head = {
          id: '#',
          name: '姓名',
          phone: '手机号',
          address: '地址',
          hospital: '医院',
          // invited: '邀请糖友数',
          beans: '迈豆数',
          qr_code: '二维码'
        };
        index.searching.user_type = '普通用户';
      }
      if (name == '企业用户' || name == '<a href="#enterprise">企业用户</a>' ) {
        index.data_head = {
          id: '#',
          name: '姓名',
          phone: '手机号',
          address: '地址',
          hospital: '医院',
          // invited: '邀请糖友数',
          beans: '迈豆数',
          qr_code: '二维码'
        };
        index.searching.user_type = '企业用户';
      }
      if (name == '所有用户' || name == '<a href="#all">所有用户</a>' ) {
        index.data_head = {
          id: '#',
          name: '姓名',
          phone: '手机号',
          address: '地址',
          hospital: '医院',
          // invited: '邀请糖友数',
          beans: '迈豆数',
          qr_code: '二维码'
        };
        index.searching.user_type = '所有用户';
      }
      if (name == '修改迈豆' || name == '<a href="#modbean">修改迈豆</a>' ) {
        index.data_head = {
          id: '#',
          phone: '手机号',
          beans: '操作迈豆数',
          opt: '操作人',
          remark: '备注',
          created_at: '操作时间'
        };
        index.searching.user_type = '修改迈豆';
      }
      if (name == 'A类医生' || name == '<a href="#doctor_a">A类医生</a>' ) {
        index.data_head = {
          id: '#',
          type: '类别',
          name: '姓名',
          phone: '手机号',
          address: '地址',
          hospital: '医院',
          region: '所在大区',
          referred_name: '推荐代表',
          invited: '邀请糖友数',
          beans: '迈豆数',
          focus_count: '关注数',
          register_count: '注册数',
          questionnaire_count: '问卷数',
          qr_code: '二维码',
        };
        index.searching.user_type = 'A类医生';
      }
      $.get(index.get_url,
        {},
        function (data) {
          if (data.success) {
            index.searched = '';
            index.page_all = data.data.customers.last_page;
            index.page_active = data.data.customers.current_page;
            index.page_data = data.data.customers.data;
            index.$nextTick(initialize_popover);
          }
        },
        'json'
        );
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
      if(this.searching.user_type == 'A类医生'){
        $.get(index.get_url,
        {
          page: page_num,
          key: index.a_searched.type,
          value: index.a_searched.value
        },
        function (data) {
          if (data.success) {
            index.page_active = data.data.customers.current_page;
            index.page_data = data.data.customers.data;
            index.$nextTick(initialize_popover);
          }
        },
        'json'
        )
      } else {
       $.get(index.get_url,
       {
        page: page_num,
        key: index.searched
      },
      function (data) {
        if (data.success) {
          index.page_active = data.data.customers.current_page;
          index.page_data = data.data.customers.data;
          index.$nextTick(initialize_popover);
        }
      },
      'json'
      )
      }
    }
    ,
    choose_page_invited: function (e) {
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
      $.get('/customer/invited',
      {
        id: this.this_person.id,
        page: this.this_person.invited.page_num
      },
      function (data) {
        if (data.success) {
          this.this_person.invited.page_data = data.data
        }
      }
      );
    }
    ,
    choose_page_beans: function (e) {
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
      $.get('/customer/beans',
      {
        id: this.this_person.id,
        page: this.this_person.beans.page_num
      },
      function (data) {
        if (data.success) {
          this.this_person.beans.page_data = data.data
        }
      }
      );
    }
    ,
    search: function () {
      $.get(index.get_url,
      {
        key: this.searching.detail
      },
      function (data) {
        if (data.success) {
          index.searched = index.searching.detail;
          index.page_all = data.data.customers.last_page;
          index.page_active = data.data.customers.current_page;
          index.page_data = data.data.customers.data;
          index.$nextTick(initialize_popover);
        }
      },
      'json'
      )
    }
    , 
    a_search: function () {
      $.get(index.get_url,
      {
        key: this.a_searching.type,
        value: this.a_searching.value,
      },
      function (data) {
        if (data.success) {
          index.searched = index.a_searching.value;
          index.a_searched.type = index.a_searching.type,
          index.a_searched.value = index.a_searching.value,
          index.page_all = data.data.customers.last_page;
          index.page_active = data.data.customers.current_page;
          index.page_data = data.data.customers.data;
          index.$nextTick(initialize_popover);
        }
      },
      'json'
      )
    }
    ,
    person_detail: function (e) {
      $('#myModal').modal('show');
      this.this_person.id = e.id;
      this.this_person.type_id = e.type_id;
      if (e.information) {
        with (this.this_person) {
          name = e.information.name;
          phone = e.information.phone;
          hospital = e.information.hospital;
          province = e.information.province;
          city = e.information.city;
          district = e.information.district;
          remark = e.information.remark;
          department = e.information.department;
          type= e.information.type;
          referred_name= e.information.referred_name;
          referred_phone= e.information.referred_phone;
          region= e.information.region;
          region_level= e.information.region_level;
          responsible= e.information.responsible;
          hospital_level= e.information.hospital_level;
        }
      } else {
        with (this.this_person) {
          name = '';
          hospital = '';
          province = '';
          city = '';
          district = '';
          remark = '';
          department = '';
          type= '';
          referred_name= '';
          referred_phone= '';
          region= '';
          region_level= '';
          responsible= '';
          hospital_level= '';
          phone= '';
        }
      }
      with (this.other_info) {
        phone = e.phone;
        nickname = e.nickname;
        beans_total = e.beans_total;
        qr_code = e.qr_code;
        focus_count= e.focus_count;
        register_count= e.register_count;
        questionnaire_count= e.questionnaire_count;
      }
      if (index.this_person.province != '') {
        $('#province').val(index.this_person.province);
        $('#province').trigger('change');
        $('#city').val(index.this_person.city);
        $('#city').trigger('change');
        $('#area').val(index.this_person.district);
        $('#area').trigger('change');
      }
      if (e.statistics) {
        index.other_info.statistics.friend_count = e.statistics.friend_count;
      } else {
        index.other_info.statistics.friend_count = '';
      }
      if (e.type) {
        index.other_info.type.type_ch = e.type.type_ch;
      } else {
        index.other_info.type.type_ch = '';
      }
      this.this_person_cache = JSON.parse(JSON.stringify(this.this_person));
      this.beans_cache = this.other_info.beans_total;
      //$.get('/customer/invited',
      //  {
      //    id: this.this_person.id,
      //    page: this.other_info.invited.page_num
      //  },
      //  function (data) {
      //    if (data.success) {
      //      this.other_info.invited.page_data = data.data
      //    }
      //  }
      //);
      //$.get('/customer/beans',
      //  {
      //    id: this.this_person.id,
      //    page: this.other_info.beans.page_num
      //  },
      //  function (data) {
      //    if (data.success) {
      //      this.other_info.beans.page_data = data.data
      //    }
      //  }
      //);
    }
    ,
    cancel_edit: function () {
      this.this_person = this.this_person_cache;
      $('#user_card p').toggleClass('hide');
      $('#user_card button').toggleClass('hide');
      $('#user_card .form-control').toggleClass('sr-only');
      $('#beans_edit').toggleClass('hide');
    }
    ,
    edit_btn: function () {
      $('#user_card p').toggleClass('hide');
      $('#user_card button').toggleClass('hide');
      $('#user_card .form-control').toggleClass('sr-only');
      $('#beans_edit').toggleClass('hide');
    }
    ,
    submit_edit: function () {
      var beans_edit = {
        action: '管理员操作',
        result: (this.beans_edit + this.other_info.beans_total) > 0 ? this.beans_edit : this.other_info.beans_total * (-1)
      };
      console.log(beans_edit.action);
      console.log(beans_edit.result);

      //if (beans_edit.result != 0) {
      //  $.post('/',beans_edit,function (data) {
      //    if (data.success) {
      //       this.other_info.beans_total += this.beans_edit;
      //    }
      //  });
      //}
      $.post('/customer/' + this.this_person.id + '/update', this.this_person,
        function (data) {
          if (data.success) {
            $.get(index.get_url,
            {
              page: index.page_active,
              key: index.searching.detail
            },
            function (data) {
              if (data.success) {
                index.page_data = data.data.customers.data;
                index.$nextTick(initialize_popover);
              }
            },
            'json'
            );
            $('#user_card p').toggleClass('hide');
            $('#user_card button').toggleClass('hide');
            $('#user_card .form-control').toggleClass('sr-only');
            $('#beans_edit').toggleClass('hide');
          }
        }, 'json'
        );
    },
    addUserBean: function(){
      $('#addBeanAModal').modal('show');
    },
    addDoctorA: function(){
      // $('.modal').modal('hide');
      $('#addDoctorAModal').modal('show');
    },
    cancelAdd: function(){
      $('#addDoctorAModal').modal('hide');
      index.add_doctor = '';
    },
    submitAdd: function(){
      $.post('/customer/create-information', this.add_doctor,
        function (data) {
          if (data.success) {
            $.get(index.get_url,
            {
              page: index.page_active,
              key: index.searching.detail
            },
            function (data) {
              if (data.success) {
                index.page_data = data.data.customers.data;
                index.$nextTick(initialize_popover);
                index.add_doctor = '';
                $('#addDoctorAModal').modal('hide');
              }
            },
            'json'
            );
          }
        }, 'json'
        );
    },

    submitAddBean: function(){
      $.post('/customer/save-bean', {phone:$('#phone').val(),beans:$('#beans').val(),remark:$('#remark').val()},
          function (data) {
            if(!data.success)
            {
              alert(data.data.message);
              return false;
            }

            if (data.success) {
              $.get(index.get_url,
                  {
                    page: index.page_active,
                    key: index.searching.detail
                  },
                  function (data) {
                    if (data.success) {
                      index.page_data = data.data.customers.data;
                      index.$nextTick(initialize_popover);
                      $('#addBeanAModal').modal('hide');
                    }
                  },
                  'json'
              );
            }
          }, 'json'
      );
    },
    showPatient: function(e){
      // $('.modal').modal('hied');
      index.this_person.name = e.information.name;
      $.get('/customer/lower_list?customer_id='+e.id,{},
      function (data) {
        index.other_info.patient.page_data = data.data.lower_list;
        index.$nextTick(initialize_popover);
        $('#patientModal').modal('show');
      });
    },
    // choose_page_patient: function (e) {
    //   var page_num = e.target.getAttribute('name');
    //   switch (page_num) {
    //     case 'pre':
    //     page_num = this.other_info.patient.page_active - 1;
    //     break;
    //     case 'pre5':
    //     if (this.other_info.patient.page_active - 5 > 0) {
    //       page_num = this.other_info.patient.page_active - 5;
    //     } else {
    //       page_num = 1;
    //     }
    //     break;
    //     case 'next':
    //     page_num = this.other_info.patient.page_active + 1;
    //     break;
    //     case 'next5':
    //     if (this.other_info.patient.page_active + 4 < this.other_info.patient.page_all) {
    //       page_num = this.other_info.patient.page_active + 5;
    //     } else {
    //       page_num = this.other_info.patient.page_all;
    //     }
    //     break;
    //     default:
    //     page_num = e.target.innerHTML;
    //     break;
    //   }
    //   $.get('/customer/beans',
    //   {
    //     page: this.other_info.patient.page_num
    //   },
    //   function (data) {
    //     if (data.success) {
    //       this.other_info.patient.page_data = data.data
    //     }
    //   }
    //   );
    // }
  }
});


var click_btn = location.hash;
switch (click_btn) {
  case '#doctor':
  index.searching.user_type = '医生';
  break;
  case '#volunteer':
  index.searching.user_type = '志愿者';
  break;
  case '#nurse':
  index.searching.user_type = '护士';
  break;
  case '#common':
  index.searching.user_type = '普通用户';
  break;
  case '#enterprise':
  index.searching.user_type = '企业用户';
  break;
  case '#all':
  index.searching.user_type = '所有用户';
  break;
  case '#doctor_a':
  index.searching.user_type = 'A类医生';
  break;
  default :
  index.searching.user_type = '医生';
  click_btn = '#doctor';
  break;
}

$('.nav').children().eq(0).children().addClass('active');

$(click_btn).trigger('click');





