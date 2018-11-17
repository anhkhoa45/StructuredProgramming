<header class="main-header">
    <!-- Logo -->
    <a href="{!! route('backend') !!}" class="logo">
        <!-- mini logo for sidebar mini 50x50 pixels -->
        <span class="logo-mini"><b>N</b><b>HN</b></span>
        <!-- logo for regular state and mobile devices -->
        <span class="logo-lg"><b>NHN</b></span>
    </a>
    <!-- Header Navbar: style can be found in header.less -->
    <nav class="navbar navbar-static-top">
        <!-- Sidebar toggle button-->
        <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
        </a>

        <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
                
                <!-- User Account: style can be found in dropdown.less -->
                <li class="dropdown user user-menu">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                        {{-- <img src="{!! \Auth::user()->getAvatarUrl() !!}" class="user-image" alt="User Image"> --}}
                        {{-- <span class="hidden-xs">{!! \Auth::user()->name !!}</span> --}}
                    </a>
                    <ul class="dropdown-menu">
                        <!-- User image -->
                        <li class="user-header">
                            {{-- <img src="{!! \Auth::user()->getAvatarUrl() !!}" class="img-circle" alt="User Image"> --}}

                            <p>
                                {{-- {!! Auth::user()->name !!} --}}
                            </p>
                        </li>
                        <!-- Menu Footer-->
                        <li class="user-footer">
                            <div class="pull-left">
                                {{-- <a href="{!! route('backend.setting.user.show', \Auth::user()->id) !!}" class="btn btn-default btn-flat">{!! trans('backend/auth.profile') !!}</a> --}}
                            </div>
                            <div class="pull-right">
                                {{-- <a href="{!! route('backend.auth.logout') !!}" class="btn btn-default btn-flat">{!! trans('backend/auth.log_out') !!}</a> --}}
                            </div>
                        </li>
                    </ul>
                </li>
                <!-- Control Sidebar Toggle Button -->
            </ul>
        </div>
    </nav>
</header>