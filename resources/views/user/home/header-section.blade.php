<section class="" id="hero">
    <div class="banner burger  align-item-center parallax" style="background-position-y: 0px;">
        <div class="container">
            <div class="row align-item-center mt3">
                <div class="col-sm-6 col-lg-6 ">
                    <div class="banner-text">
                        <h2 class="wow fadeIn" data-wow-delay="0.5s" data-wow-duration="1s">
                            <strong class="template-color">BoxPrice</strong> лучший способ зарабатывать деньги
                        </h2>
                        <p class="wow fadeIn big-pera" data-wow-delay="1s" data-wow-duration="2s">
                            <strong class="template-color">Почему с нами легко зарабатывать </strong><br />
                            <ul class="wow fadeIn " data-wow-delay="1s" data-wow-duration="2s">
                                <li>+20% при каждом пополнении</li>
                                <li>Выиграть до 2 раза больше</li>
                                <li>Стабильность</li>
                                <li>Моментальная выплата</li>
                            </ul>
                        </p>
                        <div class="mt3 banner-btn-group">
                            <a href="{{ url('/how-it-work') }}" class="redirect-btn btn-alpha ">Как Это Работает </a>
                            @if (!Auth::user())
                                <a href="{{ url('sign-up') }}" class="redirect-btn btn-alpha ">Регистрация </a>
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-lg-5 col-lg-offset-1">
                    <div class="timer-box text-center">
                        <h2 class="mt0 ">Нам уже: </h2>
                        <div class="timer">
                            <div class="days">33<span>Days</span></div>
                            <div class="hours">08<span>Hours</span></div>
                            <div class="minutes">25<span>Minutes</span></div>
                            <div class="seconds">43<span>Seconds</span></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>