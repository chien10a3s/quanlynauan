@extends('layouts.1column')

@section('htmlheader_title')
	{{ Voyager::setting('title') }}
@endsection

@section('main-content')
<div class="container">
    <div class="row">
        <div class="col-md-9 col-xs-12">
            <div id="mainslider" class="owl-carousel">
                @foreach($slides as $slide)
                <div class="slide">
                    <a href="{{ $slide->url }}"><img src="{{ Voyager::image( $slide->image ) }}" class="img-responsive" /></a>
                </div>
                @endforeach
            </div>
        </div>
        <div class="col-md-3 col-xs-12">
            <ul id="slide-column-2">
                @foreach($banners as $banner)
                <li><a href="{{ $banner->url }}"><img src="{{ Voyager::image( $banner->image ) }}" class="img-responsive" /></a></li>
                @endforeach
            </ul>
        </div>
    </div>

    
    {!! Voyager::setting('service') !!}
    <!--
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
    -->
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
                            @foreach($featuredposts as $post)
                            <div class="dgt-blog-item dgt-clear-left col-sm-4 col-md-4 tips">
                                <div class="dgt-blog-item-inner">
                                    <div class="post-feature-image">
                                        <div class="wrapper-img">
                                            <a href="{{ url('blog/'.$post->slug) }}" title="{{$post->title}}"> 
                                                <img width="660" height="440" src="{{ Voyager::image($post->image)}}" class="attachment-large size-large wp-post-image" alt="{{$post->title}}"/> 
                                            </a>
                                        </div> 
                                        <span class="dgt-blog-date">{{ date('d-m-Y', $post->created_at->timestamp) }}</span>
                                    </div>
                                    <div class="dgt-blog-info">
                                        <h4 class="dgt-blog-title"><a class="blog-title" href="{{ url('blog/'.$post->slug) }}" title="{{$post->title}}"> {{$post->title}} </a></h4>
                                        <div class="info-post clearfix"> 
                                            <span class="dgt-blog-author">
                                                <img src="{{ Voyager::image($post->authorId->avatar)}}" width="20" height="20" alt="{{$post->title}}" class="avatar avatar-20 wp-user-avatar wp-user-avatar-20 alignnone photo"> 
                                                <a href="javascript:void(0)" title="{{ $post->authorId->name }}" rel="author">{{ $post->authorId->name }}</a>
                                            </span>
                                        </div>
                                        <div class="dgt-blog-description">{{ $post->excerpt }}</div>
                                        <div class="clearfix"></div>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <div id="testimonial" class="owl-carousel">
        @foreach($testimonials as $testimonial)
        <div class="dgt-testimonial-item dgt-al-center">
            <div class="dgt-testimonial-avatar"> 
                <img width="180" height="180" src="{{ Voyager::image($testimonial->image) }}" class="attachment-full size-full img-responsive" alt="">
            </div>
            <div class="dgt-testimonial-info">
                <p style="color: #ffffff">{{ $testimonial->testimonial }}</p>
                <h3 style="color: #ffffff">{{ $testimonial->name }}</h3>
                <h4>{{ $testimonial->about }}</h4>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection
