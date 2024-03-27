<!DOCTYPE html>

<html lang="en">







  @include('layouts.partials.head')





  <body id="kt_body" class="header-fixed header-mobile-fixed subheader-enabled subheader-fixed aside-enabled aside-fixed aside-minimize-hoverable page-loading">
	


  @include('layouts.partials.header')



  @yield('content')



  @include('layouts.partials.footer')



  @include('layouts.partials.footer-scripts')



</body>



</html>