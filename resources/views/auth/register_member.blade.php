<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Page</title>
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.16/dist/tailwind.min.css" rel="stylesheet">
</head>

<body class="bg-gray-200">
    <div class="flex py-10 md:py-20 px-5 md:px-32 min-h-screen">
        <div class="flex flex-col lg:flex-row w-full shadow bg-white p-10 md:px-20">
            <div class="w-full lg:w-1/2 bg-white p-10 px-5 md:px-20">
                <h1 class="font-bold text-xl text-gray-700">Register</h1>
                @if (Session::has('errors'))
                    <ul>
                         @foreach (Session::get('errors') as $error)
                         <li style="color: red">{{ is_array($error) ? implode(", ", $error) : $error }}</li>
                         @endforeach
                        
                    </ul>
                        @endif
                <form action="/register_member" class="mt-10" method="POST" onsubmit="return validatePassword();">
                    @csrf
                    <div class="my-3">
                        <label class="font-semibold" for="nama_member">Nama Member</label>
                        <input required type="text" placeholder="Nama Member" name="nama_member" id="nama_member"
                            class="block border-2 rounded-full mt-2 py-2 px-5 w-full">
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="my-3">
                            <label class="font-semibold" for="provinsi">Provinsi</label>
                            <input required type="text" placeholder="Provinsi" name="provinsi" id="provinsi"
                                class="block border-2 rounded-full mt-2 py-2 px-5 w-full">
                        </div>
                        <div class="my-3">
                            <label class="font-semibold" for="kabupaten">Kabupaten</label>
                            <input required type="text" placeholder="Kabupaten" name="kabupaten" id="kabupaten"
                                class="block border-2 rounded-full mt-2 py-2 px-5 w-full">
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="my-3">
                            <label class="font-semibold" for="kecamatan">Kecamatan</label>
                            <input required type="text" placeholder="Kecamatan" name="kecamatan" id="kecamatan"
                                class="block border-2 rounded-full mt-2 py-2 px-5 w-full">
                        </div>
                        <div class="my-3">
                            <label class="font-semibold" for="detail_alamat">Detail Alamat</label>
                            <input required type="text" placeholder="Detail Alamat" name="detail_alamat" id="detail_alamat"
                                class="block border-2 rounded-full mt-2 py-2 px-5 w-full">
                        </div>
                    </div>
                    <div class="my-3">
                        <label class="font-semibold" for="no_hp">No Hp</label>
                        <input required type="text" placeholder="Your Number Phone" name="no_hp" id="no_hp"
                            class="block border-2 rounded-full mt-2 py-2 px-5 w-full">
                    </div>
                    <div class="my-3">
                        <label class="font-semibold" for="email">Email</label>
                        <input required type="email" placeholder="example@gmail.com" name="email" id="email"
                            class="block border-2 rounded-full mt-2 py-2 px-5 w-full">
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="my-3">
                            <label class="font-semibold" for="password">Password</label>
                            <input required type="password" placeholder="Password" name="password" id="password"
                                class="block border-2 rounded-full mt-2 py-2 px-5 w-full">
                        </div>
                        <div class="my-3">
                            <label class="font-semibold" for="konfirmasi">Konfirmasi Password</label>
                            <input required type="password" placeholder="Konfirmasi Password" name="konfirmasi_password" id="konfirmasi_password"
                                class="block border-2 rounded-full mt-2 py-2 px-5 w-full">
                        </div>
                    </div>
                    <div class="my-5">
                        <button type="submit" class="w-full rounded-full bg-blue-400 hover:bg-blue-600 text-white py-2">REGISTER</button>
                    </div>
                </form>
                <span class="text-gray-700">Already have an account? <a href="/login_member" class="text-blue-400 hover:text-blue-600">Login here.</a></span>
            </div>
            <div class="w-full lg:w-1/2 flex justify-center items-center">
                <img src="images/logo.png" alt="Logo" class="w-full max-h-96">
            </div>
        </div>
    </div>
</body>

<script>
    function validatePassword() {
        var password = document.getElementById("password").value;
        var confirmPassword = document.getElementById("konfirmasi_password").value;

        // Regex untuk memeriksa keberadaan huruf besar, huruf kecil, dan angka dalam password
        var uppercaseRegex = /[A-Z]/;
        var lowercaseRegex = /[a-z]/;
        var numberRegex = /[0-9]/;

        if (!uppercaseRegex.test(password) || !lowercaseRegex.test(password) || !numberRegex.test(password)) {
            showMessage("Password harus mengandung setidaknya satu huruf besar, satu huruf kecil, dan satu angka.");
            return false;
        }

        if (password !== confirmPassword) {
            showMessage("Password dan konfirmasi password tidak cocok.");
            return false;
        }

        return true;
    }

    function showMessage(message) {
        alert(message);
    }
</script>


</html>
