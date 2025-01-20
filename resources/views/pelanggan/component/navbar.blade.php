<nav class="navbar navbar-expand-lg navbar-dark" style="background-color: #ffc107;">
    <div class="container">
        <a class="navbar-brand" href="#">Toko Cihuy</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a class="nav-link {{Request::path() == '/' ? 'active' : ''}}" aria-current="page" href="/">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{Request::path() == 'shop' ? 'active' : ''}}" href="/shop">Shop</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link {{Request::path() == 'contact' ? 'active' : ''}}" href="/contact">Contact Us</a>
                </li>
            </ul>
            <div class="d-flex align-items-center gap-3">
                @auth
                <div class="d-flex gap-2 align-items-center">
                    <img src="{{ asset('storage/user/' . Auth::user()->foto) }}" class="rounded-circle"
                        style="width: 50px;" alt="Profile Picture">
                    <div class="text-white">
                        <p class="m-0" style="font-weight: bold;">{{ Auth::user()->name }}</p>
                        <p class="m-0" style="font-size: 12px;">{{ Auth::user()->email }}</p>
                    </div>
                </div>
                <a href="logout_pelanggan" class="btn btn-danger">Logout</a>
                @else
                <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#exampleModal">
                    Login | Register
                </button>
                @endauth

                <div class="notif">
                    <a href="/transaksi" class="nav-link position-relative">
                        <i class="fa fa-bag-shopping fs-5"></i>
                        @if ($count)
                        <span class="position-absolute top-0 start-100 translate-middle badge rounded-pill bg-danger">
                            {{ $count }}
                        </span>
                        @endif
                    </a>
                </div>

                <div class="notif">
                    <a href="/checkOut" class="nav-link position-relative">
                        <i class="fa fa-cash-register fs-5"></i>
                    </a>
                </div>

                <!-- PayPal Button -->
                <div id="paypal-button-container"></div>
            </div>
        </div>
    </div>
</nav>

<!-- Tambahkan PayPal SDK -->
<script src="https://www.paypal.com/sdk/js?client-id=YOUR_CLIENT_ID&currency=USD"></script>
<script>
    paypal.Buttons({
        createOrder: function (data, actions) {
            return actions.order.create({
                purchase_units: [{
                    amount: {
                        value: '10.00' // Sesuaikan jumlah pembayaran
                    }
                }]
            });
        },
        onApprove: function (data, actions) {
            return actions.order.capture().then(function (details) {
                alert('Pembayaran berhasil dilakukan oleh ' + details.payer.name.given_name);
                // Tambahkan logika untuk memproses pembayaran di server Anda
            });
        }
    }).render('#paypal-button-container');
</script>
