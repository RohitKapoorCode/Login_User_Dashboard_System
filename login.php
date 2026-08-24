<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Login </title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>
        body {
            min-height: 100vh;
            background: linear-gradient(135deg, #667eea, #764ba2);
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .login-card {
            width: 400px;
            border: none;
            border-radius: 20px;
            padding: 15px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
        }

        .login-title {
            font-weight: 700;
            color: #333;
        }

        .form-control {
            height: 50px;
            border-radius: 10px;
        }

        .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.2rem rgba(102, 126, 234, 0.2);
        }

        .login-btn {
            height: 50px;
            border: none;
            border-radius: 10px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            font-weight: 600;
        }

        .login-btn:hover {
            opacity: 0.9;
            transform: translateY(-1px);
        }

        .register-link {
            text-decoration: none;
            font-weight: 600;
        }

        /* Password Eye Button */
        .password-group .form-control {
            border-radius: 10px 0 0 10px;
        }

        .password-group .btn {
            border-radius: 0 10px 10px 0;
            height: 50px;
        }
    </style>
</head>

<body>

<?php
session_start();
if (isset($_POST['submit'])) {

    $login = $_POST['login'];
    $Pass = $_POST['password'];

    $conn = mysqli_connect("localhost", "root", "", "login_form")
        or die("Connection is Disconnected");

    $query = "SELECT * FROM register WHERE username='$login'";

    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) > 0) {

        $user = mysqli_fetch_assoc($result);

        if (password_verify($Pass, $user['password'])) {

        $_SESSION['login'] = $user['email'];

        $cookie_name = "login";
        $cookie_value = $user['username'];

        setcookie(
            $cookie_name,
            $cookie_value,
            time() + 120 ,
            "/"
        );


            header("Location: http://localhost/Rohit%20Project/Login%20Form/dash.php");
            exit;

        } else {

            echo "<script>alert('Wrong Password')</script>";
        }

    } else {

        echo "<script>
                alert('You are not registered. Please register first');
                window.location.href='register.php';
              </script>";

        exit;
    }

    
    }

?>

<div class="card login-card bg-white">

    <div class="card-body">

        <h2 class="text-center fw-bold text-dark mb-3">
            Login Form</h2>

        <form action="" method="POST">

            <!-- Username -->
            <div class="mb-3">

                <label class="form-label">
                    Username
                </label>

                <input type="email"
                       name="login"
                       class="form-control"
                       placeholder="Enter Username"
                       required>

            </div>


            <!-- Password -->
            <div class="mb-3">

                <label class="form-label">
                    Password
                </label>

                <div class="input-group password-group">

                    <input type="password"
                           name="password"
                           id="password"
                           class="form-control"
                           placeholder="Enter your password"
                           required>

                    <button type="button"
                            class="btn btn-outline-secondary"
                            onclick="showPassword()"
                            id="eyeButton">

                        👁️

                    </button>

                </div>

            </div>


            <!-- Remember + Forgot -->
            <div class="d-flex justify-content-between mb-4">

                <div class="form-check">

                    <input class="form-check-input"
                           type="checkbox"
                           id="remember">

                    <label class="form-check-label" for="remember">
                        Remember me
                    </label>

                </div>

                <a href="forget.php" class="text-decoration-none">
                    Forgot Password?
                </a>

            </div>


            <!-- Login Button -->
            <button type="submit"
                    name="submit"
                    class="btn btn-primary login-btn w-100">

                Login

            </button>

        </form>


        <p class="text-center mt-4 mb-0">

            Don't have an account?

            <a href="register.php" class="register-link">
                Register
            </a>

        </p>

    </div>

</div>


<script>

function showPassword() {

    let password = document.getElementById("password");
    let eyeButton = document.getElementById("eyeButton");

    if (password.type === "password") {

        password.type = "text";
        eyeButton.innerHTML = "👁️";

    } else {

        password.type = "password";
        eyeButton.innerHTML = "🙈";

    }

}

</script>

</body>
</html>