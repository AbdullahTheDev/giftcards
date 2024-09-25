<!DOCTYPE html>
<html>
<head>
    <title>Verify Your Code</title>
</head>
<body>
    <h1>Verify Your Code</h1>

    <form method="POST" action="{{ route('verification') }}">
        @csrf
        <div>
            <label for="code">Verification Code:</label>
            <input id="code" type="text" name="code" required autofocus>
            @error('code')
                <span>{{ $message }}</span>
            @enderror
        </div>

        <button type="submit">Verify</button>
    </form>
</body>
</html>
