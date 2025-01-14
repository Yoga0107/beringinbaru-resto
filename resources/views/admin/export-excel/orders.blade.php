<table>
    <thead>
        <tr>
            <td>#ID</td>
            <td>Customers</td>
            <td>Menu</td>
            <td>Quantity</td>
            <td>Price</td>
            <td>Cost</td>
            <td>Total</td>
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
        @foreach ($orders as $order)
            <tr>
                {{-- @dd($orders) --}}
                <td>{{ $order->id }}</td>
                <td>
                    {{ $order->User->name }}
                </td>
                <td>
                    @foreach ($order->detailOrder as $detail)
                        {{ $detail->menu->title }}<br>
                    @endforeach
                </td>
                <td>
                    @foreach ($order->detailOrder as $detail)
                        {{ $detail->qty }}<br>
                    @endforeach
                </td>
                <td>
                    @foreach ($order->detailOrder as $detail)
                        {{ $detail->menu->pric }}<br>
                    @endforeach
                </td>
                <td>
                    {{ $order->Street->cost->cost }}
                </td>
                <td>{{ $order->total }}</td>
                <td>
                    @if ($order->cod)
                        COD
                    @else
                        E-Transfer
                    @endif
                </td>
                <td>
                    @if ($order->paid)
                        yes
                    @else
                        no
                    @endif
                </td>
                <td>
                    @if ($order->delivery)
                        yes
                    @else
                        no
                    @endif
                </td>
                <td>
                    {{ $order->status }}
                </td>
                <td>
                    {{ $order->created_at }}
                </td>
                <td>
                    {{ $order->updated_at }}
                </td>
                <td>
                    {{ $order->deleted_at }}
                </td>
            </tr>
        @endforeach
    </tbody>

</table>
