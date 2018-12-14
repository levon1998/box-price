<ul class="nav nav-tabs nav-justified">
    <li class="{{ (Route::current()->getName() == 'my-account') ? 'active' : '' }}"><a href="{{ url('/my-account') }}">Мой Профиль <i class="fa fa-area-chart" aria-hidden="true"></i></a></li>
    <li class="{{ (Route::current()->getName() == 'my-boxes') ? 'active' : '' }}"><a href="{{ url('/my-boxes') }}">Открыть Ящик <i class="fa fa-archive" aria-hidden="true"></i></a></li>
    <li class="{{ (Route::current()->getName() == 'replenish-funds') ? 'active' : '' }}"><a href="{{ url('/replenish-funds') }}">Пополнить Баланс <i class="fa fa-money" aria-hidden="true"></i></a></li>
    <li class="{{ (Route::current()->getName() == 'withdraw-funds') ? 'active' : '' }}"><a href="{{ url('/withdraw-funds') }}">Вывести Средства <i class="fa fa-credit-card" aria-hidden="true"></i></a></li>
</ul>
<br>