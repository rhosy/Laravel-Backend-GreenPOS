<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="index.html">POS</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="index.html">POS</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="nav-item dropdown {{ Route::is('home') ? 'active' : '' }}">
                <a href="{{ route('home') }}"
                    class="nav-link"><i class="fas fa-home"></i><span>Dashboard</span></a>
            </li>
            <li class="nav-item dropdown {{ $type_menu === 'product' ? 'active' : '' }}">
                <a href="#"
                    class="nav-link has-dropdown"><i class="fas fa-shopping-bag"></i><span>Product</span></a>
                <ul class="dropdown-menu">
                    <li class='{{ Route::is('category.*') ? 'active' : '' }}'>
                        <a class="nav-link"
                            href="{{ route('category.index') }}">Category</a>
                    </li>
                    <li class="{{ Route::is('product.*') ? 'active' : '' }}">
                        <a class="nav-link"
                            href="{{ route('product.index') }}">Items</a>
                    </li>
                </ul>
            </li>
            <li class="menu-header">Merchants</li>
            <li class="nav-item dropdown {{ Route::is('merchant.*') ? 'active' : '' }}">
                <a href="{{ route('merchant.index') }}"
                    class="nav-link"><i class="fas fa-building"></i><span>Merchant</span></a>
            </li>
            <li class="nav-item dropdown {{ Route::is('outlet.*') ? 'active' : '' }}">
                <a href="{{ route('outlet.index') }}"
                    class="nav-link"><i class="fas fa-store"></i><span>Outlets</span></a>
            </li>
            <li class="nav-item dropdown {{ Route::is('user.*') ? 'active' : '' }}">
                <a href="{{ route('user.index') }}"
                    class="nav-link"><i class="fas fa-user"></i><span>Users</span></a>
            </li>

            
    </aside>
</div>
