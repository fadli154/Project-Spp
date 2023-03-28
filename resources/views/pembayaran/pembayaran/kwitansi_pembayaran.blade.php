<!DOCTYPE html>
<html lang="en">

@include('partials.head')

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<body>
    <div class="card card-kwitansi text-center col-8 p-3">
        <div class="card-header row">
            <div class="col-3">
                <img src="{{ asset('img/Logo smkn 4.png') }}" width="100px" alt="">
            </div>
            <div class="col text-center">
                <h2 class="text-info uppercase title-kwitansi" style="margin-bottom: 0px">SMKN 4 TANGERANG</h2>
                <strong class="text-dark d-block" style="margin-bottom">PEMBAYARAN SPP DENGAN E-SPP</strong>
                <span>JL. Veteran No.1A Babakan Kota Tangerang</span>
            </div>
        </div>
        @foreach ($pembayaranList as $item)
            <small class="d-block d-flex justify-content-lg-start mt-2 text-dark">Pembayaran ID :
                #SMKN4TNG-{{ $item->id }}</small>
            <div class="card-body">
                <h3 class="card-title uppercase text-dark text-bold d-block ">Kwitansi Pembayaran</h3>
                <table class="table table-striped mt-3">
                    <thead>
                        <tr>
                            <th scope="col">TANGGAL PEMBAYARAN</th>
                            <th scope="col">JUMLAH PEMBAYARAN</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>{{ $item->tanggal_bayar->format(' d/M/Y') }}</td>
                            <td>{{ currency_IDR($item->jumlah_dibayar) }}</td>
                        </tr>
                    </tbody>
                </table>
                <div class="card-footer text-body-secondary">
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
            </div>
        @endforeach
    </div>
</body>

<script>
    window.print();
</script>

@include('partials.script')

</html>
