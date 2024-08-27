<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inventory Manager</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">

    <style>
        #start-buttons {
            display: flex;
            justify-content: center;
            gap: 20px;
            margin-top: 50px;
        }

        #scanner {
            display: none;
            margin-top: 30px;
            text-align: center;
            transform: rotateY(180deg);
        }

        #preview {
            width: 100%;
            max-width: 500px;
            border: 2px solid #007bff;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        #inventory-details,
        #add-inventory-form {
            margin-top: 20px;
        }

        #notFoundModal .modal-content {
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <div id="start-buttons">
            <button id="scan-inventory-btn" class="btn btn-primary">Scan Inventory</button>
            <button id="add-inventory-btn" class="btn btn-secondary">Add New Inventory</button>
        </div>

        <div id="scanner">
            <video id="preview"></video>
        </div>

        <div id="inventory-details" style="display: none;" class="mt-3">
            <h2>Detail Inventaris</h2>
            <p><strong>Number:</strong> <span id="inventory-number"></span></p>
            <p><strong>Name:</strong> <span id="inventory-name"></span></p>
            <p><strong>Description:</strong> <span id="inventory-description"></span></p>
            <p><strong>Category:</strong> <span id="inventory-category"></span></p>
            <p><strong>Quantity:</strong> <span id="inventory-quantity"></span></p>
            <p><strong>Year:</strong> <span id="inventory-year"></span></p>
            <button id="go-back-btn" class="btn btn-warning mt-3">Go Back</button>
        </div>

        <div id="add-inventory-form" style="display: none;" class="mt-3">
            <h2>Add New Inventory</h2>
            <form id="new-inventory-form">
                <div class="mb-3">
                    <label for="inventory-number-input" class="form-label">Number</label>
                    <input type="text" class="form-control" id="inventory-number-input" required>
                </div>
                <div class="mb-3">
                    <label for="inventory-name-input" class="form-label">Name</label>
                    <input type="text" class="form-control" id="inventory-name-input" required>
                </div>
                <div class="mb-3">
                    <label for="inventory-description-input" class="form-label">Description</label>
                    <textarea class="form-control" id="inventory-description-input" required></textarea>
                </div>
                <div class="mb-3">
                    <label for="inventory-category-input" class="form-label">Category</label>
                    <input type="text" class="form-control" id="inventory-category-input" required>
                </div>
                <div class="mb-3">
                    <label for="inventory-quantity-input" class="form-label">Quantity</label>
                    <input type="number" class="form-control" id="inventory-quantity-input" required>
                </div>
                <div class="mb-3">
                    <label for="inventory-year-input" class="form-label">Year</label>
                    <input type="number" class="form-control" id="inventory-year-input" required>
                </div>
                <button type="submit" class="btn btn-success">Save Inventory</button>
            </form>
        </div>

        <div class="modal fade" id="notFoundModal" tabindex="-1" aria-labelledby="notFoundModalLabel"
            aria-hidden="true">
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
    </div>

    <script src="https://rawgit.com/schmich/instascan-builds/master/instascan.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script>
        let scanner = new Instascan.Scanner({
            video: document.getElementById('preview')
        });
        let scannedQRCode = '';

        $(document).ready(function() {
            $('#go-back-btn').on('click', function() {
                $('#inventory-details').hide();
                $('#start-buttons').fadeIn();
            });

            $('#scan-inventory-btn').on('click', function() {
                $('#start-buttons').hide();
                $('#scanner').fadeIn();
                startScanner(scanInventory);
            });

            $('#add-inventory-btn').on('click', function() {
                $('#start-buttons').hide();
                $('#scanner').fadeIn();
                startScanner(addNewInventory);
            });

            $('#new-inventory-form').on('submit', function(e) {
                e.preventDefault();
                let number = $('#inventory-number-input').val();
                let name = $('#inventory-name-input').val();
                let description = $('#inventory-description-input').val();
                let category = $('#inventory-category-input').val();
                let quantity = $('#inventory-quantity-input').val();
                let year = $('#inventory-year-input').val();

                $.ajax({
                    url: "{{ url('/add') }}",
                    method: 'POST',
                    data: {
                        qr_code: scannedQRCode,
                        number: number,
                        name: name,
                        description: description,
                        category: category,
                        quantity: quantity,
                        year: year,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        alert('Inventory saved!');
                        $('#add-inventory-form').hide();
                        $('#scanner').hide();
                        $('#start-buttons').fadeIn();
                    },
                    error: function() {
                        alert('Failed to save the inventory.');
                    }
                });
            });
        });

        function startScanner(callback) {
            Instascan.Camera.getCameras().then(function(cameras) {
                if (cameras.length > 0) {
                    let rearCamera = cameras.find(camera => !camera.name.toLowerCase().includes('front') && !camera
                        .name.toLowerCase().includes('selfie'));

                    if (rearCamera) {
                        scanner.start(rearCamera);
                    } else {
                        scanner.start(cameras[0]);
                    }
                } else {
                    console.error('No cameras found.');
                }
            }).catch(function(e) {
                console.error(e);
            });

            scanner.addListener('scan', callback);
        }

        function scanInventory(content) {
            $.ajax({
                url: "{{ url('/scan') }}",
                method: 'POST',
                data: {
                    qr_code: content,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    if (response.found) {
                        $('#inventory-number').text(response.number);
                        $('#inventory-name').text(response.name);
                        $('#inventory-description').text(response.description);
                        $('#inventory-category').text(response.category);
                        $('#inventory-quantity').text(response.quantity);
                        $('#inventory-year').text(response.year);
                        $('#inventory-details').fadeIn();
                    } else {
                        $('#notFoundModal').modal('show');
                    }
                    scanner.stop();
                    $('#scanner').hide();
                },
                error: function() {
                    $('#notFoundModal').modal('show');
                    scanner.stop();
                    $('#scanner').hide();
                }
            });
            scanner.removeListener('scan', scanInventory);
        }

        function addNewInventory(content) {
            scannedQRCode = content;
            scanner.stop();
            $('#scanner').hide();
            $('#add-inventory-form').fadeIn();
            scanner.removeListener('scan', addNewInventory);
        }
    </script>
</body>

</html>
