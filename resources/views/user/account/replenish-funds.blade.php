@extends('user.layout.app')

@section('title')
    Box Price - Пополнить Балансе
@endsection

@section('content')
    <section>
        <div class="banner burger  align-item-center parallax" style="background-position-y: 0px;">
            <div class="container">
                <div class="row align-item-center">
                    <div class="col-sm-12 text-center" style="min-height: 500px;">
                        @include('user.account.tabs')

                        <div class="tab-content">
                            <div class="col-md-6">
                                <form method="post" action="{{ url(route('replenish-funds-save')) }}">
                                    <h2 class="template-color mt3 mb3">Пополнить с помощью Payeer</h2>
                                    <div class="form-group has-warning has-feedback mb2">
                                        <input type="number" name="m_amount" class="form-control {{ ($errors->first('username')) ? 'has-error' : '' }} input-type-text" placeholder="Сумма пополнения (50.00 рублей)">
                                    </div>

                                    <input type="hidden" name="m_shop" value="{{ env('PAYEER_M_ID') }}">
{{--                                    <input type="hidden" name="m_orderid" value="{{ uniqid(time()) }}">--}}
                                    <input type="hidden" name="m_orderid" value="12345">
                                    <input type="hidden" name="m_curr" value="{{ env('PAYEER_M_CURR') }}">
                                    <input type="hidden" name="m_desc" value="{{ env('PAYEER_M_DESC') }}">
                                    <input type="hidden" name="m_sign" value="{{ env('PAYEER_M_SIGN') }}">
                                    {{ csrf_field() }}
                                    <input type="submit" name="m_process" class="redirect-btn btn-alpha" value="Пополнить" />

                                </form>
                            </div>
                            <div class="col-md-6">

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