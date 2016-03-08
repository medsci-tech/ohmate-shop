var count = new Vue({
  el: 'costomer_count',
  methods: {
    getter: function() {
      $.get('/personal/statistics',{ log: 'show me the money' },
        function(data){
          if(data.success){
            count.data = JSON.parse(data);
          } else {
            alert('服务器被扫地大妈抱走了, 追回中...')
          }
        },'json')
    }
  }
});

count.getter();

var data1 = [];
var data2 = [];
var color_list = ["#F7464A","#46BFBD","#FDB45C","#949FB1","#4D5360"];
var highlight_list = ["#FF5A5E","#5AD3D1","#FFC870","#A8B3C5","#616774"];

for ( i = 1 ; i < count.customerArticleStatistics.length ; i++ ){
  data1.push({
    value: count.customerArticleStatistics[i].count,
    color: color_list[i%5],
    highlight: highlight_list[i%5],
    label: count.customerArticleStatistics[i].article_type_id
  });
  $('.data1').children().eq(i).child().css("background-color",color_list[i%5]);
}

for ( i = 1 ; i < count.customerCommodityStatistics.length ; i++ ){
  data2.push({
    value: count.customerCommodityStatistics[i].count,
    color: color_list[i],
    highlight: highlight_list[i],
    label: count.customerCommodityStatistics[i].commodity_id
  });
  $('.data2').children().eq(i).child().css("background-color",color_list[i%5]);
}

Chart.defaults.global.responsive = true;
var ctx = document.getElementById("study").getContext("2d");
var myStudy = new Chart(ctx).Pie(data1);
var ct2 = document.getElementById("consume").getContext("2d");
var myConsume = new Chart(ct2).Pie(data2);

