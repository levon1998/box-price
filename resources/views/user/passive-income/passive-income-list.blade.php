<div class="col-lg-12 col-sm-12 ">
    <h3 class="template-color text-center">Пассивный Доход </h3><hr />
    <p>Пассивный доход это уникальная возможность вложить деньги и получить прибыль каждый день не зависимо от ваших усилий и активность.</p>
    <p>Источники пассивного дохода не ограничены можно приобрести сколько захочется. Естественно чем много источников тем больше заработок.</p>
    <hr/><br/>
    <div class="services-list" style="margin-bottom: 40px;">
        @if (!empty($passiveIncome))
            @foreach ($passiveIncome as $key => $item)
                <div class="service-box passive_income_block wow fadeInUp" data-wow-delay=".{{$key+2}}s" data-wow-duration=".{{$key+2}}s">
                    <span title="Количество купленных источников." class="passive_income_count">{{ $item->count() }}</span>
                    <img src="{{ asset($item->image) }}" class="box-image-size img-responsive" alt="image_source">
                    <span>{{$item->name}}</span>
                    <span>Доход в день {{ $item->daily_income }} Рублей</span>
                    <span>Срок {{ $item->duration }} дней</span>
                    <button class="btn-alpha mt2 buy-passive-income redirect-btn" data-id="{{$item->id}}">{{ $item->price }} Рублей</button>
                </div>
            @endforeach
        @endif
    </div>
</div>