@extends('layout.sidebar')

@section('search')
    {{-- section   shearch   --}}
    <div class="search">
        <form action="{{ route('orders.search') }}" method="POST" id="serach">
            @csrf
            <label>
                <input type="text" placeholder="Search Here" name="search" id="search"
                    onabort="event.preventDefault();
                         document.getElementById('serach').submit();
                     "
                >
                <ion-icon name="search"></ion-icon>

            </label>
        </form>
    </div>
@endsection


@section('content')
    @php
        function statusTagAdmin($status)
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
    <!-- Cards -->
    <div class="CardBox">
        <div class="Card">
            <div>
                <div class="numbers">{{ $sales }}</div>
                <div class="CardName">Orders</div>
            </div>
            <div class="iconBox">
                <ion-icon name="basket"></ion-icon>
            </div>
        </div>
        <div class="Card">
            <div>
                <div class="numbers">{{ $ArchivedOrders }}</div>
                <div class="CardName">Orders Archive</div>
            </div>
            <div class="iconBox">
                <ion-icon name="archive"></ion-icon>
            </div>
        </div>
        <div class="Card">
            <div>
                <div class="numbers">{{ $usersCount }}</div>
                <div class="CardName">Customers</div>
            </div>
            <div class="iconBox"><ion-icon name="person"></ion-icon></div>
        </div>

        <div class="Card">
            <div>
                <div class="numbers">{{ number_format($Earning, 0, '', '.') }}</div>
                <div class="CardName">Earning</div>
            </div>
            <div class="iconBox">
                <ion-icon name="cash"></ion-icon>
            </div>
        </div>
    </div>
    {{-- orders list --}}
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-12">
                        <div class="div-header d-flex flex-row justify-content-between align-item-center border-bottom p-2">
                            <h3>
                                <ion-icon name="list"></ion-icon>
                            </h3>
                        </div>
                        <!--- details Lists --->
                        <div class="cat-details">
                            <!--- category details List -->
                            <div class="list">
                                <div class="cartHeader">
                                    <h2>Orders</h2>
                                    {{-- Export Orders  --}}
                                    <a title="Export All users" class="btn  btn-sm btn-success mr-0" href="{{ route('orders-export') }}">
                                        <i class="fa-solid fa-download text-white"></i>
                                    </a>
                                    @if (Route::currentRouteName() == 'orders.archive')
                                        <a href="{{ route('orders.index') }}" class="btn">View Orders</a>
                                    @else
                                        <a href="{{ route('orders.archive') }}" class="btn">View Archived Orders</a>
                                    @endif

                                </div>
                                <div class="table-responsive">
                                    <table class="table vw-100">
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
                                                <td>receipt</td>
                                                <td class="text-center">Action</td>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach ($orders as $order)
                                                <tr>
                                                    {{-- @dd($orders) --}}
                                                    <th>{{ $order->id }}</th>
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
                                                            Rp{{ number_format($detail->menu->pric, 0, '', '.') }}<br>
                                                        @endforeach
                                                    </td>
                                                    <td>
                                                        Rp {{ number_format($order->Shipment->Street->cost->cost, 0, '', '.') }}
                                                    </td>
                                                    <td>Rp {{ number_format($order->total, 0, '', '.') }}</td>
                                                    <td>
                                                        @if ($order->cod)
                                                            COD
                                                        @else
                                                            E-transfer
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ($order->paid)
                                                            <i class="fa fa-check text-success"></i>
                                                        @else
                                                            <i class="fa fa-close text-danger"></i>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        @if ($order->Shipment->delivery)
                                                            <i class="fa fa-check text-success"></i>
                                                        @else
                                                            <i class="fa fa-close text-danger"></i>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <div class="status {{ statusTagAdmin($order->status) }}">{{ $order->status }}</div>
                                                    </td>
                                                    <td>
                                                        @if ($order->receipt)
                                                            <button type="button" class="" data-bs-toggle="modal" data-bs-target="#modalImage" data-bs-whatever="@fat">
                                                                <img src="{{ asset('images//receipt/' . $order->receipt) }}" alt="receipt_image" class="img-fluid" width="70" height="70">
                                                            </button>

                                                            <div class="modal fade" id="modalImage" tabindex="-1" aria-labelledby="modalImageLabel" aria-hidden="true">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title text-dark" id="modalImageLabel">Receipt</h5>
                                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            <img src="{{ asset('images//receipt/' . $order->receipt) }}" alt="receipt_image" class="img-fluid" width="100%"
                                                                                height="100%"
                                                                            >
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @else
                                                            <div></div>
                                                        @endif
                                                    </td>

                                                    <td class="d-flex flex-row justify-content-center align-items-center ">
                                                        @if ($order->status === 'delivery')
                                                        @endif

                                                        {{-- button delivery --}}
                                                        @if ($order->status === 'process')
                                                            <button title="Deliver To Customer" type="button" class="btn btn-pr btn-sm ml-2" data-bs-toggle="modal" data-bs-target="#exampleModal">
                                                                <i class="fa fa-sign-out text-white"></i>
                                                            </button>

                                                            <!-- Modal -->
                                                            <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title text-dark" id="exampleModalLabel">Data Pengiriman</h5>
                                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                        </div>
                                                                        <form id="update-{{ $order->id }}" action="{{ route('orders.update', $order->id) }}" method="POST">
                                                                            @csrf
                                                                            @method('PUT')
                                                                            <div class="modal-body text-dark text-start">
                                                                                <p>Nama Kurir:
                                                                                    <input type="text" class="form-control d-inline w-50" id="inputCourir" name="input_courier"
                                                                                        aria-describedby="courier"
                                                                                    >
                                                                                </p>
                                                                                <p>Estimasi Tiba:
                                                                                    <input type="time" class="form-control d-inline w-50" id="inputEstimation" name="input_estimation"
                                                                                        aria-describedby="estimation"
                                                                                    >
                                                                                </p>
                                                                                <p>Penerima: {{ $order->User->name }}</p>
                                                                                <p class="mb-1">Alamat </p>
                                                                                <p class="mb-0">kecamatan: {{ $order->shipment->Street->district }}</p>
                                                                                <p class="mb-0">Kelurahan: {{ $order->shipment->Street->village }}</p>
                                                                                <p class="mb-0">Jalan: {{ $order->shipment->Street->street }}</p>
                                                                                <p class="mb-0">Alamat Lengkap: {{ $order->Shipment->address }}</p>
                                                                                <p>Total Pembayaran: Rp {{ $order->total }}</p>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                                                                                <button class="btn btn-primary"
                                                                                    onclick="event.preventDefault(); document.getElementById('update-{{ $order->id }}').submit();"
                                                                                >
                                                                                    Delivery Now
                                                                                </button>
                                                                            </div>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        @endif

                                                        @if ($order->Shipment->delivery && $order->status === 'delivery')
                                                            {{-- button detail pengiriman --}}
                                                            <button title="info more" type="button" class="btn btn-warning btn-sm me-1" data-bs-toggle="modal" data-bs-target="#infomodal">
                                                                <i class="fa fa-info text-white"></i>
                                                            </button>

                                                            <!-- Modal -->
                                                            <div class="modal fade" id="infomodal" tabindex="-1" aria-labelledby="infomodal" aria-hidden="true">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title text-dark" id="infomodal">Info Pengiriman</h5>
                                                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                                        </div>
                                                                        <div class="modal-body text-dark text-start">
                                                                            <p>Nama Kurir: {{ $order->Shipment->courier }}
                                                                            </p>
                                                                            <p>Estimasi Tiba: {{ $order->Shipment->estimation }}
                                                                            </p>
                                                                            <p>Penerima: {{ $order->User->name }}</p>
                                                                            <p class="mb-1">Alamat </p>
                                                                            <p class="mb-0">kecamatan: {{ $order->shipment->Street->district }}</p>
                                                                            <p class="mb-0">Kelurahan: {{ $order->shipment->Street->village }}</p>
                                                                            <p class="mb-0">Jalan: {{ $order->shipment->Street->street }}</p>
                                                                            <p class="mb-0">Alamat Lengkap: {{ $order->Shipment->address }}</p>
                                                                            <p>Total Pembayaran: Rp {{ $order->total }}</p>
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            {{-- button success --}}
                                                            <form id="updateStatus-{{ $order->id }}" action="{{ route('orders.updateStatus', $order->id) }}" method="POST">
                                                                @csrf
                                                                @method('PUT')
                                                                <button title="Order Success"
                                                                    onclick="event.preventDefault();
                                                            document.getElementById('updateStatus-{{ $order->id }}').submit();"
                                                                    class="btn  btn-success  btn-sm ml-2"
                                                                >
                                                                    <i class="fa fa-check text-white"></i>
                                                                </button>
                                                            </form>
                                                        @endif

                                                        @if (empty($order->deleted_at))
                                                            {{-- Archive form --}}
                                                            <form id="delete-{{ $order->id }}" action="{{ route('orders.destroy', $order->id) }}" method="post"
                                                                style="margin-left: 4px !important"
                                                            >
                                                                @csrf
                                                                @method('DELETE')
                                                                <button class="btn btn-danger btn-sm" title="Archive order"
                                                                    onclick="event.preventDefault();

                                                                    Swal.fire({
                                                                    title: 'Are you sure?',
                                                                    text: 'Do you want to Archive this  Order',
                                                                    icon: 'warning',
                                                                    showCancelButton: true,
                                                                    confirmButtonColor: '#3085d6',
                                                                    cancelButtonColor: '#d33',
                                                                    confirmButtonText: 'Yes, Archive it!'
                                                                    }).then((result) => {
                                                                    if (result.isConfirmed) {
                                                                        document.getElementById('delete-{{ $order->id }}').submit();
                                                                        Swal.fire(
                                                                        'Deleted!',
                                                                        'The Order has been Archived.',
                                                                        'success'
                                                                        )
                                                                    }
                                                                    })
                                                               "
                                                                >
                                                                    <i class="fa fa-trash"></i>
                                                                </button>
                                                            </form>
                                                        @else
                                                            <form id="unarchive-{{ $order->id }}" action="{{ route('order.unarchive', $order->id) }}" method="Post">
                                                                @csrf
                                                                @method('PUT')
                                                                <button title="Unarchive this Order"
                                                                    onclick="event.preventDefault();
                                                                document.getElementById('unarchive-{{ $order->id }}').submit();"
                                                                    class="btn  btn-pr  btn-sm ms-1"
                                                                >
                                                                    <i class="fa-solid fa-diagram-next text-white"></i>
                                                                </button>
                                                            </form>
                                                        @endif


                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>

                                    </table>
                                </div>


                            </div>

                        </div>
                        {{-- Pagination --}}
                        <div class="justify-content-center d-flex">
                            {{ $orders->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection

    @section('script')
    @endsection
