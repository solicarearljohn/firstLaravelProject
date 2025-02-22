<!-- resources/views/home.blade.php -->

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Homepage</title>
    <!-- Include Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
</head>
<body>

    <div class="container">
        <div class="row">
            <div class="col-12 d-flex justify-content-end mt-3">
                <form action="/logout" method="POST">
                    @csrf
                    <button class="btn btn-danger">Log Out</button>
                </form>
            </div>
        </div>

        @auth
        <div class="row">
            <div class="col-12 mt-4">
                <!-- Welcome Alert -->
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <strong>Hi, {{ auth()->user()->username }}!</strong> Welcome to the homepage, feel free to explore!
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            </div>
        </div>
        </div>
        @endauth

    
    </div>

    

</body>
</html>
