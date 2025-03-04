@extends('layout.sidebar')

@section('search')
    <div class="search">
        <form action="{{ route('cost-search.index') }}" method="POST" id="serach">
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
    <!-- Cards-->
    <div class="CardBox">
        <div class="Card">
            <div>
                <div class="numbers">{{ $courierCount }}</div>
                <div class="CardName">Courier</div>
            </div>
            <div class="iconBox"><ion-icon name="albums"></ion-icon></div>
        </div>
        {{-- <div class="Card">
            <div>
                <div class="numbers">{{ $streetCount }}</div>
                <div class="CardName">street</div>
            </div>
            <div class="iconBox">
                <ion-icon name="pin"></ion-icon>
            </div>
        </div> --}}
        {{-- <div class="Card">
            <div>
                <div class="numbers">{{ $MenusCount }}</div>
                <div class="CardName">Menus</div>
            </div>
            <div class="iconBox">
                <ion-icon name="clipboard"></ion-icon>
            </div>
        </div>
        <div class="Card">
            <div>
                <div class="numbers">{{ $Earning }}</div>
                <div class="CardName">Earning</div>
            </div>
            <div class="iconBox">
                <ion-icon name="cash"></ion-icon>
            </div>
        </div> --}}
    </div>
    {{-- Categories list --}}
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-12">
                        <div class="div-header d-flex flex-row justify-content-between align-item-center border-bottom p-2">
                            <h3>
                                <ion-icon name="list"></ion-icon>
                            </h3>
                            <a href="{{ route('couriers.create') }}" class="btn btn-primary">
                                <i class="fas fa-plus"></i>
                            </a>
                        </div>
                        <!--- details Lists --->
                        <div class="cat-details">
                            <!--- category details List -->
                            <div class="list">
                                <div class="cartHeader">
                                    <h2>Couriers</h2>
                                    <a href="/couriers" class="btn">View All</a>
                                </div>
                                <div class="table-responsive">
                                    <table>
                                        <thead>
                                            <tr>
                                                <td>#ID</td>
                                                <td>Name</td>
                                                <td class="text-center">Action</td>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach ($couriers as $courier)
                                                <tr>
                                                    <td>{{ $courier->id }}</td>
                                                    <td>{{ $courier->name }}</td>
                                                    <td class="d-flex flex-row justify-content-center align-items-center ">
                                                        <a href="{{ route('couriers.edit', $courier->id) }}" class="btn btn-success btn-sm"><i class="fas fa-edit"></i></a>
                                                        {{-- delete form --}}
                                                        <form id="{{ $courier->id }}" action="{{ route('couriers.destroy', $courier->id) }}" method="post" style="margin-left: 4px !important">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="btn btn-danger btn-sm"
                                                                onclick="event.preventDefault();

                                                                    Swal.fire({
                                                                    title: 'Are you sure?',
                                                                    text: 'Do you want to delete courier {{ $courier->name }}',
                                                                    icon: 'warning',
                                                                    showCancelButton: true,
                                                                    confirmButtonColor: '#3085d6',
                                                                    cancelButtonColor: '#d33',
                                                                    confirmButtonText: 'Yes, delete it!'
                                                                    }).then((result) => {
                                                                    if (result.isConfirmed) {
                                                                        document.getElementById('{{ $courier->id }}').submit();
                                                                        Swal.fire(
                                                                        'Deleted!',
                                                                        'The courier has been deleted.',
                                                                        'success'
                                                                        )
                                                                    }
                                                                    })
                                                               "
                                                            >
                                                                <i class="fa fa-trash"></i>
                                                            </button>
                                                        </form>

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
                            {{ $couriers->links('pagination::bootstrap-4') }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endsection


    @section('script')
    @endsection
