if (localStorage.cart != 'undefined' && localStorage.cart) {
  var cart = JSON.parse(localStorage.cart);
} else {
  var cart = [];
}


var shop_cart = new Vue({
    el: '#cart_form',
    data: {
      cart: cart,

      person: {
        beans: 90000,
        consume: 0
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
        this.person.consume =
          this.person.beans < this.priceAll * 100 ? this.person.beans : this.priceAll * 100;
        return this.person.consume / 100;
      },
      priceCount: function () {
        if (this.address == null) {
          return this.priceAll + 8 - this.priceDiscount;
        } else {
          return this.priceAll + this.address.postage - this.priceDiscount;
        }
      },
      postage: function () {
        if (this.address == null) {
          return 8;
        } else {
          return this.address.postage;
        }
      }

    },

    methods: {
      removeGoods: function (e) {
        this.cart.$remove(e);
        localStorage.cart = JSON.stringify(this.cart);
      }
      ,
      priceGoods: function (e) {
        return e.price * e.num;
      }
      ,
      numMinus: function (e) {
        if (e.num >= 2) {
          e.num--;
        }
      }
      ,
      numAdd: function (e) {
        if (e.num <= 98) {
          e.num++;
        }
      }
      ,
      beansConsume: function () {
      }
      ,
      postCart: function () {
        console.log(JSON.stringify(shop_cart.$data));
        $.post('/shop/order/create', JSON.stringify(shop_cart.$data),
          function (data) {
            if (data.success) {
              function onBridgeReady() {
                WeixinJSBridge.invoke(
                  'getBrandWCPayRequest', {
                    "appId": "wx2421b1c4370ec43b",     //公众号名称，由商户传入
                    "timeStamp": " 1395712654",         //时间戳，自1970年以来的秒数
                    "nonceStr": "e61463f8efa94090b1f366cccfbbb444", //随机串
                    "package": "prepay_id=u802345jgfjsdfgsdg888",
                    "signType": "MD5",         //微信签名方式：
                    "paySign": "70EA570631E4BB79628FBCA90534C63FF7FADD89" //微信签名
                  },
                  function (res) {
                    if (res.err_msg == "get_brand_wcpay_request：ok") {
                      shop_cart.cart = [];
                      localStorage.cart.clear();
                      $.post('/shop/order/create', {"get_brand_wcpay_request": "ok"},
                        function (data) {
                          if (data.success){
                          }
                        }, "json"
                      );
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
  })
  ;

