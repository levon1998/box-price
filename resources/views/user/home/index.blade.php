@extends('user.layout.app')

@section('title')
    Box Prize - Главная страница
@endsection

@section('content')
    @include('user.home.header-section')

    @include('user.home.boxes-section')

    @include('user.home.winers-section')

    @include('user.home.review-section')
@endsection

@section('scripts')
    <script>
        var buyUrl = "{{url('/buy-new-box')}}";
    </script>
    <script src="{{asset('/js/home/home.js')}}"></script>
@endsection