<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>User Posts</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="{{ asset('js/posts/index.js') }}"></script>
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

        .post-card {
            background-color: #ffffff;
            border: 1px solid #d3e4cd;
            border-radius: 10px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            padding: 15px;
        }

        .btn-primary,
        .btn-outline-primary,
        .btn-outline-secondary,
        .btn-outline-danger {
            border-radius: 20px;
        }

        .btn-primary {
            background-color: #40916c;
            border-color: #40916c;
        }

        .btn-primary:hover {
            background-color: #2d6a4f;
            border-color: #2d6a4f;
        }

        .like-button {
            color: #6c757d;
            cursor: pointer;
        }

        .like-button.liked {
            color: #e63946;
        }

        .like-count {
            margin-left: 5px;
            font-weight: bold;
        }

        .create-post-btn {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background-color: #40916c;
            color: white;
            border: none;
            border-radius: 50%;
            width: 60px;
            height: 60px;
            display: flex;
            align-items: center;
            justify-content: center;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            cursor: pointer;
            font-size: 24px;
        }

        .create-post-btn:hover {
            background-color: #2d6a4f;
        }

        .profile-dropdown img {
            object-fit: cover;
            border: 2px solid #40916c;
            cursor: pointer;
        }
    </style>
</head>

<body>
    <!-- Navbar -->
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

    <!-- Main Content -->
    <div class="container mt-5 pt-5">
        <div class="row">
            <h3 class="col-12">Posts</h3>
        </div>
        <hr>

        @if ($message = Session::get('success'))
        <p class="text-success">{{ $message }}</p>
        @endif

        @if ($posts->isEmpty())
        <p>No posts available.</p>
        @else
        @foreach ($posts as $post)
        <div class="post-card card mb-3">
            <div class="card-body">
                <div class="d-flex align-items-center mb-2">
                    <a href="{{ route('profile.show', $post->user->id) }}" class="d-flex align-items-center text-decoration-none">
                        <img src="{{ asset('storage/' . ($post->user->profile_picture ?? 'images/profile_picture/default.png')) }}" alt="Profile Picture" class="rounded-circle" style="width: 40px; height: 40px; margin-right: 10px;">
                        <p class="mb-0">{{ $post->user->name }}</p>
                    </a>
                </div>
                <p>{{ $post->message }}</p>
                <p class="text-muted small">
                    {{ __('Posted') }}: {{ $post->created_at->diffForHumans() }}
                </p>
                @if ($post->image)
                <img src="{{ asset('storage/images/' . $post->image) }}" class="img-fluid rounded" style="height: 25vh; object-fit: cover;">
                @endif

                <div class="row mt-3">
                    <form class="col-6" action="{{ route('posts.show', $post->id) }}" method="GET">
                        @csrf
                        <button type="submit" class="btn btn-outline-primary btn-sm">View</button>
                    </form>

                    @auth
                    @if (Auth::id() === $post->user_id)
                    <div class="col-6 text-end">
                        <form action="{{ route('posts.edit', $post->id) }}" method="GET" style="display: inline;">
                            @csrf
                            <button type="submit" class="btn btn-outline-secondary btn-sm">Edit</button>
                        </form>
                        <form action="{{ route('posts.destroy', $post->id) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-outline-danger btn-sm ms-2">Delete</button>
                        </form>
                    </div>
                    @endif
                    @endauth
                </div>

                <div class="like-section mt-3">
                    <i class="like-button fa fa-heart 
                        @auth
                        @if ($post->like()->count() > 0)
                            liked
                        @endif
                        @endauth" id="like-button-{{ $post->id }}" onclick="likesClick({{ $post->id }})"></i>
                    <span class="like-count" id="like-count-{{ $post->id }}">{{ $post->likes }}</span>
                </div>
            </div>
        </div>
        @endforeach
        <div class="container">
            {{ $posts->links('pagination::bootstrap-5') }}
        </div>
        @endif
    </div>

    <!-- Create Post Button -->
    @auth
    <form action="{{ route('posts.create') }}" method="GET">
        <button type="submit" class="create-post-btn">
            <i class="fas fa-plus"></i>
        </button>
    </form>
    @endauth

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>

</html>
