<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration System</title>
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

        .form-container {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center;
            min-height: 100vh;
        }

        .error-container {
            display: flex;
            flex-direction: column;
            justify-content: center;
            align-items: center
        }

        .form-box {
            background: #ffffff;
            padding: 40px;
            box-shadow: 0px 0px 20px rgba(0, 0, 0, 0.1);
            border-radius: 10px;
            max-width: 400px;
            width: 100%;
        }

        .form-box h2 {
            text-align: center;
            margin-bottom: 30px;
            font-weight: bold;
            color: #333;
        }

        .form-box .btn-primary {
            width: 100%;
            padding: 10px;
            margin-top: 10px;
            background-color: #4a69bd;
            border: none;
        }

        .form-box .btn-primary:hover {
            background-color: #3b5998;
        }

        .form-box a {
            text-decoration: none;
            font-size: 14px;
            display: block;
            margin-top: 10px;
            text-align: center;
            color: #4a69bd;
        }

        .toggle-link {
            cursor: pointer;
            font-weight: bold;
            color: #333;
        }
    </style>
</head>

<body>
    @if(session('error'))
    <div class="alert alert-danger error-container">
        {{ session('error') }}
    </div>
    @endif
    @if(session('success'))
    <div class="alert alert-success error-container">
        {{ session('success') }}
    </div>
    @endif
    @if($errors->any())
    <div class="alert alert-danger error-container">
        <ul>
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
    @endif

    @auth
    <div class="form-container">
        <h1>Congratulations! LoggedIn Successfully...</h1>
        <form action="/logout" method="post">
            @csrf
            <button class="btn-primary">Log out</button>
        </form>
    </div>
    @else
    <div class="container form-container">
        <div class="m-4">
            <h1 class="text-center">Welcome!</h1>
        </div>
        <div class="form-box" id="loginBox">
            <h2>Login</h2>
            <form action="/login" method="POST">
                @csrf
                <div class="mb-3">
                    <label for="loginEmail" class="form-label">Email address</label>
                    <input name="loginEmail" type="email" class="form-control" id="loginEmail" placeholder="Enter your email" required>
                </div>
                <div class="mb-3">
                    <label for="loginPassword" class="form-label">Password</label>
                    <input name="loginPassword" type="password" class="form-control" id="loginPassword" placeholder="Enter your password" required>
                </div>
                <button type="submit" class="btn btn-primary">Login</button>
                <a class="toggle-link" id="toSignup">Don't have an account? Sign up</a>
            </form>
        </div>

        <div class="form-box d-none" id="signupBox">
            <h2>Sign Up</h2>
            <form action="/signup" method="POST" id="userSignupForm">
                @csrf
                <div class="mb-3">
                    <label for="name" class="form-label">Name</label>
                    <input name="name" type="text" class="form-control" id="signupName" placeholder="Enter your name" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email address</label>
                    <input name="email" type="email" class="form-control" id="signupEmail" placeholder="Enter your email" required>
                </div>
                <div class="mb-3">
                    <label for="password" class="form-label">Password</label>
                    <input name="password" type="password" class="form-control" id="signupPassword" placeholder="Enter your password" required>
                </div>
                <button type="submit" class="btn btn-primary">Sign Up</button>
                <a class="toggle-link" id="toLogin">Already have an account? Login</a>
            </form>
        </div>
    </div>

    <script>
        document.getElementById('userSignupForm').addEventListener('submit', function(e) {

        })
        document.getElementById('toSignup').addEventListener('click', function() {
            document.getElementById('loginBox').classList.add('d-none');
            document.getElementById('signupBox').classList.remove('d-none');
        });

        document.getElementById('toLogin').addEventListener('click', function() {
            document.getElementById('signupBox').classList.add('d-none');
            document.getElementById('loginBox').classList.remove('d-none');
        });
    </script>


    @endauth
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>