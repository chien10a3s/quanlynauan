<footer id="footer" class="site-footer footer-fixed">
    <div class="footer-widget">
        <div class="container">
            <div class="row">
                <div class="col-sm-6 col-md-3">
                    <div id="dgt_fiora_about_widget-3" class="widget first dgt_fiora_about_widget">
                        <div class="dgt-widget-about">
                            {!!Voyager::setting('footer_about')!!}
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3">
                    <div id="dgt_soraka_latest_news_widget-6" class="widget dgt_soraka_latest_news_widget">
                        <h3 class="widget-title">BÀI VIẾT MỚI NHẤT</h3>
                        <div class="dgt-blog-sidebar">
                            <?php $latestposts = \TCG\Voyager\Models\Post::where('status', 'PUBLISHED')->orderBy('created_at', 'DESC')->limit(2)->get(); ?>
                            @foreach($latestposts as $post)
                            <div class="dgt-blog-sidebar-item clearfix">
                                <div class="blog-image">
                                    <a href="{{ url('blog/'.$post->slug) }}" rel="bookmark" title="Permanent Link: {{$post->title}}">
                                        <img width="230" height="230" src="{{ Voyager::image($post->image)}}" class="attachment-thumbnail size-thumbnail wp-post-image" alt="">
                                    </a>
                                </div>
                                <div class="blog-info">
                                    <h4><a href="{{ url('blog/'.$post->slug) }}" rel="bookmark" title="Permanent Link: {{$post->title}}">{{$post->title}}</a></h4>
                                    <span class="dgt-blog-date">{{ date('d-m-Y', $post->created_at->timestamp) }}</span>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-3">
                    <h3 class="widget-title">THÔNG TIN</h3>
                    <div class="dgt-blog-sidebar">
                        {{ menu('footer') }}
                    </div>
                </div>
                <div class="col-sm-6 col-md-3">
                    <h3 class="widget-title">LIÊN HỆ</h3>
                    <div class="dgt-social icon-show name-hidden">
                        <div class="fb-page" data-href="{{Voyager::setting('facebook_url')}}" data-small-header="false" data-adapt-container-width="true" data-hide-cover="false" data-show-facepile="true"><blockquote cite="https://www.facebook.com/facebook" class="fb-xfbml-parse-ignore"><a href="https://www.facebook.com/facebook">Facebook</a></blockquote></div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div id="coppyright">
        <div class="container">
            <div class="coppyright-inner dgt-al-center">
                <div class="row">
                    <p>{{Voyager::setting('copyright')}}</p>
                </div>
            </div>
        </div>
    </div>
</footer>