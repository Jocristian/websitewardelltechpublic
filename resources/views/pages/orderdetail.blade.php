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
    <div class="alert alert-success">
        ✅ Thank you for your purchase! A receipt has been sent to your email.
    </div>

    <!-- Order Requirements -->
    <div class="card mb-4">
        <div class="card-header">
            <strong>Submit Requirements to Start Your Order</strong>
        </div>
        <div class="card-body">
            <p>The seller needs the following information to start working on your order:</p>
            <ul>
                <li>Send any text or details the freelancer should know.</li>
                <li>Attach files or instructions if necessary.</li>
            </ul>

            <form action="{{ route('order.submit', $service->service_id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group mb-3">
                    <textarea name="requirements" class="form-control" rows="5" maxlength="2500" required></textarea>
                    <small class="text-muted">Max 2500 characters</small>
                </div>

                <div class="form-check mb-3">
                    <input class="form-check-input" type="checkbox" id="confirm" required>
                    <label class="form-check-label" for="confirm">
                        The information I provided is <strong>accurate and complete</strong>.
                    </label>
                </div>

                <div class="d-flex justify-content-between">
                    <a href="#" class="btn btn-outline-secondary">Remind Me Later</a>
                    <button type="submit" class="btn btn-success">Start Order</button>
                </div>
                <input type="hidden" name="service_id" value="{{ $service->service_id }}">
                <input type="hidden" name="seller_id" value="{{ $service->user_id }}">
            </form>
        </div>
    </div>

    <!-- Sidebar Info -->
    <div class="card">
        <div class="card-body">
            <h5>{{ $service->overview }}</h5>
            <p>Service by: {{ $service->user_id }} <strong>{{ $service->user->name }}</strong>
    </div>
    <!-- Order Complete Modal -->
    <div class="modal fade" id="orderCompleteModal" tabindex="-1" aria-labelledby="orderCompleteLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content text-center p-4">
        <h4 class="modal-title text-success mb-3" id="orderCompleteLabel">🎉 Order Complete</h4>
        <p>Thank you! Your order has been submitted successfully.</p>
        <a href="/" class="btn btn-primary mt-3">Back to Dashboard</a>
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
                e.preventDefault(); // Prevent default submit
                modal.show(); // Show modal

                // After showing modal, submit form for real
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

            // Wait for the modal to be hidden before redirecting
            const modalElement = document.getElementById('orderCompleteModal');
            modalElement.addEventListener('hidden.bs.modal', function () {
                window.location.href = "/dashboard"; // or any other redirect URL after modal closes
            });
        });
    </script>
    @endif



    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
