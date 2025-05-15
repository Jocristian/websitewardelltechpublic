<button id="pay-button" class="btn btn-success">Bayar Sekarang</button>

<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>
<script>
    document.getElementById('pay-button').addEventListener('click', function () {
        fetch('{{ route("order.pay", ["service_id" => $order->service_id, "order_id" => $order->id]) }}')
            .then(response => response.json())
            .then(data => {
                window.snap.pay(data.snapToken, {
                    onSuccess: function (result) {
                        // Update status order jadi "on progress"
                        fetch('/order/update-status/{{ $order->id }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify({ status: 'on progress' })
                        }).then(() => {
                            alert('Pembayaran berhasil dan order dimulai!');
                            window.location.href = '/dashboard';
                        });
                    },
                    onPending: function (result) {
                        alert("Pembayaran tertunda. Silakan tunggu konfirmasi.");
                    },
                    onError: function (result) {
                        alert("Gagal melakukan pembayaran.");
                    },
                    onClose: function () {
                        alert("Kamu menutup popup sebelum pembayaran selesai.");
                    }
                });
            });
    });
</script>
