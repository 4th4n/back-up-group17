@extends('admin.dashboard')

@section('head')
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
@endsection

@section('content')
<div class="container my-5">
    <h1 class="mb-4 text-center">List of Orders</h1>

    @if($orders->isEmpty())
        <div class="alert alert-info text-center" role="alert">
            No orders found.
        </div>
    @else
        <div class="card">
            <div class="card-body">
                <div class="table-responsive">
                    <table class="table table-bordered table-hover">
                        <thead class="thead-light">
                            <tr>
                                <!-- <th scope="col">Order No.</th> -->
                                <th scope="col">Order ID</th>
                                <th scope="col">Total Price</th>
                                <th scope="col">Items</th>
                                <th scope="col">Created At</th>
                                <th scope="col">Completed</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orders as $order)
                                <tr>
                                    <!-- <td>{{ $order->order_number }}</td> -->
                                    <td>{{ $order->id }}</td>
                                    <td>₱{{ number_format($order->total_price, 2) }} pesos</td>
                                    <td>
                                        <ul class="list-unstyled mb-0">
                                            @foreach($order->items as $item)
                                                <li>{{ $item->name }} ({{ $item->pivot->quantity }} pcs)</li>
                                            @endforeach
                                        </ul>
                                    </td>
                                    <td>{{ $order->created_at->format('F j, Y h:i A') }}</td>
                                    <td>
                                        <form action="{{ route('order.complete', $order->id) }}" method="POST">
                                            @csrf
                                            @method('PATCH')
                                            <div class="form-check">
                                                <input type="checkbox" 
                                                       class="form-check-input" 
                                                       name="completed" 
                                                       id="completed_{{ $order->id }}"
                                                       {{ $order->completed ? 'checked disabled' : '' }}>
                                                <label class="form-check-label" for="completed_{{ $order->id }}">
                                                    Mark as Completed
                                                </label>
                                            </div>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endif
</div>

<style>
    /* Style for the checkbox */
    .form-check-input {
        transform: scale(1.2);
        cursor: pointer;
    }
</style>
@endsection
