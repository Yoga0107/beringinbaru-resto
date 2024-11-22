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
                                <h3><i class="fas fa fa-edit"></i> Edit Cost</h3>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('cost.update', $cost->id) }}" method="post">
                                    @method('PUT')
                                    @csrf
                                    <div class="row mb-3">
                                        <label for="cost" class="col-md-2 col-sm-3 form-label">Cost:</label>
                                        <input type="number" id="cost" name="cost" class="col form-control" value="{{ $cost->cost }}">
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
