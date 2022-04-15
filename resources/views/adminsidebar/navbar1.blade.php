<li class="nav-item">
    <a class="nav-link" data-toggle="collapse" href="#form-elements" aria-expanded="false"
        aria-controls="form-elements">
        <i class="ti-clipboard menu-icon"></i>
        <span class="menu-title">Creation</span>
        <i class="menu-arrow"></i>
    </a>
    <div class="collapse" id="form-elements">
        <ul class="nav flex-column sub-menu">
            <li class="nav-item"><a class="nav-link" href="{{ route('admin.add.category') }}">Add
                    Category</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('admin.add.product') }}">Add
                    Product</a></li>
            <li class="nav-item"><a class="nav-link" href="{{ route('admin.add.slider') }}">Add Slider</a>
            </li>
            <li class="nav-item"><a class="nav-link" href="{{ route('admin.add.slider') }}">Add Order</a>
            </li>
        </ul>
    </div>
</li>
