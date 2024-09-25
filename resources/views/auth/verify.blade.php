<!DOCTYPE html>
<html>
<head>
    <title>Verify Your Code</title>
</head>
<body>
    <h1>Verification</h1>
    <form method="POST" action="{{ route('verification') }}">
        @csrf
        <label for="code">Enter the verification code sent to your email:</label>
        <input type="text" name="code" id="code" required>
        <button type="submit">Verify</button>
    </form>

    @if ($errors->any())
        <div>
            <strong>{{ $errors->first() }}</strong>
        </div>
    @endif
</body>
</html>
