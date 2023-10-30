<!DOCTYPE html>
<html>

<head>
    <title>Password Reset</title>
</head>

<body>
    <h1>Password Reset</h1>
    <p>Click the following link to reset your password:</p>
    <a target="_blank" href="{{ route('password.reset', ['token' => $token]) }}"><button class=" bg-blue-500 text-white px-3 py-1">
            Reset Password</button></a>
</body>

</html>
