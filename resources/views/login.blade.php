<!-- resources/views/login.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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
                        <h2 class="card-title text-center mb-4">Login</h2>

                        <!-- Login Form -->
                        <form action="/login" method="POST">
                            @csrf
                            <div class="mb-3">
                                <label for="loginname" class="form-label">Username</label>
                                <input name="loginname" type="text" class="form-control" id="loginname" placeholder="Please enter">
                            </div>
                            <div class="mb-3">
                                <label for="loginpassword" class="form-label">Password</label>
                                <input name="loginpassword" type="password" class="form-control" id="loginpassword" placeholder="Please enter your password">
                            </div>
                            <button type="submit" class="btn btn-primary w-100">Login</button>
                        </form>

                        <div class="mt-3 text-center">
                            <p>No account yet? <a href="{{ url('/register') }}">Please register</a></p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

</body>
</html>
