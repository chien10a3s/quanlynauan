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
        <link href="{{ asset('/css/icofont.css') }}" rel="stylesheet" type="text/css" />
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
                                    <div class="col-xs-12">
                                        <div class="main-menu">
                                            <ul id="menu-main-menu-1" class="menu">
                                                <li class="menu-item current-menu-item"><a href="#">Trang chủ</a></li>
                                                <li class="menu-item"><a href="#">Hệ thống cửa hàng</a></li>
                                                <li class="menu-item"><a href="#">Hướng dẫn đặt hàng</a></li>
                                                <li class="menu-item"><a href="#">Hỗ trợ khách hàng</a></li>
                                                <li class="menu-item"><a href="#">Liên hệ</a></li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div id="slider-wrap" class="container">
                <div class="row">
                    <div class="col-md-9 col-xs-12">
                        <div id="mainslider" class="owl-carousel">
                            <div class="slide">
                                <a href="#"><img src="{{ asset('/images/img-slider-1.jpg') }}" class="img-responsive" /></a>
                            </div>
                            <div class="slide">
                                <a href="#"><img src="{{ asset('/images/img-slider-2.jpg') }}" class="img-responsive" /></a>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-3 col-xs-12">
                        <ul id="slide-column-2">
                            <li><a href="#"><img src="{{ asset('/images/small-1.jpg') }}" class="img-responsive" /></a></li>
                            <li><a href="#"><img src="{{ asset('/images/small-2.jpg') }}" class="img-responsive" /></a></li>
                            <li><a href="#"><img src="{{ asset('/images/small-3.jpg') }}" class="img-responsive" /></a></li>
                        </ul>
                    </div>
                </div>
                <!--
                <div class="image_thumb">
                    <ul>
                        <li class="">
                            <a href="https://media.foody.vn/biz_banner/foody-1170-375-longphung-01-01-636299241614892508.jpg" title="Long Phụng Royal">
                                <img src="https://media.foody.vn/biz_banner/s40x40/foody-1170-375-longphung-01-01-636299241614892508.jpg" alt="Long Phụng Royal" title="Long Phụng Royal">
                            </a>
                            <div class="block">
                                <div class="thumb-descr">
                                    <p><span style="font-size:11px">Nhà hàng khá sang trọng phù hợp để đặt tiệc cưới</span>
                                    </p>
                                </div>
                                <h2><a title="Long Phụng Royal">Long Phụng Royal</a></h2>
                            </div>
                        </li>
                        <li class="">
                            <a href="https://media.foody.vn/biz_banner/foody-hai%20san%20v68%201170x375-636316615549556692.jpg" title="V68 - Hải Sản Các Món">
                                <img src="https://media.foody.vn/biz_banner/s40x40/foody-hai%20san%20v68%201170x375-636316615549556692.jpg" alt="V68 - Hải Sản Các Món" title="V68 - Hải Sản Các Món">
                            </a>
                            <div class="block">
                                <div class="thumb-descr">
                                    <p><span style="font-size:11px">Giảm ngay 20% tổng hóa đơn cho khách đặt bàn trước.</span>
                                    </p>
                                </div>
                                <h2><a title="V68 - Hải Sản Các Món">V68 - Hải Sản Các Món</a></h2>
                            </div>
                        </li>
                    </ul>
                </div>
                -->
            </div>
            
            <div id="content">
                <div class="container">
                    <div class="service">
            			<div class="col-xs-6 col-sm-3 service-item">
            				<a href="#">
            					<div class="icon text-center">
            						<i class="icofont icofont-free-delivery"></i>
            					</div>
            					<div class="info">
            						<h3>Miễn phí giao hàng</h3>
            						<span>Đơn hàng 300.000 đ trở lên</span>
            					</div>
            				</a>
            			</div>
            			<div class="col-xs-6 col-sm-3 service-item">
            				<a href="#">
            					<div class="icon text-center">
            						<i class="icofont icofont-fast-delivery"></i>
            					</div>
            					<div class="info">
            						<h3>Giao hàng trong ngày</h3>
            						<span>Khi đặt hàng trước 10h sáng</span>
            					</div>
            				</a>
            			</div>
            			<div class="col-xs-6 col-sm-3 service-item">
            				<a href="#">
            					<div class="icon text-center">
            						<i class="icofont icofont-checked"></i>
            					</div>
            					<div class="info">
            						<h3>Đảm bảo chất lượng</h3>
            						<span>Sản phẩm đã được kiểm định</span>
            					</div>
            				</a>
            			</div>
            			<div class="col-xs-6 col-sm-3 service-item">
            				<a href="#">
            					<div class="icon text-center">
            						<i class="icofont icofont-social-wechat"></i>
            					</div>
            					<div class="info">
            						<h3>Hỗ trợ</h3>
            						<span>Hotline: 1900 636 979</span>
            					</div>
            				</a>
            			</div>
            		</div>
                </div>
            </div>
            <div id="section-2">
                <div class="container">
                    <div class="dgt-custom-heading">
                        <span class="dgt-heading-icon">
                            <img src="{{ asset('/images/icon-heading-small.png') }}" width="27" height="35" alt="Icon Heading"/>
                        </span>
                        <h2 style="text-align: center" class="dgt-heading">Teaux</h2>
                        <p class="dgt-sub-title" style="color: #ffffff">Về chúng tôi</p>
                    </div>
                    <div class="row">
                        <div class="col-sm-3 dgt-counter-box-inner"> 
                            <span class="dgt-icon"><i style="font-size: 80px" class="icofont icofont-pizza"></i></span>
                            <h3 class="dgt-counter">25.540</h3>
                            <h4>Khách hàng</h4>
                        </div>
                        
                        <div class="col-sm-3 dgt-counter-box-inner"> 
                            <span class="dgt-icon"><i style="font-size: 80px" class="icofont icofont-noodles"></i></span>
                            <h3 class="dgt-counter">3.500</h3>
                            <h4>Món ăn</h4>
                        </div>
                        
                        <div class="col-sm-3 dgt-counter-box-inner"> 
                            <span class="dgt-icon"><i style="font-size: 80px" class="icofont icofont-chef"></i></span>
                            <h3 class="dgt-counter">25.540</h3>
                            <h4>Đầu bếp</h4>
                        </div>
                        
                        <div class="col-sm-3 dgt-counter-box-inner"> 
                            <span class="dgt-icon"><i style="font-size: 80px" class="icofont icofont-sandwich"></i></span>
                            <h3 class="dgt-counter">25.540</h3>
                            <h4>Đánh giá</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </body>
</html>
