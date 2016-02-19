/**
 * Created by 鹏飞 on 2016/2/14.
 */

if (localStorage.cart){
  var cart = JSON.parse(localStorage.cart);
} else {
  var cart = null;
};

var shop_cart = new Vue({
  el: '#cart_form',
  data: {

    cart: cart,

    person: {
      beans: 900,
      consume: 0
    },

    address: {
      name: '杨先生',
      phone: '18311561869',
      address: '湖北省武汉市东湖高新大道3234号'
    }
  },

  computed: {
    priceAll: function () {
      var all = 0;
      for (i = 0; i < this.cart.length; i++) {
        all += this.cart[i].price * this.cart[i].num;
      }
      return all;
    },
    priceDiscount: function () {
      if (this.person.consume > this.person.beans || this.person.consume > this.priceAll * 100) {
        this.person.consume =
          this.person.beans < this.priceAll * 100 ? this.person.beans : this.priceAll * 100;
      }
      return this.person.consume / 100;
    },
    priceCount: function () {
      return this.priceAll + 8 - this.priceDiscount;
    }

  },

  methods: {
    removeGoods: function (e) {
      this.cart.$remove(e);
    },
    priceGoods: function (e) {
      return e.price * e.num;
    },
    numMinus: function (e) {
      if (e.num >= 2) {
        e.num--;
      }
    },
    numAdd: function (e) {
      if (e.num <= 98) {
        e.num++;
      }
    },
    beansConsume: function () {
    }
  }
});

