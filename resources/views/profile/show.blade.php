<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{ $user->name }}'s Profile</title>
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
        .container{
            padding-top: 30px;
        }
        .page-header {
            font-weight: 600;
            color: #40916c;
        }
        .profile-picture {
            width: 150px;
            height: 150px;
            object-fit: cover;
            border-radius: 50%;
            border: 3px solid #40916c;
        }
        .card {
            background-color: #ffffff;
            border: 1px solid #d3e4cd;
            border-radius: 10px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        }
    </style>
</head>
<body>
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

    <div class="container mt-5">
        <h1>{{ $user->name }}'s Profile</h1>

        <div class="card p-3 mb-3">
            <img 
                src="{{ $user->profile_picture ? asset('storage/' . $user->profile_picture) : asset('storage/images/profile_picture/default.png') }}" 
                alt="Profile Picture" 
                class="profile-picture mb-3">
            <h2>{{ $user->name }}</h2>
            <p>{{ $user->description ?? 'No description provided.' }}</p>

            @if (Auth::check() && Auth::id() === $user->id)
                <a href="{{ route('profile.edit', $user->id) }}" class="btn btn-primary">Edit Profile</a>
            @endif
        </div>

        <h3>{{ $user->name }}'s Posts</h3>
        @if ($posts->isEmpty())
            <p>No posts available.</p>
        @else
            @foreach ($posts as $post)
                <div class="post-card card mb-3">
                    <div class="card-body">
                        <p>{{ $post->message }}</p>
                        <p class="text-muted small">
                            {{ __('Posted') }}: {{ $post->created_at->diffForHumans() }}
                        </p>
                        @if ($post->image)
                            <img src="{{ asset('storage/images/' . $post->image) }}" class="img-fluid rounded mb-3" style="max-height: 300px; object-fit: cover;">
                        @endif
                    </div>
                </div>
            @endforeach
            <div class="pagination">
                {{ $posts->links() }}
            </div>
        @endif
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
