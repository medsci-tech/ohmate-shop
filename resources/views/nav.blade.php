<nav class="navbar navbar-inverse navbar-fixed-top">
  <div class="container-fluid">
    <div class="navbar-header">
      <span><img class="img-responsive" src="{{ url('/images/logo.png') }}" style="margin: 5px;width: 45px; float: left;"></span>
      @if (Auth::guest())
      @else
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar"
              aria-expanded="false" aria-controls="navbar">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      @endif
      <a class="navbar-brand active" href="#">易康伴侣</a>
    </div>
    <div id="navbar" class="navbar-collapse collapse">
      @if (Auth::guest())
      @else
        <ul class="nav navbar-nav navbar-right">
          <?php $user = Auth::user();?>
          @can('customer_administration')
            <li><a href="{{ url('/customer/index') }}">用户管理</a></li>
          @endcan
          @can('order_administration')
            <li><a href="{{ url('/order/index') }}">订单管理</a></li>
          @endcan
          <li>
            <a id="dLabel" data-target="#" data-toggle="dropdown" role="button" aria-haspopup="true"
               aria-expanded="false">
              <i class="fa fa-user"></i> {{ Auth::user()->name }}
              <span class="caret"></span>
            </a>

            <div class="dropdown-menu" aria-labelledby="dLabel">
              <ul class="">
                <li><a href="{{ url('/logout') }}">登出</a>
              </ul>
            </div>
          </li>

        </ul>
        <form class="navbar-form navbar-right" @submit.prevent="search">
          <div class="has-feedback">
            <input v-on:keyup.enter="search" type="text" class="form-control" placeholder="Search..."
                   v-model="searching.detail">
            <button type="submit" class="btn btn-link form-control-feedback fa fa-search"></button>
          </div>
        </form>
      @endif
    </div>
  </div>
</nav>