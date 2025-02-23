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
    <!--user icon-->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
</head>
<body>

    <div class="container">
        <div class="row">
            <div class="col-12 d-flex justify-content-end mt-3">
                <form action="/logout" method="POST">
                    @csrf
                    <!-- Check if the user is authenticated -->
                    @auth
                    <i class="fas fa-user"></i>&nbsp;{{ auth()->user()->username }}&nbsp;&nbsp;
                    @endauth
                    <button class="btn btn-danger">Log Out</button>
                  
                </form>
            </div>
        </div>
        <br>

    
    <div>
        <table class="table table-hover">
            <thead class="table-dark">
                <tr>
                     <!-- <th scope="col">#</th>  -->
                    <th scope="col">Student's Name</th>
                    <th scope="col">Age</th>
                    <th scope="col">Gender</th>
                    <th scope="col">Action</th> <!-- New column for actions -->
                </tr>
            </thead>
            <tbody>
                @foreach($students as $std)
                <tr>
                    <!-- <th scope="row">{ $std -> id }}</th>  -->
                    <td>{{ $std -> name }}</td>
                    <td>{{ $std -> age }}</td>
                    <td>{{ $std -> gender }}</td>
                    <td>
                        <!-- Delete Button -->
                        <form action="{{ route('students.destroy', $std->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Delete</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>

    <!--
    <span class="alert alert-success">
        { session('success') }}
    </span>
-->

     <!-- Check if there's a success message -->
     @if (session('success'))
     <div class="alert alert-success alert-dismissible fade show" role="alert">
         {{ session('success') }}
         <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
     </div>

 
     <script>
         // Automatically close the alert after 4 seconds
         setTimeout(function() {
             var alert = document.querySelector('.alert');
             if (alert) {
                 alert.classList.remove('show');
             }
         }, 4000);  // 4000 milliseconds = 4 seconds
     </script>
     @endif

    <!-- Action btn for modal -->
    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addNewModal">
        Add New Students
    </button>
    <!-- Modal component -->
    <div class="modal fade" id="addNewModal" tabindex="-1" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5" id="exampleModalLabel">Please enter your information!</h1>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form method="post" action="{{ route('std.addNewStudent') }}">
                        @csrf
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" placeholder="Enter name">
                            @error('name')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="age" class="form-label">Age</label>
                            <input type="number" class="form-control" id="age" name="age" value="{{ old('age') }}" placeholder="Enter age" min="1" max="120">
                            @error('age')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="gender" class="form-label">Gender</label>
                            <select class="form-control" id="gender" name="gender">
                                <option value="" disabled selected>Select gender</option>
                                <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>Male</option>
                                <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>Female</option>
                            </select>
                            @error('gender')
                            <span class="text-danger">{{ $message }}</span>
                            @enderror
                        </div>                        

                        <button type="submit" class="btn btn-primary">Save changes</button>
                    </form>
                </div>


            </div>
        </div>
    </div>

</div>
    
    </div>

    

</body>
</html>
