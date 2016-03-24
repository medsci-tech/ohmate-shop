<nav class="uk-navbar uk-navbar-attached">

  <a href="#api-offcanvas" class="uk-navbar-toggle uk-visible-small" data-uk-offcanvas>
    {{--<i class="uk-icon-bars"></i>--}}
  </a>

  <div class="uk-container uk-container-center">
    <ul class="uk-navbar-nav">
      <li>
        <a style="display: inline-block;" class="navbar-brand" href="{{ url('/home') }}">
          <img style="height: 100%;" src="/images/logo.png">
        </a>
      </li>
    </ul>

    <div class="uk-navbar-flip">
      <ul class="uk-navbar-nav uk-hidden-small">
        @if (Auth::guest())
          <li><a href="{{ url('/login') }}">登录</a></li>
          <li><a href="{{ url('/register') }}">注册</a></li>
        @else
          <?php $user = Auth::user();?>
          @can('user_administration')
          <li class="uk-parent" data-uk-dropdown="{mode:'click'}">
            <a href="">
              用户管理
              <i class="uk-icon-caret-down"></i>
            </a>

            <div class="uk-dropdown uk-dropdown-navbar" role="menu">
              <ul class="uk-nav uk-nav-navbar">
                <li class="uk-nav-header">
                  后台权限管理
                </li>
                <li>
                  <a href="{{ url('/users') }}">
                    后台权限管理
                  </a>
                </li>

                <li class="uk-nav-header">
                  用户管理
                </li>
                <li>
                  <a href="{{ url('/customer') }}">
                    用户列表
                  </a>
                </li>
              </ul>
            </div>
          </li>
          @endcan

          @can('edit_article_index')
          <li class="uk-parent" data-uk-dropdown="{mode:'click'}">
            <a href="">
              教育频道
              <i class="uk-icon-caret-down"></i>
            </a>

            <div class="uk-dropdown uk-dropdown-navbar" role="menu">
              <ul class="uk-nav uk-nav-navbar">
                <li class="uk-nav-header">
                  教育频道管理
                </li>
                <li>
                  <a href="{{ url('/article') }}">
                    文章管理
                  </a>
                </li>
              </ul>
            </div>
          </li>
          @endcan

          <li class="uk-parent" data-uk-dropdown="{mode:'click'}">
            <a href="">
              <i class="uk-icon-user uk-icon-small"></i> {{ Auth::user()->name }}
              <i class="uk-icon-caret-down"></i>
            </a>

            <div class="uk-dropdown uk-dropdown-navbar" role="menu">
              <ul class="uk-nav uk-nav-navbar">
                <li><a href="{{ url('/logout') }}">登出</a>
              </ul>
            </div>
          </li>
        @endif
      </ul>
    </div>
  </div>
</nav>

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
        @if (Auth::guest())
          <li><a href="{{ url('/login') }}">登录</a></li>
          <li><a href="{{ url('/register') }}">注册</a></li>
        @else
          <?php $user = Auth::user();?>
          @can('user_administration')
          <li class="active"><a href="#">用户管理</a></li>
          <li><a href="#">商城管理</a></li>
          <li><a href="#">文章管理</a></li>
          <li><a href="#">系统管理</a></li>
            <li>
              <a  id="dLabel" data-target="#" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">
                <i class="fa fa-user"></i> {{ Auth::user()->name }}
                <span class="caret"></span>
              </a>

              <div class="uk-dropdown uk-dropdown-navbar" role="menu">
                <ul class="uk-nav uk-nav-navbar">
                  <li><a href="{{ url('/logout') }}">登出</a>
                </ul>
              </div>
            </li>
          @endcan

      </ul>
      <form class="navbar-form navbar-right" @submit.prevent="search">
        <div class="has-feedback">
          <input v-on:keyup.enter="submit" type="text" class="form-control" placeholder="Search..."
                 v-model="searching.detail">
          <button type="submit" class="btn btn-link form-control-feedback fa fa-search"></button>
        </div>
      </form>
    </div>
  </div>
</nav>