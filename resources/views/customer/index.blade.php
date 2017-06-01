<!doctype html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Kitchen</title>
        <link href="{{ asset('/css/bootstrap.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('/css/bootstrap-theme.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('/css/front.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('/css/animate.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('/css/owl.carousel.min.css') }}" rel="stylesheet" type="text/css" />
        <script type="text/javascript" src="{{ asset('/js/jquery-1.12.4.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('/js/bootstrap.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('/js/owl.carousel.min.js') }}"></script>
        <script type="text/javascript" src="{{ asset('/js/front.js') }}"></script>
    </head>
    <body>
        <div id="page" class="site">
            <div id="masthead" class="site-header fixed-header">
                <div class="dgt-header-inner dgt-position-fixed">
                    <div class="header-primary">
                        <div class="container">
                            <div class="header-section"> 
                                <span class="header-mobile-open-icon visible-sm visible-xs">
                                    <i class="ion-navicon"></i>
                                </span>
                                <div class="row">
                                    <div class="col-sm-3 col-md-3 col-lg-3">
                                        <div class="site-branding">
                                            <p class="logo" id="logo">
                                                <a href="{{url('/')}}" rel="home"> 
                                                    <img src="{{ asset('/images/logo.png') }}" alt="" /> 
                                                </a>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="hidden-sm hidden-xs col-sm-6 col-md-6">
                                        <form method="get" id="searchform" class="searchform" action="http://demo.kevthemes.com/teaux/">
                                            <div class="dgt-search-form">
                                                <div class="dgt-input-seach">
                                                    <input type="text" placeholder="Gợi ý từ khoá: Thịt lợn, thịt bò, rau cải...." name="s" id="s" />
                                                    <button type="submit" name="search"><i class="fa fa-search"></i><span>Tìm kiếm</span></button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                    <div class="hidden-sm hidden-xs dgt-header-right col-sm-3 col-md-3">
                                        <ul class="user-info">
                                            <li class="user-link">
                                                <a href="#"><i class="fa fa-user-circle-o" aria-hidden="true"></i> Tài khoản</a>
                                            </li>
                                            <li class="shopping-link">
                                                <a href="#"><i class="fa fa-shopping-basket" aria-hidden="true"></i> Giỏ hàng</a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="mainslider" class="owl-carousel">
                <div class="slide">
                    <a href="#"><img src="{{ asset('/images/img-slider-1.jpg') }}" class="img-responsive" /></a>
                </div>
                <div class="slide">
                    <a href="#"><img src="{{ asset('/images/img-slider-2.jpg') }}" class="img-responsive" /></a>
                </div>
            </div>
            <div id="content">
                <div class="container">
                    
                </div>
            </div>
        </div>
    </body>
</html>
