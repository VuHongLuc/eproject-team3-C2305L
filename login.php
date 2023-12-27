<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>
    <!-- Link CSS Bootstrap -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-5">
                <div class="card mt-5 custom-rounded">
                    <div class="card-body">
                        <h2 class="card-title text-center text-red"><strong>LOGIN</strong></h2>
                        <form>
                            <div class="form-group">
                                <label for="username"><strong>Username</strong></label>
                                <input type="text" class="form-control custom-input" id="username" placeholder="Enter username">
                            </div>
                            <div class="form-group">
                                <label for="password"><strong>Password</strong></label>
                                <input type="password" class="form-control custom-input" id="password" placeholder="Enter password">
                                <small class="form-text text-right text-hover-red"><a href="#" class="text-black">Forgot password?</a></small>
                            </div>
                            <div class="form-group text-center">
                                <button type="submit" class="btn btn-danger form-control">LOGIN</button>
                                <span>OR <a href="" class ="text-red">CREATE</a> AN NEW ACCOUNT</span>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Link JavaScript Bootstrap -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>