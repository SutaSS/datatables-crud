<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Products</title>
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.1/css/buttons.dataTables.min.css">
    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
        }
        body {
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;
            padding: 20px;
        }
        .container {
            max-width: 1200px;
            margin: 0 auto;
            background-color: white;
            padding: 20px;
            border: 1px solid #ddd;
        }
        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
        }
        h1 {
            font-size: 24px;
            font-weight: normal;
        }
        .btn {
            padding: 10px 20px;
            border: 1px solid #ddd;
            background-color: white;
            color: black;
            cursor: pointer;
            text-decoration: none;
            display: inline-block;
        }
        .btn-primary {
            background-color: #007bff;
            color: white;
            border-color: #007bff;
        }
        .btn-primary:hover {
            background-color: #0056b3;
        }
        .btn-edit {
            background-color: #28a745;
            color: white;
            border-color: #28a745;
            padding: 5px 10px;
            font-size: 12px;
        }
        .btn-edit:hover {
            background-color: #1e7e34;
        }
        .btn-delete {
            background-color: #dc3545;
            color: white;
            border-color: #dc3545;
            padding: 5px 10px;
            font-size: 12px;
        }
        .btn-delete:hover {
            background-color: #c82333;
        }
        table {
            width: 100%;
            border-collapse: collapse;
        }
        th, td {
            padding: 12px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        th {
            background-color: #f9f9f9;
            font-weight: bold;
        }
        .actions {
            display: flex;
            gap: 5px;
        }
        .modal {
            display: none;
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            z-index: 1000;
            justify-content: center;
            align-items: center;
        }
        .modal.show {
            display: flex;
        }
        .modal-content {
            background-color: white;
            padding: 30px;
            border: 1px solid #ddd;
            max-width: 400px;
            width: 100%;
        }
        .modal-header {
            margin-bottom: 20px;
        }
        .modal-header h2 {
            font-size: 20px;
            font-weight: normal;
        }
        .modal-body {
            margin-bottom: 20px;
            color: #666;
        }
        .modal-footer {
            display: flex;
            gap: 10px;
            justify-content: flex-end;
        }
        .btn-cancel {
            background-color: #6c757d;
            color: white;
            border-color: #6c757d;
        }
        .btn-cancel:hover {
            background-color: #545b62;
        }
        .btn-confirm {
            background-color: #dc3545;
            color: white;
            border-color: #dc3545;
        }
        .btn-confirm:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>
    <div class="container">
        <div class="header">
            <h1>Products</h1>
            <a href="{{ route('products.create') }}" class="btn btn-primary">Add Product</a>
        </div>

        <table id="productsTable" class="display">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Description</th>
                    <th>Price</th>
                    <th>Stock</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($products as $product)
                <tr>
                    <td>{{ $product->name }}</td>
                    <td>{{ $product->description }}</td>
                    <td>Rp {{ number_format($product->price, 0, ',', '.') }}</td>
                    <td>{{ $product->stock }}</td>
                    <td>
                        <div class="actions">
                            <a href="{{ route('products.edit', $product->uuid) }}" class="btn btn-edit">Edit</a>
                            <button class="btn btn-delete" onclick="showDeleteModal('{{ $product->uuid }}', '{{ $product->name }}')">Delete</button>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    @include('products.modals.delete')

    <script src="https://code.jquery.com/jquery-3.7.1.js"></script>
    <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.4.1/js/buttons.html5.min.js"></script>
    <script>
        $(document).ready(function() {
            $('#productsTable').DataTable({
                pageLength: 10,
                dom: 'lBfrtip'
            });
        });

        function showDeleteModal(uuid, name) {
            document.getElementById('productName').textContent = name;
            document.getElementById('deleteForm').action = "{{ route('products.destroy', ':uuid') }}".replace(':uuid', uuid);
            document.getElementById('deleteModal').classList.add('show');
        }

        function closeDeleteModal() {
            document.getElementById('deleteModal').classList.remove('show');
        }

        // Close modal when clicking outside
        document.getElementById('deleteModal').addEventListener('click', function(e) {
            if (e.target === this) {
                closeDeleteModal();
            }
        });
    </script>
</body>
</html>