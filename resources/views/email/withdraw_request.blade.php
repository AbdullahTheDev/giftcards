<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Withdraw Request</title>
</head>
<body>
    <p>
        {{ $data['username'] }} has request a withdraw.
    </p>
    <br>
    <p>
        Total Amount Requested: <strong>{{ $data['total'] }}</strong>
    </p>

    
</body>
</html>