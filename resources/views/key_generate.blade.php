<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Generate Laravel App Key</title>
</head>
<body>
    <h2>Generate Laravel Application Key</h2>

    @if(session('success'))
        <p style="color: green;">{{ session('success') }}</p>
    @endif

    <form action="/generate-key" method="POST">
        {{ csrf_field() }}
        <button type="submit">Generate Key</button>
    </form>
</body>
</html>
