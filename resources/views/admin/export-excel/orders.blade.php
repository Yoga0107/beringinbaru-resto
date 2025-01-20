<table>
    <thead>
        <tr>
            <td>#ID</td>
            <td>Customers</td>
            <td>Menu</td>
            <td>Quantity</td>
            <td>Price</td>
            <td>Cost</td>
            <td>Subtotal</td>
            <td>Payment Method</td>
            <td>Paid</td>
            <td>Delivery</td>
            <td>Status</td>
            <td>Created_at</td>
            <td>Updated_at</td>
            <td>Deleted_at</td>
        </tr>
    </thead>

    <tbody>
        @foreach ($detailOrders as $detail)
            <tr>
                {{-- @dd($orders) --}}
                <td>{{ $detail->Order->id }}</td>
                <td>
                    {{ $detail->Order->User->name }}
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
                <td>
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
                </td>
            </tr>
        @endforeach
    </tbody>
    <tfoot>
        <tr>
            <th scope="row" colspan="6">TOTAL</th>
            <td>{{ $total }}</td>
        </tr>
    </tfoot>

</table>
