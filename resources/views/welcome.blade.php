<!DOCTYPE html>
<html lang="en">

<head>
    <title>Welcome to the system</title>
    <style>
        /* Background Gradient */
        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            background: linear-gradient(45deg, #6a11cb, #2575fc);
            /* Beautiful gradient */
            font-family: 'Arial', sans-serif;
            margin: 0;
            padding: 0;
        }

        /* Container with shadows and padding */
        .container {
            text-align: center;
            padding: 40px;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 500px;
            animation: fadeIn 1s ease-in-out;
        }

        /* Header styling with animation */
        h1 {
            font-size: 32px;
            color: #333;
            margin-bottom: 20px;
            animation: slideInFromTop 1s ease-in-out;
        }

        /* Paragraph styling */
        p {
            font-size: 18px;
            color: #666;
            margin-bottom: 30px;
            animation: fadeIn 1.5s ease-in-out;
        }

        /* Top-right login/register links */
        .top-right-links {
            position: absolute;
            top: 20px;
            right: 20px;
        }

        .top-right-links a {
            margin-left: 10px;
            text-decoration: none;
            font-size: 16px;
            color: #ffffff;
            transition: color 0.3s ease;
        }

        .top-right-links a:hover {
            color: #f8f9fa;
        }

        /* Animation keyframes */
        @keyframes fadeIn {
            0% {
                opacity: 0;
            }

            100% {
                opacity: 1;
            }
        }

        @keyframes slideInFromTop {
            0% {
                transform: translateY(-50px);
                opacity: 0;
            }

            100% {
                transform: translateY(0);
                opacity: 1;
            }
        }

        /* Image Styling */
        .container img {
            max-width: 100%;
            height: auto;
            border-radius: 8px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
            margin-bottom: 30px;
        }

        /* Button Styling */
        .btn {
            padding: 10px 20px;
            background-color: #2575fc;
            color: #ffffff;
            border: none;
            border-radius: 5px;
            text-decoration: none;
            font-size: 16px;
            transition: background-color 0.3s ease;
        }

        .btn:hover {
            background-color: #6a11cb;
        }
    </style>
</head>

<body class="antialiased">
    <!-- Top Links for Authentication -->
    <div class="top-right-links">
        @if (Route::has('login'))
            <div>
                @auth
                    <a href="{{ url('/home') }}" class="btn">Home</a>
                @else
                    <a href="{{ route('login') }}" class="btn"><i class="fas fa-sign-in-alt"></i> Log in</a>

                    @if (Route::has('register'))
                        <a href="{{ route('register') }}" class="btn"><i class="fas fa-user-plus"></i> Register</a>
                    @endif
                @endauth
            </div>
        @endif
    </div>

    <!-- Centered Content -->
    <div class="container">
        <h1>Welcome to the System</h1>
        <p>Your self-workplace inspection journey starts here!</p>

        <!-- Image -->
        <img src="{{ asset('SWIS.png') }}" alt="System">

        <!-- Call to action buttons for log in and register -->
        <div>
            @auth
                <a href="{{ url('/home') }}" class="btn">Go to Dashboard</a>
            @else
                <a href="{{ route('login') }}" class="btn"><i class="fas fa-sign-in-alt"></i> Log in</a>
                <a href="{{ route('register') }}" class="btn"><i class="fas fa-user-plus"></i> Register</a>
            @endauth
        </div>

    </div>

    <!-- Add FontAwesome for icons -->
    <script src="https://kit.fontawesome.com/a076d05399.js"></script>
</body>

</html>