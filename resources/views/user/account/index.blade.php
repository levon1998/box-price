@extends('user.layout.app')

@section('title')
    Box Prize - Моя страница
@endsection

@section('content')
    <section>
        <div class="banner burger  align-item-center parallax" style="background-position-y: 0px;">
            <div class="container">
                <div class="row align-item-center">
                    <div class="col-sm-12 text-center" style="min-height: 500px;">
                        @include('user.account.tabs')

                        <div class="tab-content">
                            <div class="tab-pane fade in active">
                                <h3>Последние Выгрышы </h3><br />
                                <table class="table">
                                    <thead>
                                        <tr>
                                            <th class="text-center">Ящик</th>
                                            <th class="text-center">Сумма</th>
                                            <th class="text-center">Дата Покупки</th>
                                            <th class="text-center">Дата Открытия</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @if (isset($lastWins) && count($lastWins) > 0)
                                            @foreach ($lastWins as $win)
                                                <tr>
                                                    <td>{{ $win->name }}</td>
                                                    <td>{{ $win->price }}</td>
                                                    <td>{{ $win->created_at }}</td>
                                                    <td>{{ $win->opened_date }}</td>
                                                </tr>
                                            @endforeach
                                        @endif
                                    </tbody>
                                </table><br /><br />
                                <h3>Награды и Достижения</h3>
                                <div class="prize-section">
{{-- <iframe src="http://www.free-kassa.ru/merchant/forms.php?gen_form=1&m=113338&default-sum=200&button-text=Оплатить&encoding=CP1251&type=v3&id=271637"  width="590" height="320" frameBorder="0" target="_parent" ></iframe> --}}
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script src="{{asset('/js/account/account.js')}}"></script>
@endsection