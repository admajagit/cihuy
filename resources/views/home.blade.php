{{-- resources/views/kendaraan/index.blade.php --}}
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Daftar Kendaraan</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container mt-5">
        <h1 class="text-center mb-4">Tampilan Home</h1>
        <h2 class="text-center mb-4">Daftar Sewa Kendaraan</h2>
        
        <!-- Menampilkan pesan sukses jika ada -->
        @if(session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <!-- Daftar kendaraan dalam bentuk card -->
        <div class="row">
            @foreach ($kendaraans as $kendaraan)
                <div class="col-md-4 mb-4">
                    <div class="card h-100">
                        @if($kendaraan->gambar)
                            <img src="{{ asset('storage/' . $kendaraan->gambar) }}" class="card-img-top" alt="{{ $kendaraan->jenis_mobil }}">
                        @else
                            <img src="https://via.placeholder.com/150" class="card-img-top" alt="No Image">
                        @endif
                        <div class="card-body">
                            <h5 class="card-title">{{ $kendaraan->jenis_mobil }}</h5>
                            <p class="card-text">
                                <strong>Nomor Plat:</strong> {{ $kendaraan->nomor_plat }}<br>
                                <strong>Tahun Pembuatan:</strong> {{ $kendaraan->tahun_pembuatan }}<br>
                                <strong>Status:</strong> {{ $kendaraan->status_ketersediaan }}
                            </p>
                        </div>
                        <div class="card-footer text-center">
                            <button class="btn btn-primary">Sewa Kendaraan</button>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
    </div>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
