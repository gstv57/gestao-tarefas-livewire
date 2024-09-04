<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta http-equiv="X-UA-Compatible" content="IE=edge" />
  <title>{{ config('app.name', 'Laravel') }}</title>
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport" />
    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
  <!-- Fonts and icons -->
  <script src="/assets/js/plugin/webfont/webfont.min.js"></script>
  <script>
    WebFont.load({
      google: { families: ["Public Sans:300,400,500,600,700"] },
      custom: {
        families: [
          "Font Awesome 5 Solid",
          "Font Awesome 5 Regular",
          "Font Awesome 5 Brands",
          "simple-line-icons",
        ],
        urls: ["/assets/css/fonts.min.css"],
      },
      active: function () {
        sessionStorage.fonts = true;
      },
    });
  </script>

  <!-- CSS Files -->
  <link rel="stylesheet" href="/assets/css/bootstrap.min.css" />
  <link rel="stylesheet" href="/assets/css/plugins.min.css" />
  <link rel="stylesheet" href="/assets/css/kaiadmin.min.css" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <link rel="stylesheet" href="/assets/css/modal.css"/>
  @vite(['resources/js/app.js'])
  @livewireStyles
</head>

<body>

  <div class="wrapper">
    <!-- Sidebar -->
    <div class="sidebar" data-background-color="dark">
      <div class="sidebar-logo">
        <!-- Logo Header -->
        <div class="logo-header" data-background-color="dark">
          <a href="index.html" class="logo">
            <img src="/assets/img/kaiadmin/logo_light.svg" alt="navbar brand" class="navbar-brand" height="20" />
          </a>
          <div class="nav-toggle">
            <button class="btn btn-toggle toggle-sidebar">
              <i class="gg-menu-right"></i>
            </button>
            <button class="btn btn-toggle sidenav-toggler">
              <i class="gg-menu-left"></i>
            </button>
          </div>
          <button class="topbar-toggler more">
            <i class="gg-more-vertical-alt"></i>
          </button>
        </div>



        <!-- End Logo Header -->
      </div>
        <div class="sidebar-wrapper scrollbar scrollbar-inner">
            <div class="sidebar-content">
                <ul class="nav nav-secondary">
                    @can('user-navbar')
                        <li class="nav-item submenu {{ Request::routeIs('usuarios.*') ? 'active' : '' }}">
                            <a data-bs-toggle="collapse" href="#userMenu" aria-expanded="{{ Request::routeIs('usuarios.*') ? 'true' : 'false' }}">
                                <i class="fas fa-user"></i>
                                <p>Usuários</p>
                                <span class="caret"></span>
                            </a>
                            <div class="collapse {{ Request::routeIs('usuarios.*') ? 'show' : '' }}" id="userMenu">
                                <ul class="nav nav-collapse">
                                    <li>
                                        <a href="{{ route('usuarios.index') }}" wire:navigate class="{{ Request::routeIs('usuarios.index') ? 'active' : '' }}">
                                            <span class="sub-item">Ver Usuários</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('usuarios.create') }}" wire:navigate class="{{ Request::routeIs('usuarios.create') ? 'active' : '' }}">
                                            <span class="sub-item">Criar Usuário</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    @endcan

                    @can('projetos-navbar')
                        <li class="nav-item submenu {{ Request::routeIs('projeto.*') ? 'active' : '' }}">
                            <a data-bs-toggle="collapse" href="#projectMenu" aria-expanded="{{ Request::routeIs('projeto.*') ? 'true' : 'false' }}">
                                <i class="fas fa-book"></i>
                                <p>Projetos</p>
                                <span class="caret"></span>
                            </a>
                            <div class="collapse {{ Request::routeIs('projeto.*') ? 'show' : '' }}" id="projectMenu">
                                <ul class="nav nav-collapse">
                                    @can('view-projeto')
                                        <li>
                                            <a href="{{ route('projeto.index') }}" wire:navigate class="{{ Request::routeIs('projeto.index') ? 'active' : '' }}">
                                                <span class="sub-item">Ver Projetos</span>
                                            </a>
                                        </li>
                                    @endcan
                                    @can('create-projeto')
                                        <li>
                                            <a href="{{ route('projetos.create') }}" wire:navigate class="{{ Request::routeIs('projetos.create') ? 'active' : '' }}">
                                                <span class="sub-item">Criar Projeto</span>
                                            </a>
                                        </li>
                                    @endcan
                                </ul>
                            </div>
                        </li>
                    @endcan

                    @can('roles-navbar')
                        <li class="nav-item submenu {{ Request::routeIs('roles.*') ? 'active' : '' }}">
                            <a data-bs-toggle="collapse" href="#roleMenu" aria-expanded="{{ Request::routeIs('roles.*') ? 'true' : 'false' }}">
                                <i class="fas fa-user-shield"></i>
                                <p>Roles</p>
                                <span class="caret"></span>
                            </a>
                            <div class="collapse {{ Request::routeIs('roles.*') ? 'show' : '' }}" id="roleMenu">
                                <ul class="nav nav-collapse">
                                    <li>
                                        <a href="{{ route('roles.index') }}" wire:navigate class="{{ Request::routeIs('roles.index') ? 'active' : '' }}">
                                            <span class="sub-item">Ver Roles</span>
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </li>
                    @endcan
                </ul>
            </div>
        </div>

    </div>
    <!-- End Sidebar -->

    <div class="main-panel">
      <div class="main-header">
        <div class="main-header-logo">
          <!-- Logo Header -->
          <div class="logo-header" data-background-color="dark">
            <a href="index.html" class="logo">
              <img src="/assets/img/kaiadmin/logo_light.svg" alt="navbar brand" class="navbar-brand" height="20" />
            </a>
            <div class="nav-toggle">
              <button class="btn btn-toggle toggle-sidebar">
                <i class="gg-menu-right"></i>
              </button>
              <button class="btn btn-toggle sidenav-toggler">
                <i class="gg-menu-left"></i>
              </button>
            </div>
            <button class="topbar-toggler more">
              <i class="gg-more-vertical-alt"></i>
            </button>
          </div>
          <!-- End Logo Header -->
        </div>
        <!-- Navbar Header -->
        <livewire:header-layout></livewire:header-layout>
        <!-- End Navbar -->
      </div>

      <div class="container">
        <div class="page-inner">
{{--          <div class="page-header">--}}
{{--            <h4 class="page-title">Dashboard</h4>--}}
{{--            <ul class="breadcrumbs">--}}
{{--              <li class="nav-home">--}}
{{--                <a href="#">--}}
{{--                  <i class="icon-home"></i>--}}
{{--                </a>--}}
{{--              </li>--}}
{{--            </ul>--}}
{{--          </div>--}}
          <div class="page-category">
            {{ $slot }}
          </div>
        </div>
      </div>
      <footer class="footer">
        <div class="container-fluid d-flex justify-content-between">
          <nav class="pull-left">
            <ul class="nav">
              <li class="nav-item">
                <a class="nav-link" href="http://www.themekita.com">
                  ThemeKita
                </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#"> Help </a>
              </li>
              <li class="nav-item">
                <a class="nav-link" href="#"> Licenses </a>
              </li>
            </ul>
          </nav>
          <div class="copyright">
            2024, made with <i class="fa fa-heart heart text-danger"></i> by
            <a href="http://www.themekita.com">ThemeKita</a>
          </div>
          <div>
            Distributed by
            <a target="_blank" href="https://themewagon.com/">ThemeWagon</a>.
          </div>
        </div>
      </footer>
    </div>

  </div>

  @livewireScripts
  <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <x-livewire-alert::scripts />
  <!--   Core JS Files   -->
  <script src="/assets/js/core/jquery-3.7.1.min.js"></script>
  <script src="/assets/js/core/popper.min.js"></script>
  <script src="/assets/js/core/bootstrap.min.js"></script>

  <!-- jQuery Scrollbar -->
  <script src="/assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>
  <!-- Kaiadmin JS -->
  <script src="/assets/js/kaiadmin.min.js"></script>
</body>

</html>
