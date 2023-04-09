<!DOCTYPE html>
<html lang="en">

@include('partials.head')

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <style>
        body {
            font-family: Arial, sans-serif;
            font-size: 14px;
            line-height: 1.5;

        }

        h1,
        h2,
        h3,
        h4,
        h5,
        h6 {
            font-weight: bold;
            margin: 0;
        }

        .container {
            max-width: 800px;
            margin: 10px auto;
            padding: 20px;
            border: 1px solid #ccc;
            border-radius: 5px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        table td,
        table th {
            padding: 10px;
            border: 1px solid #ccc;
            text-align: left;
        }

        table th {
            font-weight: bold;
            background-color: #f2f2f2;
        }

        .text-right {
            text-align: right;
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="row">
            <div class="col-4 text-center">
                <img src="{{ asset('img/Logo smkn 4.png') }}" width="100px" alt="">
            </div>
            <div class="col text-center">
                <h2 class="text-info uppercase title-kwitansi" style="margin-bottom: 0px">SMKN 4 TANGERANG</h2>
                <strong class="text-dark d-block" style="margin-bottom">PEMBAYARAN SPP DENGAN E-SPP</strong>
                <span>JL. Veteran No.1A Babakan Kota Tangerang</span>
            </div>
        </div>
        <hr>
        @foreach ($pembayaranList as $item)
            <small class="d-block d-flex justify-content-lg-start mt-2">Pembayaran ID :
                #SMKN4TNG-{{ $item->id }}</small>
            <div class="card-body">
                <h3 class="card-title uppercase text-dark text-bold d-block text-center ">Kwitansi Pembayaran</h3>
                <table>
                    <thead>
                        <tr>
                            <th>Tanggal Pembayaran</th>
                            <th>Jumlah Pembayaran</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $item->tanggal_bayar->format(' d/M/Y') }}</td>
                            <td>{{ currency_IDR($item->jumlah_dibayar) }}</td>
                        </tr>
                    </tbody>
                </table>
                <div class="">
                    <i class="d-block d-flex justify-content-lg-start text-dark ">Terbilang :
                        {{ ucwords(terbilang($item->jumlah_dibayar)) }}</i>
                    <span class="d-block d-flex justify-content-lg-start mt-2 mb-4 text-dark ">Tangerang,
                        {{ $item->tanggal_bayar->translatedFormat('d F Y') }}</span>
                    @foreach ($userList as $data)
                        @if ($data->id == $item->user_id)
                            <span class="d-block d-flex justify-content-lg-start text-dark capitalize"
                                style="margin-top: 100px">
                                {{ $data->name }}</span>
                        @endif
                    @endforeach
                </div>
                <footer class="mt-4 d-block d-flex justify-content-lg-end">
                    <p>Terima kasih atas pembayaran Anda.</p>
                </footer>
            </div>
        @endforeach
    </div>
</body>

<script>
    window.print();
</script>

@include('partials.script')

</html>
