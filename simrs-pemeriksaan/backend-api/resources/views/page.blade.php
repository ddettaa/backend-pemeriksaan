<!DOCTYPE html>
<html lang="id">
<head>
  <meta charset="UTF-8">
  <title>Kami Telah Pindah</title>
  <style>
    body, html {
      height: 100%;
      margin: 0;
      font-family: Arial, sans-serif;
      background: url('{{ asset('login-bg.png') }}') no-repeat center center fixed;
      background-size: cover;
      display: flex;
      align-items: center;
      justify-content: center;
      position: relative;
    }

    .info-box {
      background-color: white;
      padding: 40px 60px;
      border-radius: 12px;
      box-shadow: 0 4px 20px rgba(0,0,0,0.2);
      text-align: center;
      max-width: 500px;
    }

    .info-box h1 {
      margin-top: 0;
      color: #2c3e50;
    }

    .info-box a {
      display: inline-block;
      margin-top: 15px;
      padding: 10px 20px;
      background-color: #3A6065;
      color: white;
      text-decoration: none;
      border-radius: 6px;
      font-weight: bold;
    }

    .info-box a:hover {
      background-color: #73B2BB;
    }

    .api-doc-link {
      position: fixed;
      bottom: 20px;
      right: 20px;
      background-color: #3A6065;
      color: #fff;
      padding: 10px 16px;
      border-radius: 6px;
      font-size: 14px;
      text-decoration: none;
      font-weight: bold;
      z-index: 1000;
      transition: background-color 0.3s;
    }
    
    .api-doc-link:hover {
      background-color: #73B2BB;
    }
  </style>
</head>
<body>

  <div class="info-box">
    <h1>Kami Telah Pindah!</h1>
    <p>Silakan kunjungi halaman baru kami di:</p>
    <a href="https://frontend-pemeriksaan.vercel.app" target="_blank">Kunjungi Situs Baru</a>
  </div>

  <!-- Tombol dokumentasi API di pojok kiri bawah -->
  <a class="api-doc-link" href="/docs" target="_blank">Dokumentasi API</a>

</body>
</html>
