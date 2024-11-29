@extends('layouts.app')

@section('content')
<div class="container-fluid my-4">
    <!-- Success Message -->
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <!-- Title -->
    <h1 class="text-center mb-5 text-primary fw-bold">Welcome to the Menu</h1>
  
    <!-- Category Buttons -->
    <div class="category-container text-left my-4">
        <div class="category-buttons d-flex justify-content-left flex-wrap gap-3">
            <a href="{{ route('menu.category', 'breakfast') }}" class="btn btn-outline-primary rounded-pill">Breakfast</a>
            <a href="{{ route('menu.category', 'lunch') }}" class="btn btn-outline-primary rounded-pill">Lunch</a>
            <a href="{{ route('menu.category', 'snacks') }}" class="btn btn-outline-primary rounded-pill">Snacks</a>
            <a href="{{ route('menu.category', 'cup-noodles') }}" class="btn btn-outline-primary rounded-pill">Cup Noodles</a>
            <a href="{{ route('menu.category', 'drinks') }}" class="btn btn-outline-primary rounded-pill">Drinks</a>
            <a href="{{ route('menu.category', 'biscuits') }}" class="btn btn-outline-primary rounded-pill">Biscuits</a>
            <a href="{{ route('menu.category', 'junk-foods') }}" class="btn btn-outline-primary rounded-pill">Junk Foods</a>
            <a href="{{ route('menu.category', 'chocolates') }}" class="btn btn-outline-primary rounded-pill">Chocolates</a>
        </div>
    </div>

    <div class="row">
        
        <!-- Menu Section -->
<div class="col-md-8">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <!-- Menu Title -->
        <h2 class="text-left text-secondary">Menu</h2>

        <!-- Search Bar
        <div class="search-container">
            <form class="search-input-group d-flex" action="{{ route('menu.search') }}" method="GET">
                <input class="form-control w-auto rounded-pill me-2" type="search" name="query" placeholder="Search for delicious items..." aria-label="Search">
                <button type="submit" class="btn btn-primary rounded-pill px-3">
                    <i class="bi bi-search"></i>
                </button>
                <button type="button" class="btn btn-secondary rounded-pill ms-2 px-3">
                    <i class="bi bi-mic"></i>
                </button>
            </form>
        </div>
        -->

        <div class="search-container">
  <form class="search-input-group d-flex align-items-center" action="{{ route('menu.search') }}" method="GET">
    <input id="search-input" class="form-control rounded-pill me-3" type="search" name="query" placeholder="Search for delicious items..." aria-label="Search">
    
    <button type="submit" class="btn btn-primary rounded-pill px-3 me-2">
      <i class="bi bi-search"></i>
    </button>
    
    <button id="voice-search-btn" type="button" class="btn btn-secondary rounded-pill px-3">
      <i class="bi bi-mic"></i>
    </button>
  </form>
</div>

    </div>

    <!-- Menu Items -->
    <div id="product-list" class="row">
    @if(isset($items) && !$items->isEmpty())
        @foreach($items as $item)
            <div class="col-12 col-sm-6 col-md-4 mb-4 product-item" data-name="{{ $item->name }}">
                <div class="card h-100 shadow border-0 rounded-lg overflow-hidden position-relative">
                    @if($item->image)
                        <img src="{{ asset('images/' . $item->image) }}" class="card-img-top img-fluid" alt="{{ $item->name }}">
                    @else
                        <img src="{{ asset('images/default.png') }}" class="card-img-top img-fluid" alt="Default Image">
                    @endif

                    <div class="card-body d-flex flex-column text-center">
                        <h5 class="card-title text-primary">{{ $item->name }}</h5>
                        <p class="card-text text-muted mb-3">Price: <strong>₱{{ number_format($item->price, 2) }}</strong></p>

                        <!-- Check Quantity -->
                        @if($item->quantity > 0)
                            <form action="{{ route('order.add') }}" method="POST" class="mt-auto">
                                @csrf
                                <input type="hidden" name="item_id" value="{{ $item->id }}">
                                <button type="submit" class="btn btn-primary rounded-pill w-100">Add to Cart</button>
                            </form>
                        @else
                            <span class="badge bg-danger position-absolute top-0 end-0 m-2">Out of Stock</span>
                            <button class="btn btn-secondary rounded-pill w-100" disabled>Out of Stock</button>
                        @endif
                    </div>
                </div>
            </div>
        @endforeach
    @else
        <p class="text-center text-muted">No items found.</p>
    @endif
</div>

</div>


        <!-- Order Section -->
       
        <div class="col-md-4">
    <h2 class="text-center text-secondary mb-4">Your Order</h2>
    @if(session('order'))
    <ul class="list-group mb-3 shadow rounded-lg">
        @foreach(session('order') as $id => $details)
        <li class="list-group-item d-flex justify-content-between align-items-center">
            <div class="order-item-info">
                <h6 class="mb-0">{{ $details['name'] }}</h6>
                <div class="d-flex align-items-center">
                    <form action="{{ route('order.update') }}" method="POST">
                        @csrf
                        <input type="hidden" name="item_id" value="{{ $id }}">
                        <input type="hidden" name="quantity" value="{{ $details['quantity'] - 1 }}">
                        <button type="submit" class="btn btn-light btn-sm me-2 rounded-circle" {{ $details['quantity'] <= 1 ? 'disabled' : '' }}>
                            <i class="fas fa-minus"></i>
                        </button>
                    </form>
                    
                    <span class="fw-bold">{{ $details['quantity'] }}</span>

                    <form action="{{ route('order.update') }}" method="POST" class="ms-2">
                        @csrf
                        <input type="hidden" name="item_id" value="{{ $id }}">
                        <input type="hidden" name="quantity" value="{{ $details['quantity'] + 1 }}">
                        <button type="submit" class="btn btn-light btn-sm rounded-circle">
                            <i class="fas fa-plus"></i>
                        </button>
                    </form>
                </div>
            </div>
            <div class="order-item-controls d-flex align-items-center">
                <span class="order-item-price text-primary fw-bold">₱{{ number_format($details['price'] * $details['quantity'], 2) }}</span>
                <form action="{{ route('order.remove') }}" method="POST" class="ms-3">
                    @csrf
                    <input type="hidden" name="item_id" value="{{ $id }}">
                    <button type="button" class="btn btn-danger btn-sm rounded-circle" 
                            onclick="confirmDelete(event, this.form)">
                        <i class="fas fa-trash-alt"></i>
                    </button>
                </form>
            </div>
        </li>
        @endforeach
    </ul>
    <div class="total-amount text-center mb-3 p-3 bg-light rounded shadow">
        <h4>Total Amount: <strong>₱{{ number_format($totalAmount, 2) }}</strong></h4>
    </div>
    <a href="{{ route('order.checkout') }}" class="btn btn-success btn-block rounded-pill px-4 py-2 shadow">
        <i class="fas fa-shopping-cart"></i> Proceed to Checkout
    </a>
    @else
    <div class="alert alert-info text-center">
        <p>Your order is currently empty.</p>
    </div>
    @endif
</div>

<script>
    /**
     * Function to confirm deletion of an item
     * @param {Event} event - The click event
     * @param {HTMLFormElement} form - The form element to submit
     */
    function confirmDelete(event, form) {
        event.preventDefault(); // Pigilan ang form submission
        if (confirm('Are you sure you want to delete this item?')) {
            form.submit(); // Ituloy ang submission kapag confirmed
        }
    }
</script>

<style>
    .total-amount {
        font-size: 1.2rem;
        font-weight: bold;
    }
    .btn-block {
        width: 100%;
    }
</style>
<!-- Style adjustments -->
 <script>
 document.addEventListener("DOMContentLoaded", function () {
  const voiceSearchBtn = document.getElementById("voice-search-btn");
  const searchInput = document.getElementById("search-input");
  const productList = document.getElementById("product-list");

  // Check if browser supports webkitSpeechRecognition
  if ("webkitSpeechRecognition" in window) {
    const recognition = new webkitSpeechRecognition();
    recognition.lang = "en-US";
    recognition.interimResults = false;

    // Start voice recognition on button click
    voiceSearchBtn.addEventListener("click", () => {
      recognition.start();
    });

    // Process result of voice recognition
    recognition.onresult = event => {
      const query = event.results[0][0].transcript;
      searchInput.value = query;
      filterProducts(query);
    };

    // Handle voice recognition errors
    recognition.onerror = event => {
      console.error("Voice search error:", event.error);
      alert("Voice search error: " + event.error);
    };
  } else {
    alert("Voice search is not supported in this browser.");
  }

  // Filter products based on search input or voice recognition query
  function filterProducts(query) {
    const items = document.querySelectorAll(".product-item");
    query = query.toLowerCase();
    
    let resultsFound = false; // Track if there are matching results

    items.forEach(item => {
      const name = item.getAttribute("data-name").toLowerCase();
      if (name.includes(query)) {
        item.style.display = "block";
        resultsFound = true;
      } else {
        item.style.display = "none";
      }
    });

    // Show a message if no results match the search query
    if (!resultsFound) {
      productList.innerHTML = `<p class="text-center text-muted">No items match your search.</p>`;
    }
  }

  // Event listener for text input in the search box
  searchInput.addEventListener("input", event => {
    filterProducts(event.target.value);
  });
});   
 </script>
<style>
    .container-fluid {
        max-width: 100%;
        padding: 0 15px;
    }
    .card {
        border-radius: 10px;
        height: auto;
        transition: transform 0.3s ease, box-shadow 0.3s ease;
    }
    .card:hover {
        transform: translateY(-5px);
        box-shadow: 0 10px 20px rgba(0, 0, 0, 0.1);
    }
    .card-img-top {
        height: 180px;
        object-fit: cover;
    }
    .list-group-item {
        border: none;
    }
    .order-item-price {
        font-weight: bold;
        margin-right: 10px;
        color: #007bff;
    }
    .total-amount {
        font-size: 1.2rem;
        font-weight: bold;
    }
    .btn-light {
        background-color: #f8f9fa;
        border: 1px solid #ced4da;
    }
    .btn-block {
        width: 100%;
    }
    .category-buttons .btn-outline-primary {
        border-color:#1E90FF;
        color: white;
        background-color:#1E90FF; /* Default state */
    }

    .category-buttons .btn-outline-primary:hover {
        background-color:white ; /* Change background color on hover */
        color: black; /* Text color when hovered */
    }-

    .category-buttons .btn-outline-primary:active {
        background-color: #0056b3; /* Active state background color */
        color: white; /* Text color when button is clicked */
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function () {
        const alert = document.querySelector('.alert-success');
        if (alert) {
            setTimeout(() => {
                alert.classList.remove('show');
            }, 1000); // 3000 milliseconds = 3 seconds
        }
    });
</script>
@endsection
