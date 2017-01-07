@extends('app')

@section('css')
@endsection

@section('content')
<div class="container-fluid">
  <div class="row">
    <div class="col-sm-3 col-md-2 sidebar">
      <ul class="nav nav-sidebar">
        <li :class="(searching.user_type == '医生')?'active':''" @click="choose_data" id="doctor"><a href="#doctor">医生</a></li>
        <li :class="(searching.user_type == '志愿者')?'active':''" @click="choose_data" id="volunteer"><a href="#volunteer">志愿者</a></li>
        <li :class="(searching.user_type == '护士')?'active':''" @click="choose_data" id="nurse"><a href="#nurse">护士</a></li>
        <li :class="(searching.user_type == '普通用户')?'active':''" @click="choose_data" id="common"><a href="#common">普通用户</a></li>
        <li :class="(searching.user_type == '企业用户')?'active':''" @click="choose_data" id="enterprise"><a href="#enterprise">企业用户</a></li>
        <li :class="(searching.user_type == '所有用户')?'active':''" @click="choose_data" id="all"><a href="#all">所有用户</a></li>
        @if (Auth::user()->name=='戴可')
        <li :class="(searching.user_type == '修改迈豆')?'active':''" @click="choose_data" id="modbean"><a href="#modbean">修改迈豆</a></li>
        @endif
      </ul>
      <hr>
      <ul class="nav nav-sidebar">
        <li :class="(searching.user_type == 'A类医生')?'active':''" @click="choose_data" id="doctor_a"><a href="#doctor_a">A类医生</a></li>
      </ul>
    </div>
    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main" v-cloak>
      <h2 class="sub-header">@{{searching.user_type}}
        <span v-if="searched" class="small">(@{{searched}})</span>
        <button @click="addUserBean" v-if="searching.user_type == '修改迈豆'" class="btn btn-primary">修改用户迈豆</button>
        <button @click="addDoctorA" v-if="searching.user_type == 'A类医生'" class="btn btn-primary">添加</button>
        <div v-if="searching.user_type == 'A类医生'" style="font-size: initial; display: inline-block; float: right;">
          <select v-model='a_searching.type' class="form-control" style="display: inline-block; width: auto; padding-top: 7px">
            <option value="" disabled>请选择搜索项</option>
            <option value="name">姓名</option>
            <option value="phone">电话</option>
            <option value="referred_name">推荐代表姓名</option>
          </select>
          <div class="has-feedback" style="display: inline-block; width: auto;">
            <input @keyup.enter='a_search' v-model='a_searching.value' type="text" class="form-control" placeholder="A类医生查询">
            <button @click='a_search' style="pointer-events: all;" type="button" class="btn btn-link form-control-feedback fa fa-search"></button>
          </div>
        </div>
      </h2>

      <span v-if="searching.user_type=='修改迈豆'">
   <div class="table-responsive">
     <table class="table table-striped table-hover table-bordered">
       <thead>
       <tr>
         <th >@{{data_head.id}}</th>
         <th>@{{data_head.phone}}</th>
         <th>@{{data_head.beans}}</th>
         <th>@{{data_head.created_at}}</th>
         <th>@{{data_head.remark}}</th>
         <th>@{{data_head.opt}}</th>
       </tr>
       </thead>
       <tbody>
       <tr v-cloak v-for="person in page_data">
         <td v-if="data_head.id">@{{person.id}}</td>
         <td v-if="data_head.phone">
           <div>
             @{{person.phone}}
           </div>
         </td>
         <td>
           <div>
             @{{person.beans}}
           </div>
         </td>
         <td >
           <div>
             @{{person.created_at}}
           </div>
         </td>
         <td >
           <div>
             @{{person.remark}}
           </div>
         </td>
         <td >
           <div >
             @{{person.opt}}
           </div>
         </td>

       </tr>
       </tbody>
     </table>
   </div>

      </span>

    <span v-if="searching.user_type!='修改迈豆'">
      <div class="table-responsive">
        <table class="table table-striped table-hover table-bordered">
          <thead>
            <tr>
              <th v-if="data_head.id">@{{data_head.id}}</th>
              <th v-if="data_head.type">@{{data_head.type}}</th>
              <th v-if="data_head.name">@{{data_head.name}}</th>
              <th v-if="data_head.phone">@{{data_head.phone}}</th>
              <th v-if="data_head.level">@{{data_head.level}}</th>
              <th v-if="data_head.referred_name">@{{data_head.referred_name}}</th>
              <th v-if="data_head.referred_phone">@{{data_head.referred_phone}}</th>
              <th v-if="data_head.region">@{{data_head.region}}</th>
              
              <th v-if="data_head.region_level">@{{data_head.region_level}}</th>
              
              <th v-if="data_head.responsible">@{{data_head.responsible}}</th>
              <th v-if="data_head.address">@{{data_head.address}}</th>
              <th v-if="data_head.hospital">@{{data_head.hospital}}</th>
              <th v-if="data_head.hospital_level">@{{data_head.hospital_level}}</th>
              <th v-if="data_head.department">@{{data_head.department}}</th>
              <th v-if="data_head.remark">@{{data_head.remark}}</th>
              <th v-if="data_head.invited">@{{data_head.invited}}</th>
              <th v-if="data_head.beans">@{{data_head.beans}}</th>
              <th v-if="data_head.focus_count">@{{data_head.focus_count}}</th>
              <th v-if="data_head.register_count">@{{data_head.register_count}}</th>
              <th v-if="data_head.questionnaire_count">@{{data_head.questionnaire_count}}</th>
              <th v-if="data_head.qr_code">@{{data_head.qr_code}}</th>
              <th v-if="searching.user_type == 'A类医生'">患者列表</th>
              <th>详情</th>
            </tr>
          </thead>
          <tbody>
            <tr v-cloak v-for="person in page_data">
              <td v-if="data_head.id">@{{person.id}}</td>
              <td v-if="data_head.type">
                <div v-if="person.information">
                  @{{person.information.type}}
                </div>
              </td>
              <td v-if="data_head.name">
                <div v-if="person.information">
                  @{{person.information.name}}
                </div>
              </td>
              <td v-if="data_head.phone"> 
                <div v-if="person.information">
                  @{{person.information.phone}}
                </div>
              </td>
              <td v-if="data_head.level"> 
                <div v-if="person.information">
                  @{{person.information.level}}
                </div>
              </td>
              <td v-if="data_head.referred_name"> 
                <div v-if="person.information">
                  @{{person.information.referred_name}}
                </div>
              </td>
              <td v-if="data_head.referred_phone"> 
                <div v-if="person.information">
                  @{{person.information.referred_phone}}
                </div>
              </td>
              <td v-if="data_head.region"> 
                <div v-if="person.information">
                  @{{person.information.region}}
                </div>
              </td>
              <td v-if="data_head.region_level"> 
                <div v-if="person.information">
                  @{{person.information.region_level}}
                </div>
              </td>
              <td v-if="data_head.responsible"> 
                <div v-if="person.information">
                  @{{person.information.responsible}}
                </div>
              </td>
              <td v-if="data_head.address">
                <div v-if="person.information">
                  @{{person.information.province}}-@{{person.information.city}}-@{{person.information.district}}
                </div>
              </td>
              <td v-if="data_head.hospital">
                <div v-if="person.information">
                  @{{person.information.hospital}}
                </div>
              </td>
              <td v-if="data_head.hospital_level">
                <div v-if="person.information">
                  @{{person.information.hospital_level}}
                </div>
              </td>
              <td v-if="data_head.department">
                <div v-if="person.information">
                  @{{person.information.department}}
                </div>
              </td>
              <td v-if="data_head.remark">
                <div v-if="person.information">
                  @{{person.information.remark}}
                </div>
              </td>
              <td v-if="data_head.invited">
                <div v-if="person.statistics">
                  @{{person.statistics.friend_count}}
                </div>
              </td>
              <td v-if="data_head.beans">
                @{{person.beans_total}}
              </td>
              <td v-if="data_head.focus_count">
                @{{person.focus_count}}
              </td>
              <td v-if="data_head.register_count">
                @{{person.register_count}}
              </td>
              <td v-if="data_head.questionnaire_count">
                @{{person.questionnaire_count}}
              </td>
              <td v-if="data_head.qr_code">
                <a class="disabled"
                tabindex="0" role="button"
                data-container="body"
                data-toggle="popover"
                data-placement="bottom"
                data-content="<img class='img-responsive' src='@{{person.qr_code}}'>"
                v-if="person.qr_code"
                >显示
              </a>
            </td>
            <td v-if="searching.user_type == 'A类医生'">
              <a tabindex="0" role="button" @click="showPatient(person)">患者列表</a>
            </td>
            <td>
              <a tabindex="0" role="button" @click="person_detail(person)">详情</a>
            </td>
          </tr>
        </tbody>
      </table>
    </div>
    </span>
    <nav class="text-center col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 col-xs-12" id="pagination">
      <ul class="pagination" @click="choose_page">
        <li v-if="page_active > 1">
          <a aria-label="Previous" name="pre">
            &laquo;
          </a>
        </li>
        <li v-if="page_show > 1">
          <a aria-label="Previous5" name="pre5">
            &hellip;
          </a>
        </li>
        <li :class="(page_active == page_show)?'active':''"><a>@{{page_show}}</a></li>
        <li :class="(page_active == page_show+1)?'active':''" v-if="(page_show+1)<=page_all"><a>@{{ page_show+1 }}</a></li>
        <li :class="(page_active == page_show+2)?'active':''" v-if="(page_show+2)<=page_all"><a>@{{ page_show+2 }}</a></li>
        <li :class="(page_active == page_show+3)?'active':''" v-if="(page_show+3)<=page_all"><a>@{{ page_show+3 }}</a></li>
        <li :class="(page_active == page_show+4)?'active':''" v-if="(page_show+4)<=page_all"><a>@{{ page_show+4 }}</a></li>
        <li v-if="(page_show+5)<=page_all"><a name="next5" aria-label="Next5"> &hellip;</a></li>
        <li v-if="page_active < page_all"><a aria-label="Next" name="next">&raquo;</a></li>
      </ul>
    </nav>
  </div>
</div>


<!-- Modal -->

  <div v-if="searching.user_type == '修改迈豆'" class="modal fade" id="addBeanAModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel3">
    <div class="modal-dialog" role="document">
      <div class="col-sm-12">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                      aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel2">修改用户迈豆</h4>
          </div>
          <div class="modal-body">
            <form class="form-horizontal">
              <br>
              <div class="col-sm-6">

                <div class="form-group">
                  <label for="phone2" class="col-sm-3 control-label">电话</label>
                  <div class="col-sm-8">
                    <input type="number" class="form-control" id="phone" placeholder="请输入电话">
                  </div>
                </div>
                <div class="form-group">
                  <label for="hospital22" class="col-sm-3 control-label">操作迈豆数</label>
                  <div class="col-sm-8">
                    <input type="number" class="form-control" id="beans" placeholder="请输入要添加或减少的迈豆值"
                           v-model="add_doctor.hospital">
                  </div>
                </div>

                <div class="form-group">
                  <label for="remark2" class="col-sm-3 control-label">备注</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control" id="remark" placeholder="请输入备注"
                           v-model="add_doctor.remark">
                  </div>
                </div>
              </div>
              <div class="clearfix"></div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" @click="cancelAdd">取消</button>
            <button type="button" class="btn btn-warning" @click="submitAddBean">确认</button>
          </div>
        </div>
      </div>
    </div>
  </div>


<div v-if="searching.user_type != 'A类医生'" class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="col-sm-12">
      <div class="modal-content" id="user_card">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
            aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel1">@{{ searching.user_type }}名片</h4>
          </div>
          <div class="modal-body">
            <form class="form-horizontal">
              <br>
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">姓名</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control sr-only" id="inputEmail3" placeholder="请输入姓名"
                    v-model="this_person.name">

                    <p class="form-control-static">@{{ this_person.name }}</p>
                  </div>
                </div>
                <div class="form-group">
                  <label for="user_type" class="col-sm-3 control-label">用户类型</label>
                  <div class="col-sm-8">
                    <select id="user_type" class="form-control sr-only" v-model="this_person.type_id">
                      <option value="4">医生</option>
                      <option value="3">护士</option>
                      <option value="2">志愿者</option>
                      <option value="1">普通用户</option>
                      <option value="5">企业用户</option>
                    </select>

                    <p class="form-control-static">@{{ other_info.type.type_ch }}</p>
                  </div>
                </div>
                <div class="form-group">
                  <label for="phone" class="col-sm-3 control-label">电话</label>
                  <div class="col-sm-8">
                    <input type="number" class="form-control sr-only" id="phone" placeholder="请输入电话" disabled
                    v-model="this_person.phone">

                    <p class="form-control-static">@{{ this_person.phone }}</p>
                  </div>
                </div>
                <div class="form-group">
                  <label for="nickname" class="col-sm-3 control-label">微信昵称</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control sr-only" id="nickname" placeholder="请输入微信昵称" disabled
                    v-model="other_info.nickname">

                    <p class="form-control-static">@{{ other_info.nickname }}</p>
                  </div>
                </div>
                <div class="form-group">
                  <label for="hospital" class="col-sm-3 control-label">医院名称</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control sr-only" id="hospital" placeholder="请输入医院名称"
                    v-model="this_person.hospital">

                    <p class="form-control-static">@{{ this_person.hospital }}</p>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-3 control-label" for="province">医院地址</label>
                  <div class="col-sm-8">
                    <p class="form-control-static">@{{ this_person.province }}-@{{ this_person.city }}-@{{ this_person.district }}</p>
                    <input class="form-control sr-only" name="province" id="province"
                    v-model="this_person.province"></input>
                  </div>
                  <label class="col-sm-3 control-label" for="city"></label>
                  <div class="col-sm-8">
                    <input class="form-control sr-only" name="city" id="city"
                    v-model="this_person.city"></input>
                  </div>
                  <label class="col-sm-3 control-label" for="area"></label>
                  <div class="col-sm-8">
                    <input class="form-control sr-only" name="area" id="area"
                    v-model="this_person.district"></input>
                  </div>
                </div>

                <div class="form-group">
                  <label for="department" class="col-sm-3 control-label">科室</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control sr-only" id="department" placeholder="请输入科室"
                    v-model="this_person.department">

                    <p class="form-control-static">@{{ this_person.department }}</p>
                  </div>
                </div>

                <div class="form-group">
                  <label for="remark" class="col-sm-3 control-label">备注</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control sr-only" id="remark" placeholder="请输入备注"
                    v-model="this_person.remark">

                    <p class="form-control-static">@{{ this_person.remark }}</p>
                  </div>
                </div>
              </div>
              <div class="col-sm-6">
                {{--<div class="form-group">--}}
                {{--<label for="invited" class="col-sm-3 control-label">糖友数</label>--}}
                {{--<div class="col-sm-8">--}}
                {{--<input type="number" class="form-control sr-only" id="invited" placeholder="邀请糖友数" disabled--}}
                {{--v-model="other_info.statistics.friend_count">--}}

                {{--<p class="form-control-static">@{{ other_info.statistics.friend_count }}</p>--}}
                {{--</div>--}}
                {{--</div>--}}
                <div class="form-group">
                  <label for="beans" class="col-sm-3 control-label">迈豆数</label>
                  <div class="col-sm-8">
                    <input type="number" class="form-control sr-only" id="beans" placeholder="请输入迈豆数" disabled
                    v-model="other_info.beans_total">

                    <p class="form-control-static">@{{ other_info.beans_total }}</p>
                  </div>
                </div>
                <div class="form-group hide" id="beans_edit">
                  <label for="beans_edit" class="col-sm-3 control-label">迈豆修改</label>
                  <div class="col-sm-8">
                    <input type="number" class="form-control sr-only" id="beans_edit" placeholder="请输入迈豆数"
                    v-model="beans_edit">

                    <p class="form-control-static">@{{ beans_edit }}</p>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-3 control-label">二维码</label>
                  <div class="col-sm-8">
                    <img class="form-control-static img-responsive" :src="other_info.qr_code">
                  </div>
                </div>
              </div>
              <div class="clearfix"></div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
            <button type="button" class="btn btn-primary" @click="edit_btn">编辑</button>
            <button type="button" class="btn btn-default hide" @click="cancel_edit">取消</button>
            <button type="button" class="btn btn-warning hide" @click="submit_edit">确认</button>
          </div>
        </div>
      </div>
      <div class="col-sm-4" v-if="false">
        <div class="modal-content col-xs-12 ">
          <div class="modal-header">
            <h4 class="modal-title" id="myModalLabel2">邀请总数&emsp;@{{ other_info.statistics.friend_count }}</h4>
          </div>
          <div class="modal-body">
            <table class="table">
              <tr>
                <th>#</th>
                <th>电话</th>
                <th>邀请时间</th>
              </tr>
              <tr v-for="person in this_person.invited.page_data">
                <td>@{{ person.id }}</td>
                <td>@{{ person.phone }}</td>
                <td>@{{ person.time }}</td>
              </tr>
            </table>
          </div>
          <div class="modal-footer">
            <ul class="pagination" @click="choose_page">
              <li v-if="this_person.invited.page_active > 1">
                <a aria-label="Previous" name="pre">
                  &laquo;
                </a>
              </li>
              <li v-if="this_person.invited.page_show > 1">
                <a aria-label="Previous5" name="pre5">
                  &hellip;
                </a>
              </li>
              <li :class="(this_person.invited.page_active == this_person.invited.page_show)?'active':''"><a>@{{this_person.invited.page_show}}</a></li>
              <li :class="(this_person.invited.page_active == this_person.invited.page_show+1)?'active':''" v-if="(this_person.invited.page_show+1)<=this_person.invited.page_all"><a>@{{ this_person.invited.page_show+1 }}</a></li>
              <li :class="(this_person.invited.page_active == this_person.invited.page_show+2)?'active':''" v-if="(this_person.invited.page_show+2)<=this_person.invited.page_all"><a>@{{ this_person.invited.page_show+2 }}</a></li>
              <li :class="(this_person.invited.page_active == this_person.invited.page_show+3)?'active':''" v-if="(this_person.invited.page_show+3)<=this_person.invited.page_all"><a>@{{ this_person.invited.page_show+3 }}</a></li>
              <li :class="(this_person.invited.page_active == this_person.invited.page_show+4)?'active':''" v-if="(this_person.invited.page_show+4)<=this_person.invited.page_all"><a>@{{ this_person.invited.page_show+4 }}</a></li>
              <li v-if="(this_person.invited.page_show+5)<=this_person.invited.page_all">
                <a name="next5" aria-label="Next5">
                  &hellip;
                </a>
              </li>
              <li v-if="this_person.invited.page_active < this_person.invited.page_all">
                <a aria-label="Next" name="next">
                  &raquo;
                </a>
              </li>
            </ul>
          </div>
        </div>
        <div class="modal-content col-xs-12 ">
          <div class="modal-header">
            <h4 class="modal-title" id="myModalLabel3">总迈豆&emsp;@{{ other_info.beans_total }}</h4>
          </div>
          <div class="modal-body">
            <table class="table">
              <tr>
                <th>操作</th>
                <th>迈豆变化</th>
                <th>操作时间</th>
              </tr>
              <tr v-for="action in this_person.beans.page_data">
                <td>@{{ action.action }}</td>
                <td>@{{ action.result }}</td>
                <td>@{{ action.time }}</td>
              </tr>
            </table>
          </div>
          <div class="modal-footer">
            <ul class="pagination" @click="choose_page">
              <li v-if="this_person.beans.page_active > 1">
                <a aria-label="Previous" name="pre">
                  &laquo;
                </a>
              </li>
              <li v-if="this_person.beans.page_show > 1">
                <a aria-label="Previous5" name="pre5">
                  &hellip;
                </a>
              </li>
              <li :class="(this_person.beans.page_active == this_person.beans.page_show)?'active':''"><a>@{{this_person.beans.page_show}}</a></li>
              <li :class="(this_person.beans.page_active == this_person.beans.page_show+1)?'active':''" v-if="(this_person.beans.page_show+1)<=this_person.beans.page_all"><a>@{{ this_person.beans.page_show+1 }}</a></li>
              <li :class="(this_person.beans.page_active == this_person.beans.page_show+2)?'active':''" v-if="(this_person.beans.page_show+2)<=this_person.beans.page_all"><a>@{{ this_person.beans.page_show+2 }}</a></li>
              <li :class="(this_person.beans.page_active == this_person.beans.page_show+3)?'active':''" v-if="(this_person.beans.page_show+3)<=this_person.beans.page_all"><a>@{{ this_person.beans.page_show+3 }}</a></li>
              <li :class="(this_person.beans.page_active == this_person.beans.page_show+4)?'active':''" v-if="(this_person.beans.page_show+4)<=this_person.beans.page_all"><a>@{{ this_person.beans.page_show+4 }}</a></li>
              <li v-if="(this_person.beans.page_show+5)<=this_person.beans.page_all">
                <a name="next5" aria-label="Next5">
                  &hellip;
                </a>
              </li>
              <li v-if="this_person.beans.page_active < this_person.beans.page_all">
                <a aria-label="Next" name="next">
                  &raquo;
                </a>
              </li>
            </ul>
          </div>
        </div>
      </div>

    </div>
  </div>

</div>

<div v-if="searching.user_type == 'A类医生'" class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
  <div class="modal-dialog" role="document">
    <div class="col-sm-12">
      <div class="modal-content" id="user_card">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
            aria-hidden="true">&times;</span></button>
            <h4 class="modal-title" id="myModalLabel1">@{{ searching.user_type }}名片</h4>
          </div>
          <div class="modal-body">
            <form class="form-horizontal">
              <br>
              <div class="col-sm-6">
                <div class="form-group">
                  <label for="inputEmail3" class="col-sm-3 control-label">姓名</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control sr-only" id="inputEmail3" placeholder="请输入姓名"
                    v-model="this_person.name">

                    <p class="form-control-static">@{{ this_person.name }}</p>
                  </div>
                </div>
                <div class="form-group">
                  <label for="type" class="col-sm-3 control-label">用户类型</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control sr-only" id="type" placeholder="用户类型" v-model="this_person.type">

                    <p class="form-control-static">@{{ this_person.type }}</p>
                  </div>
                </div>
                <div class="form-group">
                  <label for="phone" class="col-sm-3 control-label">电话</label>
                  <div class="col-sm-8">
                    <input type="number" class="form-control sr-only" id="phone" placeholder="请输入电话" v-model="this_person.phone">

                    <p class="form-control-static">@{{ this_person.phone }}</p>
                  </div>
                </div>
                <div class="form-group">
                  <label for="region" class="col-sm-3 control-label">所在大区</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control sr-only" id="region" placeholder="请输入"
                    v-model="this_person.region">

                    <p class="form-control-static">@{{ this_person.region }}</p>
                  </div>
                </div>
                <div class="form-group">
                  <label for="region_level" class="col-sm-3 control-label">大区级别</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control sr-only" id="region_level" placeholder="请输入医"
                    v-model="this_person.region_level">

                    <p class="form-control-static">@{{ this_person.region_level }}</p>
                  </div>
                </div>
                <div class="form-group">
                  <label for="responsible" class="col-sm-3 control-label">地区级别</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control sr-only" id="responsible" placeholder="请输入"
                    v-model="this_person.responsible">

                    <p class="form-control-static">@{{ this_person.responsible }}</p>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-3 control-label" for="province">医院地址</label>
                  <div class="col-sm-8">
                    <p class="form-control-static">@{{ this_person.province }}-@{{ this_person.city }}-@{{ this_person.district }}</p>
                    <input class="form-control sr-only" name="province" id="province"
                    v-model="this_person.province"></input>
                  </div>
                  <label class="col-sm-3 control-label" for="city"></label>
                  <div class="col-sm-8">
                    <input class="form-control sr-only" name="city" id="city"
                    v-model="this_person.city"></input>
                  </div>
                  <label class="col-sm-3 control-label" for="area"></label>
                  <div class="col-sm-8">
                    <input class="form-control sr-only" name="area" id="area"
                    v-model="this_person.district"></input>
                  </div>
                </div>

                <div class="form-group">
                  <label for="hospital" class="col-sm-3 control-label">医院名称</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control sr-only" id="hospital" placeholder="请输入医院名称"
                    v-model="this_person.hospital">

                    <p class="form-control-static">@{{ this_person.hospital }}</p>
                  </div>
                </div>
                <div class="form-group">
                  <label for="hospital_level" class="col-sm-3 control-label">医院级别</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control sr-only" id="hospital_level" placeholder="请输入医院级别"
                    v-model="this_person.hospital_level">

                    <p class="form-control-static">@{{ this_person.hospital_level }}</p>
                  </div>
                </div>
                <div class="form-group">
                  <label for="department" class="col-sm-3 control-label">科室</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control sr-only" id="department" placeholder="请输入科室"
                    v-model="this_person.department">

                    <p class="form-control-static">@{{ this_person.department }}</p>
                  </div>
                </div>

                <div class="form-group">
                  <label for="remark" class="col-sm-3 control-label">备注</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control sr-only" id="remark" placeholder="请输入备注"
                    v-model="this_person.remark">

                    <p class="form-control-static">@{{ this_person.remark }}</p>
                  </div>
                </div>
              </div>
              <div class="col-sm-6">

                <div class="form-group">
                  <label for="referred_name" class="col-sm-3 control-label">推荐代表</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control sr-only" id="referred_name" placeholder="" disabled
                    v-model="this_person.referred_name">

                    <p class="form-control-static">@{{ this_person.referred_name }}</p>
                  </div>
                </div>
                <div class="form-group">
                  <label for="referred_phone" class="col-sm-3 control-label">代表手机号</label>
                  <div class="col-sm-8">
                    <input type="text" class="form-control sr-only" id="referred_phone" placeholder="" disabled
                    v-model="this_person.referred_phone">

                    <p class="form-control-static">@{{ this_person.referred_phone }}</p>
                  </div>
                </div>
                <div class="form-group">
                  <label for="beans" class="col-sm-3 control-label">迈豆数</label>
                  <div class="col-sm-8">
                    <input type="number" class="form-control sr-only" id="beans" placeholder="请输入迈豆数" disabled
                    v-model="other_info.beans_total">

                    <p class="form-control-static">@{{ other_info.beans_total }}</p>
                  </div>
                </div>
                <div class="form-group">
                  <label for="focus_count" class="col-sm-3 control-label">关注数</label>
                  <div class="col-sm-8">
                    <input type="number" class="form-control sr-only" id="focus_count" placeholder="请输入关注数" disabled
                    v-model="other_info.focus_count">

                    <p class="form-control-static">@{{ other_info.focus_count }}</p>
                  </div>
                </div>
                <div class="form-group">
                  <label for="register_count" class="col-sm-3 control-label">注册数</label>
                  <div class="col-sm-8">
                    <input type="number" class="form-control sr-only" id="register_count" placeholder="请输入注册数" disabled
                    v-model="other_info.register_count">

                    <p class="form-control-static">@{{ other_info.register_count }}</p>
                  </div>
                </div>
                <div class="form-group">
                  <label for="questionnaire_count" class="col-sm-3 control-label">问卷数</label>
                  <div class="col-sm-8">
                    <input type="number" class="form-control sr-only" id="questionnaire_count" placeholder="请输入问卷数" disabled
                    v-model="other_info.questionnaire_count">

                    <p class="form-control-static">@{{ other_info.questionnaire_count }}</p>
                  </div>
                </div>
                <div class="form-group hide" id="beans_edit">
                  <label for="beans_edit" class="col-sm-3 control-label">迈豆修改</label>
                  <div class="col-sm-8">
                    <input type="number" class="form-control sr-only" id="beans_edit" placeholder="请输入迈豆数"
                    v-model="beans_edit">

                    <p class="form-control-static">@{{ beans_edit }}</p>
                  </div>
                </div>
                <div class="form-group">
                  <label class="col-sm-3 control-label">二维码</label>
                  <div class="col-sm-8">
                    <img class="form-control-static img-responsive" :src="other_info.qr_code">
                  </div>
                </div>
              </div>
              <div class="clearfix"></div>
            </form>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal">关闭</button>
            <button type="button" class="btn btn-primary" @click="edit_btn">编辑</button>
            <button type="button" class="btn btn-default hide" @click="cancel_edit">取消</button>
            <button type="button" class="btn btn-warning hide" @click="submit_edit">确认</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<div v-if="searching.user_type == 'A类医生'" class="modal fade" id="addDoctorAModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel2">
  <div class="modal-dialog" role="document">
   <div class="col-sm-12">
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
          aria-hidden="true">&times;</span></button>
          <h4 class="modal-title" id="myModalLabel2">添加A类医生</h4>
        </div>
        <div class="modal-body">
          <form class="form-horizontal">
            <br>
            <div class="col-sm-6">
              <div class="form-group">
                <label for="input1" class="col-sm-3 control-label">姓名</label>
                <div class="col-sm-8">
                  <input type="text" class="form-control" id="input1" placeholder="请输入姓名"
                  v-model="add_doctor.name">
                </div>
              </div>
              <div class="form-group">
                <label for="user_type2" class="col-sm-3 control-label">用户类型</label>
                <div class="col-sm-8">
                  <input type="text" class="form-control" id="user_type2" placeholder="用户类型" v-model="add_doctor.type">
                </div>
              </div>
              <div class="form-group">
                <label for="phone2" class="col-sm-3 control-label">电话</label>
                <div class="col-sm-8">
                  <input type="number" class="form-control" id="phone2" placeholder="请输入电话" v-model="add_doctor.phone">
                </div>
              </div>
              <div class="form-group">
                <label for="region2" class="col-sm-3 control-label">所在大区</label>
                <div class="col-sm-8">
                  <input type="text" class="form-control" id="region2" placeholder="请输入"
                  v-model="add_doctor.region">
                </div>
              </div>
              <div class="form-group">
                <label for="region_level2" class="col-sm-3 control-label">大区级别</label>
                <div class="col-sm-8">
                  <input type="text" class="form-control" id="region_level2" placeholder="请输入"
                  v-model="add_doctor.region_level">
                </div>
              </div>
              <div class="form-group">
                <label for="responsible2" class="col-sm-3 control-label">地区级别</label>
                <div class="col-sm-8">
                  <input type="text" class="form-control" id="responsible2" placeholder="请输入"
                  v-model="add_doctor.responsible">
                </div>
              </div>
              <div class="form-group">
                <label class="col-sm-3 control-label" for="province2">医院地址</label>
                <div class="col-sm-8">
                  <input class="form-control" name="province2" id="province2"  placeholder="请输入省"
                  v-model="add_doctor.province"></input>
                </div>
                <label class="col-sm-3 control-label" for="city2"></label>
                <div class="col-sm-8">
                  <input class="form-control" name="city2" id="city2"  placeholder="请输入市"
                  v-model="add_doctor.city"></input>
                </div>
                <label class="col-sm-3 control-label" for="area2"></label>
                <div class="col-sm-8">
                  <input class="form-control" name="area2" id="area2"  placeholder="请输入区"
                  v-model="add_doctor.district"></input>
                </div>
              </div>

            </div>
            <div class="col-sm-6">

              <div class="form-group">
                <label for="hospital22" class="col-sm-3 control-label">医院名称</label>
                <div class="col-sm-8">
                  <input type="text" class="form-control" id="hospital22" placeholder="请输入医院名称"
                  v-model="add_doctor.hospital">
                </div>
              </div>
              <div class="form-group">
                <label for="hospital_level22" class="col-sm-3 control-label">医院级别</label>
                <div class="col-sm-8">
                  <input type="text" class="form-control" id="hospital_level22" placeholder="请输入医院级别"
                  v-model="add_doctor.hospital_level">
                </div>
              </div>
              <div class="form-group">
                <label for="department22" class="col-sm-3 control-label">科室</label>
                <div class="col-sm-8">
                  <input type="text" class="form-control" id="department22" placeholder="请输入科室"
                  v-model="add_doctor.department">
                </div>
              </div>

              <div class="form-group">
                <label for="remark2" class="col-sm-3 control-label">备注</label>
                <div class="col-sm-8">
                  <input type="text" class="form-control" id="remark2" placeholder="请输入备注"
                  v-model="add_doctor.remark">
                </div>
              </div>
            </div>
            <div class="clearfix"></div>
          </form>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" @click="cancelAdd">取消</button>
          <button type="button" class="btn btn-warning" @click="submitAdd">确认</button>
        </div>
      </div>
    </div>
  </div>
</div>

<div v-if="searching.user_type == 'A类医生'" class="modal fade" id="patientModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel3">
  <div class="modal-dialog" role="document">
    <div class="modal-dialog" role="document">
      <div class="col-sm-12">
        <div class="modal-content" id="user_card">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
              aria-hidden="true">&times;</span>
            </button>
            <h4 class="modal-title" id="myModalLabel3">@{{ this_person.name }}&emsp;患者列表</h4>
          </div>
          <div class="modal-body">
            <table class="table table-striped table-hover table-bordered">
              <thead>
                <tr>
                  <th>open_id</th>
                  <th>手机号</th>
                  <th>剩余迈豆</th>
                  <th>消费迈豆</th>
                  <th>消费现金</th>
                  <th>第一题</th>
                  <th>第二题</th>
                  <th>第三题</th>
                  <th>第四题</th>
                </tr>
              </thead>
              <tbody>
                <tr v-cloak v-for="person in other_info.patient.page_data">
                  <td>@{{person.openid}}</td>
                  <td>@{{person.phone}}</td>
                  <td>@{{person.beans_total}}</td>
                  <td>@{{person.lower_cash_payment_sum}}</td>
                  <td>@{{person.lower_beans_payment_sum}}</td>
                  <td>@{{person.q1}}</td>
                  <td>@{{person.q2 ||person.q1b }}</td>
                  <td>@{{person.q3}}-@{{person.q3a||person.q3b||person.q3c||person.q3d||person.q3d2||person.q3e}}</td>
                  <td>@{{person.q4}}</td>
                </tr>
              </tbody>
            </table>
          </div>
          <div class="modal-footer">
           {{--  <ul class="pagination" style="float: left; margin: 0px" @click="choose_page_patient">
              <li v-if="other_info.patient.page_active > 1">
                <a aria-label="Previous" name="pre">
                  &laquo;
                </a>
              </li>
              <li v-if="other_info.patient.page_show > 1">
                <a aria-label="Previous5" name="pre5">
                  &hellip;
                </a>
              </li>
              <li :class="(other_info.patient.page_active == other_info.patient.page_show)?'active':''"><a>@{{other_info.patient.page_show}}</a></li>
              <li :class="(other_info.patient.page_active == other_info.patient.page_show+1)?'active':''" v-if="(other_info.patient.page_show+1)<=other_info.patient.page_all"><a>@{{ other_info.patient.page_show+1 }}</a></li>
              <li :class="(other_info.patient.page_active == other_info.patient.page_show+2)?'active':''" v-if="(other_info.patient.page_show+2)<=other_info.patient.page_all"><a>@{{ other_info.patient.page_show+2 }}</a></li>
              <li :class="(other_info.patient.page_active == other_info.patient.page_show+3)?'active':''" v-if="(other_info.patient.page_show+3)<=other_info.patient.page_all"><a>@{{ other_info.patient.page_show+3 }}</a></li>
              <li :class="(other_info.patient.page_active == other_info.patient.page_show+4)?'active':''" v-if="(other_info.patient.page_show+4)<=other_info.patient.page_all"><a>@{{ other_info.patient.page_show+4 }}</a></li>
              <li v-if="(other_info.patient.page_show+5)<=other_info.patient.page_all">
                <a name="next5" aria-label="Next5">
                  &hellip;
                </a>
              </li>
              <li v-if="other_info.patient.page_active < other_info.patient.page_all">
                <a aria-label="Next" name="next">
                  &raquo;
                </a>
              </li>
            </ul> --}}
            <button type="button" class="btn btn-warning" data-dismiss="modal">确认</button>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection

@section('js')
<script src="{{asset('/js/vendor/city.js')}}"></script>
<script src="{{asset('/js/backend/admin.js')}}"></script>
@endsection