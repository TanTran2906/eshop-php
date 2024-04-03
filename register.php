<?php
session_start();
include ("server/connection.php");
//if user has already registered, then take user to account
if (isset($_SESSION['logged_in'])) {
    header('location: account.php');
    exit;
}

if (isset($_POST['register'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $confirmPassword = $_POST['confirmPassword'];

    // Kiểm tra định dạng email bằng filter_var và FILTER_VALIDATE_EMAIL (thuộc tính hỗ trợ sẵn)
    $filteredEmail = filter_var($email, FILTER_VALIDATE_EMAIL);
    if (empty($name)) {
        header('location: register.php?error=Name field cannot be empty!');
    } else if ($filteredEmail === false) {
        header('location: register.php?error=Invalid email format!');
    } else if (strlen($password) < 6) {
        header('location: register.php?error=Password must be at least 6 charachters!');
    } else if ($password !== $confirmPassword) {
        header('location: register.php?error=Password don\'t match!');
    }
    //If there is no error 
    else {
        //check whether there is a user with this email or not
        $stmt1 = $conn->prepare("SELECT count(*) FROM users where user_email=?");
        $stmt1->bind_param('s', $email);
        $stmt1->execute();
        $stmt1->bind_result($num_rows);
        $stmt1->store_result();
        $stmt1->fetch();

        //if there is user already registed with this email
        if ($num_rows != 0) {
            header('location: register.php?error=User with this email already exists');
            //if no user registerd with this email before
        } else {
            // Tạo người dùng mới
            $hashedPassword = md5($password);
            //$stmt = $conn->prepare("INSERT INTO users (user_name, user_email,user_password) VALUES (?,?,?)");
            $stmt = $conn->prepare("CALL register(?,?,?)");
            $stmt->bind_param('sss', $name, $email, $hashedPassword);

            //if account was created successfully
            if ($stmt->execute()) {
                $user_id = $stmt->insert_id;
                $_SESSION['user_id'] = $user_id;
                $_SESSION['user_email'] = $email;
                $_SESSION['user_name'] = $name;
                $_SESSION['logged_in'] = true;
                header('location: account.php?register_success=You registered successfully!');
                //Account could not be created
            } else {
                header('location: register.php?error=Could not create an account at the moment!');
            }
        }
    }

}


?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>Register</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous" />

    <link rel="stylesheet" href="./assets/css/style.css" />
    <link rel="stylesheet" href="./assets/css/register.css" />
</head>

<body>
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg bg-white py-3 fixed-top">
        <div class="container">
            <img class="logo" src="./assets/img/logo.png" />
            <h2 class="brand">Sun</h2>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse nav-buttons" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="index.php">Home</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="shop.php">Shop</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="#">Blog</a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" href="contact.php">Contact us</a>
                    </li>

                    <li class="nav-item">
                        <a href="cart.php"><i class="fa-solid fa-bag-shopping"></i></a>
                        <a href="account.php"><i class="fa-solid fa-user"></i></a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <!-- Register  -->
    <section class="my-5 py-5">
        <div class="container text-center mt-3 pt-5">
            <h2 class="form-weight-bold">Register</h2>
            <hr class="mx-auto line" />
        </div>
        <div class="mx-auto container">
            <p style="color: red;" class="text-center">
                <?php if (isset($_GET["error"])) {
                    echo $_GET["error"];
                } ?>
            </p>
            <form id="register-form" method="POST" action="register.php">
                <div class="form-group">
                    <label>Name</label>
                    <input type="text" class="form-control" id="register-name" name="name" placeholder="Name" />
                </div>
                <div class="form-group">
                    <label>Email</label>
                    <input type="text" class="form-control" id="register-email" name="email" placeholder="Email" />
                </div>
                <div class="form-group">
                    <label>Password</label>
                    <input type="password" class="form-control" id="register-password" name="password"
                        placeholder="Password" />
                </div>
                <div class="form-group">
                    <label>Confirm Password</label>
                    <input type="password" class="form-control" id="register-confirm-password" name="confirmPassword"
                        placeholder="Confirm Password" />
                </div>
                <div class="form-group">
                    <input type="submit" class="btn" id="register-btn" value="Register" name="register" />
                </div>
                <div class="form-group">
                    <a id="login-url" href="login.php" class="btn">Do you have an account? Login
                    </a>
                </div>
            </form>
        </div>
    </section>

    <!--Footer -->
    <?php include ("layouts/footer.php") ?>
</body>

</html>