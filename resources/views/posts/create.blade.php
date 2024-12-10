<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Create Post</title>
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <style>
        body {
            background-color: #f4f9f4; /* Subtle green background */
            color: #2d6a4f; /* Deep green text */
            font-family: 'Arial', sans-serif;
        }
        .create-post-card {
            background-color: #ffffff; /* White background for the card */
            border: 1px solid #d3e4cd;
            border-radius: 10px;
            box-shadow: 0px 4px 6px rgba(0, 0, 0, 0.1);
            padding: 20px;
        }
        .btn-green {
            background-color: #40916c;
            color: white;
            border: none;
        }
        .btn-green:hover {
            background-color: #2d6a4f;
        }
        .custom-file-input {
            color: #2d6a4f;
        }
        .form-control:focus {
            border-color: #40916c;
            box-shadow: 0 0 0 0.2rem rgba(64, 145, 108, 0.25);
        }
        h1 {
            font-size: 24px;
            font-weight: bold;
        }
    </style>
</head>
<body>
    <div class="container my-5">
        <div class="row justify-content-center">
            <div class="col-lg-6 col-md-8 col-sm-12">
                <div class="create-post-card">
                    <h1 class="mb-4 text-center">🌱 Create a New Post</h1>
                    
                    <!-- Display validation errors -->
                    @foreach ($errors->all() as $error)
                        <p class="text-danger small">{{ $error }}</p>
                    @endforeach
                    
                    <form action="{{ route('posts.store') }}" method="POST" enctype="multipart/form-data">
                        @csrf
                        <!-- Message Input -->
                        <div class="mb-4">
                            <label for="message" class="form-label">Share Your Green Initiative</label>
                            <textarea class="form-control" name="message" id="message" rows="4" placeholder="Write your thoughts here..." required></textarea>
                        </div>
                        
                        <!-- Image Upload -->
                        <div class="mb-4">
                            <label for="image" class="form-label">Upload a Picture (Optional)</label>
                            <input class="form-control custom-file-input" type="file" id="image" name="image" accept="image/*">
                        </div>
                        
                        <!-- Submit Button -->
                        <button type="submit" class="btn btn-green w-100 py-2">Post It 🌿</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</body>
</html>
