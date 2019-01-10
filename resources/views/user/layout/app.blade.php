<!DOCTYPE html>
<html>
<head>
    <title>@yield('title')</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="keywords" content="HTML5 Template" />
    <meta name="description" content="Cryptency ICO is a modern responsive landing page template specially created for ICO Agencies and Crypto Currency Businesses" />
    <meta name="author" content="Pixel Speaks" />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="shortcut icon" href="/favicon.ico" type="image/x-icon">
    <link href="{{ asset('/font-awesome/css/font-awesome.css') }}" rel="stylesheet">
    @yield('styles')
    <link rel="stylesheet" href="{{ asset('/css/main.css') }}" type="text/css">
</head>

<body data-spy="scroll" data-target=".navbar" data-offset="82">
    <div class="site-loader">
        <div class="loader-dots">
            <div class="circle circle-1"></div>
            <div class="circle circle-2"></div>
        </div>
    </div>
    @include('user.layout.header')

        @yield('content')

    @include('user.layout.footer')

    <script src="{{ asset('/js/jquery3.2.1.min.js') }}"></script>
    <script src="{{ asset('/js/bootstrap.min.js') }}"></script>
    <script src="{{ asset('/js/main.js') }}"></script>
    <script src="{{ asset('/js/wow.min.js') }}"></script>
	<!-- BEGIN JIVOSITE CODE {literal} -->
	<script type='text/javascript'>
	(function(){ var widget_id = 'uo4PhT9NJA';var d=document;var w=window;function l(){var s = document.createElement('script'); s.type = 'text/javascript'; s.async = true;s.src = '//code.jivosite.com/script/widget/'+widget_id; var ss = document.getElementsByTagName('script')[0]; ss.parentNode.insertBefore(s, ss);}if(d.readyState=='complete'){l();}else{if(w.attachEvent){w.attachEvent('onload',l);}else{w.addEventListener('load',l,false);}}})();
	</script>
	<!-- {/literal} END JIVOSITE CODE -->
    @yield('scripts')
</body>
</html>