<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gift Received</title>
</head>
<body>
    <p>
        Hi {{ $data['host_name'] }},
    </p>
    <p>
        Great news! You’ve received a gift from <strong>{{ $data['gifter_name'] }}</strong>.
    </p>
    <p>
        Gift Amount: <strong>${{ $data['amount'] }}</strong>
    </p>
    <br>
    <p>
        Keep up the amazing work!
    </p>
</body>
</html>
