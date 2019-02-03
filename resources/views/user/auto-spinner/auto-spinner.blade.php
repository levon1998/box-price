@extends('user.layout.app')

@section('title')
    Box Price - Авто спиннер
@endsection

@section('content')
    <section class="dark-template-bg">
        <div class="banner burger  align-item-center parallax" style="background-position-y: 0px;">
            <div class="container">
                <div class="row align-item-center">
                    <div class="row">
                        <div class="col-sm-12 col-lg-8 col-lg-offset-2 text-center">
                            <h2 class="template-color wow fadeInUp" data-wow-delay=".2s" data-wow-duration="1s">Авто спиннер для получения баллов каждый день </h2>
                            <div class="wow fadeInUp" data-wow-delay=".5s" data-wow-duration=".5s">
                                <p class="big-pera">Авто спиннер предназначен для получения баллов каждый день, чем выше твой уровень спиннера чем больше шанс получить больше баллов. баллы автоматически добавляется каждый день в 12:00</p>
                            </div>
                        </div>
                    </div>

                    <div class="row align-item-center mt8">
                        <div class="col-lg-12 col-sm-12 ">
                            <div class="services-list">
                                @if (isset($spinners) && count($spinners) > 0)
                                    @foreach ($spinners as $key => $spinner)
                                        <div class="service-box spinner{{$spinner->id}} wow fadeInUp" data-wow-delay=".{{$key+2}}s" data-wow-duration=".{{$key+2}}s">
                                            <img src="{{ asset('/img/auto-spinner-level-'.$spinner->level.'.png') }}" class="box-image-size img-responsive" alt="image_source">
                                            <span>{{$spinner->name}}</span>
                                            <span>{{ $spinner->description }}</span>
                                            @if(is_null(Auth::user()->spinner) && $spinner->id == 1)
                                                <button class="btn-alpha mt2 buy-spinner redirect-btn" data-spinner-id="{{$spinner->id}}">
                                                    {{ $spinner->price }} Рублей
                                                </button>
                                            @elseif (!is_null(Auth::user()->spinner) && Auth::user()->spinner->spinner_id >= $spinner->id)
                                                <button class="btn-alpha mt2 redirect-btn">
                                                    Куплено
                                                </button>
                                            @elseif (!is_null(Auth::user()->spinner) && Auth::user()->spinner->spinner_id + 1 == $spinner->id)
                                                <button class="btn-alpha mt2 buy-spinner redirect-btn" data-spinner-id="{{$spinner->id}}">
                                                    {{ $spinner->price }} Рублей
                                                </button>
                                            @endif
                                        </div>
                                    @endforeach
                                @endif
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="buyModal" role="dialog"></div>
    </section>
@endsection

@section('scripts')
    <script>
        var buyUrl = "{{url('/buy-spinner')}}";
    </script>
    <script src="{{asset('/js/auto-spinner/auto-spinner.js')}}"></script>
@endsection