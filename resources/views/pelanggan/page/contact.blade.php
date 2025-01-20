@extends('pelanggan.layout.index')

@section('content')
    <div class="row mt-4 align-items-center">
        <div class="col-md-6">
            <div class="content-text">
                Lorem ipsum dolor sit amet consectetur adipisicing elit. Corrupti commodi delectus neque, quasi soluta non
                illum, similique quisquam nostrum iusto magni aspernatur esse. Ipsa cupiditate vitae est iusto labore culpa
                magnam fugit minima. Voluptate ipsam ad, neque voluptas ducimus perspiciatis praesentium natus iure delectus
                eaque officia dolores iste asperiores assumenda aliquam dignissimos! Ex odit accusantium ad quaerat, omnis
                atque
                minus velit dicta sapiente quam vel, temporibus eligendi! Nobis, molestiae hic praesentium reiciendis
                exercitationem in debitis quisquam. Totam dolores veritatis reprehenderit et voluptates iure, alias quam
                consequatur in cumque saepe eius, aperiam repellat temporibus aut? Nobis quam sunt fuga perspiciatis nemo
                reprehenderit similique tempora dolore, beatae fugiat, obcaecati expedita possimus. Quae fugit tempore,
                obcaecati excepturi unde laudantium eveniet ratione natus. Distinctio.
            </div>
        </div>
        <div class="col-md-6">
            <img src="{{ asset('assets/img/company.png') }}" style="width:480px; margin-left:220px;">
        </div>
    </div>

    <div class="d-flex justify-content-lg-between mt-5">
        <div class="d-flex align-items-center gap-4">
            <i class="fa fa-users fa-2x text-primary"></i>
            <p class="m-0 fs-5">+ 300 Pelanggan</p>
        </div>
        <div class="d-flex align-items-center gap-4">
            <i class="fas fa-home fa-2x text-warning"></i>
            <p class="m-0 fs-5"> +500 Seller</p>
        </div>
        <div class="d-flex align-items-center gap-4">
            <i class="fas fa-shirt fa-2x text-success"></i>
            <p class="m-0 fs-5">+ 300 Product</p>
        </div>
    </div>

    <h4 class="text-center mt-md-5 mb-md-2">Contact Us</h4>
    <hr class="mb-5">
    <div class="row mb-md-5">
        <div class="col-md-5">
            <div class="bg-warning" style="width: 100%; height:50vh; border-radius:10px; display: flex; justify-content: center; align-items: center;">
                <iframe 
                    width="100%" 
                    height="100%" 
                    frameborder="0" 
                    style="border-radius:10px;" 
                    src="https://www.google.com/maps/embed/v1/place?key=YOUR_API_KEY&q=1,E02-E07+10350+Kota+Jakarta+Pusat+DKI+Jakarta">
                </iframe>
            </div>
        </div>
        
        <div class="col-md-7">
            <div class="card border-warning">
                <div class="card-header text-center bg-warning">
                    <h4><i class="fas fa-comment-dots"></i> Kritik dan saran</h4> <!-- Added message icon -->
                </div>
                <div class="card-body">
                    <p class="p-0 mb-5 text-lg-center">Masukan kritik dan saran anda kepada aplikasi kami ini agar kami dapat memberikan
                        apa yang menjadi kebutuhan anda dan kami dapat berkembang lebih baik lagi.
                    </p>
                    <div class="mb-3 row">
                        <label for="email" class="col-sm-2 col-form-label">Email</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="email" placeholder="Masukan email Anda">
                        </div>
                    </div>
                    <div class="mb-3 row">
                        <label for="pesan" class="col-sm-2 col-form-label">Pesan</label>
                        <div class="col-sm-10">
                            <input type="text" class="form-control" id="pesan" placeholder="Masukan Pesan Anda">
                        </div>
                    </div>
                    <button class="btn btn-warning mt-4 w-100"> Kirim pesan anda</button>
                </div>
            </div>
        </div>
        
    </div>
@endsection
@push('scripts')
    <script>
        const lat = -6.2088; // Latitude
        const lng = 106.8456; // Longitude

        const map = L.map('map').setView([lat, lng], 13);
        L.tileLayer('https://{s}.tile.openstreetmap.org/{z}/{x}/{y}.png', {
            attribution: '&copy; <a href="https://www.openstreetmap.org/copyright">OpenStreetMap</a> contributors'
        }).addTo(map);

        L.marker([lat, lng]).addTo(map)
            .bindPopup('<b>Lokasi Anda</b><br>Jakarta')
            .openPopup();
    </script>
@endpush