<!DOCTYPE html>
<html>
    <head>
        <title>QR Code Page</title>
        <style>
            body {
                display: flex !important;
                flex-direction: column !important;
                justify-content: center !important;
                align-items: center !important;
                gap: 20px !important;
                font-family: Arial, sans-serif !important;
                margin: 0 !important;
                width: 210mm !important;
            }
            .container {
                background-color: #f0eaa7 !important;
                display: flex !important;
                flex-direction: row !important;
                justify-content: space-between !important;
                align-items: center !important;
                width: 175mm !important;
                height: 68mm !important;
                padding: 20px !important;
                margin: 5mm 0 5mm 0 !important;
                box-sizing: border-box !important;
                background-image: url('/images/background-qr.png') !important;
                background-size: cover !important;
                background-position: center !important;
            }
            .text {
                width: 100% !important;
                flex: 1 !important;
            }
            .text h1 {
                width: fit-content !important;
                margin: 0 !important;
                font-size: 30px !important;
                color: #333 !important;
            }
            .text h2 {
                width: fit-content !important;
                margin: 10px 0 0 0 !important;
                font-size: 20px !important;
                color: #555 !important;
            }
            .qrcode-container {
                width: 100% !important;
                display: flex !important;
                flex-direction: column !important;
                justify-content: center !important;
                align-items: center !important;
            }
            .qrcode {
                width: 60% !important;
                display: flex !important;
                justify-content: center !important;
                align-items: center !important;
            }
            .qrcode img {
                max-width: 100% !important;
                max-height: 100% !important;
            }
            .link {
                /* padding: 0 !important; */
                /* margin: -30px 0 0 0 !important; */
                width: 60% !important;
                font-size: 10px !important;
                color: #000 !important;
                word-break: break-all !important;
                text-align: right !important;
            }
        </style>
    </head>
    <body>
        @foreach ($tanaman as $tm)
            <div class="container">
                <div class="text">
                    <h1>{{ $tm->nama }}</h1>
                    <h2>{{ $tm->nama_latin }}</h2>
                </div>
                <div class="qrcode-container">
                    <div class="qrcode">
                        <img src="{{ storage_path('app/public/qr/' . $tm->qrPath) }}" alt="QR Code">
                        {{-- {!! $tm->qr !!} --}}
                    </div>
                    <div class="link">
                        {{ $tm->url }}
                    </div>
                </div>
            </div>
        @endforeach
    </body>
</html>
