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
                            <div class="col-md-7">
                                <iframe src="http://www.free-kassa.ru/merchant/forms.php?gen_form=1&m=113338&default-sum=200&button-text=Оплатить&type=v3&id=273044"  width="590" height="320" frameBorder="0" target="_parent" ></iframe>
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