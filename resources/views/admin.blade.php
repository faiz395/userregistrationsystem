<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard - Users List</title>
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/app.css">

    <style>
        body {
            background-color: #f7f9fc;
            font-family: 'Poppins', sans-serif;
        }

        .admin-container {
            padding: 40px;
        }

        .table-container {
            background: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.1);
            margin-bottom: 40px;
        }

        .table thead th {
            background-color: #4a69bd;
            color: white;
            text-align: center;
        }

        .table tbody td {
            text-align: center;
            vertical-align: middle;
        }

        .table tbody td.is-admin {
            font-weight: bold;
            color: #4a69bd;
        }

        h2 {
            text-align: center;
            margin-bottom: 30px;
            font-weight: bold;
            color: #333;
        }

        .logout-btn {
            background-color: #4a69bd;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            float: right;
            margin-bottom: 20px;
        }

        .logout-btn:hover {
            background-color: #3b5998;
        }

        .form-container {
            background: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.1);
        }

        label {
            font-weight: bold;
        }

        .register-btn {
            background-color: #4a69bd;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            margin-top: 10px;
        }

        .register-btn:hover {
            background-color: #3b5998;
        }

        /* Custom CSS for success alert */
        .alert-success-container {
            background-color: #d4edda;
            /* Light green background */
            color: #155724;
            /* Dark green text */
            border: 1px solid #c3e6cb;
            /* Light green border */
            border-radius: 5px;
            /* Rounded corners */
            padding: 15px;
            /* Padding inside the alert */
            margin-bottom: 20px;
            /* Margin below the alert */
            font-family: 'Arial', sans-serif;
            /* Font family for the alert */
            font-size: 16px;
            /* Font size for the alert text */
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            /* Subtle shadow for depth */
            max-width: 600px;
            /* Maximum width of the alert box */
            margin-left: auto;
            /* Center the alert horizontally */
            margin-right: auto;
            /* Center the alert horizontally */
            text-align: center;
            /* Center the text inside the alert */
            transition: opacity 0.3s ease;
            /* Smooth transition effect */
        }

        /* Responsive styling */
        @media (max-width: 768px) {
            .alert-success-container {
                font-size: 14px;
                /* Adjust font size for smaller screens */
                padding: 10px;
                /* Adjust padding for smaller screens */
            }
        }
        .alert-container {
            margin-bottom: 20px;
        }

        .error-container{
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center
        }
    </style>
</head>

<body>

    @if(session('success'))
    <div class="alert alert-success error-container">
        {{ session('success') }}
    </div>
    @endif
    @auth
    <div class="container admin-container">
        <h2>Admin Dashboard - Registered Users</h2>

        <!-- Logout Button -->
        <form action="/logout" method="post">
            @csrf
            <button type="submit" class="logout-btn">Logout</button>
        </form>

        <!-- Table of Registered Users -->
        <div class="table-container">
            <table class="table table-striped table-bordered">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Date Registered</th>
                        <th>Admin Status</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <!-- <td>{{ $user->password }}</td> -->
                        <td>{{ $user->created_at->format('d M Y') }}</td>
                        <td class="is-admin">
                            {{ $user->isAdmin ? 'Admin' : 'User' }}
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- User Registration Form -->

        <div class="form-container">
            <h4 class="text-center mb-4">Register a New User</h4>
            <form action="/signup" method="POST">
                @csrf
                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="name">Name</label>
                        <input type="text" name="name" id="name" class="form-control" placeholder="Enter full name" required>
                    </div>
                    <div class="col-md-6">
                        <label for="email">Email</label>
                        <input type="email" name="email" id="email" class="form-control" placeholder="Enter email address" required>
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <label for="password">Password</label>
                        <input type="password" name="password" id="password" class="form-control" placeholder="Enter password" required>
                    </div>
                    <div class="col-md-6 d-flex align-items-end">
                        <div class="form-check">
                            <input class="form-check-input" type="checkbox" name="isAdmin" id="isAdmin">
                            <label class="form-check-label" for="isAdmin">
                                Register as Admin
                            </label>
                        </div>
                    </div>
                </div>

                <button type="submit" class="register-btn">Register User</button>
            </form>
        </div>
    </div>
    @endauth
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>