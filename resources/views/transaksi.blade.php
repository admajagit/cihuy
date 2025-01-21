<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Form Transaksi Sewa Kendaraan</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
</head>
<body class="bg-gray-100">
    <div class="container mx-auto px-4 py-8">
        <div class="max-w-2xl mx-auto bg-white rounded-lg shadow-md p-6">
            <h2 class="text-2xl font-bold mb-6">Form Transaksi Sewa Kendaraan</h2>

            @if ($errors->any())
                <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded mb-4">
                    <ul class="list-disc pl-5">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('transaksi.store') }}" method="POST" class="space-y-6">
                @csrf

                <div class="mb-4">
                    <label for="kendaraan_id" class="block text-gray-700 font-bold mb-2">Kendaraan yang Dipilih</label>
                    <input type="hidden" name="kendaraan_id" value="{{ $kendaraan_id }}">
                    <div class="w-full border rounded-md px-3 py-2 bg-gray-50">
                        {{ $kendaraan->jenis_mobil }}
                    </div>
                </div>

                <div class="mb-4">
                    <label for="lokasi" class="block text-gray-700 font-bold mb-2">Lokasi Pengambilan</label>
                    <input type="text" name="lokasi" id="lokasi" value="{{ old('lokasi') }}" 
                        class="w-full border rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                        required>
                </div>

                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="mb-4">
                        <label for="tanggal_mulai" class="block text-gray-700 font-bold mb-2">Tanggal Mulai</label>
                        <input type="date" name="tanggal_mulai" id="tanggal_mulai" value="{{ old('tanggal_mulai') }}"
                            class="w-full border rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                            required>
                    </div>

                    <div class="mb-4">
                        <label for="tanggal_berakhir" class="block text-gray-700 font-bold mb-2">Tanggal Berakhir</label>
                        <input type="date" name="tanggal_berakhir" id="tanggal_berakhir" value="{{ old('tanggal_berakhir') }}"
                            class="w-full border rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500"
                            required>
                    </div>
                </div>

                <div class="mb-4">
                    <label for="payment" class="block text-gray-700 font-bold mb-2">Metode Pembayaran</label>
                    <select name="payment" id="payment" class="w-full border rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500" required>
                        <option value="">Pilih Metode Pembayaran</option>
                        <option value="BRI" {{ old('payment') == 'BRI' ? 'selected' : '' }}>BRI</option>
                        <option value="BCA" {{ old('payment') == 'BCA' ? 'selected' : '' }}>BCA</option>
                        <option value="BANK" {{ old('payment') == 'BANK' ? 'selected' : '' }}>BANK</option>
                        <option value="BANK JAGO" {{ old('payment') == 'BANK JAGO' ? 'selected' : '' }}>BANK JAGO</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label for="no_rekening" class="block text-gray-700 font-bold mb-2">Nomor Rekening</label>
                    <input type="text" name="no_rekening" id="no_rekening" value="{{ old('no_rekening') }}"
                        class="w-full border rounded-md px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                </div>

                <input type="hidden" name="status_pembayaran" value="pending">

                <div class="flex justify-end space-x-4">
                    <a href="{{ url('/') }}" 
                        class="bg-gray-500 text-white px-4 py-2 rounded-md hover:bg-gray-600 transition-colors">
                        Batal
                    </a>
                    <button type="submit" 
                        class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600 transition-colors">
                        Simpan Transaksi
                    </button>
                </div>
            </form>
        </div>
    </div>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            // Set minimum date for tanggal_mulai to today
            const today = new Date().toISOString().split('T')[0];
            document.getElementById('tanggal_mulai').min = today;

            // Update tanggal_berakhir min date when tanggal_mulai changes
            document.getElementById('tanggal_mulai').addEventListener('change', function() {
                document.getElementById('tanggal_berakhir').min = this.value;
            });
        });
    </script>
</body>
</html>