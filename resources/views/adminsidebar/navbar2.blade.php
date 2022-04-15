<li class="nav-item">
    <a class="nav-link" data-toggle="collapse" href="#tables" aria-expanded="false"
        aria-controls="tables">
        <i class="ti-layout menu-icon"></i>
        <span class="menu-title">Views</span>
        <i class="menu-arrow"></i>
    </a>
    <div class="collapse" id="tables">
        <ul class="nav flex-column sub-menu">
            <li class="nav-item"> <a class="nav-link" href="{{ route('admin.categories') }}">Category
                    </a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ route('admin.products') }}">Product
                    </a></li>
            <li class="nav-item"> <a class="nav-link" href="{{ route('admin.sliders') }}">Slider</a>
            </li>
            <li class="nav-item"> <a class="nav-link"
                    href="{{ route('admin.orders') }}">Order</a></li>
        </ul>
    </div>
</li>