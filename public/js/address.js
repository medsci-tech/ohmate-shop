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
    },
    chooseImg: {
      imgtrue: '/image/shop_icon/icon.png',
      imgfalse: '/image/shop_icon/icon1.png'
    },
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
            alert('服务器异常2!');
          }
        }, "json"
      );
    },
    chooseAdd: function (e) {
      if (!e.is_default) {
        e.is_default = true;
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
            };
          } else {
            alert('服务器异常4!');
          }
        }, "json"
      );
    }

//      submitAdd: function () {
//        if (this.newAdd.id == '-1'){
//          list.addFun();
//        } else {
//          list.editFun();
//        }
//      },

//      editAdd: function (e) {
//        $('#title').text('修改收货地址');
//        $('#button button').text('完'+' '+'成');
//        this.newAdd.id = e.id;
//        this.newAdd.name = e.name;
//        this.newAdd.phone = e.phone;
//        this.newAdd.province = e.province;
//        this.newAdd.city = e.city;
//        this.newAdd.district = e.district;
//        this.newAdd.address = e.address;
//      },
//      editFun: function () {
//        if ($('#province').val() && $('#city').val() && $('#area').val()) {
//          $.post('/shop/address/update',
//            {
//              id: this.newAdd.id,
//              name: this.newAdd.name,
//              phone: this.newAdd.phone,
//              province: this.newAdd.province,
//              city: this.newAdd.city,
//              district: this.newAdd.district,
//              address: this.newAdd.address
//            },
//            function (data) {
//              if (data.success) {
//                list.addReload();
//                list.newAdd = {
//                  id: -1,
//                  name: '',
//                  phone: '',
//                  province: '选择省',
//                  city: '选择市',
//                  district: '选择区',
//                  address: '',
//                  is_default: false
//                };
//                $('#title').text('添加收货地址');
//                $('#button button').text('添加并设为默认');
//              } else {
//                alert('服务器异常5!');
//              }
//            }, "json"
//          )
//        }
//      }
  }
});

list.addReload();
