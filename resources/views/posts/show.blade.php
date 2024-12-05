<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Show Post</title>
    
    <link rel="stylesheet" href="{{ asset('css/posts/show.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous defer"></script>
    <script src="{{ asset('js/posts/show.js') }}"></script>
</head>
<body>
    <div class="container-fluid fixed-top bg-white ps-3 pt-2">
        <div class="col-2">
            <a href="{{ route('posts.index') }}" style="text-decoration: none;">
                <h1 class="page-header">
                    Green Social
                </h1>
            </a>
        </div>
    </div>

    <div class="container margin-top-add">
        <h1 class="mb-4">Post</h1>
        <p class="border rounded p-3 mb-5">{{ $post->message }}</p>
        <div class="row">
            <h3 class="col-3">Comments</h3>
        </div>
        <hr>
        @if ($message = Session::get('success'))
            <p class="text-success">{{ $message }}</p>
        @endif
        @foreach ($comments as $comment)
            <div class="post-card card mb-3">
                <div class="card-body">
                    <p>{{ $comment->message }}</p>
                    @if(!is_null($comment->image))
                        <img src="{{ asset('storage/images/' . $comment->image) }}" style="height:25vh">
                        <br><br>
                    @endif
                    
                    <div class="row">
                        <div class="col-12 text-end">
                            <form action="{{ route('comments.edit', ['postId' => $post->id, 'commentId' => $comment->id]) }}" method="GET" style="display: inline;">
                                @csrf
                                <button type="submit" class="btn btn-outline-secondary btn-sm">Edit</button>
                            </form>
                            <form action="{{ route('comments.destroy', ['postId' => $post->id, 'commentId' => $comment->id]) }}" method="POST" style="display: inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger btn-sm ms-2">Delete</button>
                            </form>
                        </div>
                    </div>

                    <div class="like-section mt-2">
                        <i class="like-button fa fa-heart 
                        @if ($comment->like()->count() > 0)
                            liked
                        @endif" id="like-button-{{ $comment->id }}" onclick="likesClick({{ $post->id }}, {{ $comment->id }})"></i>
                        <span class="like-count" id="like-count-{{ $comment->id }}">{{ $comment->likes }}</span>
                    </div>
                </div>
            </div>
        @endforeach
        <div class="container">
            {{ $comments->links('pagination::bootstrap-5') }}
        </div>
    </div>
    <form action="{{ route('comments.create', $post->id) }}" method="GET">
        <button type="submit" class="create-comment-btn">
            <i class="fas fa-plus"></i>
        </button>
    </form>
</body>
</html>
