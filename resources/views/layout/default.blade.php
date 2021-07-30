<!DOCTYPE html>
<html lang="en">

<head>
  <!-- Required meta tags -->
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Top Seven</title>
  <!-- plugins:css -->
  @include('layout.default-css')
  <!-- endinject -->
  <!-- <link rel="shortcut icon" href="../../images/favicon.png" /> -->
  @yield('css-page')
</head>

<body>
<div id="wrapper">
@include('layout.default-sidemenu')
      <!-- partial -->
<div id="content-wrapper" class="d-flex flex-column">
    
    <!-- partial -->
    <div id="content">
      
      @include('layout.default-headmenu')
      <div class="container-fluid">
        
          @yield('content')

          
        <!-- content-wrapper ends -->
        <!-- partial:../../partials/_footer.html -->
        <footer class="footer">
          @include('layout.default-copyright')
        </footer>
        <!-- partial -->
      </div>
      <!-- main-panel ends -->
    </div>
    <!-- page-body-wrapper ends -->
  </div>
</div>
  <!-- container-scroller -->
  <!-- plugins:js -->
  @include('layout.default-js')
  @yield('js-page')
</body>

</html>