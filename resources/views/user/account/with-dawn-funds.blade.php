@extends('user.layout.app')

@section('title')
    Box Price - Вывести Средства
@endsection

@section('content')
    <section>
        <div class="banner burger  align-item-center parallax" style="background-position-y: 0px;">
            <div class="container">
                <div class="row align-item-center">
                    <div class="col-sm-12 text-center" style="min-height: 500px;">
                        @include('user.account.tabs')

                        <div class="tab-content">
                            <div class="col-md-8 col-md-offset-2">
                                <form method="post" action="{{ url(route('withdraw-funds-save')) }}">
                                    <h2 class="template-color mt3 mb3">Заказать мгновенную выплату </h2>
                                    <div class="form-group has-warning has-feedback mb2">
                                        <input type="number" name="payeer_account" class="form-control {{ ($errors->first('payeer_account')) ? 'has-error' : '' }} input-type-text" placeholder="Номер Кошелька Payeer (P**********)">
                                    </div>
                                    <div class="form-group has-warning has-feedback mb2">
                                        <input type="number" name="m_amount" class="form-control {{ ($errors->first('m_amount')) ? 'has-error' : '' }} input-type-text" placeholder="Сумма для вывода">
                                    </div>
                                    {{ csrf_field() }}
                                    <input type="submit" name="m_process" class="redirect-btn btn-alpha" value="Заказать выплату " />
                                </form><br />

                                <h3>Последние 10 Выплат </h3><br />
                                <table class="table">
                                    <thead>
                                    <tr>
                                        <th class="text-center">Идентификатор</th>
                                        <th class="text-center">Сумма</th>
                                        <th class="text-center">Статус</th>
                                        <th class="text-center">Дата вывода</th>
                                    </tr>
                                    </thead>
                                    <tbody>

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