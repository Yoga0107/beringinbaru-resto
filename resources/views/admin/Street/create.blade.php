@extends('layout.sidebar')

@section('style')
    {{-- Select-Bootstrap --}}
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">
@endsection

@section('content')
    {{-- Categories list --}}
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-md-12">
                        <div class="card p-3">
                            <div class="card-title margin-bottom">
                                <h3><i class="fas fa fa-list"></i> Add New Street</h3>
                            </div>
                            <div class="card-body">
                                <form action="{{ route('street.store') }}" method="post" enctype="multipart/form-data">
                                    @csrf
                                    <div class="mb-3">
                                        <div class="custom-select row">
                                            <label for="district" class="col-md-2 col-sm-3 form-label">District:</label>
                                            <select id="SelectDistrict" class="selectDistrict col p-0 form-control border" data-live-search="true" title="kecamatan" name="district_id">
                                                @foreach ($districts as $district)
                                                    <option data-tokens={{ $district['name'] }} value={{ $district['id'] }}>{{ $district['name'] }}</option>
                                                @endforeach
                                            </select>
                                        </div>
                                    </div>
                                    <div class="mb-3">
                                        <div class="custom-select row">
                                            <label for="village" class="col-md-2 col-sm-3 form-label">Village:</label>
                                            <select id="SelectVillage" class="selectVillage col p-0 form-control border" data-live-search="true" title="kelurahan" name="village_id">

                                            </select>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="street" class="col-md-2 col-sm-3 form-label">Street:</label>
                                        <textarea class="col form-control" name="street" placeholder="Jalan Jati Asih" id="floatingTextarea"></textarea>
                                    </div>
                                    <div class="mb-3">
                                        <div class="custom-select row">
                                            <label for="cost" class="col-md-2 col-sm-3 form-label">Cost:</label>
                                            <select id="SelectCost" class="selectCost col p-0 form-control border" data-live-search="true" title="cost" name="cost_id">
                                                @foreach ($costs as $cost)
                                                    <option data-tokens={{ $cost->cost }} value={{ $cost->id }}>{{ $cost->cost }}</option>
                                                @endforeach
                                            </select>
                                        </div>
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
    </div>
@endsection

@section('script')
    <script src="http://code.jquery.com/jquery-1.9.1.js"></script>
    <script src="{{ asset('js/admin/selectPicker.js') }}"></script>
    {{-- select-bootstrap --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.14.0-beta3/dist/js/bootstrap-select.min.js"></script>
@endsection
