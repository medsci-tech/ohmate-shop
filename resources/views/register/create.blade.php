<!DOCTYPE html>
<html>
<head lang="en">
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=no">
  <title>用户注册</title>
  <link rel="stylesheet" href="{{asset('/css/register.css')}}">
</head>
<body>
<div class="container">
  <form class="register" action="{{url('/register/store')}}" method="POST">
    <div class="form-group">
      <label><span id="label_phone"></span>
        <input type="text" name="phone" id="phone" class="form-control" placeholder="请输入手机号" required>
      </label>
    </div>
    <div class="form-group">
      <label><span id="label_code"></span>
        <input type="text" name="code" id="code" class="form-control" placeholder="请输入验证码" required>
      </label>
      <button type="button" class="btn btn-info" onclick='turnTo();'>获取验证码</button>
    </div>
    <button type="submit" class="btn btn-block">确&emsp;认</button>
    <div class="checkbox">
      <label>
        <input type="checkbox" checked required>
        已阅读并同意
      </label>
      <button type="button" class="btn-link" data-toggle="modal" data-target="#myModal">《易康伴侣服务协议》</button>
    </div>
    {{csrf_field()}}
  </form>
  <div id="myModal2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h4 class="modal-title text-center" id="myModalLabel2">&emsp;成为会员有什么好处？</h4>
        </div>
        <div class="modal-body">
          <p>1. 注册即可获得21.8元现金。</p>
          <p>2. 可在积分商城免费领取礼品。</p>
          <p>3. 学习糖尿病知识还可获得更多积分。</p>
          <p>4. 注册后即可参与有奖活动，轻松抱回礼品。</p>
          <p>5. 学习贵在坚持，糖尿病学堂内容每周都会更新。</p>
        </div>
      </div>
    </div>
  </div>
  <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
          <h4 class="modal-title text-center" id="myModalLabel">&emsp;易康伴侣服务协议</h4>
        </div>
        <div class="modal-body">
          <p>【易康伴侣】的产品和服务是易康伴侣（武汉）科技有限责任公司（以下简称“易康科技”）拥有、管理和维护的。本用户协议是用户在注册或使用【易康伴侣】的产品和服务时与易康科技之间的协议。请用户在使用本产品和服务前认真阅读并充分理解本协议中各条款，包括免除或者限制易康科技责任的免责条款及对用户的权利限制。如果您使用【易康伴侣】的产品和服务时，您的使用行为将被视为对本协议全部内容的认可，并同意接受本协议各项条款的约束。您对本协议的接受还包括接受易康科技对用户协议随时所做的任何修改，这些条款由易康科技随时更新，且无需另行通知。您在使用【易康伴侣】的产品和服务的同时即是对以下所有条款的接受和遵守。</p>

          <h4>一 使用规则</h4>

          <p>1.	用户不得在【易康伴侣】客户端和商城上传或发布任何非法、恶意、恐吓、欺诈、诽谤、种族歧视、淫秽猥亵等不当信息（包括但不限于任何可能侵犯他人权益、违反中国或其他国家法律或产生民事责任或刑事责任之言论、资料或内容）。</p>
          <p>2.	【易康伴侣】保有删除不符合本协议约定或不符合法律法规并由用户发布的信息且无需通知用户的权利，同时【易康伴侣】有权就用户违反本条第一款规定而作出独立判断并采取暂停或关闭用户账号等措施。用户需对自己在客户端和商城上的言论和行为承担法律责任。</p>
          <p>3.	用户同意接受【易康伴侣】及其合作第三方通过自身软件向用户发送商品促销或其他相关商业信息。</p>
          <p>4.	用户接受【易康伴侣】提供的服务时，可能需向【易康伴侣】或第三方支付一定的费用。在此情况下，【易康伴侣】会在相关页面上做明确的提示。【易康伴侣】将有权决定【易康伴侣】所提供的产品和服务的资费标准和收费方式，【易康伴侣】可能会就不同的产品和服务制定不同的资费标准和收费方式，也可能按照【易康伴侣】所提供的产品和服务的不同阶段确定不同的资费标准和收费方式。另外，【易康伴侣】也可能不时地修改【易康伴侣】的资费政策。如用户不同意支付该等费用，或不同意【易康伴侣】资费政策中的任何内容，则可以选择不接受相关的服务。此外，用户通过【易康伴侣】向第三方提供服务时，可能会获得【易康伴侣】或第三方支付的一定费用或获得相应的奖励。【易康伴侣】将有权决定该等费用或奖励的支付方式和政策，并可能不时地修改。如用户不同意该等支付方式，或不同意支付政策中的任何内容，则可以选择不通过【易康伴侣】向第三方提供相关的服务。</p>

          <h4>二 服务风险及免责声明</h4>

          <p> 1.	因Internet服务存在因不可抗力、移动通讯终端病毒或黑客攻击、系统不稳定、用户所在位置、用户关机以及其他任何技术、互联网络、通信线路原因等造成的服务中断、数据丢失或不能满足用户要求的风险。用户须自行承担以上风险。</p>
          <p>2.	因手机或电脑的多样性，用户的手机或电脑可能并不支持【易康伴侣】客户端软件。由于手机型号或电脑不相匹配所导致的无法正常使用的问题可以联络【易康伴侣】的客服处理；而对由于手机型号或电脑不相匹配所导致任何手机问题或损害，均由用户自行承担以上风险。</p>
          <p>3.	用户手机或电脑隐私信息在使用本软件及服务时可能产生的非【易康伴侣】责任的信息安全风险，【易康伴侣】不承担由此给您带来的任何不便或损失。</p>
          <p>4.	安装或卸载客户端软件可能会引起的手机或电脑系统的不稳定，【易康伴侣】不承担由此给您带来的任何不便或损失。</p>
          <p>5.	【易康伴侣】客户端和【易康伴侣】商城中涉及到慢性病科普知识的宣传和咨询以及医患之间的互动服务，其仅为传播有益健康咨询为目的，【易康伴侣】致力于提供正确、完整的慢性病的咨询和宣传，但不对其真实性、科学性、严肃性和完整性做任何形式的保证，且不对其信息的不正确或遗漏导致的任何损失或损害承担责任。上述资讯，不得作为任何决定或行动的依据。如果您有相关疑问，请您务必另行征询医生或其他有医疗资格的专业人士的意见。</p>
          <p>6.	本客户端软件和商城所载之商品或服务信息仅适用于中华人民共和国大陆区域范围，所涉及的产品在不同国家和地区可能出现不同的标签或说明，对此【易康伴侣】不承担任何责任。</p>

          <h4>三 隐私权保护</h4>

          <p>1.	【易康伴侣】尊重并保护所有用户的个人隐私权，您注册的用户名、手机号码、电子邮件地址等个人资料，非经您亲自许可或根据相关法律、法规的强制性规定，【易康伴侣】不会主动地泄露给第三方。</p>
          <p>2.	为服务用户的目的，【易康伴侣】可通过使用用户的个人信息，向用户提供服务，包括但不限于向用户发出活动和服务信息等。</p>
          <p>3.	用户不得将在易康伴侣注册取得的账户借给他人使用，否则用户将承担由此产生的全部风险，并与实际使用人承担连带责任。</p>
          <p>4.	用户知悉并同意，为便于提升【易康伴侣】产品质量及更好地服务用户，【易康伴侣】有权收集用户的个人健康档案信息，并对该些信息进行分析、整合，自行或授权与【易康伴侣】具有合作关系的第三方合法使用该等信息，而无需另行获得用户授权或许可。</p>
          <p>5.	用户同意，易康伴侣有权使用用户的注册信息、用户名及密码，登录进入用户的账户进行证据保全，包括但不限于公证、见证等。</p>

          <h4>四  商城购物</h4>

          <p>1.	【易康伴侣】商城平台提供购物服务，商城中的商品价格、数量、是否有货等信息随时会发生变化，商城不做另行通知。【易康伴侣】尽可能保证您所浏览商品信息的准确性，但由于商品信息的数量极其庞大，商城中提供的信息可能会有滞后性，请您知悉并谅解。</p>
          <p>2.	在您下订单时，请确认所购商品的名称、数量、价格、型号、规格、收货地址、收货人姓名、联系电话等信息。收货人与用户不一致时，以收货人的行为和意思表示为用户的行为和意思表示，用户需对收货人的行为及意思表示承担连带责任。</p>
          <p>3.	由于受到市场变化及难以控制因素的影响，【易康伴侣】无法保证您所提交的订单里的商品有库存，如果发生缺货断货的情况，您有权利取消订单。</p>
          <p>4.	【易康伴侣】会尽快将商品配送到您订单中列明的收货地址，商城中列出的送货时间为参考时间，参考时间是根据库存状况、包装转送等正常的处理时间、送货地点等因素估算得出的。您可以随时登录账户查询订单状况。</p>
          <p>5.	如因以下情况造成配送迟延或无法配送，【易康伴侣】不承担责任：</p>
          <p>（1）用户提供的信息错误、地址不详细；</p>
          <p>（2）商品送达后无人签收；</p>
          <p>（3）情势变更；</p>
          <p>（4）不可抗力，如：自然灾害、交通戒严或管制、限制运输、突发战争等。</p>

          <h4>五  积分及换购活动</h4>

          <p>1.	【易康伴侣】根据用户的购物、参与学习互动、提供业务指导等情形可以给予相应的积分，积分的表现形式为迈豆。迈豆是【易康伴侣】对用户行为或服务的一种奖励和回馈，用户可在商城使用迈豆兑换商品。对迈豆的获取途径、数量、有效期限，【易康伴侣】享有最终解释权。</p>
          <p>2.	用户可通过充值服务、购物、参与活动获取迈豆。在【易康伴侣】提供的医患服务环节，用户提供医学指导或参与点评、互动等服务亦可获得迈豆。</p>
          <p>3.	用户可使用迈豆在积分商城兑换商品，商品因供货商要求、商品数量等因素影响会不定期进行调整，具体信息请以积分兑换页面为准。用户通过兑换积分获得的商品，【易康伴侣】概不提供发票。</p>
          <p>4.	用户使用迈豆兑换商品后，所消耗的迈豆不提供修正或退还等操作服务。</p>
          <p>5.	任何组织和个人不得进行迈豆的倒卖、转卖、交易等非法牟利行为，不得以任何不正当手段恶意获取迈豆，包括但不限于黑客攻击、利用漏洞不当获取、非正规渠道取得，等等。一旦发现用户通过不正当手段获取迈豆，则【易康伴侣】保有追回用户迈豆的权利，并有权对违反此规定的用户进行严肃处理，包括但不限于冻结积分、扣还积分、清零积分、追回积分兑换的物品、封停账号、刑事报案或其他手段，等等。</p>

          <h4>六 其他</h4>

          <p>1.	本用户协议的制定、执行和解释及争议的解决适用中华人民共和国法律。</p>
          <p>2.	如用户与【易康伴侣】就履行本用户协议发生纠纷，则双方可友好协商解决。解决不成的，则任一方可向易康科技所在地法院通过诉讼方式解决。</p>
          <p>3.	本用户协议的条款解释权及迈豆积分及兑换规则的最终解释权归【易康伴侣】所有。</p>

        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default btn-block center-block" data-dismiss="modal">确&emsp;认</button>
        </div>
      </div>
    </div>
  </div>
</div>

<script src="{{asset('/js/vendor/jquery-2.1.4.min.js')}}"></script>
<script src="{{asset('/js/vendor/bootstrap.min.js')}}"></script>
<script type="text/javascript">
  function validateMobile() {
    var mobile = document.getElementById('phone').value;
    var code = document.getElementById('code').value;
    if (mobile.length == 0) {
      document.getElementById('label_phone').innerText = '请输入手机号码！';
      document.getElementById('phone').focus();
      return false;
    }
    if (mobile.length != 11) {
      document.getElementById('label_phone').innerText = '请输入有效的手机号码！';
      document.getElementById('phone').focus();
      return false;
    }

    var myreg = /^(((13[0-9]{1})|(15[0-9]{1})|(17[0-9]{1})|(18[0-9]{1}))+\d{8})$/;
    if (!myreg.test(mobile)) {
      document.getElementById('label_phone').innerText = '请输入有效的手机号码！';
      document.getElementById('phone').focus();
      return false;
    }

    return true;

  }

  function validateAll() {
    if (!validateMobile()) {
      return false;
    }

    if (code.length == 0) {
      document.getElementById('label_code').innerText = '请输入验证码！';
      document.getElementById('code').focus();
      return false;
    }

    if (code.length != 6) {
      document.getElementById('label_code').innerText = '请输入有效的验证码！';
      document.getElementById('code').focus();
      return false;
    }

    if (isNaN(code)) {
      document.getElementById('label_code').innerText = '请输入有效的验证码！';
      document.getElementById('code').focus();
      return false;
    }

    return true;
  }

  function turnTo() {
    if (validateMobile()) {
      $('.form-group button').attr("disabled", "disabled");
      var mobile = document.getElementById('phone').value;
      $.get(
        '/register/sms?phone=' + mobile,
        function (data) {
          if (data.success) {
          } else {
            alert(data.error_message.phone);
          }
        },
        "json"
      );

      var i = 61;
      timer();
      function timer() {
        i--;
        $('.form-group button').text(i + '秒后重发');
        if (i == 0) {
          clearTimeout(timer);
          $('.form-group button').removeAttr("disabled");
          $('.form-group button').text('重新发送');
        } else {
          setTimeout(timer, 1000);
        }
      }
    }
  }
</script>
</body>
</html>
