<form method="POST" action="{{ route('transaksi.store') }}">
    @csrf
    <input type="hidden" name="kendaraan_id" value="{{ $kendaraan->id }}">
    <div class="mb-3">
        <label for="lokasi" class="form-label">Lokasi</label>
        <input type="text" class="form-control" id="lokasi" name="lokasi" required>
    </div>
    <div class="mb-3">
        <label for="tanggal_mulai" class="form-label">Tanggal Mulai</label>
        <input type="date" class="form-control" id="tanggal_mulai" name="tanggal_mulai" required>
    </div>
    <div class="mb-3">
        <label for="durasi" class="form-label">Durasi (hari)</label>
        <input type="number" class="form-control" id="durasi" name="durasi" required>
    </div>
    <div class="mb-3">
        <label for="total_harga" class="form-label">bayar disini</label>
        <input type="number" class="form-control" id="total_harga" name="total_harga" required>
    </div>
    <button type="submit" class="btn btn-success">Konfirmasi Sewa</button>
</form>
