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
                </ul>
            </div>
            <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main" v-cloak>
                <h2 class="sub-header">@{{searching.user_type}}<span v-if="searched" class="small">(@{{searched}})</span></h2>
                <div class="table-responsive">
                    <table class="table table-striped table-hover">
                        <thead>
                        <tr>
                            <th v-if="data_head.id">@{{data_head.id}}</th>
                            <th v-if="data_head.name">@{{data_head.name}}</th>
                            <th v-if="data_head.phone">@{{data_head.phone}}</th>
                            <th v-if="data_head.hospital">@{{data_head.hospital}}</th>
                            <th v-if="data_head.address">@{{data_head.address}}</th>
                            <th v-if="data_head.invited">@{{data_head.invited}}</th>
                            <th v-if="data_head.beans">@{{data_head.beans}}</th>
                            <th v-if="data_head.qr_code">@{{data_head.qr_code}}</th>
                            <th></th>
                        </tr>
                        </thead>
                        <tbody>
                        <tr v-cloak v-for="person in page_data">
                        <td v-if="data_head.id">@{{person.id}}</td>
                        <td v-if="data_head.name">@{{person.name}}</td>
                        <td v-if="data_head.phone">@{{person.phone}}</td>
                        <td v-if="data_head.hospital">@{{person.hospital.name}}</td>
                        <td v-if="data_head.address">@{{person.hospital.province}}-@{{person.hospital.city}}-@{{person.hospital.area}}-@{{person.hospital.location}}</td>
                        <td v-if="data_head.invited">
                            @{{person.statistics.friend_count}}
                        </td>
                        <td v-if="data_head.beans">
                            @{{person.beans_total}}
                        </td>
                        <td v-if="data_head.qr_code">
                            <a class="disabled"
                               tabindex="0" role="button"
                               data-container="body"
                               data-toggle="popover"
                               data-placement="bottom"
                               data-content="<img class='img-responsive' src='@{{person.qr_code}}'>"
                            >显示
                            </a>
                        </td>
                        <td>
                            <a href="#" @click="person_detail(person)">详情</a>
                        </td>
                        </tr>
                        </tbody>
                    </table>
                </div>
                <nav class="text-center col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 col-xs-12" id="pagination">
                    <ul class="pagination" @click="choose_page">
                    <li v-if="page_active > 1">
                        <a href="#" aria-label="Previous" name="pre">
                            &laquo;
                        </a>
                    </li>
                    <li v-if="page_show > 1">
                        <a href="#" aria-label="Previous5" name="pre5">
                            &hellip;
                        </a>
                    </li>
                    <li :class="(page_active == page_show)?'active':''"><a href="#">@{{page_show}}</a></li>
                    <li :class="(page_active == page_show+1)?'active':''" v-if="(page_show+1)<=page_all"><a
                          href="#">@{{ page_show+1 }}</a></li>
                    <li :class="(page_active == page_show+2)?'active':''" v-if="(page_show+2)<=page_all"><a
                          href="#">@{{ page_show+2 }}</a></li>
                    <li :class="(page_active == page_show+3)?'active':''" v-if="(page_show+3)<=page_all"><a
                          href="#">@{{ page_show+3 }}</a></li>
                    <li :class="(page_active == page_show+4)?'active':''" v-if="(page_show+4)<=page_all"><a
                          href="#">@{{ page_show+4 }}</a></li>
                    <li v-if="(page_show+5)<=page_all">
                        <a href="#" name="next5" aria-label="Next5">
                            &hellip;
                        </a>
                    </li>
                    <li v-if="page_active < page_all">
                        <a href="#" aria-label="Next" name="next">
                            &raquo;
                        </a>
                    </li>
                    </ul>
                </nav>
            </div>
        </div>
    </div>

    <!-- Modal -->
    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
        <div class="modal-dialog" role="document">
            <div class="col-sm-8">
                <div class="modal-content" id="user_card">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span
                              aria-hidden="true">&times;</span></button>
                        <h4 class="modal-title" id="myModalLabel1">@{{ searching.user_type }}名片</h4>
                    </div>
                    <div class="modal-body">
                        <form class="form-horizontal">
                            <input type="hidden" name="_token" value="{{ csrf_token() }}">
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
                                        <input type="number" class="form-control sr-only" id="phone" placeholder="请输入电话"
                                               v-model="other_info.phone">

                                        <p class="form-control-static">@{{ other_info.phone }}</p>
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
                                        <p class="form-control-static">@{{ this_person.province }}-@{{ this_person.city }}-@{{ this_person.district }}-@{{ this_person.department}}</p>
                                        <select class="form-control sr-only" name="province" id="province"
                                                v-model="this_person.province"></select>
                                    </div>
                                    <label class="col-sm-3 control-label" for="city"></label>
                                    <div class="col-sm-8">
                                        <select class="form-control sr-only" name="city" id="city"
                                                v-model="this_person.city"></select>
                                    </div>
                                    <label class="col-sm-3 control-label" for="area"></label>
                                    <div class="col-sm-8">
                                        <select class="form-control sr-only" name="area" id="area"
                                                v-model="this_person.district"></select>
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
                                    <label for="invited" class="col-sm-3 control-label">糖友数</label>
                                    <div class="col-sm-8">
                                        <input type="number" class="form-control sr-only disabled" id="invited" placeholder="邀请糖友数" disabled
                                               v-model="other_info.statistics.friend_count">

                                        <p class="form-control-static">@{{ other_info.statistics.friend_count }}</p>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="beans" class="col-sm-3 control-label">迈豆数</label>
                                    <div class="col-sm-8">
                                        <input type="number" class="form-control sr-only" id="beans" placeholder="请输入迈豆数"
                                               v-model="other_info.beans_total">

                                        <p class="form-control-static">@{{ other_info.beans_total }}</p>
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
            <div class="col-sm-4">
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
                            <a href="#" aria-label="Previous" name="pre">
                                &laquo;
                            </a>
                        </li>
                        <li v-if="this_person.invited.page_show > 1">
                            <a href="#" aria-label="Previous5" name="pre5">
                                &hellip;
                            </a>
                        </li>
                        <li :class="(this_person.invited.page_active == this_person.invited.page_show)?'active':''"><a href="#">@{{this_person.invited.page_show}}</a></li>
                        <li :class="(this_person.invited.page_active == this_person.invited.page_show+1)?'active':''" v-if="(this_person.invited.page_show+1)<=this_person.invited.page_all"><a
                              href="#">@{{ this_person.invited.page_show+1 }}</a></li>
                        <li :class="(this_person.invited.page_active == this_person.invited.page_show+2)?'active':''" v-if="(this_person.invited.page_show+2)<=this_person.invited.page_all"><a
                              href="#">@{{ this_person.invited.page_show+2 }}</a></li>
                        <li :class="(this_person.invited.page_active == this_person.invited.page_show+3)?'active':''" v-if="(this_person.invited.page_show+3)<=this_person.invited.page_all"><a
                              href="#">@{{ this_person.invited.page_show+3 }}</a></li>
                        <li :class="(this_person.invited.page_active == this_person.invited.page_show+4)?'active':''" v-if="(this_person.invited.page_show+4)<=this_person.invited.page_all"><a
                              href="#">@{{ this_person.invited.page_show+4 }}</a></li>
                        <li v-if="(this_person.invited.page_show+5)<=this_person.invited.page_all">
                            <a href="#" name="next5" aria-label="Next5">
                                &hellip;
                            </a>
                        </li>
                        <li v-if="this_person.invited.page_active < this_person.invited.page_all">
                            <a href="#" aria-label="Next" name="next">
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
                            <a href="#" aria-label="Previous" name="pre">
                                &laquo;
                            </a>
                        </li>
                        <li v-if="this_person.beans.page_show > 1">
                            <a href="#" aria-label="Previous5" name="pre5">
                                &hellip;
                            </a>
                        </li>
                        <li :class="(this_person.beans.page_active == this_person.beans.page_show)?'active':''"><a href="#">@{{this_person.beans.page_show}}</a></li>
                        <li :class="(this_person.beans.page_active == this_person.beans.page_show+1)?'active':''" v-if="(this_person.beans.page_show+1)<=this_person.beans.page_all"><a
                              href="#">@{{ this_person.beans.page_show+1 }}</a></li>
                        <li :class="(this_person.beans.page_active == this_person.beans.page_show+2)?'active':''" v-if="(this_person.beans.page_show+2)<=this_person.beans.page_all"><a
                              href="#">@{{ this_person.beans.page_show+2 }}</a></li>
                        <li :class="(this_person.beans.page_active == this_person.beans.page_show+3)?'active':''" v-if="(this_person.beans.page_show+3)<=this_person.beans.page_all"><a
                              href="#">@{{ this_person.beans.page_show+3 }}</a></li>
                        <li :class="(this_person.beans.page_active == this_person.beans.page_show+4)?'active':''" v-if="(this_person.beans.page_show+4)<=this_person.beans.page_all"><a
                              href="#">@{{ this_person.beans.page_show+4 }}</a></li>
                        <li v-if="(this_person.beans.page_show+5)<=this_person.beans.page_all">
                            <a href="#" name="next5" aria-label="Next5">
                                &hellip;
                            </a>
                        </li>
                        <li v-if="this_person.beans.page_active < this_person.beans.page_all">
                            <a href="#" aria-label="Next" name="next">
                                &raquo;
                            </a>
                        </li>
                        </ul>
                    </div>
                </div>
            </div>

        </div>
    </div>
@endsection

@section('js')
    <script src="{{asset('/js/vendor/city.js')}}"></script>
    <script src="{{asset('/js/admin.js')}}"></script>
@endsection