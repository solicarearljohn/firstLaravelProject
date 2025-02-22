

<!-- resources/views/register.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register Page</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<body>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 mt-5">
                <div class="card">
                    <div class="card-body">
                        <h2 class="card-title text-center mb-4">Register</h2>

                        <!-- Register Form -->
                        <form action="/register" method="POST">
                            @csrf
                            <div class="mb-3">

                                <label for="username" class="form-label">Username</label>
                                <input name="username" type="text" class="form-control" id="username" placeholder="Enter your username" required>

                            </div>
                            <div class="mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input name="email" type="email" class="form-control" id="email" placeholder="example@gmail.com" required>
                            </div>
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input name="password" type="password" class="form-control" id="password" placeholder="Enter your password" required>
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Register</button>
                        </form>

                        <div class="mt-3 text-center">
                            <p>Already have an account? <a href="{{ url('/login') }}">Back to Login</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
