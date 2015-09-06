<!doctype html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="x-ua-compatible" content="ie=edge">
        <title>@yield('title')</title>

        @yield('og')

        <meta name="description" content="Sitio para los fotos más hilarantes y divertido en internet !! Si tienen internet, ahi nos vemos ! :p">
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">

        <link rel="shortcut icon" href="{{ asset('img/favicon/favicon.png') }}">
        <link rel="apple-touch-icon" href="{{ asset('img/favicon/icon.png') }}">

        <script type="text/javascript">window.ayboll=(function(d,s,id){var js,fjs=d.getElementsByTagName(s)[0],t=window.ayboll||{};if(d.getElementById(id))return;js=d.createElement(s);js.id=id;js.src="//edge.ayboll.com/ayboll/js/widget.js";fjs.parentNode.insertBefore(js,fjs);t._e=[];t.ready=function(f){t._e.push(f);};return t;}(document,"script","ayboll-wjs"));</script>

        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="{{ asset('bower_components/wtf-forms/wtf-forms.css') }}">

        <link rel="stylesheet" href="{{ asset('css/main.css') }}">

    </head>
    <body class=@yield('class')>
        <!--[if lt IE 8]>
            <p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
        <![endif]-->

        <div class="content-wrap">

            @include('layout.nav')

            @yield('content')

        </div>

        <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
        <script src="{{ asset('js/lib/masonry.js') }}"></script>
        @include('partials.analytics')
        @yield('js')
    </body>
</html>
