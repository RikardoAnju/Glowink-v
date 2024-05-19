<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <script src="https://cdn.tailwindcss.com"></script>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700&display=swap" rel="stylesheet">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <meta name="csrf-token" content="{{ csrf_token() }}">

  <style>
    body {
      font-family: 'Poppins', sans-serif; /* Menggunakan font Poppins */
      background-color: #A0CADB;
      margin: 0;
      padding: 0;
    }
    .container {
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }
    .card {
      width: 400px;
      padding: 20px;
      background-color: #FFF;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
      border-radius: 8px;
      position: relative;
    }
    .card img {
      display: block;
      margin: 0 auto;
      width: 150px;
      height: auto;
      margin-bottom: 20px;
    }
    .card-title {
      text-align: center;
      font-size: 24px;
      font-weight: bold;
      margin-bottom: 20px;
    }
    .form-group {
      margin-bottom: 20px;
    }
    .form-group label {
      display: block;
      font-weight: bold;
    }
    .form-group input {
      width: 95%;
      padding: 10px;
      border: 1px solid #ccc;
      border-radius: 5px;
      outline: none;
    }
    .error {
      color: #ff0000;
      margin-top: 5px;
    }
    .btn {
      width: 95%;
      padding: 10px;
      background-color: #f06292;
      color: #FFF;
      border: none;
      border-radius: 5px;
      cursor: pointer;
      outline: none;
    }
    .btn:hover {
      background-color: #ec407a;
    }
    .loading {
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      display: none;
    }
    .loading-spinner {
      border: 4px solid rgba(0, 0, 0, 0.1);
      width: 36px;
      height: 36px;
      border-radius: 50%;
      border-top-color: #f06292;
      animation: spin 1s ease-in-out infinite;
    }
    @keyframes spin {
      to {
        transform: rotate(360deg);
      }
    }
  </style>
</head>
<body>

<div class="container mx-auto">
    <div class="card">
        <img src="images/logo.png" alt="Logo" />
        <h3 class="card-title">LOGIN</h3>
        <form class="form-login user" method="POST" action="/login">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="form-group">
                <label for="email">Email</label>
                @error('email')
                    <div class="error">{{ $message }}</div>
                @enderror
                <input type="text" id="email" name="email" placeholder="Email" class="email @error('email') error @enderror">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Password" class="password @error('password') error @enderror">
                @error('password')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn">Login</button>
        </form>
        <div class="loading">
            <div class="loading-spinner"></div>
        </div>
    </div>
</div>

<script>
    $(function (){
        function setCookie(name, value, days) {
            var expires = "";
            if (days) {
                var date = new Date();
                date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
                expires = "; expires=" + date.toUTCString();
            }
            document.cookie = name + "=" + (value || "") + expires + "; path=/";
        }

        $('.form-login').submit(function(e){
            e.preventDefault();
            const email = $('.email').val();
            const password = $('.password').val();
            const csrf_token = $('meta[name="csrf-token"]').attr('content');

            $('.loading').show(); // Show the loading indicator

            $.ajax({
                url : '/login',
                type : 'POST',
                data : {
                    email : email,
                    password : password,
                    _token : csrf_token
                },
                success : function(data){
                    if (data.success) {
                        localStorage.setItem('token', data.token); // Menggunakan setItem untuk menyimpan token
                        setTimeout(function() {
                            $('.loading').hide(); // Hide the loading indicator
                            window.location.href = '/adminpage';
                        }, 3000); // Wait for 3 seconds before redirecting
                    } else {
                        $('.loading').hide(); // Hide the loading indicator
                        alert(data.message ? data.message : 'Email or password is wrong');
                    }
                },
                error: function() {
                    $('.loading').hide(); // Hide the loading indicator on error
                    alert('An error occurred. Please try again.');
                }
            });
        });
    });
</script>

</body>
</html>
