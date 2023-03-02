<div class="sidebar">
    <!-- Sidebar user panel (optional) -->
    <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <div class="image">
            <img src="{{ asset('assets') }}/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div>
        <div class="info">
            <a href="#" class="d-block">{{ Session::get('name') }}</a>
        </div>
    </div>

    <!-- Sidebar Menu -->
    <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
            <!-- Add icons to the links using the .nav-icon class
   with font-awesome or any other icon font library -->
            <li class="nav-item">
                <a href="{{ route('user.index') }}" class="nav-link {{ Route::is('user.index') ? 'active' : '' }}">
                    <i class="nav-icon fas fa-users"></i>
                    <p>
                        User
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <form action="{{ route('product.stock') }}" method="POST" id="product">
                    @csrf
                    <input type="hidden" name="bank_id" value="2">
                    <a href="#" class="nav-link" onclick="document.getElementById('product').submit();"> <i
                            class="nav-icon fas fa-check-square"></i> Soal No 4 </a>
                </form>

            </li>
            <li class="nav-item">
                <a href="{{ route('api.user') }}" class="nav-link">
                    <i class="nav-icon fas fa-check-square"></i>
                    <p>
                        Soal No 5
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('soalno6') }}" class="nav-link">
                    <i class="nav-icon fas fa-check-square"></i>
                    <p>
                        Soal No 6
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('soalno7') }}" class="nav-link">
                    <i class="nav-icon fas fa-check-square"></i>
                    <p>
                        Soal No 7
                    </p>
                </a>
            </li>
            <li class="nav-item">
                <a href="{{ route('actionlogout') }}" class="nav-link">
                    <i class="nav-icon fas fa-chevron-left"></i>
                    <p>
                        Logout
                    </p>
                </a>
            </li>
        </ul>
    </nav>
    <!-- /.sidebar-menu -->
</div>
