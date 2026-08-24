<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>Register Form</title>

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

        .register-card {
            width: 430px;
            border: none;
            border-radius: 16px;
            padding: 5px;
            box-shadow: 0 12px 30px rgba(0, 0, 0, 0.2);
        }

        .register-title {
            font-size: 24px;
            font-weight: 700;
            color: #333;
        }

        .form-label {
            font-size: 14px;
        }

        .form-control,
        .form-select {
            height: 36px;
            border-radius: 8px;
            font-size: 14px;
        }

        .form-control:focus,
        .form-select:focus {
            border-color: #667eea;
            box-shadow: 0 0 0 0.12rem rgba(102, 126, 234, 0.2);
        }

        .register-btn {
            height: 40px;
            border: none;
            border-radius: 8px;
            background: linear-gradient(135deg, #667eea, #764ba2);
            font-weight: 600;
        }

        .register-btn:hover {
            opacity: 0.9;
        }

        .login-link {
            text-decoration: none;
            font-weight: 600;
        }

        /* Password Eye Button */
        .password-group .form-control {
            border-radius: 8px 0 0 8px;
        }

        .password-group .btn {
            height: 36px;
            border-radius: 0 8px 8px 0;
        }

    </style>

</head>

<body>

<?php

if (isset($_POST['submit'])) {

    $name = $_POST['firstname'];
    $last = $_POST['lastname'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $date = $_POST['date'];
    $gender = $_POST['gender'];
    $username = $_POST['username'];

    // Password Hash
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT);

    // Database Connection
    $conn = mysqli_connect("localhost", "root", "", "login_form")
        or die("Connection Failed");

    // Insert Query
    $query = "INSERT INTO `register`
    (`first_name`, `last_name`, `email`, `phone`, `date`, `gender`, `username`, `password`)
    VALUES
    ('$name', '$last', '$email', '$phone', '$date', '$gender', '$username', '$password')";

    $result = mysqli_query($conn, $query);

    if ($result) {

        header("Location: http://localhost/Rohit%20Project/Login%20Form/login.php");
        exit;

    } else {

        echo "Query Error: " . mysqli_error($conn);

    }

}

?>

<div class="card register-card bg-white">

    <div class="card-body">

        <h2 class="text-center fw-bold text-dark mb-3">
            Register Form
        </h2>

        <form action="" method="POST">

            <!-- First & Last Name -->
            <div class="row">

                <div class="col-6 mb-1">

                    <label class="form-label mb-0">
                        First Name
                    </label>

                    <input type="text"
                           name="firstname"
                           class="form-control"
                           placeholder="First name"
                           required>

                </div>

                <div class="col-6 mb-1">

                    <label class="form-label mb-0">
                        Last Name
                    </label>

                    <input type="text"
                           name="lastname"
                           class="form-control"
                           placeholder="Last name"
                           required>

                </div>

            </div>


            <!-- Email -->
            <div class="mb-1">

                <label class="form-label mb-0">
                    Email
                </label>

                <input type="email"
                       name="email"
                       class="form-control"
                       placeholder="Enter your email"
                       required>

            </div>


            <!-- Phone -->
            <div class="mb-1">

                <label class="form-label mb-0">
                    Phone
                </label>

                <input type="tel"
                       name="phone"
                       class="form-control"
                       placeholder="Enter phone number"
                       required>

            </div>


            <!-- DOB & Gender -->
            <div class="row">

                <div class="col-6 mb-1">

                    <label class="form-label mb-0">
                        Date of Birth
                    </label>

                    <input type="date"
                           name="date"
                           class="form-control"
                           required>

                </div>


                <div class="col-6 mb-1">

                    <label class="form-label mb-0">
                        Gender
                    </label>

                    <select name="gender"
                            class="form-select"
                            required>

                        <option value="">Select</option>
                        <option value="Male">Male</option>
                        <option value="Female">Female</option>
                        <option value="Other">Other</option>

                    </select>

                </div>

            </div>


            <!-- Username -->
            <div class="mb-1">

                <label class="form-label mb-0">
                    Username
                </label>

                <input type="text"
                       name="username"
                       class="form-control"
                       placeholder="Enter Username"
                       required>

            </div>


            <!-- Password -->
            <div class="mb-2">

                <label class="form-label mb-0">
                    Password
                </label>

                <div class="input-group password-group">

                    <input type="password"
                           name="password"
                           id="password"
                           class="form-control"
                           placeholder="Enter password"
                           required>

                    <button type="button"
                            class="btn btn-outline-secondary"
                            onclick="showPassword()">

                        👁️

                    </button>

                </div>

            </div>


            <!-- Terms -->
            <div class="form-check mb-2">

                <input class="form-check-input"
                       type="checkbox"
                       id="terms"
                       required>

                <label class="form-check-label small"
                       for="terms">

                    I agree to Terms & Conditions

                </label>

            </div>


            <!-- Button -->
            <button type="submit"
                    name="submit"
                    class="btn btn-primary register-btn w-100">

                Create Account

            </button>

        </form>


        <p class="text-center small mt-2 mb-0">

            Already have an account?

            <a href="login.php"
               class="login-link">

                Login

            </a>

        </p>

    </div>

</div>


<!-- Show / Hide Password -->
<script>

function showPassword() {

    let password = document.getElementById("password");

    if (password.type === "password") {

        password.type = "text";

    } else {

        password.type = "password";

    }

}

</script>

</body>
</html>