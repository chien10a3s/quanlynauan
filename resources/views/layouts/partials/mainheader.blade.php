<div id="top-bar">
    <div class="container">
        <div id="mobile-menu" class="visible-xs"><a class="" href="#main-menu-mobile"><i class="fa fa-bars" aria-hidden="true"></i> Menu</a></div>
        {{ menu('topbar') }}
    </div>
</div>
<div id="masthead" class="site-header fixed-header">
    <div class="dgt-header-inner dgt-position-fixed">
        <div class="header-primary">
            <div class="container">
                <div class="header-section">
                    <span class="header-mobile-open-icon visible-sm visible-xs">
                        <i class="ion-navicon"></i>
                    </span>
                    <div class="row">
                        <div class="col-sm-3 col-md-2 col-lg-2" id="logo-image">
                            <div class="site-branding">
                                <p class="logo" id="logo">
                                    <a href="{{url('/')}}" rel="home">
                                        <img class="img-responsive" src="{{ Voyager::image(Voyager::setting('logo'))}}" />
                                    </a>
                                </p>
                            </div>
                        </div>
                        <div class="dgt-header-right col-md-3 pull-right">
                            <ul class="user-info">
                                <li class="user-link">
                                    <a href="{{ url('account') }}"><i class="fa fa-user-circle-o" aria-hidden="true"></i> <span class="hidden-xxs">Tài khoản</span></a>
                                </li>
                            </ul>
                        </div>
                        <div class="col-sm-12 col-md-7 col-lg-7">
                            <!--
                            <form method="get" id="searchform" class="searchform" action="http://demo.kevthemes.com/teaux/">
                                <div class="dgt-search-form">
                                    <div class="dgt-input-seach">
                                        <input type="text" placeholder="G?i ý t? khoá: Th?t l?n, th?t bò, rau c?i...." name="s" id="s" />
                                        <button type="submit" name="search"><i class="fa fa-search"></i><span>Tìm ki?m</span></button>
                                    </div>
                                </div>
                            </form>
                            -->
                            <div id="" class="main-menu hidden-xs">
                                {{ menu('main-navigation') }}
                            </div>

                            <div id="main-menu-mobile" class="hidden-lg hidden-md hidden-sm">
                                {{ menu('main-navigation') }}
                            </div>

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>