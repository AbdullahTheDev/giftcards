<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gift Confirmation</title>
</head>
<body>
    <p>
        Hi {{ $data['username'] }},
    </p>
    <p>
        Thank you for your generous gift!
    </p>
    <p>
        You have sent a gift of <strong>${{ $data['amount'] }}</strong> on the event <strong>{{ $data['event_name'] }}</strong>.
    </p>
    <br>
    <p>
        We truly appreciate your support.
    </p>
</body>
</html>
