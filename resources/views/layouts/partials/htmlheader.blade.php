<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('htmlheader_title', Voyager::setting('title'))</title>
    <meta name="description" content="{{ Voyager::setting('description') }}">
    
    <link href="{{ asset('/css/all.css') }}" rel="stylesheet" type="text/css" />

    <link href="{{ asset('/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('/css/jquery.mmenu.all.css') }}" rel="stylesheet" type="text/css" />
    <link rel="stylesheet" type="text/css" href="{{ voyager_asset('lib/css/toastr.min.css') }}">
    <link rel="stylesheet" href="{{ voyager_asset('fonts/voyager/styles.css') }}">
    
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
    <script type="text/javascript" src="{{ voyager_asset('lib/js/toastr.min.js') }}"></script>
    <script type="text/javascript" src="{{ voyager_asset('lib/js/bootstrap.min.js') }}"></script>
    <script type="text/javascript" src="{{ voyager_asset('lib/js/bootstrap-switch.min.js') }}"></script>
    <script>
                @if(Session::has('alerts'))
        let alerts = {!! json_encode(Session::get('alerts')) !!};

        displayAlerts(alerts, toastr);
        @endif

        @if(Session::has('message'))

        // TODO: change Controllers to use AlertsMessages trait... then remove this
        var alertType = {!! json_encode(Session::get('alert-type', 'info')) !!};
        var alertMessage = {!! json_encode(Session::get('message')) !!};
        var alerter = toastr[alertType];

        if (alerter) {
            alerter(alertMessage);
        } else {
            toastr.error("toastr alert-type " + alertType + " is unknown");
        }

        @endif
    </script>
</head>