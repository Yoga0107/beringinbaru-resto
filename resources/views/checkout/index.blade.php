@extends('checkout.app')

@section('content')
    <div class="container py-5">
        <div class="row justify-content-between">
            {{-- START PAYMENT --}}
            <div class="col-6 py-4">
                <div class="logo"><i class="fas fa-utensils"></i>BERINGIN BARU</div>
                <p class="mt-5 fs-5">Customer Information</p>
                <div class="row p-3 border rounded-3 fs-5 custom-border-width">
                    <div class="col">
                        <p class="m-0">Nama</p>
                        <p class="m-0">Alamat</p>
                        <p class="m-0">Ongkir</p>
                    </div>
                    <div class="col m-auto">
                        <p class="m-0">{{ $username }}</p>
                        <p class="m-0">KEMAYORAN</p>
                        <p class="m-0">Rp. {{ number_format(Cart::getSubTotal(), 0, '', '.') }}</p>
                    </div>
                </div>
                <p class="mt-5 fs-5">Payment Method</p>
                <div class="d-flex">
                    <div class="form-check flex-fill ps-0 me-3 border rounded-3 custom-text-primary">
                        <input class="form-check-input d-none" type="radio" name="paymentMethod" id="e-transfer" onchange="paymentMethod()">
                        <label class="form-check-label w-100" for="e-transfer">
                            <div class="p-4 border rounded-3 custom-border-width custom-border-color pointer">
                                <div class="mx-auto text-center">
                                    <i class="fas fa-money-check-alt fa-2xl">
                                    </i>
                                    <span class="ms-2">
                                        e-transfer
                                    </span>
                                </div>
                            </div>
                        </label>
                    </div>
                    <div class="form-check flex-fill ps-0 border rounded-3 custom-text-primary">
                        <input class="form-check-input d-none" type="radio" name="paymentMethod" id="cod" onchange="paymentMethod()">
                        <label class="form-check-label w-100" for="cod">
                            <div class="p-4 border rounded-3 custom-border-width custom-border-color pointer">
                                <div class="mx-auto text-center">
                                    <i class="fas fa-money-check-alt fa-2xl">
                                    </i>
                                    <span class="ms-2">
                                        COD
                                    </span>
                                </div>
                            </div>
                        </label>
                    </div>
                </div>

                <div id="nomorRekening" class="d-none">
                    <p class="mt-5 fs-5">Nomor Rekening</p>
                    <p class="fs-5 fw-bold m-0">0123123123</p>
                    <p class="m-0">A/N Bayu</p>
                </div>

                <div id="pesanCOD" class="d-none">
                    <p class="mt-5 fs-5">Pastikan Kamu di rumah, dan menyiapkan uang pas</p>
                </div>

                <div id="btnPayment" class="btn btn-primary-disabled w-100 mt-5">Lakukan Pembayaran</div>



            </div>
            {{-- END PAYMENT --}}

            {{-- START ORDER SUMMARY --}}
            <div class="col-6 ps-5">
                <div class="bg-light-gray w-100 h-100 rounded-1rem p-5">
                    <p class="fs-5 text-center">
                        Jumlah Total
                    </p>
                    <p class="fs-1 fw-bolder custom-text-primary text-center">
                        Rp. {{ number_format(Cart::getSubTotal(), 0, '', '.') }}
                    </p>
                    <hr class="my-5 custom-text-green2" />
                    <p class="fs-5 text-center mb-4">
                        Order Summary
                    </p>
                    @foreach ($items as $item)
                        <div class="mb-2">
                            <div class="row fw-bold">
                                <div class="col">{{ $item->name }}</div>
                                <div class="col text-end">{{ number_format($item->price * $item->quantity, 0, '', '.') }}</div>
                            </div>
                            <span class="custom-text-green2 mb-2">qty: {{ $item->quantity }}</span>
                        </div>
                    @endforeach
                    <hr class="my-4 custom-text-green2" />
                    <div class="row">
                        <div class="col custom-text-green2">Subtotal</div>
                        <div class="col text-end fw-bold">{{ number_format(Cart::getSubTotal(), 0, '', '.') }}</div>
                    </div>
                    <div class="row mt-2">
                        <div class="col custom-text-green2">Ongkir</div>
                        <div class="col text-end fw-bold">18.000</div>
                    </div>
                    <hr class="my-4 custom-text-green2" />
                    <div class="row fw-bold fs-5">
                        <div class="col">Total</div>
                        {{-- //TODO: ubah total menjadi subtotal + ongkir --}}
                        <div class="col text-end custom-text-primary">39.000</div>
                    </div>
                </div>
            </div>
            {{-- END ORDER SUMMARY --}}
        </div>
    </div>
@endsection
