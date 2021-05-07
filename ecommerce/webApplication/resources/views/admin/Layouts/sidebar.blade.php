<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar">
    <!-- sidebar -->
    <div class="sidebar">
        <!-- sidebar menu -->
        <ul class="sidebar-menu">
            <li class="active">
                <a href="{{url('/admin/dashboard')}}"><i class="fa fa-tachometer"></i><span>Dashboard</span>
                    <span class="pull-right-container">
                    </span>
                </a>
            </li>
            <li class="active">
                <a href="{{url('/admin/banners')}}"><i class="fa fa-image"></i><span>Banners</span>
                    <span class="pull-right-container">
                    </span>
                </a>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-list"></i><span>Categories</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{url('admin/add_category')}}">Add Category</a></li>
                    <li><a href="{{url('admin/view_category')}}">View Categories</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-product-hunt"></i><span>Products</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{url('admin/add_product')}}">Add Product</a></li>
                    <li><a href="{{url('admin/view_products')}}">View Products</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#">
                    <i class="fa fa-gift"></i><span>Coupon</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">
                    <li><a href="{{url('admin/add_coupon')}}">Add Coupon</a></li>
                    <li><a href="{{url('admin/view_coupons')}}">View Coupon</a></li>
                </ul>
            </li>
            <li class="active">
                <a href="{{url('/admin/orders')}}"><i class="pe-7s-cart"></i><span>Orders</span>
                    <span class="pull-right-container">
                    </span>
                </a>
            </li>
            <li class="active">
                <a href="{{url('/admin/customers')}}"><i class="fa fa-users"></i><span>Customer</span>
                    <span class="pull-right-container">
                    </span>
                </a>
            </li>
            <li class="active">
                <a href="{{url('/admin/contact')}}"><i class="fa fa-phone"></i><span>Contact</span>
                    <span class="pull-right-container">
                    </span>
                </a>
            </li>
        </ul>
    </div>
    <!-- /.sidebar -->
</aside>