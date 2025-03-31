<!DOCTYPE html>
<html lang="en">
<head>
    @include('partials.head') <!-- Incluye meta tags, título y enlaces CSS comunes -->
</head>
<body>
<body> 
    <!-- loader starts-->
    <div class="loader-wrapper">
      <div class="theme-loader">    
        <div class="loader-p"></div>
      </div>
    </div>
    <!-- loader ends-->
    <!-- tap on top starts-->
    <div class="tap-top"><i data-feather="chevrons-up"></i></div>
    <!-- tap on tap ends-->
    <!-- page-wrapper Start   -->
    <div class="page-wrapper compact-wrapper" id="pageWrapper">
      <!-- Page Header Start -->
      @include('partials.header')

      <!-- Page Header Ends                              -->
      <!-- Page body Start -->
      <div class="page-body-wrapper"> 
        
        <!-- Page Sidebar Start-->
        @include('partials.sidebar')
        <!-- Page Sidebar Ends-->
        <div class="page-body">
          <div class="container-fluid">
            <div class="page-title"> 
              <div class="row">
                <div class="col-xl-4 col-sm-7 box-col-3">
                  <h3>Dashboard de Hidroponia</h3>
                  
                </div>
                <div class="col-5 d-none d-xl-block">
                  <!-- Page Sub Header Start-->
                  
                  <!-- Page Sub Header end
                  -->
                </div>
                <div class="col-xl-3 col-sm-5 box-col-4">
                  <ol class="breadcrumb"> 
                    <li class="breadcrumb-item"><a href="index.html">
                        <svg class="stroke-icon">
                          <use href="../assets/svg/icon-sprite.svg#stroke-home"></use>
                        </svg></a></li>
                    <li class="breadcrumb-item">Dashboard</li>
                    <li class="breadcrumb-item active">Default</li>
                  </ol>
                </div>
              </div>
            </div>
          </div>
          <!-- Container-fluid starts-->
          
          <!-- Container-fluid Ends-->
        </div>
        <!-- footer start-->
        @include('partials.footer')
      </div>
    </div>
    @include('partials.scripts')
  </body>
</html>
