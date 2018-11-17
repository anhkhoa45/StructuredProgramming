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
                    <span>{!! trans('backend/layout.logistic') !!}</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li class="treeview">
                        <a href="{!! route('backend.bill.master.index') !!}">
                            <i class="fa fa-book"></i>
                            <span>{!! trans('backend/layout.master_bill') !!}</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="{!! route('backend.bill.master.index') !!}"><i class="fa fa-align-justify"></i>{!! trans('backend/bill/master/common.general') !!}</a></li>
                            <li><a href="{!! route('backend.bill.master.air.index') !!}"><i class="fa fa-plane"></i>{!! trans('backend/bill/master/air.air_master_bill') !!}</a></li>
                            <li><a href="{!! route('backend.bill.master.sea.index') !!}"><i class="fa fa-anchor"></i>{!! trans('backend/bill/master/sea.sea_master_bill') !!}</a></li>
                            <li><a href="{!! route('backend.bill.master.truck.index') !!}"><i class="fa fa-truck"></i>{!! trans('backend/bill/master/truck.truck_master_bill') !!}</a></li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="{!! route('backend.bill.house.index') !!}">
                            <i class="fa fa-book"></i>
                            <span>{!! trans('backend/layout.house_bill') !!}</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="{!! route('backend.bill.house.index') !!}"><i class="fa fa-align-justify"></i>{!! trans('backend/bill/house/common.general') !!}</a></li>
                            <li><a href="{!! route('backend.bill.house.air.index') !!}"><i class="fa fa-plane"></i>{!! trans('backend/bill/house/air.air_house_bill') !!}</a></li>
                            <li><a href="{!! route('backend.bill.house.sea.index') !!}"><i class="fa fa-anchor"></i>{!! trans('backend/bill/house/sea.sea_house_bill') !!}</a></li>
                            <li><a href="{!! route('backend.bill.house.truck.index') !!}"><i class="fa fa-truck"></i>{!! trans('backend/bill/house/truck.truck_house_bill') !!}</a></li>
                        </ul>
                    </li>
                    <li class="treeview">
                        <a href="{!! route('backend.invoice.index') !!}">
                            <i class="fa fa-shopping-cart"></i>
                            <span>{!! trans('backend/layout.invoice') !!}</span>
                        </a>
                    </li>
                    <li class="treeview">
                        <a href="{!! route('backend.customer.index') !!}">
                            <i class="fa fa-address-book"></i>
                            <span>{!! trans('backend/layout.customer') !!}</span>
                        </a>
                    </li>
                    <li class="treeview"><a href="{!! route('backend.fee.index') !!}"><i class="fa fa-dollar"></i><span>{!! trans('backend/layout.fee') !!}</span></a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="{!! route('backend.job.index') !!}">
                    <i class="fa fa-tasks"></i>
                    <span>{!! trans('backend/layout.jobs') !!}</span>
                </a>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-database"></i>
                    <span>{!! trans('backend/layout.internal') !!}</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{!! route('backend.internal.department.index') !!}"><i class="fa fa-sitemap"></i>{!! trans('backend/layout.department') !!}</a></li>
                    <li><a href="{!! route('backend.internal.employee.index') !!}"><i class="fa fa-user"></i>{!! trans('backend/layout.employee') !!}</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-cog"></i>
                    <span>{!! trans('backend/layout.setting') !!}</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li>
                        <a href="{!! route('backend.setting.user.index') !!}">
                            <i class="fa fa-user"></i>
                            <span>{!! trans('backend/layout.account') !!}</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="{!! route('backend.setting.user.roleAdmin') !!}"><i class="fa fa-circle-o"></i>{!! trans('backend/user.role_admin') !!}</a></li>
                            <li><a href="{!! route('backend.setting.user.roleUser') !!}"><i class="fa fa-circle-o"></i>{!! trans('backend/user.role_user') !!}</a></li>
                        </ul>
                    </li>
                </ul>
            </li> --}}
        </ul>
    </section>
    <!-- /.sidebar -->
</aside>