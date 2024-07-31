<!DOCTYPE html>
<html>
    <head>
        <title>QR Codes</title>
        <style>
            h2 {
                text-align: center;
            }
            .qr-container {
                display: flex;
                flex-direction: column;
                align-items: center;
                justify-content: center;
                gap: 100px;
            }
        </style>
    </head>
    <body>
        <h2>QR Codes</h2>
        <div class="qr-container">
            @foreach ($tanaman as $tm)
                <div class="qr-code">
                    <img src="{{ storage_path('app/public/qr/' . $tm->qrPath) }}" alt="QR Code">
                    <div>{{ $tm->url }}</div>
                </div><br><br><br>
            @endforeach
        </div>
    </body>
</html>
