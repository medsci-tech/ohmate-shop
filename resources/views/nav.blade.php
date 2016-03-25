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
      @if (Auth::guest())
      @else
        <ul class="nav navbar-nav navbar-right">
          {{--<?php $user = Auth::user();?>--}}
          {{--@can('user_administration')--}}

          <li class="active"><a href="#">用户管理</a></li>
          <li><a href="#">商城管理</a></li>
          <li><a href="#">文章管理</a></li>
          <li><a href="#">系统管理</a></li>
            <li>
              <a  id="dLabel" data-target="#" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-user"></i> {{ Auth::user()->name }}
                <span class="caret"></span>
              </a>

              <div class="dropdown-menu" aria-labelledby="dLabel">
                <ul class="">

                  <li><a href="{{ url('/logout') }}">登出</a>
                </ul>
              </div>
            </li>
          {{--@endcan--}}

        </ul>
      <form class="navbar-form navbar-right" @submit.prevent="search">
        <div class="has-feedback">
          <input @keyup.enter="submit" type="text" class="form-control" placeholder="Search..."
                 v-model="searching.detail">
          <button type="submit" class="btn btn-link form-control-feedback fa fa-search"></button>
        </div>
      </form>
      @endif
    </div>
  </div>
</nav>