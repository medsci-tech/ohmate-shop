/**
 * Created by 鹏飞 on 2016/2/18.
 */

var cart = [
  {
    id: '1',
    name: '易折清洁消毒棒',
    tag: '一次性使用无菌注射针',
    price: 22.00,
    priceBefore: 30.00,
    num: 1
  }
];

localStorage.cart = JSON.stringify(cart);



var list = new Vue({
    el: '#goods',
    data: {
      goods: {
        id: '2',
        name: '易折清洁消毒棒',
        tag: '一次性使用无菌注射针',
        price: 22.00,
        priceBefore: 30.00,
        num: 1
      },
      cart: JSON.parse(localStorage.cart)
    },
    computed: {
      alreadyHave: function () {
        for (i = 0; i < this.cart.length; i++) {
          if (this.cart[i].id == this.goods.id) {
            return i;
          }
        }
        return -1;
      }
    },

    methods: {
      addGoods: function () {
        if (this.alreadyHave != -1) {
          this.cart[this.alreadyHave].num += this.goods.num;
          localStorage.cart = JSON.stringify(this.cart);
        } else {
          this.cart.push(this.goods);
          localStorage.cart = JSON.stringify(this.cart);
          this.cart = JSON.parse(localStorage.cart);
        }
        this.goods.num = 1;
      },
      numMinus: function () {
        if (this.goods.num >= 2) {
          this.goods.num--;
        }
      },
      numAdd: function () {
        if (this.goods.num <= 98) {
          this.goods.num++;
        }
      }
    }
  })
  ;
