<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login | DISKOMINFO</title>
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Rubik:400,700">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: 'Rubik', sans-serif;
        }

        body {
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            overflow: hidden;
            background-color: #f4f4f4;
        }

        .background-container {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 0;
        }

        .background-slide {
            position: absolute;
            width: 100%;
            height: 100%;
        }

        .background-slide img {
            position: absolute;
            width: 100%;
            height: 100%;
            object-fit: cover;
            animation: slideAnimation 12s infinite;
            z-index: 0;
            opacity: 0;
        }

        .background-slide img:nth-child(1) {
            animation-delay: 0s;
        }

        .background-slide img:nth-child(2) {
            animation-delay: 4s;
        }

        .background-slide img:nth-child(3) {
            animation-delay: 8s;
        }

        @keyframes slideAnimation {
            0% {
                opacity: 0;
                z-index: 0;
            }
            10% {
                opacity: 1;
                z-index: 1;
            }
            40% {
                opacity: 1;
                z-index: 1;
            }
            50% {
                opacity: 0;
                z-index: 0;
            }
            100% {
                opacity: 0;
                z-index: 0;
            }
        }

        .background-overlay {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1;
        }

        .login-container {
            position: relative;
            display: flex;
            max-width: 1200px;
            width: 100%;
            height: 550px;
            background: white;
            box-shadow: 0 4px 20px rgba(0, 0, 0, 0.2);
            border-radius: 10px;
            overflow: hidden;
            z-index: 2;
        }

        .welcome-section {
            color: white;
            padding: 50px;
            flex: 1;
            display: flex;
            justify-content: center;
            align-items: center;
            font-size: 24px;
            text-align: center;
            background: linear-gradient(45deg, #007bff, #00c6ff);
            background-size: 200% 200%;
            animation: gradientBackground 6s infinite;
        }

        @keyframes gradientBackground {
            0% {
                background-position: 0% 50%;
            }
            50% {
                background-position: 100% 50%;
            }
            100% {
                background-position: 0% 50%;
            }
        }

        .form-section {
            padding: 40px;
            flex: 1;
            overflow-y: auto;
        }

        .form-section h1 {
            margin-bottom: 20px;
            font-size: 48px;
            text-align: center;
            background: linear-gradient(45deg, #007bff, #00c6ff);
            background-clip: text;
            -webkit-background-clip: text;
            color: transparent;
            font-weight: bold;
            animation: gradientTextColor 6s infinite;
        }

        @keyframes gradientTextColor {
            0% {
                color: rgba(0, 123, 255, 0); /* Transparan pada awal */
            }
            25% {
                color: rgba(0, 123, 255, 0.5); /* Warna biru redup */
            }
            50% {
                color: rgba(0, 123, 255, 1); /* Warna biru terang */
            }
            75% {
                color: rgba(0, 123, 255, 0.5); /* Warna biru redup */
            }
            100% {
                color: rgba(0, 123, 255, 0); /* Transparan kembali */
            }
        }

        .form-section .input-group {
            position: relative;
            margin-bottom: 20px;
        }

        .form-section .input-group input {
            width: 100%;
            padding: 15px 10px 15px 40px;
            font-size: 16px;
            border: 1px solid #ccc;
            border-radius: 5px;
        }

        .form-section .input-group i {
            position: absolute;
            top: 50%;
            left: 10px;
            transform: translateY(-50%);
            font-size: 18px;
            color: #aaa;
        }

        .form-section .btn {
            display: block;
            width: 100%;
            padding: 16px;
            background: linear-gradient(45deg, #007bff, #00c6ff);
            color: white;
            font-size: 18px;
            font-weight: bold;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .form-section .register-link {
            text-align: center;
            margin-top: 20px;
            font-size: 16px;
        }

        .form-section .register-link a {
            color: #007bff;
            text-decoration: none;
        }

        .form-section .btn:hover {
            background: linear-gradient(45deg, #00c6ff, #007bff);
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.2);
            transform: translateY(-3px);
        }
    </style>
</head>

<body>
    <div class="background-container">
        <div class="background-slide">
            <img src="assets/images/LOGODISKOMINFO.png" alt="Slide 1">
            <img src="assets/images/ruang/Gedung3.jpeg" alt="Slide 2">
            <img src="assets/images/ruang/Gedung2.jpeg" alt="Slide 3">
        </div>
        <div class="background-overlay"></div>
    </div>

    <div class="login-container">
        <div class="welcome-section">
            <div style="text-align: center;">
                <i class="fas fa-university"></i>
                <h2>Welcome to Ruang Rapat DISKOMINFO</h2>
                <p style="margin-top: 10px; font-size: 16px; line-height: 1.5;">
                    Join us in shaping your bright future! 🌟<br>
                    Discover excellence in education and innovation.
                </p>
            </div>
        </div>
        <div class="form-section">
            <h1 class="login-title">
                LOG<span>IN</span>
            </h1>
            <form action="/login" method="post">
    @csrf
    <div class="input-group">
        <i class="fas fa-user"></i>
        <input type="text" id="login" name="login" required placeholder="Email atau Username" value="{{ old('login') }}">
        @error('login')
        <div style="color: red; font-size: 12px;">{{ $message }}</div>
        @enderror
    </div>
    <div class="input-group">
        <i class="fas fa-lock"></i>
        <input type="password" id="password" name="password" required placeholder="Password">
        @error('password')
        <div style="color: red; font-size: 12px;">{{ $message }}</div>
        @enderror
    </div>
    <button type="submit" class="btn">Login</button>
</form>
            <div class="register-link">
                Not a member yet? <a href="/register">Sign up</a>
            </div>
        </div>
    </div>
</body>

</html>