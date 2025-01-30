<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>

<style>
    table {
        font-family: arial, sans-serif;
        border-collapse: collapse;
        width: 100%;
    }

    td,
    th {
        border: 1px solid #dddddd;
        text-align: left;
        padding: 8px;
    }
</style>

<body>
    <h1 style="text-align: center;">Rumah Makan Beringin Baru</h1>

    <table>
        <thead>
            <tr>
                <td>#ID</td>
                <td>Nama Pemesan</td>
                <td>Menu Pesanan</td>
                <td>Hari / Tanggal</td>
                <td>Jam</td>
                <td>Total Harga</td>
            </tr>
        </thead>

        <tbody>
            @foreach ($orders as $order)
                <tr>
                    {{-- @dd($orders) --}}
                    <td>
                        <h4>{{ $order->id }}</h4>
                    </td>
                    <td>
                        {{ $order->User->name }}
                    </td>
                    <td>
                        @foreach ($order->detailOrder as $detail)
                            <div>
                                <div style="display: inline; margin-bottom: 18px;">
                                    <p style="display: inline; margin: 0">{{ $detail->Menu->title }}</p>
                                    <p style="display: inline; margin: 0">x{{ $detail->qty }}</p>
                                </div>
                                <p style="margin: 0">Harga: Rp{{ number_format($detail->Menu->pric, 0, '', '.') }}</p>
                                <p style="margin: 0">Subtotal: Rp{{ number_format($detail->subtotal, 0, '', '.') }}</p>
                            </div>
                            <br>
                        @endforeach
                    </td>
                    <td>
                        <p>
                            {{ $order->created_at->format('d-m-Y') }}
                        </p>
                    </td>
                    <td>
                        <p>
                            {{ $order->created_at->format('H:i:s') }}
                        </p>
                    </td>
                    <td>
                        <p>
                            Rp{{ number_format($order->total, 0, '', '.') }}
                        </p>
                    </td>


                    {{-- <td>
                    @foreach ($order->detailOrder as $detail)
                        {{ $detail->menu->title }}<br>
                    @endforeach
                </td> --}}
                    {{-- <td>
                    @foreach ($order->detailOrder as $detail)
                        {{ $detail->qty }}<br>
                    @endforeach
                </td> --}}
                    {{-- <td>
                    @foreach ($order->detailOrder as $detail)
                        {{ $detail->menu->pric }}<br>
                    @endforeach
                </td> --}}
                    {{-- <td>
                    {{ $detail->Menu->title }}<br>
                </td>
                <td>
                    {{ $detail->qty }}<br>
                </td>
                <td>
                    {{ $detail->Menu->pric }}<br>
                </td>
                <td>
                    {{ $detail->Order->Shipment->Street->cost->cost }}
                </td>
                <td>{{ $detail->subtotal }}</td>
                <td>
                    @if ($detail->Order->cod)
                        COD
                    @else
                        E-Transfer
                    @endif
                </td>
                <td>
                    @if ($detail->Order->paid)
                        yes
                    @else
                        no
                    @endif
                </td>
                <td>
                    @if ($detail->Order->Shipment->delivery)
                        yes
                    @else
                        no
                    @endif
                </td>
                <td>
                    {{ $detail->Order->status }}
                </td>
                <td>
                    {{ $detail->Order->created_at }}
                </td>
                <td>
                    {{ $detail->Order->updated_at }}
                </td>
                <td>
                    {{ $detail->Order->deleted_at }}
                </td> --}}
                </tr>
            @endforeach
        </tbody>
        {{-- <tfoot>
        <tr>
            <th scope="row" colspan="6">TOTAL</th>
            <td>{{ $total }}</td>
        </tr>
    </tfoot> --}}

    </table>
</body>

</html>
