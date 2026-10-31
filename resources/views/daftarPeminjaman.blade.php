<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Rapat Kerja</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <style>
        body {
            background: url("{{ asset('assets/images/BANNER RAPAT.png') }}") no-repeat center center fixed;
            background-size: cover;
            color: white;
            text-align: center;
            font-family: Arial, sans-serif;
        }
        .container {
            text-align: center;
            margin-top: 90px;
        }
        .title {
            margin-top: 50px;
            font-size: 2.5rem;
            font-weight: bold;
            color: #000000;
        }
        .title2 {
            margin-top: 10px;
            font-size: 2.2rem;
            font-weight: bold;
            color: #ff0000;
            font-family: 'Roboto', sans-serif;
        }
        .subtitle {
            width: 70%;
            margin: 40px auto; 
            color: #000000;
            font-size: 30px;
            font-weight: bold;
            line-height: 1.5;
            margin-bottom: 2em;
                /* Batas 4 baris teks */
            display: -webkit-box;
            -webkit-line-clamp: 4; /* Batasi hanya 4 baris */
            -webkit-box-orient: vertical; /* Agar pemotongan berdasarkan baris vertikal */
            overflow: hidden; /* Sembunyikan teks yang melebihi batas */
        }
        .address {
            font-size: 25px;
            font-weight: bold;
            color: #000000;
        }
        .logo-container {
            background-color: #b61111;
            display: inline-block;
            padding: 20px;
            border-radius: 50px;
        }
        .logo-container img {
            margin: 0 20px;
        }
        .footer-social ul {
            list-style: none;
            padding: 0;
            margin: 0;
            display: flex;
            gap: 15px;
            justify-content: center;
        }
        .footer-social ul li a {
            color: black;
            font-size: 24px;
        }
        .footer-area {
        position: fixed;
        bottom: 0;
        left: 0;
        width: 100%;
        padding: 20px 0;
        z-index: 100;
    }

    </style>
</head>
<body>
    <div class="container">
        <div class="logo-container justify-content-center align-items-center">
            <img src="{{ asset('assets/images/Logo Pemkab Malang.png') }}" alt="Logo 1" width="50">
            <img src="{{ asset('assets/images/Logo Malang Makmur.png') }}" alt="Logo 2" width="100">
        </div>

        <h1 class="title">RAPAT KERJA</h1>
        <h1 class="title2">
            Bidang {{ $activeRent?->user?->name ?? 'Belum ada data' }} Diskominfo Malang
        </h1>
        

        @if($activeRent)
            <p class="subtitle">{{ $activeRent->purpose }}</p>
            <div class="address">
                {{ \Carbon\Carbon::parse($activeRent->time_start_use)->translatedFormat('d F Y - H:i') }} 
                s/d 
                {{ \Carbon\Carbon::parse($activeRent->time_end_use)->translatedFormat('H:i') }}
            </div>
        @else
            <p class="subtitle">Tidak ada jadwal rapat saat ini.</p>
        @endif

        <footer id="footer" class="footer-area pt-50">
            <div class="container">
                <div class="footer-credit d-flex align-items-center justify-content-center flex-wrap">
                    <!-- Media Sosial -->
                    <div class="footer-social d-flex align-items-center">
                        <ul class="d-flex list-unstyled mb-0">
                            <li>
                                <a href="https://www.facebook.com/kominfomalang/?locale=id_ID" target="_blank">
                                    <i class="fab fa-facebook"></i>
                                </a>
                            </li>
                            <li>
                                <a href="https://twitter.com/KominfoKabMlg/status/1856978455898066979" target="_blank">
                                    <i class="fab fa-twitter"></i>
                                </a>
                            </li>
                            <li>
                                <a href="https://www.instagram.com/kominfokabmlg?igsh=MWxrZ3BibjFlNWJlZQ==" target="_blank">
                                    <i class="fab fa-instagram"></i>
                                </a>
                            </li>
                            <li>
                                <a href="https://www.tiktok.com/@kominfokabmlg?_t=ZS-8tZyOOpalwl&_r=1" target="_blank">
                                    <i class="fab fa-tiktok text-dark"></i>
                                </a>
                            </li>
                            <li>
                                <a href="https://kominfo.malangkab.go.id" target="_blank">
                                    <i class="fab fa-instagram"></i>
                                </a>
                            </li>
                        </ul>
                    </div>
        
                    <!-- Pemisah | -->
                    <span class="text-dark px-2">|</span>
        
                    <!-- Teks Copyright -->
                    <div class="text-dark">
                        <span>Copyrights © 2025 Diskominfo Kabupaten Malang</span> | 
                        <span>Jl. KH Agus Salim No.7</span>
                    </div>
                </div>
            </div>
        </footer>
        
    </div>
</body>
</html>
