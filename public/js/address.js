var list = new Vue({
  el: '#addresses',
  data: {
    addresses: [],
    newAdd: {
      id: -1,
      name: '',
      phone: '',
      province: '',
      city: '',
      district: '',
      address: '',
      is_default: false
    }
  },

  methods: {
    addReload: function () {
      $.post('/shop/address/list', {},
        function (data) {
          if (data.success) {
            list.addresses = data.data;
          } else {
            alert('服务器异常1!');
          }
        }, "json"
      );
    },
    removeAdd: function (e) {
      $.post('/shop/address/delete',
        {id: e.id},
        function (data) {
          if (data.success) {
            list.addReload();
          } else {
            alert('Oops!');
          }
        }, "json"
      );
    },
    chooseAdd: function (e) {
      if (!e.is_default) {
        //for( i=0 ; i<list.addresses.length ; i++){
        //  list.addresses[i].is_default = false;
        //}
        //e.is_default = true;
        $.post('/shop/address/update',
          {
            id: e.id,
            is_default: true
          },
          function (data) {
            if (data.success) {
              list.addReload();
            } else {
              alert('服务器异常3!');
            }
          }, "json"
        )
      }
    },

    addFun: function () {
      $.post('/shop/address/create',
        {
          name: this.newAdd.name,
          phone: this.newAdd.phone,
          province: this.newAdd.province,
          city: this.newAdd.city,
          district: this.newAdd.district,
          address: this.newAdd.address,
          is_default: true
        },
        function (data) {
          if (data.success) {
            list.addReload();
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
          } else {
            alert('请输入正确的手机号!');
          }
        }, "json"
      );
    },

    editAdd: function (e) {
      $('.heading-toggle').removeClass('hide');
      $('#heading_add').addClass('hide');
      $('#button button').removeClass('hide');
      $('#button_add').addClass('hide');
      this.newAdd.id = e.id;
      this.newAdd.name = e.name;
      this.newAdd.phone = e.phone;
      this.newAdd.province = e.province;
      this.newAdd.city = e.city;
      this.newAdd.district = e.district;
      this.newAdd.address = e.address;
      $('#province').val(e.province);
      $('#province').trigger('change');
      $('#city').val(e.city);
      $('#city').trigger('change');
      $('#area').val(e.district);
      $('#area').trigger('change');
    },

    editFun: function () {
      $.post('/shop/address/update',
        {
          id: this.newAdd.id,
          name: this.newAdd.name,
          phone: this.newAdd.phone,
          province: this.newAdd.province,
          city: this.newAdd.city,
          district: this.newAdd.district,
          address: this.newAdd.address
        },
        function (data) {
          if (data.success) {
            list.addReload();
            list.editCancel();
          } else {
            alert('服务器异常5!');
          }
        }, "json"
      )
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

list.addReload();
