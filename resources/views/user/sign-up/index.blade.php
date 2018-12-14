@extends('user.layout.app')

@section('title')
    Box Prize - Регистрация
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
                        <form action="{{ url('/sign-up') }}" method="post">
                            {{ csrf_field() }}
                            <h2 class="template-color mt3 mb3">Регистрация</h2>
                            <div class="form-group has-feedback mb2">
                                <input type="text" value="{{ old('username') }}" name="username" class="form-control {{ ($errors->first('username')) ? 'has-error' : '' }} input-type-text" placeholder="Имя Пользователя">
                                <span class="validation-error-text text-left mb1 mt1">{{ $errors->first('username') }}</span>
                            </div>
                            <div class="form-group has-feedback">
                                <input type="email" value="{{ old('email') }}" name="email" class="form-control {{ ($errors->first('email')) ? 'has-error' : '' }} input-type-text mb1" placeholder="Электронная Почта">
                                <span class="validation-error-text text-left mb1 mt1">{{ $errors->first('email') }}</span>
                            </div>
                            <div class="form-group has-feedback">
                                <input type="password" name="password" class="form-control {{ ($errors->first('password')) ? 'has-error' : '' }} input-type-text" placeholder="Пароль">
                                <span class="validation-error-text text-left mb1 mt1">{{ $errors->first('password') }}</span>
                            </div>
                            <div class="form-group has-feedback">
                                <input type="password" name="password_confirmation" class="form-control input-type-text" placeholder="Подтверждения">
                            </div>
                            <div class="form-group mt2 mb3">
                                <button href="http://box-prize.loc/sign-up" class="menu-btn ">Далее</button>
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