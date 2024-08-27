@extends('layouts.layout')
@section('content')
    <style>
        .video-container {
            position: relative;
        }

        .viewfinder {
            border: 5px solid #a7d1ff;
            border-radius: 25px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.3);
        }

        #preview {
            display: block;
            width: 100%;
            height: auto;
            border-radius: 20px;
        }
    </style>
    <main class="main">
        <section id="scan" class="scan section">
            <div class="container" data-aos="fade-up">
                <div class="row justify-content-center mb-4">
                    <div class="col-lg-8 text-center">
                        <h2>Scan QR Code</h2>
                        <p class="mb-4">Point your camera to a QR code.</p>
                    </div>
                </div>

                <div class="row justify-content-center">
                    <div class="col-lg-6">
                        <div id="scanner" class="video-container">
                            <div class="viewfinder">
                                <video id="preview" class="img-fluid"></video>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="row justify-content-center mt-4">
                    <div class="col-lg-8 text-center">
                        <div class="d-flex justify-content-around">
                            <a href="{{ route('home') }}" class="btn btn-secondary mt-3">Go Back to Home</a>
                            <a href="{{ route('list.page') }}" class="btn btn-secondary mt-3">See Inventory List</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>

    <!-- Modal: QR Code Not Found -->
    <div class="modal fade" id="notFoundModal" tabindex="-1" aria-labelledby="notFoundModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="notFoundModalLabel">QR Code Not Found</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    The QR code was not found in the saved inventory.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Modal: QR Code Already Saved -->
    <div class="modal fade" id="alreadySavedModal" tabindex="-1" aria-labelledby="alreadySavedModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="alreadySavedModalLabel">QR Code Already Saved</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    The QR code already exists in the saved inventory.
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
                </div>
            </div>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script>
        let scanner = new Instascan.Scanner({
            video: document.getElementById('preview')
        });

        Instascan.Camera.getCameras().then(function(cameras) {
            if (cameras.length > 0) {
                let rearCamera = cameras.find(camera => !camera.name.toLowerCase().includes('front') && !camera.name.toLowerCase().includes('webcam') && !camera.name.toLowerCase().includes('virtual'));
                if (rearCamera) {
                    scanner.start(rearCamera);
                    document.querySelector('.video-container').style.transform = 'scaleX(-1)';
                } else {
                    scanner.start(cameras[0]);
                }
            } else {
                console.error('No cameras found.');
            }
        }).catch(function(e) {
            console.error(e);
        });

        scanner.addListener('scan', function(content) {
            @if ($action == 'scanning')
                $.ajax({
                    url: "{{ route('detail.page') }}",
                    method: 'POST',
                    data: {
                        scannedQRCode: content,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.notfound) {
                            $('#notFoundModal').modal('show');
                        } else {
                            window.location.href = "{{ route('detail.session') }}";
                        }
                    },
                    error: function() {
                        $('#notFoundModal').modal('show');
                    }
                });
            @elseif ($action == 'editing')
                $.ajax({
                    url: "{{ route('edit.page2') }}",
                    method: 'POST',
                    data: {
                        scannedQRCode: content,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.notfound) {
                            $('#notFoundModal').modal('show');
                        } else {
                            window.location.href = "{{ route('edit.session') }}";
                        }
                    },
                    error: function() {
                        $('#notFoundModal').modal('show');
                    }
                });
            @else
                $.ajax({
                    url: "{{ route('add.page') }}",
                    method: 'POST',
                    data: {
                        scannedQRCode: content,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        if (response.found) {
                            $('#alreadySavedModal').modal('show');
                        } else {
                            window.location.href = "{{ route('add.session') }}";
                        }
                    },
                    error: function() {
                        $('#alreadySavedModal').modal('show');
                    }
                });
            @endif
        });
    </script>
@endsection
