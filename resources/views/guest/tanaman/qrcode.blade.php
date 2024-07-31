<!DOCTYPE html>
<html>
<head>
    <title>QR Code Page</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            background-image: url('/images/background-qr.png'); /* Path to your background image */
            background-size: cover;
            background-position: center;
            display: flex;
            justify-content: center;
            align-items: center;
            height: 100vh;
            width: 100vw;
        }
        .container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            width: 100%;
            padding: 20px;
            box-sizing: border-box;
        }
        .text {
            flex: 1;
            padding-left: 200px;
        }
        .text h1 {
            margin: 0;
            font-size: 45px;
            color: #333;
        }
        .text h2 {
            margin: 10px 0 0 0;
            font-size: 30px;
            color: #555;
        }
        .qrcode-container {
            flex: 0 0 300px;
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
        }
            .qrcode {
            width: 500px;
            height: 400px;
            display: flex;
            justify-content: center;
            align-items: center;
            /* margin-bottom: 10px; */
            padding-right: 200px;
        }
        .qrcode img {
            max-width: 100%;
            max-height: 100%;
        }
        .link {
            font-size: 14px;
            color: #000;
            word-break: break-all;
            text-align: center;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="text">
            <h1>Nama Tanaman</h1>
            <h2>Nama Latin</h2>
        </div>
        <div class="qrcode-container">
            <div class="qrcode">
                {!! $qrCode !!}
            </div>
            <div class="link">
                {{ $url }}
            </div>
        </div>
    </div>
</body>
</html>
