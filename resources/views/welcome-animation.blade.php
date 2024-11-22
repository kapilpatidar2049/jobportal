<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{__('Welcome')}}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f3f3f3;
        }
        .welcome-container {
            text-align: center;
            opacity: 0;
            transform: translateY(20px);
            animation: fadeInUp 1s forwards;
        }
        @keyframes fadeInUp {
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        .welcome-message {
            font-size: 2em;
            color: #333;
        }
        .continue {
            margin-top: 20px;
            padding: 10px 20px;
            background-color: #28a745;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
            font-size: 1em;
        }
    </style>
</head>
<body>

<div class="welcome-container">
    <div class="welcome-message">{{__('Welcome')}}, {{ Auth::user()->name }}!</div>
    <button class="continue" onclick="window.location.href='/dashboard'">{{__('Continue to Dashboard')}}</button>
</div>

</body>
</html>
