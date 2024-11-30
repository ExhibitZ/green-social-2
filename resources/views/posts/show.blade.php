<!DOCTYPE html>
<html>
<head>
    <title>Show Post</title>
    <link rel="stylesheet" href="{{ asset('css/posts/show.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous defer"></script>
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
        <h1 class="mb-4">View Post</h1>
        <p class="border rounded p-3 mb-5">{{ $post->message }}</p>
        <div class="row">
            <h3 class="col-3">Comments</h3>
            <form class="col-3 offset-6 text-end" action="{{ route('comments.create', $post->id) }}" method="GET">
                <button type="submit" class="btn btn-primary">Create Comment</button>
            </form>
        </div>
        <hr>
        @if ($message = Session::get('success'))
            <p class="text-success">{{ $message }}</p>
        @endif
        @foreach ($comments as $comment)
            <div class="container mb-3 p-3 border rounded ">
                <p>{{ $comment->message }}</p>
                <p>Likes: {{ $comment->likes }}</p>

                <div class="row">
                    <div class="col-12 text-end">
                        <form action="{{ route('comments.edit', ['postId' => $post->id, 'commentId' => $comment->id]) }}" method="GET" style="display: inline;">
                            @csrf
                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                        <form action="{{ route('comments.destroy', ['postId' => $post->id, 'commentId' => $comment->id]) }}" method="POST" style="display: inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
        <div class="container">
            {{ $comments->links('pagination::bootstrap-5') }}
        </div>
    </div>
</body>
</html>
