/**
 * Created by 鹏飞 on 2016/2/17.
 */
var address = new Vue({
  el: '#addresses',
  data: {
    addresses: [],
    newAdd: {
      name: '',
      phone: '',
      address: '',
      postage: 8,
      default: false
    },
    chooseImg: {
      imgtrue: '/image/shop_icon/icon.png',
      imgfalse: '/image/shop_icon/icon1.png'
    },
  },

  methods: {
    removeAdd: function (e) {
      if (e.default == true) {
        this.addresses.$remove(e);
        this.addresses[0].default = true;
      } else {
        this.addresses.$remove(e);
      }
    },
    chooseAdd: function (e) {
      for (i = 0; i < this.addresses.length; i++) {
        this.addresses[i].default = false;
      }
      e.default = true;
    },
    addAdd: function () {
      if ($('#province').val() && $('#city').val() && $('#area').val()) {
        for (i = 0; i < this.addresses.length; i++) {
          this.addresses[i].default = false;
        }
        if ($('#province').val() == '新疆维吾尔自治区' || $('#province').val() == '西藏自治区') {
          this.newAdd.postage = 12;
        }
        this.addresses.push({
          name: this.newAdd.name,
          phone: this.newAdd.phone,
          address: $('#province').val() + $('#city').val() + $('#area').val() + this.newAdd.address,
          postage: this.newAdd.postage,
          default: true
        });
        this.newAdd = {
          name: '',
          phone: '',
          address: '',
          postage: 8,
          default: false
        }
      }
    },
    editAdd: function (e) {
      if ((this.newAdd.name || this.newAdd.phone || this.newAdd.address) == 0) {
        if (e.default == true) {
          this.addresses.$remove(e);
          this.addresses[0].default = true;
        } else {
          this.addresses.$remove(e);
        }
        this.newAdd.name = e.name;
        this.newAdd.phone = e.phone;
      }
    }
  }
});