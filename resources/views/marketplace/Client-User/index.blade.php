<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ __('User/Client') }}</title>
    <link rel="stylesheet" href="{{ url('admin_theme/marketplace/css/style.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css"
        integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg=="
        crossorigin="anonymous" referrerpolicy="no-referrer" />
</head>

<body class="user_client_body">
    <div class="container">
        <form action="">
            <div class="user_client">
                <a href="{{route('user_details',$user->id)}}"><div class="userbutton">{{ __('User') }}</div></a>
                <a href="{{route('client_details',$user->id)}}"><div class="clientbutton">{{ __('Client') }}</div></a>
            </div>
        </form>
    </div>
</body>

</html>
