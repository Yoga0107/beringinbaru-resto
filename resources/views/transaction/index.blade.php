@extends('layout.app')

@php
    function statusTag($status)
    {
        switch ($status) {
            case 'process':
                return 'pending';
            case 'delivery':
                return 'inProgress';
            case 'delivered':
                return 'delivered';
        }
    }
@endphp

@section('content')
    <!-- cart item -->
    @foreach ($transactions as $item)
        <div class="small-container cart-page mb-4">
            <table>
                <tr>
                    <th>#Order ID</th>
                    <th>Menu</th>
                    {{-- <th>qty</th> --}}
                    {{-- <th>Price</th> --}}
                    <th>Cost</th>
                    <th>Courier</th>
                    <th>Estimation</th>
                    <th>Payment</th>
                    <th>Status</th>
                    <th>total</th>
                    <th>Action</th>
                </tr>

                <tr>
                    <td>
                        <h2>{{ $item->id }}</h2>
                    </td>
                    <td>
                        @foreach ($item->detailOrder as $detail)
                            <div class="cart-info">
                                <img src="{{ asset('images/menu/' . $detail->Menu->image) }}" alt="">
                                <div>
                                    <h3>{{ $detail->Menu->title }}</h3>
                                    <small>{{ $detail->Menu->description }}</small>
                                    <h5>x{{ $detail->qty }}</h5>
                                    <div>
                                        <h3 style="margin-top: 20px">Rp{{ number_format($detail->Menu->pric, 0, '', '.') }}</h3>
                                    </div>

                                </div>
                            </div>
                            <br>
                        @endforeach
                    </td>
                    {{-- <td>
                        @foreach ($item->detailOrder as $detail)
                            <h2>{{ $detail->qty }}</h2>
                            <br>
                        @endforeach
                    </td> --}}
                    {{-- <td>
                        @foreach ($item->detailOrder as $detail)
                            <h2>{{ number_format($detail->Menu->pric, 0, '', '.') }}</h2>
                            <br>
                        @endforeach
                    </td> --}}
                    <td>
                        <h2>Rp{{ number_format($item->Shipment->street->cost->cost, 0, '', '.') }}</h2>
                    </td>
                    <td>
                        @if ($item->Shipment->courier)
                            <h2>{{ $item->Shipment->courier }}</h2>
                        @else
                            <h2>-</h2>
                        @endif
                    </td>
                    <td>
                        @if ($item->Shipment->estimation)
                            <h2>{{ $item->Shipment->estimation }}</h2>
                        @else
                            <h2>-</h2>
                        @endif
                    </td>
                    <td>
                        @if ($item->cod)
                            <h2>COD</h2>
                        @else
                            <h2>E-Transfer</h2>
                        @endif
                    </td>
                    <td>
                        <div class="status {{ statusTag($item->status) }}">{{ $item->status }}</div>
                        {{-- <h2>{{ $item->status }}</h2> --}}
                    </td>
                    <td class="price">Rp {{ number_format($item->total, 0, '', '.') }}</td>
                    <td>
                        @if ($item->status === 'delivery')
                            <div>
                                <a href="https://wa.me/62xxxxxxxxx">
                                    <button type="submit" id="btn" class="btn btn-danger mt-5">Complain</button>
                                </a>
                                <form action="/transaction/{{ $item->id }}" method="post">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" id="btn" class="btn btn-primary mt-5">Diterima</button>
                                </form>
                            </div>
                        @endif
                        @if ($item->status === 'delivered')
                            <a href="/#review2">
                                <button type="submit" id="btn" class="btn btn-primary mt-5">
                                    Review
                                </button>
                            </a>
                        @endif
                    </td>
                </tr>
            </table>
        </div>
    @endforeach
@endsection
