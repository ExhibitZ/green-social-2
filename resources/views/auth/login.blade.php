<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous" defer></script>
</head>
<body style="background-color:#f3f4f5;">
    <div class="container text-center mt-5">
        <p style="color: #28a745; font-size: 56px;">Green Social</p>
    </div>
    <div class="container-fluid">
        <div class="row justify-content-center">
            <div class="col-6 pt-2 pb-2 bg-white shadow-sm border rounded">
                <form action="">
                    @csrf
                    <label for="name" class="form-label">Email</label>
                    <input type="email" class="form-control" name="email" id="email" required>
                    <label for="name" class="form-label">Password</label>
                    <input type="password" class="form-control mb-3" name="password" id="password" required>
                    <input type="submit" class="btn btn-primary" value="Login">
                </form>
            </div>
        </div>
    </div>
</body>
</html>