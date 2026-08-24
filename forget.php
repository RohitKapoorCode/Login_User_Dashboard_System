<!DOCTYPE html>

<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Reset Password</title>

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">

    <style>

        body {
            min-height: 100vh;
            margin: 0;
            background: linear-gradient(135deg, #667eea, #764ba2);
            display: flex;
            justify-content: center;
            align-items: center;
        }

        .reset-card {
            width: 400px;
            border: none;
            border-radius: 18px;
            padding: 10px;
            box-shadow: 0 15px 35px rgba(0, 0, 0, 0.2);
        }

        .reset-title {
            font-weight: 700;
            color: #333;
        }

        .form-control {
            height: 44px;
            border-radius: 9px;
        }

        .form-control:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.15rem rgba(102, 126, 234, 0.2);
        }

        .reset-btn {
            height: 44px;
            border: none;
            border-radius: 9px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            font-weight: 600;
        }

        .reset-btn:hover {
            opacity: 0.9;
        }

        .login-link {
            text-decoration: none;
            font-weight: 600;
        }

        /* Password Eye */
        .password-group .form-control {
            border-radius: 9px 0 0 9px;
        }

        .password-group .btn {
            height: 44px;
            border-radius: 0 9px 9px 0;
        }

    </style>

</head>

<body>
    <?php

if (isset($_POST['reset'])) {

    $email = $_POST['email'];
    $newpass = $_POST['newpass'];

    $conn = mysqli_connect("localhost", "root", "", "login_form")
        or die("Connection Failed");

    $query = "SELECT * FROM register WHERE email='$email'";
    $result = mysqli_query($conn, $query);

    $row = mysqli_fetch_assoc($result);

    if ($row) {

        $hash = password_hash($newpass, PASSWORD_DEFAULT);

        $update = "UPDATE register 
                   SET password ='$hash' 
                   WHERE email='$email'";

        if (mysqli_query($conn, $update)) {

            echo "<script>
                    alert('Password is Updated');
                    window.location.href='login.php';
                  </script>";

        } else {
            echo "Password update failed";
        }

    } else {

        echo "<script>
                alert('Email Not Found');
              </script>";
    }

    mysqli_close($conn);
}



?>


    <div class="card reset-card bg-white">

        <div class="card-body">

            <h2 class="text-center fw-bold text-dark mb-3">
                Reset Password
            </h2>

            <form action="" method="POST">
 
                <!-- Email -->
                <div class="mb-3">

                    <label class="form-label">
                        Email Address
                    </label>

                    <input type="email"
                           class="form-control"
                           name="email"
                           placeholder="Enter your registered email"
                           required>

                </div>


                <!-- New Password -->
                <div class="mb-3">

                    <label class="form-label">
                        New Password
                    </label>

                    <div class="input-group password-group">

                        <input type="password"
                               id="newPassword"
                               name="newpass"
                               class="form-control"
                               placeholder="Enter new password"
                               required>

                        <button type="button"
                                class="btn btn-outline-secondary"
                                onclick="showNewPassword()">

                            👁️

                        </button>

                    </div>

                </div>


            
                <!-- Reset Button -->
                <button type="submit"
                        class="btn btn-primary reset-btn w-100"
                        name="reset">

                    Reset Password

                </button>

            </form>


            <p class="text-center mt-3 mb-0">

                Remember your password?

                <a href="login.php" class="login-link">
                    Back to Login
                </a>

            </p>

        </div>

    </div>


    <!-- Show / Hide New Password -->
    <script>

        function showNewPassword() {

            let password = document.getElementById("newPassword");

            if (password.type === "password") {
                password.type = "text";
            } else {
                password.type = "password";
            }

        }


        <!-- Show / Hide Confirm Password -->

        function showConfirmPassword() {

            let password = document.getElementById("confirmPassword");

            if (password.type === "password") {
                password.type = "text";
            } else {
                password.type = "password";
            }

        }

    </script>

</body>

</html>