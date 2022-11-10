<nav class="sidebar sidebar-offcanvas" id="sidebar">
    <ul class="nav">
        <li class="nav-item {{Request::is('customer/dashboard') ? 'active':''}}">
            <a class="nav-link" href="{{route('customer.dashboard')}}">
                <i class="mdi mdi-home menu-icon"></i>
                <span class="menu-title">Dashboard</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="{{route('customer.view-cart')}}">
                <i class="mdi mdi-cart menu-icon"></i>
                <span class="menu-title">My Cart</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="pages/forms/basic_elements.html">
                <i class="mdi mdi-package menu-icon"></i>
                <span class="menu-title">My Orders</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="pages/charts/chartjs.html">
                <i class="mdi mdi-message-draw menu-icon"></i>
                <span class="menu-title">My Reviews</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="pages/tables/basic-table.html">
                <i class="mdi mdi-coin menu-icon"></i>
                <span class="menu-title">Coupons</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="pages/icons/mdi.html">
                <i class="mdi mdi-message-text menu-icon"></i>
                <span class="menu-title">Notices</span>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" href="pages/forms/basic_elements.html">
                <i class="mdi mdi-account-card-details menu-icon"></i>
                <span class="menu-title">Manage Account</span>
            </a>
        </li>
    </ul>
</nav>
