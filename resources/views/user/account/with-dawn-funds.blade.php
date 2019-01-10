@extends('user.layout.app')

@section('title')
    Box Price - Вывести Средства
@endsection

@section('content')
    <section>
        <div class="banner burger  align-item-center parallax" style="background-position-y: 0px;">
            <div class="container">

                @if (!empty(Session::get('success')) && Session::get('success'))
                    <div class="alert alert-success" role="alert">{{ Session::get('message') }}</div>
                @elseif (!empty(Session::get('success')) && !Session::get('success'))
                    <div class="alert alert-danger" role="alert">{{ Session::get('message') }}</div>
                @endif

                <div class="row align-item-center">
                    <div class="col-sm-12 text-center" style="min-height: 500px;">
                        @include('user.account.tabs')

                        <div class="tab-content">
                            <div class="col-md-8 col-md-offset-2">
                                <form method="post" action="{{ url(route('withdraw-funds-save')) }}">
                                    <h2 class="template-color mt3 mb3">Заказать мгновенную выплату </h2>
                                    <div class="form-group has-warning has-feedback mb2">
                                        <input type="text" name="payeer_account" value="{{ old('payeer_account') }}" class="form-control {{ ($errors->first('payeer_account')) ? 'has-error' : '' }} input-type-text" placeholder="Номер Кошелька Payeer (P**********)">
                                        <span class="validation-error-text text-left mb1 mt1">{{ $errors->first('payeer_account') }}</span>
                                    </div>
                                    <div class="form-group has-warning has-feedback mb2">
                                        <input type="number" name="m_amount" class="form-control {{ ($errors->first('m_amount')) ? 'has-error' : '' }} input-type-text" placeholder="Сумма для вывода">
                                        <span class="validation-error-text text-left mb1 mt1">{{ $errors->first('m_amount') }}</span>
                                    </div>
                                    {{ csrf_field() }}
                                    <div class="form-group mt4">
                                        <button type="submit" class="redirect-btn btn-alpha">Заказать выплату</button>
                                    </div>
                                </form><br />

                                <h3>Последние 10 Выплат </h3><br />
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th class="text-center">Идентификатор</th>
                                        <th class="text-center">Кошелек</th>
                                        <th class="text-center">Сумма</th>
                                        <th class="text-center">Статус</th>
                                        <th class="text-center">Дата вывода</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                        @if (isset($lastPays) && count($lastPays) > 0)
                                            @foreach ($lastPays as $pay)
                                                <tr>
                                                    <td>{{ $pay->id }}</td>
                                                    <td>{{ $pay->payeer }}</td>
                                                    <td>{{ number_format($pay->pay, 2, '.', '')}}</td>
                                                    <td>{{ translateWithdrawState($pay->state) }}</td>
                                                    <td>{{ $pay->created_at }}</td>
                                                </tr>
                                            @endforeach
                                        @else
                                            <tr>
                                                <td colspan="5"><p>Вы ещё не заказывали выплату </p></td>
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