<!DOCTYPE html>
<html>

<head>
    <title>Invoice Lunas</title>
</head>

<style>
    body {
        font-family: 'Courier New', monospace;
    }
</style>

<body>
    <div style="width:100%;text-align:center">
        <img style="width:200px" src="{{ public_path('images/savana/logo.png') }}" />
    </div>
    <h2 style="text-align:center">{{ $title }}</h2>
    <div style="width:100%;margin-top:20px">
        <table style="width:100%;font-size:14px">
            <tr>
                <td style="width:10%">
                    Nama
                </td>
                <td style="width:1%">
                    :
                </td>
                <td style="width:30%">
                    Nur Hudha Haksono
                </td>
                <td style="width:19%">
                    Tanggal Acara
                </td>
                <td style="width:1%">
                    :
                </td>
                <td style="width:39%">
                    21-12-2022
                </td>
            </tr>
            <!-- Jarak -->
            <tr>
                <td style="height:20px;">
                </td>
                <td>
                </td>
                <td>
                </td>
                <td>
                </td>
                <td>
                </td>
                <td>
                </td>
            </tr>
            <tr>
                <td>
                    No. HP
                </td>
                <td>
                    :
                </td>
                <td>
                    08387722798
                </td>
                <td>
                    Tempat Acara
                </td>
                <td>
                    :
                </td>
                <td>
                    Jl. Mangga 2 No 29, Kelurahan Jati Makmur, Kecamatan Pondok Gede, Bekasi
                </td>
            </tr>
        </table>
    </div>
    <div style="width:100%;margin-top:30px">
        <table style="width: 100%;border-collapse:collapse" border="1">
            <thead style="font-weight:bold;background:#c49b63">
                <tr>
                    <td style="width: 80%;text-align:center">
                        Nama Produk/Paket
                    </td>
                    <td style="width: 30%;text-align:center">
                        Harga
                    </td>
                </tr>
            </thead>
            <tbody>
                <!-- Product -->
                <tr>
                    <td style="text-align: left;">
                        Engagement - Stepa
                    </td>
                    <td style="text-align: right;font-weight:bold">
                        Rp. 5.000.000
                    </td>
                </tr>
                <!-- IF Discount -->
                <tr>
                    <td style="text-align: left;">
                        Discount
                    </td>
                    <td style="text-align: right;color: red;font-weight:bold">
                        - Rp. 100.000
                    </td>
                </tr>
                <!-- Total -->
                <tr>
                    <td style="text-align: left;">
                        Total Dibayarkan
                    </td>
                    <td style="text-align: right;color: green;font-weight:bold">
                        Rp. 4.900.000
                    </td>
                </tr>
            </tbody>
        </table>
    </div>
    <div style="width:100%;text-align:right;margin-top:30px">
        <img style="width:150px" src="{{ public_path('images/stempel/lunas.png') }}" />
    </div>
</body>

</html>