<ul class="nav nav-tabs nav-justified">
    <li class="{{ (Route::current()->getName() == 'my-account') ? 'active' : '' }}"><a href="{{ url('/my-account') }}">Мой Профиль <i class="fa fa-area-chart" aria-hidden="true"></i></a></li>
    <li class="{{ (Route::current()->getName() == 'my-boxes') ? 'active' : '' }}"><a href="{{ url('/my-boxes') }}">Открыть Ящик <i class="fa fa-archive" aria-hidden="true"></i></a></li>
    <li class="{{ (Route::current()->getName() == 'passive-income') ? 'active' : '' }}"><a href="{{ url('/passive-income') }}">Пассивный Доход <i class="fa fa-spinner" aria-hidden="true"></i></a></li>
</ul>
<br>