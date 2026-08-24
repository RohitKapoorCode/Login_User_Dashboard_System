<?php

            session_start();

            if (!isset($_SESSION['login'])) {
                header("Location: login.php");
                exit;
            }
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title> Dashboard</title>

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">

    <style>

        body {
            margin: 0;
            background: #f5f8ff;
            font-family: Arial, sans-serif;
        }

        /* Sidebar */
        .sidebar {
            min-height: 100vh;
            background: linear-gradient(180deg, #0d6efd, #0047ab);
            color: white;
            padding: 25px 15px;
        }

        .logo {
            text-align: center;
            font-size: 24px;
            font-weight: bold;
            margin-bottom: 35px;
        }

        .menu a {
            display: block;
            color: white;
            text-decoration: none;
            padding: 13px 15px;
            margin-bottom: 8px;
            border-radius: 10px;
            transition: 0.3s;
        }

        .menu a:hover,
        .menu .active {
            background: rgba(255,255,255,0.18);
            transform: translateX(4px);
        }

        /* Topbar */
        .topbar {
            background: white;
            padding: 18px 25px;
            box-shadow: 0 3px 15px rgba(0,0,0,0.05);
        }

        .profile {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .profile-img {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            background: #0d6efd;
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
        }

        /* Welcome */
        .welcome {
            background: linear-gradient(135deg, #0d6efd, #4e9cff);
            color: white;
            border-radius: 18px;
            padding: 30px;
            margin-bottom: 25px;
            box-shadow: 0 8px 25px rgba(13,110,253,0.25);
        }

        .welcome h2 {
            font-weight: bold;
        }

        /* Cards */
        .dashboard-card {
            background: white;
            border: none;
            border-radius: 16px;
            padding: 22px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.06);
            transition: 0.3s;
        }

        .dashboard-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 10px 25px rgba(0,0,0,0.1);
        }

        .icon {
            width: 48px;
            height: 48px;
            background: #e8f1ff;
            color: #0d6efd;
            border-radius: 12px;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 22px;
            margin-bottom: 15px;
        }

        .number {
            font-size: 28px;
            font-weight: bold;
            color: #222;
        }

        .small-text {
            color: #777;
        }

        /* Activity */
        .activity {
            background: white;
            border-radius: 16px;
            padding: 25px;
            box-shadow: 0 5px 20px rgba(0,0,0,0.06);
        }

        .activity-item {
            display: flex;
            align-items: center;
            padding: 15px 0;
            border-bottom: 1px solid #eee;
        }

        .activity-icon {
            width: 40px;
            height: 40px;
            background: #e8f1ff;
            color: #0d6efd;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            margin-right: 15px;
        }

        /* Progress */
        .progress {
            height: 8px;
            border-radius: 10px;
        }

        /* Mobile */
        @media(max-width: 768px) {

            .sidebar {
                min-height: auto;
            }

            .menu {
                display: flex;
                flex-wrap: wrap;
                gap: 5px;
            }

            .menu a {
                padding: 8px 12px;
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
                My Dashboard
            </div>

            <div class="menu">

                <a href="#" class="active">🏠 Dashboard</a>

                <a href="update.php">👤 Profile</a>

                <a href="login.php">🚪 Logout</a>

            </div>

        </div>


        <!-- Main Content -->
        <div class="col-md-9 col-lg-10 p-0">

            <!-- Topbar -->
            <div class="topbar d-flex justify-content-between align-items-center">

                <div>
                    <h2 class="mb-0">Dashboard</h2>
                    <p class="text-muted">
                        Overview of your account
                    </p>
                </div>
            </div>
            

            <!-- Content -->
            <div class="p-4">


                <!-- Welcome -->
                <div class="welcome">

                   <h2>
                        Welcome back,
                        <?php echo isset($_COOKIE["login"]) ? $_COOKIE["login"] : "Guest"; ?>
                    </h2>
                </div>
                

                <!-- Cards -->
               


                            </div>

                        </div>

                    </div>

                </div>


            </div>

        </div>

    </div>

</div>

</body>
</html>