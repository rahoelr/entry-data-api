<!DOCTYPE html>
<html>

<head>
    <title>Data Entry Registration</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            color: #000000;
        }

        .container {
            max-width: 600px;
            margin: 20px auto;
            text-align: center;
        }

        .title {
            color: #605BFF;
            font-size: 28px;
            margin-top: 20px;
        }

        .content-box {
            background: white;
            padding: 20px;
            margin-bottom: 20px;
        }

        .register-button {
            display: inline-block;
            background-color: #605BFF;
            color: #FFFFFF;
            padding: 15px 40px;
            text-decoration: none;
            border-radius: 16px;
            font-size: 18px;
            margin: 12px 0;
        }

        .footer-text {
            color: #666;
            font-size: 14px;
            margin-top: 12px;
        }

        .copyright {
            color: #666;
            font-size: 12px;
            margin-top: 8px;
        }
    </style>
</head>

<body>
    <div class="container">
        <h1 class="title">Data Entry Registration</h1>

        <div class="content-box">
            <h2>Halo, Pengguna!</h2>
            <p>Gunakan tombol berikut untuk menyelesaikan proses pendaftaran akun Anda:</p>

            <a href="https://cmsentity.nolimit.id/register/{{ $data['id'] }}" class="register-button">Lengkapi Pendaftaran</a>

            <p>Jika Anda tidak merasa melakukan pendaftaran akun, abaikan email ini.</p>
        </div>

        <div class="copyright">© 2024 Data Entry. Hak Cipta Dilindungi.</div>
        <div class="footer-text">Email ini dikirim secara otomatis, mohon tidak membalas email ini.</div>
    </div>
</body>

</html>