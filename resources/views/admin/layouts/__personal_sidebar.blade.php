<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                <img src="{!! \Auth::user()->getAvatarUrl() !!}" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
                <p>{!! \Auth::user()->name !!}</p>
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="header">DASHBOARD</li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-user-circle"></i>
                    <span>{!! trans('admin/layout.personal') !!}</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{!! route('admin.personal.job.index') !!}"><i class="fa fa-clone"></i>{!! trans('admin/layout.job') !!}</a></li>
                    <li><a href="{!! route('admin.personal.refund.index') !!}"><i class="fa fa-dollar"></i>{!! trans('admin/layout.refund') !!}</a></li>
                </ul>
            </li>
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>