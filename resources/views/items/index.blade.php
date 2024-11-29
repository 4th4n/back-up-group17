@extends('admin.dashboard') <!-- Extending the admin dashboard layout -->

@section('content')
<div class="container mt-5">
    <!-- Button to trigger the modal -->
    <div class="d-flex justify-content-end">
        <button type="button" class="btn btn-primary mb-3" data-bs-toggle="modal" data-bs-target="#createItemModal">
            Add New Item
        </button>
    </div>

    <!-- Include the create item form -->
    @include('items.create') <!-- This will include the create item form from items/create.blade.php -->

    <!-- Rest of your content, e.g., table for displaying items -->
    <div class="card">
        <div class="card-body">
            <h2 class="mb-4">Products of List</h2>
            <table class="table table-bordered table-hover">
                <thead class="thead-light">
                    <tr>
                       
                        <th>Name</th>
                        <th>Quantity</th>
                        <!-- <th>Low Stock Level</th> -->
                        <th>Price</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($items as $item)
                        <tr>
                            
                            <td>{{ $item->name }}</td>
                            <td>{{ $item->quantity }}</td>
                            <!-- <td>{{ $item->low_stock_level ?? 'N/A' }}</td> -->
                            <td>₱{{ number_format($item->price, 2) }}</td>
                            <td>
                                <!-- Edit Button -->
                                <a href="{{ route('items.edit', $item->id) }}" class="btn btn-primary me-2">Edit</a>
                                
                                <!-- Delete Button -->
                                <form action="{{ route('items.destroy', $item->id) }}" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="button" class="btn btn-danger" onclick="confirmDelete(event, this.form)">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- Confirmation Script for Delete -->
<script>
    function confirmDelete(event, form) {
        event.preventDefault(); // Prevent form submission
        if (confirm('Are you sure you want to delete this item?')) {
            form.submit(); // Submit the form if user confirms
        }
    }
</script>
@endsection
