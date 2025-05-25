<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>WardellTech</title>
    <link rel="icon" href="/img/headingW.png">
    <link rel="stylesheet" href="assets/css/services.css">
    @yield('css')
    @vite([
    'node_modules/bootstrap/dist/css/bootstrap.min.css',
    'node_modules/owl.carousel/dist/assets/owl.carousel.min.css',
    'node_modules/owl.carousel/dist/assets/owl.theme.default.min.css',
    'node_modules/jquery.fancybox/source/jquery.fancybox.css',
    'resources/fonts/flaticon_mycollection.css',
    'resources/css/fontawesome.min.css',
    'resources/css/style.css',
    'resources/css/responsive.css'])

    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <style>
    .sticky-sidebar {
      position: sticky;
      top: 20px;
    }
    .product-image {
      object-fit: cover;
      border-radius: 10px;
    }
    .overview-list li {
      margin-bottom: 0.5rem;
    }
  </style>
</head>
<body>
@section('content')
<div class="container my-5">
    <!-- Alert success -->
    <!-- Alert sukses -->
<!-- Persyaratan Pesanan -->
<div class="card mb-4">
    <div class="card-header">
        <strong>Kirim Persyaratan untuk Memulai Pesanan Anda</strong>
    </div>
    <div class="card-body">
        <p>Penjual memerlukan informasi berikut untuk mulai mengerjakan pesanan Anda:</p>
        <ul>
            <li>Kirim teks atau detail yang perlu diketahui freelancer.</li>
            <li>Lampirkan file atau instruksi jika diperlukan.</li>
        </ul>

        <form action="{{ route('order.submit', $order->service_id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            <div class="form-group mb-3">
                <textarea name="requirements" class="form-control" rows="5" maxlength="2500" required></textarea>
                <small class="text-muted">Maksimum 2500 karakter</small>
            </div>

            <div class="form-check mb-3">
                <input class="form-check-input" type="checkbox" id="confirm" required>
                <label class="form-check-label" for="confirm">
                    Informasi yang saya berikan <strong>akurat dan lengkap</strong>.
                </label>
            </div>
            <div class="d-flex justify-content-end">
                <button type="button" id="pay-button" class="btn btn-success">Mulai Pesanan & Bayar</button>
            </div>
            <input type="hidden" name="service_id" value="{{ $order->service_id }}">
            <input type="hidden" name="seller_id" value="{{ $order->user_id }}">
        </form>
    </div>
</div>

<!-- Info Sidebar -->
<div class="card">
    <div class="card-body">
        <h5>{{ $order->overview }}</h5>
        <p>Layanan oleh: {{ $order->user_id }} <strong>{{ $order->service->user->name }}</strong></p>
    </div>
</div>

<!-- Modal Pesanan Selesai -->
<div class="modal fade" id="orderCompleteModal" tabindex="-1" aria-labelledby="orderCompleteLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content text-center p-4">
            <h4 class="modal-title text-success mb-3" id="orderCompleteLabel">🎉 Pesanan Selesai</h4>
            <p>Terima kasih! Pesanan Anda berhasil dikirim.</p>
            <a href="/" class="btn btn-primary mt-3">Kembali ke Dashboard</a>
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const form = document.querySelector('form');
        const modalElement = document.getElementById('orderCompleteModal');

        if (!form || !modalElement) return;

        const modal = new bootstrap.Modal(modalElement);

        form.addEventListener('submit', function (e) {
            e.preventDefault(); // Mencegah submit default
            modal.show(); // Tampilkan modal

            // Setelah modal muncul, submit form secara otomatis
            setTimeout(() => {
                form.submit();
            }, 1500);
        });
    });
</script>

@if(session('success'))
<script>
    document.addEventListener('DOMContentLoaded', function () {
        const modal = new bootstrap.Modal(document.getElementById('orderCompleteModal'));
        modal.show();

        // Tunggu modal ditutup sebelum mengarahkan
        const modalElement = document.getElementById('orderCompleteModal');
        modalElement.addEventListener('hidden.bs.modal', function () {
            window.location.href = "/dashboard"; // atau URL lainnya
        });
    });
</script>
@endif

<!-- Script Midtrans -->
<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>
<script>
    document.getElementById('pay-button').addEventListener('click', function (e) {
        e.preventDefault(); // cegah tombol submit default

        const form = document.querySelector('form');

        // Validasi dasar
        if (!form.reportValidity()) {
            return; // Jangan lanjutkan jika form tidak valid
        }

        fetch('{{ route("order.pay", ["service_id" => $order->service_id, "order_id" => $order->id]) }}')
            .then(response => response.json())
            .then(data => {
                window.snap.pay(data.snapToken, {
                    onSuccess: function (result) {
                        // Submit form jika pembayaran berhasil
                        form.submit();
                    },
                    onPending: function (result) {
                        alert("Pembayaran sedang diproses. Mohon tunggu konfirmasi.");
                    },
                    onError: function (result) {
                        alert("Pembayaran gagal. Silakan coba lagi.");
                    },
                    onClose: function () {
                        alert("Anda menutup jendela pembayaran sebelum menyelesaikan transaksi.");
                    }
                });
            })
            .catch(err => {
                console.error(err);
                alert("Gagal memproses pembayaran. Silakan coba lagi.");
            });
    });
</script>



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
