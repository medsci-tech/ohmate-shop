$.ajaxSetup({
  headers: {
    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
  }
});

if (typeof localStorage.cart != 'undefined') {
  var cart = JSON.parse(localStorage.cart);
} else {
  var cart = [];
}

var shop_cart = new Vue({
  el: '#cart_form',
  data: {
    cart: cart,
    beans: 0,
    address: [],
    post_fee: 0
  },

  computed: {
    cartList: function () {
      var list = [];
      for (i = 0; i < this.cart.length; i++) {
        list.push({
          id: this.cart[i].id,
          num: this.cart[i].num
        })
      }
      return list;
    },
    priceAll: function () {
      var all = 0;
      for (i = 0; i < this.cart.length; i++) {
        all += this.cart[i].price * this.cart[i].num;
      }
      return all;
    },
    priceDiscount: function () {
      var consume =
        this.beans < this.priceAll * 100 ? this.beans : this.priceAll * 100;
      return consume / 100;
    },
    priceCount: function () {
      if (this.address == null) {
        return this.priceAll + 8 - this.priceDiscount;
      } else {
        return this.priceAll + this.post_fee - this.priceDiscount;
      }
    },
    postage: function () {
      if (this.address == null) {
        return 8;
      } else {
        return this.post_fee;
      }
    }
  },

  methods: {
    removeGoods: function (e) {
      this.cart.$remove(e);
      localStorage.cart = JSON.stringify(this.cart);
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
    getPersonal: function () {
      $.post('/shop/cart/customer-information',
        {},
        function (data) {
          if (data.success) {
            shop_cart.beans = data.data.beans;
            shop_cart.address = data.data.default_address;
            shop_cart.post_fee = data.data.post_fee;
          }
        }, "json"
      )
    },
    postCart: function () {
      if(shop_cart.address.length != 0){
        console.log(JSON.stringify(shop_cart.$data));
        $.post('/shop/order/generate-config',
          {
            cart: this.cartList,
            address_id: this.address.id
          },
          function (data) {
            if (data.success) {
              shop_cart.cart = [];
              localStorage.clear();
              function onBridgeReady() {
                WeixinJSBridge.invoke(
                  'getBrandWCPayRequest', JSON.parse(data.data.result),
                  function (res) {
                    if (res.err_msg == "get_brand_wcpay_request：ok") {

                      $.post('shop/payment/ok',
                        {
                          order_id: data.data.order_id,
                          success:true
                        }
                      )
                    }     // 使用以上方式判断前端返回,微信团队郑重提示：res.err_msg将在用户支付成功后返回    ok，但并不保证它绝对可靠。
                  }
                );
              }

              if (typeof WeixinJSBridge == "undefined") {
                if (document.addEventListener) {
                  document.addEventListener('WeixinJSBridgeReady', onBridgeReady, false);
                } else if (document.attachEvent) {
                  document.attachEvent('WeixinJSBridgeReady', onBridgeReady);
                  document.attachEvent('onWeixinJSBridgeReady', onBridgeReady);
                }
              } else {
                onBridgeReady();
              }

            } else {
              alert('服务器异常!');
            }
          }, "json"
        );
      }

    }
  }
});

shop_cart.getPersonal();
