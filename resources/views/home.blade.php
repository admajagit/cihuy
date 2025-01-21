<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Mutu Rent Car</title>
  <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
</head>
<body>
  <!-- Navbar -->
  <nav class="navbar">
    <div class="nav-left">
      <img src="{{ asset('assets/logo.png') }}" alt="Logo" class="logo">
      <div class="title">MUTU RENT CAR</div>
    </div>
    <div class="nav-center">
      <a href="#beranda">Beranda</a>
      <a href="#daftar-mobil">Daftar Mobil</a>
      <a href="#kontak">Kontak</a>
    </div>
    <div class="nav-right">
      <button class="btn masuk">Masuk</button>
      <button class="btn daftar">Daftar</button>
    </div>
  </nav>

  <!-- Banner Section -->
  <main id="beranda" class="banner">
    <div class="banner-overlay">
      <div class="banner-text">
        <h1>
          Percayakan Perjalanan Anda<br>
          dengan Mutu Rent Car
        </h1>
      </div>
    </div>
    <img src="{{ asset('assets/banner1.png') }}" alt="Banner" class="banner-image">
  </main>

  <!-- section 2 -->
  <div class="sc2">
    <div class="sc2-text">
      <h1>Perjalanan Nyaman dengan Mutu Rent Car</h1>
      <h6>Mutu Rent Car adalah rental mobil terpercaya yang menyediakan pilihan mobil seperti Sigra,<br>
      Ayla, Xenia, Avanza, dan Agya. Kami menawarkan layanan mudah, aman, dan nyaman untuk <br> 
      kebutuhan perjalanan harian, mingguan, atau bulanan Anda!</h6>
    </div>

    <div class="sc2-keunggulan">
      <div class="sc2-item">
        <div class="sc2-icon">
          <div class="sc2-icon-circle">
            <i class="fa fa-money-bill-wave"></i>
          </div>
        </div>
        <h4>Harga Terbaik</h4>
      </div>
      <div class="sc2-item">
        <div class="sc2-icon">
          <div class="sc2-icon-circle">
            <i class="fa fa-broom"></i>
          </div>
        </div>
        <h4>Mobil Bersih</h4>
      </div>
      <div class="sc2-item">
        <div class="sc2-icon">
          <div class="sc2-icon-circle">
            <i class="fa fa-shield-alt"></i>
          </div>
        </div>
        <h4>Mesin Aman</h4>
      </div>
      <div class="sc2-item">
        <div class="sc2-icon">
          <div class="sc2-icon-circle">
            <i class="fa fa-road"></i>
          </div>
        </div>
        <h4>Perjalanan Nyaman</h4>
      </div>
    </div>
  </div>

  <div class="container">
    <img src="{{ asset('assets/5.jpg') }}" alt="Gallery Image" class="gallery-img">
    <img src="{{ asset('assets/6.jpg') }}" alt="Gallery Image" class="gallery-img">
    <img src="{{ asset('assets/7.jpg') }}" alt="Gallery Image" class="gallery-img">
    <img src="{{ asset('assets/8.jpg') }}" alt="Gallery Image" class="gallery-img">
    <img src="{{ asset('assets/9.jpg') }}" alt="Gallery Image" class="gallery-img">
  </div>

  <!-- scbg -->
  <div class="scbg" style="background-image: url('{{ asset('assets/bgcar.png') }}')">
    <div class="scbg-text">
      <h1>RASAKAN PERJALANAN TERBAIK</h1>
      <h6>Perjalanan Terbaik Dimulai dari Mutu Rent Car</h6>
    </div>
  </div>

  <!-- Daftar Mobil Section -->
  <div id="daftar-mobil" class="sc3">
    <div class="sc3-title">
      <h2>Daftar Mobil</h2>
    </div>
    <div class="vehicle-grid">
      <div class="row">
        @foreach ($kendaraans as $kendaraan)
        <div class="col-md-4 mb-4">
          <div class="card h-100">
            @if($kendaraan->gambar)
              <img src="{{ asset('storage/'. $kendaraan->gambar) }}" class="card-img-top" alt="{{ $kendaraan->jenis_mobil }}">
            @else
              <img src="https://via.placeholder.com/150" class="card-img-top" alt="No Image">
            @endif
            <div class="card-body">
              <h5 class="card-title">{{ $kendaraan->jenis_mobil }}</h5>
              <p class="card-text">
                <strong>Nomor Plat:</strong> {{ $kendaraan->nomor_plat }}<br>
                <strong>Tahun Pembuatan:</strong> {{ $kendaraan->tahun_pembuatan }}<br>
                <strong>Status:</strong> {{ $kendaraan->status_ketersediaan }}<br>
                <strong>Harga:</strong> {{ $kendaraan->harga_sewa }}
              </p>
            </div>
            <div class="card-footer text-center">
              <a href="{{ route('transaksi.create', ['kendaraan_id' => $kendaraan->id]) }}" class="btn btn-primary">Sewa Kendaraan</a>
            </div>
          </div>
        </div>
        @endforeach
      </div>
    </div>
  </div>

  <!-- Footer / Kontak -->
  <div id="kontak" class="footer">
    <div class="footer-container">
      <div class="footer-left">
        <h4>Mutu Rent Car</h4>
        <p>
          <span><strong>Alamat:</strong> Jl. Raya Mutu No. 123, Jakarta</span>
          <span><strong>Email:</strong> info@muturentcar.com</span>
          <span><strong>Telepon:</strong> +62 000000000</span>
          <span><strong>Jam Operasional:</strong> 08:00 - 20:00 WIB</span>
        </p>
      </div>
      <div class="footer-right">
        <img src="{{ asset('assets/logoPT.png') }}" alt="Logo">
      </div>
    </div>
  </div>
</body>
</html>