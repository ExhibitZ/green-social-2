<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Show Post</title>
    
    <link rel="stylesheet" href="{{ asset('css/posts/show.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" defer></script>
    <script src="{{ asset('js/posts/show.js') }}"></script>
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
            margin-bottom: 20px;
        }

        .profile-picture {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            object-fit: cover;
            margin-right: 10px;
        }

        .btn-primary {
            background-color: #40916c;
            border-color: #40916c;
        }

        .btn-primary:hover {
            background-color: #2d6a4f;
            border-color: #2d6a4f;
        }

        .add-comment-form {
        background-color: #ffffff;
        border: 1px solid #d3e4cd;
        border-radius: 10px;
        padding: 15px;
        box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
        margin-top: 20px;
    }

    .profile-picture {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        object-fit: cover;
    }

    .comment-input {
        border-radius: 20px;
        border: 1px solid #d3e4cd;
        padding: 10px 15px;
        width: 100%;
        font-size: 14px;
        resize: none;
        outline: none;
    }

    .comment-input:focus {
        border-color: #40916c;
        box-shadow: 0 0 5px rgba(64, 145, 108, 0.4);
    }

    .btn-add-comment {
        background-color: #40916c;
        border-color: #40916c;
        border-radius: 20px;
        color: white;
        padding: 8px 20px;
        font-size: 14px;
    }

    .btn-add-comment:hover {
        background-color: #2d6a4f;
        border-color: #2d6a4f;
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
                        <img src="{{ asset('storage/' . (Auth::user()->profile_picture ?? 'images/profile_picture/default.png')) }}" alt="Profile Picture" class="profile-picture">
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
        <div class="post-card">
            <div class="d-flex align-items-center mb-3">
                <img src="{{ asset('storage/' . ($post->user->profile_picture ?? 'images/profile_picture/default.png')) }}" class="profile-picture">
                <a href="{{ route('profile.show', $post->user->id) }}" class="text-decoration-none">{{ $post->user->name }}</a>
            </div>
            <p>{{ $post->message }}</p>
            @if ($post->image)
                <img src="{{ asset('storage/images/' . $post->image) }}" class="img-fluid rounded" style="height: 25vh; object-fit: cover;">
            @endif
            <p class="text-muted small">Posted: {{ $post->created_at->diffForHumans() }}</p>
        </div>

        <h3 class="mb-3">Comments</h3>
        <hr>
        @foreach ($comments as $comment)
            <div class="post-card">
                <div class="d-flex align-items-center mb-2">
                    <img src="{{ asset('storage/' . ($comment->user->profile_picture ?? 'images/profile_picture/default.png')) }}" class="profile-picture">
                    <a href="{{ route('profile.show', $comment->user->id) }}" class="text-decoration-none">{{ $comment->user->name }}</a>
                </div>
                <p>{{ $comment->message }}</p>
                @if ($comment->image)
                    <img src="{{ asset('storage/images/' . $comment->image) }}" class="img-fluid rounded" style="height: 25vh; object-fit: cover;">
                @endif
                <p class="text-muted small">Posted: {{ $comment->created_at->diffForHumans() }}</p>
                <div class="like-section mt-2">
                        <i class="like-button fa fa-heart
                        @auth
                        @if (($comment->like()->count() > 0) && (Auth::user()->comment_likes()->count() > 0))
                            liked
                        @endif
                        @endauth" id="like-button-{{ $comment->id }}"
                        @auth
                            onclick="likesClick({{ $post->id }}, {{ $comment->id }})"
                        @endauth></i>
                        <span class="like-count" id="like-count-{{ $comment->id }}">{{ $comment->likes }}</span>
                    </div>
            </div>
        @endforeach
        <div class="container">
            {{ $comments->links('pagination::bootstrap-5') }}
        </div>
    </div>

    <!-- Create Comment Form -->
    @auth
        <div class="add-comment-form mt-4 p-4">
            <form action="{{ route('comments.store', $post->id) }}" method="POST">
                @csrf
                <div class="d-flex align-items-center mb-3">
                    <img src="{{ asset('storage/' . (Auth::user()->profile_picture ?? 'images/profile_picture/default.png')) }}" class="profile-picture me-2">
                    <textarea name="message" class="form-control comment-input" rows="3" placeholder="Write your comment here..." required></textarea>
                </div>
                <div class="text-end">
                    <button type="submit" class="btn btn-add-comment">Post Comment</button>
                </div>
            </form>
        </div>
    @endauth
</body>
</html>
