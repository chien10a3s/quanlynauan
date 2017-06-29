<!DOCTYPE html>
<html lang="en">
    @section('htmlheader')
        @include('layouts.partials.htmlheader')
    @show
    @yield('header')
    <body class="template-{{ $view_name }}">
        <div id="fb-root"></div>
        <script>(function(d, s, id) {
          var js, fjs = d.getElementsByTagName(s)[0];
          if (d.getElementById(id)) return;
          js = d.createElement(s); js.id = id;
          js.src = "//connect.facebook.net/vi_VN/sdk.js#xfbml=1&version=v2.9&appId=1713794735515717";
          fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'facebook-jssdk'));</script>

        <div id="page" class="site">
            @include('layouts.partials.mainheader')
            <div id="content">
                @yield('main-content')
            </div>
            @include('layouts.partials.footer')
        </div>
    </body>
    @yield('page-script')
</html>
