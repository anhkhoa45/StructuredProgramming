<aside class="main-sidebar">
    <section class="sidebar">
        <ul class="sidebar-menu" data-widget="tree">
            <li class="header">DASHBOARD</li>
            <li class="active treeview">
                <a href="{!! route('admin.setting.user.index') !!}">
                    <i class="fa fa-user"></i>
                    <span>{!! trans('admin/base.lbl_user') !!}</span>
                </a>
                <ul class="active treeview-menu">
                    <li>
                        <a href="{!! route('admin.setting.user.index') !!}">
                            <i class="fa fa-align-justify"></i>
                            {!! trans('admin/base.list') !!}
                        </a>
                    </li>
                    <li>
                        <a href="{!! route('admin.setting.user.create') !!}">
                            <i class="fa fa-plus-circle"></i>
                            {!! trans('admin/base.create') !!}
                        </a>
                    </li>
                </ul>
            </li>
            <li class="active treeview">
                <a href="{!! route('admin.setting.product.index') !!}">
                    <i class="fa fa-product-hunt"></i>
                    <span>{!! trans('admin/base.lbl_product') !!}</span>
                </a>
                <ul class="active treeview-menu">
                    <li>
                        <a href="{!! route('admin.setting.product.index') !!}">
                            <i class="fa fa-align-justify"></i>
                            {!! trans('admin/base.list') !!}
                        </a>
                    </li>
                    <li>
                        <a href="{!! route('admin.setting.product.create') !!}">
                            <i class="fa fa-plus-circle"></i>
                            {!! trans('admin/base.create') !!}
                        </a>
                    </li>
                </ul>
            </li>
            <li class="active treeview">
                <a href="{!! route('admin.setting.invoice.index') !!}">
                    <i class="fa fa-product-hunt"></i>
                    <span>{!! trans('admin/base.lbl_invoice') !!}</span>
                </a>
                <ul class="active treeview-menu">
                    <li>
                        <a href="{!! route('admin.setting.invoice.index') !!}">
                            <i class="fa fa-align-justify"></i>
                            {!! trans('admin/base.list') !!}
                        </a>
                    </li>

                </ul>
            </li>

        </ul>
    </section>
</aside>
