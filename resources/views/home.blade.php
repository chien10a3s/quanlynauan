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
        <script type="text/javascript" src="{{ asset('/js/jquery.sticky.js') }}"></script>
        <script type="text/javascript" src="{{ asset('/js/front.js') }}"></script>
    </head>
    <body>
        <div id="fb-root"></div>
        <script>(function(d, s, id) {
          var js, fjs = d.getElementsByTagName(s)[0];
          if (d.getElementById(id)) return;
          js = d.createElement(s); js.id = id;
          js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.9&appId=1713794735515717";
          fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));</script>
    
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
                                    <div class="col-sm-3 col-md-3 col-lg-2">
                                        <div class="site-branding">
                                            <p class="logo" id="logo">
                                                <a href="{{url('/')}}" rel="home"> 
                                                    <img src="{{ asset('/images/logo.png') }}" alt="" /> 
                                                </a>
                                            </p>
                                        </div>
                                    </div>
                                    <div class="hidden-sm hidden-xs col-sm-6 col-md-6 col-lg-7">
                                        <!--
                                        <form method="get" id="searchform" class="searchform" action="http://demo.kevthemes.com/teaux/">
                                            <div class="dgt-search-form">
                                                <div class="dgt-input-seach">
                                                    <input type="text" placeholder="Gợi ý từ khoá: Thịt lợn, thịt bò, rau cải...." name="s" id="s" />
                                                    <button type="submit" name="search"><i class="fa fa-search"></i><span>Tìm kiếm</span></button>
                                                </div>
                                            </div>
                                        </form>
                                        -->
                                        
                                        <div class="main-menu">
                                            {{ menu('front') }}
                                        </div>
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
                    <div id="section-2">
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
                    
                    <div id="blog" class="vc_row wpb_row vc_row-fluid dgt-bg-inherit">
                        <div class="wpb_column vc_column_container vc_col-sm-12">
                            <div class="vc_column-inner ">
                                <div class="wpb_wrapper">
                                    <div class="dgt-custom-heading vc_custom_heading dgt-al-center">
                                        <span class="dgt-heading-icon">
                                        <img src="http://demo.kevthemes.com/teaux/wp-content/uploads/2017/03/icon-heading.png" width="27" height="35" alt="Icon Heading"></span>
                                        <h2 style="text-align: center" class="dgt-heading">Our blog</h2>
                                        <p class="dgt-sub-title">for cooking-holic</p>
                                        <div class="clearfix"></div>
                                    </div>
                                    <div class="dgt-vc-element dgt-blog-grid">
                                        <div class="row">
                                            <div class="dgt-blog-item  dgt-clear-left col-sm-4 col-md-4 tips">
                                                <div class="dgt-blog-item-inner">
                                                    <div class="post-feature-image">
                                                        <div class="wrapper-img">
                                                            <a href="http://demo.kevthemes.com/teaux/restaurant-to-host-spring/" title="Restaurant to host “Spring”"> <img width="660" height="440" src="http://demo.kevthemes.com/teaux/wp-content/uploads/2016/10/img-blog-1.jpg" class="attachment-large size-large wp-post-image" alt="" srcset="http://demo.kevthemes.com/teaux/wp-content/uploads/2016/10/img-blog-1.jpg 700w, http://demo.kevthemes.com/teaux/wp-content/uploads/2016/10/img-blog-1-300x200.jpg 300w" sizes="(max-width: 660px) 100vw, 660px"> </a>
                                                        </div> <span class="dgt-blog-date">31<span>Oct</span></span>
                                                    </div>
                                                    <div class="dgt-blog-info">
                                                        <h4 class="dgt-blog-title"> <a class="blog-title" href="http://demo.kevthemes.com/teaux/restaurant-to-host-spring/" title="Restaurant to host “Spring”"> Restaurant to host “Spring” </a></h4>
                                                        <div class="info-post clearfix"> <span class="dgt-blog-author"><img src="http://demo.kevthemes.com/teaux/wp-content/uploads/2016/11/avatar-2.png" width="20" height="20" alt="Restaurant" class="avatar avatar-20 wp-user-avatar wp-user-avatar-20 alignnone photo"> <a href="http://demo.kevthemes.com/teaux/author/admin/" title="Posts by Restaurant" rel="author">Restaurant</a></span>
                                                        </div>
                                                        <div class="dgt-blog-description"> English has paired 16 Memphis chefs with 16 guest chefs from throughout the country to create a one-of-a-kind culinary...</div>
                                                        <div class="clearfix"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="dgt-blog-item  col-sm-4 col-md-4 blog">
                                                <div class="dgt-blog-item-inner">
                                                    <div class="post-feature-image">
                                                        <div class="wrapper-img">
                                                            <a href="http://demo.kevthemes.com/teaux/join-us-for-le-soild-restaurant/" title="Join us for Le Soild Restaurant"> <img width="660" height="440" src="http://demo.kevthemes.com/teaux/wp-content/uploads/2016/10/img-blog-2.jpg" class="attachment-large size-large wp-post-image" alt="" srcset="http://demo.kevthemes.com/teaux/wp-content/uploads/2016/10/img-blog-2.jpg 700w, http://demo.kevthemes.com/teaux/wp-content/uploads/2016/10/img-blog-2-300x200.jpg 300w" sizes="(max-width: 660px) 100vw, 660px"> </a>
                                                        </div> <span class="dgt-blog-date">31<span>Oct</span></span>
                                                    </div>
                                                    <div class="dgt-blog-info">
                                                        <h4 class="dgt-blog-title"> <a class="blog-title" href="http://demo.kevthemes.com/teaux/join-us-for-le-soild-restaurant/" title="Join us for Le Soild Restaurant"> Join us for Le Soild Restaurant </a></h4>
                                                        <div class="info-post clearfix"> <span class="dgt-blog-author"><img src="http://demo.kevthemes.com/teaux/wp-content/uploads/2016/11/avatar-2.png" width="20" height="20" alt="Restaurant" class="avatar avatar-20 wp-user-avatar wp-user-avatar-20 alignnone photo"> <a href="http://demo.kevthemes.com/teaux/author/admin/" title="Posts by Restaurant" rel="author">Restaurant</a></span>
                                                        </div>
                                                        <div class="dgt-blog-description"> English has paired 16 Memphis chefs with 16 guest chefs from throughout the country to create a one-of-a-kind culinary...</div>
                                                        <div class="clearfix"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="dgt-blog-item  col-sm-4 col-md-4 blog">
                                                <div class="dgt-blog-item-inner">
                                                    <div class="post-feature-image">
                                                        <div class="wrapper-img">
                                                            <a href="http://demo.kevthemes.com/teaux/yelp-restaurant-wins-best-fine-dining/" title="YELP: Restaurant wins Best Fine"> <img width="660" height="440" src="http://demo.kevthemes.com/teaux/wp-content/uploads/2016/10/img-blog-3.jpg" class="attachment-large size-large wp-post-image" alt="" srcset="http://demo.kevthemes.com/teaux/wp-content/uploads/2016/10/img-blog-3.jpg 700w, http://demo.kevthemes.com/teaux/wp-content/uploads/2016/10/img-blog-3-300x200.jpg 300w" sizes="(max-width: 660px) 100vw, 660px"> </a>
                                                        </div> <span class="dgt-blog-date">31<span>Oct</span></span>
                                                    </div>
                                                    <div class="dgt-blog-info">
                                                        <h4 class="dgt-blog-title"> <a class="blog-title" href="http://demo.kevthemes.com/teaux/yelp-restaurant-wins-best-fine-dining/" title="YELP: Restaurant wins Best Fine"> YELP: Restaurant wins Best Fine </a></h4>
                                                        <div class="info-post clearfix"> <span class="dgt-blog-author"><img src="http://demo.kevthemes.com/teaux/wp-content/uploads/2016/11/avatar-2.png" width="20" height="20" alt="Restaurant" class="avatar avatar-20 wp-user-avatar wp-user-avatar-20 alignnone photo"> <a href="http://demo.kevthemes.com/teaux/author/admin/" title="Posts by Restaurant" rel="author">Restaurant</a></span>
                                                        </div>
                                                        <div class="dgt-blog-description"> English has paired 16 Memphis chefs with 16 guest chefs from throughout the country to create a one-of-a-kind culinary...</div>
                                                        <div class="clearfix"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    
                    <div id="testimonial" class="owl-carousel">
                        <div class="dgt-testimonial-item dgt-al-center">
                            <div class="dgt-testimonial-avatar"> 
                                <img width="180" height="180" src="{{ asset('/images/avatar-1.png') }}" class="attachment-full size-full img-responsive" alt="">
                            </div>
                            <div class="dgt-testimonial-info">
                                <p style="color: #ffffff">Đồ ăn ngon, rất hợp khẩu vị. Nấu đúng yêu cầu. Đồ ăn ngon, rất hợp khẩu vị. Nấu đúng yêu cầu. Đồ ăn ngon, rất hợp khẩu vị. Nấu đúng yêu cầu</p>
                                <h3 style="color: #ffffff">NK Hoài</h3>
                                <h4>Types Of Cookware Pots And Pans</h4>
                            </div>
                        </div>
                        <div class="dgt-testimonial-item dgt-al-center">
                            <div class="dgt-testimonial-avatar"> 
                                <img width="180" height="180" src="{{ asset('/images/avatar-2.png') }}" class="attachment-full size-full img-responsive" alt="">
                            </div>
                            <div class="dgt-testimonial-info">
                                <p style="color: #ffffff">Đồ ăn ngon, rất hợp khẩu vị. Nấu đúng yêu cầu. Đồ ăn ngon, rất hợp khẩu vị. Nấu đúng yêu cầu. Đồ ăn ngon, rất hợp khẩu vị. Nấu đúng yêu cầu</p>
                                <h3 style="color: #ffffff">NK Hoài</h3>
                                <h4>Types Of Cookware Pots And Pans</h4>
                            </div>
                        </div>
                        <div class="dgt-testimonial-item dgt-al-center">
                            <div class="dgt-testimonial-avatar"> 
                                <img width="180" height="180" src="{{ asset('/images/avatar-19.jpg') }}" class="attachment-full size-full img-responsive" alt="">
                            </div>
                            <div class="dgt-testimonial-info">
                                <p style="color: #ffffff">Đồ ăn ngon, rất hợp khẩu vị. Nấu đúng yêu cầu. Đồ ăn ngon, rất hợp khẩu vị. Nấu đúng yêu cầu. Đồ ăn ngon, rất hợp khẩu vị. Nấu đúng yêu cầu</p>
                                <h3 style="color: #ffffff">NK Hoài</h3>
                                <h4>Types Of Cookware Pots And Pans</h4>
                            </div>
                        </div><div class="dgt-testimonial-item dgt-al-center">
                            <div class="dgt-testimonial-avatar"> 
                                <img width="180" height="180" src="{{ asset('/images/avatar-20.jpg') }}" class="attachment-full size-full img-responsive" alt="">
                            </div>
                            <div class="dgt-testimonial-info">
                                <p style="color: #ffffff">Đồ ăn ngon, rất hợp khẩu vị. Nấu đúng yêu cầu. Đồ ăn ngon, rất hợp khẩu vị. Nấu đúng yêu cầu. Đồ ăn ngon, rất hợp khẩu vị. Nấu đúng yêu cầu</p>
                                <h3 style="color: #ffffff">NK Hoài</h3>
                                <h4>Types Of Cookware Pots And Pans</h4>
                            </div>
                        </div>
                        <div class="dgt-testimonial-item dgt-al-center">
                            <div class="dgt-testimonial-avatar"> 
                                <img width="180" height="180" src="{{ asset('/images/avatar-1.png') }}" class="attachment-full size-full img-responsive" alt="">
                            </div>
                            <div class="dgt-testimonial-info">
                                <p style="color: #ffffff">Đồ ăn ngon, rất hợp khẩu vị. Nấu đúng yêu cầu. Đồ ăn ngon, rất hợp khẩu vị. Nấu đúng yêu cầu. Đồ ăn ngon, rất hợp khẩu vị. Nấu đúng yêu cầu</p>
                                <h3 style="color: #ffffff">NK Hoài</h3>
                                <h4>Types Of Cookware Pots And Pans</h4>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>
            
            <footer id="footer" class="site-footer footer-fixed">
                <div class="footer-widget">
                    <div class="container">
                        <div class="row">
                            <div class="col-sm-3 col-md-3">
                                <div id="dgt_fiora_about_widget-3" class="widget first dgt_fiora_about_widget">
                                    <div class="dgt-widget-about">
                                        <div class="logo-footer">
                                            <a href="#" rel="home"> <img src="{{ asset('/images/logo-footer.png') }}" alt=""></a>
                                        </div>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.</p>
                                        <div class="dgt-about-info"></div>
                                        
                                        <div class="dgt-widget-about">
                                            <div class="dgt-about-info">
                                                <p><i class="icofont icofont-location-pin"></i>Keangnam Landmark Tower, Ha Noi</p>
                                                <p><i class="icofont icofont-mail"></i><a href="mailto:support@company.com">support@company.com</a>
                                                </p>
                                                <p><i class="icofont icofont-ui-touch-phone"></i>(0123) 456-789-000</p>
                                                <p><i class="icofont icofont-clock-time"></i>Monday - Sunday: 8:00 AM - 22:00 PM</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3 col-md-3">
                                <div id="dgt_soraka_latest_news_widget-6" class="widget dgt_soraka_latest_news_widget">
                                    <h3 class="widget-title">BÀI VIẾT MỚI NHẤT</h3>
                                    <div class="dgt-blog-sidebar">
                                        <div class="dgt-blog-sidebar-item clearfix">
                                            <div class="blog-image">
                                                <a href="http://demo.kevthemes.com/teaux/restaurant-to-host-spring/" rel="bookmark" title="Permanent Link: Restaurant to host “Spring”"><img width="230" height="230" src="http://demo.kevthemes.com/teaux/wp-content/uploads/2016/10/img-blog-1-230x230.jpg" class="attachment-thumbnail size-thumbnail wp-post-image" alt="">
                                                </a>
                                            </div>
                                            <div class="blog-info">
                                                <h4><a href="http://demo.kevthemes.com/teaux/restaurant-to-host-spring/" rel="bookmark" title="Permanent Link: Restaurant to host “Spring”">Restaurant to host “Spring”</a></h4> <span class="dgt-blog-date">Oct 31, 2016</span>
                                            </div>
                                        </div>
                                        <div class="dgt-blog-sidebar-item clearfix">
                                            <div class="blog-image">
                                                <a href="http://demo.kevthemes.com/teaux/join-us-for-le-soild-restaurant/" rel="bookmark" title="Permanent Link: Join us for Le Soild Restaurant"><img width="230" height="230" src="http://demo.kevthemes.com/teaux/wp-content/uploads/2016/10/img-blog-2-230x230.jpg" class="attachment-thumbnail size-thumbnail wp-post-image" alt="">
                                                </a>
                                            </div>
                                            <div class="blog-info">
                                                <h4><a href="http://demo.kevthemes.com/teaux/join-us-for-le-soild-restaurant/" rel="bookmark" title="Permanent Link: Join us for Le Soild Restaurant">Join us for Le Soild Restaurant</a></h4> <span class="dgt-blog-date">Oct 31, 2016</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-3 col-md-3">
                                <h3 class="widget-title">THÔNG TIN</h3>
                                <div class="dgt-blog-sidebar">
                                    <ul class="care-customer">
        								<li><a href="#">Giới thiệu</a></li>
        								<li><a href="#">Điều khoản sử dụng</a></li>
        								<li><a href="#">Chính sách bảo mật thông tin</a></li>
        								<li><a href="#">Hướng dẫn đặt hàng</a></li>
        								<li><a href="#">Hệ thống của hàng</a></li>
                                        <li><a href="#">Liên hệ</a></li>
        							</ul>
                                </div>
                            </div>
                            <div class="col-sm-3 col-md-3">
                                <h3 class="widget-title">LIÊN HỆ</h3>
                                <div class="dgt-social icon-show name-hidden">
                                    <div class="fb-page" data-href="https://www.facebook.com/facebook" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/facebook" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/facebook">Facebook</a></blockquote></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div id="coppyright">
                    <div class="container">
                        <div class="coppyright-inner dgt-al-center">
                            <div class="row">
                                <p>© Copyright 2017, All Rights Reserved</a>
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </footer>
            
        </div>
    </body>
</html>
