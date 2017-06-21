<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('htmlheader_title', Voyager::setting('title'))</title>
    <meta name="description" content="{{ Voyager::setting('description') }}">
    
    <link href="{{ asset('/css/all.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/css/bootstrap-theme.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/css/jquery.mmenu.all.css') }}" rel="stylesheet" type="text/css" />
    
    <link href="{{ asset('/css/icofont.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/css/front.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/css/animate.css') }}" rel="stylesheet" type="text/css" />
    
    <link href="{{ asset('/css/owl.carousel.min.css') }}" rel="stylesheet" type="text/css" />
    <script type="text/javascript" src="{{ asset('/js/jquery-1.12.4.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/js/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/js/owl.carousel.min.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/js/jquery.sticky.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/js/jquery.mmenu.all.js') }}"></script>
    <script type="text/javascript" src="{{ asset('/js/front.js') }}"></script>
</head>