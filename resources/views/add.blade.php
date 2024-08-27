@extends('layouts.layout')

@section('content')
    <main class="main">
        <section id="add" class="add section">
            <div class="container" data-aos="fade-up">
                <div class="row justify-content-center mb-4">
                    <div class="col-lg-8 text-center">
                        <h2>Add New Inventory</h2>
                        <p class="mb-4">Please fill out the form below to add a new inventory item.</p>
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col-lg-6">
                        <form id="new-inventory-form" action="{{ route('add.save') }}" method="POST">
                            @csrf
                            <input type="hidden" name="qr_code" value="{{ $scannedQRCode }}">

                            <div class="mb-3">
                                <label for="inventory-name-input" class="form-label">Nama</label>
                                <input type="text" class="form-control" id="inventory-name-input" name="name"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label for="inventory-brand-input" class="form-label">Merk</label>
                                <input type="text" class="form-control" id="inventory-brand-input" name="brand"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label for="inventory-user-input" class="form-label">Pemakai</label>
                                <input type="text" class="form-control" id="inventory-user-input" name="user"
                                    required>
                            </div>
                            <div class="mb-3">
                                <label for="inventory-year-input" class="form-label">Tahun</label>
                                <input type="number" class="form-control" id="inventory-year-input" name="year"
                                    required>
                            </div>
                            <div class="row">
                                <div class="col-6 d-flex justify-content-start">
                                    <a href="{{ route('list.page') }}" class="btn btn-secondary">Cancel</a>
                                </div>
                                <div class="col-6 d-flex justify-content-end">
                                    <button type="submit" class="btn btn-success">Save Inventory</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
