@extends('admin.dashboard')

@section('content')
<div class="container mt-5">
    <h2>Edit Item</h2>
    <form action="{{ route('items.update', $item->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="name" class="form-label">Name</label>
            <input type="text" id="name" name="name" class="form-control" 
                   value="{{ old('name', $item->name) }}" required>
        </div>

        <div class="mb-3">
            <label for="price" class="form-label">Price</label>
            <input type="number" id="price" name="price" class="form-control" step="0.01" 
                   value="{{ old('price', $item->price) }}" required>
        </div>

        <div class="mb-3">
            <label for="quantity" class="form-label">Add Quantity</label>
            <input type="number" id="quantity" name="quantity" class="form-control" 
                   value="0" min="0" required>
            <small class="text-muted">Enter the quantity to add to the current stock.</small>
        </div>

        <button type="submit" class="btn btn-primary">Update Item</button>
    </form>
</div>
@endsection
