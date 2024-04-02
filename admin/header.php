<?php
session_start();
?>
<?php
include ("../server/connection.php");
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0, user-scalable=0" />
    <meta name="description" content="POS - Bootstrap Admin Template" />
    <meta name="keywords"
        content="admin, estimates, bootstrap, business, corporate, creative, management, minimal, modern,  html5, responsive" />
    <meta name="author" content="Dreamguys - Bootstrap Admin Template" />
    <meta name="robots" content="noindex, nofollow" />
    <title>Admin</title>

    <link rel="shortcut icon" type="image/x-icon" href="assets/img/favicon.jpg" />

    <link rel="stylesheet" href="assets/css/bootstrap.min.css" />

    <link rel="stylesheet" href="assets/css/animate.css" />

    <link rel="stylesheet" href="assets/css/dataTables.bootstrap4.min.css" />

    <link rel="stylesheet" href="assets/plugins/fontawesome/css/fontawesome.min.css" />
    <link rel="stylesheet" href="assets/plugins/fontawesome/css/all.min.css" />

    <link rel="stylesheet" href="assets/css/style.css" />
</head>

<body>
    <div id="global-loader">
        <div class="whirly-loader"></div>
    </div>

    <div class="main-wrapper">
        <!-- Navbar - Header  -->
        <div class="header">
            <div class="header-left active">
                <a href="index.php" class="logo">
                    <img src="assets/img/logo.png" alt="" />
                </a>
                <a href="index.php" class="logo-small">
                    <img src="assets/img/logo-small.png" alt="" />
                </a>
                <a id="toggle_btn" href="javascript:void(0);"> </a>
            </div>

            <a id="mobile_btn" class="mobile_btn" href="#sidebar">
                <span class="bar-icon">
                    <span></span>
                    <span></span>
                    <span></span>
                </span>
            </a>

            <ul class="nav user-menu">

                <li class="nav-item dropdown has-arrow main-drop">
                    <a href="javascript:void(0);" class="dropdown-toggle nav-link userset" data-bs-toggle="dropdown">
                        <span class="user-img"><img src="assets/img/profiles/avator1.jpg" alt="" />
                            <span class="status online"></span></span>
                    </a>
                    <div class="dropdown-menu menu-drop-user">
                        <div class="profilename">
                            <div class="profileset">
                                <span class="user-img"><img src="assets/img/profiles/avator1.jpg" alt="" />
                                    <span class="status online"></span></span>
                                <div class="profilesets">
                                    <h6>
                                        <?php if (isset($_SESSION['admin_name']))
                                            echo $_SESSION['admin_name']; ?>
                                    </h6>
                                    <h5>Admin</h5>
                                </div>
                            </div>
                            <!-- <hr class="m-0" />
                            <a class="dropdown-item" href="profile.html">
                                <i class="me-2" data-feather="user"></i> My
                                Profile</a> -->
                            <hr class="m-0" />
                            <a class="dropdown-item logout pb-0" href="logout.php?logout=1"><img
                                    src="assets/img/icons/log-out.svg" class="me-2" alt="img" />Logout</a>
                        </div>
                    </div>
                </li>

            </ul>
        </div>