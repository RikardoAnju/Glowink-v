n<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>
    <link rel="stylesheet" href="style.css">
    <style>
        body {
    font-family: sans-serif;
    margin: 0;
    padding: 0;
    background-color: #f0f0f0;
}

.container {
    background-color: #fff;
    padding: 30px;
    border-radius: 5px;
    box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
    max-width: 900px;
    margin: 0 auto;
}

.header {
    text-align: center;
    margin-bottom: 20px;
}

.header h1 {
    font-size: 24px;
    margin-bottom: 10px;
}

.header p {
    font-size: 16px;
    color: #777;
}

.row {
    margin-bottom: 15px;
}

.col-md-6 {
    width: 50%;
    float: left;
}

label {
    display: block;
    margin-bottom: 5px;
}

input[type="text"],
input[type="email"],
input[type="password"],
input[type="file"] {
    width: 100%;
    padding: 10px;
    border: 1px solid #ccc;
    border-radius: 3px;
    margin-bottom: 15px;
}

button {
    background-color: #4CAF50;
    color: white;
    padding: 10px 20px;
    border: none;
    border-radius: 3px;
    cursor: pointer;
    font-size: 16px;
}

button:hover {
    background-color: #45a049;
}

.footer {
    text
}
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Register</h1>
            <p>Silahkan isi formulir berikut untuk membuat akun baru.</p>
        </div>
        <form action="proses_register.php" method="post" enctype="multipart/form-data">
            <div class="row">
                <div class="col-md-6">
                    <label for="nama_lengkap">Nama Lengkap:</label>
                    <input type="text" id="nama_lengkap" name="nama_lengkap" required>
                </div>
                <div class="col-md-6">
                    <label for="username">Username:</label>
                    <input type="text" id="username" name="username" required>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label for="email">Email:</label>
                    <input type="email" id="email" name="email" required>
                </div>
                <div class="col-md-6">
                    <label for="password">Password:</label>
                    <input type="password" id="password" name="password" required>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6">
                    <label for="foto_profil">Foto Profil:</label>
                    <input type="file" id="foto_profil" name="foto_profil">
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <button type="submit">Daftar</button>
                </div>
            </div>
        </form>
        <div class="footer">
            <p>Sudah memiliki akun? <a href="login.html">Masuk disini</a></p>
        </div>
    </div>
</body>
</html>
