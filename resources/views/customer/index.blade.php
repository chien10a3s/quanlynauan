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
            						<img src="{{ asset('/images/s1.png') }}">
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
            						<img src="{{ asset('/images/s2.png') }}">
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
            						<img src="{{ asset('/images/s3.png') }}">
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
            						<img src="{{ asset('/images/s4.png') }}">
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
        </div>
    </body>
</html>
