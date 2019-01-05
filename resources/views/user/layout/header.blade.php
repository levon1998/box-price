<nav class="navbar wow fadeInDown" data-wow-delay=".2s" data-wow-duration="1s" id="myNavbar">
    <div class="container">
        <div class="navbar-header ">
            <button data-target="#navbarCollapse" data-toggle="collapse" class="navbar-toggle collapsed" type="button">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar top"></span>
                <span class="icon-bar mid"></span>
                <span class="icon-bar btm"></span>
            </button>
            <a href="{{ url('/') }}" class="logo navbar-brand">
                𝔹𝕠𝕩 ℙ𝕣𝕚c𝕖
            </a>
        </div>
        <div id="navbarCollapse" class="collapse navbar-collapse">
            <ul class="nav navbar-nav navbar-right" id="nav_bar">
                <li><a href="{{ url('/last-winnings') }}">Последние Выигрыши</a></li>
                @if (Auth::check())
                    <li>
                        <a href="{{ url('/auto-spinner') }}">
                            <img src="{{ asset('/img/auto-spinner.png') }}" title="Авто Спиннер" width="30px" height="30px" style="margin-top: -7px"/>
                        </a>
                    </li>
                    <ul class="nav navbar-nav navbar-right">
                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" style="padding-top: 8px;">
                                <img src="{{ (Auth::user()->avatar) ? Auth::user()->avatar : asset('/img/avatar.png') }}" width="35px" height="35px" />
                                <strong>{{ Auth::user()->username }}</strong>
                                <i class="fa fa-chevron-down"></i>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a href="javascript:void(0)">Баланс <span class="pull-right user-balance">{{ number_format(Auth::user()->balance, 2, '.', ' ') }}</span></a></li>
                                <li><a href="javascript:void(0)">баллы <span class="pull-right">{{ Auth::user()->score }}</span></a></li>
                                <hr class="dropdown-menu-hr"/>
                                <li><a href="{{ url('/my-account') }}" >Моя страница</a></li>
                                <li><a href="{{ url('/logout') }}">Выход</a></li>
                            </ul>
                        </li>
                    </ul>
                @else
                    <li class="sidebar-btn"><a href="{{ url('sign-in') }}" class="menu-btn">Войти</a></li>
                    <li class="sidebar-btn"><a href="{{ url('sign-up') }}" class="menu-btn">Регистрация</a></li>
                @endif
            </ul>
        </div>
    </div>
</nav>