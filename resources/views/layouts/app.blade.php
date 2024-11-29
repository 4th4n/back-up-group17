<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ordering System for School Canteen</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.10.0/font/bootstrap-icons.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">
    <!-- Add this in the <head> section of layouts/app.blade.php -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- Custom Styles -->
    <style>
        body {
            max-width: 100%; /* Allow the container to take the full width */
            padding: 0 15px; /* Add some padding */
        }

        /* Responsive Search Container */
        .search-container {
            flex-grow: 1;
            display: flex;
            justify-content: center;
            max-width: 100%;
        }

        .search-input-group {
            display: flex;
            align-items: center;
            border-radius: 30px;
            background-color: #fff;
            box-shadow: 0px 4px 8px rgba(0, 0, 0, 0.3);
            padding: 0.2rem 0.5rem;
            max-width: 400px;
            width: 100%;
            height: 40px;
        }

        .search-input-group input {
            border: none;
            outline: none;
            box-shadow: none;
            flex-grow: 1;
            font-size: 1rem;
            height: 100%;
        }

        .search-input-group .icon-btn {
            background: none;
            border: none;
            color: #666;
            font-size: 1.2rem;
        }

        .search-input-group .search-mic-btn {
            background-color: #f0f0f0;
            border-radius: 50%;
            padding: 1%;
            margin-left: 10px;
        }

        /* Footer */
        .footer {
            background-color: #f8f9fa;
            text-align: center;
            margin-top: auto; /* Ensures footer stays at bottom */
        }

        /* Media Queries */
        @media (max-width: 768px) {
            .navbar {
                padding: 0.2rem 0.5rem;
            }

            .search-container {
                max-width: 80%;
            }

            .search-input-group {
                max-width: 100%;
            }
        }

        @media (max-width: 576px) {
            .search-container {
                max-width: 100%;
            }
        }
    </style>
</head>
<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light bg-light">
                        <div class="container-fluid">
                        <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="{{ asset('images/logo.png') }}" alt="logo" width="40" height="30">
                </a>

            <!-- <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button> -->
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">
                    <!-- Remaining menu items or any new ones can be added here -->
                </ul>
            </div>
        </div>
    </nav>

    <!-- Main Content -->
    <main class="container-fluid mt-4 flex-grow-1">
        @yield('content')
    </main>

    <!-- Footer -->
    <footer class="footer mt-auto py-3 bg-light">
        <div class="container-fluid">
            <span class="text-muted">&copy; {{ date('Y') }} Ordering System for School Canteen</span>
        </div>
    </footer>

    <!-- Bootstrap JS and dependencies -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
