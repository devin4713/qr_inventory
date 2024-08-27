@extends('layouts.layout')

@section('content')
    <main class="main">

        @if (session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif

        <section id="list" class="list section">
            <div class="container" data-aos="fade-up">
                <div class="row justify-content-center">
                    <div class="col-lg-8 text-center">
                        <h2>Inventory List</h2>
                        <p class="mb-4">Here is the list of all your inventory items.</p>
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col-lg-10">
                        <div class="row justify-content-end mt-3 mb-4">
                            <div class="col-lg-8 text-end">
                                <a href="{{ route('add.cam') }}" class="btn btn-success btn-sm">Add New</a>
                            </div>
                        </div>
                        <div class="table-responsive">
                            <table class="table table-bordered table-striped table-sm">
                                <thead class="table-dark">
                                    <tr class="text-center">
                                        <th>No</th>
                                        <th>Nama</th>
                                        <th>Merk</th>
                                        <th>Pemakai</th>
                                        <th>Tahun</th>
                                        <th>Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($inventories as $index => $inventory)
                                        <tr>
                                            <td class="text-center">{{ $index + 1 }}</td>
                                            <td>{{ $inventory->name }}</td>
                                            <td>{{ $inventory->brand }}</td>
                                            <td>{{ $inventory->user }}</td>
                                            <td>{{ $inventory->year }}</td>
                                            <td class="text-center">
                                                <a href="{{ route('edit.page', ['id' => $inventory->id]) }}" class="btn btn-primary btn-sm">Edit</a>
                                                <form action="{{ route('delete.process', ['id' => $inventory->id]) }}"
                                                    method="POST" style="display:inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure you want to delete this item?');">Delete</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
