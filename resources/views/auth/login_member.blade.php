<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-200">
    <div class="flex py-10 md:py-20 px-5 md:px-32 min-h-screen">
        <div class="flex flex-col lg:flex-row w-full shadow bg-white p-10 md:px-20">
            <div class="w-full lg:w-1/2 lg:pr-10">
                <h1 class="font-bold text-xl text-gray-700">Login Page</h1>
                <p class="text-gray-600">Please login to start your session!</p>
                <br>
                @if (Session::has('success'))
                    <p style="color: green">{{ Session::get('success') }}</p>
                @endif
                @if (Session::has('failed'))
                    <p style="color: red">{{ Session::get('failed') }}</p>
                @endif
                @if ($errors->any())
                    <div style="color: red">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <form action="/login_member_action" method="POST" class="mt-10" id="loginForm">
                    @csrf
                    <div class="my-3">
                        <label class="font-semibold" for="email">E-mail</label>
                        <input type="email" placeholder="yourmail@example.com" name="email" id="email"
                            class="block border-2 rounded-full mt-2 py-2 px-5 w-full" required>
                        <span id="emailError" style="color: red; display: none;">Please enter a valid email address.</span>
                    </div>
                    <div class="my-3">
                        <label class="font-semibold" for="password">Password</label>
                        <input type="password" placeholder="password" name="password" id="password"
                            class="block border-2 rounded-full mt-2 py-2 px-5 w-full" required>
                        <span id="passwordError" style="color: red; display: none;">Please enter your password.</span>
                        <span id="credentialError" style="color: red; display: none;">Email or password is incorrect.</span>
                    </div>
                    <div class="flex justify-between items-center">
                        <div class="flex items-center">
                            <input type="checkbox" name="remember_me" id="remember_me"
                                class="rounded-full text-blue-400 cursor-pointer">
                            <label for="remember_me" class="ml-2 text-gray-700">Remember Me</label>
                        </div>
                        <a href="/forgot_password" class="text-blue-400 hover:text-blue-600">Forgot password?</a>
                    </div>
                    <div class="my-5">
                        <button type="button" onclick="validateForm()"
                            class="w-full rounded-full bg-blue-400 hover:bg-blue-600 text-white py-2">LOGIN</button>
                    </div>
                </form>
                <span class="text-gray-700">Don't have an account? <a href="/register_member"
                        class="text-blue-400 hover:text-blue-600">Create here.</a></span>
            </div>
            <div class="w-full lg:w-1/2 lg:flex lg:justify-center lg:items-center">
                <img src="images/logo.png" alt="Logo" />
            </div>
        </div>
    </div>

    <script>
        function validateForm() {
            var email = document.getElementById("email").value;
            var password = document.getElementById("password").value;
            var isValid = true;

            if (!email || !validateEmail(email)) {
                document.getElementById("emailError").style.display = "block";
                isValid = false;
            } else {
                document.getElementById("emailError").style.display = "none";
            }

            if (!password) {
                document.getElementById("passwordError").style.display = "block";
                isValid = false;
            } else {
                document.getElementById("passwordError").style.display = "none";
            }

            if (isValid) {
                document.getElementById("loginForm").submit();
            }
        }

        function validateEmail(email) {
            // Simple email validation regex
            var re = /\S+@\S+\.\S+/;
            return re.test(email);
        }
    </script>
</body>

</html>
