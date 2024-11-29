<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.5.0/font/bootstrap-icons.min.css" rel="stylesheet">
    <style>
        /* Offcanvas menu styling */
        .custom-offcanvas-bg {
            background-color: #2c3e50; /* Dark blue-gray */
            color: #ecf0f1; Light gray
        }
        .custom-offcanvas-bg .offcanvas-title {
            font-weight: bold;
            font-size: 1.3rem;
            color: #ffffff;
        }
        .custom-offcanvas-bg .nav-link {
            color: #ecf0f1;
            font-weight: 500;
            transition: color 0.3s ease;
        }
        .custom-offcanvas-bg .nav-link:hover {
            color: #3498db; /* Hover color */
        }

        /* Navbar styling */
        .navbar {
            background-color: #34495e; /* Darker blue-gray */
            border-bottom: 2px solid #1abc9c; /* Light teal border */
        }
        .navbar-brand {
            font-size: 1.6rem;
            font-weight: bold;
            color: #ecf0f1;
        }
        .navbar-brand:hover {
            color: #3498db;
        }

        /* Main content styling */
        main {
            background-color: #ecf0f1; /* Light background for content */
            padding: 2.5rem;
            border-radius: 10px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
        }
        h2 {
            color: #2c3e50;
            font-weight: bold;
            font-size: 1.8rem;
            margin-bottom: 1.5rem;
        }

        /* Button styling */
        .btn-primary {
            background-color: #1abc9c; /* Light teal */
            border-color: #1abc9c;
            font-weight: 600;
            transition: background-color 0.3s ease;
        }
        .btn-primary:hover {
            background-color: #16a085;
            border-color: #16a085;
        }

        .btn-secondary {
            background-color: #3498db; /* Blue */
            border-color: #3498db;
            font-weight: 600;
        }
        .btn-secondary:hover {
            background-color: #2980b9;
            border-color: #2980b9;
        }

        /* Offcanvas toggler styling */
        .navbar-toggler-icon {
            background-color: ;
        }

        /* Logout link styling */
        .nav-link.logout-link {
            color: #e74c3c; /* Red for logout */
            font-weight: bold;
        }
        .nav-link.logout-link:hover {
            color: #c0392b;
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-dark">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
                <span class="navbar-toggler-icon"></span>
            </button>
            <span class="navbar-brand mb-0 h1">Admin Dashboard</span>
        </div>
        </nav>

    <!-- Offcanvas Menu -->
    <div class="offcanvas offcanvas-start custom-offcanvas-bg" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Menu</h5>
            <button type="button" class="btn-close btn-close-white" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <ul class="nav flex-column">
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('items.index') }}">Update Inventory</a>
                </li>
                <!-- <li class="nav-item">
                    <a class="nav-link" href="{{ route('orders.view') }}">List Orders</a>
                </li> -->
                <li class="nav-item">
                  <a class="nav-link" href="{{ route('restock.index') }}">Restock Items</a> <!-- New Restock Link -->
                 </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.history') }}">Order History</a> <!-- Link to Order History -->
                </li>
                <li class="nav-item">
                    <a class="nav-link logout-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                       Logout
                    </a>
                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                        @csrf
                    </form>
                </li>
            </ul>
        </div>
    </div>

    <!-- Main Content -->
    <main class="container my-4">
        @yield('content')
    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
