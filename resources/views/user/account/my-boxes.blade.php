@extends('user.layout.app')

@section('title')
    Box Price - Мои ящики
@endsection

@section('content')
    <section class="dark-template-bg">
        <div class="banner burger  align-item-center parallax" style="background-position-y: 0px;">
            <div class="container">
                <div class="row align-item-center">
                    <div class="col-sm-12 text-left" style="min-height: 500px;">
                        @include('user.account.tabs')

                        <div class="tab-content">

                            <div class="col-lg-12 col-sm-12 ">
                                <div class="services-list" style="margin-bottom: 40px;">
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

                            <div class="tab-pane fade in active">
                                <hr>
                                <h3 class="boxCollapse" data-toggle="collapse" data-target="#closedBoxes">Закрытие Ящики <i class="fa fa-chevron-down" aria-hidden="true"></i></h3>
                                <hr>
                                <div id="closedBoxes" class="collapse collapseClosedBox in">
                                    <div class="services-list">
                                        @if (!empty($closedBoxes) && count($closedBoxes) > 0)
                                            @foreach ($closedBoxes as $key => $box)
                                                <div class="service-box box-number-{{$box->id}}">
                                                    <img src="{{ asset($box->image_source) }}" class="box-image-size img-responsive" alt="image_source">
                                                    <span>{{$box->name}}</span>
                                                    <span>{{ $box->description }}</span>
                                                    <button class="btn-alpha mt2 open-box redirect-btn" data-box-id="{{$box->id}}">Открыть</button>
                                                </div>
                                            @endforeach
                                        @else
                                            <h3 style="margin-top: 50px;">У вас нет закрытых ящиков</h3>
                                        @endif
                                    </div>
                                </div>
                                <hr>
                                <h3 class="boxCollapse" data-toggle="collapse" data-target="#openBoxes">Открытие Ящики <i class="fa fa-chevron-left" aria-hidden="true"></i></h3>
                                <hr>
                                <div id="openBoxes" class="collapse collapseOpenBox">
                                    <div class="services-list open-service-list">
                                        @if (!empty($openBoxes) && count($openBoxes) > 0)
                                            @foreach ($openBoxes as $key => $box)
                                                <div class="service-box">
                                                    <img src="{{ asset($box->image_source) }}" class="box-image-size img-responsive" alt="image_source">
                                                    <span>{{$box->name}}</span>
                                                    <span>{{ $box->description }}</span>
                                                    <span>Ваш Выигрыш {{number_format($box->price, 2, ',', ' ')}} Рублей</span>
                                                </div>
                                            @endforeach
                                        @else
                                            <h3 style="margin-top: 50px;">У вас нет открытых ящиков</h3>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal fade" id="buyModal" role="dialog"></div>
        <div class="modal fade" id="openModal" role="dialog"></div>
    </section>
@endsection

@section('scripts')
    <script>
        var openBoxUrl = "{{url('/open-box')}}";
    </script>
    <script src="{{asset('/js/account/account.js')}}"></script>
@endsection