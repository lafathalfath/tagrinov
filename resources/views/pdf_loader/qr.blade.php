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
                /* justify-content: space-between !important;
                align-items: center !important; */
                width: 175mm !important;
                height: 68mm !important;
                padding: 20px !important;
                margin: 5mm 0 5mm 0 !important;
            }
            h1 {
                width: fit-content !important;
                margin: 0 !important;
                font-size: 30px !important;
                color: #333 !important;
                word-break: none;
                word-wrap: break-word;
            }
            h2 {
                width: fit-content !important;
                margin: 10px 0 0 0 !important;
                font-size: 20px !important;
                color: #555 !important;
                word-break: none;
                word-wrap: nowrap;
            }
            .qrcode {
                width: 80mm !important;
                display: flex !important;
                justify-content: center !important;
                align-items: center !important;
            }
            .qrcode img {
                max-width: 65% !important;
                max-height: 65% !important;
            }
            .link {
                padding: 0 !important;
                margin: 1mm 0 0 0 !important;
                width: 60mm !important;
                font-size: 10px !important;
                color: #000 !important;
                word-break: break-all !important;
                word-wrap: break-word !important;
                text-align: left !important;
            }
            tr, td {
                height: 100%;
            }
            
        </style>
    </head>
    <body>
        @foreach ($tanaman as $tm)
            <div class="container">
                <table style="width: 100%;height: 100%;">
                    <tbody>
                        <tr>
                            <td style="width: 100mm !important;">
                                <h1>{{ $tm->nama }}</h1>
                                <h2>{{ $tm->nama_latin }}</h2>
                            </td>
                            <td>
                                <div class="qrcode">
                                    <img src="{{ asset('storage/qr/' . $tm->qrPath) }}" alt="QR Code untuk {{ $tm->nama }}">
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        @endforeach
    </body>
</html>
