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
                                    <a href="{{ url('/users/index') }}">
                                        后台权限管理
                                    </a>
                                </li>

                                <li class="uk-nav-header">
                                    用户管理
                                </li>
                                <li>
                                    <a href="{{ url('/customer/index') }}">
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
                                    <a href="{{ url('/article/index') }}">
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