@extends('user.layout.app')

@section('title')
    Box Prize - Подтвердить Электронный Почты
@endsection

@section('content')
    <section>
        <div class="banner burger  align-item-center parallax" style="background-position-y: 0px;">
            <div class="container text-center">
                @if ($confirmed)
                    <h2><strong class="template-color">Box Prize</strong> <span class="confirmedText">Подтверждения</span></h2><br />
                    <p><i class="fa fa-refresh fa-spin" id="confirmLoading" style="font-size:200px; color: #34bbff;" ></i></p>
                    <a href="{{ url('sign-in') }}" class="menu-btn loginBtn" style="display: none;">Войти</a>
                @else
                    <h2><strong class="template-color">Box Prize</strong> Спасибо за регистрацию </h2>
                    <br />
                    <p>Благодарим вас за регистрацию, мы отправили письмо с ссылкой активация.</p>
                    <p>Если письмо не пришел пожалуйста праверты спам.</p>
                    <a href="{{ url('/sign-in') }}" class="menu-btn">Войти</a>
                @endif
            </div>
        </div>
    </section>
@endsection

@section('scripts')
    <script src="{{asset('/js/confirm.js')}}"></script>
@endsection