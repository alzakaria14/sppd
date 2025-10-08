
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Kominfo</title>
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/7.0.1/css/all.min.css">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            background-color: #f0f2f5;
        }

        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 50px;
            background-color: #fff;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .navbar .logo {
            display: flex;
            align-items: center;
        }

        .navbar .logo img {
            height: 40px;
            margin-right: 10px;
        }

        .navbar .logo span {
            font-size: 24px;
            font-weight: 700;
            color: #004d99;
        }

        .navbar .nav-links {
            display: flex;
            align-items: center;
            list-style: none;
            margin: 0;
            padding: 0;
        }

        .navbar .nav-links li {
            margin-right: 25px;
        }

        .navbar .nav-links li a {
            text-decoration: none;
            color: #555;
            font-weight: 500;
            transition: color 0.3s ease;
        }

        .navbar .nav-links li a:hover {
            color: #004d99;
        }

        .navbar .btn-masuk {
            padding: 8px 20px;
            background-color: #004d99;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            font-weight: 500;
            transition: background-color 0.3s ease;
        }

        .navbar .btn-masuk:hover {
            background-color: #003366;
        }

        .header-content {
            background: linear-gradient(rgba(0, 77, 153, 0.5), rgba(0, 77, 153, 0.5)), url('https://via.placeholder.com/1500x500.png?text=Latar+Belakang+Kota') no-repeat center center/cover;
            color: #fff;
            height: 800px;
            display: flex;
            justify-content: center;
            align-items: center;
            text-align: center;
            /* position: relative; */
        }

        .header-box {
            background-color: #fff;
            color: #333;
            padding: 40px 60px;
            border-radius: 10px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.1);
            max-width: 700px;
        }

        .header-box h1 {
            font-size: 2.5em;
            margin-bottom: 10px;
            color: #004d99;
        }

        .header-box .underline {
            width: 50px;
            height: 3px;
            background-color: #004d99;
            margin: 10px auto 20px;
        }

        .header-box p {
            font-size: 1.1em;
            line-height: 1.6;
            color: #555;
        }

        .footer {
            background-color: #004d99;
            color: #fff;
            padding: 20px 50px;
            text-align: center;
            position: relative;
            bottom: 0;
            /* max-width: 700px; */
        }

        .footer .footer-top {
            font-size: 0.9em;
            margin-bottom: 10px;
        }

        .footer .footer-contact {
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .footer .footer-contact a {
            color: #fff;
            text-decoration: none;
            margin: 0 10px;
            font-size: 0.9em;
            transition: color 0.3s ease;
        }

        .footer .footer-contact a:hover {
            color: #ccc;
        }

        .social-icons a {
            margin: 0 5px;
            color: #fff;
            font-size: 1.2em;
            transition: color 0.3s ease;
        }

        .social-icons a:hover {
            color: #ccc;
        }

        .logo-small {
            height: 20px;
            vertical-align: middle;
            margin-right: 5px;
        }

        /* Responsive design adjustments */
        @media (max-width: 768px) {
            .navbar {
                flex-direction: column;
                padding: 15px 20px;
            }

            .navbar .nav-links {
                margin-top: 15px;
                flex-direction: column;
            }

            .navbar .nav-links li {
                margin: 5px 0;
            }

            .navbar .btn-masuk {
                margin-top: 10px;
            }

            .header-box {
                padding: 30px 40px;
                max-width: 90%;
            }

            .header-box h1 {
                font-size: 2em;
            }

            .header-box p {
                font-size: 1em;
            }

            .footer .footer-contact {
                flex-direction: column;
            }
        }
    </style>
</head>
<body>

    <nav class="navbar">
        <div class="logo">
            <img src="views/assets/img/logo.png" alt="Logo">
            <!-- <span>Kominfo.info</span> -->
        </div>
        <ul class="nav-links">
            <li><a href="#">Beranda</a></li>
            <li><a href="#">Tentang Kami</a></li>
            <li><a href="#">Hubungi Kami</a></li>
            <li><a href="#">Media</a></li>
            <li><a href="#">Kontak</a></li>
        </ul>
        <a href="views" class="btn-masuk">Masuk</a>
    </nav>

    <header class="header-content">
        <div class="header-box">
            <h1>TENTANG KAMI</h1>
            <div class="underline"></div>
            <p>
                Layanan ini dibuat untuk memudahkan pegawai dalam membuat dan mengakses SPPD di Dinas Komunikasi dan Informasi HSS.
                Kritik dan saran sangat kami hargai demi peningkatan kualitas layanan kami, salam.
            </p>
        </div>
    </header>

    <footer class="footer">
        <div class="footer-top">
            Diskominfo Hulu Sungai Selatan
        </div>
        <div class="footer-contact">
            <a href="https://www.instagram.com/info.hss">
                <i class="fa-brands fa-instagram"></i> info.hss
            </a> |
            <a href="https://web.facebook.com/dinaskominfo.hss/">
                <i class="fa-brands fa-facebook-f"></i> dinaskominfo.hss
            </a> |
            <a href="https://www.youtube.com/channel/UCcoO9IAaRP_hDMAFJI5FUIg">
                <i class="fa-brands fa-youtube"></i> HSS TVnet
            </a>
            </a>
        </div>
    </footer>

</body>
</html>