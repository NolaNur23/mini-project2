<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
@include('layouts.head')


<body class="vertical-layout vertical-menu 2-columns   menu-expanded fixed-navbar" data-open="click"
    data-menu="vertical-menu" data-color="bg-chartbg" data-col="2-columns">

    <!-- fixed-top-->
    {{-- navbar  --}}
    @include('layouts.navbar')
    {{-- navbar end  --}}


    <div class="main-menu menu-fixed menu-light menu-accordion    menu-shadow " data-scroll-to-active="true"
        data-img="/AdminTemplate/theme-assets/images/backgrounds/02.jpg">
        <div class="navbar-header">
            <ul class="nav navbar-nav flex-row">
                <li class="nav-item mr-auto"><a class="navbar-brand" href="index.html"><img class="brand-logo"
                            alt="Chameleon admin logo" src="/AdminTemplate/theme-assets/images/logo/logo.png" />
                        <h3 class="brand-text">Chameleon</h3>
                    </a></li>
                <li class="nav-item d-md-none"><a class="nav-link close-navbar"><i class="ft-x"></i></a></li>
            </ul>
        </div>
        {{-- //sidebar  --}}
        @include('layouts.sidebar')
        {{-- sidrbar tutup  --}}
        {{-- <a class="btn btn-danger btn-block btn-glow btn-upgrade-pro mx-1"
            href="https://themeselection.com/products/chameleon-admin-modern-bootstrap-webapp-dashboard-html-template-ui-kit/"
            target="_blank">Download PRO!</a> --}}
        <div class="navigation-background"></div>
    </div>


    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-wrapper-before"></div>
            <div class="content-header row">
                <div class="content-header-left col-md-4 col-12 mb-2">
                    <h3 class="content-header-title">@yield('page_title')</h3>
                </div>
                <div class="content-header-right col-md-8 col-12">
                    <div class="breadcrumbs-top float-md-right">
                        <div class="breadcrumb-wrapper mr-1">
                            <ol class="breadcrumb">
                                @yield('breadcrumb')
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">

                @yield('content')
            </div>
        </div>
    </div>
    @include('layouts.footer')


    {{-- script  --}}
    @include('layouts.script')
    {{-- //isi  --}}

    <!-- ////////////////////////////////////////////////////////////////////////////-->


    {{-- footer  --}}


</body>


</html>
