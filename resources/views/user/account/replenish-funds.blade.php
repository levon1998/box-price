@extends('user.layout.app')

@section('title')
    Box Price - Пополнить Балансе
@endsection

@section('content')
    <section>
        <div class="banner burger  align-item-center parallax" style="background-position-y: 0px;">
            <div class="container">

                @if (!empty(Session::get('success')) && Session::get('success'))
                    <div class="alert alert-success" role="alert">
                        Поздравляем. ваш счет успешно пополнен. Текущее баланс составляет {{ number_format(Auth::user()->balance, 2, '.', '') }}
                    </div>
                @elseif (!empty(Session::get('success')) && !Session::get('success'))
                    <div class="alert alert-danger" role="alert">
                        Произошла ошибка. попробуйте ещё или сообщить администрации.
                    </div>
                @endif

                <div class="row align-item-center account-central-block">

                    @include('user.account.pays')

                    <div class="col-sm-12 text-center" style="min-height: 500px;">
                        @include('user.account.tabs')

                        <div class="tab-content">
                            <div class="col-md-8 col-md-offset-2">
                                <form method="post" action="{{ url(route('replenish-funds-save')) }}">
                                    <h2 class="template-color mt3 mb3">Пополнить с помощью Payeer</h2>
                                    {{ csrf_field() }}
                                    <div class="form-group has-warning has-feedback ">
                                        <input type="number" name="m_amount" class="form-control {{ ($errors->first('m_amount')) ? 'has-error' : '' }} input-type-text" placeholder="Сумма пополнения (50.00 рублей)">
                                        <span class="validation-error-text text-left mb1 mt1">{{ $errors->first('m_amount') }}</span>
                                    </div>
                                    <div class="form-group mt4">
                                        <button type="submit" class="redirect-btn btn-alpha">Пополнить</button>
                                    </div>
                                </form><br />

                                <h3>Последние 10 Выгрышы </h3><br />
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th class="text-center">Идентификатор</th>
                                        <th class="text-center">Сумма</th>
                                        <th class="text-center">Дата Пополнения</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @if (isset($lastWins) && count($lastWins) > 0)
                                            @foreach ($lastWins as $win)
                                                <tr>
                                                    <td>{{ $win->order_id }}</td>
                                                    <td>{{ number_format($win->pay, 2, '.', '')}}</td>
                                                    <td>{{ $win->created_at }}</td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                               <td colspan="3"><p>На вашем счету пока нет пополнения </p></td>
                                            </tr>
                                        @endif
                                    </tbody>
                                </table>
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