
<p>Order Number: {{ $order->order_number }}</p>
<a href="{{ route('kiosk.index') }}" class="btn btn-primary mt-3">Back to Menu</a>
<!-- <p>Total Price: {{ $order->total_price }}</p> -->

<!-- If you don't want to show items -->
<!-- Remove or comment out the items section -->

<!-- 
<h2>Items</h2>
<ul>
    @foreach ($order->items as $item)
        <li>{{ $item->name }} - {{ $item->pivot->quantity }} x {{ $item->pivot->price }}</li>
    @endforeach
    
</ul>
-->
