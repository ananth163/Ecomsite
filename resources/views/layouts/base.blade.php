<!DOCTYPE html>
<html class="no-js" lang="en">
  <head>
    <meta charset="utf-8" />
    <meta http-equiv="x-ua-compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>{{getenv('APP_NAME')}} - @yield('title')</title>
    <link rel="stylesheet" type="text/css" href="/css/all.css">
    <!-- Font Awesome CDN -->
    <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">  
</head>
<body data-pageid="@yield('pageid')">
  
  <!-- Navigation -->
    @include('includes.nav')
  
  <!-- Sitewrapper -->
  <div class="site-wrapper">
    @yield('content')
    <div class="notify text-center"></div>
  </div>

  <!-- Footer -->
  @yield('footer')

  
  <script type="text/javascript" src="/js/all.js" async></script>
</body>
</html>