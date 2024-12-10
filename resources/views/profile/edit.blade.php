<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Edit Profile</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            background-color: #f4f9f4;
            font-family: 'Poppins', sans-serif;
            color: #2d6a4f;
        }

        .navbar {
            background-color: #ffffff;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        }

        .page-header {
            font-weight: 600;
            color: #40916c;
        }
        .container {
            margin-top: 80px;
        }

        .rounded-circle {
            border: 3px solid #40916c;
        }

        .btn-primary {
            background-color: #40916c;
            border-color: #40916c;
        }

        .btn-primary:hover {
            background-color: #2d6a4f;
            border-color: #2d6a4f;
        }
    </style>
</head>

<body>
    <!-- Navigation Bar -->
    <nav class="navbar navbar-expand-lg fixed-top">
        <div class="container-fluid">
            <a class="navbar-brand page-header" href="{{ route('posts.index') }}">🌱 Green Social</a>
            <div class="d-flex align-items-center ms-auto">
                @guest
                <form action="{{ route('register.create') }}" method="GET" class="me-2">
                    <button type="submit" class="btn btn-primary">Register</button>
                </form>
                <form action="{{ route('login.create') }}" method="GET">
                    <button type="submit" class="btn btn-primary">Login</button>
                </form>
                @endguest

                @auth
                <div class="dropdown profile-dropdown">
                    <button class="btn btn-link dropdown-toggle p-0" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        <img src="{{ asset('storage/' . (Auth::user()->profile_picture ?? 'images/profile_picture/default.png')) }}" alt="Profile Picture" class="rounded-circle" style="width: 50px; height: 50px;">
                    </button>
                    <ul class="dropdown-menu dropdown-menu-end shadow-lg" aria-labelledby="navbarDropdown">
                        <li>
                            <a href="{{ route('profile.show', Auth::id()) }}" class="dropdown-item d-flex align-items-center">
                                <i class="fas fa-user-circle me-2"></i> My Profile
                            </a>
                        </li>
                        <li>
                            <form action="{{ route('login.destroy') }}" method="POST">
                                @csrf
                                <button type="submit" class="dropdown-item text-danger d-flex align-items-center">
                                    <i class="fas fa-sign-out-alt me-2"></i> Log out
                                </button>
                            </form>
                        </li>
                    </ul>
                </div>
                @endauth
            </div>
        </div>
    </nav>

    <!-- Edit Profile Section -->
    <div class="container">
        <h1>Edit Your Profile</h1>

        <!-- Display form errors -->
        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <!-- Display success message -->
        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        <!-- Profile Edit Form -->
        <form action="{{ route('profile.update', $user->id) }}" method="POST" enctype="multipart/form-data">
            @csrf
            @method('PUT')

            <!-- Profile Picture -->
            <div class="mb-3">
                <label for="profile_picture" class="form-label">Profile Picture</label>
                <div>
                    <img src="{{ $user->profile_picture ? asset('storage/' . $user->profile_picture) : asset('images/profile_picture/default.png') }}" 
                         alt="Profile Picture" 
                         class="rounded-circle mb-2" 
                         style="width: 150px; height: 150px;">
                </div>
                <input type="file" class="form-control" id="profile_picture" name="profile_picture" accept="image/*">
            </div>

            <!-- Name Field -->
            <div class="mb-3">
                <label for="name" class="form-label">Name</label>
                <input type="text" class="form-control" id="name" name="name" value="{{ old('name', $user->name) }}" required>
            </div>

            <!-- Description Field -->
            <div class="mb-3">
                <label for="description" class="form-label">Description</label>
                <textarea class="form-control" id="description" name="description" rows="4">{{ old('description', $user->description) }}</textarea>
            </div>

            <!-- Submit Button -->
            <button type="submit" class="btn btn-primary">Save Changes</button>
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
