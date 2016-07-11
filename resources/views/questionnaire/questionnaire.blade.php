@extends('main')

@section('css')
  <link rel="stylesheet" href="{{asset('/')}}vendor/iCheck/all.css">
  <link rel="stylesheet" href="{{asset('/')}}vendor/buttons/buttons.css">
  <link rel="stylesheet" href="{{asset('/')}}vendor/swiper/swiper-3.3.0.min.css">
  <style>
    body {
      font-family: "Microsoft YaHei UI", "Helvetica Neue", Helvetica, Arial, sans-serif;
      position: relative;
      height: 100%;
    }

    .container {
      max-width: 750px;
    }

    .mainImg {
      max-width: 400px;
    }

    form {
      font-size: 20px;
    }

    form .iradio_flat-blue, .iradio_flat-blue {
      height: 24px;
    }

    .swiper-container {
      width: 100%;
      height: 100%;
    }

    .required {
      color: red;
    }

    .button {
      font-family: "Microsoft YaHei UI", "Helvetica Neue", Helvetica, Arial, sans-serif;
    }

    .radio-adjust {
      margin-top: 20px;
      margin-bottom: 20px;
    }

    .biaozhi {
      font-size: 40px;
    }

    label {
      display: inline;
    }


  </style>
@endsection

@section('content')
  <div class="container">
    <form action="localhost">
      <div class="swiper-container">
        <div class="swiper-wrapper">
          <div class="swiper-slide swiper-no-swiping">
            <h3 class="text-primary">1、糖尿病治疗方式</h3>

            <div class="radio radio-adjust">
              <input required name="q1" id="q1_c1" value="A" type="radio">
              <label for="q1_c1">
                <span class="text-warning">A</span>、注射胰岛素
              </label>
            </div>
            <div class="radio radio-adjust">
              <input required name="q1" id="q1_c2" value="B" type="radio">
              <label for="q1_c2">
                <span class="text-warning">B</span>、单纯使用口服药
              </label>
            </div>
            <!--<div class="mainImg">-->
            <!--<img class="img-responsive" src="image/q1.jpg" alt="q1">-->
            <!--</div>-->
            <p class="hidden required small">请选择一个选项!</p>
            <button type="button" id="button1" style="margin: auto; font-size: 80%;"
                    class=" button button-block button-large button-rounded button-primary">
              点这里点这里
            </button>
            <br>
            <br>
          </div>
          <!--0-->
          <div class="swiper-slide swiper-no-swiping">
            <h3 class="text-primary">2、注射起始时间</h3>

            <div class="radio radio-adjust">
              <input name="q2" id="q2_c1" value="A" type="radio">
              <label for="q2_c1">
                <span class="text-warning">A</span>、首次使用
              </label>
            </div>
            <div class="radio radio-adjust">
              <input name="q2" id="q2_c2" value="B" type="radio">
              <label for="q2_c2">
                <span class="text-warning">B</span>、既往停用后，重新开始使用
              </label>
            </div>
            <!--<div class="mainImg">-->
            <!--<img class="img-responsive" src="image/q2.jpg" alt="q2">-->
            <!--</div>-->
            <div class="radio radio-adjust">
              <input name="q2" id="q2_c3" value="C" type="radio">
              <label for="q2_c3">
                <span class="text-warning">C</span>、已停用
              </label>
            </div>
            <p class="hidden required small">请选择一个选项!</p>
            <button type="button" id="button2" style="margin: auto; font-size: 80%;"
                    class=" button button-block button-large button-rounded button-primary">
              选好了吗，选好了快点点我
            </button>
            <br>
            <br>
          </div>
          <!--1-->
          <div class="swiper-slide swiper-no-swiping">
            <h3 class="text-primary">3、使用的注射药物</h3>

            <!--<div class="mainImg">-->
            <!--<img class="img-responsive" src="image/q3.jpg" alt="q3">-->
            <!--</div>-->
            <div class="radio">
              <input name="q3" id="q3_c1" value="A" type="radio">
              <label for="q3_c1">
                <span class="text-warning">A</span>、诺和锐30&50
              </label>
              <!--<button type="button" class="small btn-link show-picture"><i class="glyphicon glyphicon-picture"></i>-->
              </button>
              <br>
            </div>
            <div class="radio">
              <input name="q3" id="q3_c2" value="B" type="radio">
              <label for="q3_c2">
                <span class="text-warning">B</span>、优泌乐25&50
              </label>
              <!--<button type="button" class="small btn-link show-picture"><i class="glyphicon glyphicon-picture"></i>-->
              </button>
              <br>
            </div>
            <div class="radio">
              <input name="q3" id="q3_c3" value="C" type="radio">
              <label for="q3_c3">
                <span class="text-warning">C</span>、诺和平
              </label>
              <!--<button type="button" class="small btn-link show-picture"><i class="glyphicon glyphicon-picture"></i>-->
              </button>
              <br>
            </div>
            <div class="radio">
              <input name="q3" id="q3_c4" value="D" type="radio">
              <label for="q3_c4">
                <span class="text-warning">D</span>、来得时
              </label>
              <!--<button type="button" class="small btn-link show-picture"><i class="glyphicon glyphicon-picture"></i>-->
              </button>
              <br>
            </div>
            <div class="radio">
              <input name="q3" id="q3_c5" value="E" type="radio">
              <label for="q3_c5">
                <span class="text-warning">E</span>、长秀霖
              </label>
              <!--<button type="button" class="small btn-link show-picture"><i class="glyphicon glyphicon-picture"></i>-->
              </button>
              <br>
            </div>
            <div class="radio">
              <input name="q3" id="q3_c6" value="F" type="radio">
              <label for="q3_c6">
                <span class="text-warning">F</span>、诺和锐
              </label>
              <!--<button type="button" class="small btn-link show-picture"><i class="glyphicon glyphicon-picture"></i>-->
              </button>
              <br>
            </div>
            <div class="radio">
              <input name="q3" id="q3_c7" value="G" type="radio">
              <label for="q3_c7">
                <span class="text-warning">G</span>、优泌乐
              </label>
              <!--<button type="button" class="small btn-link show-picture"><i class="glyphicon glyphicon-picture"></i>-->
              </button>
              <br>
            </div>
            <div class="radio">
              <input name="q3" id="q3_c8" value="H" type="radio">
              <label for="q3_c8">
                <span class="text-warning">H</span>、诺和平+诺和锐
              </label>
              <!--<button type="button" class="small btn-link show-picture"><i class="glyphicon glyphicon-picture"></i>-->
              </button>
              <br>
            </div>
            <div class="radio">
              <input name="q3" id="q3_c9" value="I" type="radio">
              <label for="q3_c9">
                <span class="text-warning">I</span>、诺和平+优泌乐
              </label>
              <!--<button type="button" class="small btn-link show-picture"><i class="glyphicon glyphicon-picture"></i>-->
              </button>
              <br>
            </div>
            <div class="radio">
              <input name="q3" id="q3_c10" value="J" type="radio">
              <label for="q3_c10">
                <span class="text-warning">J</span>、来得时+诺和锐
              </label>
              <!--<button type="button" class="small btn-link show-picture"><i class="glyphicon glyphicon-picture"></i>-->
              </button>
              <br>
            </div>
            <div class="radio">
              <input name="q3" id="q3_c11" value="K" type="radio">
              <label for="q3_c11">
                <span class="text-warning">K</span>、来得时+优泌乐
              </label>
              <!--<button type="button" class="small btn-link show-picture"><i class="glyphicon glyphicon-picture"></i>-->
              </button>
              <br>
            </div>
            <div class="radio">
              <input name="q3" id="q3_c12" value="L" type="radio">
              <label for="q3_c12">
                <span class="text-warning">L</span>、长秀霖+诺和锐
              </label>
              <!--<button type="button" class="small btn-link show-picture"><i class="glyphicon glyphicon-picture"></i>-->
              </button>
              <br>
            </div>
            <div class="radio">
              <input name="q3" id="q3_c13" value="M" type="radio">
              <label for="q3_c13">
                <span class="text-warning">M</span>、长秀霖+优泌乐
              </label>
              <!--<button type="button" class="small btn-link show-picture"><i class="glyphicon glyphicon-picture"></i>-->
              </button>
              <br>
            </div>
            <div class="radio">
              <input name="q3" id="q3_c14" value="N" type="radio">
              <label for="q3_c14">
                <span class="text-warning">N</span>、诺和力
              </label>
              <!--<button type="button" class="small btn-link show-picture"><i class="glyphicon glyphicon-picture"></i>-->
              </button>
              <br>
            </div>
            <div class="radio">
              <input name="q3" id="q3_c15" value="O" type="radio">
              <label for="q3_c15">
                <span class="text-warning">O</span>、百泌达
              </label>
              <!--<button type="button" class="small btn-link show-picture"><i class="glyphicon glyphicon-picture"></i>-->
              </button>
              <br>
            </div>
            <div class="radio">
              <input name="q3" id="q3_c16" value="P" type="radio">
              <label for="q3_c16">
                <span class="text-warning">P</span>、诺和灵系列
              </label>
              <!--<button type="button" class="small btn-link show-picture"><i class="glyphicon glyphicon-picture"></i>-->
              </button>
              <br>
            </div>
            <div class="radio">
              <input name="q3" id="q3_c17" value="Q" type="radio">
              <label for="q3_c17">
                <span class="text-warning">Q</span>、其他品牌人胰岛素系列
              </label>
              <!--<button type="button" class="small btn-link show-picture"><i class="glyphicon glyphicon-picture"></i>-->
              </button>
              <br>
            </div>
            <p class="hidden required small">请选择一个选项!</p>
            <button type="button" id="button3" style="margin: auto; font-size: 80%;"
                    class=" button button-block button-large button-rounded button-primary">
              看我，奖励在招手
            </button>
            <br>
            <br>
          </div>
          <!--2-->
          <div class="swiper-slide swiper-no-swiping">
            <h3 class="text-primary">4、您多久更换一次胰岛素针头</h3>

            <div class="radio">
              <input name="q4" id="q4_c1" value="A" type="radio">
              <label for="q4_c1">
                <span class="text-warning">A</span>、每次更换
              </label>
            </div>
            <div class="radio">
              <input name="q4" id="q4_c2" value="B" type="radio">
              <label for="q4_c2">
                <span class="text-warning">B</span>、每天更换
              </label>
            </div>
            <!--<div class="mainImg">-->
            <!--<img class="img-responsive" src="image/q3.jpg" alt="testImg">-->
            <!--</div>-->
            <div class="radio">
              <input name="q4" id="q4_c3" value="C" type="radio">
              <label for="q4_c3">
                <span class="text-warning">C</span>、1-3天更换
              </label>
            </div>
            <div class="radio">
              <input name="q4" id="q4_c4" value="D" type="radio">
              <label for="q4_c4">
                <span class="text-warning">D</span>、超过3天
              </label>
            </div>
            <div class="radio">
              <input name="q4" id="q4_c5" value="E" type="radio">
              <label for="q4_c5">
                <span class="text-warning">E</span>、更换胰岛素笔芯时更换
              </label>
            </div>
            <p class="hidden required small">请选择一个选项!</p>
            <button type="button" id="button4" style="margin: auto; font-size: 80%;"
                    class=" button button-block button-large button-rounded button-primary">
              点我点我，奖励就在眼前
            </button>
            <br>
            <br>
          </div>
          <!--3-->
          <div class="swiper-slide swiper-no-swiping">
            <h3 class="text-primary">3、停用胰岛素的原因是？</h3>

            <div class="radio">
              <input name="q3b" id="q3b_c1" value="A" type="radio">
              <label for="q3b_c1">
                <span class="text-warning">A</span>、自行停用
              </label>
            </div>
            <div class="radio">
              <input name="q3b" id="q3b_c2" value="B" type="radio">
              <label for="q3b_c2">
                <span class="text-warning">B</span>、医嘱要求停用
              </label>
            </div>
            <!--<div class="mainImg">-->
            <!--<img class="img-responsive" src="image/q3.jpg" alt="testImg">-->
            <!--</div>-->
            <p class="hidden required small">请选择一个选项!</p>
            <button type="button" id="button3b" style="margin: auto; font-size: 80%;"
                    class=" button button-block button-large button-rounded button-primary">
              点我点我，奖励就在眼前
            </button>
            <br>
            <br>
          </div>
          <!--4-->
          <div class="swiper-slide swiper-no-swiping">
            <h3 class="text-primary">2、您在服药期间出现过以下哪些症状？（可多选）</h3>

            <div class="checkbox">
              <input name="q2[]" id="q2b_c1" value="A" type="checkbox">
              <label for="q2b_c1">
                <span class="text-warning">A</span>、颤抖
              </label>
            </div>
            <div class="checkbox">
              <input name="q2[]" id="q2b_c2" value="B" type="checkbox">
              <label for="q2b_c2">
                <span class="text-warning">B</span>、心悸
              </label>
            </div>
            <!--<div class="mainImg">-->
            <!--<img class="img-responsive" src="image/q3.jpg" alt="testImg">-->
            <!--</div>-->
            <div class="checkbox">
              <input name="q2[]" id="q2b_c3" value="C" type="checkbox">
              <label for="q2b_c3">
                <span class="text-warning">C</span>、大汗淋漓
              </label>
            </div>
            <div class="checkbox">
              <input name="q2[]" id="q2b_c4" value="D" type="checkbox">
              <label for="q2b_c4">
                <span class="text-warning">D</span>、焦虑
              </label>
            </div>
            <div class="checkbox">
              <input name="q2[]" id="q2b_c5" value="E" type="checkbox">
              <label for="q2b_c5">
                <span class="text-warning">E</span>、头晕
              </label>
            </div>
            <div class="checkbox">
              <input name="q2[]" id="q2b_c6" value="F" type="checkbox">
              <label for="q2b_c6">
                <span class="text-warning">F</span>、饥饿难耐
              </label>
            </div>
            <div class="checkbox">
              <input name="q2[]" id="q2b_c7" value="G" type="checkbox">
              <label for="q2b_c7">
                <span class="text-warning">G</span>、视力模糊
              </label>
            </div>
            <div class="checkbox">
              <input name="q2[]" id="q2b_c8" value="H" type="checkbox">
              <label for="q2b_c8">
                <span class="text-warning">H</span>、疲惫不堪
              </label>
            </div>
            <div class="checkbox">
              <input name="q2[]" id="q2b_c9" value="I" type="checkbox">
              <label for="q2b_c9">
                <span class="text-warning">I</span>、头痛
              </label>
            </div>
            <div class="checkbox">
              <input name="q2[]" id="q2b_c10" value="J" type="checkbox">
              <label for="q2b_c10">
                <span class="text-warning">J</span>、烦躁
              </label>
            </div>
            <p class="hidden required small">请选择一个选项!</p>
            <button type="button" id="button2b" style="margin: auto; font-size: 80%;"
                    class=" button button-block button-large button-rounded button-primary">
              点我点我，奖励就在眼前
            </button>
            <br>
            <br>
          </div>
          <!--5-->
          <div class="swiper-slide swiper-no-swiping">
            <img class="img-responsive" src="{{url('/')}}image/questionnaire/finish.png" alt="">
            <br>
            <button type="submit" id="button5" style="margin: auto; font-size: 80%;"
                    class="button button-block button-large button-rounded button-primary center-block">
              点击领取奖卡
            </button>
            <br>
          </div>
          <!--6-->
          <!--<div class="swiper-slide swiper-no-swiping text-center">-->
          <!--<br>-->
          <!--<br>-->
          <!--<i class="biaozhi text-success glyphicon glyphicon-heart-empty"></i>-->
          <!--<br>-->
          <!--<br>-->

          <!--<p>感谢您填写调查问卷！</p>-->

          <!--<p>您可以去积分商城逛逛</p>-->
          <!--<br>-->
          <!--<button type="button" style="margin: auto" id="button_good"-->
          <!--class="button button-block button-large button-rounded button-action">-->
          <!--去易康商城逛逛-->
          <!--</button>-->
          <!--<br>-->
          <!--<br>-->
          <!--</div>-->
          <!--<div class="swiper-slide swiper-no-swiping text-center">-->
          <!--<br>-->
          <!--<br>-->
          <!--<i class="biaozhi text-warning glyphicon glyphicon-info-sign"></i>-->
          <!--<br>-->
          <!--<br>-->

          <!--<p>感谢您填写调查问卷！</p>-->

          <!--<p>根据您的注射习惯，<br>建议您学习安全注射的知识</p>-->
          <!--<br>-->
          <!--<button type="button" style="margin: auto" id="button_bad"-->
          <!--class="button button-block button-large button-rounded button-caution">-->
          <!--去学习安全注射知识-->
          <!--</button>-->
          <!--<br>-->
          <!--<br>-->
          <!--</div>-->
        </div>
      </div>
    </form>


  </div>

  <script src="{{asset('/')}}vendor/jQuery/jQuery-2.1.4.min.js"></script>
  <script src="{{asset('/')}}vendor/iCheck/icheck.js"></script>
  <script src="{{asset('/')}}vendor/swiper/swiper-3.3.0.min.js"></script>

  <script>
    $(document).ready(function () {

      $('input').iCheck({
        checkboxClass: 'icheckbox_flat-blue',
        radioClass: 'iradio_flat-blue',
        increaseArea: '20%' // optional
      });

      var swiper = new Swiper('.swiper-container', {
        autoHeight: true
      });

      $('button[class*="show-picture"]').click(function () {
        $('button[class*="show-picture"]').next().addClass('hide');
        $(this).next().removeClass('hide');
        swiper.update();
      });

      $('#button1').click(function () {
        check1 = $('#q1_c1').parent().attr('aria-checked');
        check2 = $('#q1_c2').parent().attr('aria-checked');
        if (check1 === 'true') {
          $(this).siblings('p').addClass('hidden');
          swiper.slideNext()
        } else if (check2 === 'true') {
          $(this).siblings('p').addClass('hidden');
          swiper.slideTo(5)
        } else {
          $(this).siblings('p').removeClass('hidden');
          swiper.update();
        }
      });

      $('#button2').click(function () {
        check1 = $('#q2_c1').parent().attr('aria-checked');
        check2 = $('#q2_c2').parent().attr('aria-checked');
        check3 = $('#q2_c3').parent().attr('aria-checked');
        if (check1 === 'true' || check2 === 'true') {
          $(this).siblings('p').addClass('hidden');
          swiper.slideNext()
        } else if (check3 === 'true') {
          $(this).siblings('p').addClass('hidden');
          swiper.slideTo(4)
        } else {
          $(this).siblings('p').removeClass('hidden');
          swiper.update();
        }
      });

      $('#button3').click(function () {
        var checked = false;
        $(this).siblings('.radio').children('div').each(function () {
          if ($(this).attr('aria-checked') === 'true') {
            checked = true;
          }
        });
        if (checked) {
          $(this).siblings('p').addClass('hidden');
          swiper.slideNext();
        } else {
          $(this).siblings('p').removeClass('hidden');
          swiper.update();
        }
      });

      $('#button4').click(function () {
        var checked = false;
        $(this).siblings('.radio').children('div').each(function () {
          if ($(this).attr('aria-checked') === 'true') {
            checked = true;
          }
        });
        if (checked) {
          $(this).siblings('p').addClass('hidden');
          swiper.slideTo(6);
        } else {
          $(this).siblings('p').removeClass('hidden');
          swiper.update();
        }
      });

      $('#button3b').click(function () {
        var checked = false;
        $(this).siblings('.radio').children('div').each(function () {
          if ($(this).attr('aria-checked') === 'true') {
            checked = true;
          }
        });
        if (checked) {
          $(this).siblings('p').addClass('hidden');
          swiper.slideTo(6);
        } else {
          $(this).siblings('p').removeClass('hidden');
          swiper.update();
        }
      });

      $('#button2b').click(function () {
        var checked = false;
        $(this).siblings('.checkbox').children('div').each(function () {
          if ($(this).attr('aria-checked') === 'true') {
            checked = true;
          }
        });
        if (checked) {
          $(this).siblings('p').addClass('hidden');
          swiper.slideTo(6);
        } else {
          $(this).siblings('p').removeClass('hidden');
          swiper.update();
        }
      });
    });


  </script>
@endsection