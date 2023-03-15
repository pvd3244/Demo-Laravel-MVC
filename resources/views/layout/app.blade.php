<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <title>CRUD</title>
</head>
<style>
    *{
        margin: 0;
        padding: 0;
    }
    .container{
        width: 100vw;
        height: 100vh;
        display: flex;
        justify-content: center;
        align-items: center;
        flex-direction: column;
    }
    .form{
        width: 400px;
    }
    .input-error{
        border: 1px solid red;
    }
</style>
<body>
    @yield('content')
</body>
</html>
