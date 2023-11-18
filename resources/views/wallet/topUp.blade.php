@extends('voyager::master')

@section('content')
<x-style />

<form action="" id="paymentForm">
    <div>
        <label for="amount">Amount: </label>
        <input type="tel" name="amount" id="amount" required>
    </div>
    <input type="hidden" value="{{$user_email}}" id="email-address">

    <input class="btn" type="submit" value="Top Up Wallet">
</form>

<script src="https://js.paystack.co/v1/inline.js"></script>

<script>
    var paymentForm = document.getElementById('paymentForm');
    paymentForm.addEventListener('submit', payWithPaystack, false);

    function payWithPaystack(e) {
        e.preventDefault();
        var handler = PaystackPop.setup({
            key: '',
            email: document.getElementById('email-address').value,
            amount: document.getElementById('amount').value * 100, // the amount value is multiplied by 100 to convert to the lowest currency unit
            currency: 'NGN',
            callback: function(response) {
                //this happens after the payment is completed successfully
                // var reference = response.reference;
                alert('Please hold on while your payment is being processed. once successfully processed, your wallet balance would be topped up.');
                // Make an AJAX call to your server with the reference to verify the transaction
            },
            onClose: function() {
                alert('Transaction was not completed, window closed.');
            },
        });
        handler.openIframe();
    }
</script>

@stop