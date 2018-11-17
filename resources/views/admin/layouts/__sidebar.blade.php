<aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <!-- Sidebar user panel -->
        <div class="user-panel">
            <div class="pull-left image">
                {{-- <img src="{!! \Auth::user()->getAvatarUrl() !!}" class="img-circle" alt="User Image"> --}}
            </div>
            <div class="pull-left info">
                {{-- <p>{!! \Auth::user()->name !!}</p> --}}
                <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
            </div>
        </div>
        <!-- sidebar menu: : style can be found in sidebar.less -->
        <ul class="sidebar-menu">
            <li class="header">DASHBOARD</li>
            {{-- <li class="treeview">
                <a href="#">
                    <i class="fa fa-cubes"></i>
                    <span>{!! trans('admin/layout.logistic') !!}</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="treeview">
                        <a href="{!! route('admin.bill.master.index') !!}">
                            <i class="fa fa-book"></i>
                            <span>{!! trans('admin/layout.master_bill') !!}</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="{!! route('admin.bill.master.index') !!}"><i class="fa fa-align-justify"></i>{!! trans('admin/bill/master/common.general') !!}</a></li>
                            <li><a href="{!! route('admin.bill.master.air.index') !!}"><i class="fa fa-plane"></i>{!! trans('admin/bill/master/air.air_master_bill') !!}</a></li>
                            <li><a href="{!! route('admin.bill.master.sea.index') !!}"><i class="fa fa-anchor"></i>{!! trans('admin/bill/master/sea.sea_master_bill') !!}</a></li>
                            <li><a href="{!! route('admin.bill.master.truck.index') !!}"><i class="fa fa-truck"></i>{!! trans('admin/bill/master/truck.truck_master_bill') !!}</a></li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="{!! route('admin.bill.house.index') !!}">
                            <i class="fa fa-book"></i>
                            <span>{!! trans('admin/layout.house_bill') !!}</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="{!! route('admin.bill.house.index') !!}"><i class="fa fa-align-justify"></i>{!! trans('admin/bill/house/common.general') !!}</a></li>
                            <li><a href="{!! route('admin.bill.house.air.index') !!}"><i class="fa fa-plane"></i>{!! trans('admin/bill/house/air.air_house_bill') !!}</a></li>
                            <li><a href="{!! route('admin.bill.house.sea.index') !!}"><i class="fa fa-anchor"></i>{!! trans('admin/bill/house/sea.sea_house_bill') !!}</a></li>
                            <li><a href="{!! route('admin.bill.house.truck.index') !!}"><i class="fa fa-truck"></i>{!! trans('admin/bill/house/truck.truck_house_bill') !!}</a></li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="{!! route('admin.invoice.index') !!}">
                            <i class="fa fa-shopping-cart"></i>
                            <span>{!! trans('admin/layout.invoice') !!}</span>
                        </a>
                    </li>
                    <li class="treeview">
                        <a href="{!! route('admin.customer.index') !!}">
                            <i class="fa fa-address-book"></i>
                            <span>{!! trans('admin/layout.customer') !!}</span>
                        </a>
                    </li>
                    <li class="treeview"><a href="{!! route('admin.fee.index') !!}"><i class="fa fa-dollar"></i><span>{!! trans('admin/layout.fee') !!}</span></a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="{!! route('admin.job.index') !!}">
                    <i class="fa fa-tasks"></i>
                    <span>{!! trans('admin/layout.jobs') !!}</span>
                </a>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-database"></i>
                    <span>{!! trans('admin/layout.internal') !!}</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{!! route('admin.internal.department.index') !!}"><i class="fa fa-sitemap"></i>{!! trans('admin/layout.department') !!}</a></li>
                    <li><a href="{!! route('admin.internal.employee.index') !!}"><i class="fa fa-user"></i>{!! trans('admin/layout.employee') !!}</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-cog"></i>
                    <span>{!! trans('admin/layout.setting') !!}</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <a href="{!! route('admin.setting.user.index') !!}">
                            <i class="fa fa-user"></i>
                            <span>{!! trans('admin/layout.account') !!}</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="{!! route('admin.setting.user.roleAdmin') !!}"><i class="fa fa-circle-o"></i>{!! trans('admin/user.role_admin') !!}</a></li>
                            <li><a href="{!! route('admin.setting.user.roleUser') !!}"><i class="fa fa-circle-o"></i>{!! trans('admin/user.role_user') !!}</a></li>
                        </ul>
                    </li>
                </ul>
            </li> --}}
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>