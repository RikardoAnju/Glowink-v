<!doctype html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login</title>
  <script src="https://cdn.tailwindcss.com"></script>

  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700&display=swap" rel="stylesheet">
  <style>
    body {
      font-style: normal;
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
  </style>
</head>
<body>

<div class="container mx-auto">
    <div class="card">
        <img src="images/logo.png" alt="Logo" />
        <h3 class="card-title">LOGIN</h3>
        @if ($errors->any())
        <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded relative" role="alert">
            <strong class="font-bold">Error:</strong>
            <span class="absolute top-0 bottom-0 right-0 px-4 py-3">
                <svg class="fill-current h-6 w-6 text-red-500" role="button" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20"><title>Close</title><path d="M14.348 14.849a1.2 1.2 0 0 1-1.697 0L10 11.819l-2.651 3.029a1.2 1.2 0 1 1-1.697-1.697l2.758-3.15-2.759-3.152a1.2 1.2 0 1 1 1.697-1.697L10 8.183l2.651-3.031a1.2 1.2 0 1 1 1.697 1.697l-2.758 3.152 2.758 3.15a1.2 1.2 0 0 1 0 1.698z"/></svg>
            </span>
            <p>{{ $errors->first() }}</p>
        </div>
        @endif
        <form action="login" method="POST">
            <input type="hidden" name="_token" value="{{ csrf_token() }}">
            <div class="form-group">
                <label for="email">Email</label>
                @error('email')
                    <div class="error">{{ $message }}</div>
                @enderror
                <input type="text" id="email" name="email" placeholder="Email" class="@error('email') error @enderror">
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" id="password" name="password" placeholder="Password" class="@error('password') error @enderror">
                @error('password')
                    <div class="error">{{ $message }}</div>
                @enderror
            </div>
            <button type="submit" class="btn">Login</button>
        </form>
    </div>
</div>

</body>
</html>
