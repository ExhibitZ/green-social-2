<!DOCTYPE html>
<html>
<head>
    <title>Create Post</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous defer"></script>
</head>
<body>
    <div class="container mt-3">
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
                        <form action="{{ route('posts.edit', $post->id) }}" method="GET" style="display: inline;">
                            @csrf
                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                        <form action="{{ route('posts.destroy', $post->id) }}" method="POST" style="display: inline;">
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
