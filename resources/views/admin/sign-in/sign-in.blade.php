<!DOCTYPE html>
<html>

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Login</title>
        <link href="{{ asset('/admin/css/bootstrap.min.css') }}" rel="stylesheet">
        <link href="{{ asset('/admin/font-awesome/css/font-awesome.css') }}" rel="stylesheet">
        <link href="{{ asset('/admin/css/animate.css') }}" rel="stylesheet">
        <link href="{{ asset('/admin/css/style.css') }}" rel="stylesheet">
    </head>

    <body class="gray-bg">
        <div class="middle-box text-center loginscreen animated fadeInDown">
            <div>
                <form class="m-t" method="post" role="form" action="{{ url(env('ADMIN_URL')."/login") }}">
                    {{csrf_field()}}
                    <h2>Вход в админ панель</h2>
                    <div class="form-group">
                        <input type="login" class="form-control" placeholder="Логин" required="">
                    </div>
                    <div class="form-group">
                        <input type="password" class="form-control" placeholder="Пароль" required="">
                    </div>
                    <button type="submit" class="btn btn-primary block full-width m-b">Login</button>
                </form>
            </div>
        </div>

        <script src="{{ asset('/admin/js/jquery-3.1.1.min.js') }}"></script>
        <script src="{{ asset('/admin/js/bootstrap.min.js') }}"></script>
    </body>
</html>
