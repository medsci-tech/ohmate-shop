var list = new Vue({
  el: '#addresses',
  data: {
    addresses: [],
    newAdd: {
      id: -1,
      name: '',
      phone: '',
      code: '',
      province: '',
      city: '',
      district: '',
      address: '',
      is_default: false,
      gift_type :'',
      activity_id:''
    }
  },

  methods: {
    addFun: function () {
      $.post('/register/createAdd',
        {
          name: this.newAdd.name,
          phone: this.newAdd.phone,
          code: this.newAdd.code,
          province: this.newAdd.province,
          city: this.newAdd.city,
          district: this.newAdd.district,
          address: this.newAdd.address,
          is_default: this.newAdd.is_default,
          gift_type :this.newAdd.gift_type,
          activity_id:this.newAdd.activity_id,
        },
        function (data) {
          if (data.success) {
            //alert('您的信息已经成功提交!');
            //top.window.close();
            window.location.href='/register/subok';
          } else {
            alert(data.error_messages);
          }
        }, "json"
      );
    },
    editCancel: function () {
      list.newAdd = {
        id: -1,
        name: '',
        phone: '',
        province: '',
        city: '',
        district: '',
        address: '',
        is_default: false
      }
      $('.heading-toggle').toggleClass('hide');
      $('#button button').toggleClass('hide');
    }
  }
});
