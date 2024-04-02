<?php
session_start();
include ("../server/connection.php");

if (isset($_SESSION['admin_logged_in'])) {
    header('location: index.php');
    exit;
}
if (isset($_POST['login_btn'])) {

    $email = $_POST['email'];
    $password = md5($_POST['password']);

    $stmt = $conn->prepare("SELECT admin_id,admin_name, admin_email, admin_password FROM admins WHERE admin_email = ? AND admin_password = ? LIMIT 1");

    $stmt->bind_param('ss', $email, $password);

    if ($stmt->execute()) {
        $stmt->bind_result($admin_id, $admin_name, $admin_email, $admin_password);
        $stmt->store_result();


        if ($stmt->num_rows() == 1) {
            $stmt->fetch();

            $_SESSION['admin_id'] = $admin_id;
            $_SESSION['admin_name'] = $admin_name;
            $_SESSION['admin_email'] = $admin_email;
            $_SESSION['admin_logged_in'] = true;

            header('location: index.php?login_success=Logged in successfully!');

        } else {
            header('location: login.php?error=Could not verify your account!');
        }
    }

}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Login</title>
    <link rel="stylesheet" href="../assets/css/admin_login.css">
</head>

<body>
    <section>
        <div class="form-box">
            <div class="form-value">
                <form method="POST" action="login.php">
                    <h2>Login</h2>
                    <div class="inputbox">
                        <ion-icon name="mail-outline"></ion-icon>
                        <input type="email" required name="email">
                        <label for="">Email</label>
                    </div>
                    <div class="inputbox">
                        <ion-icon name="lock-closed-outline"></ion-icon>
                        <input type="password" required name="password">
                        <label for="">Password</label>
                    </div>
                    <!-- <div class="forget">
                        <label for=""><input type="checkbox">Remember Me <a href="#">Forget Password</a></label>

                    </div> -->
                    <button type="submit" name="login_btn">Log in</button>
                    <!-- <div class="register">
                        <p>Don't have a account <a href="#">Register</a></p>
                    </div> -->
                </form>
            </div>
        </div>
    </section>
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
</body>

</html>