<!DOCTYPE html>
<html class="no-js" lang="zxx">
@include('frontend.partials.css')

<body>
    <!--[if lte IE 9]>
      <p class="browserupgrade">
        You are using an <strong>outdated</strong> browser. Please
        <a href="https://browsehappy.com/">upgrade your browser</a> to improve
        your experience and security.
      </p>
    <![endif]-->

    <!-- Preloader -->
    <div class="preloader">
        <div class="preloader-inner">
            <div class="preloader-icon">
                <span></span>
                <span></span>
            </div>
        </div>
    </div>
    <!-- /End Preloader -->

    <!-- Start Header Area -->
@include('frontend.partials.header')
    <!-- End Header Area -->



 @yield('content')

    <!-- Start Footer Area -->
@include('frontend.partials.footer')
    <!--/ End Footer Area -->

    <!-- ========================= scroll-top ========================= -->
    @include('frontend.partials.js')
</body>

</html>