<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login Aplikasi Perpustakaan</title>

    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css" rel="stylesheet">
    
    <!-- Bootstrap -->
    <link href="/Assets/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- SweetAlert -->
    <link href="/Assets/css/sweetalert2.min.css" rel="stylesheet">
    
    <style>
        :root {
            --primary-color: #6a11cb;
            --secondary-color: #2575fc;
            --accent-color: #ff4d4d;
            --text-light: #ffffff;
            --text-dark: #333333;
        }
        
        body {
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            height: 100vh;
            margin: 0;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            overflow: hidden;
            display: flex;
            justify-content: center;
            align-items: center;
        }
        
        .login-container {
            position: relative;
            width: 400px;
            background: rgba(255, 255, 255, 0.15);
            backdrop-filter: blur(10px);
            -webkit-backdrop-filter: blur(10px);
            border-radius: 20px;
            box-shadow: 0 25px 45px rgba(0, 0, 0, 0.2);
            border: 1px solid rgba(255, 255, 255, 0.1);
            overflow: hidden;
            z-index: 10;
            padding: 40px;
            animation: fadeIn 0.8s ease-in-out;
        }
        
        .login-container::before {
            content: '';
            position: absolute;
            top: -50%;
            left: -50%;
            width: 200%;
            height: 200%;
            background: linear-gradient(
                to bottom right,
                rgba(255, 255, 255, 0.1),
                rgba(255, 255, 255, 0)
            );
            transform: rotate(45deg);
            z-index: -1;
        }
        
        .login-header {
            text-align: center;
            margin-bottom: 30px;
            color: var(--text-light);
        }
        
        .login-header h2 {
            font-weight: 700;
            font-size: 2.2rem;
            margin-bottom: 10px;
            text-shadow: 0 2px 10px rgba(0, 0, 0, 0.2);
        }
        
        .login-header p {
            opacity: 0.8;
            font-size: 0.9rem;
        }
        
        .form-group {
            margin-bottom: 25px;
            position: relative;
        }
        
        .form-control {
            background: rgba(255, 255, 255, 0.1);
            border: none;
            border-radius: 50px;
            padding: 15px 20px;
            color: var(--text-light);
            width: 100%;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }
        
        .form-control:focus {
            background: rgba(255, 255, 255, 0.2);
            outline: none;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.2);
        }
        
        .form-control::placeholder {
            color: rgba(255, 255, 255, 0.7);
        }
        
        .btn-login {
            background: linear-gradient(to right, var(--primary-color), var(--secondary-color));
            border: none;
            border-radius: 50px;
            padding: 15px;
            color: white;
            font-weight: 600;
            width: 100%;
            cursor: pointer;
            transition: all 0.3s ease;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.2);
            margin-top: 10px;
            text-transform: uppercase;
            letter-spacing: 1px;
        }
        
        .btn-login:hover {
            transform: translateY(-3px);
            box-shadow: 0 8px 25px rgba(0, 0, 0, 0.3);
        }
        
        .btn-login:active {
            transform: translateY(0);
        }
        
        .remember-me {
            color: var(--text-light);
            margin-bottom: 20px;
        }
        
        .remember-me input {
            margin-right: 8px;
        }
        
        .circles {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            overflow: hidden;
            z-index: 1;
        }
        
        .circles li {
            position: absolute;
            display: block;
            list-style: none;
            width: 20px;
            height: 20px;
            background: rgba(255, 255, 255, 0.2);
            animation: animate 25s linear infinite;
            bottom: -150px;
            border-radius: 50%;
        }
        
        .circles li:nth-child(1) {
            left: 25%;
            width: 80px;
            height: 80px;
            animation-delay: 0s;
        }
        
        .circles li:nth-child(2) {
            left: 10%;
            width: 20px;
            height: 20px;
            animation-delay: 2s;
            animation-duration: 12s;
        }
        
        .circles li:nth-child(3) {
            left: 70%;
            width: 20px;
            height: 20px;
            animation-delay: 4s;
        }
        
        .circles li:nth-child(4) {
            left: 40%;
            width: 60px;
            height: 60px;
            animation-delay: 0s;
            animation-duration: 18s;
        }
        
        .circles li:nth-child(5) {
            left: 65%;
            width: 20px;
            height: 20px;
            animation-delay: 0s;
        }
        
        .circles li:nth-child(6) {
            left: 75%;
            width: 110px;
            height: 110px;
            animation-delay: 3s;
        }
        
        .circles li:nth-child(7) {
            left: 35%;
            width: 150px;
            height: 150px;
            animation-delay: 7s;
        }
        
        .circles li:nth-child(8) {
            left: 50%;
            width: 25px;
            height: 25px;
            animation-delay: 15s;
            animation-duration: 45s;
        }
        
        .circles li:nth-child(9) {
            left: 20%;
            width: 15px;
            height: 15px;
            animation-delay: 2s;
            animation-duration: 35s;
        }
        
        .circles li:nth-child(10) {
            left: 85%;
            width: 150px;
            height: 150px;
            animation-delay: 0s;
            animation-duration: 11s;
        }
        
        @keyframes animate {
            0% {
                transform: translateY(0) rotate(0deg);
                opacity: 1;
                border-radius: 0;
            }
            
            100% {
                transform: translateY(-1000px) rotate(720deg);
                opacity: 0;
                border-radius: 50%;
            }
        }
        
        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }
        
        .input-icon {
            position: absolute;
            right: 20px;
            top: 50%;
            transform: translateY(-50%);
            color: rgba(255, 255, 255, 0.7);
        }
        
        /* Responsive adjustments */
        @media (max-width: 768px) {
            .login-container {
                width: 90%;
                padding: 30px;
            }
        }
    </style>
</head>

<body>
    <!-- Animated Background Elements -->
    <ul class="circles">
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
        <li></li>
    </ul>
    
    <div class="login-container">
        <div class="login-header">
            <h2><i class="fas fa-book-open"></i> Perpustakaan Digital</h2>
            <p>Masuk untuk mengakses sistem</p>
        </div>
        
        <form role="form" action="<?= base_url('admin/autentikasi-login');?>" method="post">
            <div class="form-group">
                <input class="form-control" placeholder="Username" name="username" type="text" autofocus>
                <i class="fas fa-user input-icon"></i>
            </div>
            <div class="form-group">
                <input class="form-control" placeholder="Password" name="password" type="password">
                <i class="fas fa-lock input-icon"></i>
            </div>
            <div class="remember-me">
                <label>
                    <input name="remember" type="checkbox" value="Remember Me"> Ingat Saya
                </label>
            </div>
            <button type="submit" class="btn-login">Masuk <i class="fas fa-arrow-right"></i></button>
        </form>
    </div>

    <!-- Scripts -->
    <script src="/Assets/js/jquery-1.11.1.min.js"></script>
    <script src="/Assets/js/bootstrap.min.js"></script>
    <script src="/Assets/js/sweetalert2.min.js"></script>
    
    <?php if (session()->getFlashdata('success')) : ?>
    <script type="text/javascript">
        $(document).ready(function () {
            Swal.fire({
                title: 'Success!',
                text: "<?php echo session()->getFlashdata('success'); ?>",
                icon: 'success',
                background: 'rgba(255, 255, 255, 0.9)',
                backdrop: `
                    rgba(0,0,123,0.4)
                    url("https://sweetalert2.github.io/images/nyan-cat.gif")
                    left top
                    no-repeat
                `
            });
        });
    </script>
    <?php endif; ?>
    
    <?php if (session()->getFlashdata('error')) : ?>
    <script type="text/javascript">
        $(document).ready(function () {
            Swal.fire({
                title: 'Error!',
                text: "<?php echo session()->getFlashdata('error'); ?>",
                icon: 'error',
                background: 'rgba(255, 255, 255, 0.9)',
                showConfirmButton: true,
                confirmButtonText: 'Coba Lagi',
                allowOutsideClick: false
            });
        });
    </script>
    <?php endif; ?>
    
    <?php if (session()->getFlashdata('info')) : ?>
    <script type="text/javascript">
        $(document).ready(function () {
            Swal.fire({
                title: 'Info',
                text: "<?php echo session()->getFlashdata('info'); ?>",
                icon: 'info',
                background: 'rgba(255, 255, 255, 0.9)',
                showConfirmButton: true,
                confirmButtonText: 'OK',
                timer: 5000,
                timerProgressBar: true
            });
        });
    </script>
    <?php endif; ?>
    
    <script>
        // Add floating animation to the login container
        $(document).ready(function() {
            function floatAnimation() {
                $('.login-container').animate({
                    'margin-top': '+=10px'
                }, 1500).animate({
                    'margin-top': '-=10px'
                }, 1500, floatAnimation);
            }
            
            floatAnimation();
            
            // Add focus effects
            $('.form-control').focus(function() {
                $(this).parent().find('.input-icon').css('color', 'white');
            }).blur(function() {
                $(this).parent().find('.input-icon').css('color', 'rgba(255, 255, 255, 0.7)');
            });
        });
    </script>
</body>
</html>