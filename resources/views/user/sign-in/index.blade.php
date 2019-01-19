@extends('user.layout.app')

@section('title')
    Box Price - Вход
@endsection

@section('styles')
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
@endsection

@section('content')
    <section>
        <div class="banner burger  align-item-center parallax" style="background-position-y: 0px;">
            <div class="container">
                <div class="row align-item-center">
                    <div class="col-sm-offset-3 col-sm-6 col-lg-6 sign-up-box text-center">
                        <form action="{{ url('/sign-in') }}" method="post">
                            {!! csrf_field() !!}
                            <h2 class="template-color mt3 mb3">Авторизация </h2>
                            <div class="form-group has-warning has-feedback mb2">
                                <input type="text" name="username" value="{{ old('username') }}" class="form-control {{ ($errors->first('username')) ? 'has-error' : '' }} input-type-text" placeholder="Имя Пользователя">
                                <span class="validation-error-text text-left mb1 mt1">{{ $errors->first('username') }} {{ Session::get('notActiveUser') }}</span>
                            </div>
                            <div class="form-group has-warning has-feedback">
                                <input type="password" name="password" class="form-control {{ ($errors->first('password')) ? 'has-error' : '' }} input-type-text" placeholder="Пароль">
                                <span class="validation-error-text text-left mb1 mt1">{{ $errors->first('password') }}</span>
                            </div>
                            <div class="form-group mt2 mb3">
                                <button type="submit" class="menu-btn ">Вход</button>
                                <a href="{{ url('sign-up') }}" class="menu-btn">Регистрация</a>
                            </div>
                            <hr />
                            @include('user.layout.o-auth')
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>
@endsection