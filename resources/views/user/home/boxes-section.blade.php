<section class="burger dark-template-bg services" id="service" >
    <div class="container">

        <div class="row">
            <div class="col-sm-12 col-lg-8 col-lg-offset-2 text-center">
                <h2 class="wow fadeInUp" data-wow-delay=".2s" data-wow-duration="1s">Доступные ящики для заработка</h2>
                <div class="wow fadeInUp" data-wow-delay=".5s" data-wow-duration=".5s">
                    <p class="big-pera">В данный момент в проекте доступны 4 ящиков для заработка с койдавай можна виграт до 2 раза больше </p>
                </div>
            </div>
        </div>

        <div class="row align-item-center mt8">
            <div class="col-lg-12 col-sm-12 ">
                <div class="services-list">
                    @if (!empty($boxes))
                        @foreach ($boxes as $key => $box)
                            <div class="service-box wow fadeInUp" data-wow-delay=".{{$key+2}}s" data-wow-duration=".{{$key+2}}s">
                                <img src="{{ asset($box->image_source) }}" class="box-image-size img-responsive" alt="image_source">
                                <span>{{$box->name}}</span>
                                <span>{{ $box->description }}</span>
                                @if (Auth::check())
                                    <button class="btn-alpha mt2 buy-box redirect-btn" data-box-id="{{$box->id}}">{{ $box->price }} Рублей</button>
                                @else
                                    <a href="{{ url('sign-in') }}" class="btn-alpha mt2 redirect-btn">{{ $box->price }} Рублей</a>
                                @endif
                            </div>
                        @endforeach
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="modal fade" id="buyModal" role="dialog"></div>
</section>

<section class="burger dark-template-bg services" id="service" >
    <div class="container">

        <div class="row">
            <div class="col-sm-12 col-lg-8 col-lg-offset-2 text-center">
                <h2 class="wow fadeInUp" data-wow-delay=".2s" data-wow-duration="1s">Пассивный Доход </h2>
                <div class="wow fadeInUp" data-wow-delay=".5s" data-wow-duration=".5s">
                    <p>Пассивный доход это уникальная возможность вложить деньги и получить прибыль каждый день не зависимо от ваших усилий и активность. Источники пассивного дохода не ограничены можно приобрести сколько захочется. Естественно чем много источников тем больше заработок.</p>
                </div>
            </div>
        </div>

        <div class="col-lg-12 col-sm-12 ">
            <div class="services-list" style="margin-bottom: 40px;">
                @if (!empty($passiveIncome))
                    @foreach ($passiveIncome as $key => $item)
                        <div class="service-box passive_income_block wow fadeInUp" data-wow-delay=".{{$key+2}}s" data-wow-duration=".{{$key+2}}s">
                            <img src="{{ asset($item->image) }}" class="box-image-size img-responsive" alt="image_source">
                            <span>{{$item->name}}</span>
                            <span>Доход в день {{ $item->daily_income }} Рублей</span>
                            <span>Срок {{ $item->duration }} дней</span>
                            @if (Auth::check())
                                <a href="{{ url('/passive-income') }}" class="btn-alpha mt2 redirect-btn">{{ $item->price }} Рублей</a>
                            @else
                                <a href="{{ url('sign-in') }}" class="btn-alpha mt2 redirect-btn">{{ $item->price }} Рублей</a>
                            @endif
                        </div>
                    @endforeach
                @endif
            </div>
        </div>
    </div>
</section>