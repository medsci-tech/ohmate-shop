<!DOCTYPE html>
<html lang="zh-cmn-Hans">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="renderer" content="webkit">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>易康伴侣-后台</title>

    <link href="{{ asset('/css/uikit.almost-flat.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/components/accordion.almost-flat.min.css') }}" rel="stylesheet">
    <link href="{{ asset('/css/app.css') }}" rel="stylesheet">
    @yield('css')
</head>
<body>
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
                                        权限管理
                                    </li>
                                    <li>
                                        <a href="{{ url('/users/userlist') }}">
                                            权限管理
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
                                        <a href="{{ url('/users/userlist') }}">
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

@if (count($errors) > 0)
    <div class="uk-alert uk-alert-danger">
        <strong>Whoops!</strong> 看起来你输错了什么。<br><br>
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

@if (\Session::get('success'))
    <div class="uk-alert uk-alert-success">
        <strong>操作成功!</strong>
    </div>
@endif

@yield('content')

<script src="http://cdn.bootcss.com/jquery/2.1.3/jquery.min.js"></script>
<script src="{{ asset('/js/uikit.min.js') }}"></script>
<script src="{{ asset('/js/components/accordion.min.js') }}"></script>
@yield('js')
</body>
</html>
