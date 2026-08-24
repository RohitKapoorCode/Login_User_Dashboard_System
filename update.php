<?php

session_start();

/* Login check */
if (!isset($_SESSION['login'])) {
    header("Location: login.php");
    exit;
}


/* Database connection */
$conn = mysqli_connect("localhost", "root", "", "login_form");

if (!$conn) {
    die("Connection Failed: " . mysqli_connect_error());
}


/* Current logged-in email */
$current_email = $_SESSION['login'];


/* Get registered user's data */
$query = "SELECT * FROM register WHERE email='$current_email'";

$result = mysqli_query($conn, $query);

$user = mysqli_fetch_assoc($result);

if (!$user) {
    echo "<script>
            alert('User not found');
            window.location.href='login.php';
          </script>";
    exit;
}


/* Update Profile */
if (isset($_POST['update'])) {

    $name     = $_POST['firstname'];
    $last     = $_POST['lastname'];
    $email    = $_POST['email'];
    $phone    = $_POST['phone'];
    $date     = $_POST['date'];
    $gender   = $_POST['gender'];
    $username = $_POST['username'];
    $newpass  = $_POST['password'];


    /*
    Password blank hai:
    Old password same rahega
    */
    if (empty($newpass)) {

        $update = "UPDATE register SET
                    first_name='$name',
                    last_name='$last',
                    email='$email',
                    phone='$phone',
                    date='$date',
                    gender='$gender',
                    username='$username'
                   WHERE email='$current_email'";

    } else {

        /* New password hash */
        $password = password_hash($newpass, PASSWORD_DEFAULT);

        $update = "UPDATE register SET
                    first_name='$name',
                    last_name='$last',
                    email='$email',
                    phone='$phone',
                    date='$date',
                    gender='$gender',
                    username='$username',
                    password='$password'
                   WHERE email='$current_email'";
    }


    /* Run update query */
    if (mysqli_query($conn, $update)) {

        /* New email ko session mein save karo */
        $_SESSION['login'] = $email;

        echo "<script>
                alert('Profile Updated Successfully');
                window.location.href='dash.php';
              </script>";

        exit;

    } else {

        echo "<script>
                alert('Profile Update Failed');
              </script>";
    }
}

?>


<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="UTF-8">

    <meta name="viewport"
          content="width=device-width, initial-scale=1.0">

    <title>Update Profile</title>


    <!-- Bootstrap -->

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
          rel="stylesheet">


    <style>

        body {
            background: #f4f8ff;
            font-family: Arial, sans-serif;
        }


        /* Sidebar */

        .sidebar {
            min-height: 100vh;
            background: linear-gradient(180deg, #0d6efd, #0047ab);
            padding: 25px 15px;
            color: white;
        }


        .logo {
            text-align: center;
            font-size: 23px;
            font-weight: bold;
            margin-bottom: 35px;
        }


        .sidebar a {
            display: block;
            color: white;
            text-decoration: none;
            padding: 13px 15px;
            margin-bottom: 8px;
            border-radius: 10px;
        }


        .sidebar a:hover,
        .sidebar .active {
            background: rgba(255,255,255,0.18);
        }


        /* Topbar */

        .topbar {
            background: white;
            padding: 18px 25px;
            box-shadow: 0 2px 10px rgba(0,0,0,0.06);
        }


        /* Profile Card */

        .profile-card {
            background: white;
            border-radius: 18px;
            padding: 30px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.07);
        }


        .profile-header {
            background: linear-gradient(135deg, #0d6efd, #4e9cff);
            color: white;
            border-radius: 15px;
            padding: 25px;
            margin-bottom: 25px;
        }


        .profile-image {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            background: white;
            color: #0d6efd;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 30px;
            font-weight: bold;
        }


        .form-control,
        .form-select {
            padding: 12px;
            border-radius: 9px;
        }


        .form-control:focus,
        .form-select:focus {
            box-shadow: 0 0 0 3px rgba(13,110,253,0.12);
        }


        .update-btn {
            padding: 12px 30px;
            border-radius: 9px;
        }


        @media(max-width: 768px) {

            .sidebar {
                min-height: auto;
            }

        }

    </style>

</head>


<body>


<div class="container-fluid">

    <div class="row">


        <!-- Sidebar -->

        <div class="col-md-3 col-lg-2 sidebar">

            <div class="logo">
                🚀 MyDashboard
            </div>


            <a href="dash.php">
                🏠 Dashboard
            </a>


            <a href="update.php" class="active">
                👤 Update Profile
            </a>


            <a href="logout.php">
                🚪 Logout
            </a>

        </div>



        <!-- Main Content -->

        <div class="col-md-9 col-lg-10 p-0">


            <!-- Topbar -->

            <div class="topbar">

                <h2 class="mb-0">
                    Update Profile
                </h2>

                <small class="text-muted">
                    Manage your personal information
                </small>

            </div>



            <!-- Content -->

            <div class="p-4">

                <div class="profile-card">


                    <!-- Profile Header -->

                    <div class="profile-header">

                        <div class="d-flex align-items-center gap-3">


                            <div class="profile-image">

                                <?php

                                echo strtoupper(
                                    substr($user['first_name'], 0, 1)
                                );

                                ?>

                            </div>


                            <div>

                                <h3 class="mb-1">

                                    <?php

                                    echo htmlspecialchars(
                                        $user['first_name']
                                    );

                                    ?>

                                </h3>


                                <p class="mb-0">
                                    Update Your Profile Information
                                </p>

                            </div>

                        </div>

                    </div>



                    <!-- Form -->

                    <form action="" method="POST">

                        <div class="row g-4">


                            <!-- First Name -->

                            <div class="col-md-6">

                                <label class="form-label">
                                    First Name
                                </label>

                                <input
                                    type="text"
                                    name="firstname"
                                    class="form-control"
                                    value="<?php echo htmlspecialchars($user['first_name']); ?>"
                                    placeholder="Enter your name"
                                    required
                                >

                            </div>



                            <!-- Last Name -->

                            <div class="col-md-6">

                                <label class="form-label">
                                    Last Name
                                </label>

                                <input
                                    type="text"
                                    name="lastname"
                                    class="form-control"
                                    value="<?php echo htmlspecialchars($user['last_name']); ?>"
                                    placeholder="Enter your last name"
                                    required
                                >

                            </div>



                            <!-- Email -->

                            <div class="col-md-6">

                                <label class="form-label">
                                    Email Address
                                </label>

                                <input
                                    type="email"
                                    name="email"
                                    class="form-control"
                                    value="<?php echo htmlspecialchars($user['email']); ?>"
                                    placeholder="Enter email"
                                    required
                                >

                            </div>



                            <!-- Phone -->

                            <div class="col-md-6">

                                <label class="form-label">
                                    Phone Number
                                </label>

                                <input
                                    type="tel"
                                    name="phone"
                                    class="form-control"
                                    value="<?php echo htmlspecialchars($user['phone']); ?>"
                                    placeholder="Enter phone number"
                                    required
                                >

                            </div>



                            <!-- Date of Birth -->

                            <div class="col-md-6">

                                <label class="form-label">
                                    Date of Birth
                                </label>

                                <input
                                    type="date"
                                    name="date"
                                    class="form-control"
                                    value="<?php echo htmlspecialchars($user['date']); ?>"
                                    required
                                >

                            </div>



                            <!-- Gender -->

                            <div class="col-md-6">

                                <label class="form-label">
                                    Gender
                                </label>

                                <select
                                    class="form-select"
                                    name="gender"
                                    required
                                >

                                    <option value="">
                                        Select Gender
                                    </option>


                                    <option value="Male"
                                        <?php
                                        if ($user['gender'] == 'Male') {
                                            echo 'selected';
                                        }
                                        ?>>
                                        Male
                                    </option>


                                    <option value="Female"
                                        <?php
                                        if ($user['gender'] == 'Female') {
                                            echo 'selected';
                                        }
                                        ?>>
                                        Female
                                    </option>


                                    <option value="Other"
                                        <?php
                                        if ($user['gender'] == 'Other') {
                                            echo 'selected';
                                        }
                                        ?>>
                                        Other
                                    </option>

                                </select>

                            </div>



                            <!-- Username -->

                            <div class="col-md-6">

                                <label class="form-label">
                                    Username
                                </label>

                                <input
                                    type="text"
                                    name="username"
                                    class="form-control"
                                    value="<?php echo htmlspecialchars($user['username']); ?>"
                                    placeholder="Update Username"
                                    required
                                >

                            </div>



                            <!-- Password -->

                            <div class="col-md-6">

                                <label class="form-label">
                                    New Password
                                </label>

                                <input
                                    type="password"
                                    name="password"
                                    class="form-control"
                                    placeholder="Leave blank to keep old password"
                                >

                            </div>



                            <!-- Buttons -->

                            <div class="col-12 mt-4">

                                <button
                                    type="submit"
                                    name="update"
                                    class="btn btn-primary update-btn"
                                >
                                    Update Profile
                                </button>


                                <button
                                    type="reset"
                                    class="btn btn-outline-secondary update-btn ms-2"
                                >
                                    Reset
                                </button>

                            </div>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</div>


</body>

</html>