<!-- resources/views/admin/restock.blade.php -->
@extends('admin.dashboard')

@section('content')
<div class="container">
    <h1 class="my-4">Restock Items</h1>
    <form action="{{ route('restock.store') }}" method="POST" class="mb-4">
        @csrf
        <div class="form-group">
            <label for="item_id">Select Item</label>
            <select name="item_id" id="item_id" class="form-control" required>
                <option value="" disabled selected>Choose an item</option>
                @foreach($items as $item)
                <option value="{{ $item->id }}">{{ $item->name }} (Current Stock: {{ $item->quantity }})</option>
                @endforeach
            </select>
        </div>
        <div class="form-group mt-3">
            <label for="quantity">Quantity to Add</label>
            <input type="number" name="quantity" id="quantity" class="form-control" min="1" required>
        </div>
        <button type="submit" class="btn btn-primary mt-3">Restock</button>
    </form>

    @if(session('success'))
    <div class="alert alert-success">
        {{ session('success') }}
    </div>
    @endif

    <h2 class="mt-5">Current Items</h2>
    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Item Name</th>
                <th>Stock</th>
                <th>Price</th>
            </tr>
        </thead>
        <tbody>
            @foreach($items as $item)
            <tr>
                <td>{{ $item->name }}</td>
                <td>{{ $item->quantity }}</td>
                <td>₱{{ number_format($item->price, 2) }}</td>
            </tr>
            @endforeach
        </tbody>
    </table>
</div>
@endsection
