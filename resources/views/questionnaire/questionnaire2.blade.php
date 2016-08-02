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
      background: url(image/questionnaire/蓝色彩带.png) no-repeat center;
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
            <div class="form-group" v-for="option in question.option">
              <label for="@{{question.id}}_c@{{$index+1}}">
                <div class="option-heading col-xs-2">
                  <div :class=" question.value==option ? 'choosen' : '' ">@{{{'&#'+(65+ $index)+';'}}}</div>
                </div>
                <div class="option-content col-xs-10" :class=" question.value==option ? 'choosen' : '' ">
                  <span>@{{option}}</span>
                  <img v-if="question.option_img&&question.option_img[$index]" class="" :src="'/image/questionnaire/'+question.option_img[$index]" alt="">
                </div>
              </label>
              <input class="hidden" type="radio" name="@{{question.id}}" id="@{{question.id}}_c@{{$index+1}}"
                     v-model="question.value"
                     value="@{{option}}">
            </div>
          </div>
          <div class="col-xs-6">
            <button @click="preview(question)" v-if="question.preview" type="button" class="btn btn-primary btn-block">
            上一题
            </button>
          </div>
          <div class="col-xs-6">
            <button @click="next(question)" v-if="question.next[question.option.indexOf(question.value)]&&question.value"
            type="button" class="btn btn-primary btn-block">
            下一题
            </button>
          </div>
          <div class="col-xs-6">
            <button v-if="!question.next[question.option.indexOf(question.value)]&&question.value" type="submit"
                    class="btn btn-primary btn-block">提交
            </button>
          </div>
          <div class="col-xs-6">
            <button v-if="!question.preview&&!question.value" type="button" class="btn btn-primary btn-block fade">占位
            </button>
          </div>
        </div>
        <div class="swiper-slide swiper-no-swiping" v-for="question in checkbox" id="@{{question.id}}">
          <br>

          <div class=" text-center question-number">
            <div><span>@{{ question.number_zhCN }}</span></div>
          </div>

          <p class="text-center question-name">
            <span>@{{ question.name_zhCN }}</span>
          </p>
          <img class="question-line" src="image/questionnaire/线.png" alt="">

          <div class="container">
            <div class="form-group"></div>
            <div class="form-group" v-for="(index,options) in question.option">
              <div class="row">
                <div class="col-xs-4 checkbox-heading">
                  <div>@{{ index }}:</div>
                </div>
                <div class="col-xs-8 checkbox-content">
                  <label v-for="option in options">
                    <div class="btn btn-primary" :class="(question.checked_items.indexOf(option)>-1) ? 'choosen' : ''">@{{
                    option }}
                    </div>
                    <input class="hidden" type="checkbox" name="@{{question.id}}[]" v-model="question.checked_items" value="@{{ option }}">
                  </label>
                </div>
              </div>
            </div>
          </div>
          <div class="col-xs-6">
            <button @click="preview(question)" v-if="question.preview" type="button" class="btn btn-primary btn-block">上一题</button>
          </div>
          <div class="col-xs-6">
            <button @click="next(question)" v-if="question.next&&(question.checked_items.length!=0)" type="button"
            class="btn btn-primary btn-block">
            下一题
            </button>
          </div>
          <div class="col-xs-6">
            <button v-if="!question.next&&(question.checked_items.length!=0)" type="submit"
                    class="btn btn-primary btn-block">提交
            </button>
          </div>
          <div class="col-xs-6">
            <button v-if="!question.preview&&(question.checked_items.length==0)" type="button"
                    class="btn btn-primary btn-block fade">占位
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
    var vm = new Vue({
      el: "#questionnaire",
      data: {
        radio: [
          {
            id: 'q1',
            number_zhCN: '一',
            name_zhCN: '请选择您的糖尿病治疗方式',
            option: ['注射胰岛素', '口服药等其他治疗方式'],
            option_img: ['诺和笔.png', '糖果.png'],
            preview: null,
            next: ['q2', 'q1b'],
            value: null
          }, {
            id: 'q2',
            number_zhCN: '二',
            name_zhCN: '请选择胰岛素注射起始时间',
            option: ['我是一周内开始首次使用', '既往停用后重新开始使用', '使用超过一周', '已停用'],
            option_img: null,
            preview: null,
            next: ['q3', 'q3', 'q3', null],
            value: null
          }, {
            id: 'q3',
            number_zhCN: '三',
            name_zhCN: '请选择您正在使用的胰岛素治疗方案',
            option: ['一天1针', '一天2针', '一天3针', '一天4针', '胰岛素泵'],
            option_img: null,
            preview: null,
            next: ['q3a', 'q3b', 'q3c', 'q3d', 'q3e'],
            value: null
          }, {
            id: 'q3a',
            number_zhCN: 'A',
            name_zhCN: '一天1针',
            option: ['诺和锐30', '诺和平', '诺和力', '来得时', '长秀霖', '诺和灵系列', '其他'],
            option_img: ['诺和锐30.png', '诺和平.png', '诺和力.png', '来得时.png', '长秀霖.png', '诺和灵系列.png', null],
            preview: null,
            next: ['q4', 'q4', 'q4', 'q4', 'q4', 'q4', 'q4'],
            value: null
          }, {
            id: 'q3b',
            number_zhCN: 'B',
            name_zhCN: '一天2针',
            option: ['诺和锐30&50', '优泌乐25&50', '百泌达', '诺和灵系列', '其他'],
            option_img: ['诺和锐30&50.png', '优泌乐25&50.png', '百泌达.png', '诺和灵系列.png', null],
            preview: null,
            next: ['q4', 'q4', 'q4', 'q4', 'q4'],
            value: null
          }, {
            id: 'q3c',
            number_zhCN: 'C',
            name_zhCN: '一天3针',
            option: ['诺和锐30&50', '诺和锐', '优泌乐25&50', '诺和灵系列', '其他'],
            option_img: ['诺和锐30&50.png', '诺和锐.png', '优泌乐25&50.png', '诺和灵系列.png', null],
            preview: null,
            next: ['q4', 'q4', 'q4', 'q4', 'q4'],
            value: null
          }, {
            id: 'q3d',
            number_zhCN: 'D',
            name_zhCN: '一天4针',
            option: ['诺和锐', '优泌乐', '诺和灵系列', '其他'],
            option_img: ['诺和锐.png', '优泌乐.png', '诺和灵系列.png', null],
            preview: null,
            next: ['q3d2', 'q3d2', 'q4', 'q4'],
            value: null
          }, {
            id: 'q3d2',
            number_zhCN: 'D',
            name_zhCN: '一天4针',
            option: ['来得时', '长秀霖', '诺和平'],
            option_img: ['来得时.png', '长秀霖.png', '诺和平.png'],
            preview: 'q3d',
            next: ['q4', 'q4', 'q4'],
            value: null
          }, {
            id: 'q3e',
            number_zhCN: 'E',
            name_zhCN: '胰岛素泵',
            option: ['诺和锐', '优泌乐', '其他'],
            option_img: ['诺和锐.png', '优泌乐.png', null],
            preview: null,
            next: ['q4', 'q4', 'q4'],
            value: null
          }, {
            id: 'q4',
            number_zhCN: '四',
            name_zhCN: '您认为应该多长时间更换一次针头',
            option: ['每次注射都需要更换', '每天更换一次', '3-5天更换一次', '更换胰岛素笔芯时更换'],
            option_img: null,
            preview: null,
            next: [null, null, null, null],
            value: null
          }
        ],
        checkbox: [
          {
            id: 'q1b',
            number_zhCN: '二',
            name_zhCN: '口服药物等其它治疗方式(多选)',
            option: {
              '阿卡波糖': ['拜糖平', '卡博平', '贝希'],
              '二甲双胍': ['格华止', '利龄', '信谊'],
              '瑞格列奈': ['诺和龙', '孚来迪'],
              '格列美脲': ['亚莫利', '万苏平', '林美欣'],
              '伏格列波糖': ['倍欣', '家能', '安立泰'],
              '其他': ['其他']
            },
            option_img: null,
            checked_items: [],
            preview: 'q1',
            next: null
          }
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
          var next;
          if (Array.isArray(e.next)) {
            next = e.next[e.option.indexOf(e.value)];
          }
          if (!Array.isArray(e.next)) {
            next = e.next;
          }

          var radio_length = this.radio.length;
          var checkbox_length = this.checkbox.length;
          var i = 0;
          var j = 0;

          while (i < radio_length) {
            if (this.radio[i].id === next) {
              this.radio[i].preview = e.id;
              i = radio_length;
              j = checkbox_length;
            }
            i++;
          }

          while (j < checkbox_length) {
            if (this.radio[j].id === next) {
              this.radio[j].preview = e.id;
              j = checkbox_length;
            }
            j++;
          }

          swiper.slideTo($('.swiper-slide').index($('#' + next)));
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

    $(function () {
      $('#q3d .col-xs-6').eq(1).addClass('hide');
      $('#q3d2 .col-xs-6').eq(0).children().text('返 回');
      $('#q3d2 label span').text(function(){
        return '与'+$(this).text()+'同时使用'
      });
      $('#q3d_c1,#q3d_c2').siblings().click(function(){
        swiper.slideNext(false,500);
      });
      $('#q3d_c3,#q3d_c4').siblings().click(function(){
        $('#q3d .col-xs-6').eq(1).removeClass('hide');
      });
      $("[src$='诺和锐30&50.png'],[src$='优泌乐25&50.png']").css('width','100%');
      $("[src$='诺和笔.png'],[src$='糖果.png']").css({'width':'50%','margin-top':'0'});
    });
  </script>
@endsection