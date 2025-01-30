@extends('layout.sidebar')

@section('content')
    {{-- Categories list --}}
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card p-3">
                            <div class="card-title margin-bottom">
                                <h3><i class="fas fa fa-list"></i> Add New Courier</h3>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('couriers.store') }}" method="post">
                                    @csrf
                                    <div class="row mb-3">
                                        <label for="cost" class="col-md-2 col-sm-3 form-label">Courier:</label>
                                        <input type="text" id="name" name="name" class="col form-control" placeholder="alex">
                                    </div>

                                    <div class="mb-3">
                                        <input type="submit" value="Send" class="btn btn-primary">
                                    </div>
                                </form>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </div>
    @endsection

    @section('script')
    @endsection
