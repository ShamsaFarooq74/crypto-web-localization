<!DOCTYPE html>
<html>
<head>
    <title>View Payment</title>
</head>
<body>
    <h1>Payment Details</h1>

    <p>Payment ID: {{ $payment['id'] }}</p>
    <p>Amount: ${{ $payment['amount'] }}</p>
    <p>User Name: {{ $payment['user']['name'] }}</p>

    <!-- Additional payment information -->

    <a href="/">Go Back</a>
</body>
</html>
