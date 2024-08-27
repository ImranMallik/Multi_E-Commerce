<div class="main-sidebar sidebar-style-2">
    <aside id="sidebar-wrapper">
        <div class="sidebar-brand">
            <a href="{{ route('admin.dashboard') }}">Imran</a>
        </div>
        <div class="sidebar-brand sidebar-brand-sm">
            <a href="{{ route('admin.dashboard') }}">Im</a>
        </div>
        <ul class="sidebar-menu">
            <li class="menu-header">Dashboard</li>
            <li class="dropdown active">
                <a href="{{ route('admin.dashboard') }}" class="nav-link"><i
                        class="fas fa-fire"></i><span>Dashboard</span></a>

            </li>
            <li class="menu-header">Starter</li>
            {{-- Category --}}
            <li
                class="dropdown {{ setActive(['admin.category.*', 'admin.sub-category.*', 'admin.child-category.*']) }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
                    <i class="fas fa-th-large"></i>
                    <span>Manage Categories</span>
                </a>
                <ul class="dropdown-menu">
                    <li class="{{ setActive(['admin.category.*']) }}">
                        <a class="nav-link" href="{{ route('admin.category.index') }}">
                            <i class="fas fa-list-alt"></i>
                            Category
                        </a>
                    </li>
                    <li class="{{ setActive(['admin.sub-category.*']) }}">
                        <a class="nav-link" href="{{ route('admin.sub-category.index') }}">
                            <i class="fas fa-th-list"></i>
                            Sub Category
                        </a>
                    </li>
                    <li class="{{ setActive(['admin.child-category.*']) }}">
                        <a class="nav-link" href="{{ route('admin.child-category.index') }}">
                            <i class="fas fa-sitemap"></i>
                            Child Category
                        </a>
                    </li>
                </ul>
            </li>
            {{-- End Category --}}

            {{-- Manage Product --}}
            <li
                class="dropdown {{ setActive([
                    'admin.products.*',
                    'admin.products-variant.*',
                    'admin.products-image-gallery.*',
                    'admin.products-variants-items.*',
                    'admin.brand.*',
                    'admin.products.index',
                    'admin.seller-products',
                    'admin.seller-pending-products',
                ]) }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
                    <i class="fas fa-boxes"></i>
                    <span>Manage Products</span>
                </a>
                <ul class="dropdown-menu">
                    <li class="{{ setActive(['admin.brand.*']) }}">
                        <a class="nav-link" href="{{ route('admin.brand.index') }}">
                            <i class="fas fa-tags"></i>
                            Brands
                        </a>
                    </li>
                    <li class="{{ setActive(['admin.products.index']) }}">
                        <a class="nav-link" href="{{ route('admin.products.index') }}">
                            <i class="fas fa-box"></i>
                            Products
                        </a>
                    </li>
                    <li class="{{ setActive(['admin.seller-products']) }}">
                        <a class="nav-link" href="{{ route('admin.seller-products') }}">
                            <i class="fas fa-shopping-bag"></i>
                            Seller Products
                        </a>
                    </li>
                    <li class="{{ setActive(['admin.seller-pending-products']) }}">
                        <a class="nav-link" href="{{ route('admin.seller-pending-products') }}">
                            <i class="fas fa-hourglass-half"></i>
                            Pending Products
                        </a>
                    </li>



                </ul>
            </li>
            {{-- End --}}

            <li class="dropdown {{ setActive(['admin.slider.*']) }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
                    <i class="fas fa-cogs"></i>
                    <span>Manage Website</span>
                </a>
                <ul class="dropdown-menu">
                    <li class="{{ setActive(['admin.slider.*']) }}">
                        <a class="nav-link" href="{{ route('admin.slider.index') }}">
                            <i class="fas fa-sliders-h"></i>
                            Slider
                        </a>
                    </li>
                </ul>
            </li>


            <li class="dropdown {{ setActive(['admin.vendor-profile.*', 'admin.flash-sale.*']) }}">
                <a href="#" class="nav-link has-dropdown" data-toggle="dropdown">
                    <i class="fas fa-shopping-cart"></i>
                    <span>E-commerce</span>
                </a>
                <ul class="dropdown-menu">
                    <li class="{{ setActive(['admin.vendor-profile.*']) }}">
                        <a class="nav-link" href="{{ route('admin.vendor-profile.index') }}">
                            <i class="fas fa-user-tie"></i>
                            Vendor Profile
                        </a>
                    </li>
                </ul>
                <ul class="dropdown-menu">
                    <li class="{{ setActive(['admin.flash-sale.*']) }}">
                        <a class="nav-link" href="{{ route('admin.flash-sale.index') }}">
                            <i class="fas fa-bolt"></i>
                            Flash Sale
                        </a>
                    </li>
                </ul>

            </li>

        </ul>
    </aside>
</div>
