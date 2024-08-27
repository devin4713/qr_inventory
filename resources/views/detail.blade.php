@extends('layouts.layout')

@section('content')
    <main class="main">

        @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif

        <section id="detail" class="detail section">
            <div class="container" data-aos="fade-up">
                <div class="row justify-content-center mb-4">
                    <div class="col-lg-8 text-center">
                        <h2>Inventory Detail</h2>
                        <p class="mb-4">Here are the details of the inventory item.</p>
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col-lg-8">
                        <div class="border p-4 rounded shadow-sm" data-aos="fade-up">
                            <div class="row mb-3">
                                <div class="col-4 font-weight-bold">Nama</div>
                                <div class="col-8">: {{ $name }}</div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-4 font-weight-bold">Merk</div>
                                <div class="col-8">: {{ $brand }}</div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-4 font-weight-bold">Pemakai</div>
                                <div class="col-8">: {{ $user }}</div>
                            </div>
                            <div class="row mb-3">
                                <div class="col-4 font-weight-bold">Tahun</div>
                                <div class="col-8">: {{ $year }}</div>
                            </div>
                            <div class="d-flex justify-content-between mt-4">
                                <a href="{{ route('list.page') }}" class="btn btn-secondary">See Inventory List</a>
                                <a href="{{ route('scan.cam') }}" class="btn btn-secondary">Scan Inventory</a>
                                <a href="{{ route('edit.page', ['id' => $id]) }}" class="btn btn-secondary">Edit This Item</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
