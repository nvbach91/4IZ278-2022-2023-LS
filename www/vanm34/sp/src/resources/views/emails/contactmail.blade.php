<!DOCTYPE html>
<html>

<head>
    <title>Contact Message</title>
</head>

<body>
    <h2>You received a message from {{ $details['from'] }}</h2>
    <p>{{ $details['message'] }}</p>
</body>

</html>