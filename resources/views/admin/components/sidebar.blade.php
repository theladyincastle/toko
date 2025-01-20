<aside class="sidebar navbar navbar-expand-lg bg-warning d-flex flex-column gap-4 align-content-lg-center rounded shadow-sm mb-3" style="margin-top: 0; padding-top: 0; padding-bottom: 0">
    <h5 class="navbar-brand text-white fw-bold">Toko Cihuy</h5>

    <div class="collapse navbar-collapse flex-grow-0" id="navbarNavDropdown">
        <ul class="navbar-nav flex-column gap-3 px-2">
            <!-- Dashboard -->
            <li class="navbar-item rounded {{ Request::path() === 'admin/dashboard' ? 'bg-orange text-warning' : '' }}">
                <a href="dashboard" class="text-white text-decoration-none">
                    <div class="d-flex gap-3 align-items-center">
                        <span class="material-icons">dashboard</span>
                        <p class="m-0 p-0">Dashboard</p>
                    </div>
                </a>
            </li>

            <li class="navbar-item rounded {{ Request::path() === 'admin/product' ? 'bg-orange text-warning' : '' }}">
                <a href="product" class="text-white text-decoration-none">
                    <div class="d-flex gap-3 align-items-center">
                        <span class="material-icons">inventory</span>
                        <p class="m-0 p-0">Product</p>
                    </div>
                </a>
            </li>

            <li class="navbar-item rounded {{ Request::path() === 'admin/transaksi' ? 'bg-orange text-warning' : '' }}">
                <a href="transaksi" class="text-white text-decoration-none">
                    <div class="d-flex gap-3 align-items-center">
                        <span class="material-icons">receipt_long</span>
                        <p class="m-0 p-0">Transaksi</p>
                    </div>
                </a>
            </li>

            <li class="navbar-item rounded {{ Request::path() === 'admin/report' ? 'bg-orange text-warning' : '' }}">
                <a href="report" class="text-white text-decoration-none">
                    <div class="d-flex gap-3 align-items-center">
                        <span class="material-icons">analytics</span>
                        <p class="m-0 p-0">Report</p>
                    </div>
                </a>
            </li>

            <li class="navbar-item rounded {{ Request::path() === 'admin/user_management' ? 'bg-orange text-warning' : '' }}">
                <a href="user_management" class="text-white text-decoration-none">
                    <div class="d-flex gap-3 align-items-center">
                        <span class="material-icons">people_alt</span>
                        <p class="m-0 p-0">User Management</p>
                    </div>
                </a>
            </li>

            <li class="navbar-item">
                <a href="logout" class="text-white text-decoration-none">
                    <div class="d-flex gap-3 align-items-center">
                        <span class="material-icons">logout</span>
                        <p class="m-0 p-0">Logout</p>
                    </div>
                </a>
            </li>
        </ul>
    </div>


    <style>
        .sidebar .navbar-item:hover {
            background-color:#b4790b!important; 
        }
        .sidebar .navbar-item a {
            color: #FFFFFF; 
        }
        .sidebar .navbar-item:hover a {
            color: #FFFFFF !important; 
        }
        .bg-orange {
        background-color: #b4790b !important; 
        color: #ffffff !important; 
    }
    </style>
    
</aside>
