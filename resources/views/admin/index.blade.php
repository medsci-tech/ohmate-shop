<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=no">
  <title>易康伴侣管理后台</title>
  <link rel="stylesheet" href="{{asset('/css/admin.css')}}">
</head>
<body id="index">
<nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
              aria-expanded="false" aria-controls="navbar">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand active" href="#">易康伴侣</a>
    </div>
    <div id="navbar" class="navbar-collapse collapse">
      <ul class="nav navbar-nav navbar-right">
        <li class="active"><a href="#">用户管理</a></li>
        <li><a href="#">商城管理</a></li>
        <li><a href="#">文章管理</a></li>
        <li><a href="#">系统管理</a></li>
      </ul>
      <form class="navbar-form navbar-right" @submit.prevent="search">
        <div class="has-feedback">
          <input type="text" class="form-control" placeholder="Search..." v-model="searching">
          <button type="submit" class="btn btn-link
           form-control-feedback fa fa-search"></button>
        </div>
      </form>
    </div>
  </div>
</nav>

<div class="container-fluid">
  <div class="row">
    <div class="col-sm-3 col-md-2 sidebar">
      <ul class="nav nav-sidebar">
        <li :class="(data_name == '医生')?'active':''" @click="choose_data"><a href="#">医生</a></li>
        <li :class="(data_name == '志愿者')?'active':''" @click="choose_data"><a href="#">志愿者</a></li>
        <li :class="(data_name == '用户数据')?'active':''" @click="choose_data"><a href="#">用户数据</a></li>
      </ul>
    </div>
    <div class="col-sm-9 col-sm-offset-3 col-md-10 col-md-offset-2 main" v-cloak="">
      <h2 class="sub-header">@{{data_name}}<span v-if="search" class="small">(@{{searched}})</span></h2>
      <div class="table-responsive">
        <table class="table table-striped table-hover">
          <thead>
          <tr>
            <th v-for="head in data_head">@{{ head }}</th>
          </tr>
          </thead>
          <tbody>
          <tr v-cloak v-for="person in pagedata">
            <td>@{{person.id}}</td>
            <td>@{{person.name}}</td>
            <td>@{{person.phone}}</td>
            <td>@{{person.nickname}}</td>
            <td>@{{person.invited}}</td>
            <td>@{{person.beans}}</td>
            <td>
              <a tabindex="0" role="button"
                 data-container="body"
                 data-toggle="popover"
                 data-placement="bottom"
                 data-content="<img class='img-responsive' src='@{{person.qrcode}}'>"
              >
                显示
              </a>
            </td>
          </tr>
          </tbody>
        </table>
      </div>
      <nav class="text-center">
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
          <li :class="(page_active == page_show)?'active':''"><a href="#">@{{ page_show }}</a></li>
          <li :class="(page_active == page_show+1)?'active':''" v-if="(page_show+1)<=page_all"><a href="#">@{{ page_show+1 }}</a></li>
          <li :class="(page_active == page_show+2)?'active':''" v-if="(page_show+2)<=page_all"><a href="#">@{{ page_show+2 }}</a></li>
          <li :class="(page_active == page_show+3)?'active':''" v-if="(page_show+3)<=page_all"><a href="#">@{{ page_show+3 }}</a></li>
          <li :class="(page_active == page_show+4)?'active':''" v-if="(page_show+4)<=page_all"><a href="#">@{{ page_show+4 }}</a></li>
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

<script src="{{asset('/js/vendor/jquery-2.1.4.min.js')}}"></script>
<script src="{{asset('/js/vendor/bootstrap.min.js')}}"></script>
<script src="{{asset('/js/vendor/vue.js')}}"></script>
<script src="{{asset('/js/admin.js')}}"></script>
</body>
</html>