@extends('layout.sidebar')


@section('search')
    {{-- section shearch   --}}
    <div class="search">
        <form action="{{ route('menus.search') }}" method="POST" id="serach">
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
    <!-- Cards for statistics -->
    <div class="CardBox">
        {{-- <div class="Card">
                    <div>
                        <div class="numbers">{{$POPULARMenusCount}}</div>
                        <div class="CardName">Popular Menus</div>
                    </div>
                    <div class="iconBox">
                        <ion-icon name="star"></ion-icon>
                    </div>
                </div> --}}
        <div class="Card">
            <div>
                <div class="numbers">{{ $streetsCount }}</div>
                <div class="CardName">Streets</div>
            </div>
            <div class="iconBox">
                <ion-icon name="pin"></ion-icon>
            </div>
        </div>
        {{-- <div class="Card">
                    <div>
                        <div class="numbers">{{$catsCount}}</div>
                        <div class="CardName">Categories</div>
                    </div>
                    <div class="iconBox"><ion-icon name="albums"></ion-icon></div>
                </div> --}}
        <div class="Card">
            <div>
                <div class="numbers">{{ $costsCount }}</div>
                <div class="CardName">Costs</div>
            </div>
            <div class="iconBox">
                <ion-icon name="cash"></ion-icon>
            </div>
        </div>
    </div>
    {{-- Street list --}}
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-12">
                        <div class="div-header d-flex flex-row justify-content-between align-item-center border-bottom p-2">
                            <h3>
                                <ion-icon name="list"></ion-icon>
                            </h3>
                            <a href="{{ route('street.create') }}" class="btn btn-primary">
                                <i class="fas fa-plus"></i>
                            </a>
                        </div>
                        <!--- details Lists --->
                        <div class="menu-details">
                            <!--- menu details List -->
                            <div class="list ">
                                <div class="cartHeader">
                                    <h2>Streets</h2>
                                    <a href="/Menu" class="btn">View All</a>
                                </div>
                                <div class="table-responsive">
                                    <table>
                                        <thead>
                                            <tr>
                                                <td>#ID</td>
                                                <td>District</td>
                                                <td>Village</td>
                                                <td>Street</td>
                                                <td>Cost</td>
                                                <td class="text-center">Action</td>
                                            </tr>
                                        </thead>

                                        <tbody>
                                            @foreach ($streets as $street)
                                                <tr>
                                                    <td>{{ $street->id }}</td>
                                                    <td>{{ $street->district }}</td>
                                                    <td>{{ $street->village }}</td>
                                                    <td>{{ $street->street }}</td>
                                                    <td>{{ $street->cost }}</td>
                                                    <td class="d-flex flex-row justify-content-center align-items-center ">
                                                        <a href="{{ route('street.edit', $street->id) }}" class="btn btn-success btn-sm"><i class="fas fa-edit"></i></a>
                                                        {{-- delete form --}}
                                                        <form id="{{ $street->id }}" action="{{ route('street.destroy', $street->id) }}" method="post" style="margin-left: 4px !important">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button class="btn btn-danger btn-sm"
                                                                onclick="event.preventDefault();

                                                                    Swal.fire({
                                                                    title: 'Are you sure?',
                                                                    text: 'Do you want to delete Street {{ $street->street }}',
                                                                    icon: 'warning',
                                                                    showCancelButton: true,
                                                                    confirmButtonColor: '#3085d6',
                                                                    cancelButtonColor: '#d33',
                                                                    confirmButtonText: 'Yes, delete it!'
                                                                    }).then((result) => {
                                                                    if (result.isConfirmed) {
                                                                        document.getElementById('{{ $street->id }}').submit();
                                                                        Swal.fire(
                                                                        'Deleted!',
                                                                        'The category has been deleted.',
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

                                    {{-- Menu Pagination --}}
                                    <div class="justify-content-center d-flex">
                                        {{ $streets->links('pagination::bootstrap-4') }}
                                    </div>



                                </div>
                            </div>
                            {{-- Costs  --}}
                            <div class="menu-category">
                                <div class="cartHeader">
                                    <h2>Street <span class="fw-light fs-6">(get street by cost)</span></h2>
                                </div>

                                <table>
                                    @foreach ($costs as $cost)
                                        <tr>
                                            <td><a href="{{ route('category.menus', $cost->id) }}">{{ $cost->cost }}</a></td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>
                        </div>
                        {{-- end category --}}
                    </div>
                    {{-- Menu Pagination
                                    <div class="justify-content-center d-flex">
                                           {{$menus->links("pagination::bootstrap-4")}}
                                    </div> --}}



                </div>
            </div>
        </div>
    </div>
@endsection

@section('script')
@endsection
