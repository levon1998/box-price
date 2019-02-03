@extends('user.layout.app')

@section('title')
    Box Price - Пассивный Доход
@endsection

@section('content')
    <section class="dark-template-bg">
        <div class="banner burger  align-item-center parallax" style="background-position-y: 0px;">
            <div class="container">
                <div class="row align-item-center account-central-block">

                    @include('user.account.pays')

                    <div class="col-sm-12 text-center" style="min-height: 500px;">

                        @include('user.account.tabs')

                        <div class="tab-content">
                            <div class="tab-pane fade in active">
                                @include('user.passive-income.passive-income-list')

                                @include('user.passive-income.passive-income-history')
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
    <script src="{{asset('/js/account/passive-income.js')}}"></script>
@endsection