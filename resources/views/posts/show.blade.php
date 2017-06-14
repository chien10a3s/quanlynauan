<!doctype html>
<html lang="{{ config('app.locale') }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>Kitchen</title>
        <link href="{{ asset('/css/all.css') }}" rel="stylesheet" type="text/css" />
        <link href="{{ asset('/css/font-awesome.min.css') }}" rel="stylesheet" type="text/css" />
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
                                            <ul id="menu-main-menu-1" class="menu">
                                                <li class="menu-item current-menu-item"><a href="#">Trang chủ</a></li>
                                                <li class="menu-item"><a href="#">Hệ thống cửa hàng</a></li>
                                                <li class="menu-item"><a href="#">Hướng dẫn đặt hàng</a></li>
                                                <li class="menu-item"><a href="#">Hỗ trợ khách hàng</a></li>
                                                <li class="menu-item"><a href="#">Liên hệ</a></li>
                                            </ul>
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

            <div id="content">
                <div class="container">
                    <div class="row">
                        <div class="col-md-3 col-xs-12" id="left-column">
                            <div class="box box-danger direct-chat direct-chat-danger">
                                <div class="box-header with-border">
                                    <h3 class="box-title">Bài viết cùng chuyên mục</h3>
                                </div>
                                <div class="box-body">
                                    <ul class="related-post">
                                        @foreach($post->category->posts as $relatedpost)
                                            @if($relatedpost->id != $post->id)
                                                <li>
                                                    <a href="{{ url('blog/'.$post->category->slug.'/'.$relatedpost->slug) }}" title="{{$relatedpost->title}}">
                                                        @if(isset($relatedpost->image) && $relatedpost->image )
                                                            <img src="{{ Voyager::image( $relatedpost->image ) }}" class="img-responsive" />
                                                        @endif
                                                        {{$relatedpost->title}}
                                                    </a>
                                                </li>
                                            @endif
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-9 col-xs-12" id="center-column">
                            <div class="box box-danger direct-chat direct-chat-danger">
                                <div class="box-header with-border">
                                    <h3 class="post-title">{{ $post->title }}</h3>
                                    <ul class="post-meta">
                                        <li>Blog: <a href="{{ url('blog/category/'.$post->category->slug) }}" title="{{$post->category->name}}"><span>{{$post->category->name}}</span></a></li><!--
                                        --><li>Tác giả: <span>{{ $post->authorId->name }}</span></li><!--
                                        --><li>Ngày: <span>{{ date('d/m/Y', strtotime($post->created_at)) }}</span></li>
                                    </ul>
                                </div>
                                <div class="box-body">
                                    @if(isset($post->image) && $post->image )
                                    <div class="rte post-image">
                                        <img src="{{ Voyager::image( $post->image ) }}" class="img-responsive" />
                                    </div>
                                    @endif
                                    
                                    <div class="rte post-body">
                                        {!! $post->body !!}
                                    </div>
                                </div>
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
