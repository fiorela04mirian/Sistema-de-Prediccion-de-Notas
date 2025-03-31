<!-- Page Header Start -->
<div class="page-header">
          <div class="header-wrapper row m-0">
              <div class="header-logo-wrapper col-auto p-0">
                  <div class="logo-wrapper">
                      <a href="index.html">
                          <img class="img-fluid for-light" src="../assets/images/logo/logo.png" alt="">
                          <img class="img-fluid for-dark" src="../assets/images/logo/logo_dark.png" alt="">
                      </a>
                  </div>
                  <div class="toggle-sidebar">
                      <svg class="sidebar-toggle">
                          <use href="../assets/svg/icon-sprite.svg#stroke-animation"></use>
                      </svg>
                  </div>
              </div>

              <form class="col-sm-4 form-inline search-full d-none d-xl-block" action="#" method="get">
                  <div class="form-group">
                      <div class="Typeahead Typeahead--twitterUsers"></div>
                  </div>
              </form>

              <div class="nav-right col-xl-8 col-lg-12 col-auto pull-right right-header p-0">
                  <ul class="nav-menus">
                      <li class="serchinput">
                          <div class="serchbox">
                              <svg>
                                  <use href="../assets/svg/icon-sprite.svg#search"></use>
                              </svg>
                          </div>
                          <div class="form-group search-form">
                              <input type="text" placeholder="Search here...">
                          </div>
                      </li>

                      <!-- Sección de perfil condicional según autenticación -->
                      <li class="profile-nav onhover-dropdown pe-0 py-0">
                          @auth
                          <!-- Si el usuario está autenticado, muestra su nombre -->
                          <div class="d-flex align-items-center profile-media">
                              <img class="b-r-25" src="../assets/images/dashboard/profile.png" alt="">
                              <div class="flex-grow-1 user">
                                  <span>{{ Auth::user()->name }}</span> <!-- Muestra el nombre del usuario -->
                                  <p class="mb-0 font-nunito">
                                      {{ __('Usuario') }}
                                      <svg>
                                          <use href="../assets/svg/icon-sprite.svg#header-arrow-down"></use>
                                      </svg>
                                  </p>
                              </div>
                          </div>

                          <ul class="profile-dropdown onhover-show-div">
                              <li><a href="{{ route('home') }}"><i data-feather="user"></i><span>Cuenta</span></a></li>
                              <li>
                                  <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                      <i data-feather="log-in"></i><span>Cerrar sesión</span>
                                  </a>
                                  <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                      @csrf
                                  </form>
                              </li>
                          </ul>
                          @else
                          <!-- Si el usuario no está autenticado, muestra el enlace para iniciar sesión -->
                          <a href="{{ route('login') }}" class="btn btn-primary">{{ __('Iniciar sesión') }}</a>
                          @endauth
                      </li>
                  </ul>
              </div>

              <script class="result-template" type="text/x-handlebars-template">
                  <div class="ProfileCard u-cf">
                      <div class="ProfileCard-avatar">
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-airplay m-0">
                              <path d="M5 17H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-1"></path>
                              <polygon points="12 15 17 21 7 21 12 15"></polygon>
                          </svg>
                      </div>
                      <div class="ProfileCard-details">
                          <div class="ProfileCard-realName">{{'name'}}</div>
                      </div>
                  </div>
              </script>
          </div>
      </div>