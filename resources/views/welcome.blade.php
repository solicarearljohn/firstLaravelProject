<!-- resources/views/dashboard.blade.php -->
@php
    use App\Models\Students;
@endphp


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laravel Activity</title>
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
                    <button class="btn btn-dark">Log Out</button>
                  
                   
                </form>
            </div>
        </div>
        <br>
        
        <form action="{{ route('students.search') }}" method="GET" class="mb-2">
            <div class="input-group">
                <input type="text" class="form-control me-2" style="max-width: 220px;" placeholder="Search Student's name" name="search" value="{{ request('search') }}">
                <button class="btn btn-primary" type="submit">Search</button>
            </div>
        </form>

        
        
        <form action="{{ route('students.index') }}" method="GET" class="mb-2">
            <button class="btn btn-secondary" type="submit">Clear Search</button>
        </form>
        
           
    <div style="border: 1px solid #ebe9e9; border-radius: 8px; background-color:#fffcfc;; padding: 10px;">
        <div>
            <table class="table table-hover table-bordered" style="border-radius: 8px; background-color: #f8f9fa;">
               <!-- Button to trigger modal -->
            <div class="d-flex justify-content-end mb-3">
                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addNewModal">
                    Add New Students
                </button>
            </div>
            
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
                }, 5000);  // 5000 milliseconds = 4 seconds
            </script>
    @endif


    <div class="d-flex justify-content-between align-items-center mb-1">
        <h5 class="text-left">Student's List</h5> 
       
        <h5 class="text-right">Total Students: {{ students::count() }}</h5> <!-- Total Students across all pages -->
    </div>
                <thead class="table-dark">
                    <tr>
                        <th scope="col" class="text-center">#</th>   
                        <th scope="col" class="text-center">Student's Name</th>
                        <th scope="col" class="text-center">Age</th>
                        <th scope="col" class="text-center">Gender</th>
                        <th scope="col" class="text-center">Action</th>
                    </tr>
                </thead>
                <tbody>
                @if($students->count() > 0)  
                  @foreach($students as $std)
                    <tr>
                     
                       <th scope="row" class="text-center">{{ $students->firstItem() + $loop->index }}</th>  
                        <td class="text-center">{{ $std->name }}</td>
                        <td class="text-center">{{ $std->age }}</td>
                        <td class="text-center">{{ $std->gender }}</td>
                        <td>
                    <div class="d-flex justify-content-center">
                          
                            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#editModal{{ $std->id }}">
                                Edit
                            </button>
                            &nbsp;
                           
                            <form action="{{ route('students.destroy', $std->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger">Delete</button>
                            </form>
                    </div>    
                        </td>
                    </tr>
                    @endforeach
                    @else
                        <tr>
                            <td colspan="5" class="text-center">No records found</td>
                        </tr>
                    @endif
                </tbody>   
        </table>
    </div>   

         <!-- Add Pagination Links Below the Table -->
         <div class="d-flex justify-content-end">
            {{ $students->appends(['search' => request('search')])->links('pagination::bootstrap-5') }}
        </div>

    </div>     
                    <!-- Modal component -->
                <div class="modal fade" id="addNewModal" tabindex="-1" aria-hidden="true">
                        <div class="modal-dialog">
                            <div class="modal-content">
                                    <div class="modal-header" style="background-color: #007bff; color: white;">   
                                    <h1 class="modal-title fs-5" id="exampleModalLabel">Please enter your information!</h1>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                </div>
                                <div class="modal-body">
                                    <form method="post" action="{{ route('std.addNewStudent') }}">
                                        @csrf
                                        <div class="mb-3">
                                            <label for="name" class="form-label"><strong>Name</strong></label>
                                            <input type="text" class="form-control" id="name" name="name" value="{{ old('name') }}" placeholder="Last Name, First Name M.I."  pattern="[A-Za-z\s\,\.\-]+" title="Name should only contain letters and spaces"  required>
                                            @error('name')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="age" class="form-label"><strong>Age</strong></label>
                                            <input type="number" class="form-control" id="age" name="age" value="{{ old('age') }}" placeholder="Enter age" min="1" max="120">
                                            @error('age')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>
                                        <div class="mb-3">
                                            <label for="gender" class="form-label"><strong>Gender</strong></label>
                                            <select class="form-control" id="gender" name="gender">
                                                <option value="" disabled selected>Select gender</option>
                                                <option value="Male" {{ old('gender') == 'Male' ? 'selected' : '' }}>Male</option>
                                                <option value="Female" {{ old('gender') == 'Female' ? 'selected' : '' }}>Female</option>
                                            </select>
                                            @error('gender')
                                            <span class="text-danger">{{ $message }}</span>
                                            @enderror
                                        </div>                        

                                        <button type="submit" class="btn btn-success">Save</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                </div>

                <!-- Edit Modals for each student -->
                @foreach($students as $std)
                <div class="modal fade" id="editModal{{ $std->id }}" tabindex="-1" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header" style="background-color: #007bff; color: white;">
                                <h1 class="modal-title fs-5" id="exampleModalLabel">Update Student Information</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body">
                                <form method="post" action="{{ route('students.update', $std->id) }}">
                                    @csrf
                                    @method('PUT')
                                    <div class="mb-3">
                                        <label for="name" class="form-label"><strong>Name</strong></label>
                                        <input type="text" class="form-control" id="name" name="name" value="{{ $std->name }}" placeholder="Enter name" pattern="[A-Za-z\s\.\,\-]+" title="Name should only contain letters and spaces"  required>
                                        @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="age" class="form-label"><strong>Age</strong></label>
                                        <input type="number" class="form-control" id="age" name="age" value="{{ $std->age }}" placeholder="Enter age" min="1" max="120">
                                        @error('age')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="mb-3">
                                        <label for="gender" class="form-label"><strong>Gender</strong></label>
                                        <select class="form-control" id="gender" name="gender">
                                            <option value="Male" {{ $std->gender == 'Male' ? 'selected' : '' }}>Male</option>
                                            <option value="Female" {{ $std->gender == 'Female' ? 'selected' : '' }}>Female</option>
                                        </select>
                                        @error('gender')
                                        <span class="text-danger">{{ $message }}</span>
                                        @enderror
                                    </div>                        

                                    <button type="submit" class="btn btn-success">Save changes</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
                @endforeach

            </div>
            
    </div>

</body>
</html>