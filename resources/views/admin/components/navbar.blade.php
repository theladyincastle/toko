<nav class="mb-0 d-flex justify-content-lg-between bg-warning p-3 rounded shadow-sm" style="margin-left: 0;">
    <div class="d-flex flex-column">
        <ol class="breadcrumb mb-1">
            <li class="breadcrumb-item active">
                <a href="#" class="text-white text-decoration-none">{{ $name ?? 'Default Name' }}</a>
              
                
            </li>
        </ol>
        <span class="text-white fw-bold">{{ $name ?? 'Default Name' }}</span>
    </div>

    <div class="d-flex align-items-center gap-4">
        <div class="icon-notif position-relative">
            <span class="material-icons text-white" style="font-size: 24px;">
                notifications
            </span>
            <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                3
            </span>
        </div>

        <div class="d-flex gap-3 align-items-center">
            <img src="{{ asset('storage/user/'. Auth::user()->foto) }}" 
                 class="rounded-circle border border-white shadow-sm" 
                 style="width: 50px; height: 50px; object-fit: cover;" 
                 alt="User Photo">
            <div class="d-flex flex-column">
                <p class="m-0 text-white fw-bold" style="font-size: 14px;">{{ Auth::user()->name }}</p>
                <p class="m-0 text-light" style="font-size: 12px;">{{ Auth::user()->email }}</p>
            </div>
        </div>
    </div>
</nav>
