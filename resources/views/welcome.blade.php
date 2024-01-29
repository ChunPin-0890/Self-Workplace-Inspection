<!DOCTYPE html>
<html>
<head>
    <title>Welcome to the system</title>
    <style>
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background-color: #f5f5f5;
            font-family: Arial, sans-serif;
        }

        .container {
            text-align: center;
            padding: 20px;
            background-color: #ffffff;
            border-radius: 5px;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        h1 {
            font-size: 24px;
            color: #333333;
        }

        p {
            font-size: 18px;
            color: #666666;
        }

        .top-right-links {
            position: absolute;
            top: 10px;
            right: 10px;
        }

        .top-right-links a {
            margin-left: 10px;
            text-decoration: none;
            font-size: 14px;
            color: #333333;
        }
    </style>
</head>
<body class="antialiased">
    <div class="top-right-links">
        @if (Route::has('login'))
            <div>
                @auth
                    <a href="{{ url('/home') }}">Home</a>
                @else
                    <a href="{{ route('login') }}">Log in</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}">Register</a>
                    @endif
                @endauth
            </div>
        @endif
    </div>

    <div class="container">
        <img src="{{asset('SWIS.png') }}" alt="System">
       
        
    </div>
</body>
</html>
