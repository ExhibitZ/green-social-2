<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Posts</title>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>

    <style>
   
        body {
            font-family: 'Poppins', sans-serif;
        }

        .like-button {
            cursor: pointer;
            font-size: 1.5em;
            color: #ccc;
            transition: transform 0.3s ease, color 0.3s ease;
        }

        .like-button.liked {
            color: red;
            transform: scale(1.2);
        }

        .like-button:hover {
            color: #ff6666;
        }

        .like-count {
            font-size: 1.2em;
            margin-left: 10px;
        }

        .post-card {
            margin-bottom: 20px;
            border-radius: 15px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            transition: transform 0.3s ease;
        }

        .post-card:hover {
            transform: translateY(-5px);
        }

        .card-header {
            background-color: #f8f9fa;
        }

        .heart-pop {
            position: relative;
        }

        .heart-pop .fa-heart {
            animation: pop 0.5s ease-in-out;
        }

        @keyframes pop {
            0% {
                transform: scale(1);
                opacity: 1;
            }
            50% {
                transform: scale(1.5);
                opacity: 0.5;
            }
            100% {
                transform: scale(1);
                opacity: 1;
            }
        }

        .like-section {
            display: flex;
            align-items: center;
        }

        .create-post-btn {
            position: fixed;
            bottom: 20px;
            right: 20px;
            background-color: #28a745;
            color: white;
            font-size: 2rem;
            border-radius: 50%;
            width: 60px;
            height: 60px;
            display: flex;
            justify-content: center;
            align-items: center;
            border: none;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.3);
            transition: transform 0.3s ease;
        }
        .create-post-btn:hover {
            transform: scale(1.1);
        }

        .container {
            margin-top: 100px;
        }

        .page-header {
            color: #28a745;
        }
    </style>
</head>
<body>
    <div class="container-fluid fixed-top bg-white ps-3 pt-2">
        <h1 class="page-header">Green Social</h1>
    </div>

    <div class="container">
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
                        <p>{{ $post->message }}</p>

                        <div class="row">
                            <form class="col-6" action="{{ route('posts.show', $post->id) }}" method="GET">
                                @csrf
                                <button type="submit" class="btn btn-outline-primary btn-sm">View</button>
                            </form>
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
                        </div>

                        <div class="like-section mt-2">
                            <i class="like-button fa fa-heart" id="like-{{ $post->id }}" data-post-id="{{ $post->id }}"></i>
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

    <form action="{{ route('posts.create') }}" method="GET">
        <button type="submit" class="create-post-btn">
            <i class="fas fa-plus"></i>
        </button>
    </form>

    <script>
        document.addEventListener("DOMContentLoaded", function() {
            document.querySelectorAll('.like-button').forEach(button => {
                button.addEventListener('click', function() {
                    let postId = this.getAttribute('data-post-id');
                    let likeCountElement = document.getElementById(`like-count-${postId}`);
                    let likeButton = document.getElementById(`like-${postId}`);

                    likeButton.classList.toggle('liked');

                    let likeCount = parseInt(likeCountElement.textContent);
                    likeCountElement.textContent = likeButton.classList.contains('liked') ? likeCount + 1 : likeCount - 1;

                    fetch(`/posts/${postId}/like`, {
                        method: 'POST',
                        headers: {
                            'Content-Type': 'application/json',
                            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                        },
                        body: JSON.stringify({ like: likeButton.classList.contains('liked') })
                    });
                });
            });
        });
    </script>
</body>
</html>
