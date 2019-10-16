<!DOCTYPE html>
<html>
<head>
	<title>Admin - @yield('title')</title>
	<link rel="stylesheet" type="text/css" href="/css/all.css">
	<!-- Font Awesome CDN -->
	<link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.11.2/css/all.css">
</head>
<body>
  
  <!-- Sidebar -->
  @include('admin.includes.admin-sidebar')

  <div class="off-canvas-content admin_title_bar" data-off-canvas-content>
    <!-- Your page content lives here -->
    <div class="title-bar">
  		<div class="title-bar-left">
    		<button class="menu-icon hide-for-large" type="button" data-open="offCanvas"></button>
    		<span class="title-bar-title">{{ getenv('APP_NAME')}}</span>
  		</div>
  	</div>

    @yield('content')
    
  </div>

<script type="text/javascript" src="/js/all.js" async></script>
</body>
</html>