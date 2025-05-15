<script src="https://app.sandbox.midtrans.com/snap/snap.js" data-client-key="{{ env('MIDTRANS_CLIENT_KEY') }}"></script>

<button id="pay-button">Pay Now</button>

<script type="text/javascript">
    document.getElementById('pay-button').onclick = function () {
        snap.pay('{{ $snapToken }}', {
            onSuccess: function(result){
                console.log(result);
                window.location.href = "/payment-success";
            },
            onPending: function(result){
                console.log(result);
            },
            onError: function(result){
                console.log(result);
            }
        });
    };
</script>
