<!DOCTYPE html>
<html>
<head>
    <title>Redirecting to Payment Gateway...</title>
    <style>
        body { font-family: Arial, sans-serif; text-align: center; padding: 50px; }
        .loader { border: 4px solid #f3f3f3; border-top: 4px solid #3498db; border-radius: 50%; width: 40px; height: 40px; animation: spin 2s linear infinite; margin: 20px auto; }
        @keyframes spin { 0% { transform: rotate(0deg); } 100% { transform: rotate(360deg); } }
    </style>
</head>
<body>
    <h2>Redirecting to Payment Gateway...</h2>
    <div class="loader"></div>
    <p>Please wait while we redirect you to the secure payment page.</p>
    
    <form id="easebuzzForm" method="POST" action="{{ $paymentUrl }}">
        <input type="hidden" name="key" value="{{ $key }}">
        <input type="hidden" name="txnid" value="{{ $txnid }}">
        <input type="hidden" name="amount" value="{{ $amount }}">
        <input type="hidden" name="productinfo" value="{{ $productinfo }}">
        <input type="hidden" name="firstname" value="{{ $firstname }}">
        <input type="hidden" name="email" value="{{ $email }}">
        <input type="hidden" name="phone" value="{{ $phone }}">
        <input type="hidden" name="surl" value="{{ $surl }}">
        <input type="hidden" name="furl" value="{{ $furl }}">
        <input type="hidden" name="hash" value="{{ $hash }}">
        <input type="hidden" name="udf1" value="">
        <input type="hidden" name="udf2" value="">
        <input type="hidden" name="udf3" value="">
        <input type="hidden" name="udf4" value="">
        <input type="hidden" name="udf5" value="">
        <input type="hidden" name="udf6" value="">
        <input type="hidden" name="udf7" value="">
        <input type="hidden" name="udf8" value="">
        <input type="hidden" name="udf9" value="">
        <input type="hidden" name="udf10" value="">
    </form>

    <script>
        // Auto-submit the form after 2 seconds
        setTimeout(function() {
            document.getElementById('easebuzzForm').submit();
        }, 2000);
    </script>
</body>
</html>