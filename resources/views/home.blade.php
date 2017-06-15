@extends('layouts.1column')

@section('htmlheader_title')
	{{ Voyager::setting('title') }}
@endsection

@section('main-content')
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
		<div class="col-xs-6 col-md-3 service-item">
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
		<div class="col-xs-6 col-md-3 service-item">
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
		<div class="col-xs-6 col-md-3 service-item">
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
		<div class="col-xs-6 col-md-3 service-item">
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
@endsection
