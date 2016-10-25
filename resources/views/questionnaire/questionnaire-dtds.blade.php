@extends('questionnaire.main')

@section('css')
  <link rel="stylesheet" href="{{asset('/')}}vendor/swiper/swiper-3.3.0.min.css">
  <style>
    body {
      font-family: "Microsoft YaHei UI", "Helvetica Neue", Helvetica, Arial, sans-serif;
      color: #fff;
      font-size: 16px;
    }

    .btn {
      border-radius: 8px;
      padding: 10px;
      font-size: 16px;
      border: none;
    }

    .background-img {
      width: 100%;
      height: 100%;
      position: fixed;
      top: 0;
      left: 0;
      background-color: rgb(140, 207, 239);
    }

    a:focus, a:hover {
      text-decoration: none;
    }

    label {
      font-weight: normal;
      width: 100%;
    }

    .question-number {
      margin-bottom: -5px;
    }

    .question-number div {
      width: 40px;
      height: 40px;
      padding-top: 6px;
      margin: auto;
      margin-bottom: -10px;
      font-size: 20px;
      font-weight: bold;
      background-color: #30a7df;
      border-radius: 100%;
    }

    .question-name {
      padding: 20px 20px 30px 20px;
      background: url(/image/questionnaire/蓝色彩带.png) no-repeat center;
      background-size: cover;
      font-size: 16px;
    }

    .question-remark {
      text-align: center;
      margin-top: -30px;
    }

    .question-line {
      width: 100%;
      margin: -40px 0 -30px 0;
    }

    .option-heading {
      padding-left: 0;
      padding-right: 10px;
    }

    .option-heading div {
      width: 32px;
      height: 32px;
      padding-top: 4px;
      margin: auto;
      border: 1px solid #fff;
      background-color: #337ab7;
      border-radius: 100%;
      text-align: center;
    }

    .container {
      padding: 15px;
      margin: 15px;
      background-color: rgba(47, 168, 255, 0.5);
      border-radius: 10px;
    }

    .option-content {
      min-height: 34px;
      padding-top: 5px;
      padding-bottom: 5px;
      display: inline-block;
      border: 1px solid #fff;
      background-color: #337ab7;
      border-radius: 5px;
    }

    .option-content img {
      width: 70%;
      float: right;
      margin-bottom: 10px;
      margin-top: 20px;
    }

    .checkbox-heading {
      padding-top: 6px;
      padding-right: 0;
    }

    .checkbox-content {
      padding-left: 0;
    }

    .checkbox-content label {
      display: inline;
    }

    .checkbox-content label div {
      width: 31%;
      padding-left: 0;
      padding-right: 0;
      text-align: center;
      border-color: #fff;
    }

    .choosen {
      background-color: #5cb85c !important;
      border: 1px solid #fff;
      box-sizing: border-box;
    }

    [v-cloak] {
      display: none;
    }

  </style>
@endsection

@section('content')
  <div class="background-img">
    <img class="img-responsive" src="/image/questionnaire/背景-1.png" alt="">
  </div>

  <form action="" method="post" id="questionnaire" v-cloak>
    <input type="hidden" name="_token" value="{{ csrf_token() }}">
    <div class="swiper-container">
      <div class="swiper-wrapper">
        <div class="swiper-slide swiper-no-swiping">
          <br>

          <div class="text-center">
            <div style="margin-top: -60px;margin-bottom: -50px;"><img style="width: 200px" src="/image/questionnaire/logo.png" alt=""></div>
          </div>


          <img class="question-line" src="/image/questionnaire/线.png" alt="">

          <div class="container" style="background-color: rgba(47, 168, 255, 0.8);">
            <img style="width: 100%; margin-top: -30px;" src="/image/questionnaire/WDFlogo.png" alt="">
            <p style="flood-color: #aaa">欢迎您参与世界糖尿病基金会在中国发起的城镇化糖尿病移动教育项目(项目编号:WDF14-922)并关注"易康伴侣"健康平台。您可以在平台浏览糖尿病相关知识，并可以通过学习获取积分奖励，兑换包括胰岛素针头在内的各种健康产品。
              <br>现在，我们邀请您花一分钟时间填写一份问卷，只需要不超过5步，就可以领取一份健康小礼品哟~</p>
          </div>
          <div class="col-xs-12">
            <button @click="start" type="button" class="btn btn-primary btn-block">
            答题领好礼
            </button>
          </div>
        </div>
        <div class="swiper-slide swiper-no-swiping" v-for="question in radio" id="@{{question.id}}">
          <br>

          <div class="text-center question-number">
            <div><span>@{{ question.number_zhCN }}</span></div>
          </div>

          <p class="text-center question-name">
            <span>@{{ question.name_zhCN }}</span>

          <div v-if="question.name_remark" class="question-remark">
            <small class="text-primary">@{{ question.name_remark }}</small>
          </div>
          </p>
          <img class="question-line" src="/image/questionnaire/线.png" alt="">

          <div class="container">
            <div class="form-group"></div>
            <div class="form-group" v-for="(letter,option) in question.option">
              <label for="@{{question.id}}_c@{{$index+1}}">
                <div class="option-heading col-xs-2">
                  <div :class=" question.value==letter ? 'choosen' : '' ">@{{{'&#'+(65+ $index)+';'}}}</div>
                </div>
                <div class="option-content col-xs-10" :class=" question.value==letter ? 'choosen' : '' ">
                  <span>@{{option}}</span>
                  <img v-if="question.option_img&&question.option_img[$index]" class="" :src="'/image/questionnaire/'+question.option_img[$index]" alt="">
                </div>
              </label>
              <input class="hidden" type="radio" name="@{{question.id}}" id="@{{question.id}}_c@{{$index+1}}"
                     v-model="question.value"
                     value="@{{letter}}">
            </div>
          </div>
          <div class="col-xs-6">
            <button @click="preview(question)" v-if="question.preview" type="button" class="btn btn-primary btn-block">
            上一题
            </button>
          </div>
          <div class="col-xs-6">
            <button @click="next(question)" v-if="question.next&&question.value"
            type="button" class="btn btn-primary btn-block">
            下一题
            </button>
          </div>
          <div class="col-xs-6">
            <button v-if="!question.next&&question.value" @click.prevent="submit" type="submit"
                    class="btn btn-primary btn-block">提交
            </button>
          </div>
          <div class="col-xs-6">
            <button v-if="!question.preview&&!question.value" type="button" class="btn btn-primary btn-block fade">占位
            </button>
          </div>
        </div>

      </div>
    </div>
    <br>
  </form>

  <script src="{{asset('/')}}vendor/jQuery/jQuery-2.1.4.min.js"></script>
  <script src="{{asset('/')}}js/vendor/vue.js"></script>
  <script src="{{asset('/')}}vendor/swiper/swiper-3.3.0.min.js"></script>

  <script>
    var question_data = [];

    $.ajaxSetup({
        async : false
    }); 

    $.get('/questionnaire3/questions',{},function(data){
      if(data){
        for ( item in data ){
          question_data.push(data[item]);
        }
      }
    });

    var question_length = question_data.length;

    for(i=0; i<question_length; i++){
      question_data[i].length = 0;
      for( item in question_data[i].answer){
        question_data[i].length ++;
      }
    }

    var vm = new Vue({
      el: "#questionnaire",
      data: {
        radio: [
          {
            id: 'q1',
            number_zhCN: '一',
            name_zhCN: question_data[0].question,
            option: question_data[0].answer,
            option_img: null,
            preview: null,
            next: 'q2',
            value: null
          },
          {
            id: 'q2',
            number_zhCN: '二',
            name_zhCN: question_data[1].question,
            option: question_data[1].answer,
            option_img: null,
            preview: null,
            next: 'q3',
            value: null
          },
          {
            id: 'q3',
            number_zhCN: '三',
            name_zhCN: question_data[2].question,
            option: question_data[2].answer,
            option_img: null,
            preview: null,
            next: 'q4',
            value: null
          },
          {
            id: 'q4',
            number_zhCN: '四',
            name_zhCN: question_data[3].question,
            option: question_data[3].answer,
            option_img: null,
            preview: null,
            next: 'q5',
            value: null
          },
          {
            id: 'q5',
            number_zhCN: '五',
            name_zhCN: question_data[4].question,
            option: question_data[4].answer,
            option_img: null,
            preview: null,
            next: null,
            value: null
          },
        ],
        checkbox: [
          // {
          //   id: 'q1b',
          //   number_zhCN: '二',
          //   name_zhCN: '口服药物等其它治疗方式(多选)',
          //   option: {
          //     '阿卡波糖': ['拜糖平', '卡博平', '贝希'],
          //     '二甲双胍': ['格华止', '利龄', '信谊'],
          //     '瑞格列奈': ['诺和龙', '孚来迪'],
          //     '格列美脲': ['亚莫利', '万苏平', '林美欣'],
          //     '伏格列波糖': ['倍欣', '家能', '安立泰'],
          //     '其他': ['其他']
          //   },
          //   option_img: null,
          //   checked_items: [],
          //   preview: 'q1',
          //   next: null
          // }
        ]
      },
      methods: {
        start: function () {
          swiper.slideNext();
        },
        preview: function (e) {
          if (e.value) {
            e.value = null;
          }
          if (e.checked_items) {
            e.checked_items = [];
          }
          swiper.slideTo($('.swiper-slide').index($('#' + e.preview)));
        },
        next: function (e) {
          var next = e.next;

          var radio_length = this.radio.length;
         
          var i = 0;
          

          while (i < radio_length) {
            if (this.radio[i].id === next) {
              this.radio[i].preview = e.id;
              i = radio_length;
            }
            i++;
          }

          
          swiper.slideTo($('.swiper-slide').index($('#' + next)));
        },
        submit: function (){
          var right = 0;
          for(var i=0; i<question_length; i++){
            if ( this.radio[i].value == question_data[i].right){
              right++;
            } 
          }
          if (right>=3){
            alert('恭喜您,答题成功!');
            window.location.href="/shop/yiyuan-index"; 
          } else {
            alert('答题正确数少于3个,请重新答题!');
            history.go(0);
          }
        }
      }
    });

    var swiper = new Swiper('.swiper-container', {
      autoHeight: true,
      effect: 'fade',
      fade: {
        crossFade: true
      }
    });


  </script>
@endsection