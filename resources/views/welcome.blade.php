<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SIZIS - </title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
    <style>
        body {
            margin: 0;
            font-family: 'Inter', sans-serif;
            background-color: #171f2e; /* Warna latar belakang abu-abu muda */
            color: #1f2937;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
        }
        .container {
            text-align: center;
            padding: 2rem;
        }
        h1 {
            font-size: 2.25rem; /* 36px */
            font-weight: 700;
            max-width: 600px;
            line-height: 1.2;
            color:rgb(255, 255, 255);
        }
        .button {
            display: inline-block;
            margin-top: 2rem;
            padding: 0.875rem 2rem; /* 14px 32px */
            background-color: #f59e0b; /* Warna biru */
            color: white;
            font-weight: 600;
            text-decoration: none;
            border-radius: 0.5rem; /* 8px */
            transition: background-color 0.2s;
        }
        .button:hover {
            background-color: #fbbf24; /* Warna biru lebih gelap saat hover */
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Sistem Informasi Pengelolaan Zakat, Infaq, dan Shodaqoh Lazismu Unit Layanan Wage</h1>
        <a href="{{ url('/admin') }}" class="button">Masuk ke Aplikasi</a>
    </div>
</body>
</html>